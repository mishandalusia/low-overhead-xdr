@extends('layouts.app-dashboard')

@section('content')

<div class="brp-page" id="blockedIpPage">

    <div class="brp-heading">
        <h1>Blocked IP</h1>
        <p>Manage suspicious IP addresses with filters, pending status, block and unblock actions.</p>
    </div>

    <!-- Filter -->
    <div class="brp-filter-panel">
        <div class="brp-filter-group">
            <label>Filter Date</label>
            <input type="date" id="filterDate" onchange="filterBlockedIp()">
        </div>

        <div class="brp-filter-group">
            <label>Filter Alert</label>
            <select id="filterAlert" onchange="filterBlockedIp()">
                <option value="all">All Alerts</option>
                <option value="Nmap Reconnaissance">Nmap Reconnaissance</option>
                <option value="Brute Force Login Attempt">Brute Force Login Attempt</option>
                <option value="Malware Communication">Malware Communication</option>
                <option value="SQL Injection Attempt">SQL Injection Attempt</option>
            </select>
        </div>

        <div class="brp-filter-group">
            <label>Filter Category</label>
            <select id="filterCategory" onchange="filterBlockedIp()">
                <option value="all">All Categories</option>
                <option value="Reconnaissance">Reconnaissance</option>
                <option value="Authentication Attack">Authentication Attack</option>
                <option value="Malware">Malware</option>
                <option value="Web Attack">Web Attack</option>
            </select>
        </div>

        <button type="button" class="brp-reset-btn" onclick="resetBlockedFilter()">Reset Filter</button>
    </div>

    <!-- Summary -->
    <div class="brp-summary-grid">
        <div class="brp-summary-card">
            <span>Total Blocked IPs</span>
            <h2 id="totalBlockedCount">3</h2>
            <p>Currently blocked sources</p>
        </div>

        <div class="brp-summary-card">
            <span>Pending Actions</span>
            <h2 id="pendingCount">0</h2>
            <p>Waiting for confirmation</p>
        </div>

        <div class="brp-summary-card">
            <span>Success Actions</span>
            <h2 id="successCount">0</h2>
            <p>Completed today</p>
        </div>
    </div>

    <div class="brp-main-grid">

        <!-- IP Response List -->
        <div class="brp-panel">
            <div class="brp-panel-header">
                <h3>IP Response List</h3>
                <p>Suspicious IP addresses detected from security alerts.</p>
            </div>

            <div class="brp-list-header">
                <span>Date</span>
                <span>IP Address</span>
                <span>Alert</span>
                <span>Category</span>
                <span>Status</span>
                <span>Action</span>
            </div>

            <div class="brp-ip-list" id="ipList">

                <div class="brp-ip-row purple"
                    data-date="2026-07-15"
                    data-ip="10.67.xx.xx"
                    data-time="11:20"
                    data-alert="Nmap Reconnaissance"
                    data-category="Reconnaissance"
                    data-status="blocked"
                    data-source="External suspicious source"
                >
                    <div>
                        <small>Date</small>
                        <strong>2026-07-15</strong>
                        <em>11:20</em>
                    </div>

                    <div>
                        <small>IP Address</small>
                        <strong>10.67.xx.xx</strong>
                        <em>External suspicious source</em>
                    </div>

                    <div>
                        <small>Alert</small>
                        <strong>Nmap Reconnaissance</strong>
                    </div>

                    <div>
                        <small>Category</small>
                        <strong>Reconnaissance</strong>
                    </div>

                    <div>
                        <span class="brp-status blocked">Blocked</span>
                    </div>

                    <div>
                        <button type="button" class="brp-action-btn unblock" onclick="handleIpAction(this)">Unblock</button>
                    </div>
                </div>

                <div class="brp-ip-row violet"
                    data-date="2026-07-15"
                    data-ip="192.168.1.20"
                    data-time="11:32"
                    data-alert="Brute Force Login Attempt"
                    data-category="Authentication Attack"
                    data-status="blocked"
                    data-source="Web server source"
                >
                    <div>
                        <small>Date</small>
                        <strong>2026-07-15</strong>
                        <em>11:32</em>
                    </div>

                    <div>
                        <small>IP Address</small>
                        <strong>192.168.1.20</strong>
                        <em>Web server source</em>
                    </div>

                    <div>
                        <small>Alert</small>
                        <strong>Brute Force Login Attempt</strong>
                    </div>

                    <div>
                        <small>Category</small>
                        <strong>Authentication Attack</strong>
                    </div>

                    <div>
                        <span class="brp-status blocked">Blocked</span>
                    </div>

                    <div>
                        <button type="button" class="brp-action-btn unblock" onclick="handleIpAction(this)">Unblock</button>
                    </div>
                </div>

                <div class="brp-ip-row red"
                    data-date="2026-07-15"
                    data-ip="192.168.1.45"
                    data-time="11:40"
                    data-alert="Malware Communication"
                    data-category="Malware"
                    data-status="blocked"
                    data-source="Database server source"
                >
                    <div>
                        <small>Date</small>
                        <strong>2026-07-15</strong>
                        <em>11:40</em>
                    </div>

                    <div>
                        <small>IP Address</small>
                        <strong>192.168.1.45</strong>
                        <em>Database server source</em>
                    </div>

                    <div>
                        <small>Alert</small>
                        <strong>Malware Communication</strong>
                    </div>

                    <div>
                        <small>Category</small>
                        <strong>Malware</strong>
                    </div>

                    <div>
                        <span class="brp-status blocked">Blocked</span>
                    </div>

                    <div>
                        <button type="button" class="brp-action-btn unblock" onclick="handleIpAction(this)">Unblock</button>
                    </div>
                </div>

                <div class="brp-ip-row blue"
                    data-date="2026-07-15"
                    data-ip="172.16.xx.xx"
                    data-time="11:46"
                    data-alert="SQL Injection Attempt"
                    data-category="Web Attack"
                    data-status="unblocked"
                    data-source="Application request source"
                >
                    <div>
                        <small>Date</small>
                        <strong>2026-07-15</strong>
                        <em>11:46</em>
                    </div>

                    <div>
                        <small>IP Address</small>
                        <strong>172.16.xx.xx</strong>
                        <em>Application request source</em>
                    </div>

                    <div>
                        <small>Alert</small>
                        <strong>SQL Injection Attempt</strong>
                    </div>

                    <div>
                        <small>Category</small>
                        <strong>Web Attack</strong>
                    </div>

                    <div>
                        <span class="brp-status unblocked">Unblocked</span>
                    </div>

                    <div>
                        <button type="button" class="brp-action-btn block" onclick="handleIpAction(this)">Block</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Detail -->
        <div class="brp-panel brp-action-panel">
            <div class="brp-panel-header">
                <h3>Action Detail</h3>
                <p>Selected IP action process.</p>
            </div>

            <div class="brp-selected-card">
                <div class="brp-selected-hero">
                    <small>Selected IP</small>
                    <h2 id="selectedIp">-</h2>
                </div>

                <div class="brp-detail-box">
                    <small>Alert Type</small>
                    <strong id="selectedAlert">-</strong>
                </div>

                <div class="brp-detail-box">
                    <small>Category</small>
                    <strong id="selectedCategory">-</strong>
                </div>

                <div class="brp-detail-box">
                    <small>Current Process</small>
                    <strong id="selectedProcess">Waiting for action</strong>
                </div>
            </div>
        </div>

    </div>

    <!-- History -->
    <div class="brp-panel brp-history-panel">
        <div class="brp-panel-header">
            <h3>Response History</h3>
            <p>History of block, unblock, pending, and success actions.</p>
        </div>

        <div class="brp-history-list" id="historyList">
            <div class="brp-history-row">
                <div>
                    <strong>10.67.xx.xx blocked</strong>
                    <span>Nmap Reconnaissance • 11:20</span>
                </div>
                <b>Success</b>
            </div>

            <div class="brp-history-row">
                <div>
                    <strong>192.168.1.20 blocked</strong>
                    <span>Brute Force Login Attempt • 11:32</span>
                </div>
                <b>Success</b>
            </div>
        </div>
    </div>

