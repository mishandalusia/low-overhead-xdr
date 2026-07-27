<?php

namespace App\Services;

class DemoDataService
{
    /**
     * Realistic placeholder threats, shaped exactly like WazuhService::getThreats().
     * Custom XDR Rules:
     * - 100100: Nmap Scan Detected
     * - 100101: Brute Force Attempt Detected (Hydra)
     * - 100102: SQL Injection Attempt Detected (SQLMap)
     * - 100200: Nmap Reconnaissance Activity Detected
     * - 100500: Transaction Behaviour Anomaly Detected
     * - 100600: Repeated Behavioural Anomaly - Temporary User Block
     */
    public static function fakeThreats(): array
    {
        $now = now();

        $rows = [
            ['id' => 'demo-1', 'rule_id' => '100600', 'rule' => 'Repeated Behavioural Anomaly - Temporary User Block', 'category' => 'Behaviour Anomaly', 'agent' => 'app-server-04', 'agent_id' => '004', 'source' => '192.168.1.30', 'destination' => 'N/A', 'level' => 14, 'severity' => 'Critical', 'minutesAgo' => 2, 'user' => 'HEKEL', 'amount' => 500, 'transaction_status' => 'USER_BLOCKED', 'response_action' => 'Temporary User Block'],
            ['id' => 'demo-2', 'rule_id' => '100500', 'rule' => 'Transaction Behaviour Anomaly Detected', 'category' => 'Behaviour Anomaly', 'agent' => 'app-server-04', 'agent_id' => '004', 'source' => '192.168.1.30', 'destination' => 'N/A', 'level' => 12, 'severity' => 'High', 'minutesAgo' => 5, 'user' => 'HEKEL', 'amount' => 450, 'transaction_status' => 'ANOMALY', 'response_action' => 'Alert Logged'],
            ['id' => 'demo-3', 'rule_id' => '100101', 'rule' => 'Brute Force Attempt Detected', 'category' => 'Authentication Attack', 'agent' => 'db-server-02', 'agent_id' => '002', 'source' => '192.168.1.77', 'destination' => '192.168.1.10', 'level' => 12, 'severity' => 'High', 'minutesAgo' => 12, 'user' => 'Hydra', 'response_action' => 'Block IP'],
            ['id' => 'demo-4', 'rule_id' => '100102', 'rule' => 'SQL Injection Attempt Detected', 'category' => 'Web Attack', 'agent' => 'web-server-01', 'agent_id' => '001', 'source' => '172.16.4.12', 'destination' => '192.168.1.20', 'level' => 15, 'severity' => 'Critical', 'minutesAgo' => 18, 'user' => 'SQLMap', 'response_action' => 'Block IP'],
            ['id' => 'demo-5', 'rule_id' => '100100', 'rule' => 'Nmap Scan Detected', 'category' => 'Reconnaissance', 'agent' => 'web-server-01', 'agent_id' => '001', 'source' => '10.67.12.45', 'destination' => '192.168.1.20', 'level' => 10, 'severity' => 'High', 'minutesAgo' => 25, 'user' => 'Nmap', 'response_action' => 'None'],
            ['id' => 'demo-6', 'rule_id' => '100200', 'rule' => 'Nmap Reconnaissance Activity Detected', 'category' => 'Reconnaissance', 'agent' => 'web-server-01', 'agent_id' => '001', 'source' => '10.67.12.45', 'destination' => '192.168.1.20', 'level' => 10, 'severity' => 'High', 'minutesAgo' => 30, 'user' => 'Nmap', 'response_action' => 'None'],
            ['id' => 'demo-7', 'rule_id' => '100500', 'rule' => 'Transaction Behaviour Anomaly Detected', 'category' => 'Behaviour Anomaly', 'agent' => 'app-server-04', 'agent_id' => '004', 'source' => '192.168.1.30', 'destination' => 'N/A', 'level' => 12, 'severity' => 'High', 'minutesAgo' => 45, 'user' => 'NAMIN', 'amount' => 750, 'transaction_status' => 'ANOMALY', 'response_action' => 'Alert Logged'],
            ['id' => 'demo-8', 'rule_id' => '100600', 'rule' => 'Repeated Behavioural Anomaly - Temporary User Block', 'category' => 'Behaviour Anomaly', 'agent' => 'app-server-04', 'agent_id' => '004', 'source' => '192.168.1.30', 'destination' => 'N/A', 'level' => 14, 'severity' => 'Critical', 'minutesAgo' => 55, 'user' => 'BADUSER', 'amount' => 1200, 'transaction_status' => 'USER_BLOCKED', 'response_action' => 'Temporary User Block'],
        ];

        return array_map(function ($row) use ($now) {
            $time = $now->copy()->subMinutes($row['minutesAgo']);

            return [
                'id' => $row['id'],
                'rule_id' => $row['rule_id'],
                'rule' => $row['rule'],
                'level' => $row['level'],
                'category' => $row['category'],
                'agent' => $row['agent'],
                'agent_id' => $row['agent_id'],
                'source' => $row['source'],
                'destination' => $row['destination'],
                'severity' => $row['severity'],
                'time' => $time->toIso8601String(),
                'date' => $time->format('Y-m-d'),
                'clock' => $time->format('H:i'),
                'user' => $row['user'] ?? null,
                'amount' => $row['amount'] ?? null,
                'transaction_status' => $row['transaction_status'] ?? null,
                'response_action' => $row['response_action'] ?? 'None',
            ];
        }, $rows);
    }

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
