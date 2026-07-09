@extends('layouts.app-dashboard')

@section('content')

<div class="dashboard-overview-page">

    <div class="page-heading">
        <h1>Dashboard Overview</h1>
        <p>Overview monitoring for events, alerts, incidents, blocked IPs, and threat severity.</p>
    </div>

    <!-- Summary Cards -->
    <div class="dashboard-stats-grid">
        <div class="dashboard-stat-card purple">
            <div class="stat-icon">EV</div>
            <div>
                <span>Total Events</span>
                <h2>12,482</h2>
                <p>Collected security events</p>
            </div>
        </div>

        <div class="dashboard-stat-card pink">
            <div class="stat-icon">AL</div>
            <div>
                <span>Active Alerts</span>
                <h2>38</h2>
                <p>Alerts need attention</p>
            </div>
        </div>

        <div class="dashboard-stat-card yellow">
            <div class="stat-icon">IP</div>
            <div>
                <span>Blocked IPs</span>
                <h2>84</h2>
                <p>Blocked suspicious sources</p>
            </div>
        </div>

        <div class="dashboard-stat-card blue">
            <div class="stat-icon">IN</div>
            <div>
                <span>Open Incidents</span>
                <h2>14</h2>
                <p>Incidents under handling</p>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Panels -->
    <div class="dashboard-bottom-grid">

        <!-- Top Threat Types -->
        <div class="dashboard-panel">
            <div class="panel-header">
                <div>
                    <h3>Top Threat Types</h3>
                    <p>Most detected threat categories from monitored endpoints.</p>
                </div>
            </div>

            <div class="threat-list">
                <div class="threat-row">
                    <div>
                        <strong>Brute Force Attack</strong>
                        <small>Repeated login attempts</small>
                    </div>

                    <span>34%</span>

                    <div class="threat-progress">
                        <div style="width: 34%;"></div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>SQL Injection</strong>
                        <small>Suspicious database query pattern</small>
                    </div>

                    <span>26%</span>

                    <div class="threat-progress red">
                        <div style="width: 26%;"></div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>Port Scanning</strong>
                        <small>Multiple port probing activity</small>
                    </div>

                    <span>21%</span>

                    <div class="threat-progress orange">
                        <div style="width: 21%;"></div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>Malware Communication</strong>
                        <small>Suspicious outbound connection</small>
                    </div>

                    <span>19%</span>

                    <div class="threat-progress green">
                        <div style="width: 19%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Threat Severity Distribution -->
        <div class="dashboard-panel">
            <div class="panel-header">
                <div>
                    <h3>Threat Severity Distribution</h3>
                    <p>Threat distribution based on severity level.</p>
                </div>
            </div>

            <div class="severity-total">
                <h2>430</h2>
                <p>Total Threats</p>
            </div>

            <div class="severity-list">
                <div class="severity-row">
                    <div>
                        <span class="severity-dot critical"></span>
                        <strong>Critical</strong>
                    </div>
                    <b>90</b>
                </div>

                <div class="severity-row">
                    <div>
                        <span class="severity-dot high"></span>
                        <strong>High</strong>
                    </div>
                    <b>120</b>
                </div>

                <div class="severity-row">
                    <div>
                        <span class="severity-dot medium"></span>
                        <strong>Medium</strong>
                    </div>
                    <b>145</b>
                </div>

                <div class="severity-row">
                    <div>
                        <span class="severity-dot low"></span>
                        <strong>Low</strong>
                    </div>
                    <b>75</b>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Alerts -->
    <div class="dashboard-panel recent-alerts-panel">
        <div class="panel-header">
            <div>
                <h3>Recent Alerts</h3>
                <p>Latest security alerts detected from monitored endpoints.</p>
            </div>
        </div>

        <div class="recent-alert-list">
            <div class="recent-alert-item">
                <div class="alert-time">11:20</div>

                <div class="alert-info">
                    <strong>Nmap Reconnaissance</strong>
                    <small>Suspicious network scanning activity detected</small>
                </div>

                <span class="alert-severity high">High</span>

                <div class="alert-source">10.67.xx.xx</div>
            </div>

            <div class="recent-alert-item">
                <div class="alert-time">11:25</div>

                <div class="alert-info">
                    <strong>Transaction Behaviour Anomaly</strong>
                    <small>Unusual transaction pattern detected</small>
                </div>

                <span class="alert-severity critical">Critical</span>

                <div class="alert-source">User A</div>
            </div>

            <div class="recent-alert-item">
                <div class="alert-time">11:32</div>

                <div class="alert-info">
                    <strong>Brute Force Login Attempt</strong>
                    <small>Repeated failed login attempts</small>
                </div>

                <span class="alert-severity medium">Medium</span>

                <div class="alert-source">192.168.1.20</div>
            </div>
        </div>
    </div>

