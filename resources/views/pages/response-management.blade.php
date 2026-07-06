@extends('layouts.app-dashboard')

@section('content')
<div class="response-management-page">

    <div class="page-heading">
        <div>
            <h1>Response Management</h1>
            <p>Manage blocked IP addresses, review response actions, and unblock trusted sources.</p>
        </div>
    </div>

    <div class="response-layout">

        <section class="response-panel blocked-ip-panel">
            <div class="response-panel-title">
                <span>Blocked IP Management</span>
                <h2>IP Response List</h2>
                <p>Manage suspicious IP addresses using block and unblock actions.</p>
            </div>

            <div class="blocked-ip-list" id="blockedIpList">

                <div class="blocked-ip-item selected" data-ip="192.168.1.20" data-reason="Brute Force Login Attempt" data-status="blocked">
                    <div class="ip-main">
                        <div class="ip-icon critical">IP</div>
                        <div>
                            <strong>192.168.1.20</strong>
                            <small>Brute Force Login Attempt</small>
                        </div>
                    </div>

                    <div class="ip-meta">
                        <span class="block-status blocked">Blocked</span>
                        <button type="button" class="block-btn" disabled>Block</button>
                        <button type="button" class="unblock-btn">Unblock</button>
                    </div>
                </div>

                <div class="blocked-ip-item" data-ip="192.168.1.15" data-reason="SQL Injection Detected" data-status="blocked">
                    <div class="ip-main">
                        <div class="ip-icon high">IP</div>
                        <div>
                            <strong>192.168.1.15</strong>
                            <small>SQL Injection Detected</small>
                        </div>
                    </div>

                    <div class="ip-meta">
                        <span class="block-status blocked">Blocked</span>
                        <button type="button" class="block-btn" disabled>Block</button>
                        <button type="button" class="unblock-btn">Unblock</button>
                    </div>
                </div>

                <div class="blocked-ip-item" data-ip="192.168.1.30" data-reason="Port Scan Activity" data-status="unblocked">
                    <div class="ip-main">
                        <div class="ip-icon medium">IP</div>
                        <div>
                            <strong>192.168.1.30</strong>
                            <small>Port Scan Activity</small>
                        </div>
                    </div>

                    <div class="ip-meta">
                        <span class="block-status unblocked">Unblocked</span>
                        <button type="button" class="block-btn">Block</button>
                        <button type="button" class="unblock-btn" disabled>Unblock</button>
                    </div>
                </div>

                <div class="blocked-ip-item" data-ip="192.168.1.45" data-reason="Malware Communication Attempt" data-status="blocked">
                    <div class="ip-main">
                        <div class="ip-icon low">IP</div>
                        <div>
                            <strong>192.168.1.45</strong>
                            <small>Malware Communication Attempt</small>
                        </div>
                    </div>

                    <div class="ip-meta">
                        <span class="block-status blocked">Blocked</span>
                        <button type="button" class="block-btn" disabled>Block</button>
                        <button type="button" class="unblock-btn">Unblock</button>
                    </div>
                </div>

            </div>
        </section>

        <section class="response-panel unblock-action-panel">
            <div class="response-panel-title">
                <span>Unblock Action</span>
                <h2>Selected Response</h2>
                <p>Review the selected source before applying a response action.</p>
            </div>

            <div class="unblock-card">
                <div class="selected-ip-box">
                    <small>Selected IP</small>
                    <strong id="selectedIp">192.168.1.20</strong>
                </div>

                <div class="selected-detail">
                    <div>
                        <small>Block Reason</small>
                        <strong id="selectedReason">Brute Force Login Attempt</strong>
                    </div>

                    <div>
                        <small>Response Status</small>
                        <strong id="selectedStatus">Blocked</strong>
                    </div>

                    <div>
                        <small>Action Type</small>
                        <strong id="selectedAction">Ready to unblock</strong>
                    </div>
                </div>

                <button type="button" class="confirm-unblock-btn" id="confirmActionBtn">
                    Confirm Unblock
                </button>
            </div>
        </section>

    </div>

    <section class="response-panel response-history-panel">
        <div class="response-panel-title">
            <span>Response History</span>
            <h2>Recent Response Actions</h2>
            <p>History of blocked and unblocked IP actions from the response module.</p>
        </div>

        <div class="response-history-list" id="responseHistoryList">
            <div class="history-row">
                <div class="history-left">
                    <span class="history-dot blocked"></span>
                    <div>
                        <strong>192.168.1.20 blocked</strong>
                        <small>Brute Force Login Attempt</small>
                    </div>
                </div>
                <b>2 minutes ago</b>
            </div>

            <div class="history-row">
                <div class="history-left">
                    <span class="history-dot blocked"></span>
                    <div>
                        <strong>192.168.1.15 blocked</strong>
                        <small>SQL Injection Detected</small>
                    </div>
                </div>
                <b>10 minutes ago</b>
            </div>

            <div class="history-row">
                <div class="history-left">
                    <span class="history-dot unblocked"></span>
                    <div>
                        <strong>192.168.1.30 unblocked</strong>
                        <small>Port Scan Activity</small>
                    </div>
                </div>
                <b>30 minutes ago</b>
            </div>
        </div>
    </section>

