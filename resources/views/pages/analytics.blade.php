@extends('layouts.app-dashboard')

@section('content')

<div class="rpt-page" id="reportsPage">

    <div class="rpt-hero">
        <div>
            <span>Security Reports</span>
            <h1>Reports</h1>
            <p>Security activity report by day and week, including blocked IP activity and alert severity summary.</p>
        </div>

        <div class="rpt-actions">
            <button type="button" class="rpt-btn pdf" onclick="window.print()">Export PDF</button>
            <button type="button" class="rpt-btn csv" onclick="exportReportCSV()">Export CSV</button>
        </div>
    </div>

    <div class="rpt-summary-grid">
        <div class="rpt-summary-card">
            <span>Total Activities</span>
            <h2 id="summaryActivity">312</h2>
            <p>Detected activities</p>
        </div>

        <div class="rpt-summary-card">
            <span>Blocked IPs</span>
            <h2 id="summaryBlocked">4</h2>
            <p>Suspicious sources blocked</p>
        </div>

        <div class="rpt-summary-card">
            <span>Critical Alerts</span>
            <h2>90</h2>
            <p>Need immediate action</p>
        </div>

        <div class="rpt-summary-card">
            <span>Response Success</span>
            <h2>92%</h2>
            <p>Handled response actions</p>
        </div>
    </div>

    <div class="rpt-mode-panel">
        <div>
            <h3>Activity Report</h3>
            <p>View security activity based on daily or weekly report.</p>
        </div>

        <div class="rpt-mode-buttons">
            <button type="button" class="rpt-mode-btn active" onclick="setReportMode('daily', this)">Daily</button>
            <button type="button" class="rpt-mode-btn" onclick="setReportMode('weekly', this)">Weekly</button>
        </div>
    </div>

    <div class="rpt-top-grid">

        <div class="rpt-panel">
            <div class="rpt-panel-header">
                <span>Attack Activity</span>
                <h3>Activity Trend</h3>
                <p>Activity movement detected from monitored endpoints.</p>
            </div>

            <div class="rpt-chart-box">
                <svg viewBox="0 0 900 320" class="rpt-chart-svg" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="rptLineGradient" x1="0" x2="1" y1="0" y2="0">
                            <stop offset="0%" stop-color="#8b5cf6"/>
                            <stop offset="50%" stop-color="#d946ef"/>
                            <stop offset="100%" stop-color="#ec4899"/>
                        </linearGradient>

                        <linearGradient id="rptAreaGradient" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#d946ef" stop-opacity="0.34"/>
                            <stop offset="100%" stop-color="#d946ef" stop-opacity="0"/>
                        </linearGradient>
                    </defs>

                    <line x1="45" y1="60" x2="860" y2="60" class="rpt-grid-line"/>
                    <line x1="45" y1="120" x2="860" y2="120" class="rpt-grid-line"/>
                    <line x1="45" y1="180" x2="860" y2="180" class="rpt-grid-line"/>
                    <line x1="45" y1="240" x2="860" y2="240" class="rpt-grid-line"/>

                    <path
                        d="M70 215 C130 150, 170 140, 215 170 C270 210, 305 130, 350 118 C405 105, 430 205, 480 190 C545 172, 560 88, 625 94 C690 100, 705 42, 755 60 C812 78, 815 145, 850 128 L850 270 L70 270 Z"
                        class="rpt-area"
                    />

                    <path
                        d="M70 215 C130 150, 170 140, 215 170 C270 210, 305 130, 350 118 C405 105, 430 205, 480 190 C545 172, 560 88, 625 94 C690 100, 705 42, 755 60 C812 78, 815 145, 850 128"
                        class="rpt-line"
                    />

                    <circle cx="70" cy="215" r="7" class="rpt-point"/>
                    <circle cx="215" cy="170" r="7" class="rpt-point"/>
                    <circle cx="350" cy="118" r="7" class="rpt-point"/>
                    <circle cx="480" cy="190" r="7" class="rpt-point"/>
                    <circle cx="625" cy="94" r="7" class="rpt-point"/>
                    <circle cx="755" cy="60" r="8" class="rpt-point"/>
                    <circle cx="850" cy="128" r="7" class="rpt-point"/>

                    <text x="60" y="304" class="rpt-chart-label">Mon</text>
                    <text x="202" y="304" class="rpt-chart-label">Tue</text>
                    <text x="338" y="304" class="rpt-chart-label">Wed</text>
                    <text x="468" y="304" class="rpt-chart-label">Thu</text>
                    <text x="615" y="304" class="rpt-chart-label">Fri</text>
                    <text x="742" y="304" class="rpt-chart-label">Sat</text>
                    <text x="838" y="304" class="rpt-chart-label">Sun</text>
                </svg>

                <div class="rpt-chart-info">
                    <span>Peak Activity</span>
                    <strong>Friday</strong>
                    <small>88% activity volume</small>
                </div>
            </div>

            <div class="rpt-trend-summary">
                <div>
                    <small>Total Activities</small>
                    <strong id="trendActivity">312</strong>
                </div>

                <div>
                    <small>Blocked IPs</small>
                    <strong id="trendBlocked">4</strong>
                </div>

                <div>
                    <small>Report Mode</small>
                    <strong id="trendMode">Daily</strong>
                </div>
            </div>
        </div>

        <div class="rpt-panel">
            <div class="rpt-panel-header">
                <span>Severity Distribution</span>
                <h3>Alert Severity Ratio</h3>
                <p>Distribution of alerts based on severity category.</p>
            </div>

            <div class="rpt-severity-total">
                <div>
                    <small>Total Alerts</small>
                    <h2>430</h2>
                    <p>Weekly Summary</p>
                </div>

                <div class="rpt-donut"></div>
            </div>

            <div class="rpt-severity-list">
                <div class="rpt-severity-row critical">
                    <div>
                        <i></i>
                        <strong>Critical</strong>
                    </div>
                    <b>90</b>
                </div>

                <div class="rpt-severity-row high">
                    <div>
                        <i></i>
                        <strong>High</strong>
                    </div>
                    <b>120</b>
                </div>

                <div class="rpt-severity-row medium">
                    <div>
                        <i></i>
                        <strong>Medium</strong>
                    </div>
                    <b>145</b>
                </div>

                <div class="rpt-severity-row low">
                    <div>
                        <i></i>
                        <strong>Low</strong>
                    </div>
                    <b>75</b>
                </div>
            </div>
        </div>

    </div>

    <div class="rpt-panel rpt-activity-panel">
        <div class="rpt-panel-header">
            <span>Activity Details</span>
            <h3 id="activityTitle">Daily Security Activity</h3>
            <p>Security activities including detected alerts and blocked IP actions.</p>
        </div>

        <div class="rpt-activity-header">
            <span>Date</span>
            <span>Time</span>
            <span>Activity</span>
            <span>Blocked IP</span>
            <span>Category</span>
            <span>Severity</span>
            <span>Status</span>
        </div>

        <div class="rpt-activity-list" id="activityList">

            <div class="rpt-activity-row purple" data-period="daily">
                <div>
                    <small>Date</small>
                    <strong>2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>11:20</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Nmap Reconnaissance</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>10.67.xx.xx</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Reconnaissance</strong>
                </div>

                <div>
                    <span class="rpt-badge high">High</span>
                </div>

                <div>
                    <span class="rpt-status blocked">Blocked</span>
                </div>
            </div>

            <div class="rpt-activity-row violet" data-period="daily">
                <div>
                    <small>Date</small>
                    <strong>2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>11:25</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Transaction Behaviour Anomaly</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>-</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Behaviour Anomaly</strong>
                </div>

                <div>
                    <span class="rpt-badge critical">Critical</span>
                </div>

                <div>
                    <span class="rpt-status investigated">Investigated</span>
                </div>
            </div>

            <div class="rpt-activity-row red" data-period="daily">
                <div>
                    <small>Date</small>
                    <strong>2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>11:32</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Brute Force Login Attempt</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>192.168.1.20</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Authentication Attack</strong>
                </div>

                <div>
                    <span class="rpt-badge medium">Medium</span>
                </div>

                <div>
                    <span class="rpt-status blocked">Blocked</span>
                </div>
            </div>

            <div class="rpt-activity-row blue" data-period="daily">
                <div>
                    <small>Date</small>
                    <strong>2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>11:40</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Malware Communication</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>192.168.1.45</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Malware</strong>
                </div>

                <div>
                    <span class="rpt-badge critical">Critical</span>
                </div>

                <div>
                    <span class="rpt-status blocked">Blocked</span>
                </div>
            </div>

            <div class="rpt-activity-row purple" data-period="weekly">
                <div>
                    <small>Period</small>
                    <strong>2026-07-09 - 2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>-</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Total Reconnaissance Activities</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>21 IPs</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Reconnaissance</strong>
                </div>

                <div>
                    <span class="rpt-badge high">High</span>
                </div>

                <div>
                    <span class="rpt-status blocked">Blocked</span>
                </div>
            </div>

            <div class="rpt-activity-row violet" data-period="weekly">
                <div>
                    <small>Period</small>
                    <strong>2026-07-09 - 2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>-</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Total Authentication Attacks</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>38 IPs</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Authentication Attack</strong>
                </div>

                <div>
                    <span class="rpt-badge medium">Medium</span>
                </div>

                <div>
                    <span class="rpt-status blocked">Blocked</span>
                </div>
            </div>

            <div class="rpt-activity-row red" data-period="weekly">
                <div>
                    <small>Period</small>
                    <strong>2026-07-09 - 2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>-</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Total Malware Communication</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>12 IPs</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Malware</strong>
                </div>

                <div>
                    <span class="rpt-badge critical">Critical</span>
                </div>

                <div>
                    <span class="rpt-status blocked">Blocked</span>
                </div>
            </div>

            <div class="rpt-activity-row blue" data-period="weekly">
                <div>
                    <small>Period</small>
                    <strong>2026-07-09 - 2026-07-15</strong>
                </div>

                <div>
                    <small>Time</small>
                    <strong>-</strong>
                </div>

                <div>
                    <small>Activity</small>
                    <strong>Total Web Attack Attempts</strong>
                </div>

                <div>
                    <small>Blocked IP</small>
                    <strong>13 IPs</strong>
                </div>

                <div>
                    <small>Category</small>
                    <strong>Web Attack</strong>
                </div>

                <div>
                    <span class="rpt-badge high">High</span>
                </div>

                <div>
                    <span class="rpt-status investigated">Investigated</span>
                </div>
            </div>

        </div>
    </div>

    <div class="rpt-panel rpt-blocked-panel">
        <div class="rpt-panel-header">
            <span>Blocked IP Activity</span>
            <h3>Blocked IP Report</h3>
            <p>List of IP addresses blocked by response action.</p>
        </div>

        <div class="rpt-blocked-grid">
            <div class="rpt-blocked-card">
                <strong>10.67.xx.xx</strong>
                <span>Nmap Reconnaissance • 11:20</span>
                <b class="rpt-badge high">High</b>
            </div>

            <div class="rpt-blocked-card">
                <strong>192.168.1.20</strong>
                <span>Brute Force Login Attempt • 11:32</span>
                <b class="rpt-badge medium">Medium</b>
            </div>

            <div class="rpt-blocked-card">
                <strong>192.168.1.45</strong>
                <span>Malware Communication • 11:40</span>
                <b class="rpt-badge critical">Critical</b>
            </div>

            <div class="rpt-blocked-card">
                <strong>172.16.xx.xx</strong>
                <span>SQL Injection Attempt • 11:46</span>
                <b class="rpt-badge high">High</b>
            </div>
        </div>
    </div>

