@extends('layouts.app-dashboard')

@section('content')
<div class="alert-management-page">

    <div class="page-heading">
        <div>
            <h1>Alert Management</h1>
            <p>Review alert severity, current status, and detailed security event information.</p>
        </div>
    </div>

    <div class="alert-top-grid">

        <section class="alert-panel alert-list-panel">
            <div class="panel-title">
                <span>Alert List</span>
                <h2>Security Alerts</h2>
                <p>Latest alerts detected from monitored endpoints and network activity.</p>
            </div>

            <div class="alert-list">
                <button class="alert-item active" data-alert="1">
                    <div class="alert-main">
                        <span class="severity-dot critical"></span>
                        <div>
                            <strong>Brute Force Login Attempt</strong>
                            <small>Source IP: 192.168.1.20</small>
                        </div>
                    </div>
                    <span class="status-pill open">Open</span>
                </button>

                <button class="alert-item" data-alert="2">
                    <div class="alert-main">
                        <span class="severity-dot high"></span>
                        <div>
                            <strong>SQL Injection Detected</strong>
                            <small>Target: Database Server</small>
                        </div>
                    </div>
                    <span class="status-pill open">Open</span>
                </button>

                <button class="alert-item" data-alert="3">
                    <div class="alert-main">
                        <span class="severity-dot medium"></span>
                        <div>
                            <strong>Port Scan Activity</strong>
                            <small>Source IP: 192.168.1.30</small>
                        </div>
                    </div>
                    <span class="status-pill progress">In Progress</span>
                </button>

                <button class="alert-item" data-alert="4">
                    <div class="alert-main">
                        <span class="severity-dot low"></span>
                        <div>
                            <strong>Malware Signature Found</strong>
                            <small>Target: Endpoint Client</small>
                        </div>
                    </div>
                    <span class="status-pill closed">Closed</span>
                </button>
            </div>
        </section>

        <section class="alert-panel">
            <div class="panel-title">
                <span>Alert Severity</span>
                <h2>Severity Level</h2>
                <p>Alert priority based on risk impact.</p>
            </div>

            <div class="severity-stack">
                <div class="severity-row">
                    <div>
                        <span class="severity-dot critical"></span>
                        <strong>Critical</strong>
                    </div>
                    <b>1</b>
                </div>

                <div class="severity-row">
                    <div>
                        <span class="severity-dot high"></span>
                        <strong>High</strong>
                    </div>
                    <b>1</b>
                </div>

                <div class="severity-row">
                    <div>
                        <span class="severity-dot medium"></span>
                        <strong>Medium</strong>
                    </div>
                    <b>1</b>
                </div>

                <div class="severity-row">
                    <div>
                        <span class="severity-dot low"></span>
                        <strong>Low</strong>
                    </div>
                    <b>1</b>
                </div>
            </div>
        </section>

    </div>

    <div class="alert-bottom-grid">

        <section class="alert-panel">
            <div class="panel-title">
                <span>Alert Status</span>
                <h2>Current Status</h2>
                <p>Handling progress of active security alerts.</p>
            </div>

            <div class="status-summary">
                <div class="status-box open-box">
                    <small>Open</small>
                    <strong>2</strong>
                </div>

                <div class="status-box progress-box">
                    <small>In Progress</small>
                    <strong>1</strong>
                </div>

                <div class="status-box closed-box">
                    <small>Closed</small>
                    <strong>1</strong>
                </div>
            </div>

            <div class="status-note">
                <span></span>
                <p>Open alerts require analyst review before response action is completed.</p>
            </div>
        </section>

        <section class="alert-panel alert-details-panel">
            <div class="panel-title">
                <span>Alert Details</span>
                <h2 id="detailTitle">Brute Force Login Attempt</h2>
                <p id="detailDescription">
                    Multiple failed login attempts were detected from one source address.
                </p>
            </div>

            <div class="detail-grid">
                <div class="detail-item">
                    <small>Severity</small>
                    <strong id="detailSeverity" class="critical-text">Critical</strong>
                </div>

                <div class="detail-item">
                    <small>Status</small>
                    <strong id="detailStatus">Open</strong>
                </div>

                <div class="detail-item">
                    <small>Source IP</small>
                    <strong id="detailSource">192.168.1.20</strong>
                </div>

                <div class="detail-item">
                    <small>Target</small>
                    <strong id="detailTarget">Web Server</strong>
                </div>

                <div class="detail-item">
                    <small>Time</small>
                    <strong id="detailTime">2 minutes ago</strong>
                </div>

                <div class="detail-item">
                    <small>Recommendation</small>
                    <strong id="detailAction">Review login activity</strong>
                </div>
            </div>
        </section>

    </div>

</div>

