<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Security Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #0f172a; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        p.subtitle { color: #64748b; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #e2e8f0; padding: 6px 8px; text-align: left; font-size: 11px; }
        th { background: #f8f3ff; }
        .summary-grid { width: 100%; margin-top: 12px; }
        .summary-grid td { border: none; padding: 6px 12px 6px 0; }
        .section-title { margin-top: 24px; font-size: 14px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Low-Overhead XDR Security Report</h1>
    <p class="subtitle">Generated {{ now()->format('Y-m-d H:i') }}</p>

    <table class="summary-grid">
        <tr>
            <td><strong>Total Activities:</strong> {{ $totalActivities }}</td>
            <td><strong>Blocked IPs:</strong> {{ $blockedIpCount }}</td>
            <td><strong>Critical Alerts:</strong> {{ $criticalCount }}</td>
            <td><strong>Response Success Rate:</strong> {{ $responseSuccessRate }}%</td>
        </tr>
    </table>

    <div class="section-title">Severity Distribution</div>
    <table>
        <tr><th>Severity</th><th>Count</th></tr>
        @foreach ($severity as $level => $count)
            <tr><td>{{ $level }}</td><td>{{ $count }}</td></tr>
        @endforeach
    </table>

    <div class="section-title">Incident Summary</div>
    <table>
        <tr><th>Open</th><th>Investigating</th><th>Resolved</th></tr>
        <tr>
            <td>{{ $incidentSummary['open'] }}</td>
            <td>{{ $incidentSummary['investigating'] }}</td>
            <td>{{ $incidentSummary['resolved'] }}</td>
        </tr>
    </table>

    <div class="section-title">Activity Details</div>
    <table>
        <tr>
            <th>Date</th><th>Time</th><th>Activity</th><th>Source IP</th><th>Category</th><th>Severity</th><th>Status</th>
        </tr>
        @foreach ($dailyRows as $row)
            <tr>
                <td>{{ $row['date'] ?? '-' }}</td>
                <td>{{ $row['clock'] ?? '-' }}</td>
                <td>{{ $row['rule'] ?? '-' }}</td>
                <td>{{ $row['source'] ?? '-' }}</td>
                <td>{{ $row['category'] ?? '-' }}</td>
                <td>{{ $row['severity'] ?? '-' }}</td>
                <td>{{ $row['incident_status'] ?? '-' }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
