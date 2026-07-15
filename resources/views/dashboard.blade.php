@extends('layouts.app-dashboard')

@section('content')

<div class="dashboard-overview-page">

    <div class="page-heading">
        <h1>Dashboard Overview</h1>
        <p>Overview monitoring for events, alerts, incidents, blocked IPs, and threat severity.</p>
    </div>

    <!-- Summary Cards -->
    <div class="dashboard-stats-grid">
        <div class="dashboard-stat-card purple">
            <div class="stat-icon">EV</div>
            <div>
                <span>Total Events</span>
                <h2>12,482</h2>
                <p>Collected security events</p>
            </div>
        </div>

        <div class="dashboard-stat-card pink">
            <div class="stat-icon">AL</div>
            <div>
                <span>Active Alerts</span>
                <h2>38</h2>
                <p>Alerts need attention</p>
            </div>
        </div>

        <div class="dashboard-stat-card yellow">
            <div class="stat-icon">IP</div>
            <div>
                <span>Blocked IPs</span>
                <h2>84</h2>
                <p>Blocked suspicious sources</p>
            </div>
        </div>

        <div class="dashboard-stat-card blue">
            <div class="stat-icon">IN</div>
            <div>
                <span>Open Incidents</span>
                <h2>14</h2>
                <p>Incidents under handling</p>
            </div>
        </div>
    </div>

    <!-- Top Threat + Severity -->
    <div class="dashboard-bottom-grid">

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
                        <small>Repeated login attempts</small>
                    </div>
                    <span>34%</span>
                    <div class="threat-progress">
                        <div style="width: 34%;"></div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>SQL Injection</strong>
                        <small>Suspicious database query pattern</small>
                    </div>
                    <span>26%</span>
                    <div class="threat-progress red">
                        <div style="width: 26%;"></div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>Port Scanning</strong>
                        <small>Multiple port probing activity</small>
                    </div>
                    <span>21%</span>
                    <div class="threat-progress orange">
                        <div style="width: 21%;"></div>
                    </div>
                </div>

                <div class="threat-row">
                    <div>
                        <strong>Malware Communication</strong>
                        <small>Suspicious outbound connection</small>
                    </div>
                    <span>19%</span>
                    <div class="threat-progress green">
                        <div style="width: 19%;"></div>
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

    <!-- Recent Alerts -->
    <div class="dashboard-panel recent-alerts-panel">
        <div class="panel-header">
            <div>
                <h3>Recent Alerts</h3>
                <p>Latest security alerts detected from monitored endpoints.</p>
            </div>
        </div>

        <div class="recent-alert-list">
            <div 
                class="recent-alert-item"
                data-date="2026-07-15"
                data-time="11:20"
                data-alert="Nmap Reconnaissance"
                data-category="Reconnaissance"
                data-source="10.67.xx.xx"
                data-severity="High"
                data-reason="This alert is classified as High because the source performed scanning activity across multiple ports, which indicates reconnaissance behavior before a possible attack."
                data-recommendation="Review the source IP, validate whether the scan is authorized, and block the IP if the activity is suspicious."
            >
                <div class="alert-time">11:20</div>
                <div class="alert-info">
                    <strong>Nmap Reconnaissance</strong>
                    <small>Suspicious network scanning activity detected</small>
                </div>
                <span class="alert-severity high">High</span>
                <div class="alert-source">10.67.xx.xx</div>
                <button class="detail-btn" onclick="showAlertDetail(this)">Detail</button>
            </div>

            <div 
                class="recent-alert-item"
                data-date="2026-07-15"
                data-time="11:25"
                data-alert="Transaction Behaviour Anomaly"
                data-category="Behaviour Anomaly"
                data-source="User A"
                data-severity="Critical"
                data-reason="This alert is classified as Critical because the transaction pattern is highly unusual and may indicate abnormal user behavior or possible account misuse."
                data-recommendation="Check the user activity, validate the transaction pattern, and escalate the incident if the activity is confirmed as suspicious."
            >
                <div class="alert-time">11:25</div>
                <div class="alert-info">
                    <strong>Transaction Behaviour Anomaly</strong>
                    <small>Unusual transaction pattern detected</small>
                </div>
                <span class="alert-severity critical">Critical</span>
                <div class="alert-source">User A</div>
                <button class="detail-btn" onclick="showAlertDetail(this)">Detail</button>
            </div>

            <div 
                class="recent-alert-item"
                data-date="2026-07-15"
                data-time="11:32"
                data-alert="Brute Force Login Attempt"
                data-category="Authentication Attack"
                data-source="192.168.1.20"
                data-severity="Medium"
                data-reason="This alert is classified as Medium because repeated login failures were detected, but there is no confirmed successful unauthorized access yet."
                data-recommendation="Monitor the login activity, apply account protection, and block the source IP if the attempts continue."
            >
                <div class="alert-time">11:32</div>
                <div class="alert-info">
                    <strong>Brute Force Login Attempt</strong>
                    <small>Repeated failed login attempts</small>
                </div>
                <span class="alert-severity medium">Medium</span>
                <div class="alert-source">192.168.1.20</div>
                <button class="detail-btn" onclick="showAlertDetail(this)">Detail</button>
            </div>
        </div>
    </div>

    <!-- Alert History Filter -->
    <div class="dashboard-panel alert-history-panel">
        <div class="panel-header history-header">
            <div>
                <h3>Alert History</h3>
                <p>Historical alerts with date, severity, category, and filtering options.</p>
            </div>
        </div>

        <div class="history-filter-grid">
            <div>
                <label>Filter Date</label>
                <input type="date" id="historyDate" onchange="filterAlertHistory()">
            </div>

            <div>
                <label>Filter Severity</label>
                <select id="historySeverity" onchange="filterAlertHistory()">
                    <option value="all">All Severity</option>
                    <option value="Critical">Critical</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>

            <div>
                <label>Filter Category</label>
                <select id="historyCategory" onchange="filterAlertHistory()">
                    <option value="all">All Categories</option>
                    <option value="Reconnaissance">Reconnaissance</option>
                    <option value="Behaviour Anomaly">Behaviour Anomaly</option>
                    <option value="Authentication Attack">Authentication Attack</option>
                    <option value="Malware">Malware</option>
                    <option value="Web Attack">Web Attack</option>
                </select>
            </div>

            <button type="button" onclick="resetHistoryFilter()" class="reset-history-btn">
                Reset
            </button>
        </div>

        <div class="alert-history-list" id="alertHistoryList">
            <div class="history-alert-row" data-date="2026-07-15" data-severity="High" data-category="Reconnaissance">
                <div>
                    <strong>Nmap Reconnaissance</strong>
                    <small>2026-07-15 • 11:20 • Reconnaissance</small>
                </div>
                <span class="alert-severity high">High</span>
                <button class="detail-btn small" onclick="showHistoryDetail(this)"
                    data-date="2026-07-15"
                    data-time="11:20"
                    data-alert="Nmap Reconnaissance"
                    data-category="Reconnaissance"
                    data-source="10.67.xx.xx"
                    data-severity="High"
                    data-reason="High risk because scanning activity was detected from the source IP."
                    data-recommendation="Validate the source and block it if the scan is unauthorized."
                >Detail</button>
            </div>

            <div class="history-alert-row" data-date="2026-07-15" data-severity="Critical" data-category="Behaviour Anomaly">
                <div>
                    <strong>Transaction Behaviour Anomaly</strong>
                    <small>2026-07-15 • 11:25 • Behaviour Anomaly</small>
                </div>
                <span class="alert-severity critical">Critical</span>
                <button class="detail-btn small" onclick="showHistoryDetail(this)"
                    data-date="2026-07-15"
                    data-time="11:25"
                    data-alert="Transaction Behaviour Anomaly"
                    data-category="Behaviour Anomaly"
                    data-source="User A"
                    data-severity="Critical"
                    data-reason="Critical risk because abnormal transaction behavior may indicate account misuse."
                    data-recommendation="Investigate the user activity and escalate if confirmed suspicious."
                >Detail</button>
            </div>

            <div class="history-alert-row" data-date="2026-07-15" data-severity="Medium" data-category="Authentication Attack">
                <div>
                    <strong>Brute Force Login Attempt</strong>
                    <small>2026-07-15 • 11:32 • Authentication Attack</small>
                </div>
                <span class="alert-severity medium">Medium</span>
                <button class="detail-btn small" onclick="showHistoryDetail(this)"
                    data-date="2026-07-15"
                    data-time="11:32"
                    data-alert="Brute Force Login Attempt"
                    data-category="Authentication Attack"
                    data-source="192.168.1.20"
                    data-severity="Medium"
                    data-reason="Medium risk because repeated failed login attempts were detected."
                    data-recommendation="Monitor the account and apply blocking if attempts continue."
                >Detail</button>
            </div>

            <div class="history-alert-row" data-date="2026-07-14" data-severity="Critical" data-category="Malware">
                <div>
                    <strong>Malware Communication</strong>
                    <small>2026-07-14 • 20:10 • Malware</small>
                </div>
                <span class="alert-severity critical">Critical</span>
                <button class="detail-btn small" onclick="showHistoryDetail(this)"
                    data-date="2026-07-14"
                    data-time="20:10"
                    data-alert="Malware Communication"
                    data-category="Malware"
                    data-source="192.168.1.45"
                    data-severity="Critical"
                    data-reason="Critical risk because the endpoint attempted suspicious outbound communication."
                    data-recommendation="Isolate the endpoint and investigate the malware indicator."
                >Detail</button>
            </div>

            <div class="history-alert-row" data-date="2026-07-14" data-severity="High" data-category="Web Attack">
                <div>
                    <strong>SQL Injection Attempt</strong>
                    <small>2026-07-14 • 21:30 • Web Attack</small>
                </div>
                <span class="alert-severity high">High</span>
                <button class="detail-btn small" onclick="showHistoryDetail(this)"
                    data-date="2026-07-14"
                    data-time="21:30"
                    data-alert="SQL Injection Attempt"
                    data-category="Web Attack"
                    data-source="172.16.xx.xx"
                    data-severity="High"
                    data-reason="High risk because suspicious database query patterns were detected."
                    data-recommendation="Check application logs and strengthen input validation."
                >Detail</button>
            </div>
        </div>
    </div>

