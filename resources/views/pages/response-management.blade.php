@extends('layouts.app-dashboard')

@section('content')

<div class="blocked-ip-page">

    <div class="page-heading">
        <h1>Blocked IP</h1>
        <p>Manage suspicious IP addresses, block reasons, blocked time, and unblock actions.</p>
    </div>

    <!-- Summary Cards -->
    <div class="blocked-summary-grid">
        <div class="blocked-summary-card red">
            <div class="blocked-icon">IP</div>
            <div>
                <span>Total Blocked IPs</span>
                <h2>84</h2>
                <p>Blocked suspicious sources</p>
            </div>
        </div>

        <div class="blocked-summary-card orange">
            <div class="blocked-icon">NM</div>
            <div>
                <span>Nmap Scan</span>
                <h2>21</h2>
                <p>Reconnaissance attempts</p>
            </div>
        </div>

        <div class="blocked-summary-card purple">
            <div class="blocked-icon">BF</div>
            <div>
                <span>Brute Force</span>
                <h2>38</h2>
                <p>Repeated login attempts</p>
            </div>
        </div>

        <div class="blocked-summary-card green">
            <div class="blocked-icon">UB</div>
            <div>
                <span>Unblocked Today</span>
                <h2>6</h2>
                <p>Trusted sources restored</p>
            </div>
        </div>
    </div>

    <div class="blocked-content-grid">

        <!-- Blocked IP List -->
        <div class="blocked-panel">
            <div class="panel-header">
                <div>
                    <h3>Blocked IP List</h3>
                    <p>Suspicious IP addresses blocked by security response action.</p>
                </div>
            </div>

            <div class="blocked-table-wrapper">
                <table class="blocked-table">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Reason</th>
                            <th>Blocked At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr data-ip="10.67.xx.xx" data-reason="Nmap Reconnaissance" data-status="Blocked">
                            <td>
                                <div class="ip-box">
                                    <div class="ip-avatar red">IP</div>
                                    <div>
                                        <strong>10.67.xx.xx</strong>
                                        <small>External suspicious source</small>
                                    </div>
                                </div>
                            </td>
                            <td>Nmap Reconnaissance</td>
                            <td>11:20</td>
                            <td><span class="ip-status blocked">Blocked</span></td>
                            <td>
                                <button class="unblock-btn" onclick="selectBlockedIP(this)">Unblock</button>
                            </td>
                        </tr>

                        <tr data-ip="192.168.1.20" data-reason="Brute Force Login Attempt" data-status="Blocked">
                            <td>
                                <div class="ip-box">
                                    <div class="ip-avatar purple">IP</div>
                                    <div>
                                        <strong>192.168.1.20</strong>
                                        <small>Web server source</small>
                                    </div>
                                </div>
                            </td>
                            <td>Brute Force Login Attempt</td>
                            <td>11:32</td>
                            <td><span class="ip-status blocked">Blocked</span></td>
                            <td>
                                <button class="unblock-btn" onclick="selectBlockedIP(this)">Unblock</button>
                            </td>
                        </tr>

                        <tr data-ip="192.168.1.45" data-reason="Malware Communication" data-status="Blocked">
                            <td>
                                <div class="ip-box">
                                    <div class="ip-avatar pink">IP</div>
                                    <div>
                                        <strong>192.168.1.45</strong>
                                        <small>Database server source</small>
                                    </div>
                                </div>
                            </td>
                            <td>Malware Communication</td>
                            <td>11:40</td>
                            <td><span class="ip-status blocked">Blocked</span></td>
                            <td>
                                <button class="unblock-btn" onclick="selectBlockedIP(this)">Unblock</button>
                            </td>
                        </tr>

                        <tr data-ip="172.16.xx.xx" data-reason="SQL Injection Attempt" data-status="Blocked">
                            <td>
                                <div class="ip-box">
                                    <div class="ip-avatar orange">IP</div>
                                    <div>
                                        <strong>172.16.xx.xx</strong>
                                        <small>Application request source</small>
                                    </div>
                                </div>
                            </td>
                            <td>SQL Injection Attempt</td>
                            <td>11:46</td>
                            <td><span class="ip-status blocked">Blocked</span></td>
                            <td>
                                <button class="unblock-btn" onclick="selectBlockedIP(this)">Unblock</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Selected IP -->
        <div class="blocked-panel selected-panel">
            <div class="panel-header">
                <div>
                    <h3>Selected IP</h3>
                    <p>Review the selected IP before applying an unblock action.</p>
                </div>
            </div>

            <div class="selected-ip-card">
                <div class="selected-ip-gradient">
                    <span>Selected IP</span>
                    <h2 id="selectedIp">10.67.xx.xx</h2>
                </div>

                <div class="selected-detail-list">
                    <div class="selected-detail">
                        <small>Block Reason</small>
                        <strong id="selectedReason">Nmap Reconnaissance</strong>
                    </div>

                    <div class="selected-detail">
                        <small>Response Status</small>
                        <strong id="selectedStatus">Blocked</strong>
                    </div>

                    <div class="selected-detail">
                        <small>Action Type</small>
                        <strong>Ready to Unblock</strong>
                    </div>
                </div>

                <button class="confirm-unblock-btn" onclick="confirmUnblock()">
                    Confirm Unblock
                </button>
            </div>
        </div>

    </div>

    <!-- Response History -->
    <div class="blocked-panel history-panel">
        <div class="panel-header">
            <div>
                <h3>Response History</h3>
                <p>Latest block and unblock actions recorded by the system.</p>
            </div>
        </div>

        <div class="history-list" id="historyList">
            <div class="history-row">
                <div>
                    <strong>10.67.xx.xx blocked</strong>
                    <small>Nmap Reconnaissance detected</small>
                </div>
                <span>11:20</span>
            </div>

            <div class="history-row">
                <div>
                    <strong>192.168.1.20 blocked</strong>
                    <small>Brute force login attempt</small>
                </div>
                <span>11:32</span>
            </div>

            <div class="history-row">
                <div>
                    <strong>192.168.1.45 blocked</strong>
                    <small>Malware communication detected</small>
                </div>
                <span>11:40</span>
            </div>
        </div>
    </div>