</div>

<style>
    .dashboard-overview-page {
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

    .dashboard-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .dashboard-stat-card {
        position: relative;
        overflow: hidden;
        min-height: 128px;
        padding: 24px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10);
    }

    .dashboard-stat-card::before {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        right: -28px;
        top: -35px;
        background: rgba(168, 85, 247, 0.25);
    }

    .dashboard-stat-card::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        right: 28px;
        bottom: -44px;
        background: rgba(236, 72, 153, 0.18);
    }

    .dashboard-stat-card.purple {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .dashboard-stat-card.pink {
        background: linear-gradient(135deg, #ffffff, #fce7f3);
    }

    .dashboard-stat-card.yellow {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .dashboard-stat-card.blue {
        background: linear-gradient(135deg, #ffffff, #dbeafe);
    }

    .stat-icon {
        position: relative;
        z-index: 2;
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #8b5cf6;
        background: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 14px 30px rgba(168, 85, 247, 0.14);
    }

    .dashboard-stat-card div {
        position: relative;
        z-index: 2;
    }

    .dashboard-stat-card span {
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .dashboard-stat-card h2 {
        margin: 6px 0 4px;
        color: #0f172a;
        font-size: 30px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .dashboard-stat-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .dashboard-bottom-grid {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 24px;
        align-items: start;
    }

    .dashboard-panel {
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
        font-size: 21px;
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

    .threat-list,
    .severity-list,
    .recent-alert-list {
        display: grid;
        gap: 14px;
        margin-top: 20px;
    }

    .threat-row {
        display: grid;
        grid-template-columns: 1fr 60px 150px;
        align-items: center;
        gap: 18px;
        padding: 18px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
    }

    .threat-row:nth-child(2) {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .threat-row:nth-child(3) {
        background: linear-gradient(135deg, #ffffff, #fff7ed);
    }

    .threat-row:nth-child(4) {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .threat-row strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .threat-row small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .threat-row span {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
        text-align: right;
    }

    .threat-progress {
        height: 9px;
        border-radius: 999px;
        background: #e2e8f0;
        overflow: hidden;
    }

    .threat-progress div {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #d946ef);
    }

    .threat-progress.red div {
        background: linear-gradient(90deg, #ef4444, #ec4899);
    }

    .threat-progress.orange div {
        background: linear-gradient(90deg, #f97316, #f59e0b);
    }

    .threat-progress.green div {
        background: linear-gradient(90deg, #22c55e, #8b5cf6);
    }

    .severity-total {
        margin-top: 20px;
        padding: 30px;
        border-radius: 22px;
        background: linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
        color: #ffffff;
        box-shadow: 0 18px 40px rgba(217, 70, 239, 0.20);
    }

    .severity-total h2 {
        margin: 0;
        font-size: 44px;
        line-height: 1;
        font-weight: 950;
    }

    .severity-total p {
        margin: 10px 0 0;
        color: rgba(255, 255, 255, 0.88);
        font-size: 14px;
        font-weight: 800;
    }

    .severity-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 18px;
        border-radius: 16px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 10px 22px rgba(168, 85, 247, 0.06);
    }

    .severity-row:nth-child(2) {
        background: linear-gradient(135deg, #ffffff, #fff7ed);
    }

    .severity-row:nth-child(3) {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .severity-row:nth-child(4) {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .severity-row div {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .severity-row strong,
    .severity-row b {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .severity-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .severity-dot.critical {
        background: #ef4444;
    }

    .severity-dot.high {
        background: #f97316;
    }

    .severity-dot.medium {
        background: #f59e0b;
    }

    .severity-dot.low {
        background: #22c55e;
    }

    .recent-alerts-panel {
        margin-top: 24px;
        width: 100%;
    }

    .recent-alert-item {
        display: grid;
        grid-template-columns: 90px 1fr 120px 150px;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
        transition: 0.2s ease;
    }

    .recent-alert-item:nth-child(1) {
        background: linear-gradient(135deg, #ffffff, #fff7ed);
    }

    .recent-alert-item:nth-child(2) {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .recent-alert-item:nth-child(3) {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .recent-alert-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
    }

    .alert-time {
        color: #7c3aed;
        font-size: 14px;
        font-weight: 950;
    }

    .alert-info strong {
        display: block;
        color: #0f172a;
        font-size: 15px;
        font-weight: 950;
    }

    .alert-info small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .alert-severity {
        padding: 9px 14px;
        border-radius: 999px;
        text-align: center;
        font-size: 12px;
        font-weight: 950;
    }

    .alert-severity.high {
        background: #ffedd5;
        color: #ea580c;
    }

    .alert-severity.critical {
        background: #fee2e2;
        color: #dc2626;
    }

    .alert-severity.medium {
        background: #fef3c7;
        color: #d97706;
    }

    .alert-source {
        color: #475569;
        font-size: 13px;
        font-weight: 850;
        text-align: right;
    }

    body.dark-mode .page-heading h1,
    body.dark .page-heading h1,
    body.dark-theme .page-heading h1,
    body.dark-mode .panel-header h3,
    body.dark .panel-header h3,
    body.dark-theme .panel-header h3,
    body.dark-mode .dashboard-stat-card h2,
    body.dark .dashboard-stat-card h2,
    body.dark-theme .dashboard-stat-card h2,
    body.dark-mode .threat-row strong,
    body.dark .threat-row strong,
    body.dark-theme .threat-row strong,
    body.dark-mode .threat-row span,
    body.dark .threat-row span,
    body.dark-theme .threat-row span,
    body.dark-mode .severity-row strong,
    body.dark .severity-row strong,
    body.dark-theme .severity-row strong,
    body.dark-mode .severity-row b,
    body.dark .severity-row b,
    body.dark-theme .severity-row b,
    body.dark-mode .alert-info strong,
    body.dark .alert-info strong,
    body.dark-theme .alert-info strong {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark .page-heading p,
    body.dark-theme .page-heading p,
    body.dark-mode .panel-header p,
    body.dark .panel-header p,
    body.dark-theme .panel-header p,
    body.dark-mode .dashboard-stat-card span,
    body.dark .dashboard-stat-card span,
    body.dark-theme .dashboard-stat-card span,
    body.dark-mode .dashboard-stat-card p,
    body.dark .dashboard-stat-card p,
    body.dark-theme .dashboard-stat-card p,
    body.dark-mode .threat-row small,
    body.dark .threat-row small,
    body.dark-theme .threat-row small,
    body.dark-mode .alert-info small,
    body.dark .alert-info small,
    body.dark-theme .alert-info small,
    body.dark-mode .alert-source,
    body.dark .alert-source,
    body.dark-theme .alert-source {
        color: #94a3b8 !important;
    }

    body.dark-mode .dashboard-panel,
    body.dark .dashboard-panel,
    body.dark-theme .dashboard-panel,
    body.dark-mode .dashboard-stat-card,
    body.dark .dashboard-stat-card,
    body.dark-theme .dashboard-stat-card,
    body.dark-mode .threat-row,
    body.dark .threat-row,
    body.dark-theme .threat-row,
    body.dark-mode .severity-row,
    body.dark .severity-row,
    body.dark-theme .severity-row,
    body.dark-mode .recent-alert-item,
    body.dark .recent-alert-item,
    body.dark-theme .recent-alert-item {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    @media (max-width: 1200px) {
        .dashboard-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-bottom-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-stats-grid {
            grid-template-columns: 1fr;
        }

        .recent-alert-item,
        .threat-row {
            grid-template-columns: 1fr;
            align-items: flex-start;
        }

        .threat-row span,
        .alert-source {
            text-align: left;
        }
    }
</style>

@endsection