</div>

<!-- Alert Detail Modal -->
<div class="alert-detail-modal" id="alertDetailModal">
    <div class="alert-detail-card">
        <button class="modal-close-btn" onclick="closeAlertDetail()">×</button>

        <div class="detail-modal-header">
            <span id="detailSeverityBadge">High</span>
            <h2 id="detailAlertName">Nmap Reconnaissance</h2>
            <p id="detailCategory">Reconnaissance</p>
        </div>

        <div class="detail-modal-grid">
            <div>
                <small>Date</small>
                <strong id="detailDate">-</strong>
            </div>

            <div>
                <small>Time</small>
                <strong id="detailTime">-</strong>
            </div>

            <div>
                <small>Source</small>
                <strong id="detailSource">-</strong>
            </div>

            <div>
                <small>Risk Level</small>
                <strong id="detailRisk">-</strong>
            </div>
        </div>

        <div class="detail-reason-box">
            <small>Reason</small>
            <p id="detailReason">-</p>
        </div>

        <div class="detail-reason-box recommendation">
            <small>Recommendation</small>
            <p id="detailRecommendation">-</p>
        </div>
    </div>
</div>

<style>
    .dashboard-overview-page {
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
    }

    .page-heading p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
        font-weight: 600;
    }

    .dashboard-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .dashboard-stat-card {
        position: relative;
        overflow: hidden;
        min-height: 128px;
        padding: 24px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        gap: 18px;
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10);
    }

    .dashboard-stat-card.purple {
        background: linear-gradient(135deg, #ffffff, #f3e8ff);
    }

    .dashboard-stat-card.pink {
        background: linear-gradient(135deg, #ffffff, #fce7f3);
    }

    .dashboard-stat-card.yellow {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .dashboard-stat-card.blue {
        background: linear-gradient(135deg, #ffffff, #dbeafe);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8b5cf6;
        background: rgba(255, 255, 255, 0.85);
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 14px 30px rgba(168, 85, 247, 0.14);
    }

    .dashboard-stat-card span {
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .dashboard-stat-card h2 {
        margin: 6px 0 4px;
        color: #0f172a;
        font-size: 30px;
        font-weight: 950;
    }

    .dashboard-stat-card p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .dashboard-bottom-grid {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 24px;
        align-items: start;
    }

    .dashboard-panel {
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
        font-size: 21px;
        font-weight: 950;
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

    .threat-list,
    .severity-list,
    .recent-alert-list,
    .alert-history-list {
        display: grid;
        gap: 14px;
        margin-top: 20px;
    }

    .threat-row {
        display: grid;
        grid-template-columns: 1fr 60px 150px;
        align-items: center;
        gap: 18px;
        padding: 18px 20px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
    }

    .threat-row strong,
    .alert-info strong,
    .history-alert-row strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .threat-row small,
    .alert-info small,
    .history-alert-row small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
    }

    .threat-row span {
        color: #0f172a;
        font-weight: 950;
    }

    .threat-progress {
        height: 9px;
        border-radius: 999px;
        background: #e2e8f0;
        overflow: hidden;
    }

    .threat-progress div {
        height: 100%;
        background: linear-gradient(90deg, #8b5cf6, #d946ef);
    }

    .threat-progress.red div {
        background: linear-gradient(90deg, #ef4444, #ec4899);
    }

    .threat-progress.orange div {
        background: linear-gradient(90deg, #f97316, #f59e0b);
    }

    .threat-progress.green div {
        background: linear-gradient(90deg, #22c55e, #8b5cf6);
    }

    .severity-total {
        margin-top: 20px;
        padding: 30px;
        border-radius: 22px;
        background: linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
        color: #ffffff;
    }

    .severity-total h2 {
        margin: 0;
        font-size: 44px;
        font-weight: 950;
    }

    .severity-total p {
        margin: 8px 0 0;
        color: rgba(255, 255, 255, 0.88);
        font-weight: 800;
    }

    .severity-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 18px;
        border-radius: 16px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
    }

    .severity-row div {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .severity-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
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

    .recent-alerts-panel,
    .alert-history-panel {
        margin-top: 24px;
    }

    .recent-alert-item,
    .history-alert-row {
        display: grid;
        grid-template-columns: 90px 1fr 120px 150px 100px;
        align-items: center;
        gap: 16px;
        padding: 18px 20px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .history-alert-row {
        grid-template-columns: 1fr 120px 100px;
    }

    .recent-alert-item:nth-child(1),
    .history-alert-row:nth-child(1) {
        background: linear-gradient(135deg, #ffffff, #fff7ed);
    }

    .recent-alert-item:nth-child(2),
    .history-alert-row:nth-child(2) {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .recent-alert-item:nth-child(3),
    .history-alert-row:nth-child(3) {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .alert-time {
        color: #7c3aed;
        font-weight: 950;
    }

    .alert-severity {
        padding: 9px 14px;
        border-radius: 999px;
        text-align: center;
        font-size: 12px;
        font-weight: 950;
    }

    .alert-severity.high {
        background: #ffedd5;
        color: #ea580c;
    }

    .alert-severity.critical {
        background: #fee2e2;
        color: #dc2626;
    }

    .alert-severity.medium {
        background: #fef3c7;
        color: #d97706;
    }

    .alert-severity.low {
        background: #dcfce7;
        color: #059669;
    }

    .alert-source {
        color: #475569;
        font-size: 13px;
        font-weight: 850;
        text-align: right;
    }

    .detail-btn {
        border: none;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        font-size: 12px;
        font-weight: 950;
        box-shadow: 0 10px 22px rgba(168, 85, 247, 0.18);
    }

    .detail-btn.small {
        padding: 9px 14px;
    }

    .history-filter-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 16px;
        align-items: end;
        margin-top: 22px;
    }

    .history-filter-grid label {
        display: block;
        margin-bottom: 8px;
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .history-filter-grid input,
    .history-filter-grid select {
        width: 100%;
        height: 48px;
        border-radius: 16px;
        border: 1px solid rgba(168, 85, 247, 0.22);
        background: #ffffff;
        padding: 0 16px;
        color: #0f172a;
        font-weight: 800;
        outline: none;
    }

    .reset-history-btn {
        height: 48px;
        border: none;
        border-radius: 16px;
        padding: 0 22px;
        cursor: pointer;
        color: #ffffff;
        font-weight: 950;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
    }

    .alert-detail-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(10px);
    }

    .alert-detail-modal.show {
        display: flex;
    }

    .alert-detail-card {
        position: relative;
        width: 100%;
        max-width: 620px;
        border-radius: 28px;
        padding: 28px;
        background:
            radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 34%),
            linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.18);
        box-shadow: 0 34px 80px rgba(15, 23, 42, 0.26);
    }

    .modal-close-btn {
        position: absolute;
        top: 16px;
        right: 18px;
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        color: #ffffff;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        font-size: 22px;
        font-weight: 900;
    }

    .detail-modal-header span {
        display: inline-flex;
        padding: 8px 14px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        font-size: 12px;
        font-weight: 950;
    }

    .detail-modal-header h2 {
        margin: 14px 0 4px;
        color: #0f172a;
        font-size: 26px;
        font-weight: 950;
    }

    .detail-modal-header p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        font-weight: 700;
    }

    .detail-modal-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        margin-top: 20px;
    }

    .detail-modal-grid div,
    .detail-reason-box {
        padding: 16px;
        border-radius: 18px;
        background: linear-gradient(135deg, #ffffff, #f8f3ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
    }

    .detail-modal-grid small,
    .detail-reason-box small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .detail-modal-grid strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .detail-reason-box {
        margin-top: 14px;
    }

    .detail-reason-box p {
        margin: 0;
        color: #334155;
        font-size: 14px;
        font-weight: 650;
        line-height: 1.6;
    }

    .detail-reason-box.recommendation {
        background: linear-gradient(135deg, #ffffff, #dcfce7);
    }

    @media (max-width: 1200px) {
        .dashboard-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-bottom-grid,
        .history-filter-grid {
            grid-template-columns: 1fr;
        }

        .recent-alert-item,
        .history-alert-row {
            grid-template-columns: 1fr;
            align-items: flex-start;
        }

        .alert-source {
            text-align: left;
        }
    }

    @media (max-width: 768px) {
        .dashboard-stats-grid,
        .detail-modal-grid {
            grid-template-columns: 1fr;
        }
    }

    /* ================================================= */
/* Dashboard - Better Colorful UI + Dark Mode */
/* Paste paling bawah style dashboard.blade.php */
/* ================================================= */

/* Background dashboard */
.main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.22), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.20), transparent 36%),
        radial-gradient(circle at bottom right, rgba(251, 191, 36, 0.12), transparent 34%),
        linear-gradient(135deg, #f8f3ff 0%, #fde7f7 48%, #f3e8ff 100%) !important;
}

/* Summary cards lebih hidup */
.dashboard-stat-card {
    position: relative;
    overflow: hidden;
    isolation: isolate;
}

.dashboard-stat-card::before {
    content: "";
    position: absolute;
    width: 135px;
    height: 135px;
    right: -45px;
    top: -48px;
    border-radius: 50%;
    background: rgba(168, 85, 247, 0.22);
    z-index: 0;
}

.dashboard-stat-card::after {
    content: "";
    position: absolute;
    width: 95px;
    height: 95px;
    right: 28px;
    bottom: -44px;
    border-radius: 50%;
    background: rgba(236, 72, 153, 0.18);
    z-index: 0;
}

.dashboard-stat-card > * {
    position: relative;
    z-index: 2;
}

.dashboard-stat-card.purple {
    background:
        radial-gradient(circle at top right, rgba(139, 92, 246, 0.25), transparent 36%),
        linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.dashboard-stat-card.pink {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.22), transparent 36%),
        linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.dashboard-stat-card.yellow {
    background:
        radial-gradient(circle at top right, rgba(251, 146, 60, 0.25), transparent 36%),
        linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.dashboard-stat-card.blue {
    background:
        radial-gradient(circle at top right, rgba(59, 130, 246, 0.22), transparent 36%),
        linear-gradient(135deg, #ffffff, #dbeafe) !important;
}

/* Icon di summary card */
.stat-icon {
    background: rgba(255, 255, 255, 0.92) !important;
    border: 1px solid rgba(168, 85, 247, 0.15);
    box-shadow: 0 14px 30px rgba(168, 85, 247, 0.18);
}

/* Panel dashboard biar tidak polos */
.dashboard-panel {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.12), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
        rgba(255, 255, 255, 0.92) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
}

/* Dekorasi icon besar di panel */
.dashboard-bottom-grid .dashboard-panel:first-child::before {
    content: "⚡";
    position: absolute;
    right: 28px;
    top: 18px;
    font-size: 58px;
    opacity: 0.08;
    pointer-events: none;
}

.dashboard-bottom-grid .dashboard-panel:last-child::before {
    content: "🛡️";
    position: absolute;
    right: 28px;
    top: 18px;
    font-size: 58px;
    opacity: 0.08;
    pointer-events: none;
}

.recent-alerts-panel::before {
    content: "🚨";
    position: absolute;
    right: 30px;
    top: 20px;
    font-size: 58px;
    opacity: 0.08;
    pointer-events: none;
}

.alert-history-panel::before {
    content: "📜";
    position: absolute;
    right: 30px;
    top: 20px;
    font-size: 58px;
    opacity: 0.08;
    pointer-events: none;
}

/* Top Threat lebih berwarna */
.threat-row {
    transition: 0.2s ease;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
}

.threat-row:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.threat-row:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.threat-row:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
}

.threat-row:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.threat-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
}

/* Severity card lebih menarik */
.severity-total {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(circle at top right, rgba(255, 255, 255, 0.25), transparent 36%),
        linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
    box-shadow: 0 18px 42px rgba(217, 70, 239, 0.25) !important;
}

.severity-total::after {
    content: "";
    position: absolute;
    width: 130px;
    height: 130px;
    right: -40px;
    bottom: -50px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.16);
}

.severity-row {
    box-shadow: 0 10px 22px rgba(168, 85, 247, 0.06);
    transition: 0.2s ease;
}

.severity-row:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.severity-row:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
}

.severity-row:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.severity-row:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.severity-row:hover {
    transform: translateY(-2px);
}

/* Recent Alert lebih berwarna */
.recent-alert-item {
    transition: 0.2s ease;
}

.recent-alert-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
}

.recent-alert-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.recent-alert-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.recent-alert-item:hover,
.history-alert-row:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
}

/* Alert History row */
.history-alert-row {
    transition: 0.2s ease;
}

.history-alert-row:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
}

.history-alert-row:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.history-alert-row:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.history-alert-row:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #fee2e2) !important;
}

