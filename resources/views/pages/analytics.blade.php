@extends('layouts.app-dashboard')

@section('content')
<div class="analytics-page">

    <div class="page-heading analytics-heading-row">
        <div>
            <h1>Analytics & Reports</h1>
            <p>Analyze attack trends, severity distribution, and response performance.</p>
        </div>

        <button type="button" class="analytics-export-btn" onclick="window.print()">
            Export PDF
        </button>
    </div>

    <div class="analytics-layout">

        <!-- Attack Trends -->
        <section class="analytics-panel attack-trends-panel">
            <div class="analytics-panel-title">
                <span>Attack Trends</span>
                <h2>Weekly Attack Activity</h2>
                <p>Attack movement detected across monitored endpoints during the last 7 days.</p>
            </div>

<div class="lox-attack-chart">
    <svg viewBox="0 0 900 320" class="attack-svg" preserveAspectRatio="none">
        <defs>
            <linearGradient id="attackLineGradient" x1="0" x2="1" y1="0" y2="0">
                <stop offset="0%" stop-color="#8b5cf6"/>
                <stop offset="50%" stop-color="#d946ef"/>
                <stop offset="100%" stop-color="#ec4899"/>
            </linearGradient>

            <linearGradient id="attackAreaGradient" x1="0" x2="0" y1="0" y2="1">
                <stop offset="0%" stop-color="#d946ef" stop-opacity="0.34"/>
                <stop offset="100%" stop-color="#d946ef" stop-opacity="0"/>
            </linearGradient>
        </defs>

        <line x1="45" y1="60" x2="860" y2="60" class="chart-grid"/>
        <line x1="45" y1="120" x2="860" y2="120" class="chart-grid"/>
        <line x1="45" y1="180" x2="860" y2="180" class="chart-grid"/>
        <line x1="45" y1="240" x2="860" y2="240" class="chart-grid"/>

        <path
            d="M70 210 C125 160, 170 150, 210 175 C270 215, 300 130, 340 120 C400 105, 430 200, 470 190 C540 175, 555 85, 620 90 C685 95, 690 45, 745 60 C805 75, 810 145, 850 125 L850 270 L70 270 Z"
            class="attack-area"
        />

        <path
            d="M70 210 C125 160, 170 150, 210 175 C270 215, 300 130, 340 120 C400 105, 430 200, 470 190 C540 175, 555 85, 620 90 C685 95, 690 45, 745 60 C805 75, 810 145, 850 125"
            class="attack-line"
        />

        <circle cx="70" cy="210" r="7" class="chart-point"/>
        <circle cx="210" cy="175" r="7" class="chart-point"/>
        <circle cx="340" cy="120" r="7" class="chart-point"/>
        <circle cx="470" cy="190" r="7" class="chart-point"/>
        <circle cx="620" cy="90" r="7" class="chart-point"/>
        <circle cx="745" cy="60" r="8" class="chart-point peak"/>
        <circle cx="850" cy="125" r="7" class="chart-point"/>

        <text x="60" y="304" class="chart-label">Mon</text>
        <text x="198" y="304" class="chart-label">Tue</text>
        <text x="328" y="304" class="chart-label">Wed</text>
        <text x="458" y="304" class="chart-label">Thu</text>
        <text x="610" y="304" class="chart-label">Fri</text>
        <text x="735" y="304" class="chart-label">Sat</text>
        <text x="838" y="304" class="chart-label">Sun</text>
    </svg>

    <div class="attack-chart-info">
        <span>Peak Activity</span>
        <strong>Friday</strong>
        <small>88% attack volume</small>
    </div>
</div>

