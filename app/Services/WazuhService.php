<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WazuhService
{
    private function host()
    {
        return rtrim(env('WAZUH_HOST'), '/');
    }

    private function username()
    {
        return env('WAZUH_USERNAME');
    }

    private function password()
    {
        return env('WAZUH_PASSWORD');
    }

    private function verifySsl()
    {
        return filter_var(env('WAZUH_VERIFY_SSL', false), FILTER_VALIDATE_BOOLEAN);
    }

    private function indexerHost()
    {
        return rtrim(env('WAZUH_INDEXER_HOST', $this->host() ? preg_replace('/:\d+$/', ':9200', $this->host()) : ''), '/');
    }

    private function indexerUsername()
    {
        return env('WAZUH_INDEXER_USERNAME');
    }

    private function indexerPassword()
    {
        return env('WAZUH_INDEXER_PASSWORD');
    }

    public function authenticate()
    {
        return Cache::remember('wazuh_token', 900, function () {
            $response = Http::withOptions([
                'verify' => $this->verifySsl(),
                'connect_timeout' => 2,
                'timeout' => 4,
            ])
                ->withBasicAuth($this->username(), $this->password())
                ->post($this->host().'/security/user/authenticate?raw=true');

            if (! $response->successful()) {
                throw new \Exception('Failed to authenticate to Wazuh API: '.$response->body());
            }

            return trim($response->body());
        });
    }

    public function getAgents()
    {
        $token = $this->authenticate();

        $response = Http::withOptions([
            'verify' => $this->verifySsl(),
            'connect_timeout' => 2,
            'timeout' => 4,
        ])
            ->withToken($token)
            ->get($this->host().'/agents', [
                'limit' => 50,
                'select' => 'id,name,ip,status,lastKeepAlive,version,os.platform,os.name',
            ]);

        if (! $response->successful()) {
            throw new \Exception('Failed to fetch agents: '.$response->body());
        }

        return $response->json()['data']['affected_items'] ?? [];
    }

    public function getOverview()
    {
        $agents = $this->getAgents();

        return [
            'total_agents' => count($agents),
            'online_agents' => collect($agents)->where('status', 'active')->count(),
            'offline_agents' => collect($agents)->where('status', 'disconnected')->count(),
        ];
    }

    /**
     * Fetch recent alerts from the Wazuh Indexer (OpenSearch), not the Manager API —
     * the Manager REST API has no general-purpose alert query endpoint.
     */
    public function getThreats(int $size = 200): array
    {
        $response = Http::withOptions([
            'verify' => $this->verifySsl(),
            'connect_timeout' => 2,
            'timeout' => 4,
        ])
            ->withBasicAuth($this->indexerUsername(), $this->indexerPassword())
            ->post($this->indexerHost().'/wazuh-alerts-*/_search', [
                'size' => $size,
                'sort' => [['timestamp' => 'desc']],
            ]);

        if (! $response->successful()) {
            throw new \Exception('Failed to fetch threats from Wazuh Indexer: '.$response->body());
        }

        $hits = $response->json()['hits']['hits'] ?? [];

        return array_map(function ($hit) {
            $source = $hit['_source'] ?? [];
            $rule = $source['rule'] ?? [];
            $timestamp = $source['timestamp'] ?? null;

            return [
                'id' => $hit['_id'] ?? null,
                'rule_id' => $rule['id'] ?? null,
                'rule' => $rule['description'] ?? 'Unknown rule',
                'category' => $rule['groups'][0] ?? 'General',
                'agent' => $source['agent']['name'] ?? 'Unknown agent',
                'agent_id' => $source['agent']['id'] ?? null,
                'source' => $source['data']['srcip'] ?? $source['srcip'] ?? 'N/A',
                'destination' => $source['data']['dstip'] ?? $source['dstip'] ?? null,
                'severity' => $this->severityFromLevel($rule['level'] ?? 0),
                'time' => $timestamp,
                'date' => $timestamp ? substr($timestamp, 0, 10) : null,
                'clock' => $timestamp ? substr($timestamp, 11, 5) : null,
            ];
        }, $hits);
    }

    private function severityFromLevel($level): string
    {
        $level = (int) $level;

        return match (true) {
            $level >= 12 => 'Critical',
            $level >= 7 => 'High',
            $level >= 4 => 'Medium',
            default => 'Low',
        };
    }

    /**
     * Manually trigger a Wazuh Active Response command on a given agent.
     * $command must match a <command> name defined in the agent's ossec.conf.
     */
    public function triggerActiveResponse(string $agentId, string $command, array $arguments = []): array
    {
        try {
            $token = $this->authenticate();

            $response = Http::withOptions([
                'verify' => $this->verifySsl(),
                'connect_timeout' => 2,
                'timeout' => 4,
            ])
                ->withToken($token)
                ->put($this->host().'/active-response?agents_list='.urlencode($agentId), [
                    'command' => '!'.$command,
                    'arguments' => $arguments,
                ]);

            if (! $response->successful()) {
                return ['success' => false, 'message' => 'Wazuh Active Response request failed: '.$response->body()];
            }

            return ['success' => true, 'message' => 'Active Response "'.$command.'" triggered on agent '.$agentId.'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
