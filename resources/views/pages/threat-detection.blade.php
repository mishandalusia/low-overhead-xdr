@extends('layouts.app-dashboard')

@section('content')

<div class="threat-final-page">

    <div class="page-heading">
        <h1>Threat Detection</h1>
        <p>Detected threats from monitored endpoints and suspicious activities.</p>
    </div>

    <div class="threat-summary-grid">
        <div class="threat-summary-card critical">
            <span>Critical Threats</span>
            <h2>8</h2>
            <p>Need immediate attention</p>
        </div>

        <div class="threat-summary-card high">
            <span>High Threats</span>
            <h2>15</h2>
            <p>Potential security risks</p>
        </div>

        <div class="threat-summary-card medium">
            <span>Medium Threats</span>
            <h2>21</h2>
            <p>Require monitoring</p>
        </div>

        <div class="threat-summary-card low">
            <span>Low Threats</span>
            <h2>31</h2>
            <p>Informational activity</p>
        </div>
    </div>

    <div class="threat-panel">
        <div class="panel-header">
            <div>
                <h3>Detected Threat List</h3>
                <p>Threat records detected from Wazuh alerts and behavioral anomaly monitoring.</p>
            </div>
        </div>

        <div class="threat-table-wrapper">
            <table class="threat-table">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th>Threat</th>
                        <th>Source</th>
                        <th>Severity</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>11:20</td>
                        <td>
                            <strong>Nmap Reconnaissance</strong>
                            <small>Network scanning activity detected</small>
                        </td>
                        <td>10.67.xx.xx</td>
                        <td><span class="severity-badge high">High</span></td>
                    </tr>

                    <tr>
                        <td>11:25</td>
                        <td>
                            <strong>Transaction Behaviour Anomaly</strong>
                            <small>Unusual transaction pattern detected</small>
                        </td>
                        <td>User A</td>
                        <td><span class="severity-badge critical">Critical</span></td>
                    </tr>

                    <tr>
                        <td>11:32</td>
                        <td>
                            <strong>Brute Force Login Attempt</strong>
                            <small>Repeated failed login activity</small>
                        </td>
                        <td>192.168.1.20</td>
                        <td><span class="severity-badge medium">Medium</span></td>
                    </tr>

                    <tr>
                        <td>11:40</td>
                        <td>
                            <strong>Malware Communication</strong>
                            <small>Suspicious outbound connection</small>
                        </td>
                        <td>192.168.1.45</td>
                        <td><span class="severity-badge critical">Critical</span></td>
                    </tr>

                    <tr>
                        <td>11:46</td>
                        <td>
                            <strong>SQL Injection Attempt</strong>
                            <small>Suspicious database query pattern</small>
                        </td>
                        <td>172.16.xx.xx</td>
                        <td><span class="severity-badge high">High</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
    .threat-final-page {
        width: 100%;
    }

    .page-heading {
        margin-bottom: 28px;
    }

    .page-heading h1 {
        margin: 0;
        color: #0f172a;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .page-heading p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
        font-weight: 600;
    }

    .threat-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .threat-summary-card {
        position: relative;
        overflow: hidden;
        padding: 24px;
        min-height: 126px;
        border-radius: 24px;
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10);
    }

    .threat-summary-card::before {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        right: -30px;
        top: -32px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.22);
    }

    .threat-summary-card::after {
        content: "";
        position: absolute;
        width: 88px;
        height: 88px;
        right: 28px;
        bottom: -42px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.17);
    }

    .threat-summary-card.critical {
        background: linear-gradient(135deg, #ffffff, #fee2e2);
    }

    .threat-summary-card.high {
        background: linear-gradient(135deg, #ffffff, #ffedd5);
    }

    .threat-summary-card.medium {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .threat-summary-card.low {
        background: linear-gradient(135deg, #ffffff, #dcfce7);
    }

    .threat-summary-card span,
    .threat-summary-card h2,
    .threat-summary-card p {
        position: relative;
        z-index: 2;
    }

    .threat-summary-card span {
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .threat-summary-card h2 {
        margin: 8px 0 4px;
        color: #0f172a;
        font-size: 32px;
        font-weight: 950;
    }

    .threat-summary-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .threat-panel {
        border-radius: 26px;
        padding: 26px;
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
            rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(168, 85, 247, 0.18);
        box-shadow: 0 24px 55px rgba(168, 85, 247, 0.13);
        backdrop-filter: blur(14px);
    }

    .panel-header h3 {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        font-weight: 950;
        letter-spacing: -0.4px;
    }

    .panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 9px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .panel-header p {
        margin: 9px 0 0;
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
    }

    .threat-table-wrapper {
        margin-top: 22px;
        overflow-x: auto;
    }

    .threat-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .threat-table th {
        text-align: left;
        color: #64748b;
        font-size: 13px;
        font-weight: 950;
        padding: 0 18px 4px;
    }

    .threat-table td {
        padding: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border-top: 1px solid rgba(168, 85, 247, 0.16);
        border-bottom: 1px solid rgba(168, 85, 247, 0.16);
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
    }

    .threat-table td:first-child {
        border-left: 1px solid rgba(168, 85, 247, 0.16);
        border-radius: 18px 0 0 18px;
        color: #7c3aed;
        font-weight: 950;
    }

    .threat-table td:last-child {
        border-right: 1px solid rgba(168, 85, 247, 0.16);
        border-radius: 0 18px 18px 0;
    }

    .threat-table strong {
        display: block;
        color: #0f172a;
        font-size: 15px;
        font-weight: 950;
    }

    .threat-table small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .severity-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 92px;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .severity-badge.critical {
        background: #fee2e2;
        color: #dc2626;
    }

    .severity-badge.high {
        background: #ffedd5;
        color: #ea580c;
    }

    .severity-badge.medium {
        background: #fef3c7;
        color: #d97706;
    }

    body.dark-mode .page-heading h1,
    body.dark .page-heading h1,
    body.dark-theme .page-heading h1,
    body.dark-mode .panel-header h3,
    body.dark .panel-header h3,
    body.dark-theme .panel-header h3,
    body.dark-mode .threat-summary-card h2,
    body.dark .threat-summary-card h2,
    body.dark-theme .threat-summary-card h2,
    body.dark-mode .threat-table td,
    body.dark .threat-table td,
    body.dark-theme .threat-table td,
    body.dark-mode .threat-table strong,
    body.dark .threat-table strong,
    body.dark-theme .threat-table strong {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark .page-heading p,
    body.dark-theme .page-heading p,
    body.dark-mode .panel-header p,
    body.dark .panel-header p,
    body.dark-theme .panel-header p,
    body.dark-mode .threat-summary-card span,
    body.dark .threat-summary-card span,
    body.dark-theme .threat-summary-card span,
    body.dark-mode .threat-summary-card p,
    body.dark .threat-summary-card p,
    body.dark-theme .threat-summary-card p,
    body.dark-mode .threat-table small,
    body.dark .threat-table small,
    body.dark-theme .threat-table small,
    body.dark-mode .threat-table th,
    body.dark .threat-table th,
    body.dark-theme .threat-table th {
        color: #94a3b8 !important;
    }

    body.dark-mode .threat-panel,
    body.dark .threat-panel,
    body.dark-theme .threat-panel,
    body.dark-mode .threat-summary-card,
    body.dark .threat-summary-card,
    body.dark-theme .threat-summary-card,
    body.dark-mode .threat-table td,
    body.dark .threat-table td,
    body.dark-theme .threat-table td {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    @media (max-width: 1200px) {
        .threat-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .threat-summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@endsection