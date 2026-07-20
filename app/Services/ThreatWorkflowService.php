<?php

namespace App\Services;

use App\Models\Incident;
use App\Models\ResponseAction;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ThreatWorkflowService
{
    /** Active Response command name — must match a <command> defined in the agent's ossec.conf. */
    private const ACTIVE_RESPONSE_COMMAND = 'firewall-drop';

    public function __construct(private WazuhService $wazuh) {}

    public function signature(array $alert): string
    {
        if (! empty($alert['id'])) {
            return (string) $alert['id'];
        }

        return md5(($alert['rule_id'] ?? '').'|'.($alert['agent'] ?? '').'|'.($alert['time'] ?? ''));
    }

    public function attach(array $alerts): array
    {
        $alerts = array_map(function ($alert) {
            $alert['signature'] = $this->signature($alert);

            return $alert;
        }, $alerts);

        $signatures = array_column($alerts, 'signature');

        $incidents = Incident::with('assignee')
            ->whereIn('alert_signature', $signatures)
            ->get()
            ->keyBy('alert_signature');

        $blockedIpStatus = $this->blockedIpStatuses()->keyBy('ip');

        return array_map(function ($alert) use ($incidents, $blockedIpStatus) {
            $incident = $incidents->get($alert['signature']);
            $blockStatus = $blockedIpStatus->get($alert['source']);

            $alert['incident_status'] = $incident->status ?? 'open';
            $alert['incident_id'] = $incident->id ?? null;
            $alert['incident_created_at'] = optional($incident?->created_at)->format('Y-m-d H:i');
            $alert['assigned_to'] = $incident->assigned_to ?? null;
            $alert['assigned_to_name'] = $incident->assignee->name ?? null;
            $alert['block_status'] = $blockStatus;
            $alert['response_label'] = $this->responseLabel($blockStatus, $alert['incident_status']);
            $alert['recommendations'] = $this->recommendationsFor($alert['category'] ?? null);
            $alert['mitre'] = $this->mitreFor($alert['rule_id'] ?? null, $alert['category'] ?? null);
            $alert['detection_source'] = $this->detectionSourceFor($alert['category'] ?? null);
            $alert['detection_engine'] = $this->detectionEngineFor($alert['category'] ?? null);
            $alert['prediction'] = $this->predictionFor($alert['category'] ?? null);
            $alert['detection_category'] = $this->detectionCategoryFor($alert['category'] ?? null);
            $alert['rule_label'] = $this->ruleLabelFor($alert['rule_id'] ?? null, $alert['category'] ?? null);

            return $alert;
        }, $alerts);
    }

    /**
     * Derive current block/unblock status per source IP from the local response_actions
     * audit trail — Wazuh has no queryable "currently blocked" list, so this is the
     * source of truth for both the Response Management page and threat enrichment.
     */
    public function blockedIpStatuses(): Collection
    {
        return ResponseAction::query()
            ->whereIn('action', ['block_ip', 'unblock_ip'])
            ->where('status', 'success')
            ->whereNotNull('source_ip')
            ->orderBy('executed_at')
            ->get()
            ->groupBy('source_ip')
            ->map(function (Collection $actions, string $ip) {
                $lastBlock = $actions->where('action', 'block_ip')->last();
                $lastUnblock = $actions->where('action', 'unblock_ip')->last();

                if (! $lastBlock) {
                    return null;
                }

                $isUnblocked = $lastUnblock && $lastUnblock->executed_at->gt($lastBlock->executed_at);

                return [
                    'ip' => $ip,
                    'status' => $isUnblocked ? 'Unblocked' : 'Blocked',
                    'blocked_at' => optional($lastBlock->executed_at)->toIso8601String(),
                    'unblocked_at' => $isUnblocked ? optional($lastUnblock->executed_at)->toIso8601String() : null,
                    'rule_description' => $lastBlock->rule_description,
                    'signature' => $lastBlock->alert_signature,
                    'rule_id' => $lastBlock->rule_id,
                    'agent_name' => $lastBlock->agent_name,
                ];
            })
            ->filter()
            ->values();
    }

    public function severityDistribution(array $alerts): array
    {
        $counts = collect($alerts)->countBy('severity');

        return [
            'Critical' => $counts->get('Critical', 0),
            'High' => $counts->get('High', 0),
            'Medium' => $counts->get('Medium', 0),
            'Low' => $counts->get('Low', 0),
        ];
    }

    public function topThreatTypes(array $alerts, int $limit = 5): array
    {
        return collect($alerts)
            ->countBy('rule')
            ->sortDesc()
            ->take($limit)
            ->map(fn ($count, $rule) => ['rule' => $rule, 'count' => $count])
            ->values()
            ->all();
    }

    public function responseLabel(?array $blockStatus, string $incidentStatus): string
    {
        if ($blockStatus) {
            return $blockStatus['status'] === 'Blocked' ? 'Blocked' : 'Completed';
        }

        return $incidentStatus === 'resolved' ? 'Completed' : 'Pending';
    }

    public function recommendationsFor(?string $category): array
    {
        $map = config('threat_recommendations');

        return $map[$category] ?? $map['default'];
    }

    public function mitreFor(?string $ruleId, ?string $category): ?array
    {
        $map = config('mitre_attack');

        if ($ruleId && isset($map['by_rule_id'][$ruleId])) {
            return $map['by_rule_id'][$ruleId];
        }

        return $map['by_category'][$category] ?? null;
    }

    /**
     * Wazuh itself only reports signature-based (Suricata) alerts — the
     * "Behaviour Anomaly" category is this app's one ML-scored alert type,
     * produced by the separate Python behaviour-detection service instead.
     */
    private const BEHAVIOUR_CATEGORY = 'Behaviour Anomaly';

    public function detectionSourceFor(?string $category): string
    {
        return $category === self::BEHAVIOUR_CATEGORY ? 'Python Behaviour Detection' : 'Suricata IDS';
    }

    public function detectionEngineFor(?string $category): string
    {
        return $category === self::BEHAVIOUR_CATEGORY ? 'Isolation Forest' : 'Suricata';
    }

    /**
     * Only behaviour-detection alerts carry a model prediction — an alert
     * reaching this list already means the model flagged it, so this is
     * always ANOMALY today; NORMAL is here for when real Isolation Forest
     * scores start flowing through instead of just the flagged ones.
     */
    public function predictionFor(?string $category): ?string
    {
        return $category === self::BEHAVIOUR_CATEGORY ? 'ANOMALY' : null;
    }

    /**
     * Coarse two-value classification (on top of detectionSourceFor) purely
     * for demo/presentation clarity — makes it unambiguous at a glance which
     * of the two detection engines produced a given alert.
     */
    public function detectionCategoryFor(?string $category): string
    {
        return $category === self::BEHAVIOUR_CATEGORY ? 'Behaviour Detection' : 'Network Detection';
    }

    /**
     * Short, human-readable nickname for a rule — shown next to the raw
     * rule ID so it reads as e.g. "100200 (Nmap Detection)" instead of a
     * bare number. Same by_rule_id-then-by_category fallback pattern as
     * mitreFor(); rule IDs are this app's own demo/Wazuh custom rule set.
     */
    public function ruleLabelFor(?string $ruleId, ?string $category): string
    {
        $byRuleId = [
            '100200' => 'Nmap Detection',
            '100210' => 'Port Scan Detection',
            '100310' => 'Malware C2 Detection',
            '100410' => 'SQL Injection Detection',
            '100420' => 'XSS Detection',
            '100500' => 'Brute Force Detection',
            '100510' => 'SSH Brute Force Detection',
            '100600' => 'Behaviour Detection',
        ];

        if ($ruleId && isset($byRuleId[$ruleId])) {
            return $byRuleId[$ruleId];
        }

        $byCategory = [
            'Reconnaissance' => 'Network Scan Detection',
            'Authentication Attack' => 'Brute Force Detection',
            'Malware' => 'Malware Detection',
            'Web Attack' => 'Web Attack Detection',
            self::BEHAVIOUR_CATEGORY => 'Behaviour Detection',
        ];

        return $byCategory[$category] ?? 'Signature Detection';
    }

    public function recordIncidentStatus(string $signature, array $alertMeta, string $status): Incident
    {
        return Incident::updateOrCreate(
            ['alert_signature' => $signature],
            [
                'rule_id' => $alertMeta['rule_id'] ?? null,
                'agent_name' => $alertMeta['agent'] ?? null,
                'source_ip' => $alertMeta['source'] ?? null,
                'status' => $status,
                'updated_by' => Auth::id(),
            ]
        );
    }

    public function assignIncident(string $signature, array $alertMeta, ?int $userId): Incident
    {
        return Incident::updateOrCreate(
            ['alert_signature' => $signature],
            [
                'rule_id' => $alertMeta['rule_id'] ?? null,
                'agent_name' => $alertMeta['agent'] ?? null,
                'source_ip' => $alertMeta['source'] ?? null,
                'assigned_to' => $userId,
                'updated_by' => Auth::id(),
            ]
        )->fresh('assignee');
    }

    public function blockIp(string $signature, array $alertMeta): ResponseAction
    {
        $action = ResponseAction::create([
            'alert_signature' => $signature,
            'rule_id' => $alertMeta['rule_id'] ?? null,
            'rule_description' => $alertMeta['rule'] ?? null,
            'source_ip' => $alertMeta['source'] ?? null,
            'agent_name' => $alertMeta['agent'] ?? null,
            'action' => 'block_ip',
            'status' => 'pending',
            'executed_at' => now(),
            'executed_by' => Auth::id(),
        ]);

        $agentId = $alertMeta['agent_id'] ?? null;
        $sourceIp = $alertMeta['source'] ?? null;

        if (! $agentId || ! $sourceIp || $sourceIp === 'N/A') {
            $action->update([
                'status' => 'failed',
                'note' => 'No agent ID or source IP available for this alert — cannot trigger Active Response.',
            ]);

            return $action;
        }

        $result = $this->wazuh->triggerActiveResponse($agentId, self::ACTIVE_RESPONSE_COMMAND, [$sourceIp]);

        $action->update([
            'status' => $result['success'] ? 'success' : 'failed',
            'note' => $result['message'],
        ]);

        return $action;
    }

    /**
     * Unblock is recorded as an administrative decision (no reliable generic
     * "undo active-response" call exists across Wazuh setups), but it is a
     * real, persisted response_actions row — not a client-side simulation.
     */
    public function unblockIp(string $signature, array $alertMeta): ResponseAction
    {
        return ResponseAction::create([
            'alert_signature' => $signature,
            'rule_id' => $alertMeta['rule_id'] ?? null,
            'rule_description' => $alertMeta['rule'] ?? null,
            'source_ip' => $alertMeta['source'] ?? null,
            'agent_name' => $alertMeta['agent'] ?? null,
            'action' => 'unblock_ip',
            'status' => 'success',
            'executed_at' => now(),
            'executed_by' => Auth::id(),
            'note' => 'Unblocked by administrator.',
        ]);
    }
}