<div class="trend-summary">
                <div>
                    <small>Total Attacks</small>
                    <strong>1,244</strong>
                </div>

                <div>
                    <small>Peak Day</small>
                    <strong>Friday</strong>
                </div>

                <div>
                    <small>Trend Status</small>
                    <strong class="warning-text">Increasing</strong>
                </div>
            </div>
        </section>

        <!-- Severity Distribution -->
        <section class="analytics-panel severity-distribution-panel">
            <div class="analytics-panel-title">
                <span>Severity Distribution</span>
                <h2>Alert Severity Ratio</h2>
                <p>Distribution of alerts based on severity category.</p>
            </div>

            <div class="severity-content">
                <div class="severity-ring">
                    <div class="severity-ring-inner">
                        <strong>430</strong>
                        <small>Total</small>
                    </div>
                </div>

                <div class="severity-list">
                    <div class="severity-item">
                        <div>
                            <span class="severity-dot critical"></span>
                            <strong>Critical</strong>
                        </div>
                        <b>90</b>
                    </div>

                    <div class="severity-item">
                        <div>
                            <span class="severity-dot high"></span>
                            <strong>High</strong>
                        </div>
                        <b>120</b>
                    </div>

                    <div class="severity-item">
                        <div>
                            <span class="severity-dot medium"></span>
                            <strong>Medium</strong>
                        </div>
                        <b>145</b>
                    </div>

                    <div class="severity-item">
                        <div>
                            <span class="severity-dot low"></span>
                            <strong>Low</strong>
                        </div>
                        <b>75</b>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Response Statistics -->
    <section class="analytics-panel response-statistics-panel">
        <div class="analytics-panel-title">
            <span>Response Statistics</span>
            <h2>Response Performance</h2>
            <p>Summary of security response actions and handling performance.</p>
        </div>

        <div class="response-stats-grid">
            <div class="response-stat-card">
                <div class="stat-icon blocked">IP</div>
                <div>
                    <small>Blocked IPs</small>
                    <strong>84</strong>
                    <p>Blocked from malicious activity.</p>
                </div>
            </div>

            <div class="response-stat-card">
                <div class="stat-icon resolved">OK</div>
                <div>
                    <small>Resolved Incidents</small>
                    <strong>62</strong>
                    <p>Incidents successfully handled.</p>
                </div>
            </div>

            <div class="response-stat-card">
                <div class="stat-icon progress">IR</div>
                <div>
                    <small>In Progress</small>
                    <strong>14</strong>
                    <p>Still under investigation.</p>
                </div>
            </div>

            <div class="response-stat-card">
                <div class="stat-icon time">MT</div>
                <div>
                    <small>Avg Response Time</small>
                    <strong>6m</strong>
                    <p>Average time to respond.</p>
                </div>
            </div>
        </div>

        <div class="response-progress-area">
            <div class="response-progress-row">
                <div class="progress-title">
                    <span>Blocked Actions</span>
                    <b>84%</b>
                </div>
                <div class="response-progress-track">
                    <div class="blocked-fill" style="width: 84%;"></div>
                </div>
            </div>

            <div class="response-progress-row">
                <div class="progress-title">
                    <span>Resolved Incidents</span>
                    <b>76%</b>
                </div>
                <div class="response-progress-track">
                    <div class="resolved-fill" style="width: 76%;"></div>
                </div>
            </div>

            <div class="response-progress-row">
                <div class="progress-title">
                    <span>Investigation Progress</span>
                    <b>58%</b>
                </div>
                <div class="response-progress-track">
                    <div class="progress-fill" style="width: 58%;"></div>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
    .analytics-page {
        width: 100%;
        animation: analyticsFadeIn 0.45s ease;
    }

    @keyframes analyticsFadeIn {
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

    .analytics-layout {
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .analytics-panel {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid #e6e8ef;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.055);
    }

    .analytics-panel-title {
        margin-bottom: 20px;
    }

    .analytics-panel-title span {
        display: block;
        color: #7c3aed;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .analytics-panel-title h2 {
        margin: 0;
        color: #0f172a;
        font-size: 22px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .analytics-panel-title p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

    .trend-chart {
        height: 280px;
        border: 1px solid #edf0f5;
        border-radius: 18px;
        background: linear-gradient(180deg, #fbfdff, #ffffff);
        padding: 24px 22px 18px;
        position: relative;
        overflow: hidden;
    }

    .trend-grid-line {
        position: absolute;
        left: 22px;
        right: 22px;
        height: 1px;
        background: #edf0f5;
    }

    .trend-grid-line:nth-child(1) {
        top: 22%;
    }

    .trend-grid-line:nth-child(2) {
        top: 42%;
    }

    .trend-grid-line:nth-child(3) {
        top: 62%;
    }

    .trend-grid-line:nth-child(4) {
        top: 82%;
    }

    .trend-bars {
        height: 100%;
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 16px;
        align-items: end;
        position: relative;
        z-index: 2;
    }

    .trend-day {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
    }

    .trend-bar {
        width: 100%;
        max-width: 42px;
        min-height: 28px;
        border-radius: 14px 14px 8px 8px;
        background: linear-gradient(180deg, #8b5cf6, #d946ef);
        box-shadow: 0 12px 26px rgba(139, 92, 246, 0.22);
    }

    .trend-day small {
        color: #64748b;
        font-size: 12px;
        font-weight: 850;
    }

    .trend-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 16px;
    }

    .trend-summary div {
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 16px;
        background: #ffffff;
    }

    .trend-summary small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .trend-summary strong {
        display: block;
        color: #0f172a;
        font-size: 16px;
        font-weight: 900;
    }

    .warning-text {
        color: #f59e0b !important;
    }

    .severity-content {
        display: grid;
        grid-template-columns: 170px 1fr;
        gap: 20px;
        align-items: center;
    }

    .severity-ring {
        width: 170px;
        height: 170px;
        border-radius: 50%;
        background:
            radial-gradient(circle at center, #ffffff 58%, transparent 59%),
            conic-gradient(
                #ef4444 0deg 75deg,
                #f97316 75deg 176deg,
                #f59e0b 176deg 298deg,
                #22c55e 298deg 360deg
            );
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .severity-ring-inner {
        text-align: center;
    }

    .severity-ring-inner strong {
        display: block;
        color: #0f172a;
        font-size: 30px;
        font-weight: 950;
        letter-spacing: -1px;
    }

    .severity-ring-inner small {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 850;
    }

    .severity-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .severity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        border: 1px solid #edf0f5;
        border-radius: 15px;
        padding: 14px;
        background: #ffffff;
    }

    .severity-item div {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .severity-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
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

    .severity-item strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .severity-item b {
        color: #0f172a;
        font-size: 15px;
        font-weight: 950;
    }

    .response-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }

    .response-stat-card {
        border: 1px solid #edf0f5;
        border-radius: 17px;
        padding: 18px;
        background: #ffffff;
        display: flex;
        gap: 14px;
        align-items: flex-start;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 950;
        flex-shrink: 0;
    }

    .stat-icon.blocked {
        background: #fee2e2;
        color: #dc2626;
    }

    .stat-icon.resolved {
        background: #dcfce7;
        color: #059669;
    }

    .stat-icon.progress {
        background: #dbeafe;
        color: #2563eb;
    }

    .stat-icon.time {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .response-stat-card small {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 7px;
    }

    .response-stat-card strong {
        display: block;
        color: #0f172a;
        font-size: 28px;
        font-weight: 950;
        letter-spacing: -1px;
    }

    .response-stat-card p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 600;
    }

    .response-progress-area {
        display: grid;
        grid-template-columns: 1fr;
        gap: 17px;
        border: 1px solid #edf0f5;
        border-radius: 18px;
        padding: 20px;
        background: #ffffff;
    }

    .progress-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 10px;
    }

    .progress-title span {
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .progress-title b {
        color: #64748b;
        font-size: 13px;
        font-weight: 900;
    }

    .response-progress-track {
        height: 9px;
        background: #edf0f5;
        border-radius: 999px;
        overflow: hidden;
    }

    .response-progress-track div {
        height: 100%;
        border-radius: inherit;
    }

    .blocked-fill {
        background: linear-gradient(90deg, #ef4444, #f97316);
    }

    .resolved-fill {
        background: linear-gradient(90deg, #22c55e, #10b981);
    }

    .progress-fill {
        background: linear-gradient(90deg, #8b5cf6, #d946ef);
    }

    body.dark-mode .analytics-panel,
    body.dark .analytics-panel,
    body.dark-theme .analytics-panel {
        background: #111827 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28) !important;
    }

    body.dark-mode .trend-chart,
    body.dark-mode .trend-summary div,
    body.dark-mode .severity-item,
    body.dark-mode .response-stat-card,
    body.dark-mode .response-progress-area,
    body.dark .trend-chart,
    body.dark .trend-summary div,
    body.dark .severity-item,
    body.dark .response-stat-card,
    body.dark .response-progress-area,
    body.dark-theme .trend-chart,
    body.dark-theme .trend-summary div,
    body.dark-theme .severity-item,
    body.dark-theme .response-stat-card,
    body.dark-theme .response-progress-area {
        background: #162033 !important;
        border-color: #243044 !important;
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading h1,
    body.dark-mode .analytics-panel-title h2,
    body.dark-mode .trend-summary strong,
    body.dark-mode .severity-ring-inner strong,
    body.dark-mode .severity-item strong,
    body.dark-mode .severity-item b,
    body.dark-mode .response-stat-card strong,
    body.dark-mode .progress-title span,
    body.dark .page-heading h1,
    body.dark .analytics-panel-title h2,
    body.dark .trend-summary strong,
    body.dark .severity-ring-inner strong,
    body.dark .severity-item strong,
    body.dark .severity-item b,
    body.dark .response-stat-card strong,
    body.dark .progress-title span,
    body.dark-theme .page-heading h1,
    body.dark-theme .analytics-panel-title h2,
    body.dark-theme .trend-summary strong,
    body.dark-theme .severity-ring-inner strong,
    body.dark-theme .severity-item strong,
    body.dark-theme .severity-item b,
    body.dark-theme .response-stat-card strong,
    body.dark-theme .progress-title span {
        color: #f8fafc !important;
    }

    body.dark-mode .page-heading p,
    body.dark-mode .analytics-panel-title p,
    body.dark-mode .trend-summary small,
    body.dark-mode .trend-day small,
    body.dark-mode .severity-ring-inner small,
    body.dark-mode .response-stat-card small,
    body.dark-mode .response-stat-card p,
    body.dark-mode .progress-title b,
    body.dark .page-heading p,
    body.dark .analytics-panel-title p,
    body.dark .trend-summary small,
    body.dark .trend-day small,
    body.dark .severity-ring-inner small,
    body.dark .response-stat-card small,
    body.dark .response-stat-card p,
    body.dark .progress-title b,
    body.dark-theme .page-heading p,
    body.dark-theme .analytics-panel-title p,
    body.dark-theme .trend-summary small,
    body.dark-theme .trend-day small,
    body.dark-theme .severity-ring-inner small,
    body.dark-theme .response-stat-card small,
    body.dark-theme .response-stat-card p,
    body.dark-theme .progress-title b {
        color: #94a3b8 !important;
    }

    body.dark-mode .trend-grid-line,
    body.dark .trend-grid-line,
    body.dark-theme .trend-grid-line {
        background: #243044 !important;
    }

    body.dark-mode .response-progress-track,
    body.dark .response-progress-track,
    body.dark-theme .response-progress-track {
        background: #263247 !important;
    }

    body.dark-mode .severity-ring,
    body.dark .severity-ring,
    body.dark-theme .severity-ring {
        background:
            radial-gradient(circle at center, #111827 58%, transparent 59%),
            conic-gradient(
                #ef4444 0deg 75deg,
                #f97316 75deg 176deg,
                #f59e0b 176deg 298deg,
                #22c55e 298deg 360deg
            ) !important;
    }

    @media (max-width: 1200px) {
        .analytics-layout {
            grid-template-columns: 1fr;
        }

        .response-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .analytics-panel {
            padding: 20px;
            border-radius: 16px;
        }

        .severity-content {
            grid-template-columns: 1fr;
            justify-items: center;
        }

        .severity-list {
            width: 100%;
        }

        .response-stats-grid {
            grid-template-columns: 1fr;
        }

        .trend-bars {
            gap: 9px;
        }
    }
    /* ================================================= */
/* Analytics Chart Upgrade - Pink Purple Style */
/* ================================================= */

.analytics-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14) !important;
    backdrop-filter: blur(14px);
}

.analytics-panel-title h2::after {
    content: "";
    display: block;
    width: 52px;
    height: 4px;
    margin-top: 8px;
    border-radius: 999px;
    background: linear-gradient(90deg, #8b5cf6, #ec4899);
}

.lox-attack-chart {
    position: relative;
    height: 315px;
    border-radius: 22px;
    padding: 18px;
    overflow: hidden;
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 32%),
        linear-gradient(135deg, #ffffff, #f8f3ff 55%, #fce7f3);
    border: 1px solid rgba(168, 85, 247, 0.18);
    box-shadow: inset 0 0 0 1px rgba(255,255,255,0.6),
                0 16px 35px rgba(168, 85, 247, 0.11);
}

.attack-svg {
    width: 100%;
    height: 100%;
}

.chart-grid {
    stroke: rgba(148, 163, 184, 0.25);
    stroke-width: 1;
}

.attack-area {
    fill: url(#attackAreaGradient);
}

.attack-line {
    fill: none;
    stroke: url(#attackLineGradient);
    stroke-width: 8;
    stroke-linecap: round;
    filter: drop-shadow(0 12px 18px rgba(217, 70, 239, 0.25));
}

.chart-point {
    fill: #ffffff;
    stroke: #d946ef;
    stroke-width: 5;
    filter: drop-shadow(0 8px 12px rgba(168, 85, 247, 0.24));
}

.chart-point.peak {
    stroke: #ec4899;
    stroke-width: 6;
}

.chart-label {
    fill: #64748b;
    font-size: 14px;
    font-weight: 800;
}

.attack-chart-info {
    position: absolute;
    right: 26px;
    top: 24px;
    min-width: 150px;
    padding: 15px 16px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.78);
    border: 1px solid rgba(168, 85, 247, 0.16);
    box-shadow: 0 16px 32px rgba(168, 85, 247, 0.12);
    backdrop-filter: blur(12px);
}

.attack-chart-info span {
    display: block;
    color: #94a3b8;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 5px;
}

.attack-chart-info strong {
    display: block;
    color: #0f172a;
    font-size: 22px;
    font-weight: 950;
}

.attack-chart-info small {
    display: block;
    margin-top: 4px;
    color: #7c3aed;
    font-size: 12px;
    font-weight: 800;
}

/* Severity Distribution biar lebih bagus */
.severity-content {
    gap: 28px !important;
}

.severity-ring {
    position: relative;
    background:
        radial-gradient(circle at center, #ffffff 56%, transparent 57%),
        conic-gradient(
            #ef4444 0deg 75deg,
            #f97316 75deg 176deg,
            #f59e0b 176deg 298deg,
            #22c55e 298deg 360deg
        ) !important;
    box-shadow: 0 22px 45px rgba(249, 115, 22, 0.18);
}

.severity-ring::before {
    content: "";
    position: absolute;
    inset: -12px;
    border-radius: 50%;
    background: conic-gradient(
        rgba(239, 68, 68, 0.18),
        rgba(249, 115, 22, 0.18),
        rgba(245, 158, 11, 0.18),
        rgba(34, 197, 94, 0.18),
        rgba(239, 68, 68, 0.18)
    );
    z-index: -1;
    filter: blur(10px);
}

.severity-item {
    background: linear-gradient(135deg, #ffffff, #fbf5ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
    transition: 0.2s ease;
}

.severity-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.13);
}

/* Response Statistics card */
.response-stat-card {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 14px 30px rgba(168, 85, 247, 0.10);
}

.response-stat-card:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.response-stat-card:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #dbeafe) !important;
}

.response-stat-card:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
}

.response-progress-area {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 32%),
        linear-gradient(135deg, #ffffff, #fbf5ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
}

/* Dark mode */
body.dark-mode .lox-attack-chart,
body.dark .lox-attack-chart,
body.dark-theme .lox-attack-chart,
body.dark-mode .analytics-panel,
body.dark .analytics-panel,
body.dark-theme .analytics-panel,
body.dark-mode .severity-item,
body.dark .severity-item,
body.dark-theme .severity-item,
body.dark-mode .response-stat-card,
body.dark .response-stat-card,
body.dark-theme .response-stat-card,
body.dark-mode .response-progress-area,
body.dark .response-progress-area,
body.dark-theme .response-progress-area {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
    color: #f8fafc !important;
}

body.dark-mode .attack-chart-info,
body.dark .attack-chart-info,
body.dark-theme .attack-chart-info {
    background: rgba(17, 24, 39, 0.82) !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .attack-chart-info strong,
body.dark .attack-chart-info strong,
body.dark-theme .attack-chart-info strong {
    color: #f8fafc !important;
}

body.dark-mode .chart-label,
body.dark .chart-label,
body.dark-theme .chart-label {
    fill: #94a3b8 !important;
}

body.dark-mode .severity-ring,
body.dark .severity-ring,
body.dark-theme .severity-ring {
    background:
        radial-gradient(circle at center, #111827 56%, transparent 57%),
        conic-gradient(
            #ef4444 0deg 75deg,
            #f97316 75deg 176deg,
            #f59e0b 176deg 298deg,
            #22c55e 298deg 360deg
        ) !important;
}
.lox-attack-chart {
    position: relative;
    height: 315px;
    border-radius: 22px;
    padding: 18px;
    overflow: hidden;
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.14), transparent 32%),
        linear-gradient(135deg, #ffffff, #f8f3ff 55%, #fce7f3);
    border: 1px solid rgba(168, 85, 247, 0.18);
    box-shadow:
        inset 0 0 0 1px rgba(255,255,255,0.6),
        0 16px 35px rgba(168, 85, 247, 0.11);
}

.attack-svg {
    width: 100%;
    height: 100%;
}

.chart-grid {
    stroke: rgba(148, 163, 184, 0.25);
    stroke-width: 1;
}

.attack-area {
    fill: url(#attackAreaGradient);
}

.attack-line {
    fill: none;
    stroke: url(#attackLineGradient);
    stroke-width: 8;
    stroke-linecap: round;
    filter: drop-shadow(0 12px 18px rgba(217, 70, 239, 0.25));
}

.chart-point {
    fill: #ffffff;
    stroke: #d946ef;
    stroke-width: 5;
    filter: drop-shadow(0 8px 12px rgba(168, 85, 247, 0.24));
}

.chart-point.peak {
    stroke: #ec4899;
    stroke-width: 6;
}

.chart-label {
    fill: #64748b;
    font-size: 14px;
    font-weight: 800;
}

.attack-chart-info {
    position: absolute;
    right: 26px;
    top: 24px;
    min-width: 150px;
    padding: 15px 16px;
    border-radius: 18px;
    background: rgba(255, 255, 255, 0.78);
    border: 1px solid rgba(168, 85, 247, 0.16);
    box-shadow: 0 16px 32px rgba(168, 85, 247, 0.12);
    backdrop-filter: blur(12px);
}

.attack-chart-info span {
    display: block;
    color: #94a3b8;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 5px;
}

.attack-chart-info strong {
    display: block;
    color: #0f172a;
    font-size: 22px;
    font-weight: 950;
}

.attack-chart-info small {
    display: block;
    margin-top: 4px;
    color: #7c3aed;
    font-size: 12px;
    font-weight: 800;
}

/* Dark mode */
body.dark-mode .lox-attack-chart,
body.dark .lox-attack-chart,
body.dark-theme .lox-attack-chart {
    background: linear-gradient(135deg, #111827, #241638) !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .attack-chart-info,
body.dark .attack-chart-info,
body.dark-theme .attack-chart-info {
    background: rgba(17, 24, 39, 0.82) !important;
    border-color: #3b2a55 !important;
}

body.dark-mode .attack-chart-info strong,
body.dark .attack-chart-info strong,
body.dark-theme .attack-chart-info strong {
    color: #f8fafc !important;
}

body.dark-mode .chart-label,
body.dark .chart-label,
body.dark-theme .chart-label {
    fill: #94a3b8 !important;
}
</style>
@endsection