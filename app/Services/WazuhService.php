<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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

    public function authenticate()
    {
        return Cache::remember('wazuh_token', 900, function () {
            $response = Http::withOptions([
                'verify' => $this->verifySsl(),
                'timeout' => 15,
            ])
            ->withBasicAuth($this->username(), $this->password())
            ->post($this->host() . '/security/user/authenticate?raw=true');

            if (!$response->successful()) {
                throw new \Exception('Failed to authenticate to Wazuh API: ' . $response->body());
            }

            return trim($response->body());
        });
    }

    public function getAgents()
    {
        $token = $this->authenticate();

        $response = Http::withOptions([
            'verify' => $this->verifySsl(),
            'timeout' => 15,
        ])
        ->withToken($token)
        ->get($this->host() . '/agents', [
            'limit' => 50,
            'select' => 'id,name,ip,status,lastKeepAlive,version',
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch agents: ' . $response->body());
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
}