.history-alert-row:nth-child(5) {
    background: linear-gradient(135deg, #ffffff, #dbeafe) !important;
}

/* Detail button */
.detail-btn {
    background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    box-shadow: 0 10px 24px rgba(168, 85, 247, 0.22);
}

.detail-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 30px rgba(217, 70, 239, 0.30);
}

/* Filter box lebih clean */
.history-filter-grid input,
.history-filter-grid select {
    background: rgba(255, 255, 255, 0.92) !important;
    box-shadow: 0 10px 22px rgba(168, 85, 247, 0.06);
}

.history-filter-grid input:focus,
.history-filter-grid select:focus {
    border-color: #d946ef !important;
    box-shadow: 0 0 0 4px rgba(217, 70, 239, 0.13) !important;
}

/* ================================================= */
/* DARK MODE DASHBOARD */
/* ================================================= */

body.dark-mode .main,
body.dark .main,
body.dark-theme .main {
    background:
        radial-gradient(circle at top left, rgba(168, 85, 247, 0.24), transparent 35%),
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 35%),
        linear-gradient(135deg, #0f172a 0%, #1e1b4b 48%, #3b123c 100%) !important;
}

/* Panel dan card dark */
body.dark-mode .dashboard-panel,
body.dark .dashboard-panel,
body.dark-theme .dashboard-panel,
body.dark-mode .dashboard-stat-card,
body.dark .dashboard-stat-card,
body.dark-theme .dashboard-stat-card,
body.dark-mode .threat-row,
body.dark .threat-row,
body.dark-theme .threat-row,
body.dark-mode .severity-row,
body.dark .severity-row,
body.dark-theme .severity-row,
body.dark-mode .recent-alert-item,
body.dark .recent-alert-item,
body.dark-theme .recent-alert-item,
body.dark-mode .history-alert-row,
body.dark .history-alert-row,
body.dark-theme .history-alert-row,
body.dark-mode .detail-modal-grid div,
body.dark .detail-modal-grid div,
body.dark-theme .detail-modal-grid div,
body.dark-mode .detail-reason-box,
body.dark .detail-reason-box,
body.dark-theme .detail-reason-box {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
        linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}