</div>

<style>
    .response-management-page {
        width: 100%;
        animation: responseFadeIn 0.45s ease;
    }

    @keyframes responseFadeIn {
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

    .response-layout {
        display: grid;
        grid-template-columns: 1.35fr 0.75fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .response-panel {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #e6e8ef;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.055);
    }

    .response-panel-title {
        margin-bottom: 20px;
    }

    .response-panel-title span {
        display: block;
        color: #7c3aed;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .response-panel-title h2 {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .response-panel-title p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .blocked-ip-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .blocked-ip-item {
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        transition: 0.2s ease;
        cursor: pointer;
    }

    .blocked-ip-item:hover,
    .blocked-ip-item.selected {
        border-color: #a855f7;
        background: #faf5ff;
        transform: translateY(-1px);
    }

    .ip-main {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .ip-icon {
        width: 46px;
        height: 46px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 900;
        flex-shrink: 0;
    }

    .ip-icon.critical {
        background: #fee2e2;
        color: #dc2626;
    }

    .ip-icon.high {
        background: #ffedd5;
        color: #ea580c;
    }

    .ip-icon.medium {
        background: #fef3c7;
        color: #d97706;
    }

    .ip-icon.low {
        background: #dcfce7;
        color: #059669;
    }

    .ip-main strong {
        display: block;
        color: #0f172a;
        font-size: 15px;
        font-weight: 900;
    }

    .ip-main small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .ip-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .block-status {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
    }

    .block-status.blocked {
        background: #fee2e2;
        color: #dc2626;
    }

    .block-status.unblocked {
        background: #dcfce7;
        color: #059669;
    }

    .block-btn,
    .unblock-btn,
    .confirm-unblock-btn {
        border: none;
        border-radius: 13px;
        font-weight: 850;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .block-btn {
        background: #fee2e2;
        color: #dc2626;
        padding: 9px 13px;
        font-size: 12px;
    }

    .block-btn:hover {
        background: #dc2626;
        color: #ffffff;
    }

    .unblock-btn {
        background: #f3e8ff;
        color: #7c3aed;
        padding: 9px 13px;
        font-size: 12px;
    }

    .unblock-btn:hover {
        background: #7c3aed;
        color: #ffffff;
    }

    .block-btn:disabled,
    .unblock-btn:disabled,
    .confirm-unblock-btn:disabled {
        cursor: not-allowed;
        opacity: 0.45;
    }

    .unblock-card {
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 18px;
    }

    .selected-ip-box {
        padding: 18px;
        border-radius: 16px;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        color: #ffffff;
        margin-bottom: 16px;
    }

    .selected-ip-box small {
        display: block;
        font-size: 12px;
        font-weight: 800;
        opacity: 0.85;
        margin-bottom: 8px;
    }

    .selected-ip-box strong {
        display: block;
        font-size: 25px;
        font-weight: 950;
        letter-spacing: -0.7px;
    }

    .selected-detail {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    .selected-detail div {
        border: 1px solid #edf0f5;
        border-radius: 14px;
        padding: 14px;
        background: #fbfdff;
    }

    .selected-detail small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .selected-detail strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .confirm-unblock-btn {
        width: 100%;
        padding: 14px 16px;
        background: #0f172a;
        color: #ffffff;
        font-size: 14px;
    }

    .confirm-unblock-btn:hover {
        background: #7c3aed;
        transform: translateY(-1px);
    }

    .response-history-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .history-row {
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    }

    .history-left {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .history-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .history-dot.blocked {
        background: #ef4444;
        box-shadow: 0 0 0 5px rgba(239, 68, 68, 0.12);
    }

    .history-dot.unblocked {
        background: #22c55e;
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.12);
    }

    .history-left strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .history-left small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .history-row b {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
    }

    body.dark-mode .response-panel,
    body.dark .response-panel,
    body.dark-theme .response-panel {
        background: #111827 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28) !important;
    }

    body.dark-mode .blocked-ip-item,
    body.dark-mode .unblock-card,
    body.dark-mode .selected-detail div,
    body.dark-mode .history-row,
    body.dark .blocked-ip-item,
    body.dark .unblock-card,
    body.dark .selected-detail div,
    body.dark .history-row,
    body.dark-theme .blocked-ip-item,
    body.dark-theme .unblock-card,
    body.dark-theme .selected-detail div,
    body.dark-theme .history-row {
        background: #162033 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading h1,
    body.dark-mode .response-panel-title h2,
    body.dark-mode .ip-main strong,
    body.dark-mode .selected-detail strong,
    body.dark-mode .history-left strong,
    body.dark .page-heading h1,
    body.dark .response-panel-title h2,
    body.dark .ip-main strong,
    body.dark .selected-detail strong,
    body.dark .history-left strong,
    body.dark-theme .page-heading h1,
    body.dark-theme .response-panel-title h2,
    body.dark-theme .ip-main strong,
    body.dark-theme .selected-detail strong,
    body.dark-theme .history-left strong {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark-mode .response-panel-title p,
    body.dark-mode .ip-main small,
    body.dark-mode .selected-detail small,
    body.dark-mode .history-left small,
    body.dark-mode .history-row b,
    body.dark .page-heading p,
    body.dark .response-panel-title p,
    body.dark .ip-main small,
    body.dark .selected-detail small,
    body.dark .history-left small,
    body.dark .history-row b,
    body.dark-theme .page-heading p,
    body.dark-theme .response-panel-title p,
    body.dark-theme .ip-main small,
    body.dark-theme .selected-detail small,
    body.dark-theme .history-left small,
    body.dark-theme .history-row b {
        color: #94a3b8 !important;
    }

    body.dark-mode .blocked-ip-item:hover,
    body.dark-mode .blocked-ip-item.selected,
    body.dark .blocked-ip-item:hover,
    body.dark .blocked-ip-item.selected,
    body.dark-theme .blocked-ip-item:hover,
    body.dark-theme .blocked-ip-item.selected {
        background: rgba(139, 92, 246, 0.16) !important;
        border-color: #7c3aed !important;
    }

    @media (max-width: 1100px) {
        .response-layout {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .response-panel {
            padding: 20px;
            border-radius: 16px;
        }

        .blocked-ip-item,
        .history-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .ip-meta {
            width: 100%;
            flex-wrap: wrap;
        }
    }
    /* ================================================= */
/* Response Management - Pink Purple UI Upgrade */
/* Paste paling bawah CSS response-management.blade.php */
/* ================================================= */

.response-management-page {
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
.response-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
    backdrop-filter: blur(14px);
}

/* Panel title */
.response-panel-title span {
    color: #7c3aed !important;
}

.response-panel-title h2 {
    color: #0f172a !important;
}

.response-panel-title h2::after {
    content: "";
    display: block;
    width: 52px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

.response-panel-title p {
    color: #64748b !important;
}

/* IP List */
.blocked-ip-item {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.blocked-ip-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.blocked-ip-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.blocked-ip-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.blocked-ip-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.blocked-ip-item:hover,
.blocked-ip-item.selected {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    border-color: #a855f7 !important;
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.15);
}

.ip-main strong {
    color: #0f172a !important;
}

.ip-main small {
    color: #64748b !important;
}

/* IP Icon */
.ip-icon {
    box-shadow: 0 12px 24px rgba(168, 85, 247, 0.12);
}

.ip-icon.critical {
    background: linear-gradient(135deg, #fee2e2, #fff1f2) !important;
    color: #dc2626 !important;
}

.ip-icon.high {
    background: linear-gradient(135deg, #ffedd5, #fff7ed) !important;
    color: #ea580c !important;
}

.ip-icon.medium {
    background: linear-gradient(135deg, #fef3c7, #fff7ed) !important;
    color: #d97706 !important;
}

.ip-icon.low {
    background: linear-gradient(135deg, #dcfce7, #f3e8ff) !important;
    color: #059669 !important;
}

/* Status */
.block-status.blocked {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.block-status.unblocked {
    background: #dcfce7 !important;
    color: #059669 !important;
}

/* Action Buttons */
.block-btn {
    background: linear-gradient(135deg, #fee2e2, #fff1f2) !important;
    color: #dc2626 !important;
    box-shadow: 0 8px 18px rgba(239, 68, 68, 0.10);
}

.block-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #ef4444, #dc2626) !important;
    color: #ffffff !important;
}

.unblock-btn {
    background: linear-gradient(135deg, #f3e8ff, #fce7f3) !important;
    color: #7c3aed !important;
    box-shadow: 0 8px 18px rgba(168, 85, 247, 0.13);
}

.unblock-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    color: #ffffff !important;
}

.block-btn:disabled,
.unblock-btn:disabled {
    opacity: 0.45 !important;
}

/* Selected Response Card */
.unblock-card {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        linear-gradient(135deg, #ffffff, #fbf5ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 14px 30px rgba(168, 85, 247, 0.10);
}

.selected-ip-box {
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, 0.24), transparent 35%),
        linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
    box-shadow: 0 18px 38px rgba(168, 85, 247, 0.24);
}

.selected-detail div {
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
}

.selected-detail div:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.selected-detail div:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.selected-detail div:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.selected-detail small {
    color: #94a3b8 !important;
}

.selected-detail strong {
    color: #0f172a !important;
}

/* Confirm Button */
.confirm-unblock-btn {
    background: linear-gradient(135deg, #111827, #2e174f) !important;
    color: #ffffff !important;
    box-shadow: 0 14px 30px rgba(15, 23, 42, 0.20);
}

.confirm-unblock-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    transform: translateY(-2px);
}

/* Response History */
.response-history-panel {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.11), transparent 32%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.11), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
}

.history-row {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.history-row:nth-child(odd) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.history-row:nth-child(even) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.history-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
}

.history-left strong {
    color: #0f172a !important;
}

.history-left small,
.history-row b {
    color: #64748b !important;
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

body.dark-mode .response-panel,
body.dark .response-panel,
body.dark-theme .response-panel,
body.dark-mode .blocked-ip-item,
body.dark .blocked-ip-item,
body.dark-theme .blocked-ip-item,
body.dark-mode .unblock-card,
body.dark .unblock-card,
body.dark-theme .unblock-card,
body.dark-mode .selected-detail div,
body.dark .selected-detail div,
body.dark-theme .selected-detail div,
body.dark-mode .history-row,
body.dark .history-row,
body.dark-theme .history-row {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}

body.dark-mode .page-heading h1,
body.dark .page-heading h1,
body.dark-theme .page-heading h1,
body.dark-mode .response-panel-title h2,
body.dark .response-panel-title h2,
body.dark-theme .response-panel-title h2,
body.dark-mode .ip-main strong,
body.dark .ip-main strong,
body.dark-theme .ip-main strong,
body.dark-mode .selected-detail strong,
body.dark .selected-detail strong,
body.dark-theme .selected-detail strong,
body.dark-mode .history-left strong,
body.dark .history-left strong,
body.dark-theme .history-left strong {
    color: #f8fafc !important;
}

body.dark-mode .page-heading p,
body.dark .page-heading p,
body.dark-theme .page-heading p,
body.dark-mode .response-panel-title p,
body.dark .response-panel-title p,
body.dark-theme .response-panel-title p,
body.dark-mode .ip-main small,
body.dark .ip-main small,
body.dark-theme .ip-main small,
body.dark-mode .selected-detail small,
body.dark .selected-detail small,
body.dark-theme .selected-detail small,
body.dark-mode .history-left small,
body.dark .history-left small,
body.dark-theme .history-left small,
body.dark-mode .history-row b,
body.dark .history-row b,
body.dark-theme .history-row b {
    color: #94a3b8 !important;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let selectedItem = document.querySelector('.blocked-ip-item.selected');
        const confirmButton = document.getElementById('confirmActionBtn');
        const historyList = document.getElementById('responseHistoryList');

        function updateSelectedPanel(item) {
            selectedItem = item;

            document.querySelectorAll('.blocked-ip-item').forEach(function (row) {
                row.classList.remove('selected');
            });

            item.classList.add('selected');

            const ip = item.dataset.ip;
            const reason = item.dataset.reason;
            const status = item.dataset.status;

            document.getElementById('selectedIp').textContent = ip;
            document.getElementById('selectedReason').textContent = reason;
            document.getElementById('selectedStatus').textContent = status === 'blocked' ? 'Blocked' : 'Unblocked';
            document.getElementById('selectedAction').textContent = status === 'blocked' ? 'Ready to unblock' : 'Ready to block';
            confirmButton.textContent = status === 'blocked' ? 'Confirm Unblock' : 'Confirm Block';
        }

        function applyStatus(item, newStatus) {
            const ip = item.dataset.ip;
            const reason = item.dataset.reason;
            const statusLabel = item.querySelector('.block-status');
            const blockButton = item.querySelector('.block-btn');
            const unblockButton = item.querySelector('.unblock-btn');

            item.dataset.status = newStatus;

            if (newStatus === 'blocked') {
                statusLabel.textContent = 'Blocked';
                statusLabel.className = 'block-status blocked';
                blockButton.disabled = true;
                unblockButton.disabled = false;

                addHistory(ip, reason, 'blocked');
            } else {
                statusLabel.textContent = 'Unblocked';
                statusLabel.className = 'block-status unblocked';
                blockButton.disabled = false;
                unblockButton.disabled = true;

                addHistory(ip, reason, 'unblocked');
            }

            updateSelectedPanel(item);
        }

        function addHistory(ip, reason, action) {
            const row = document.createElement('div');
            row.className = 'history-row';

            const dotClass = action === 'blocked' ? 'blocked' : 'unblocked';

            row.innerHTML =
                '<div class="history-left">' +
                    '<span class="history-dot ' + dotClass + '"></span>' +
                    '<div>' +
                        '<strong>' + ip + ' ' + action + '</strong>' +
                        '<small>' + reason + '</small>' +
                    '</div>' +
                '</div>' +
                '<b>Just now</b>';

            historyList.prepend(row);
        }

        document.querySelectorAll('.blocked-ip-item').forEach(function (item) {
            item.addEventListener('click', function () {
                updateSelectedPanel(item);
            });

            item.querySelector('.block-btn').addEventListener('click', function (event) {
                event.stopPropagation();
                applyStatus(item, 'blocked');
            });

            item.querySelector('.unblock-btn').addEventListener('click', function (event) {
                event.stopPropagation();
                applyStatus(item, 'unblocked');
            });
        });

        confirmButton.addEventListener('click', function () {
            if (!selectedItem) {
                return;
            }

            const currentStatus = selectedItem.dataset.status;

            if (currentStatus === 'blocked') {
                applyStatus(selectedItem, 'unblocked');
            } else {
                applyStatus(selectedItem, 'blocked');
            }
        });

        if (selectedItem) {
            updateSelectedPanel(selectedItem);
        }
    });
</script>
@endsection