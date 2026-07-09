@extends('layouts.app-dashboard')

@section('content')

<div class="agent-monitoring-page">

    <div class="page-heading">
        <h1>Agent Monitoring</h1>
        <p>Monitor connected agents, endpoint status, last activity, and health condition.</p>
    </div>

    <!-- Summary Cards -->
    <div class="agent-summary-grid">
        <div class="agent-summary-card online">
            <div class="agent-card-icon">ON</div>
            <div>
                <span>Online Agents</span>
                <h2>3</h2>
                <p>Currently connected</p>
            </div>
        </div>

        <div class="agent-summary-card offline">
            <div class="agent-card-icon">OFF</div>
            <div>
                <span>Offline Agents</span>
                <h2>1</h2>
                <p>Need attention</p>
            </div>
        </div>

        <div class="agent-summary-card total">
            <div class="agent-card-icon">AG</div>
            <div>
                <span>Total Agents</span>
                <h2>4</h2>
                <p>Registered endpoints</p>
            </div>
        </div>

        <div class="agent-summary-card health">
            <div class="agent-card-icon">HL</div>
            <div>
                <span>Average Health</span>
                <h2>87%</h2>
                <p>Endpoint condition</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="agent-content-grid">

        <!-- Agent List -->
        <div class="agent-panel">
            <div class="panel-header">
                <div>
                    <h3>Connected Agents</h3>
                    <p>List of endpoints connected to the LOX monitoring system.</p>
                </div>
            </div>

            <div class="agent-table-wrapper">
                <table class="agent-table">
                    <thead>
                        <tr>
                            <th>Agent Name</th>
                            <th>Status</th>
                            <th>Last Seen</th>
                            <th>IP Address</th>
                            <th>Agent Health</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <div class="agent-name-box">
                                    <div class="agent-avatar">RV</div>
                                    <div>
                                        <strong>rizki-VirtualBox</strong>
                                        <small>Ubuntu Endpoint</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="agent-status online">Online</span></td>
                            <td>11:30</td>
                            <td>192.168.56.101</td>
                            <td>
                                <div class="health-box">
                                    <span>96%</span>
                                    <div class="health-track">
                                        <div style="width: 96%;"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="agent-name-box">
                                    <div class="agent-avatar kali">KL</div>
                                    <div>
                                        <strong>kali-linux</strong>
                                        <small>Attack Simulation Client</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="agent-status offline">Offline</span></td>
                            <td>-</td>
                            <td>192.168.56.110</td>
                            <td>
                                <div class="health-box">
                                    <span>0%</span>
                                    <div class="health-track danger">
                                        <div style="width: 0%;"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="agent-name-box">
                                    <div class="agent-avatar web">WS</div>
                                    <div>
                                        <strong>web-server</strong>
                                        <small>Application Server</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="agent-status online">Online</span></td>
                            <td>11:28</td>
                            <td>192.168.1.20</td>
                            <td>
                                <div class="health-box">
                                    <span>89%</span>
                                    <div class="health-track">
                                        <div style="width: 89%;"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="agent-name-box">
                                    <div class="agent-avatar db">DB</div>
                                    <div>
                                        <strong>database-server</strong>
                                        <small>Database Node</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="agent-status online">Online</span></td>
                            <td>11:25</td>
                            <td>192.168.1.45</td>
                            <td>
                                <div class="health-box">
                                    <span>82%</span>
                                    <div class="health-track warning">
                                        <div style="width: 82%;"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Agent Health -->
        <div class="agent-panel">
            <div class="panel-header">
                <div>
                    <h3>Agent Health</h3>
                    <p>Endpoint condition based on connection status and activity.</p>
                </div>
            </div>

            <div class="health-card-list">
                <div class="health-card">
                    <div>
                        <strong>rizki-VirtualBox</strong>
                        <small>Stable connection</small>
                    </div>
                    <span class="health-score good">96%</span>
                </div>

                <div class="health-card">
                    <div>
                        <strong>web-server</strong>
                        <small>Normal activity</small>
                    </div>
                    <span class="health-score good">89%</span>
                </div>

                <div class="health-card">
                    <div>
                        <strong>database-server</strong>
                        <small>Minor delay detected</small>
                    </div>
                    <span class="health-score warning">82%</span>
                </div>

                <div class="health-card">
                    <div>
                        <strong>kali-linux</strong>
                        <small>No recent communication</small>
                    </div>
                    <span class="health-score danger">0%</span>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    .agent-monitoring-page {
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

    .agent-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .agent-summary-card {
        position: relative;
        overflow: hidden;
        min-height: 126px;
        padding: 24px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10);
    }

    .agent-summary-card::before {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        right: -30px;
        top: -34px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.22);
    }

    .agent-summary-card::after {
        content: "";
        position: absolute;
        width: 88px;
        height: 88px;
        right: 28px;
        bottom: -42px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.17);
    }

    .agent-summary-card.online {
        background: linear-gradient(135deg, #ffffff, #dcfce7);
    }

    .agent-summary-card.offline {
        background: linear-gradient(135deg, #ffffff, #fee2e2);
    }

    .agent-summary-card.total {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .agent-summary-card.health {
        background: linear-gradient(135deg, #ffffff, #dbeafe);
    }

    .agent-card-icon {
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
        background: rgba(255, 255, 255, 0.86);
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 14px 30px rgba(168, 85, 247, 0.14);
    }

    .agent-summary-card div {
        position: relative;
        z-index: 2;
    }

    .agent-summary-card span {
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .agent-summary-card h2 {
        margin: 7px 0 4px;
        color: #0f172a;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .agent-summary-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .agent-content-grid {
        display: grid;
        grid-template-columns: 1.5fr 0.8fr;
        gap: 24px;
        align-items: start;
    }

    .agent-panel {
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

    .agent-table-wrapper {
        margin-top: 22px;
        overflow-x: auto;
    }

    .agent-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .agent-table th {
        text-align: left;
        color: #64748b;
        font-size: 13px;
        font-weight: 950;
        padding: 0 18px 4px;
    }

    .agent-table td {
        padding: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border-top: 1px solid rgba(168, 85, 247, 0.16);
        border-bottom: 1px solid rgba(168, 85, 247, 0.16);
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
    }

    .agent-table tbody tr:nth-child(2) td {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .agent-table tbody tr:nth-child(3) td {
        background: linear-gradient(135deg, #ffffff, #dbeafe);
    }

    .agent-table tbody tr:nth-child(4) td {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .agent-table td:first-child {
        border-left: 1px solid rgba(168, 85, 247, 0.16);
        border-radius: 18px 0 0 18px;
    }

    .agent-table td:last-child {
        border-right: 1px solid rgba(168, 85, 247, 0.16);
        border-radius: 0 18px 18px 0;
    }

    .agent-name-box {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .agent-avatar {
        width: 45px;
        height: 45px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #16a34a;
        background: linear-gradient(135deg, #dcfce7, #ffffff);
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 10px 24px rgba(34, 197, 94, 0.13);
    }

    .agent-avatar.kali {
        color: #dc2626;
        background: linear-gradient(135deg, #fee2e2, #ffffff);
    }

    .agent-avatar.web {
        color: #2563eb;
        background: linear-gradient(135deg, #dbeafe, #ffffff);
    }

    .agent-avatar.db {
        color: #d97706;
        background: linear-gradient(135deg, #fef3c7, #ffffff);
    }

    .agent-name-box strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .agent-name-box small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .agent-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 86px;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .agent-status.online {
        color: #059669;
        background: #dcfce7;
    }

    .agent-status.offline {
        color: #dc2626;
        background: #fee2e2;
    }

    .health-box {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 150px;
    }

    .health-box span {
        color: #0f172a;
        font-size: 13px;
        font-weight: 950;
        min-width: 36px;
    }

    .health-track {
        flex: 1;
        height: 9px;
        border-radius: 999px;
        background: #e2e8f0;
        overflow: hidden;
    }

    .health-track div {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #22c55e, #8b5cf6);
    }

    .health-track.warning div {
        background: linear-gradient(90deg, #f59e0b, #ec4899);
    }

    .health-track.danger div {
        background: linear-gradient(90deg, #ef4444, #dc2626);
    }

    .health-card-list {
        display: grid;
        gap: 14px;
        margin-top: 22px;
    }

    .health-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 18px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
    }

    .health-card:nth-child(1) {
        background: linear-gradient(135deg, #ffffff, #dcfce7);
    }

    .health-card:nth-child(2) {
        background: linear-gradient(135deg, #ffffff, #dbeafe);
    }

    .health-card:nth-child(3) {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .health-card:nth-child(4) {
        background: linear-gradient(135deg, #ffffff, #fee2e2);
    }

    .health-card strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .health-card small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .health-score {
        min-width: 62px;
        padding: 9px 13px;
        border-radius: 999px;
        text-align: center;
        font-size: 13px;
        font-weight: 950;
    }

    .health-score.good {
        background: #dcfce7;
        color: #059669;
    }

    .health-score.warning {
        background: #fef3c7;
        color: #d97706;
    }

    .health-score.danger {
        background: #fee2e2;
        color: #dc2626;
    }

    body.dark-mode .page-heading h1,
    body.dark .page-heading h1,
    body.dark-theme .page-heading h1,
    body.dark-mode .panel-header h3,
    body.dark .panel-header h3,
    body.dark-theme .panel-header h3,
    body.dark-mode .agent-summary-card h2,
    body.dark .agent-summary-card h2,
    body.dark-theme .agent-summary-card h2,
    body.dark-mode .agent-table td,
    body.dark .agent-table td,
    body.dark-theme .agent-table td,
    body.dark-mode .agent-name-box strong,
    body.dark .agent-name-box strong,
    body.dark-theme .agent-name-box strong,
    body.dark-mode .health-box span,
    body.dark .health-box span,
    body.dark-theme .health-box span,
    body.dark-mode .health-card strong,
    body.dark .health-card strong,
    body.dark-theme .health-card strong {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark .page-heading p,
    body.dark-theme .page-heading p,
    body.dark-mode .panel-header p,
    body.dark .panel-header p,
    body.dark-theme .panel-header p,
    body.dark-mode .agent-summary-card span,
    body.dark .agent-summary-card span,
    body.dark-theme .agent-summary-card span,
    body.dark-mode .agent-summary-card p,
    body.dark .agent-summary-card p,
    body.dark-theme .agent-summary-card p,
    body.dark-mode .agent-table th,
    body.dark .agent-table th,
    body.dark-theme .agent-table th,
    body.dark-mode .agent-name-box small,
    body.dark .agent-name-box small,
    body.dark-theme .agent-name-box small,
    body.dark-mode .health-card small,
    body.dark .health-card small,
    body.dark-theme .health-card small {
        color: #94a3b8 !important;
    }

    body.dark-mode .agent-panel,
    body.dark .agent-panel,
    body.dark-theme .agent-panel,
    body.dark-mode .agent-summary-card,
    body.dark .agent-summary-card,
    body.dark-theme .agent-summary-card,
    body.dark-mode .agent-table td,
    body.dark .agent-table td,
    body.dark-theme .agent-table td,
    body.dark-mode .health-card,
    body.dark .health-card,
    body.dark-theme .health-card {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    @media (max-width: 1200px) {
        .agent-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .agent-content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .agent-summary-grid {
            grid-template-columns: 1fr;
        }

        .health-card {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

@endsection