/* Text dark */
body.dark-mode .page-heading h1,
body.dark .page-heading h1,
body.dark-theme .page-heading h1,
body.dark-mode .panel-header h3,
body.dark .panel-header h3,
body.dark-theme .panel-header h3,
body.dark-mode .dashboard-stat-card h2,
body.dark .dashboard-stat-card h2,
body.dark-theme .dashboard-stat-card h2,
body.dark-mode .threat-row strong,
body.dark .threat-row strong,
body.dark-theme .threat-row strong,
body.dark-mode .threat-row span,
body.dark .threat-row span,
body.dark-theme .threat-row span,
body.dark-mode .severity-row strong,
body.dark .severity-row strong,
body.dark-theme .severity-row strong,
body.dark-mode .severity-row b,
body.dark .severity-row b,
body.dark-theme .severity-row b,
body.dark-mode .alert-info strong,
body.dark .alert-info strong,
body.dark-theme .alert-info strong,
body.dark-mode .history-alert-row strong,
body.dark .history-alert-row strong,
body.dark-theme .history-alert-row strong,
body.dark-mode .detail-modal-header h2,
body.dark .detail-modal-header h2,
body.dark-theme .detail-modal-header h2,
body.dark-mode .detail-modal-grid strong,
body.dark .detail-modal-grid strong,
body.dark-theme .detail-modal-grid strong {
    color: #f8fafc !important;
}

