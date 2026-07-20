<?php

namespace App\Services;

class DemoDataService
{
    /**
     * Realistic placeholder threats, shaped exactly like WazuhService::getThreats().
     * Used only as a fallback when the real Wazuh Indexer is unreachable, so the
     * redesigned UI isn't empty — this stops appearing automatically the moment
     * a real connection succeeds.
     */
    public static function fakeThreats(): array
    {
        $now = now();

        $rows = [
            ['id' => 'demo-1', 'rule_id' => '100200', 'rule' => 'Nmap Reconnaissance Scan', 'category' => 'Reconnaissance', 'agent' => 'web-server-01', 'agent_id' => '001', 'source' => '10.67.12.45', 'destination' => '192.168.1.20', 'severity' => 'High', 'minutesAgo' => 6],
            ['id' => 'demo-2', 'rule_id' => '100500', 'rule' => 'Brute Force Login Attempt', 'category' => 'Authentication Attack', 'agent' => 'db-server-02', 'agent_id' => '002', 'source' => '192.168.1.77', 'destination' => '192.168.1.10', 'severity' => 'Critical', 'minutesAgo' => 18],
            ['id' => 'demo-3', 'rule_id' => '100310', 'rule' => 'Suspicious Outbound Connection', 'category' => 'Malware', 'agent' => 'endpoint-finance-03', 'agent_id' => '003', 'source' => '192.168.1.45', 'destination' => '203.0.113.9', 'severity' => 'Critical', 'minutesAgo' => 34],
            ['id' => 'demo-4', 'rule_id' => '100410', 'rule' => 'SQL Injection Attempt', 'category' => 'Web Attack', 'agent' => 'web-server-01', 'agent_id' => '001', 'source' => '172.16.4.12', 'destination' => '192.168.1.20', 'severity' => 'High', 'minutesAgo' => 52],
            ['id' => 'demo-5', 'rule_id' => '100600', 'rule' => 'Unusual Transaction Behaviour', 'category' => 'Behaviour Anomaly', 'agent' => 'app-server-04', 'agent_id' => '004', 'source' => '192.168.1.30', 'destination' => 'N/A', 'severity' => 'Medium', 'minutesAgo' => 71],
            ['id' => 'demo-6', 'rule_id' => '100210', 'rule' => 'Port Scanning Detected', 'category' => 'Reconnaissance', 'agent' => 'db-server-02', 'agent_id' => '002', 'source' => '10.67.12.46', 'destination' => '192.168.1.10', 'severity' => 'Medium', 'minutesAgo' => 95],
            ['id' => 'demo-7', 'rule_id' => '100510', 'rule' => 'Repeated Failed SSH Logins', 'category' => 'Authentication Attack', 'agent' => 'app-server-04', 'agent_id' => '004', 'source' => '198.51.100.23', 'destination' => '192.168.1.30', 'severity' => 'High', 'minutesAgo' => 128],
            ['id' => 'demo-8', 'rule_id' => '100420', 'rule' => 'Cross-Site Scripting Attempt', 'category' => 'Web Attack', 'agent' => 'web-server-01', 'agent_id' => '001', 'source' => '172.16.4.30', 'destination' => '192.168.1.20', 'severity' => 'Low', 'minutesAgo' => 160],
        ];

        return array_map(function ($row) use ($now) {
            $time = $now->copy()->subMinutes($row['minutesAgo']);

            return [
                'id' => $row['id'],
                'rule_id' => $row['rule_id'],
                'rule' => $row['rule'],
                'category' => $row['category'],
                'agent' => $row['agent'],
                'agent_id' => $row['agent_id'],
                'source' => $row['source'],
                'destination' => $row['destination'],
                'severity' => $row['severity'],
                'time' => $time->toIso8601String(),
                'date' => $time->format('Y-m-d'),
                'clock' => $time->format('H:i'),
            ];
        }, $rows);
    }

    /**
     * Realistic placeholder agents, shaped exactly like WazuhService::getAgents().
     */
    public static function fakeAgents(): array
    {
        $now = now();

        return [
            ['id' => '001', 'name' => 'web-server-01', 'ip' => '192.168.1.20', 'status' => 'active', 'lastKeepAlive' => $now->copy()->subSeconds(20)->toIso8601String(), 'version' => 'Wazuh v4.9.0', 'os' => ['platform' => 'ubuntu', 'name' => 'Ubuntu 22.04.3 LTS']],
            ['id' => '002', 'name' => 'db-server-02', 'ip' => '192.168.1.10', 'status' => 'active', 'lastKeepAlive' => $now->copy()->subSeconds(45)->toIso8601String(), 'version' => 'Wazuh v4.9.0', 'os' => ['platform' => 'ubuntu', 'name' => 'Ubuntu 22.04.3 LTS']],
            ['id' => '003', 'name' => 'endpoint-finance-03', 'ip' => '192.168.1.45', 'status' => 'disconnected', 'lastKeepAlive' => $now->copy()->subHours(3)->toIso8601String(), 'version' => 'Wazuh v4.8.2', 'os' => ['platform' => 'windows', 'name' => 'Windows 11 Pro']],
            ['id' => '004', 'name' => 'app-server-04', 'ip' => '192.168.1.30', 'status' => 'active', 'lastKeepAlive' => $now->copy()->subSeconds(12)->toIso8601String(), 'version' => 'Wazuh v4.9.0', 'os' => ['platform' => 'ubuntu', 'name' => 'Ubuntu 24.04 LTS']],
        ];
    }
}