</div>

<style>
    .brp-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .brp-heading {
        margin-bottom: 26px;
    }

    .brp-heading h1 {
        margin: 0;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .brp-heading p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .brp-filter-panel {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 16px;
        align-items: end;
        margin-bottom: 24px;
        padding: 22px 24px;
        border-radius: 26px;
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
            rgba(255, 255, 255, 0.92) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10) !important;
    }

    .brp-filter-panel::after {
        content: "🔎";
        position: absolute;
        right: 30px;
        top: 18px;
        font-size: 52px;
        opacity: 0.07;
        pointer-events: none;
    }

    .brp-filter-group {
        position: relative;
        z-index: 2;
    }

    .brp-filter-group label {
        display: block;
        margin-bottom: 8px;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 900;
    }

    .brp-filter-group input,
    .brp-filter-group select {
        width: 100%;
        height: 50px;
        padding: 0 16px;
        border-radius: 16px;
        border: 1px solid rgba(168, 85, 247, 0.22) !important;
        background: rgba(255, 255, 255, 0.92) !important;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 800;
        outline: none;
    }

    .brp-reset-btn {
        position: relative;
        z-index: 2;
        height: 50px;
        padding: 0 22px;
        border: none;
        border-radius: 16px;
        cursor: pointer;
        color: #ffffff;
        font-size: 13px;
        font-weight: 950;
        background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
        box-shadow: 0 14px 30px rgba(168, 85, 247, 0.22);
    }

    .brp-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .brp-summary-card {
        position: relative;
        overflow: hidden;
        min-height: 126px;
        padding: 24px;
        border-radius: 26px;
        background:
            radial-gradient(circle at top right, rgba(168, 85, 247, 0.20), transparent 36%),
            radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.16), transparent 36%),
            linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10) !important;
    }

    .brp-summary-card::before {
        content: "";
        position: absolute;
        width: 135px;
        height: 135px;
        right: -45px;
        top: -48px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.18);
    }

    .brp-summary-card::after {
        content: "";
        position: absolute;
        width: 95px;
        height: 95px;
        right: 28px;
        bottom: -44px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.15);
    }

    .brp-summary-card span,
    .brp-summary-card h2,
    .brp-summary-card p {
        position: relative;
        z-index: 2;
    }

    .brp-summary-card span {
        color: #64748b !important;
        font-size: 13px;
        font-weight: 900;
    }

    .brp-summary-card h2 {
        margin: 8px 0 4px;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
    }

    .brp-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .brp-main-grid {
        display: grid;
        grid-template-columns: 1.55fr 0.8fr;
        gap: 24px;
        align-items: start;
    }

    .brp-panel {
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

    .brp-panel::before {
        content: "🚫";
        position: absolute;
        top: 18px;
        right: 28px;
        font-size: 58px;
        opacity: 0.08;
        pointer-events: none;
    }

    .brp-action-panel::before {
        content: "🛡️";
    }

    .brp-history-panel::before {
        content: "📜";
    }

    .brp-panel-header {
        position: relative;
        z-index: 2;
        margin-bottom: 24px;
    }

    .brp-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 23px;
        font-weight: 950;
    }

    .brp-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .brp-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .brp-list-header {
        display: grid;
        grid-template-columns: 0.75fr 1.2fr 1.35fr 1.15fr 0.8fr 0.65fr;
        gap: 14px;
        padding: 0 16px 10px;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 950;
    }

    .brp-ip-list {
        display: grid;
        gap: 14px;
    }

    .brp-ip-row {
        display: grid;
        grid-template-columns: 0.75fr 1.2fr 1.35fr 1.15fr 0.8fr 0.65fr;
        align-items: center;
        gap: 14px;
        min-height: 78px;
        padding: 18px 16px;
        border-radius: 20px;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .brp-ip-row.purple {
        background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
    }

    .brp-ip-row.violet {
        background: linear-gradient(135deg, #ffffff, #f8f3ff) !important;
    }

    .brp-ip-row.red {
        background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
    }

    .brp-ip-row.blue {
        background: linear-gradient(135deg, #ffffff, #dbeafe) !important;
    }

    .brp-ip-row small,
    .brp-detail-box small {
        display: block;
        margin-bottom: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 850;
    }

    .brp-ip-row strong,
    .brp-detail-box strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .brp-ip-row em {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-style: normal;
        font-size: 12px;
        font-weight: 700;
    }

    .brp-status {
        display: inline-flex;
        justify-content: center;
        min-width: 92px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .brp-status.blocked {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .brp-status.unblocked {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .brp-status.pending {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .brp-action-btn {
        border: none;
        cursor: pointer;
        min-width: 88px;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
        transition: 0.2s ease;
    }

    .brp-action-btn.unblock {
        background: #f3e8ff !important;
        color: #7c3aed !important;
    }

    .brp-action-btn.block {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .brp-action-btn.pending {
        background: #fef3c7 !important;
        color: #d97706 !important;
        cursor: not-allowed;
    }

    .brp-action-btn:hover:not(.pending) {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
        color: #ffffff !important;
    }

    .brp-selected-card {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 14px;
    }

    .brp-selected-hero {
        position: relative;
        overflow: hidden;
        padding: 24px;
        border-radius: 24px;
        color: #ffffff;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.24), transparent 35%),
            linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
        box-shadow: 0 18px 42px rgba(217, 70, 239, 0.24);
    }

    .brp-selected-hero::after {
        content: "";
        position: absolute;
        width: 115px;
        height: 115px;
        right: -35px;
        bottom: -45px;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
    }

    .brp-selected-hero small {
        display: block;
        color: rgba(255,255,255,0.88) !important;
        font-size: 13px;
        font-weight: 900;
    }

    .brp-selected-hero h2 {
        margin: 10px 0 0;
        color: #ffffff !important;
        font-size: 28px;
        font-weight: 950;
    }

    .brp-detail-box {
        padding: 18px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .brp-history-panel {
        margin-top: 24px;
    }

    .brp-history-list {
        display: grid;
        gap: 14px;
        position: relative;
        z-index: 2;
    }

    .brp-history-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 18px 20px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .brp-history-row strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .brp-history-row span {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .brp-history-row b {
        padding: 9px 14px;
        border-radius: 999px;
        background: #dcfce7 !important;
        color: #059669 !important;
        font-size: 12px;
        font-weight: 950;
    }

    /* =============================== */
    /* DARK MODE AUTO SUPPORT */
    /* =============================== */

    body.dark-mode .brp-heading h1,
    body.dark .brp-heading h1,
    body.dark-theme .brp-heading h1,
    .brp-page.brp-dark .brp-heading h1 {
        color: #ffffff !important;
        text-shadow: 0 5px 18px rgba(15, 23, 42, 0.35);
    }

    body.dark-mode .brp-heading p,
    body.dark .brp-heading p,
    body.dark-theme .brp-heading p,
    .brp-page.brp-dark .brp-heading p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .brp-filter-panel,
    body.dark .brp-filter-panel,
    body.dark-theme .brp-filter-panel,
    body.dark-mode .brp-summary-card,
    body.dark .brp-summary-card,
    body.dark-theme .brp-summary-card,
    body.dark-mode .brp-panel,
    body.dark .brp-panel,
    body.dark-theme .brp-panel,
    .brp-page.brp-dark .brp-filter-panel,
    .brp-page.brp-dark .brp-summary-card,
    .brp-page.brp-dark .brp-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .brp-filter-group input,
    body.dark .brp-filter-group input,
    body.dark-theme .brp-filter-group input,
    body.dark-mode .brp-filter-group select,
    body.dark .brp-filter-group select,
    body.dark-theme .brp-filter-group select,
    .brp-page.brp-dark .brp-filter-group input,
    .brp-page.brp-dark .brp-filter-group select {
        background: #111827 !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }

    body.dark-mode .brp-filter-group label,
    body.dark .brp-filter-group label,
    body.dark-theme .brp-filter-group label,
    body.dark-mode .brp-summary-card span,
    body.dark .brp-summary-card span,
    body.dark-theme .brp-summary-card span,
    body.dark-mode .brp-summary-card p,
    body.dark .brp-summary-card p,
    body.dark-theme .brp-summary-card p,
    body.dark-mode .brp-panel-header p,
    body.dark .brp-panel-header p,
    body.dark-theme .brp-panel-header p,
    body.dark-mode .brp-list-header,
    body.dark .brp-list-header,
    body.dark-theme .brp-list-header,
    .brp-page.brp-dark .brp-filter-group label,
    .brp-page.brp-dark .brp-summary-card span,
    .brp-page.brp-dark .brp-summary-card p,
    .brp-page.brp-dark .brp-panel-header p,
    .brp-page.brp-dark .brp-list-header {
        color: #cbd5e1 !important;
    }

    body.dark-mode .brp-summary-card h2,
    body.dark .brp-summary-card h2,
    body.dark-theme .brp-summary-card h2,
    body.dark-mode .brp-panel-header h3,
    body.dark .brp-panel-header h3,
    body.dark-theme .brp-panel-header h3,
    .brp-page.brp-dark .brp-summary-card h2,
    .brp-page.brp-dark .brp-panel-header h3 {
        color: #ffffff !important;
    }

    body.dark-mode .brp-ip-row.purple,
    body.dark .brp-ip-row.purple,
    body.dark-theme .brp-ip-row.purple,
    .brp-page.brp-dark .brp-ip-row.purple {
        background: linear-gradient(135deg, #111827, #2e1a26) !important;
    }

    body.dark-mode .brp-ip-row.violet,
    body.dark .brp-ip-row.violet,
    body.dark-theme .brp-ip-row.violet,
    .brp-page.brp-dark .brp-ip-row.violet {
        background: linear-gradient(135deg, #111827, #25163d) !important;
    }

    body.dark-mode .brp-ip-row.red,
    body.dark .brp-ip-row.red,
    body.dark-theme .brp-ip-row.red,
    .brp-page.brp-dark .brp-ip-row.red {
        background: linear-gradient(135deg, #111827, #3b1a2c) !important;
    }

    body.dark-mode .brp-ip-row.blue,
    body.dark .brp-ip-row.blue,
    body.dark-theme .brp-ip-row.blue,
    .brp-page.brp-dark .brp-ip-row.blue {
        background: linear-gradient(135deg, #111827, #172554) !important;
    }

    body.dark-mode .brp-ip-row,
    body.dark .brp-ip-row,
    body.dark-theme .brp-ip-row,
    body.dark-mode .brp-detail-box,
    body.dark .brp-detail-box,
    body.dark-theme .brp-detail-box,
    body.dark-mode .brp-history-row,
    body.dark .brp-history-row,
    body.dark-theme .brp-history-row,
    .brp-page.brp-dark .brp-ip-row,
    .brp-page.brp-dark .brp-detail-box,
    .brp-page.brp-dark .brp-history-row {
        border-color: rgba(168, 85, 247, 0.27) !important;
        color: #ffffff !important;
    }

    body.dark-mode .brp-detail-box,
    body.dark .brp-detail-box,
    body.dark-theme .brp-detail-box,
    body.dark-mode .brp-history-row,
    body.dark .brp-history-row,
    body.dark-theme .brp-history-row,
    .brp-page.brp-dark .brp-detail-box,
    .brp-page.brp-dark .brp-history-row {
        background: linear-gradient(135deg, #111827, #241638) !important;
    }

    body.dark-mode .brp-ip-row strong,
    body.dark .brp-ip-row strong,
    body.dark-theme .brp-ip-row strong,
    body.dark-mode .brp-detail-box strong,
    body.dark .brp-detail-box strong,
    body.dark-theme .brp-detail-box strong,
    body.dark-mode .brp-history-row strong,
    body.dark .brp-history-row strong,
    body.dark-theme .brp-history-row strong,
    .brp-page.brp-dark .brp-ip-row strong,
    .brp-page.brp-dark .brp-detail-box strong,
    .brp-page.brp-dark .brp-history-row strong {
        color: #ffffff !important;
    }

    body.dark-mode .brp-ip-row small,
    body.dark .brp-ip-row small,
    body.dark-theme .brp-ip-row small,
    body.dark-mode .brp-ip-row em,
    body.dark .brp-ip-row em,
    body.dark-theme .brp-ip-row em,
    body.dark-mode .brp-detail-box small,
    body.dark .brp-detail-box small,
    body.dark-theme .brp-detail-box small,
    body.dark-mode .brp-history-row span,
    body.dark .brp-history-row span,
    body.dark-theme .brp-history-row span,
    .brp-page.brp-dark .brp-ip-row small,
    .brp-page.brp-dark .brp-ip-row em,
    .brp-page.brp-dark .brp-detail-box small,
    .brp-page.brp-dark .brp-history-row span {
        color: #cbd5e1 !important;
    }

    @media (max-width: 1300px) {
        .brp-main-grid {
            grid-template-columns: 1fr;
        }

        .brp-list-header,
        .brp-ip-row {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media (max-width: 900px) {
        .brp-filter-panel,
        .brp-summary-grid,
        .brp-list-header,
        .brp-ip-row {
            grid-template-columns: 1fr;
        }

        .brp-list-header {
            display: none;
        }
    }

    /* ================================================= */
/* FIX Action Detail supaya ikut dark mode penuh */
/* Paste paling bawah style response-management.blade.php */
/* ================================================= */

body.dark-mode .brp-selected-card,
body.dark .brp-selected-card,
body.dark-theme .brp-selected-card,
.brp-page.brp-dark .brp-selected-card {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
}

/* Hilangkan kotak putih yang membungkus Action Detail */
body.dark-mode .brp-action-panel .brp-selected-card,
body.dark .brp-action-panel .brp-selected-card,
body.dark-theme .brp-action-panel .brp-selected-card,
.brp-page.brp-dark .brp-action-panel .brp-selected-card {
    background: transparent !important;
}

/* Selected IP tetap gradient, tapi tanpa background putih luar */
body.dark-mode .brp-selected-hero,
body.dark .brp-selected-hero,
body.dark-theme .brp-selected-hero,
.brp-page.brp-dark .brp-selected-hero {
    background:
        radial-gradient(circle at top right, rgba(255,255,255,0.22), transparent 35%),
        linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    color: #ffffff !important;
}

/* Detail box dark */
body.dark-mode .brp-detail-box,
body.dark .brp-detail-box,
body.dark-theme .brp-detail-box,
.brp-page.brp-dark .brp-detail-box {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        linear-gradient(135deg, #111827, #241638) !important;
    border: 1px solid rgba(168, 85, 247, 0.28) !important;
    box-shadow: 0 12px 26px rgba(0, 0, 0, 0.18) !important;
    color: #ffffff !important;
}

/* Text detail */
body.dark-mode .brp-detail-box small,
body.dark .brp-detail-box small,
body.dark-theme .brp-detail-box small,
.brp-page.brp-dark .brp-detail-box small {
    color: #cbd5e1 !important;
}

body.dark-mode .brp-detail-box strong,
body.dark .brp-detail-box strong,
body.dark-theme .brp-detail-box strong,
.brp-page.brp-dark .brp-detail-box strong {
    color: #ffffff !important;
}

/* Paksa semua div dalam action detail tidak punya background putih */
body.dark-mode .brp-action-panel div,
body.dark .brp-action-panel div,
body.dark-theme .brp-action-panel div,
.brp-page.brp-dark .brp-action-panel div {
    border-color: rgba(168, 85, 247, 0.28) !important;
}

/* Kalau ada style lama yang kasih background putih */
body.dark-mode .brp-action-panel .selected-detail,
body.dark .brp-action-panel .selected-detail,
body.dark-theme .brp-action-panel .selected-detail,
body.dark-mode .brp-action-panel .selected-card,
body.dark .brp-action-panel .selected-card,
body.dark-theme .brp-action-panel .selected-card {
    background: transparent !important;
    border: none !important;
}
</style>

<script>
    function filterBlockedIp() {
        const date = document.getElementById('filterDate').value;
        const alert = document.getElementById('filterAlert').value;
        const category = document.getElementById('filterCategory').value;

        const rows = document.querySelectorAll('.brp-ip-row');

        rows.forEach(row => {
            const matchDate = !date || row.dataset.date === date;
            const matchAlert = alert === 'all' || row.dataset.alert === alert;
            const matchCategory = category === 'all' || row.dataset.category === category;

            row.style.display = matchDate && matchAlert && matchCategory ? '' : 'none';
        });
    }

    function resetBlockedFilter() {
        document.getElementById('filterDate').value = '';
        document.getElementById('filterAlert').value = 'all';
        document.getElementById('filterCategory').value = 'all';

        filterBlockedIp();
    }

    function updateSummaryCounts() {
        const rows = document.querySelectorAll('.brp-ip-row');

        let blocked = 0;
        let pending = 0;

        rows.forEach(row => {
            if (row.dataset.status === 'blocked') blocked++;
            if (row.dataset.status === 'pending') pending++;
        });

        document.getElementById('totalBlockedCount').innerText = blocked;
        document.getElementById('pendingCount').innerText = pending;
    }

    function setActionDetail(row, processText) {
        document.getElementById('selectedIp').innerText = row.dataset.ip;
        document.getElementById('selectedAlert').innerText = row.dataset.alert;
        document.getElementById('selectedCategory').innerText = row.dataset.category;
        document.getElementById('selectedProcess').innerText = processText;
    }

    function addHistory(ip, alert, action, status) {
        const historyList = document.getElementById('historyList');

        const item = document.createElement('div');
        item.className = 'brp-history-row';
        item.innerHTML = `
            <div>
                <strong>${ip} ${action}</strong>
                <span>${alert} • just now</span>
            </div>
            <b>${status}</b>
        `;

        historyList.prepend(item);
    }

    function handleIpAction(button) {
        const row = button.closest('.brp-ip-row');
        const statusBadge = row.querySelector('.brp-status');

        const currentStatus = row.dataset.status;
        const nextAction = currentStatus === 'blocked' ? 'unblock' : 'block';

        row.dataset.status = 'pending';
        statusBadge.className = 'brp-status pending';
        statusBadge.innerText = 'Pending';

        button.className = 'brp-action-btn pending';
        button.innerText = 'Pending';
        button.disabled = true;

        setActionDetail(row, `${nextAction.charAt(0).toUpperCase() + nextAction.slice(1)} pending`);
        addHistory(row.dataset.ip, row.dataset.alert, `${nextAction} pending`, 'Pending');
        updateSummaryCounts();

        setTimeout(() => {
            if (nextAction === 'unblock') {
                row.dataset.status = 'unblocked';
                statusBadge.className = 'brp-status unblocked';
                statusBadge.innerText = 'Unblocked';

                button.className = 'brp-action-btn block';
                button.innerText = 'Block';
                button.disabled = false;

                setActionDetail(row, 'Unblock success');
                addHistory(row.dataset.ip, row.dataset.alert, 'unblocked', 'Success');
            } else {
                row.dataset.status = 'blocked';
                statusBadge.className = 'brp-status blocked';
                statusBadge.innerText = 'Blocked';

                button.className = 'brp-action-btn unblock';
                button.innerText = 'Unblock';
                button.disabled = false;

                setActionDetail(row, 'Block success');
                addHistory(row.dataset.ip, row.dataset.alert, 'blocked', 'Success');
            }

            const successCount = document.getElementById('successCount');
            successCount.innerText = Number(successCount.innerText) + 1;

            updateSummaryCounts();
        }, 900);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('blockedIpPage');

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

        function syncBlockedTheme() {
            if (!page) return;

            if (isDarkTheme()) {
                page.classList.add('brp-dark');
            } else {
                page.classList.remove('brp-dark');
            }
        }

        syncBlockedTheme();
        updateSummaryCounts();

        const observer = new MutationObserver(syncBlockedTheme);

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
                setTimeout(syncBlockedTheme, 50);
            });
        }

        window.addEventListener('storage', syncBlockedTheme);
    });
</script>

@endsection