body.dark-mode .page-heading p,
body.dark .page-heading p,
body.dark-theme .page-heading p,
body.dark-mode .panel-header p,
body.dark .panel-header p,
body.dark-theme .panel-header p,
body.dark-mode .dashboard-stat-card span,
body.dark .dashboard-stat-card span,
body.dark-theme .dashboard-stat-card span,
body.dark-mode .dashboard-stat-card p,
body.dark .dashboard-stat-card p,
body.dark-theme .dashboard-stat-card p,
body.dark-mode .threat-row small,
body.dark .threat-row small,
body.dark-theme .threat-row small,
body.dark-mode .alert-info small,
body.dark .alert-info small,
body.dark-theme .alert-info small,
body.dark-mode .history-alert-row small,
body.dark .history-alert-row small,
body.dark-theme .history-alert-row small,
body.dark-mode .alert-source,
body.dark .alert-source,
body.dark-theme .alert-source,
body.dark-mode .detail-modal-header p,
body.dark .detail-modal-header p,
body.dark-theme .detail-modal-header p,
body.dark-mode .detail-reason-box p,
body.dark .detail-reason-box p,
body.dark-theme .detail-reason-box p {
    color: #94a3b8 !important;
}

/* Dark form filter */
body.dark-mode .history-filter-grid input,
body.dark .history-filter-grid input,
body.dark-theme .history-filter-grid input,
body.dark-mode .history-filter-grid select,
body.dark .history-filter-grid select,
body.dark-theme .history-filter-grid select {
    background: #0f172a !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}

/* Dark modal */
body.dark-mode .alert-detail-card,
body.dark .alert-detail-card,
body.dark-theme .alert-detail-card {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 34%),
        linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
}

