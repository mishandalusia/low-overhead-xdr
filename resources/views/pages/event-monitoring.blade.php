@extends('layouts.app-dashboard')

@section('content')
<div class="evmon-page">

    <div class="evmon-heading">
        <div>
            <h1>Event Monitoring</h1>
            <p>Monitor host events, network events, application events, and filter event logs.</p>
        </div>
    </div>

    <div class="evmon-summary-grid">

        <div class="evmon-summary-card">
            <div class="evmon-icon evmon-purple">HE</div>
            <div>
                <p>Host Events</p>
                <h2>428</h2>
                <span>Endpoint activity logs</span>
            </div>
        </div>

        <div class="evmon-summary-card">
            <div class="evmon-icon evmon-blue">NE</div>
            <div>
                <p>Network Events</p>
                <h2>312</h2>
                <span>Traffic and connection logs</span>
            </div>
        </div>

        <div class="evmon-summary-card">
            <div class="evmon-icon evmon-green">AE</div>
            <div>
                <p>Application Events</p>
                <h2>196</h2>
                <span>Service and process activity</span>
            </div>
        </div>

    </div>

    <div class="evmon-module-grid">

        <div class="evmon-panel">
            <div class="evmon-panel-title">
                <span>Host Events</span>
                <h2>Recent Host Activity</h2>
                <p>Latest endpoint events collected from monitored agents.</p>
            </div>

            <div class="evmon-list">
                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-purple-bg"></span>
                    <div>
                        <strong>Failed login attempt detected</strong>
                        <small>Web Server • 2 minutes ago</small>
                    </div>
                </div>

                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-purple-bg"></span>
                    <div>
                        <strong>New process execution recorded</strong>
                        <small>Endpoint Client • 8 minutes ago</small>
                    </div>
                </div>

                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-purple-bg"></span>
                    <div>
                        <strong>Privilege change activity</strong>
                        <small>Database Server • 15 minutes ago</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="evmon-panel">
            <div class="evmon-panel-title">
                <span>Network Events</span>
                <h2>Network Activity</h2>
                <p>Traffic and connection events from monitored network sources.</p>
            </div>

            <div class="evmon-list">
                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-blue-bg"></span>
                    <div>
                        <strong>Port scan activity detected</strong>
                        <small>Firewall Node • 12 minutes ago</small>
                    </div>
                </div>

                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-blue-bg"></span>
                    <div>
                        <strong>Outbound connection spike</strong>
                        <small>Web Server • 20 minutes ago</small>
                    </div>
                </div>

                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-blue-bg"></span>
                    <div>
                        <strong>Suspicious remote connection</strong>
                        <small>Endpoint Client • 35 minutes ago</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="evmon-panel">
            <div class="evmon-panel-title">
                <span>Application Events</span>
                <h2>Application Activity</h2>
                <p>Application and service events from monitored systems.</p>
            </div>

            <div class="evmon-list">
                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-green-bg"></span>
                    <div>
                        <strong>Database service warning</strong>
                        <small>Database Server • 18 minutes ago</small>
                    </div>
                </div>

                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-green-bg"></span>
                    <div>
                        <strong>Web application error logged</strong>
                        <small>Web Server • 28 minutes ago</small>
                    </div>
                </div>

                <div class="evmon-list-item">
                    <span class="evmon-dot evmon-green-bg"></span>
                    <div>
                        <strong>Application configuration changed</strong>
                        <small>Endpoint Client • 1 hour ago</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="evmon-panel evmon-search-panel">
        <div class="evmon-panel-title">
            <span>Event Search & Filtering</span>
            <h2>Event Logs</h2>
            <p>Search and filter host, network, and application events.</p>
        </div>

        <div class="evmon-filter">
            <input type="text" id="evmonSearch" placeholder="Search event, source, or status...">

            <select id="evmonTypeFilter">
                <option value="all">All Event Types</option>
                <option value="host">Host Events</option>
                <option value="network">Network Events</option>
                <option value="application">Application Events</option>
            </select>

            <select id="evmonStatusFilter">
                <option value="all">All Status</option>
                <option value="normal">Normal</option>
                <option value="warning">Warning</option>
                <option value="critical">Critical</option>
            </select>
        </div>

        <div class="evmon-table-wrapper">
            <table class="evmon-table">
                <thead>
                    <tr>
                        <th>Event ID</th>
                        <th>Event Type</th>
                        <th>Event Name</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>

                <tbody id="evmonTableBody">
                    <tr data-type="host" data-status="critical">
                        <td>EVT-001</td>
                        <td><span class="evmon-type evmon-type-host">Host</span></td>
                        <td>Failed login attempt detected</td>
                        <td>Web Server</td>
                        <td><span class="evmon-status evmon-critical">Critical</span></td>
                        <td>2 minutes ago</td>
                    </tr>

                    <tr data-type="network" data-status="warning">
                        <td>EVT-002</td>
                        <td><span class="evmon-type evmon-type-network">Network</span></td>
                        <td>Port scan activity detected</td>
                        <td>Firewall Node</td>
                        <td><span class="evmon-status evmon-warning">Warning</span></td>
                        <td>12 minutes ago</td>
                    </tr>

                    <tr data-type="application" data-status="warning">
                        <td>EVT-003</td>
                        <td><span class="evmon-type evmon-type-application">Application</span></td>
                        <td>Database service warning</td>
                        <td>Database Server</td>
                        <td><span class="evmon-status evmon-warning">Warning</span></td>
                        <td>18 minutes ago</td>
                    </tr>

                    <tr data-type="network" data-status="critical">
                        <td>EVT-004</td>
                        <td><span class="evmon-type evmon-type-network">Network</span></td>
                        <td>Outbound connection spike</td>
                        <td>Web Server</td>
                        <td><span class="evmon-status evmon-critical">Critical</span></td>
                        <td>20 minutes ago</td>
                    </tr>

                    <tr data-type="application" data-status="normal">
                        <td>EVT-005</td>
                        <td><span class="evmon-type evmon-type-application">Application</span></td>
                        <td>Web application error logged</td>
                        <td>Web Server</td>
                        <td><span class="evmon-status evmon-normal">Normal</span></td>
                        <td>28 minutes ago</td>
                    </tr>

                    <tr data-type="host" data-status="normal">
                        <td>EVT-006</td>
                        <td><span class="evmon-type evmon-type-host">Host</span></td>
                        <td>New process execution recorded</td>
                        <td>Endpoint Client</td>
                        <td><span class="evmon-status evmon-normal">Normal</span></td>
                        <td>35 minutes ago</td>
                    </tr>

                    <tr data-type="host" data-status="warning">
                        <td>EVT-007</td>
                        <td><span class="evmon-type evmon-type-host">Host</span></td>
                        <td>Privilege change activity</td>
                        <td>Database Server</td>
                        <td><span class="evmon-status evmon-warning">Warning</span></td>
                        <td>1 hour ago</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<style>
    .evmon-page {
        width: 100%;
    }

    .evmon-heading {
        margin-bottom: 26px;
    }

    .evmon-heading h1 {
        margin: 0;
        color: #111827;
        font-size: 30px;
        font-weight: 850;
        letter-spacing: -0.7px;
    }

    .evmon-heading p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .evmon-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .evmon-summary-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 22px;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        min-height: 135px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
    }

    .evmon-icon {
        width: 50px;
        height: 50px;
        min-width: 50px;
        min-height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 900;
        flex-shrink: 0;
    }

    .evmon-purple {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .evmon-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .evmon-green {
        background: #dcfce7;
        color: #059669;
    }

    .evmon-summary-card p {
        margin: 0 0 8px;
        color: #64748b;
        font-size: 14px;
        font-weight: 800;
    }

    .evmon-summary-card h2 {
        margin: 0;
        color: #0f172a;
        font-size: 31px;
        font-weight: 900;
    }

    .evmon-summary-card span {
        display: block;
        margin-top: 7px;
        color: #64748b;
        font-size: 13px;
    }

    .evmon-module-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 22px;
    }

    .evmon-panel {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.06);
    }

    .evmon-panel-title {
        margin-bottom: 20px;
    }

    .evmon-panel-title span {
        display: block;
        color: #7c3aed;
        font-size: 13px;
        font-weight: 850;
        margin-bottom: 8px;
    }

    .evmon-panel-title h2 {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        font-weight: 900;
    }

    .evmon-panel-title p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .evmon-list {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .evmon-list-item {
        border: 1px solid #edf0f5;
        background: #fbfdff;
        border-radius: 16px;
        padding: 15px;
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .evmon-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        margin-top: 5px;
        flex-shrink: 0;
    }

    .evmon-purple-bg {
        background: #8b5cf6;
        box-shadow: 0 0 0 5px rgba(139, 92, 246, 0.12);
    }

    .evmon-blue-bg {
        background: #2563eb;
        box-shadow: 0 0 0 5px rgba(37, 99, 235, 0.12);
    }

    .evmon-green-bg {
        background: #22c55e;
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.12);
    }

    .evmon-list-item strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .evmon-list-item small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .evmon-search-panel {
        margin-bottom: 24px;
    }

    .evmon-filter {
        display: grid;
        grid-template-columns: 1fr 210px 190px;
        gap: 12px;
        margin-bottom: 18px;
    }

    .evmon-filter input,
    .evmon-filter select {
        width: 100%;
        height: 44px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #ffffff;
        color: #0f172a;
        padding: 0 14px;
        font-size: 14px;
        font-weight: 700;
        outline: none;
    }

    .evmon-filter input:focus,
    .evmon-filter select:focus {
        border-color: #a855f7;
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.12);
    }

    .evmon-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .evmon-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .evmon-table th {
        text-align: left;
        padding: 14px 12px;
        border-bottom: 1px solid #e5e7eb;
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .evmon-table td {
        padding: 16px 12px;
        border-bottom: 1px solid #e5e7eb;
        color: #0f172a;
        font-size: 14px;
        font-weight: 700;
    }

    .evmon-table tbody tr:hover {
        background: #faf5ff;
    }

    .evmon-type,
    .evmon-status {
        display: inline-flex;
        align-items: center;
        padding: 8px 11px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
    }

    .evmon-type-host {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .evmon-type-network {
        background: #dbeafe;
        color: #2563eb;
    }

    .evmon-type-application {
        background: #dcfce7;
        color: #059669;
    }

    .evmon-normal {
        background: #dcfce7;
        color: #059669;
    }

    .evmon-warning {
        background: #fef3c7;
        color: #d97706;
    }

    .evmon-critical {
        background: #fee2e2;
        color: #dc2626;
    }

    body.dark-mode .evmon-heading h1,
    body.dark .evmon-heading h1,
    body.dark-theme .evmon-heading h1,
    body.dark-mode .evmon-summary-card h2,
    body.dark .evmon-summary-card h2,
    body.dark-theme .evmon-summary-card h2,
    body.dark-mode .evmon-panel-title h2,
    body.dark .evmon-panel-title h2,
    body.dark-theme .evmon-panel-title h2,
    body.dark-mode .evmon-list-item strong,
    body.dark .evmon-list-item strong,
    body.dark-theme .evmon-list-item strong,
    body.dark-mode .evmon-table td,
    body.dark .evmon-table td,
    body.dark-theme .evmon-table td {
        color: #f8fafc !important;
    }

    body.dark-mode .evmon-heading p,
    body.dark .evmon-heading p,
    body.dark-theme .evmon-heading p,
    body.dark-mode .evmon-summary-card p,
    body.dark .evmon-summary-card p,
    body.dark-theme .evmon-summary-card p,
    body.dark-mode .evmon-summary-card span,
    body.dark .evmon-summary-card span,
    body.dark-theme .evmon-summary-card span,
    body.dark-mode .evmon-panel-title p,
    body.dark .evmon-panel-title p,
    body.dark-theme .evmon-panel-title p,
    body.dark-mode .evmon-list-item small,
    body.dark .evmon-list-item small,
    body.dark-theme .evmon-list-item small,
    body.dark-mode .evmon-table th,
    body.dark .evmon-table th,
    body.dark-theme .evmon-table th {
        color: #94a3b8 !important;
    }

    body.dark-mode .evmon-summary-card,
    body.dark .evmon-summary-card,
    body.dark-theme .evmon-summary-card,
    body.dark-mode .evmon-panel,
    body.dark .evmon-panel,
    body.dark-theme .evmon-panel {
        background: #111827 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28) !important;
    }

    body.dark-mode .evmon-list-item,
    body.dark .evmon-list-item,
    body.dark-theme .evmon-list-item {
        background: #162033 !important;
        border-color: #243044 !important;
    }

    body.dark-mode .evmon-filter input,
    body.dark-mode .evmon-filter select,
    body.dark .evmon-filter input,
    body.dark .evmon-filter select,
    body.dark-theme .evmon-filter input,
    body.dark-theme .evmon-filter select {
        background: #162033 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
    }

    body.dark-mode .evmon-table th,
    body.dark-mode .evmon-table td,
    body.dark .evmon-table th,
    body.dark .evmon-table td,
    body.dark-theme .evmon-table th,
    body.dark-theme .evmon-table td {
        border-color: #243044 !important;
    }

    body.dark-mode .evmon-table tbody tr:hover,
    body.dark .evmon-table tbody tr:hover,
    body.dark-theme .evmon-table tbody tr:hover {
        background: rgba(139, 92, 246, 0.14) !important;
    }

    @media (max-width: 1200px) {
        .evmon-summary-grid,
        .evmon-module-grid {
            grid-template-columns: 1fr;
        }

        .evmon-filter {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .evmon-heading h1 {
            font-size: 25px;
        }

        .evmon-summary-card,
        .evmon-panel {
            padding: 20px;
        }
    }
    /* ================================================= */
/* Event Monitoring - Pink Purple UI Upgrade */
/* Paste paling bawah CSS event-monitoring.blade.php */
/* ================================================= */

.evmon-page {
    padding: 4px;
}

/* Background halaman */
.main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.20), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 35%),
        linear-gradient(135deg, #f8f3ff 0%, #fde7f7 48%, #f3e8ff 100%) !important;
}

/* Heading */
.evmon-heading h1 {
    color: #0f172a !important;
}

.evmon-heading p {
    color: #64748b !important;
}

/* ========================= */
/* Summary Cards */
/* ========================= */

.evmon-summary-card {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 22px 45px rgba(168, 85, 247, 0.14) !important;
}

.evmon-summary-card::before {
    content: "";
    position: absolute;
    width: 130px;
    height: 130px;
    right: -48px;
    top: -52px;
    border-radius: 50%;
    opacity: 0.32;
}

.evmon-summary-card::after {
    content: "";
    position: absolute;
    width: 88px;
    height: 88px;
    right: 25px;
    bottom: -45px;
    border-radius: 50%;
    opacity: 0.20;
}

.evmon-summary-card > * {
    position: relative;
    z-index: 2;
}

/* Host Events */
.evmon-summary-card:nth-child(1) {
    background: linear-gradient(135deg, #ffffff 0%, #f3e8ff 55%, #fae8ff 100%) !important;
}

.evmon-summary-card:nth-child(1)::before {
    background: #8b5cf6;
}

.evmon-summary-card:nth-child(1)::after {
    background: #d946ef;
}

/* Network Events */
.evmon-summary-card:nth-child(2) {
    background: linear-gradient(135deg, #ffffff 0%, #dbeafe 45%, #f3e8ff 100%) !important;
}

.evmon-summary-card:nth-child(2)::before {
    background: #3b82f6;
}

.evmon-summary-card:nth-child(2)::after {
    background: #8b5cf6;
}

/* Application Events */
.evmon-summary-card:nth-child(3) {
    background: linear-gradient(135deg, #ffffff 0%, #dcfce7 45%, #fae8ff 100%) !important;
}

.evmon-summary-card:nth-child(3)::before {
    background: #22c55e;
}

.evmon-summary-card:nth-child(3)::after {
    background: #d946ef;
}

/* Icon summary */
.evmon-icon {
    background: rgba(255, 255, 255, 0.76) !important;
    color: #8b5cf6 !important;
    box-shadow: 0 12px 25px rgba(168, 85, 247, 0.18);
}

.evmon-summary-card p {
    color: #64748b !important;
}

.evmon-summary-card h2 {
    color: #0f172a !important;
}

.evmon-summary-card span {
    color: #64748b !important;
}

/* ========================= */
/* Event Panels */
/* ========================= */

.evmon-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.88) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
    backdrop-filter: blur(14px);
}

/* Judul panel */
.evmon-panel-title span {
    color: #7c3aed !important;
}

.evmon-panel-title h2 {
    color: #0f172a !important;
}

.evmon-panel-title h2::after {
    content: "";
    display: block;
    width: 50px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

.evmon-panel-title p {
    color: #64748b !important;
}

/* ========================= */
/* Mini Event Cards */
/* ========================= */

.evmon-list-item {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.evmon-list-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
}

.evmon-panel:nth-child(1) .evmon-list-item {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.evmon-panel:nth-child(2) .evmon-list-item {
    background: linear-gradient(135deg, #ffffff, #dbeafe) !important;
}

.evmon-panel:nth-child(3) .evmon-list-item {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.evmon-list-item strong {
    color: #0f172a !important;
}

.evmon-list-item small {
    color: #64748b !important;
}

/* Dot lebih hidup */
.evmon-dot {
    box-shadow: 0 0 0 6px rgba(168, 85, 247, 0.12) !important;
}

/* ========================= */
/* Search & Filter Area */
/* ========================= */

.evmon-search-panel {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.11), transparent 32%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.11), transparent 35%),
        rgba(255, 255, 255, 0.9) !important;
}

.evmon-filter input,
.evmon-filter select {
    background: rgba(255, 255, 255, 0.92) !important;
    border: 1px solid rgba(168, 85, 247, 0.22) !important;
    box-shadow: 0 10px 24px rgba(168, 85, 247, 0.08);
}

.evmon-filter input:focus,
.evmon-filter select:focus {
    border-color: #d946ef !important;
    box-shadow: 0 0 0 4px rgba(217, 70, 239, 0.13) !important;
}

/* ========================= */
/* Table Upgrade */
/* ========================= */

.evmon-table {
    border-collapse: separate !important;
    border-spacing: 0 10px !important;
}

.evmon-table thead tr {
    background: transparent !important;
}

.evmon-table th {
    border-bottom: none !important;
    color: #64748b !important;
    padding-bottom: 10px !important;
}

.evmon-table tbody tr {
    background: rgba(255, 255, 255, 0.76) !important;
    box-shadow: 0 10px 22px rgba(168, 85, 247, 0.07);
    transition: 0.2s ease;
}

.evmon-table tbody tr:nth-child(odd) {
    background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(250,232,255,0.68)) !important;
}

.evmon-table tbody tr:nth-child(even) {
    background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(252,231,243,0.62)) !important;
}

.evmon-table tbody tr:hover {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    transform: translateY(-2px);
}

.evmon-table td {
    border-bottom: none !important;
    color: #0f172a !important;
    padding-top: 18px !important;
    padding-bottom: 18px !important;
}

.evmon-table tbody tr td:first-child {
    border-top-left-radius: 16px;
    border-bottom-left-radius: 16px;
}

.evmon-table tbody tr td:last-child {
    border-top-right-radius: 16px;
    border-bottom-right-radius: 16px;
}

/* Badge type */
.evmon-type-host {
    background: #f3e8ff !important;
    color: #7c3aed !important;
}

.evmon-type-network {
    background: #dbeafe !important;
    color: #2563eb !important;
}

.evmon-type-application {
    background: #dcfce7 !important;
    color: #059669 !important;
}

/* Badge status */
.evmon-critical {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.evmon-warning {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.evmon-normal {
    background: #dcfce7 !important;
    color: #059669 !important;
}

/* ========================= */
/* Dark Mode */
/* ========================= */

body.dark-mode .main,
body.dark .main,
body.dark-theme .main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.18), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 35%),
        linear-gradient(135deg, #0f172a 0%, #1e1b4b 48%, #3b123c 100%) !important;
}

body.dark-mode .evmon-summary-card,
body.dark .evmon-summary-card,
body.dark-theme .evmon-summary-card,
body.dark-mode .evmon-panel,
body.dark .evmon-panel,
body.dark-theme .evmon-panel {
    background: linear-gradient(135deg, #111827 0%, #2e174f 100%) !important;
    border-color: #3b2a55 !important;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28) !important;
}

body.dark-mode .evmon-list-item,
body.dark .evmon-list-item,
body.dark-theme .evmon-list-item,
body.dark-mode .evmon-table tbody tr,
body.dark .evmon-table tbody tr,
body.dark-theme .evmon-table tbody tr {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .evmon-heading h1,
body.dark .evmon-heading h1,
body.dark-theme .evmon-heading h1,
body.dark-mode .evmon-summary-card h2,
body.dark .evmon-summary-card h2,
body.dark-theme .evmon-summary-card h2,
body.dark-mode .evmon-panel-title h2,
body.dark .evmon-panel-title h2,
body.dark-theme .evmon-panel-title h2,
body.dark-mode .evmon-list-item strong,
body.dark .evmon-list-item strong,
body.dark-theme .evmon-list-item strong,
body.dark-mode .evmon-table td,
body.dark .evmon-table td,
body.dark-theme .evmon-table td {
    color: #f8fafc !important;
}

body.dark-mode .evmon-heading p,
body.dark .evmon-heading p,
body.dark-theme .evmon-heading p,
body.dark-mode .evmon-summary-card p,
body.dark .evmon-summary-card p,
body.dark-theme .evmon-summary-card p,
body.dark-mode .evmon-summary-card span,
body.dark .evmon-summary-card span,
body.dark-theme .evmon-summary-card span,
body.dark-mode .evmon-panel-title p,
body.dark .evmon-panel-title p,
body.dark-theme .evmon-panel-title p,
body.dark-mode .evmon-list-item small,
body.dark .evmon-list-item small,
body.dark-theme .evmon-list-item small,
body.dark-mode .evmon-table th,
body.dark .evmon-table th,
body.dark-theme .evmon-table th {
    color: #94a3b8 !important;
}

body.dark-mode .evmon-filter input,
body.dark-mode .evmon-filter select,
body.dark .evmon-filter input,
body.dark .evmon-filter select,
body.dark-theme .evmon-filter input,
body.dark-theme .evmon-filter select {
    background: #162033 !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('evmonSearch');
        const typeFilter = document.getElementById('evmonTypeFilter');
        const statusFilter = document.getElementById('evmonStatusFilter');
        const rows = document.querySelectorAll('#evmonTableBody tr');

        function filterEvents() {
            const searchValue = searchInput.value.toLowerCase();
            const selectedType = typeFilter.value;
            const selectedStatus = statusFilter.value;

            rows.forEach(function (row) {
                const rowText = row.innerText.toLowerCase();
                const rowType = row.getAttribute('data-type');
                const rowStatus = row.getAttribute('data-status');

                const matchSearch = rowText.includes(searchValue);
                const matchType = selectedType === 'all' || rowType === selectedType;
                const matchStatus = selectedStatus === 'all' || rowStatus === selectedStatus;

                row.style.display = matchSearch && matchType && matchStatus ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterEvents);
        typeFilter.addEventListener('change', filterEvents);
        statusFilter.addEventListener('change', filterEvents);
    });
</script>
@endsection