</div>

<style>
    .blocked-ip-page {
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

    .blocked-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .blocked-summary-card {
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

    .blocked-summary-card::before {
        content: "";
        position: absolute;
        width: 110px;
        height: 110px;
        right: -30px;
        top: -34px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.22);
    }

    .blocked-summary-card::after {
        content: "";
        position: absolute;
        width: 88px;
        height: 88px;
        right: 28px;
        bottom: -42px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.17);
    }

    .blocked-summary-card.red {
        background: linear-gradient(135deg, #ffffff, #fee2e2);
    }

    .blocked-summary-card.orange {
        background: linear-gradient(135deg, #ffffff, #ffedd5);
    }

    .blocked-summary-card.purple {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .blocked-summary-card.green {
        background: linear-gradient(135deg, #ffffff, #dcfce7);
    }

    .blocked-icon {
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

    .blocked-summary-card div {
        position: relative;
        z-index: 2;
    }

    .blocked-summary-card span {
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .blocked-summary-card h2 {
        margin: 7px 0 4px;
        color: #0f172a;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .blocked-summary-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .blocked-content-grid {
        display: grid;
        grid-template-columns: 1.45fr 0.85fr;
        gap: 24px;
        align-items: start;
    }

    .blocked-panel {
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

    .blocked-table-wrapper {
        margin-top: 22px;
        overflow-x: auto;
    }

    .blocked-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .blocked-table th {
        text-align: left;
        color: #64748b;
        font-size: 13px;
        font-weight: 950;
        padding: 0 18px 4px;
    }

    .blocked-table td {
        padding: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border-top: 1px solid rgba(168, 85, 247, 0.16);
        border-bottom: 1px solid rgba(168, 85, 247, 0.16);
        color: #0f172a;
        font-size: 14px;
        font-weight: 800;
    }

    .blocked-table tbody tr:nth-child(1) td {
        background: linear-gradient(135deg, #ffffff, #fff7ed);
    }

    .blocked-table tbody tr:nth-child(2) td {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .blocked-table tbody tr:nth-child(3) td {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .blocked-table tbody tr:nth-child(4) td {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .blocked-table td:first-child {
        border-left: 1px solid rgba(168, 85, 247, 0.16);
        border-radius: 18px 0 0 18px;
    }

    .blocked-table td:last-child {
        border-right: 1px solid rgba(168, 85, 247, 0.16);
        border-radius: 0 18px 18px 0;
    }

    .ip-box {
        display: flex;
        align-items: center;
        gap: 13px;
    }

    .ip-avatar {
        width: 45px;
        height: 45px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 10px 24px rgba(168, 85, 247, 0.14);
    }

    .ip-avatar.red {
        color: #dc2626;
        background: linear-gradient(135deg, #fee2e2, #ffffff);
    }

    .ip-avatar.purple {
        color: #7c3aed;
        background: linear-gradient(135deg, #f3e8ff, #ffffff);
    }

    .ip-avatar.pink {
        color: #db2777;
        background: linear-gradient(135deg, #fce7f3, #ffffff);
    }

    .ip-avatar.orange {
        color: #ea580c;
        background: linear-gradient(135deg, #ffedd5, #ffffff);
    }

    .ip-box strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .ip-box small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .ip-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 86px;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .ip-status.blocked {
        color: #dc2626;
        background: #fee2e2;
    }

    .ip-status.unblocked {
        color: #059669;
        background: #dcfce7;
    }

    .unblock-btn {
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px 16px;
        border-radius: 999px;
        color: #7c3aed;
        background: linear-gradient(135deg, #f3e8ff, #fce7f3);
        font-size: 12px;
        font-weight: 950;
        transition: 0.2s ease;
    }

    .unblock-btn:hover:not(:disabled) {
        color: #ffffff;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        transform: translateY(-2px);
    }

    .unblock-btn:disabled {
        opacity: 0.55;
        cursor: not-allowed;
    }

    .selected-ip-card {
        margin-top: 22px;
    }

    .selected-ip-gradient {
        padding: 26px;
        border-radius: 22px;
        color: #ffffff;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.22), transparent 35%),
            linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
        box-shadow: 0 18px 38px rgba(168, 85, 247, 0.24);
    }

    .selected-ip-gradient span {
        display: block;
        color: rgba(255, 255, 255, 0.82);
        font-size: 13px;
        font-weight: 850;
    }

    .selected-ip-gradient h2 {
        margin: 8px 0 0;
        font-size: 30px;
        font-weight: 950;
    }

    .selected-detail-list {
        display: grid;
        gap: 12px;
        margin-top: 16px;
    }

    .selected-detail {
        padding: 16px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 10px 22px rgba(168, 85, 247, 0.06);
    }

    .selected-detail small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 6px;
    }

    .selected-detail strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .confirm-unblock-btn {
        width: 100%;
        margin-top: 16px;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 15px 20px;
        border-radius: 18px;
        color: #ffffff;
        background: linear-gradient(135deg, #111827, #2e174f);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.20);
        font-size: 14px;
        font-weight: 950;
        transition: 0.2s ease;
    }

    .confirm-unblock-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
    }

    .history-panel {
        margin-top: 24px;
    }

    .history-list {
        display: grid;
        gap: 14px;
        margin-top: 20px;
    }

    .history-row {
        display: flex;
        justify-content: space-between;
        gap: 18px;
        align-items: center;
        padding: 18px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
    }

    .history-row:nth-child(odd) {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .history-row:nth-child(even) {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .history-row strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .history-row small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .history-row span {
        color: #7c3aed;
        font-size: 13px;
        font-weight: 950;
        white-space: nowrap;
    }

    body.dark-mode .page-heading h1,
    body.dark .page-heading h1,
    body.dark-theme .page-heading h1,
    body.dark-mode .panel-header h3,
    body.dark .panel-header h3,
    body.dark-theme .panel-header h3,
    body.dark-mode .blocked-summary-card h2,
    body.dark .blocked-summary-card h2,
    body.dark-theme .blocked-summary-card h2,
    body.dark-mode .blocked-table td,
    body.dark .blocked-table td,
    body.dark-theme .blocked-table td,
    body.dark-mode .ip-box strong,
    body.dark .ip-box strong,
    body.dark-theme .ip-box strong,
    body.dark-mode .selected-detail strong,
    body.dark .selected-detail strong,
    body.dark-theme .selected-detail strong,
    body.dark-mode .history-row strong,
    body.dark .history-row strong,
    body.dark-theme .history-row strong {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark .page-heading p,
    body.dark-theme .page-heading p,
    body.dark-mode .panel-header p,
    body.dark .panel-header p,
    body.dark-theme .panel-header p,
    body.dark-mode .blocked-summary-card span,
    body.dark .blocked-summary-card span,
    body.dark-theme .blocked-summary-card span,
    body.dark-mode .blocked-summary-card p,
    body.dark .blocked-summary-card p,
    body.dark-theme .blocked-summary-card p,
    body.dark-mode .blocked-table th,
    body.dark .blocked-table th,
    body.dark-theme .blocked-table th,
    body.dark-mode .ip-box small,
    body.dark .ip-box small,
    body.dark-theme .ip-box small,
    body.dark-mode .history-row small,
    body.dark .history-row small,
    body.dark-theme .history-row small {
        color: #94a3b8 !important;
    }

    body.dark-mode .blocked-panel,
    body.dark .blocked-panel,
    body.dark-theme .blocked-panel,
    body.dark-mode .blocked-summary-card,
    body.dark .blocked-summary-card,
    body.dark-theme .blocked-summary-card,
    body.dark-mode .blocked-table td,
    body.dark .blocked-table td,
    body.dark-theme .blocked-table td,
    body.dark-mode .selected-detail,
    body.dark .selected-detail,
    body.dark-theme .selected-detail,
    body.dark-mode .history-row,
    body.dark .history-row,
    body.dark-theme .history-row {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    @media (max-width: 1200px) {
        .blocked-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .blocked-content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .blocked-summary-grid {
            grid-template-columns: 1fr;
        }

        .history-row {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<script>
    let selectedRow = null;

    function selectBlockedIP(button) {
        selectedRow = button.closest('tr');

        const ip = selectedRow.dataset.ip;
        const reason = selectedRow.dataset.reason;
        const status = selectedRow.dataset.status;

        document.getElementById('selectedIp').innerText = ip;
        document.getElementById('selectedReason').innerText = reason;
        document.getElementById('selectedStatus').innerText = status;
    }

    function confirmUnblock() {
        if (!selectedRow) {
            selectedRow = document.querySelector('.blocked-table tbody tr');
        }

        const ip = selectedRow.dataset.ip;
        const reason = selectedRow.dataset.reason;

        selectedRow.dataset.status = 'Unblocked';

        const statusBadge = selectedRow.querySelector('.ip-status');
        statusBadge.innerText = 'Unblocked';
        statusBadge.classList.remove('blocked');
        statusBadge.classList.add('unblocked');

        const button = selectedRow.querySelector('.unblock-btn');
        button.innerText = 'Unblocked';
        button.disabled = true;

        document.getElementById('selectedStatus').innerText = 'Unblocked';

        const historyList = document.getElementById('historyList');
        const newHistory = document.createElement('div');
        newHistory.className = 'history-row';
        newHistory.innerHTML = `
            <div>
                <strong>${ip} unblocked</strong>
                <small>${reason} marked as trusted source</small>
            </div>
            <span>Now</span>
        `;

        historyList.prepend(newHistory);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const firstButton = document.querySelector('.unblock-btn');
        if (firstButton) {
            selectBlockedIP(firstButton);
        }
    });
</script>

@endsection