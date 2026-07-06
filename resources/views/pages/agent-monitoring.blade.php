@extends('layouts.app-dashboard')

@section('content')
<div class="agent-monitoring-page">

    <div class="page-heading">
        <div>
            <h1>Agent Monitoring</h1>
            <p>Monitor connected endpoints, agent health, and last activity status.</p>
        </div>
    </div>

    <div class="agent-summary-grid">
        <div class="summary-card">
            <div class="summary-icon purple">⌁</div>
            <div>
                <p>Agent Status</p>
                <h2>Healthy</h2>
                <span class="success-text">All core services are running</span>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">●</div>
            <div>
                <p>Connected Agents</p>
                <h2>12</h2>
                <span class="success-text">+3 connected today</span>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon orange">◷</div>
            <div>
                <p>Last Seen</p>
                <h2>2 min ago</h2>
                <span class="neutral-text">Latest agent activity</span>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon red">✦</div>
            <div>
                <p>Agent Health</p>
                <h2>92%</h2>
                <span class="success-text">Stable endpoint coverage</span>
            </div>
        </div>
    </div>

    <div class="agent-content-grid">

        <div class="agent-panel large-panel">
            <div class="panel-header">
                <div>
                    <h3>Connected Agents</h3>
                    <p>Live endpoint visibility across registered devices.</p>
                </div>

                <div class="agent-filter">
                    <input type="text" id="agentSearch" placeholder="Search agent...">
                    <select id="statusFilter">
                        <option value="all">All Status</option>
                        <option value="online">Online</option>
                        <option value="warning">Warning</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>
            </div>

            <div class="agent-table-wrapper">
                <table class="agent-table">
                    <thead>
                        <tr>
                            <th>Agent Name</th>
                            <th>IP Address</th>
                            <th>Operating System</th>
                            <th>Agent Status</th>
                            <th>Last Seen</th>
                            <th>Agent Health</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="agentTableBody">
                        <tr data-status="online">
                            <td>
                                <div class="agent-name">
                                    <div class="device-icon">WS</div>
                                    <div>
                                        <strong>Web Server</strong>
                                        <span>Production endpoint</span>
                                    </div>
                                </div>
                            </td>
                            <td>192.168.1.20</td>
                            <td>Ubuntu 22.04</td>
                            <td><span class="status-badge online">Online</span></td>
                            <td>2 minutes ago</td>
                            <td>
                                <div class="health-cell">
                                    <div class="health-bar">
                                        <span style="width: 96%;"></span>
                                    </div>
                                    <b>96%</b>
                                </div>
                            </td>
                            <td><button class="table-action">View</button></td>
                        </tr>

                        <tr data-status="online">
                            <td>
                                <div class="agent-name">
                                    <div class="device-icon">DB</div>
                                    <div>
                                        <strong>Database Server</strong>
                                        <span>Internal asset</span>
                                    </div>
                                </div>
                            </td>
                            <td>192.168.1.15</td>
                            <td>Ubuntu 20.04</td>
                            <td><span class="status-badge online">Online</span></td>
                            <td>5 minutes ago</td>
                            <td>
                                <div class="health-cell">
                                    <div class="health-bar">
                                        <span style="width: 91%;"></span>
                                    </div>
                                    <b>91%</b>
                                </div>
                            </td>
                            <td><button class="table-action">View</button></td>
                        </tr>

                        <tr data-status="warning">
                            <td>
                                <div class="agent-name">
                                    <div class="device-icon">FW</div>
                                    <div>
                                        <strong>Firewall Node</strong>
                                        <span>Network security layer</span>
                                    </div>
                                </div>
                            </td>
                            <td>192.168.1.30</td>
                            <td>Kali Linux</td>
                            <td><span class="status-badge warning">Warning</span></td>
                            <td>18 minutes ago</td>
                            <td>
                                <div class="health-cell">
                                    <div class="health-bar warning">
                                        <span style="width: 72%;"></span>
                                    </div>
                                    <b>72%</b>
                                </div>
                            </td>
                            <td><button class="table-action">View</button></td>
                        </tr>

                        <tr data-status="online">
                            <td>
                                <div class="agent-name">
                                    <div class="device-icon">EP</div>
                                    <div>
                                        <strong>Endpoint Client</strong>
                                        <span>User workstation</span>
                                    </div>
                                </div>
                            </td>
                            <td>192.168.1.45</td>
                            <td>Windows 11</td>
                            <td><span class="status-badge online">Online</span></td>
                            <td>1 hour ago</td>
                            <td>
                                <div class="health-cell">
                                    <div class="health-bar">
                                        <span style="width: 88%;"></span>
                                    </div>
                                    <b>88%</b>
                                </div>
                            </td>
                            <td><button class="table-action">View</button></td>
                        </tr>

                        <tr data-status="offline">
                            <td>
                                <div class="agent-name">
                                    <div class="device-icon">LT</div>
                                    <div>
                                        <strong>Analyst Laptop</strong>
                                        <span>Security analyst device</span>
                                    </div>
                                </div>
                            </td>
                            <td>192.168.1.55</td>
                            <td>Windows 10</td>
                            <td><span class="status-badge offline">Offline</span></td>
                            <td>1 day ago</td>
                            <td>
                                <div class="health-cell">
                                    <div class="health-bar danger">
                                        <span style="width: 38%;"></span>
                                    </div>
                                    <b>38%</b>
                                </div>
                            </td>
                            <td><button class="table-action">View</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="agent-panel">
            <div class="panel-header simple">
                <div>
                    <h3>Agent Health</h3>
                    <p>Endpoint condition summary.</p>
                </div>
            </div>

            <div class="health-list">
                <div class="health-item">
                    <div>
                        <strong>CPU Usage</strong>
                        <span>Normal workload</span>
                    </div>
                    <b>42%</b>
                </div>

                <div class="health-item">
                    <div>
                        <strong>Memory Usage</strong>
                        <span>Stable resource usage</span>
                    </div>
                    <b>58%</b>
                </div>

                <div class="health-item">
                    <div>
                        <strong>Disk Usage</strong>
                        <span>Storage capacity safe</span>
                    </div>
                    <b>64%</b>
                </div>

                <div class="health-item">
                    <div>
                        <strong>Service Status</strong>
                        <span>Agent service active</span>
                    </div>
                    <b class="green-text">Running</b>
                </div>
            </div>
        </div>

    </div>

    <div class="agent-panel activity-panel">
        <div class="panel-header simple">
            <div>
                <h3>Last Seen Activity</h3>
                <p>Recent heartbeat and connection activity from monitored agents.</p>
            </div>
        </div>

        <div class="activity-grid">
            <div class="activity-card">
                <span class="activity-dot online-dot"></span>
                <div>
                    <strong>Web Server connected successfully</strong>
                    <p>Agent heartbeat received from 192.168.1.20</p>
                    <small>2 minutes ago</small>
                </div>
            </div>

            <div class="activity-card">
                <span class="activity-dot online-dot"></span>
                <div>
                    <strong>Database Server sent health update</strong>
                    <p>CPU, memory, and disk metrics were updated.</p>
                    <small>5 minutes ago</small>
                </div>
            </div>

            <div class="activity-card">
                <span class="activity-dot warning-dot"></span>
                <div>
                    <strong>Firewall Node reported warning</strong>
                    <p>Agent health dropped below the recommended threshold.</p>
                    <small>18 minutes ago</small>
                </div>
            </div>

            <div class="activity-card">
                <span class="activity-dot offline-dot"></span>
                <div>
                    <strong>Analyst Laptop disconnected</strong>
                    <p>No heartbeat has been received within the last 24 hours.</p>
                    <small>1 day ago</small>
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
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 26px;
        gap: 20px;
    }

    .page-heading h1 {
        font-size: 30px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }

    .page-heading p {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .primary-btn {
        border: none;
        background: linear-gradient(135deg, #8b3dff, #d946ef);
        color: #fff;
        padding: 13px 20px;
        border-radius: 16px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 12px 28px rgba(139, 61, 255, 0.25);
        transition: 0.25s ease;
    }

    .primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 34px rgba(139, 61, 255, 0.32);
    }

    .agent-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        padding: 24px;
        min-height: 145px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
    }

    .summary-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 20px;
    }

    .summary-icon.purple {
        background: #f2e3ff;
        color: #8b3dff;
    }

    .summary-icon.green {
        background: #dcfce7;
        color: #16a34a;
    }

    .summary-icon.orange {
        background: #ffedd5;
        color: #f97316;
    }

    .summary-icon.red {
        background: #fee2e2;
        color: #ef4444;
    }

    .summary-card p {
        margin: 3px 0 8px;
        font-size: 14px;
        color: #64748b;
        font-weight: 700;
    }

    .summary-card h2 {
        margin: 0 0 9px;
        font-size: 30px;
        color: #020617;
        font-weight: 900;
    }

    .summary-card span {
        font-size: 13px;
        font-weight: 700;
    }

    .success-text {
        color: #059669;
    }

    .neutral-text {
        color: #64748b;
    }

    .agent-content-grid {
        display: grid;
        grid-template-columns: 1.7fr 0.8fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .agent-panel {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        padding: 24px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
    }

    .large-panel {
        overflow: hidden;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        margin-bottom: 20px;
    }

    .panel-header.simple {
        align-items: flex-start;
    }

    .panel-header h3 {
        margin: 0;
        font-size: 19px;
        color: #0f172a;
        font-weight: 900;
    }

    .panel-header p {
        margin: 6px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .agent-filter {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .agent-filter input,
    .agent-filter select {
        height: 42px;
        border: 1px solid #e5e7eb;
        background: #fff;
        border-radius: 14px;
        padding: 0 14px;
        outline: none;
        color: #0f172a;
        font-weight: 600;
    }

    .agent-filter input:focus,
    .agent-filter select:focus {
        border-color: #a855f7;
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.12);
    }

    .agent-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .agent-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    .agent-table th {
        text-align: left;
        padding: 14px 12px;
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        border-bottom: 1px solid #e5e7eb;
    }

    .agent-table td {
        padding: 16px 12px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
        color: #0f172a;
        font-weight: 600;
        vertical-align: middle;
    }

    .agent-table tbody tr:hover {
        background: #faf5ff;
    }

    .agent-name {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .agent-name strong {
        display: block;
        font-size: 14px;
        color: #0f172a;
    }

    .agent-name span {
        display: block;
        font-size: 12px;
        color: #64748b;
        margin-top: 3px;
    }

    .device-icon {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        background: #f2e3ff;
        color: #8b3dff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 900;
    }

    .status-badge {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
    }

    .status-badge.online {
        background: #dcfce7;
        color: #059669;
    }

    .status-badge.warning {
        background: #fef3c7;
        color: #d97706;
    }

    .status-badge.offline {
        background: #fee2e2;
        color: #dc2626;
    }

    .health-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .health-bar {
        width: 90px;
        height: 8px;
        border-radius: 999px;
        background: #e5e7eb;
        overflow: hidden;
    }

    .health-bar span {
        height: 100%;
        display: block;
        border-radius: inherit;
        background: linear-gradient(135deg, #22c55e, #16a34a);
    }

    .health-bar.warning span {
        background: linear-gradient(135deg, #f59e0b, #f97316);
    }

    .health-bar.danger span {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .health-cell b {
        font-size: 13px;
        color: #0f172a;
    }

    .table-action {
        border: none;
        background: #f3e8ff;
        color: #8b3dff;
        padding: 8px 13px;
        border-radius: 12px;
        font-weight: 800;
        cursor: pointer;
    }

    .table-action:hover {
        background: #8b3dff;
        color: #fff;
    }

    .health-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .health-item {
        padding: 17px;
        border: 1px solid #eef2f7;
        border-radius: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        background: #fbfdff;
    }

    .health-item strong {
        display: block;
        font-size: 14px;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .health-item span {
        display: block;
        color: #64748b;
        font-size: 12px;
    }

    .health-item b {
        font-size: 15px;
        color: #8b3dff;
    }

    .green-text {
        color: #059669 !important;
    }

    .activity-panel {
        margin-bottom: 24px;
    }

    .activity-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .activity-card {
        border: 1px solid #eef2f7;
        border-radius: 18px;
        padding: 18px;
        display: flex;
        gap: 12px;
        background: #fbfdff;
    }

    .activity-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        margin-top: 5px;
        flex-shrink: 0;
    }

    .online-dot {
        background: #22c55e;
    }

    .warning-dot {
        background: #f59e0b;
    }

    .offline-dot {
        background: #ef4444;
    }

    .activity-card strong {
        color: #0f172a;
        font-size: 14px;
        display: block;
    }

    .activity-card p {
        margin: 7px 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
    }

    .activity-card small {
        color: #94a3b8;
        font-weight: 700;
    }

    @media (max-width: 1200px) {
        .agent-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .agent-content-grid {
            grid-template-columns: 1fr;
        }

        .activity-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .page-heading {
            flex-direction: column;
            align-items: flex-start;
        }

        .primary-btn {
            width: 100%;
        }

        .agent-summary-grid {
            grid-template-columns: 1fr;
        }

        .panel-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .agent-filter {
            width: 100%;
            flex-direction: column;
        }

        .agent-filter input,
        .agent-filter select {
            width: 100%;
        }

        .activity-grid {
            grid-template-columns: 1fr;
        }
    }
    /* ================================================= */
/* Pink Purple Agent Monitoring Theme */
/* Paste di paling bawah CSS Agent Monitoring */
/* ================================================= */

.agent-monitoring-page {
    padding: 4px;
}

/* Background halaman biar soft pink ungu */
.main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.20), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 35%),
        linear-gradient(135deg, #f8f3ff 0%, #fde7f7 48%, #f3e8ff 100%) !important;
}

/* Card atas */
.agent-summary-grid .summary-card {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 22px 45px rgba(168, 85, 247, 0.14) !important;
}

/* Dekorasi lingkaran soft */
.agent-summary-grid .summary-card::before {
    content: "";
    position: absolute;
    width: 135px;
    height: 135px;
    right: -50px;
    top: -55px;
    border-radius: 50%;
    opacity: 0.35;
}

.agent-summary-grid .summary-card::after {
    content: "";
    position: absolute;
    width: 90px;
    height: 90px;
    right: 28px;
    bottom: -45px;
    border-radius: 50%;
    opacity: 0.22;
}

/* Agent Status */
.agent-summary-grid .summary-card:nth-child(1) {
    background: linear-gradient(135deg, #ffffff 0%, #f3e8ff 55%, #fae8ff 100%) !important;
}

.agent-summary-grid .summary-card:nth-child(1)::before {
    background: #a855f7;
}

.agent-summary-grid .summary-card:nth-child(1)::after {
    background: #d946ef;
}

/* Connected Agents */
.agent-summary-grid .summary-card:nth-child(2) {
    background: linear-gradient(135deg, #ffffff 0%, #f5e8ff 50%, #ffe4f3 100%) !important;
}

.agent-summary-grid .summary-card:nth-child(2)::before {
    background: #c084fc;
}

.agent-summary-grid .summary-card:nth-child(2)::after {
    background: #ec4899;
}

/* Last Seen */
.agent-summary-grid .summary-card:nth-child(3) {
    background: linear-gradient(135deg, #ffffff 0%, #fae8ff 50%, #fce7f3 100%) !important;
}

.agent-summary-grid .summary-card:nth-child(3)::before {
    background: #d946ef;
}

.agent-summary-grid .summary-card:nth-child(3)::after {
    background: #fb7185;
}

/* Agent Health */
.agent-summary-grid .summary-card:nth-child(4) {
    background: linear-gradient(135deg, #ffffff 0%, #f3e8ff 45%, #ffe4f3 100%) !important;
}

.agent-summary-grid .summary-card:nth-child(4)::before {
    background: #8b5cf6;
}

.agent-summary-grid .summary-card:nth-child(4)::after {
    background: #ec4899;
}

/* Biar isi card tetap di atas dekorasi */
.agent-summary-grid .summary-card > * {
    position: relative;
    z-index: 2;
}

/* Icon card dibuat lebih senada */
.agent-summary-grid .summary-icon {
    background: rgba(255, 255, 255, 0.72) !important;
    color: #9333ea !important;
    box-shadow: 0 12px 25px rgba(168, 85, 247, 0.18);
}

/* Text card */
.agent-summary-grid .summary-card p {
    color: #64748b !important;
}

.agent-summary-grid .summary-card h2 {
    color: #111827 !important;
}

.agent-summary-grid .summary-card span {
    color: #059669 !important;
}

/* Panel besar bawah */
.agent-panel {
    background: rgba(255, 255, 255, 0.82) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.13) !important;
    backdrop-filter: blur(14px);
}

/* Table dan health card biar nyatu */
.agent-table tbody tr:hover {
    background: rgba(250, 232, 255, 0.65) !important;
}

.health-item,
.activity-card {
    background: linear-gradient(135deg, #ffffff 0%, #fbf5ff 100%) !important;
    border: 1px solid rgba(168, 85, 247, 0.14) !important;
}

/* Button kecil */
.table-action {
    background: #f3e8ff !important;
    color: #9333ea !important;
}

.table-action:hover {
    background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    color: #ffffff !important;
}

/* Search dan select */
.agent-filter input,
.agent-filter select {
    background: rgba(255, 255, 255, 0.88) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
}

.agent-filter input:focus,
.agent-filter select:focus {
    border-color: #d946ef !important;
    box-shadow: 0 0 0 4px rgba(217, 70, 239, 0.12) !important;
}

/* Dark mode tetap aman */
body.dark-mode .main,
body.dark .main,
body.dark-theme .main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.18), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 35%),
        linear-gradient(135deg, #0f172a 0%, #1e1b4b 48%, #3b123c 100%) !important;
}

body.dark-mode .agent-summary-grid .summary-card:nth-child(1),
body.dark .agent-summary-grid .summary-card:nth-child(1),
body.dark-theme .agent-summary-grid .summary-card:nth-child(1) {
    background: linear-gradient(135deg, #111827 0%, #2e174f 100%) !important;
}

body.dark-mode .agent-summary-grid .summary-card:nth-child(2),
body.dark .agent-summary-grid .summary-card:nth-child(2),
body.dark-theme .agent-summary-grid .summary-card:nth-child(2) {
    background: linear-gradient(135deg, #111827 0%, #3b1d4f 100%) !important;
}

body.dark-mode .agent-summary-grid .summary-card:nth-child(3),
body.dark .agent-summary-grid .summary-card:nth-child(3),
body.dark-theme .agent-summary-grid .summary-card:nth-child(3) {
    background: linear-gradient(135deg, #111827 0%, #4a183d 100%) !important;
}

body.dark-mode .agent-summary-grid .summary-card:nth-child(4),
body.dark .agent-summary-grid .summary-card:nth-child(4),
body.dark-theme .agent-summary-grid .summary-card:nth-child(4) {
    background: linear-gradient(135deg, #111827 0%, #32164f 100%) !important;
    /* ================================================= */
/* Agent Monitoring - Pink Purple Detail Area Fix */
/* Paste paling bawah CSS agent-monitoring.blade.php */
/* ================================================= */

/* Panel Connected Agents dan Agent Health */
.agent-content-grid .agent-panel,
.agent-panel.activity-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.88) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
}

/* Connected Agents table biar ga putih polos */
.agent-table tbody tr {
    background: rgba(255, 255, 255, 0.62) !important;
    transition: 0.2s ease;
}

.agent-table tbody tr:nth-child(even) {
    background: rgba(250, 232, 255, 0.58) !important;
}

.agent-table tbody tr:nth-child(odd) {
    background: rgba(255, 247, 252, 0.72) !important;
}

.agent-table tbody tr:hover {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    transform: scale(1.003);
}

/* Biar garis table lebih soft pink */
.agent-table th,
.agent-table td {
    border-color: rgba(168, 85, 247, 0.16) !important;
}

/* Icon agent di table */
.device-icon {
    background: linear-gradient(135deg, #f3e8ff, #fce7f3) !important;
    color: #8b5cf6 !important;
    box-shadow: 0 10px 22px rgba(168, 85, 247, 0.16);
}

/* Agent Health kanan */
.health-list .health-item {
    background: linear-gradient(135deg, rgba(255,255,255,0.92), rgba(250,232,255,0.78)) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
}

.health-list .health-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.health-list .health-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.health-list .health-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #ede9fe) !important;
}

.health-list .health-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #fdf2f8) !important;
}

/* Progress bar lebih nyatu */
.health-bar {
    background: rgba(203, 213, 225, 0.55) !important;
}

.health-bar span {
    background: linear-gradient(90deg, #8b5cf6, #d946ef) !important;
}

.health-bar.warning span {
    background: linear-gradient(90deg, #f59e0b, #ec4899) !important;
}

.health-bar.danger span {
    background: linear-gradient(90deg, #ef4444, #d946ef) !important;
}

/* Last Seen Activity bawah */
.activity-grid .activity-card {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.13), transparent 36%),
        linear-gradient(135deg, rgba(255,255,255,0.95), rgba(250,232,255,0.78)) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 14px 32px rgba(168, 85, 247, 0.10);
}

.activity-grid .activity-card:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.activity-grid .activity-card:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.activity-grid .activity-card:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.activity-grid .activity-card:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #ede9fe) !important;
}

/* Button View */
.table-action {
    background: linear-gradient(135deg, #f3e8ff, #fce7f3) !important;
    color: #8b5cf6 !important;
    box-shadow: 0 8px 18px rgba(168, 85, 247, 0.13);
}

.table-action:hover {
    background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    color: #ffffff !important;
}

/* Search dan filter */
.agent-filter input,
.agent-filter select {
    background: rgba(255, 255, 255, 0.9) !important;
    border: 1px solid rgba(168, 85, 247, 0.22) !important;
    box-shadow: 0 10px 24px rgba(168, 85, 247, 0.08);
}

/* Panel title accent */
.panel-header h3 {
    color: #111827 !important;
}

.panel-header h3::after {
    content: "";
    display: block;
    width: 48px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

/* Dark mode */
body.dark-mode .agent-content-grid .agent-panel,
body.dark .agent-content-grid .agent-panel,
body.dark-theme .agent-content-grid .agent-panel,
body.dark-mode .agent-panel.activity-panel,
body.dark .agent-panel.activity-panel,
body.dark-theme .agent-panel.activity-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.16), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.16), transparent 35%),
        #111827 !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .agent-table tbody tr,
body.dark .agent-table tbody tr,
body.dark-theme .agent-table tbody tr {
    background: rgba(30, 41, 59, 0.72) !important;
}

body.dark-mode .agent-table tbody tr:nth-child(even),
body.dark .agent-table tbody tr:nth-child(even),
body.dark-theme .agent-table tbody tr:nth-child(even) {
    background: rgba(59, 24, 84, 0.38) !important;
}

body.dark-mode .health-list .health-item,
body.dark .health-list .health-item,
body.dark-theme .health-list .health-item,
body.dark-mode .activity-grid .activity-card,
body.dark .activity-grid .activity-card,
body.dark-theme .activity-grid .activity-card {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
}
}
</style>

<script>
    const searchInput = document.getElementById('agentSearch');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('#agentTableBody tr');

    function filterAgents() {
        const searchValue = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value;

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            const rowStatus = row.getAttribute('data-status');

            const matchesSearch = rowText.includes(searchValue);
            const matchesStatus = selectedStatus === 'all' || rowStatus === selectedStatus;

            row.style.display = matchesSearch && matchesStatus ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterAgents);
    statusFilter.addEventListener('change', filterAgents);
</script>
@endsection