</div>

<style>
    .rpt-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .rpt-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        margin-bottom: 24px;
        padding: 28px 30px;
        border-radius: 30px;
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
            rgba(255, 255, 255, 0.92) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 24px 55px rgba(168, 85, 247, 0.13) !important;
    }

    .rpt-hero::after {
        content: "📊";
        position: absolute;
        right: 34px;
        bottom: 18px;
        font-size: 62px;
        opacity: 0.08;
        pointer-events: none;
    }

    .rpt-hero span,
    .rpt-panel-header span {
        display: inline-flex;
        color: #7c3aed !important;
        font-size: 13px;
        font-weight: 950;
        margin-bottom: 8px;
    }

    .rpt-hero h1 {
        margin: 0;
        color: #0f172a !important;
        font-size: 34px;
        font-weight: 950;
        letter-spacing: -0.9px;
    }

    .rpt-hero p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .rpt-actions {
        position: relative;
        z-index: 2;
        display: flex;
        gap: 12px;
        flex-shrink: 0;
    }

    .rpt-btn {
        border: none;
        cursor: pointer;
        height: 50px;
        padding: 0 24px;
        border-radius: 16px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 950;
        transition: 0.2s ease;
    }

    .rpt-btn.pdf {
        background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    }

    .rpt-btn.csv {
        background: linear-gradient(135deg, #111827, #3b0764) !important;
    }

    .rpt-btn:hover {
        transform: translateY(-2px);
    }

    .rpt-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .rpt-summary-card {
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

    .rpt-summary-card::before {
        content: "";
        position: absolute;
        width: 135px;
        height: 135px;
        right: -45px;
        top: -48px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.18);
    }

    .rpt-summary-card::after {
        content: "";
        position: absolute;
        width: 95px;
        height: 95px;
        right: 28px;
        bottom: -44px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.15);
    }

    .rpt-summary-card span,
    .rpt-summary-card h2,
    .rpt-summary-card p {
        position: relative;
        z-index: 2;
    }

    .rpt-summary-card span {
        color: #64748b !important;
        font-size: 13px;
        font-weight: 900;
    }

    .rpt-summary-card h2 {
        margin: 8px 0 4px;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
    }

    .rpt-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .rpt-mode-panel {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        margin-bottom: 24px;
        padding: 22px 24px;
        border-radius: 26px;
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
            rgba(255, 255, 255, 0.92) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10) !important;
    }

    .rpt-mode-panel h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 22px;
        font-weight: 950;
    }

    .rpt-mode-panel p {
        margin: 6px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .rpt-mode-buttons {
        display: flex;
        gap: 10px;
    }

    .rpt-mode-btn {
        border: none;
        cursor: pointer;
        padding: 12px 22px;
        border-radius: 16px;
        background: #f3e8ff !important;
        color: #7c3aed !important;
        font-size: 13px;
        font-weight: 950;
    }

    .rpt-mode-btn.active {
        color: #ffffff !important;
        background: linear-gradient(135deg, #8b5cf6, #d946ef) !important;
    }

    .rpt-top-grid {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .rpt-panel {
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

    .rpt-panel-header {
        position: relative;
        z-index: 2;
        margin-bottom: 24px;
    }

    .rpt-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 24px;
        font-weight: 950;
    }

    .rpt-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .rpt-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .rpt-chart-box {
        position: relative;
        height: 330px;
        border-radius: 26px;
        padding: 18px;
        overflow: hidden;
        background:
            radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 35%),
            linear-gradient(135deg, #ffffff, #f8f3ff 55%, #fce7f3) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 18px 38px rgba(168, 85, 247, 0.13);
    }

    .rpt-chart-svg {
        width: 100%;
        height: 100%;
    }

    .rpt-grid-line {
        stroke: rgba(148, 163, 184, 0.25);
        stroke-width: 1;
    }

    .rpt-area {
        fill: url(#rptAreaGradient);
    }

    .rpt-line {
        fill: none;
        stroke: url(#rptLineGradient);
        stroke-width: 8;
        stroke-linecap: round;
        filter: drop-shadow(0 12px 18px rgba(217, 70, 239, 0.28));
    }

    .rpt-point {
        fill: #ffffff;
        stroke: #d946ef;
        stroke-width: 5;
    }

    .rpt-chart-label {
        fill: #64748b;
        font-size: 14px;
        font-weight: 850;
    }

    .rpt-chart-info {
        position: absolute;
        right: 28px;
        top: 26px;
        min-width: 160px;
        padding: 16px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.86);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
    }

    .rpt-chart-info span {
        display: block;
        color: #94a3b8 !important;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 5px;
    }

    .rpt-chart-info strong {
        display: block;
        color: #0f172a !important;
        font-size: 23px;
        font-weight: 950;
    }

    .rpt-chart-info small {
        display: block;
        color: #7c3aed !important;
        font-size: 12px;
        font-weight: 850;
        margin-top: 4px;
    }

    .rpt-trend-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 18px;
    }

    .rpt-trend-summary div {
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.16) !important;
    }

    .rpt-trend-summary small {
        display: block;
        color: #94a3b8 !important;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 8px;
    }

    .rpt-trend-summary strong {
        color: #0f172a !important;
        font-size: 18px;
        font-weight: 950;
    }

    .rpt-severity-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        padding: 28px;
        border-radius: 26px;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.26), transparent 36%),
            linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
        color: #ffffff !important;
        box-shadow: 0 18px 38px rgba(217, 70, 239, 0.22);
    }

    .rpt-severity-total small {
        display: block;
        color: rgba(255,255,255,0.88) !important;
        font-size: 13px;
        font-weight: 900;
    }

    .rpt-severity-total h2 {
        margin: 8px 0;
        color: #ffffff !important;
        font-size: 46px;
        font-weight: 950;
    }

    .rpt-severity-total p {
        margin: 0;
        color: rgba(255,255,255,0.88) !important;
        font-size: 13px;
        font-weight: 850;
    }

    .rpt-donut {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        background:
            radial-gradient(circle at center, rgba(255,255,255,0.92) 45%, transparent 47%),
            conic-gradient(#ef4444 0deg 75deg, #f97316 75deg 176deg, #f59e0b 176deg 298deg, #22c55e 298deg 360deg);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.18);
    }

    .rpt-severity-list {
        display: grid;
        gap: 14px;
        margin-top: 20px;
    }

    .rpt-severity-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 17px 18px;
        border-radius: 20px;
        border: 1px solid rgba(168, 85, 247, 0.16) !important;
    }

    .rpt-severity-row.critical { background: linear-gradient(135deg, #ffffff, #fff1f2) !important; }
    .rpt-severity-row.high { background: linear-gradient(135deg, #ffffff, #fff7ed) !important; }
    .rpt-severity-row.medium { background: linear-gradient(135deg, #ffffff, #fef3c7) !important; }
    .rpt-severity-row.low { background: linear-gradient(135deg, #ffffff, #dcfce7) !important; }

    .rpt-severity-row div {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .rpt-severity-row i {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .rpt-severity-row.critical i { background: #ef4444; }
    .rpt-severity-row.high i { background: #f97316; }
    .rpt-severity-row.medium i { background: #f59e0b; }
    .rpt-severity-row.low i { background: #22c55e; }

    .rpt-severity-row strong,
    .rpt-severity-row b {
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .rpt-activity-panel,
    .rpt-blocked-panel {
        margin-top: 24px;
    }

    .rpt-activity-header {
        display: grid;
        grid-template-columns: 0.9fr 0.55fr 1.9fr 0.9fr 1.35fr 0.85fr 0.9fr;
        gap: 14px;
        padding: 0 16px 10px;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 950;
    }

    .rpt-activity-list {
        display: grid;
        gap: 14px;
    }

    .rpt-activity-row {
        display: grid;
        grid-template-columns: 0.9fr 0.55fr 1.9fr 0.9fr 1.35fr 0.85fr 0.9fr;
        align-items: center;
        gap: 14px;
        min-height: 78px;
        padding: 18px 16px;
        border-radius: 20px;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .rpt-activity-row.purple { background: linear-gradient(135deg, #ffffff, #f3e8ff) !important; }
    .rpt-activity-row.violet { background: linear-gradient(135deg, #ffffff, #f8f3ff) !important; }
    .rpt-activity-row.red { background: linear-gradient(135deg, #ffffff, #fff1f2) !important; }
    .rpt-activity-row.blue { background: linear-gradient(135deg, #ffffff, #dbeafe) !important; }

    .rpt-activity-row small {
        display: block;
        margin-bottom: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 850;
    }

    .rpt-activity-row strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .rpt-badge,
    .rpt-status {
        display: inline-flex;
        justify-content: center;
        min-width: 92px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .rpt-badge.critical { background: #fee2e2 !important; color: #dc2626 !important; }
    .rpt-badge.high { background: #ffedd5 !important; color: #ea580c !important; }
    .rpt-badge.medium { background: #fef3c7 !important; color: #d97706 !important; }
    .rpt-status.blocked { background: #fee2e2 !important; color: #dc2626 !important; }
    .rpt-status.investigated { background: #f3e8ff !important; color: #7c3aed !important; }

    .rpt-blocked-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .rpt-blocked-card {
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
    }

    .rpt-blocked-card strong {
        display: block;
        color: #0f172a !important;
        font-size: 15px;
        font-weight: 950;
    }

    .rpt-blocked-card span {
        display: block;
        margin: 8px 0 12px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    /* DARK MODE */
    body.dark-mode .rpt-page,
    body.dark .rpt-page,
    body.dark-theme .rpt-page,
    .rpt-page.rpt-dark {
        background: transparent !important;
    }

    body.dark-mode .rpt-heading h1,
    body.dark .rpt-heading h1,
    body.dark-theme .rpt-heading h1,
    .rpt-page.rpt-dark .rpt-heading h1 {
        color: #ffffff !important;
    }

    body.dark-mode .rpt-hero,
    body.dark .rpt-hero,
    body.dark-theme .rpt-hero,
    body.dark-mode .rpt-summary-card,
    body.dark .rpt-summary-card,
    body.dark-theme .rpt-summary-card,
    body.dark-mode .rpt-mode-panel,
    body.dark .rpt-mode-panel,
    body.dark-theme .rpt-mode-panel,
    body.dark-mode .rpt-panel,
    body.dark .rpt-panel,
    body.dark-theme .rpt-panel,
    .rpt-page.rpt-dark .rpt-hero,
    .rpt-page.rpt-dark .rpt-summary-card,
    .rpt-page.rpt-dark .rpt-mode-panel,
    .rpt-page.rpt-dark .rpt-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .rpt-chart-box,
    body.dark .rpt-chart-box,
    body.dark-theme .rpt-chart-box,
    body.dark-mode .rpt-trend-summary div,
    body.dark .rpt-trend-summary div,
    body.dark-theme .rpt-trend-summary div,
    body.dark-mode .rpt-severity-row,
    body.dark .rpt-severity-row,
    body.dark-theme .rpt-severity-row,
    body.dark-mode .rpt-blocked-card,
    body.dark .rpt-blocked-card,
    body.dark-theme .rpt-blocked-card,
    .rpt-page.rpt-dark .rpt-chart-box,
    .rpt-page.rpt-dark .rpt-trend-summary div,
    .rpt-page.rpt-dark .rpt-severity-row,
    .rpt-page.rpt-dark .rpt-blocked-card {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: rgba(168, 85, 247, 0.27) !important;
    }

    body.dark-mode .rpt-activity-row.purple,
    body.dark .rpt-activity-row.purple,
    body.dark-theme .rpt-activity-row.purple,
    .rpt-page.rpt-dark .rpt-activity-row.purple {
        background: linear-gradient(135deg, #111827, #2e1a26) !important;
    }

    body.dark-mode .rpt-activity-row.violet,
    body.dark .rpt-activity-row.violet,
    body.dark-theme .rpt-activity-row.violet,
    .rpt-page.rpt-dark .rpt-activity-row.violet {
        background: linear-gradient(135deg, #111827, #25163d) !important;
    }

    body.dark-mode .rpt-activity-row.red,
    body.dark .rpt-activity-row.red,
    body.dark-theme .rpt-activity-row.red,
    .rpt-page.rpt-dark .rpt-activity-row.red {
        background: linear-gradient(135deg, #111827, #3b1a2c) !important;
    }

    body.dark-mode .rpt-activity-row.blue,
    body.dark .rpt-activity-row.blue,
    body.dark-theme .rpt-activity-row.blue,
    .rpt-page.rpt-dark .rpt-activity-row.blue {
        background: linear-gradient(135deg, #111827, #172554) !important;
    }

    body.dark-mode .rpt-activity-row,
    body.dark .rpt-activity-row,
    body.dark-theme .rpt-activity-row,
    .rpt-page.rpt-dark .rpt-activity-row {
        border-color: rgba(168, 85, 247, 0.27) !important;
    }

    body.dark-mode .rpt-hero h1,
    body.dark .rpt-hero h1,
    body.dark-theme .rpt-hero h1,
    body.dark-mode .rpt-summary-card h2,
    body.dark .rpt-summary-card h2,
    body.dark-theme .rpt-summary-card h2,
    body.dark-mode .rpt-mode-panel h3,
    body.dark .rpt-mode-panel h3,
    body.dark-theme .rpt-mode-panel h3,
    body.dark-mode .rpt-panel-header h3,
    body.dark .rpt-panel-header h3,
    body.dark-theme .rpt-panel-header h3,
    body.dark-mode .rpt-activity-row strong,
    body.dark .rpt-activity-row strong,
    body.dark-theme .rpt-activity-row strong,
    body.dark-mode .rpt-blocked-card strong,
    body.dark .rpt-blocked-card strong,
    body.dark-theme .rpt-blocked-card strong,
    body.dark-mode .rpt-severity-row strong,
    body.dark .rpt-severity-row strong,
    body.dark-theme .rpt-severity-row strong,
    body.dark-mode .rpt-severity-row b,
    body.dark .rpt-severity-row b,
    body.dark-theme .rpt-severity-row b,
    body.dark-mode .rpt-trend-summary strong,
    body.dark .rpt-trend-summary strong,
    body.dark-theme .rpt-trend-summary strong,
    body.dark-mode .rpt-chart-info strong,
    body.dark .rpt-chart-info strong,
    body.dark-theme .rpt-chart-info strong,
    .rpt-page.rpt-dark .rpt-hero h1,
    .rpt-page.rpt-dark .rpt-summary-card h2,
    .rpt-page.rpt-dark .rpt-mode-panel h3,
    .rpt-page.rpt-dark .rpt-panel-header h3,
    .rpt-page.rpt-dark .rpt-activity-row strong,
    .rpt-page.rpt-dark .rpt-blocked-card strong,
    .rpt-page.rpt-dark .rpt-severity-row strong,
    .rpt-page.rpt-dark .rpt-severity-row b,
    .rpt-page.rpt-dark .rpt-trend-summary strong,
    .rpt-page.rpt-dark .rpt-chart-info strong {
        color: #ffffff !important;
    }

    body.dark-mode .rpt-hero p,
    body.dark .rpt-hero p,
    body.dark-theme .rpt-hero p,
    body.dark-mode .rpt-summary-card span,
    body.dark .rpt-summary-card span,
    body.dark-theme .rpt-summary-card span,
    body.dark-mode .rpt-summary-card p,
    body.dark .rpt-summary-card p,
    body.dark-theme .rpt-summary-card p,
    body.dark-mode .rpt-mode-panel p,
    body.dark .rpt-mode-panel p,
    body.dark-theme .rpt-mode-panel p,
    body.dark-mode .rpt-panel-header p,
    body.dark .rpt-panel-header p,
    body.dark-theme .rpt-panel-header p,
    body.dark-mode .rpt-activity-header,
    body.dark .rpt-activity-header,
    body.dark-theme .rpt-activity-header,
    body.dark-mode .rpt-activity-row small,
    body.dark .rpt-activity-row small,
    body.dark-theme .rpt-activity-row small,
    body.dark-mode .rpt-blocked-card span,
    body.dark .rpt-blocked-card span,
    body.dark-theme .rpt-blocked-card span,
    body.dark-mode .rpt-trend-summary small,
    body.dark .rpt-trend-summary small,
    body.dark-theme .rpt-trend-summary small,
    body.dark-mode .rpt-chart-label,
    body.dark .rpt-chart-label,
    body.dark-theme .rpt-chart-label,
    .rpt-page.rpt-dark .rpt-hero p,
    .rpt-page.rpt-dark .rpt-summary-card span,
    .rpt-page.rpt-dark .rpt-summary-card p,
    .rpt-page.rpt-dark .rpt-mode-panel p,
    .rpt-page.rpt-dark .rpt-panel-header p,
    .rpt-page.rpt-dark .rpt-activity-header,
    .rpt-page.rpt-dark .rpt-activity-row small,
    .rpt-page.rpt-dark .rpt-blocked-card span,
    .rpt-page.rpt-dark .rpt-trend-summary small,
    .rpt-page.rpt-dark .rpt-chart-label {
        color: #cbd5e1 !important;
    }

    body.dark-mode .rpt-chart-info,
    body.dark .rpt-chart-info,
    body.dark-theme .rpt-chart-info,
    .rpt-page.rpt-dark .rpt-chart-info {
        background: rgba(17, 24, 39, 0.88) !important;
        border-color: rgba(168, 85, 247, 0.27) !important;
    }

    @media (max-width: 1300px) {
        .rpt-top-grid {
            grid-template-columns: 1fr;
        }

        .rpt-summary-grid,
        .rpt-blocked-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .rpt-activity-header,
        .rpt-activity-row {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media (max-width: 900px) {
        .rpt-hero,
        .rpt-mode-panel {
            flex-direction: column;
            align-items: flex-start;
        }

        .rpt-summary-grid,
        .rpt-blocked-grid,
        .rpt-trend-summary,
        .rpt-activity-row {
            grid-template-columns: 1fr;
        }

        .rpt-activity-header {
            display: none;
        }

        .rpt-actions,
        .rpt-mode-buttons {
            width: 100%;
            flex-direction: column;
        }

        .rpt-btn,
        .rpt-mode-btn {
            width: 100%;
        }
    }

    @media print {
        .sidebar,
        .topbar,
        .rpt-actions,
        .rpt-mode-buttons {
            display: none !important;
        }

        .main {
            margin: 0 !important;
            width: 100% !important;
            padding: 24px !important;
            background: #ffffff !important;
        }

        .rpt-panel,
        .rpt-hero,
        .rpt-summary-card,
        .rpt-mode-panel {
            box-shadow: none !important;
            break-inside: avoid;
        }
    }
</style>

<script>
    function setReportMode(mode, button) {
        const rows = document.querySelectorAll('.rpt-activity-row');
        const buttons = document.querySelectorAll('.rpt-mode-btn');

        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        rows.forEach(row => {
            row.style.display = row.dataset.period === mode ? 'grid' : 'none';
        });

        document.getElementById('activityTitle').innerText =
            mode === 'daily' ? 'Daily Security Activity' : 'Weekly Security Activity';

        document.getElementById('summaryActivity').innerText = mode === 'daily' ? '312' : '1,244';
        document.getElementById('summaryBlocked').innerText = mode === 'daily' ? '4' : '84';
        document.getElementById('trendActivity').innerText = mode === 'daily' ? '312' : '1,244';
        document.getElementById('trendBlocked').innerText = mode === 'daily' ? '4' : '84';
        document.getElementById('trendMode').innerText = mode === 'daily' ? 'Daily' : 'Weekly';
    }

    function exportReportCSV() {
        const rows = [];
        const visibleRows = document.querySelectorAll('.rpt-activity-row');

        rows.push(['Date', 'Time', 'Activity', 'Blocked IP', 'Category', 'Severity', 'Status']);

        visibleRows.forEach(row => {
            if (row.style.display !== 'none') {
                const items = row.querySelectorAll('strong, .rpt-badge, .rpt-status');

                rows.push([
                    items[0]?.innerText || '',
                    items[1]?.innerText || '',
                    items[2]?.innerText || '',
                    items[3]?.innerText || '',
                    items[4]?.innerText || '',
                    items[5]?.innerText || '',
                    items[6]?.innerText || ''
                ]);
            }
        });

        const csvContent = rows.map(row => row.map(value => `"${value}"`).join(',')).join('\n');

        const blob = new Blob([csvContent], {
            type: 'text/csv;charset=utf-8;'
        });

        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');

        link.href = url;
        link.download = 'lox-security-report.csv';
        link.click();

        URL.revokeObjectURL(url);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('reportsPage');

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

        function syncReportTheme() {
            if (!page) return;

            if (isDarkTheme()) {
                page.classList.add('rpt-dark');
            } else {
                page.classList.remove('rpt-dark');
            }
        }

        syncReportTheme();

        const observer = new MutationObserver(syncReportTheme);

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
                setTimeout(syncReportTheme, 50);
            });
        }

        window.addEventListener('storage', syncReportTheme);

        const activeButton = document.querySelector('.rpt-mode-btn.active');
        setReportMode('daily', activeButton);
    });
</script>

@endsection