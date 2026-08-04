<?php

namespace App\Http\Controllers;

use App\Models\ResponseAction;
use App\Services\DemoDataService;
use App\Services\ThreatWorkflowService;
use App\Services\WazuhService;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function __construct(
        private WazuhService $wazuh,
        private ThreatWorkflowService $workflow,
    ) {}

    public function index()
    {
        try {
            $categoryByIp = collect($this->wazuh->getThreats())->keyBy('source');
        } catch (\Throwable $e) {
            $categoryByIp = collect(DemoDataService::fakeThreats())->keyBy('source');
        }

        $blockedIps = $this->workflow->blockedIpStatuses()->map(function ($entry) use ($categoryByIp) {
            $entry['category'] = $categoryByIp->get($entry['ip'])['category'] ?? 'General';

            // Rule 100200 (Nmap Reconnaissance Scan) goes through the agent's
            // iptables active-response script specifically — every other
            // rule still goes through the same firewall-drop Active
            // Response command, just described more generically.
            if ($entry['status'] === 'Blocked') {
                $entry['response_status'] = (string) $entry['rule_id'] === '100200'
                    ? 'Blocked using iptables (firewall-drop)'
                    : 'Firewall-drop Executed';
                $entry['response_duration'] = '60 seconds';
            } else {
                $entry['response_status'] = 'Firewall-drop Reverted';
                $entry['response_duration'] = null;
            }

            return $entry;
        });

        $history = ResponseAction::latest('executed_at')->limit(100)->get();

        return view('pages.response-management', compact('blockedIps', 'history'));
    }

    public function block(Request $request)
    {
        $data = $request->validate([
            'signature' => 'required|string',
            'rule_id' => 'nullable|string',
            'rule' => 'nullable|string',
            'agent' => 'nullable|string',
            'agent_id' => 'nullable|string',
            'source' => 'required|string',
        ]);

        $action = $this->workflow->blockIp($data['signature'], $data);

        return response()->json([
            'status' => $action->status,
            'note' => $action->note,
        ]);
    }

    public function unblock(Request $request)
    {
        $data = $request->validate([
            'signature' => 'required|string',
            'rule_id' => 'nullable|string',
            'rule' => 'nullable|string',
            'agent' => 'nullable|string',
            'source' => 'required|string',
        ]);

        $action = $this->workflow->unblockIp($data['signature'], $data);

        return response()->json([
            'status' => $action->status,
            'note' => $action->note,
        ]);
    }
}