/* Icon dark */
body.dark-mode .stat-icon,
body.dark .stat-icon,
body.dark-theme .stat-icon {
    background: rgba(15, 23, 42, 0.88) !important;
    border: 1px solid #3b2a55 !important;
}
/* ================================================= */
/* FINAL FIX - Hilangkan kotak hitam/kepotong di page */
/* Paste PALING BAWAH style masing-masing page */
/* ================================================= */

.dashboard-overview-page,
.agent-monitoring-page,
.agent-page,
.threat-detection-page,
.threat-final-page,
.blocked-ip-page,
.response-management-page,
.reports-page {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding-top: 0 !important;
    overflow: visible !important;
}

/* Kalau root page punya background dari class lain */
.content-wrapper > div,
.content-wrapper > section,
.main > div,
.main > section {
    background: transparent !important;
}

/* Panel tetap card, bukan kotak besar */
.dashboard-panel,
.agent-panel,
.threat-panel,
.blocked-panel,
.report-panel,
.reports-hero,
.report-mode-card,
.report-summary-card,
.dashboard-stat-card,
.agent-summary-card,
.blocked-summary-card {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.12), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
        linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
    border: 1px solid rgba(168, 85, 247, 0.26) !important;
    box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    color: #f8fafc !important;
}

/* Wrapper table jangan jadi kotak hitam */
.agent-table-wrapper,
.threat-table-wrapper,
.blocked-table-wrapper,
.report-table-wrapper {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
    overflow: visible !important;
}

