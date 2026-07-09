@extends('layouts.app-dashboard')

@section('content')
<div class="dashboard-overview-page" id="dashboardReport">

    <div class="dashboard-header">
        <div>
            <h1>Dashboard Overview</h1>
            <p>Overview monitoring for events, alerts, incidents, blocked IPs, and threat severity.</p>
        </div>
    </div>

    <div class="dashboard-stats-grid">

        <div class="dashboard-stat-card">
            <div class="stat-icon purple">EV</div>
            <div>
                <p>Total Events</p>
                <h2>12,482</h2>
                <span>Collected security events</span>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-icon red">AL</div>
            <div>
                <p>Active Alerts</p>
                <h2>38</h2>
                <span>Alerts need attention</span>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-icon orange">IP</div>
            <div>
                <p>Blocked IPs</p>
                <h2>84</h2>
                <span>Blocked suspicious sources</span>
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="stat-icon blue">IN</div>
            <div>
                <p>Open Incidents</p>
                <h2>14</h2>
                <span>Incidents under handling</span>
            </div>
        </div>

    </div>

    <div class="dashboard-content-grid">

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
                        <span>Repeated login attempts</span>
                    </div>
                    <div class="threat-progress">
                        <b>34%</b>
                        <div class="progress-track">
                            <div class="progress-fill purple" style="width: 34%;"></div>
                        </div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>SQL Injection</strong>
                        <span>Suspicious database query pattern</span>
                    </div>
                    <div class="threat-progress">
                        <b>26%</b>
                        <div class="progress-track">
                            <div class="progress-fill red" style="width: 26%;"></div>
                        </div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>Port Scanning</strong>
                        <span>Multiple port probing activity</span>
                    </div>
                    <div class="threat-progress">
                        <b>21%</b>
                        <div class="progress-track">
                            <div class="progress-fill orange" style="width: 21%;"></div>
                        </div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>Malware Communication</strong>
                        <span>Suspicious outbound connection</span>
                    </div>
                    <div class="threat-progress">
                        <b>19%</b>
                        <div class="progress-track">
                            <div class="progress-fill green" style="width: 19%;"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="dashboard-panel">
            <div class="panel-header">
                <div>
                    <h3>Threat Severity Distribution</h3>
                    <p>Threat distribution based on severity level.</p>
                </div>
            </div>

            <div class="severity-box">

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

    </div>

</div>

