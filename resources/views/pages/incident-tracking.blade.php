@extends('layouts.app-dashboard')

@section('content')
<div class="incident-tracking-page">

    <div class="page-heading">
        <div>
            <h1>Incident Tracking</h1>
            <p>Track incident handling, current status, and investigation notes.</p>
        </div>
    </div>

    <div class="incident-layout">

        <!-- Incident Management -->
        <section class="incident-panel incident-management-panel">
            <div class="incident-panel-title">
                <span>Incident Management</span>
                <h2>Active Incidents</h2>
                <p>Security incidents that require monitoring and investigation.</p>
            </div>

            <div class="incident-list">
                <button class="incident-item active" data-incident="1">
                    <div class="incident-main">
                        <div class="incident-code critical">INC-001</div>
                        <div>
                            <strong>Unauthorized Login Attempt</strong>
                            <small>Web Server • 192.168.1.20</small>
                        </div>
                    </div>
                    <span class="incident-status open">Open</span>
                </button>

                <button class="incident-item" data-incident="2">
                    <div class="incident-main">
                        <div class="incident-code high">INC-002</div>
                        <div>
                            <strong>Suspicious Network Traffic</strong>
                            <small>Firewall Node • 192.168.1.30</small>
                        </div>
                    </div>
                    <span class="incident-status progress">In Progress</span>
                </button>

                <button class="incident-item" data-incident="3">
                    <div class="incident-main">
                        <div class="incident-code medium">INC-003</div>
                        <div>
                            <strong>Endpoint Malware Alert</strong>
                            <small>Endpoint Client • 192.168.1.45</small>
                        </div>
                    </div>
                    <span class="incident-status review">Review</span>
                </button>

                <button class="incident-item" data-incident="4">
                    <div class="incident-main">
                        <div class="incident-code low">INC-004</div>
                        <div>
                            <strong>Policy Violation Detected</strong>
                            <small>Analyst Laptop • 192.168.1.55</small>
                        </div>
                    </div>
                    <span class="incident-status closed">Closed</span>
                </button>
            </div>
        </section>

        <!-- Status Tracking -->
        <section class="incident-panel status-tracking-panel">
            <div class="incident-panel-title">
                <span>Status Tracking</span>
                <h2 id="statusTitle">Unauthorized Login Attempt</h2>
                <p id="statusDescription">Incident is still open and waiting for analyst validation.</p>
            </div>

            <div class="status-progress-box">
                <div class="status-current">
                    <small>Current Status</small>
                    <strong id="currentStatus">Open</strong>
                </div>

                <div class="status-progress-track">
                    <div id="statusProgressFill" style="width: 25%;"></div>
                </div>
            </div>

            <div class="status-steps">
                <div class="status-step active" id="stepOpen">
                    <span></span>
                    <div>
                        <strong>Open</strong>
                        <small>Incident detected</small>
                    </div>
                </div>

                <div class="status-step" id="stepProgress">
                    <span></span>
                    <div>
                        <strong>In Progress</strong>
                        <small>Investigation started</small>
                    </div>
                </div>

                <div class="status-step" id="stepReview">
                    <span></span>
                    <div>
                        <strong>Review</strong>
                        <small>Evidence validation</small>
                    </div>
                </div>

                <div class="status-step" id="stepClosed">
                    <span></span>
                    <div>
                        <strong>Closed</strong>
                        <small>Incident resolved</small>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Investigation Notes -->
    <section class="incident-panel investigation-notes-panel">
        <div class="incident-panel-title">
            <span>Investigation Notes</span>
            <h2 id="notesTitle">INC-001 Investigation Notes</h2>
            <p>Record analyst findings and incident investigation details.</p>
        </div>

        <div class="notes-grid">
            <div class="notes-editor">
                <label for="incidentNotes">Notes</label>
                <textarea id="incidentNotes" rows="8">Multiple failed login attempts were detected from source IP 192.168.1.20. Analyst needs to validate authentication logs and confirm whether the activity came from a legitimate user or external attacker.</textarea>
            </div>

            <div class="notes-summary">
                <div class="note-info">
                    <small>Incident ID</small>
                    <strong id="noteIncidentId">INC-001</strong>
                </div>

                <div class="note-info">
                    <small>Affected Asset</small>
                    <strong id="noteAsset">Web Server</strong>
                </div>

                <div class="note-info">
                    <small>Last Update</small>
                    <strong id="noteUpdate">2 minutes ago</strong>
                </div>

                <div class="note-info">
                    <small>Assigned Status</small>
                    <strong id="noteStatus">Open</strong>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
    .incident-tracking-page {
        width: 100%;
        animation: incidentFadeIn 0.45s ease;
    }

    @keyframes incidentFadeIn {
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

    .incident-layout {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .incident-panel {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #e6e8ef;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.055);
    }

    .incident-panel-title {
        margin-bottom: 20px;
    }

    .incident-panel-title span {
        display: block;
        color: #7c3aed;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .incident-panel-title h2 {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .incident-panel-title p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .incident-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .incident-item {
        width: 100%;
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        text-align: left;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .incident-item:hover,
    .incident-item.active {
        border-color: #c084fc;
        background: #faf5ff;
        transform: translateY(-1px);
    }

    .incident-main {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .incident-code {
        width: 64px;
        height: 42px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 900;
        flex-shrink: 0;
    }

    .incident-code.critical {
        background: #fee2e2;
        color: #dc2626;
    }

    .incident-code.high {
        background: #ffedd5;
        color: #ea580c;
    }

    .incident-code.medium {
        background: #fef3c7;
        color: #d97706;
    }

    .incident-code.low {
        background: #dcfce7;
        color: #059669;
    }

    .incident-main strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .incident-main small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .incident-status {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
    }

    .incident-status.open {
        background: #fee2e2;
        color: #dc2626;
    }

    .incident-status.progress {
        background: #dbeafe;
        color: #2563eb;
    }

    .incident-status.review {
        background: #fef3c7;
        color: #d97706;
    }

    .incident-status.closed {
        background: #dcfce7;
        color: #059669;
    }

    .status-progress-box {
        padding: 18px;
        border-radius: 16px;
        border: 1px solid #edf0f5;
        background: #ffffff;
        margin-bottom: 20px;
    }

    .status-current {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        gap: 14px;
    }

    .status-current small {
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
    }

    .status-current strong {
        color: #7c3aed;
        font-size: 18px;
        font-weight: 900;
    }

    .status-progress-track {
        width: 100%;
        height: 9px;
        border-radius: 999px;
        background: #edf0f5;
        overflow: hidden;
    }

    .status-progress-track div {
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #8b5cf6, #d946ef);
        transition: 0.25s ease;
    }

    .status-steps {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .status-step {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 15px;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        background: #ffffff;
    }

    .status-step span {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        margin-top: 5px;
        background: #cbd5e1;
        flex-shrink: 0;
    }

    .status-step.active {
        border-color: #c084fc;
        background: #faf5ff;
    }

    .status-step.active span {
        background: #8b5cf6;
        box-shadow: 0 0 0 5px rgba(139, 92, 246, 0.15);
    }

    .status-step strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .status-step small {
        display: block;
        color: #64748b;
        font-size: 12px;
        margin-top: 4px;
        font-weight: 600;
    }

    .notes-grid {
        display: grid;
        grid-template-columns: 1.3fr 0.7fr;
        gap: 20px;
    }

    .notes-editor {
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 18px;
    }

    .notes-editor label {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
        margin-bottom: 10px;
    }

    .notes-editor textarea {
        width: 100%;
        resize: vertical;
        border: 1px solid #e5e7eb;
        background: #fbfdff;
        border-radius: 14px;
        padding: 14px;
        outline: none;
        color: #0f172a;
        font-size: 14px;
        line-height: 1.7;
        font-weight: 600;
    }

    .notes-editor textarea:focus {
        border-color: #a855f7;
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.12);
    }

    .notes-summary {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .note-info {
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
    }

    .note-info small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .note-info strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    body.dark-mode .incident-panel,
    body.dark .incident-panel,
    body.dark-theme .incident-panel {
        background: #111827 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28) !important;
    }

    body.dark-mode .incident-item,
    body.dark-mode .status-progress-box,
    body.dark-mode .status-step,
    body.dark-mode .notes-editor,
    body.dark-mode .note-info,
    body.dark .incident-item,
    body.dark .status-progress-box,
    body.dark .status-step,
    body.dark .notes-editor,
    body.dark .note-info,
    body.dark-theme .incident-item,
    body.dark-theme .status-progress-box,
    body.dark-theme .status-step,
    body.dark-theme .notes-editor,
    body.dark-theme .note-info {
        background: #162033 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading h1,
    body.dark-mode .incident-panel-title h2,
    body.dark-mode .incident-main strong,
    body.dark-mode .status-step strong,
    body.dark-mode .notes-editor label,
    body.dark-mode .note-info strong,
    body.dark .page-heading h1,
    body.dark .incident-panel-title h2,
    body.dark .incident-main strong,
    body.dark .status-step strong,
    body.dark .notes-editor label,
    body.dark .note-info strong,
    body.dark-theme .page-heading h1,
    body.dark-theme .incident-panel-title h2,
    body.dark-theme .incident-main strong,
    body.dark-theme .status-step strong,
    body.dark-theme .notes-editor label,
    body.dark-theme .note-info strong {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark-mode .incident-panel-title p,
    body.dark-mode .incident-main small,
    body.dark-mode .status-step small,
    body.dark-mode .note-info small,
    body.dark .page-heading p,
    body.dark .incident-panel-title p,
    body.dark .incident-main small,
    body.dark .status-step small,
    body.dark .note-info small,
    body.dark-theme .page-heading p,
    body.dark-theme .incident-panel-title p,
    body.dark-theme .incident-main small,
    body.dark-theme .status-step small,
    body.dark-theme .note-info small {
        color: #94a3b8 !important;
    }

    body.dark-mode .notes-editor textarea,
    body.dark .notes-editor textarea,
    body.dark-theme .notes-editor textarea {
        background: #0f172a !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
    }

    body.dark-mode .status-progress-track,
    body.dark .status-progress-track,
    body.dark-theme .status-progress-track {
        background: #263247 !important;
    }

    body.dark-mode .incident-item:hover,
    body.dark-mode .incident-item.active,
    body.dark-mode .status-step.active,
    body.dark .incident-item:hover,
    body.dark .incident-item.active,
    body.dark .status-step.active,
    body.dark-theme .incident-item:hover,
    body.dark-theme .incident-item.active,
    body.dark-theme .status-step.active {
        background: rgba(139, 92, 246, 0.16) !important;
        border-color: #7c3aed !important;
    }

    @media (max-width: 1100px) {
        .incident-layout,
        .notes-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .incident-panel {
            padding: 20px;
            border-radius: 16px;
        }

        .incident-item {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    /* ================================================= */
/* Incident Tracking - Pink Purple UI Upgrade */
/* Paste paling bawah CSS incident-tracking.blade.php */
/* ================================================= */

.incident-tracking-page {
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

/* Main panels */
.incident-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
    backdrop-filter: blur(14px);
}

/* Panel title */
.incident-panel-title span {
    color: #7c3aed !important;
}

.incident-panel-title h2 {
    color: #0f172a !important;
}

.incident-panel-title h2::after {
    content: "";
    display: block;
    width: 52px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

.incident-panel-title p {
    color: #64748b !important;
}

/* Incident list */
.incident-item {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.incident-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.incident-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.incident-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.incident-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.incident-item:hover,
.incident-item.active {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    border-color: #a855f7 !important;
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.15);
}

.incident-main strong {
    color: #0f172a !important;
}

.incident-main small {
    color: #64748b !important;
}

/* Incident code */
.incident-code {
    box-shadow: 0 12px 24px rgba(168, 85, 247, 0.12);
}

/* Status Tracking box */
.status-progress-box {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 35%),
        linear-gradient(135deg, #ffffff, #f3e8ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 14px 30px rgba(168, 85, 247, 0.10);
}

.status-current small {
    color: #64748b !important;
}

.status-current strong {
    color: #7c3aed !important;
}

.status-progress-track {
    background: rgba(203, 213, 225, 0.55) !important;
}

.status-progress-track div {
    background: linear-gradient(90deg, #8b5cf6, #d946ef, #ec4899) !important;
}

/* Status steps */
.status-step {
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
    transition: 0.2s ease;
}

.status-step:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.status-step:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #dbeafe) !important;
}

.status-step:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.status-step:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.status-step.active {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    border-color: #a855f7 !important;
}

.status-step strong {
    color: #0f172a !important;
}

.status-step small {
    color: #64748b !important;
}

/* Investigation Notes */
.investigation-notes-panel {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.11), transparent 32%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.11), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
}

.notes-editor,
.note-info {
    background: linear-gradient(135deg, #ffffff, #fbf5ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
}

.notes-editor label {
    color: #0f172a !important;
}

.notes-editor textarea {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.08), transparent 34%),
        linear-gradient(135deg, #ffffff, #f8fafc) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    color: #0f172a !important;
    box-shadow: inset 0 8px 18px rgba(168, 85, 247, 0.04);
}

.notes-editor textarea:focus {
    border-color: #d946ef !important;
    box-shadow: 0 0 0 4px rgba(217, 70, 239, 0.13) !important;
}

.note-info:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.note-info:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.note-info:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.note-info:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #ede9fe) !important;
}

.note-info small {
    color: #94a3b8 !important;
}

.note-info strong {
    color: #0f172a !important;
}

/* Badge status */
.incident-status.open {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.incident-status.progress {
    background: #dbeafe !important;
    color: #2563eb !important;
}

.incident-status.review {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.incident-status.closed {
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

body.dark-mode .incident-panel,
body.dark .incident-panel,
body.dark-theme .incident-panel,
body.dark-mode .incident-item,
body.dark .incident-item,
body.dark-theme .incident-item,
body.dark-mode .status-progress-box,
body.dark .status-progress-box,
body.dark-theme .status-progress-box,
body.dark-mode .status-step,
body.dark .status-step,
body.dark-theme .status-step,
body.dark-mode .notes-editor,
body.dark .notes-editor,
body.dark-theme .notes-editor,
body.dark-mode .note-info,
body.dark .note-info,
body.dark-theme .note-info {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}

body.dark-mode .page-heading h1,
body.dark .page-heading h1,
body.dark-theme .page-heading h1,
body.dark-mode .incident-panel-title h2,
body.dark .incident-panel-title h2,
body.dark-theme .incident-panel-title h2,
body.dark-mode .incident-main strong,
body.dark .incident-main strong,
body.dark-theme .incident-main strong,
body.dark-mode .status-step strong,
body.dark .status-step strong,
body.dark-theme .status-step strong,
body.dark-mode .notes-editor label,
body.dark .notes-editor label,
body.dark-theme .notes-editor label,
body.dark-mode .note-info strong,
body.dark .note-info strong,
body.dark-theme .note-info strong {
    color: #f8fafc !important;
}

body.dark-mode .page-heading p,
body.dark .page-heading p,
body.dark-theme .page-heading p,
body.dark-mode .incident-panel-title p,
body.dark .incident-panel-title p,
body.dark-theme .incident-panel-title p,
body.dark-mode .incident-main small,
body.dark .incident-main small,
body.dark-theme .incident-main small,
body.dark-mode .status-step small,
body.dark .status-step small,
body.dark-theme .status-step small,
body.dark-mode .note-info small,
body.dark .note-info small,
body.dark-theme .note-info small {
    color: #94a3b8 !important;
}

body.dark-mode .notes-editor textarea,
body.dark .notes-editor textarea,
body.dark-theme .notes-editor textarea {
    background: #0f172a !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}
</style>

<script>
    const incidentData = {
        1: {
            title: 'Unauthorized Login Attempt',
            description: 'Incident is still open and waiting for analyst validation.',
            status: 'Open',
            progress: '25%',
            steps: ['stepOpen'],
            id: 'INC-001',
            asset: 'Web Server',
            update: '2 minutes ago',
            notes: 'Multiple failed login attempts were detected from source IP 192.168.1.20. Analyst needs to validate authentication logs and confirm whether the activity came from a legitimate user or external attacker.'
        },
        2: {
            title: 'Suspicious Network Traffic',
            description: 'Investigation is currently running on abnormal outbound traffic activity.',
            status: 'In Progress',
            progress: '50%',
            steps: ['stepOpen', 'stepProgress'],
            id: 'INC-002',
            asset: 'Firewall Node',
            update: '12 minutes ago',
            notes: 'Abnormal outbound traffic was detected from the firewall node. Analyst should review firewall logs, source destination patterns, and traffic volume before applying response action.'
        },
        3: {
            title: 'Endpoint Malware Alert',
            description: 'Evidence is being reviewed before the incident is closed.',
            status: 'Review',
            progress: '75%',
            steps: ['stepOpen', 'stepProgress', 'stepReview'],
            id: 'INC-003',
            asset: 'Endpoint Client',
            update: '25 minutes ago',
            notes: 'Malware signature was detected on the endpoint client. Initial isolation has been completed and analyst review is required to confirm cleanup status.'
        },
        4: {
            title: 'Policy Violation Detected',
            description: 'Incident has been handled and marked as resolved.',
            status: 'Closed',
            progress: '100%',
            steps: ['stepOpen', 'stepProgress', 'stepReview', 'stepClosed'],
            id: 'INC-004',
            asset: 'Analyst Laptop',
            update: '1 hour ago',
            notes: 'Policy violation was reviewed and confirmed as low impact. No additional suspicious activity was found after validation.'
        }
    };

    const incidentItems = document.querySelectorAll('.incident-item');
    const stepIds = ['stepOpen', 'stepProgress', 'stepReview', 'stepClosed'];

    incidentItems.forEach(item => {
        item.addEventListener('click', () => {
            incidentItems.forEach(incident => incident.classList.remove('active'));
            item.classList.add('active');

            const data = incidentData[item.dataset.incident];

            document.getElementById('statusTitle').textContent = data.title;
            document.getElementById('statusDescription').textContent = data.description;
            document.getElementById('currentStatus').textContent = data.status;
            document.getElementById('statusProgressFill').style.width = data.progress;

            document.getElementById('notesTitle').textContent = data.id + ' Investigation Notes';
            document.getElementById('incidentNotes').value = data.notes;
            document.getElementById('noteIncidentId').textContent = data.id;
            document.getElementById('noteAsset').textContent = data.asset;
            document.getElementById('noteUpdate').textContent = data.update;
            document.getElementById('noteStatus').textContent = data.status;

            stepIds.forEach(step => {
                document.getElementById(step).classList.remove('active');
            });

            data.steps.forEach(step => {
                document.getElementById(step).classList.add('active');
            });
        });
    });
</script>
@endsection