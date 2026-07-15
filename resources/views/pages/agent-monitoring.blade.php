@extends('layouts.app-dashboard')

@section('content')

<div class="agp-page" id="agentMonitoringPage">

    <div class="agp-heading">
        <h1>Agent Monitoring</h1>
        <p>Monitor connected agents, endpoint status, last activity, and health condition.</p>
    </div>

    <div class="agp-summary-grid">
        <div class="agp-summary-card">
            <div class="agp-summary-icon">ON</div>
            <div>
                <span>Online Agents</span>
                <h2>3</h2>
                <p>Currently connected</p>
            </div>
        </div>

        <div class="agp-summary-card">
            <div class="agp-summary-icon">OFF</div>
            <div>
                <span>Offline Agents</span>
                <h2>1</h2>
                <p>Need attention</p>
            </div>
        </div>

        <div class="agp-summary-card">
            <div class="agp-summary-icon">AG</div>
            <div>
                <span>Total Agents</span>
                <h2>4</h2>
                <p>Registered endpoints</p>
            </div>
        </div>

        <div class="agp-summary-card">
            <div class="agp-summary-icon">HL</div>
            <div>
                <span>Average Health</span>
                <h2>87%</h2>
                <p>Endpoint condition</p>
            </div>
        </div>
    </div>

    <div class="agp-content-grid">

        <div class="agp-panel">
            <div class="agp-panel-header">
                <h3>Connected Agents</h3>
                <p>List of endpoints connected to the LOX monitoring system.</p>
            </div>

            <div class="agp-agent-list">

                <div class="agp-agent-row green">
                    <div class="agp-agent-name">
                        <div class="agp-avatar green">RV</div>
                        <div>
                            <strong>rizki-VirtualBox</strong>
                            <span>Ubuntu Endpoint</span>
                        </div>
                    </div>

                    <div class="agp-cell">
                        <small>Status</small>
                        <b class="agp-status online">Online</b>
                    </div>

                    <div class="agp-cell">
                        <small>Last Seen</small>
                        <strong>11:30</strong>
                    </div>

                    <div class="agp-cell">
                        <small>IP Address</small>
                        <strong>192.168.56.101</strong>
                    </div>

                    <div class="agp-health-cell">
                        <small>Agent Health</small>
                        <div class="agp-progress-row">
                            <span>96%</span>
                            <div class="agp-progress">
                                <i style="width: 96%;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="agp-agent-row red">
                    <div class="agp-agent-name">
                        <div class="agp-avatar red">KL</div>
                        <div>
                            <strong>kali-linux</strong>
                            <span>Attack Simulation Client</span>
                        </div>
                    </div>

                    <div class="agp-cell">
                        <small>Status</small>
                        <b class="agp-status offline">Offline</b>
                    </div>

                    <div class="agp-cell">
                        <small>Last Seen</small>
                        <strong>-</strong>
                    </div>

                    <div class="agp-cell">
                        <small>IP Address</small>
                        <strong>192.168.56.110</strong>
                    </div>

                    <div class="agp-health-cell">
                        <small>Agent Health</small>
                        <div class="agp-progress-row">
                            <span>0%</span>
                            <div class="agp-progress empty">
                                <i style="width: 0%;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="agp-agent-row blue">
                    <div class="agp-agent-name">
                        <div class="agp-avatar blue">WS</div>
                        <div>
                            <strong>web-server</strong>
                            <span>Application Server</span>
                        </div>
                    </div>

                    <div class="agp-cell">
                        <small>Status</small>
                        <b class="agp-status online">Online</b>
                    </div>

                    <div class="agp-cell">
                        <small>Last Seen</small>
                        <strong>11:28</strong>
                    </div>

                    <div class="agp-cell">
                        <small>IP Address</small>
                        <strong>192.168.1.20</strong>
                    </div>

                    <div class="agp-health-cell">
                        <small>Agent Health</small>
                        <div class="agp-progress-row">
                            <span>89%</span>
                            <div class="agp-progress">
                                <i style="width: 89%;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="agp-agent-row yellow">
                    <div class="agp-agent-name">
                        <div class="agp-avatar yellow">DB</div>
                        <div>
                            <strong>database-server</strong>
                            <span>Database Node</span>
                        </div>
                    </div>

                    <div class="agp-cell">
                        <small>Status</small>
                        <b class="agp-status online">Online</b>
                    </div>

                    <div class="agp-cell">
                        <small>Last Seen</small>
                        <strong>11:25</strong>
                    </div>

                    <div class="agp-cell">
                        <small>IP Address</small>
                        <strong>192.168.1.45</strong>
                    </div>

                    <div class="agp-health-cell">
                        <small>Agent Health</small>
                        <div class="agp-progress-row">
                            <span>82%</span>
                            <div class="agp-progress warning">
                                <i style="width: 82%;"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="agp-panel agp-health-panel">
            <div class="agp-panel-header">
                <h3>Agent Health</h3>
                <p>Endpoint condition based on connection status and activity.</p>
            </div>

            <div class="agp-health-list">
                <div class="agp-health-card">
                    <div>
                        <strong>rizki-VirtualBox</strong>
                        <span>Stable connection</span>
                    </div>
                    <b class="good">96%</b>
                </div>

                <div class="agp-health-card">
                    <div>
                        <strong>web-server</strong>
                        <span>Normal activity</span>
                    </div>
                    <b class="good">89%</b>
                </div>

                <div class="agp-health-card">
                    <div>
                        <strong>database-server</strong>
                        <span>Minor delay detected</span>
                    </div>
                    <b class="warning">82%</b>
                </div>

                <div class="agp-health-card">
                    <div>
                        <strong>kali-linux</strong>
                        <span>No recent communication</span>
                    </div>
                    <b class="danger">0%</b>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    .agp-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .agp-heading {
        margin-bottom: 26px;
    }

    .agp-heading h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
        color: #0f172a !important;
    }

    .agp-heading p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .agp-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .agp-summary-card {
        position: relative;
        overflow: hidden;
        min-height: 128px;
        padding: 24px;
        border-radius: 26px;
        display: flex;
        align-items: center;
        gap: 18px;
        background:
            radial-gradient(circle at top right, rgba(168, 85, 247, 0.20), transparent 36%),
            radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.16), transparent 36%),
            linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10) !important;
    }

    .agp-summary-card::before {
        content: "";
        position: absolute;
        width: 135px;
        height: 135px;
        right: -45px;
        top: -48px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.18);
    }

    .agp-summary-card::after {
        content: "";
        position: absolute;
        width: 95px;
        height: 95px;
        right: 28px;
        bottom: -44px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.15);
    }

    .agp-summary-card > * {
        position: relative;
        z-index: 2;
    }

    .agp-summary-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #ffffff !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        color: #7c3aed !important;
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 14px 30px rgba(168, 85, 247, 0.14);
    }

    .agp-summary-card span {
        color: #64748b !important;
        font-size: 13px;
        font-weight: 900;
    }

    .agp-summary-card h2 {
        margin: 7px 0 4px;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .agp-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .agp-content-grid {
        display: grid;
        grid-template-columns: 1.65fr 0.9fr;
        gap: 24px;
        align-items: start;
    }

    .agp-panel {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        padding: 26px;
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
            rgba(255, 255, 255, 0.92) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 24px 55px rgba(168, 85, 247, 0.13) !important;
    }

    .agp-panel::before {
        content: "🖥️";
        position: absolute;
        right: 28px;
        top: 18px;
        font-size: 58px;
        opacity: 0.08;
        pointer-events: none;
    }

    .agp-health-panel::before {
        content: "🛡️";
    }

    .agp-panel-header {
        position: relative;
        z-index: 2;
        margin-bottom: 24px;
    }

    .agp-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 22px;
        font-weight: 950;
        letter-spacing: -0.4px;
    }

    .agp-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .agp-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .agp-agent-list {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 14px;
    }

    .agp-agent-row {
        display: grid;
        grid-template-columns: 1.55fr 0.8fr 0.65fr 0.9fr 1.25fr;
        align-items: center;
        gap: 18px;
        min-height: 78px;
        padding: 18px 20px;
        border-radius: 20px;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .agp-agent-row.green {
        background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
    }

    .agp-agent-row.red {
        background: linear-gradient(135deg, #ffffff, #fee2e2) !important;
    }

    .agp-agent-row.blue {
        background: linear-gradient(135deg, #ffffff, #dbeafe) !important;
    }

    .agp-agent-row.yellow {
        background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
    }

    .agp-agent-name {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .agp-avatar {
        width: 46px;
        height: 46px;
        border-radius: 15px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff !important;
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.10);
    }

    .agp-avatar.green { color: #16a34a !important; }
    .agp-avatar.red { color: #dc2626 !important; }
    .agp-avatar.blue { color: #2563eb !important; }
    .agp-avatar.yellow { color: #d97706 !important; }

    .agp-agent-name strong,
    .agp-cell strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .agp-agent-name span,
    .agp-cell small,
    .agp-health-cell small {
        display: block;
        margin-bottom: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .agp-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 84px;
        padding: 9px 15px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .agp-status.online {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .agp-status.offline {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .agp-progress-row {
        display: grid;
        grid-template-columns: 45px 1fr;
        align-items: center;
        gap: 12px;
        margin-top: 6px;
    }

    .agp-progress-row span {
        color: #0f172a !important;
        font-size: 13px;
        font-weight: 950;
    }

    .agp-progress {
        height: 9px;
        border-radius: 999px;
        overflow: hidden;
        background: #e2e8f0 !important;
    }

    .agp-progress i {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #22c55e, #8b5cf6) !important;
    }

    .agp-progress.warning i {
        background: linear-gradient(90deg, #f59e0b, #ec4899) !important;
    }

    .agp-health-list {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 14px;
    }

    .agp-health-card {
        min-height: 72px;
        padding: 18px 20px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        background: linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .agp-health-card strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .agp-health-card span {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .agp-health-card b {
        min-width: 62px;
        padding: 10px 14px;
        border-radius: 999px;
        text-align: center;
        font-size: 13px;
        font-weight: 950;
    }

    .agp-health-card b.good {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .agp-health-card b.warning {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .agp-health-card b.danger {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    /* =============================== */
    /* DARK MODE AUTO SUPPORT */
    /* =============================== */

    body.dark-mode .agp-heading h1,
    body.dark .agp-heading h1,
    body.dark-theme .agp-heading h1,
    .agp-page.agp-dark .agp-heading h1 {
        color: #ffffff !important;
        text-shadow: 0 5px 18px rgba(15, 23, 42, 0.35);
    }

    body.dark-mode .agp-heading p,
    body.dark .agp-heading p,
    body.dark-theme .agp-heading p,
    .agp-page.agp-dark .agp-heading p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .agp-summary-card,
    body.dark .agp-summary-card,
    body.dark-theme .agp-summary-card,
    .agp-page.agp-dark .agp-summary-card {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.14), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .agp-panel,
    body.dark .agp-panel,
    body.dark-theme .agp-panel,
    .agp-page.agp-dark .agp-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .agp-summary-icon,
    body.dark .agp-summary-icon,
    body.dark-theme .agp-summary-icon,
    .agp-page.agp-dark .agp-summary-icon {
        background: rgba(15, 23, 42, 0.92) !important;
        border-color: rgba(168, 85, 247, 0.36) !important;
        color: #a855f7 !important;
    }

    body.dark-mode .agp-summary-card span,
    body.dark .agp-summary-card span,
    body.dark-theme .agp-summary-card span,
    body.dark-mode .agp-summary-card p,
    body.dark .agp-summary-card p,
    body.dark-theme .agp-summary-card p,
    body.dark-mode .agp-panel-header p,
    body.dark .agp-panel-header p,
    body.dark-theme .agp-panel-header p,
    .agp-page.agp-dark .agp-summary-card span,
    .agp-page.agp-dark .agp-summary-card p,
    .agp-page.agp-dark .agp-panel-header p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .agp-summary-card h2,
    body.dark .agp-summary-card h2,
    body.dark-theme .agp-summary-card h2,
    body.dark-mode .agp-panel-header h3,
    body.dark .agp-panel-header h3,
    body.dark-theme .agp-panel-header h3,
    .agp-page.agp-dark .agp-summary-card h2,
    .agp-page.agp-dark .agp-panel-header h3 {
        color: #ffffff !important;
    }

    body.dark-mode .agp-agent-row.green,
    body.dark .agp-agent-row.green,
    body.dark-theme .agp-agent-row.green,
    .agp-page.agp-dark .agp-agent-row.green {
        background: linear-gradient(135deg, #111827, #2e1a26) !important;
    }

    body.dark-mode .agp-agent-row.red,
    body.dark .agp-agent-row.red,
    body.dark-theme .agp-agent-row.red,
    .agp-page.agp-dark .agp-agent-row.red {
        background: linear-gradient(135deg, #111827, #25163d) !important;
    }

    body.dark-mode .agp-agent-row.blue,
    body.dark .agp-agent-row.blue,
    body.dark-theme .agp-agent-row.blue,
    .agp-page.agp-dark .agp-agent-row.blue {
        background: linear-gradient(135deg, #111827, #172554) !important;
    }

    body.dark-mode .agp-agent-row.yellow,
    body.dark .agp-agent-row.yellow,
    body.dark-theme .agp-agent-row.yellow,
    .agp-page.agp-dark .agp-agent-row.yellow {
        background: linear-gradient(135deg, #111827, #3b1a2c) !important;
    }

    body.dark-mode .agp-agent-row,
    body.dark .agp-agent-row,
    body.dark-theme .agp-agent-row,
    body.dark-mode .agp-health-card,
    body.dark .agp-health-card,
    body.dark-theme .agp-health-card,
    .agp-page.agp-dark .agp-agent-row,
    .agp-page.agp-dark .agp-health-card {
        border-color: rgba(168, 85, 247, 0.27) !important;
        color: #ffffff !important;
    }

    body.dark-mode .agp-health-card,
    body.dark .agp-health-card,
    body.dark-theme .agp-health-card,
    .agp-page.agp-dark .agp-health-card {
        background: linear-gradient(135deg, #111827, #241638) !important;
    }

    body.dark-mode .agp-agent-name strong,
    body.dark .agp-agent-name strong,
    body.dark-theme .agp-agent-name strong,
    body.dark-mode .agp-cell strong,
    body.dark .agp-cell strong,
    body.dark-theme .agp-cell strong,
    body.dark-mode .agp-health-card strong,
    body.dark .agp-health-card strong,
    body.dark-theme .agp-health-card strong,
    body.dark-mode .agp-progress-row span,
    body.dark .agp-progress-row span,
    body.dark-theme .agp-progress-row span,
    .agp-page.agp-dark .agp-agent-name strong,
    .agp-page.agp-dark .agp-cell strong,
    .agp-page.agp-dark .agp-health-card strong,
    .agp-page.agp-dark .agp-progress-row span {
        color: #ffffff !important;
    }

    body.dark-mode .agp-agent-name span,
    body.dark .agp-agent-name span,
    body.dark-theme .agp-agent-name span,
    body.dark-mode .agp-cell small,
    body.dark .agp-cell small,
    body.dark-theme .agp-cell small,
    body.dark-mode .agp-health-cell small,
    body.dark .agp-health-cell small,
    body.dark-theme .agp-health-cell small,
    body.dark-mode .agp-health-card span,
    body.dark .agp-health-card span,
    body.dark-theme .agp-health-card span,
    .agp-page.agp-dark .agp-agent-name span,
    .agp-page.agp-dark .agp-cell small,
    .agp-page.agp-dark .agp-health-cell small,
    .agp-page.agp-dark .agp-health-card span {
        color: #cbd5e1 !important;
    }

    body.dark-mode .agp-progress,
    body.dark .agp-progress,
    body.dark-theme .agp-progress,
    .agp-page.agp-dark .agp-progress {
        background: #334155 !important;
    }

    @media (max-width: 1200px) {
        .agp-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .agp-content-grid {
            grid-template-columns: 1fr;
        }

        .agp-agent-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .agp-summary-grid,
        .agp-agent-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('agentMonitoringPage');

        function isDarkTheme() {
            return document.body.classList.contains('dark-mode') ||
                   document.body.classList.contains('dark') ||
                   document.body.classList.contains('dark-theme') ||
                   document.documentElement.classList.contains('dark-mode') ||
                   document.documentElement.classList.contains('dark') ||
                   document.documentElement.classList.contains('dark-theme') ||
                   localStorage.getItem('lox_theme') === 'dark' ||
                   localStorage.getItem('theme') === 'dark' ||
                   localStorage.getItem('color-theme') === 'dark';
        }

        function syncAgentTheme() {
            if (!page) return;

            if (isDarkTheme()) {
                page.classList.add('agp-dark');
            } else {
                page.classList.remove('agp-dark');
            }
        }

        syncAgentTheme();

        const observer = new MutationObserver(syncAgentTheme);

        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['class']
        });

        observer.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['class']
        });

        const switcher = document.getElementById('sidebarThemeSwitch');

        if (switcher) {
            switcher.addEventListener('change', function () {
                setTimeout(syncAgentTheme, 50);
            });
        }

        window.addEventListener('storage', syncAgentTheme);
    });
</script>

@endsection