<style>
    .dashboard-overview-page {
        width: 100%;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 26px;
    }

    .dashboard-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #111827;
    }

    .dashboard-header p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .export-btn {
        border: none;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        color: #ffffff;
        padding: 13px 18px;
        border-radius: 15px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 12px 26px rgba(139, 92, 246, 0.25);
        white-space: nowrap;
    }

    .dashboard-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .dashboard-stat-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 22px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .stat-icon.purple {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .stat-icon.red {
        background: #fee2e2;
        color: #dc2626;
    }

    .stat-icon.orange {
        background: #ffedd5;
        color: #ea580c;
    }

    .stat-icon.blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .dashboard-stat-card p {
        margin: 0 0 8px;
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
    }

    .dashboard-stat-card h2 {
        margin: 0;
        color: #0f172a;
        font-size: 30px;
        font-weight: 800;
    }

    .dashboard-stat-card span {
        display: block;
        margin-top: 7px;
        color: #64748b;
        font-size: 13px;
    }

    .dashboard-content-grid {
        display: grid;
        grid-template-columns: 1.3fr 0.9fr;
        gap: 22px;
    }

    .dashboard-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
    }

    .panel-header {
        margin-bottom: 20px;
    }

    .panel-header h3 {
        margin: 0;
        color: #0f172a;
        font-size: 20px;
        font-weight: 800;
    }

    .panel-header p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .threat-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .threat-row {
        border: 1px solid #eef2f7;
        border-radius: 17px;
        padding: 17px;
        background: #fbfdff;
        display: grid;
        grid-template-columns: 1fr 180px;
        gap: 18px;
        align-items: center;
    }

    .threat-row strong {
        display: block;
        color: #0f172a;
        font-size: 15px;
        font-weight: 800;
    }

    .threat-row span {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 13px;
    }

    .threat-progress {
        display: grid;
        grid-template-columns: 45px 1fr;
        gap: 10px;
        align-items: center;
    }

    .threat-progress b {
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
    }

    .progress-track {
        height: 9px;
        background: #e5e7eb;
        border-radius: 999px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 999px;
    }

    .progress-fill.purple {
        background: linear-gradient(90deg, #8b5cf6, #d946ef);
    }

    .progress-fill.red {
        background: linear-gradient(90deg, #ef4444, #f97316);
    }

    .progress-fill.orange {
        background: linear-gradient(90deg, #f59e0b, #f97316);
    }

    .progress-fill.green {
        background: linear-gradient(90deg, #22c55e, #10b981);
    }

    .severity-box {
        display: grid;
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .severity-total {
        border-radius: 18px;
        padding: 24px;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        color: #ffffff;
    }

    .severity-total h2 {
        margin: 0;
        font-size: 38px;
        font-weight: 800;
    }

    .severity-total p {
        margin: 7px 0 0;
        font-size: 14px;
        opacity: 0.9;
    }

    .severity-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .severity-row {
        border: 1px solid #eef2f7;
        border-radius: 15px;
        padding: 15px;
        background: #fbfdff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .severity-row div {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .severity-row strong,
    .severity-row b {
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
    }

    .severity-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        display: inline-block;
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

    body.dark-mode .dashboard-header h1,
    body.dark .dashboard-header h1,
    body.dark-theme .dashboard-header h1,
    body.dark-mode .dashboard-stat-card h2,
    body.dark .dashboard-stat-card h2,
    body.dark-theme .dashboard-stat-card h2,
    body.dark-mode .panel-header h3,
    body.dark .panel-header h3,
    body.dark-theme .panel-header h3,
    body.dark-mode .threat-row strong,
    body.dark .threat-row strong,
    body.dark-theme .threat-row strong,
    body.dark-mode .threat-progress b,
    body.dark .threat-progress b,
    body.dark-theme .threat-progress b,
    body.dark-mode .severity-row strong,
    body.dark .severity-row strong,
    body.dark-theme .severity-row strong,
    body.dark-mode .severity-row b,
    body.dark .severity-row b,
    body.dark-theme .severity-row b {
        color: #f8fafc !important;
    }

    body.dark-mode .dashboard-header p,
    body.dark .dashboard-header p,
    body.dark-theme .dashboard-header p,
    body.dark-mode .dashboard-stat-card p,
    body.dark .dashboard-stat-card p,
    body.dark-theme .dashboard-stat-card p,
    body.dark-mode .dashboard-stat-card span,
    body.dark .dashboard-stat-card span,
    body.dark-theme .dashboard-stat-card span,
    body.dark-mode .panel-header p,
    body.dark .panel-header p,
    body.dark-theme .panel-header p,
    body.dark-mode .threat-row span,
    body.dark .threat-row span,
    body.dark-theme .threat-row span {
        color: #94a3b8 !important;
    }

    body.dark-mode .dashboard-stat-card,
    body.dark .dashboard-stat-card,
    body.dark-theme .dashboard-stat-card,
    body.dark-mode .dashboard-panel,
    body.dark .dashboard-panel,
    body.dark-theme .dashboard-panel {
        background: #111827 !important;
        border-color: #243044 !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28) !important;
    }

    body.dark-mode .threat-row,
    body.dark .threat-row,
    body.dark-theme .threat-row,
    body.dark-mode .severity-row,
    body.dark .severity-row,
    body.dark-theme .severity-row {
        background: #162033 !important;
        border-color: #243044 !important;
    }

    body.dark-mode .progress-track,
    body.dark .progress-track,
    body.dark-theme .progress-track {
        background: #263247 !important;
    }

    @media (max-width: 1200px) {
        .dashboard-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .export-btn {
            width: 100%;
        }

        .dashboard-stats-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-stat-card,
        .dashboard-panel {
            padding: 20px;
        }

        .threat-row {
            grid-template-columns: 1fr;
        }
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #dashboardReport,
        #dashboardReport * {
            visibility: visible;
        }

        #dashboardReport {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: #ffffff !important;
            color: #111827 !important;
        }

        .export-btn {
            display: none !important;
        }
    }
    /* ================================================= */
/* Dashboard Overview - Pink Purple Theme */
/* Paste paling bawah CSS dashboard.blade.php */
/* ================================================= */

.dashboard-overview-page {
    padding: 4px;
}

/* Background dashboard soft pink ungu */
.main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.20), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 35%),
        linear-gradient(135deg, #f8f3ff 0%, #fde7f7 48%, #f3e8ff 100%) !important;
}

/* Header */
.dashboard-header h1 {
    color: #0f172a !important;
}

.dashboard-header p {
    color: #64748b !important;
}

/* Export PDF button */
.export-btn {
    background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 16px 36px rgba(168, 85, 247, 0.28) !important;
}

.export-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 42px rgba(168, 85, 247, 0.34) !important;
}

/* Top dashboard cards */
.dashboard-stats-grid .dashboard-stat-card {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 22px 45px rgba(168, 85, 247, 0.14) !important;
}

.dashboard-stats-grid .dashboard-stat-card::before {
    content: "";
    position: absolute;
    width: 130px;
    height: 130px;
    right: -48px;
    top: -52px;
    border-radius: 50%;
    opacity: 0.32;
}

.dashboard-stats-grid .dashboard-stat-card::after {
    content: "";
    position: absolute;
    width: 88px;
    height: 88px;
    right: 24px;
    bottom: -45px;
    border-radius: 50%;
    opacity: 0.20;
}

.dashboard-stats-grid .dashboard-stat-card > * {
    position: relative;
    z-index: 2;
}

/* Total Events */
.dashboard-stats-grid .dashboard-stat-card:nth-child(1) {
    background: linear-gradient(135deg, #ffffff 0%, #f3e8ff 55%, #fae8ff 100%) !important;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(1)::before {
    background: #8b5cf6;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(1)::after {
    background: #d946ef;
}

/* Active Alerts */
.dashboard-stats-grid .dashboard-stat-card:nth-child(2) {
    background: linear-gradient(135deg, #ffffff 0%, #ffe4f3 50%, #fce7f3 100%) !important;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(2)::before {
    background: #ec4899;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(2)::after {
    background: #fb7185;
}

/* Blocked IPs */
.dashboard-stats-grid .dashboard-stat-card:nth-child(3) {
    background: linear-gradient(135deg, #ffffff 0%, #fef3c7 45%, #fae8ff 100%) !important;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(3)::before {
    background: #f97316;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(3)::after {
    background: #d946ef;
}

/* Open Incidents */
.dashboard-stats-grid .dashboard-stat-card:nth-child(4) {
    background: linear-gradient(135deg, #ffffff 0%, #dbeafe 45%, #f3e8ff 100%) !important;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(4)::before {
    background: #3b82f6;
}

.dashboard-stats-grid .dashboard-stat-card:nth-child(4)::after {
    background: #8b5cf6;
}

/* Icon card */
.dashboard-stats-grid .stat-icon {
    background: rgba(255, 255, 255, 0.72) !important;
    color: #8b5cf6 !important;
    box-shadow: 0 12px 25px rgba(168, 85, 247, 0.18);
}

/* Text card */
.dashboard-stat-card p {
    color: #64748b !important;
}

.dashboard-stat-card h2 {
    color: #0f172a !important;
}

.dashboard-stat-card span {
    color: #64748b !important;
}

/* Main panels */
.dashboard-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.88) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
    backdrop-filter: blur(14px);
}

/* Panel title accent */
.panel-header h3 {
    color: #0f172a !important;
}

.panel-header h3::after {
    content: "";
    display: block;
    width: 52px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

.panel-header p {
    color: #64748b !important;
}

/* Top Threat Types rows */
.threat-row {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 35%),
        linear-gradient(135deg, rgba(255,255,255,0.96), rgba(250,232,255,0.74)) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.threat-row:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.threat-row:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.threat-row:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.threat-row:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #ede9fe) !important;
}

.threat-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
}

.threat-row strong,
.threat-progress b {
    color: #0f172a !important;
}

.threat-row span {
    color: #64748b !important;
}

/* Progress bars */
.progress-track {
    background: rgba(203, 213, 225, 0.55) !important;
}

.progress-fill.purple {
    background: linear-gradient(90deg, #8b5cf6, #d946ef) !important;
}

.progress-fill.red {
    background: linear-gradient(90deg, #ef4444, #ec4899) !important;
}

.progress-fill.orange {
    background: linear-gradient(90deg, #f59e0b, #ec4899) !important;
}

.progress-fill.green {
    background: linear-gradient(90deg, #22c55e, #8b5cf6) !important;
}

/* Severity total box */
.severity-total {
    background:
        radial-gradient(circle at top right, rgba(255,255,255,0.24), transparent 35%),
        linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
    box-shadow: 0 18px 38px rgba(168, 85, 247, 0.22);
}

/* Severity rows */
.severity-row {
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
}

.severity-row:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.severity-row:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.severity-row:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.severity-row:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.severity-row strong,
.severity-row b {
    color: #0f172a !important;
}

/* Dark mode */
body.dark-mode .main,
body.dark .main,
body.dark-theme .main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.18), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 35%),
        linear-gradient(135deg, #0f172a 0%, #1e1b4b 48%, #3b123c 100%) !important;
}

body.dark-mode .dashboard-stats-grid .dashboard-stat-card,
body.dark .dashboard-stats-grid .dashboard-stat-card,
body.dark-theme .dashboard-stats-grid .dashboard-stat-card,
body.dark-mode .dashboard-panel,
body.dark .dashboard-panel,
body.dark-theme .dashboard-panel {
    background: linear-gradient(135deg, #111827 0%, #2e174f 100%) !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .threat-row,
body.dark .threat-row,
body.dark-theme .threat-row,
body.dark-mode .severity-row,
body.dark .severity-row,
body.dark-theme .severity-row {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .dashboard-header h1,
body.dark .dashboard-header h1,
body.dark-theme .dashboard-header h1,
body.dark-mode .dashboard-stat-card h2,
body.dark .dashboard-stat-card h2,
body.dark-theme .dashboard-stat-card h2,
body.dark-mode .panel-header h3,
body.dark .panel-header h3,
body.dark-theme .panel-header h3,
body.dark-mode .threat-row strong,
body.dark .threat-row strong,
body.dark-theme .threat-row strong,
body.dark-mode .threat-progress b,
body.dark .threat-progress b,
body.dark-theme .threat-progress b,
body.dark-mode .severity-row strong,
body.dark .severity-row strong,
body.dark-theme .severity-row strong,
body.dark-mode .severity-row b,
body.dark .severity-row b,
body.dark-theme .severity-row b {
    color: #f8fafc !important;
}

body.dark-mode .dashboard-header p,
body.dark .dashboard-header p,
body.dark-theme .dashboard-header p,
body.dark-mode .dashboard-stat-card p,
body.dark .dashboard-stat-card p,
body.dark-theme .dashboard-stat-card p,
body.dark-mode .dashboard-stat-card span,
body.dark .dashboard-stat-card span,
body.dark-theme .dashboard-stat-card span,
body.dark-mode .panel-header p,
body.dark .panel-header p,
body.dark-theme .panel-header p,
body.dark-mode .threat-row span,
body.dark .threat-row span,
body.dark-theme .threat-row span {
    color: #94a3b8 !important;
}
</style>
@endsection