<style>
    .alert-management-page {
        width: 100%;
        animation: alertFadeIn 0.45s ease;
    }

    @keyframes alertFadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-heading {
        margin-bottom: 26px;
    }

    .page-heading h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 850;
        letter-spacing: -0.7px;
        color: #111827;
    }

    .page-heading p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 15px;
    }

    .alert-top-grid {
        display: grid;
        grid-template-columns: 1.45fr 0.75fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .alert-bottom-grid {
        display: grid;
        grid-template-columns: 0.8fr 1.4fr;
        gap: 22px;
    }

    .alert-panel {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #e6e8ef;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.055);
    }

    .panel-title {
        margin-bottom: 20px;
    }

    .panel-title span {
        display: block;
        color: #7c3aed;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .panel-title h2 {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .panel-title p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .alert-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .alert-item {
        width: 100%;
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        cursor: pointer;
        text-align: left;
        transition: 0.2s ease;
    }

    .alert-item:hover,
    .alert-item.active {
        border-color: #c084fc;
        background: #faf5ff;
        transform: translateY(-1px);
    }

    .alert-main {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .alert-main strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .alert-main small {
        display: block;
        margin-top: 4px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .severity-dot {
        width: 11px;
        height: 11px;
        border-radius: 999px;
        display: inline-block;
        flex-shrink: 0;
    }

    .severity-dot.critical {
        background: #ef4444;
        box-shadow: 0 0 0 5px rgba(239, 68, 68, 0.12);
    }

    .severity-dot.high {
        background: #f97316;
        box-shadow: 0 0 0 5px rgba(249, 115, 22, 0.12);
    }

    .severity-dot.medium {
        background: #f59e0b;
        box-shadow: 0 0 0 5px rgba(245, 158, 11, 0.12);
    }

    .severity-dot.low {
        background: #22c55e;
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.12);
    }

    .status-pill {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
    }

    .status-pill.open {
        background: #fee2e2;
        color: #dc2626;
    }

    .status-pill.progress {
        background: #dbeafe;
        color: #2563eb;
    }

    .status-pill.closed {
        background: #dcfce7;
        color: #059669;
    }

    .severity-stack {
        display: flex;
        flex-direction: column;
        border-top: 1px solid #edf0f5;
    }

    .severity-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 17px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .severity-row div {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .severity-row strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .severity-row b {
        color: #0f172a;
        font-size: 18px;
        font-weight: 900;
    }

    .status-summary {
        display: grid;
        grid-template-columns: 1fr;
        gap: 13px;
        margin-bottom: 18px;
    }

    .status-box {
        border-radius: 16px;
        padding: 17px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-box small {
        font-size: 13px;
        font-weight: 850;
    }

    .status-box strong {
        font-size: 26px;
        font-weight: 950;
    }

    .open-box {
        background: #fef2f2;
        color: #dc2626;
    }

    .progress-box {
        background: #eff6ff;
        color: #2563eb;
    }

    .closed-box {
        background: #ecfdf5;
        color: #059669;
    }

    .status-note {
        display: flex;
        gap: 12px;
        padding: 16px;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        background: #ffffff;
    }

    .status-note span {
        width: 9px;
        height: 9px;
        margin-top: 5px;
        border-radius: 50%;
        background: #8b5cf6;
        flex-shrink: 0;
    }

    .status-note p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 600;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }

    .detail-item {
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 16px;
        background: #ffffff;
    }

    .detail-item small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .detail-item strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .critical-text {
        color: #dc2626 !important;
    }

    .high-text {
        color: #ea580c !important;
    }

    .medium-text {
        color: #d97706 !important;
    }

    .low-text {
        color: #059669 !important;
    }

    @media (max-width: 1100px) {
        .alert-top-grid,
        .alert-bottom-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .alert-panel {
            padding: 20px;
            border-radius: 16px;
        }

        .alert-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
    /* ================================================= */
/* Alert Management - Pink Purple UI Upgrade */
/* Paste paling bawah CSS alert-management.blade.php */
/* ================================================= */

.alert-management-page {
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
.page-heading h1 {
    color: #0f172a !important;
}

.page-heading p {
    color: #64748b !important;
}

/* Panel utama */
.alert-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
    backdrop-filter: blur(14px);
}

/* Title panel */
.panel-title span {
    color: #7c3aed !important;
}

.panel-title h2 {
    color: #0f172a !important;
}

.panel-title h2::after {
    content: "";
    display: block;
    width: 52px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

.panel-title p {
    color: #64748b !important;
}

/* Alert List */
.alert-item {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.alert-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.alert-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.alert-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.alert-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.alert-item:hover,
.alert-item.active {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    border-color: #a855f7 !important;
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.15);
}

.alert-main strong {
    color: #0f172a !important;
}

.alert-main small {
    color: #64748b !important;
}

/* Severity Level */
.severity-row {
    border-bottom: 1px solid rgba(168, 85, 247, 0.15) !important;
    padding-left: 10px !important;
    padding-right: 10px !important;
    border-radius: 14px;
    transition: 0.2s ease;
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
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.severity-row strong,
.severity-row b {
    color: #0f172a !important;
}

/* Status Box */
.status-box {
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
}

.open-box {
    background: linear-gradient(135deg, #fff1f2, #fee2e2) !important;
}

.progress-box {
    background: linear-gradient(135deg, #eff6ff, #dbeafe) !important;
}

.closed-box {
    background: linear-gradient(135deg, #ecfdf5, #dcfce7) !important;
}

/* Status Note */
.status-note {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
}

/* Alert Details */
.detail-item {
    background: linear-gradient(135deg, #ffffff, #fbf5ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
    transition: 0.2s ease;
}

.detail-item:nth-child(1),
.detail-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.detail-item:nth-child(3),
.detail-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.detail-item:nth-child(5),
.detail-item:nth-child(6) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.detail-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.13);
}

.detail-item small {
    color: #94a3b8 !important;
}

.detail-item strong {
    color: #0f172a !important;
}

/* Badge status */
.status-pill.open {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.status-pill.progress {
    background: #dbeafe !important;
    color: #2563eb !important;
}

.status-pill.closed {
    background: #dcfce7 !important;
    color: #059669 !important;
}

/* Dark Mode */
body.dark-mode .main,
body.dark .main,
body.dark-theme .main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.18), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 35%),
        linear-gradient(135deg, #0f172a 0%, #1e1b4b 48%, #3b123c 100%) !important;
}

body.dark-mode .alert-panel,
body.dark .alert-panel,
body.dark-theme .alert-panel,
body.dark-mode .alert-item,
body.dark .alert-item,
body.dark-theme .alert-item,
body.dark-mode .severity-row,
body.dark .severity-row,
body.dark-theme .severity-row,
body.dark-mode .detail-item,
body.dark .detail-item,
body.dark-theme .detail-item,
body.dark-mode .status-note,
body.dark .status-note,
body.dark-theme .status-note {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}

body.dark-mode .page-heading h1,
body.dark .page-heading h1,
body.dark-theme .page-heading h1,
body.dark-mode .panel-title h2,
body.dark .panel-title h2,
body.dark-theme .panel-title h2,
body.dark-mode .alert-main strong,
body.dark .alert-main strong,
body.dark-theme .alert-main strong,
body.dark-mode .severity-row strong,
body.dark .severity-row strong,
body.dark-theme .severity-row strong,
body.dark-mode .severity-row b,
body.dark .severity-row b,
body.dark-theme .severity-row b,
body.dark-mode .detail-item strong,
body.dark .detail-item strong,
body.dark-theme .detail-item strong {
    color: #f8fafc !important;
}

body.dark-mode .page-heading p,
body.dark .page-heading p,
body.dark-theme .page-heading p,
body.dark-mode .panel-title p,
body.dark .panel-title p,
body.dark-theme .panel-title p,
body.dark-mode .alert-main small,
body.dark .alert-main small,
body.dark-theme .alert-main small,
body.dark-mode .detail-item small,
body.dark .detail-item small,
body.dark-theme .detail-item small {
    color: #94a3b8 !important;
}
</style>

<script>
    const alerts = {
        1: {
            title: 'Brute Force Login Attempt',
            description: 'Multiple failed login attempts were detected from one source address.',
            severity: 'Critical',
            severityClass: 'critical-text',
            status: 'Open',
            source: '192.168.1.20',
            target: 'Web Server',
            time: '2 minutes ago',
            action: 'Review login activity'
        },
        2: {
            title: 'SQL Injection Detected',
            description: 'Suspicious SQL pattern was detected against the database endpoint.',
            severity: 'High',
            severityClass: 'high-text',
            status: 'Open',
            source: '192.168.1.15',
            target: 'Database Server',
            time: '10 minutes ago',
            action: 'Inspect database request log'
        },
        3: {
            title: 'Port Scan Activity',
            description: 'Multiple ports were scanned from an external network source.',
            severity: 'Medium',
            severityClass: 'medium-text',
            status: 'In Progress',
            source: '192.168.1.30',
            target: 'Firewall Node',
            time: '30 minutes ago',
            action: 'Validate firewall rule'
        },
        4: {
            title: 'Malware Signature Found',
            description: 'A known malware signature was detected on an endpoint device.',
            severity: 'Low',
            severityClass: 'low-text',
            status: 'Closed',
            source: '192.168.1.45',
            target: 'Endpoint Client',
            time: '1 hour ago',
            action: 'Confirm endpoint cleanup'
        }
    };

    const alertItems = document.querySelectorAll('.alert-item');

    alertItems.forEach(item => {
        item.addEventListener('click', () => {
            alertItems.forEach(alert => alert.classList.remove('active'));
            item.classList.add('active');

            const data = alerts[item.dataset.alert];

            document.getElementById('detailTitle').textContent = data.title;
            document.getElementById('detailDescription').textContent = data.description;
            document.getElementById('detailSeverity').textContent = data.severity;
            document.getElementById('detailSeverity').className = data.severityClass;
            document.getElementById('detailStatus').textContent = data.status;
            document.getElementById('detailSource').textContent = data.source;
            document.getElementById('detailTarget').textContent = data.target;
            document.getElementById('detailTime').textContent = data.time;
            document.getElementById('detailAction').textContent = data.action;
        });
    });
</script>
@endsection