/* Table jangan kasih background kotak full */
.agent-table,
.threat-table,
.blocked-table,
.report-table {
    background: transparent !important;
    border-collapse: separate !important;
    border-spacing: 0 14px !important;
}

/* Header table transparan */
.agent-table thead,
.threat-table thead,
.blocked-table thead,
.report-table thead,
.agent-table thead tr,
.threat-table thead tr,
.blocked-table thead tr,
.report-table thead tr {
    background: transparent !important;
}

/* Header text */
.agent-table th,
.threat-table th,
.blocked-table th,
.report-table th {
    background: transparent !important;
    border: none !important;
    color: #cbd5e1 !important;
}

/* Row table rapi */
.agent-table td,
.threat-table td,
.blocked-table td,
.report-table td {
    color: #f8fafc !important;
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-top: 1px solid rgba(168, 85, 247, 0.24) !important;
    border-bottom: 1px solid rgba(168, 85, 247, 0.24) !important;
}

/* Row pertama sampai keempat beda warna gelap */
.agent-table tbody tr:nth-child(1) td,
.threat-table tbody tr:nth-child(1) td,
.blocked-table tbody tr:nth-child(1) td,
.report-table tbody tr:nth-child(1) td {
    background: linear-gradient(135deg, #111827, #2e1a26) !important;
}

.agent-table tbody tr:nth-child(2) td,
.threat-table tbody tr:nth-child(2) td,
.blocked-table tbody tr:nth-child(2) td,
.report-table tbody tr:nth-child(2) td {
    background: linear-gradient(135deg, #111827, #25163d) !important;
}

.agent-table tbody tr:nth-child(3) td,
.threat-table tbody tr:nth-child(3) td,
.blocked-table tbody tr:nth-child(3) td,
.report-table tbody tr:nth-child(3) td {
    background: linear-gradient(135deg, #111827, #172554) !important;
}

.agent-table tbody tr:nth-child(4) td,
.threat-table tbody tr:nth-child(4) td,
.blocked-table tbody tr:nth-child(4) td,
.report-table tbody tr:nth-child(4) td {
    background: linear-gradient(135deg, #111827, #3b1a2c) !important;
}

/* Radius table row */
.agent-table td:first-child,
.threat-table td:first-child,
.blocked-table td:first-child,
.report-table td:first-child {
    border-left: 1px solid rgba(168, 85, 247, 0.24) !important;
    border-radius: 18px 0 0 18px !important;
}

.agent-table td:last-child,
.threat-table td:last-child,
.blocked-table td:last-child,
.report-table td:last-child {
    border-right: 1px solid rgba(168, 85, 247, 0.24) !important;
    border-radius: 0 18px 18px 0 !important;
}

/* Text */
.page-heading h1,
.panel-header h3 {
    color: #ffffff !important;
}

.page-heading p,
.panel-header p,
.agent-table small,
.threat-table small,
.blocked-table small,
.report-table small {
    color: #cbd5e1 !important;
}
</style>

<script>
    function showAlertDetail(button) {
        const item = button.closest('.recent-alert-item');
        fillAlertDetail(item.dataset);
    }

    function showHistoryDetail(button) {
        fillAlertDetail(button.dataset);
    }

    function fillAlertDetail(data) {
        const badge = document.getElementById('detailSeverityBadge');

        document.getElementById('detailAlertName').innerText = data.alert;
        document.getElementById('detailCategory').innerText = data.category;
        document.getElementById('detailDate').innerText = data.date;
        document.getElementById('detailTime').innerText = data.time;
        document.getElementById('detailSource').innerText = data.source;
        document.getElementById('detailRisk').innerText = data.severity;
        document.getElementById('detailReason').innerText = data.reason;
        document.getElementById('detailRecommendation').innerText = data.recommendation;

        badge.innerText = data.severity + ' Risk';

        if (data.severity === 'Critical') {
            badge.style.background = 'linear-gradient(135deg, #ef4444, #ec4899)';
        } else if (data.severity === 'High') {
            badge.style.background = 'linear-gradient(135deg, #f97316, #ec4899)';
        } else if (data.severity === 'Medium') {
            badge.style.background = 'linear-gradient(135deg, #f59e0b, #d946ef)';
        } else {
            badge.style.background = 'linear-gradient(135deg, #22c55e, #8b5cf6)';
        }

        document.getElementById('alertDetailModal').classList.add('show');
    }

    function closeAlertDetail() {
        document.getElementById('alertDetailModal').classList.remove('show');
    }

    function filterAlertHistory() {
        const date = document.getElementById('historyDate').value;
        const severity = document.getElementById('historySeverity').value;
        const category = document.getElementById('historyCategory').value;

        const rows = document.querySelectorAll('.history-alert-row');

        rows.forEach(row => {
            const matchDate = !date || row.dataset.date === date;
            const matchSeverity = severity === 'all' || row.dataset.severity === severity;
            const matchCategory = category === 'all' || row.dataset.category === category;

            row.style.display = matchDate && matchSeverity && matchCategory ? '' : 'none';
        });
    }

    function resetHistoryFilter() {
        document.getElementById('historyDate').value = '';
        document.getElementById('historySeverity').value = 'all';
        document.getElementById('historyCategory').value = 'all';

        filterAlertHistory();
    }
</script>

@endsection