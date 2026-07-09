@extends('layouts.app-dashboard')

@section('content')

<div class="reports-page">

    <!-- Header / Hero -->
    <div class="reports-hero">
        <div class="hero-content">
            <span>Security Report</span>
            <h1>Reports</h1>
            <p>Analyze weekly attack trends, alert severity distribution, and export security reports.</p>

            <div class="hero-badges">
                <div>
                    <small>Total Attacks</small>
                    <strong>1,244</strong>
                </div>

                <div>
                    <small>Critical Alerts</small>
                    <strong>90</strong>
                </div>

                <div>
                    <small>Report Status</small>
                    <strong>Ready</strong>
                </div>
            </div>
        </div>

        <div class="report-actions">
            <button type="button" onclick="window.print()" class="export-btn pdf">
                Export PDF
            </button>

            <button type="button" onclick="exportCSV()" class="export-btn csv">
                Export CSV
            </button>
        </div>
    </div>

    <div class="reports-grid">

        <!-- Attack Trends -->
        <div class="report-panel trend-panel">
            <div class="panel-header">
                <div>
                    <span>Attack Trends</span>
                    <h3>Weekly Attack Activity</h3>
                    <p>Attack movement detected across monitored endpoints during the last 7 days.</p>
                </div>
            </div>

            <div class="attack-chart-box">
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
                        d="M70 215 C130 150, 170 140, 215 170 C270 210, 305 130, 350 118 C405 105, 430 205, 480 190 C545 172, 560 88, 625 94 C690 100, 705 42, 755 60 C812 78, 815 145, 850 128 L850 270 L70 270 Z"
                        class="attack-area"
                    />

                    <path
                        d="M70 215 C130 150, 170 140, 215 170 C270 210, 305 130, 350 118 C405 105, 430 205, 480 190 C545 172, 560 88, 625 94 C690 100, 705 42, 755 60 C812 78, 815 145, 850 128"
                        class="attack-line"
                    />

                    <circle cx="70" cy="215" r="7" class="chart-point"/>
                    <circle cx="215" cy="170" r="7" class="chart-point"/>
                    <circle cx="350" cy="118" r="7" class="chart-point"/>
                    <circle cx="480" cy="190" r="7" class="chart-point"/>
                    <circle cx="625" cy="94" r="7" class="chart-point"/>
                    <circle cx="755" cy="60" r="8" class="chart-point peak"/>
                    <circle cx="850" cy="128" r="7" class="chart-point"/>

                    <text x="60" y="304" class="chart-label">Mon</text>
                    <text x="202" y="304" class="chart-label">Tue</text>
                    <text x="338" y="304" class="chart-label">Wed</text>
                    <text x="468" y="304" class="chart-label">Thu</text>
                    <text x="615" y="304" class="chart-label">Fri</text>
                    <text x="742" y="304" class="chart-label">Sat</text>
                    <text x="838" y="304" class="chart-label">Sun</text>
                </svg>

                <div class="chart-info-card">
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
                    <strong class="increasing">Increasing</strong>
                </div>
            </div>
        </div>

        <!-- Severity Distribution -->
        <div class="report-panel severity-panel">
            <div class="panel-header">
                <div>
                    <span>Severity Distribution</span>
                    <h3>Alert Severity Ratio</h3>
                    <p>Distribution of alerts based on severity category.</p>
                </div>
            </div>

            <div class="severity-total-card">
                <div>
                    <small>Total Threats</small>
                    <h2>430</h2>
                </div>
                <span>Weekly Summary</span>
            </div>

            <div class="severity-report-content">
                <div class="severity-donut">
                    <div class="donut-center">
                        <h2>430</h2>
                        <span>Total</span>
                    </div>
                </div>

                <div class="severity-report-list">
                    <div class="severity-report-row critical">
                        <div>
                            <span></span>
                            <strong>Critical</strong>
                        </div>
                        <b>90</b>
                    </div>

                    <div class="severity-report-row high">
                        <div>
                            <span></span>
                            <strong>High</strong>
                        </div>
                        <b>120</b>
                    </div>

                    <div class="severity-report-row medium">
                        <div>
                            <span></span>
                            <strong>Medium</strong>
                        </div>
                        <b>145</b>
                    </div>

                    <div class="severity-report-row low">
                        <div>
                            <span></span>
                            <strong>Low</strong>
                        </div>
                        <b>75</b>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    .reports-page {
        width: 100%;
    }

    .reports-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        margin-bottom: 26px;
        padding: 28px 30px;
        border-radius: 30px;
        background:
            radial-gradient(circle at top right, rgba(236, 72, 153, 0.32), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.24), transparent 38%),
            linear-gradient(135deg, rgba(255,255,255,0.92), rgba(253, 242, 248, 0.88));
        border: 1px solid rgba(168, 85, 247, 0.18);
        box-shadow: 0 24px 55px rgba(168, 85, 247, 0.14);
        backdrop-filter: blur(16px);
    }

    .reports-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        right: 190px;
        top: -115px;
        background: rgba(168, 85, 247, 0.16);
    }

    .reports-hero::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        right: -48px;
        bottom: -65px;
        background: rgba(236, 72, 153, 0.18);
    }

    .hero-content,
    .report-actions {
        position: relative;
        z-index: 2;
    }

    .hero-content > span {
        display: inline-flex;
        padding: 8px 14px;
        margin-bottom: 10px;
        border-radius: 999px;
        color: #7c3aed;
        background: rgba(243, 232, 255, 0.88);
        font-size: 12px;
        font-weight: 950;
    }

    .hero-content h1 {
        margin: 0;
        color: #0f172a;
        font-size: 34px;
        font-weight: 950;
        letter-spacing: -0.9px;
    }

    .hero-content p {
        margin: 8px 0 0;
        color: #64748b;
        font-size: 15px;
        font-weight: 650;
    }

    .hero-badges {
        display: flex;
        gap: 12px;
        margin-top: 18px;
        flex-wrap: wrap;
    }

    .hero-badges div {
        min-width: 135px;
        padding: 14px 16px;
        border-radius: 18px;
        background: rgba(255,255,255,0.74);
        border: 1px solid rgba(168, 85, 247, 0.14);
        box-shadow: 0 12px 28px rgba(168, 85, 247, 0.08);
    }

    .hero-badges small {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .hero-badges strong {
        color: #0f172a;
        font-size: 20px;
        font-weight: 950;
    }

    .report-actions {
        display: flex;
        gap: 12px;
        flex-shrink: 0;
    }

    .export-btn {
        border: none;
        outline: none;
        cursor: pointer;
        padding: 15px 24px;
        border-radius: 18px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 950;
        transition: 0.2s ease;
        box-shadow: 0 16px 34px rgba(168, 85, 247, 0.24);
    }

    .export-btn.pdf {
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
    }

    .export-btn.csv {
        background: linear-gradient(135deg, #111827, #3b0764);
    }

    .export-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 42px rgba(217, 70, 239, 0.32);
    }

    .reports-grid {
        display: grid;
        grid-template-columns: 1.45fr 1fr;
        gap: 24px;
        align-items: stretch;
    }

    .report-panel {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        padding: 26px;
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.12), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(168, 85, 247, 0.18);
        box-shadow: 0 24px 55px rgba(168, 85, 247, 0.13);
        backdrop-filter: blur(14px);
    }

    .trend-panel::before,
    .severity-panel::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        right: -70px;
        top: -80px;
        background: rgba(236, 72, 153, 0.12);
    }

    .trend-panel::after,
    .severity-panel::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        left: -65px;
        bottom: -70px;
        background: rgba(139, 92, 246, 0.10);
    }

    .panel-header {
        position: relative;
        z-index: 2;
    }

    .panel-header span {
        display: inline-block;
        color: #7c3aed;
        font-size: 13px;
        font-weight: 950;
        margin-bottom: 8px;
    }

    .panel-header h3 {
        margin: 0;
        color: #0f172a;
        font-size: 24px;
        font-weight: 950;
        letter-spacing: -0.5px;
    }

    .panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .panel-header p {
        margin: 10px 0 0;
        color: #64748b;
        font-size: 14px;
        font-weight: 650;
    }

    .attack-chart-box {
        position: relative;
        z-index: 2;
        height: 350px;
        margin-top: 24px;
        border-radius: 26px;
        padding: 18px;
        overflow: hidden;
        background:
            radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 35%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #ffffff, #f8f3ff 55%, #fce7f3);
        border: 1px solid rgba(168, 85, 247, 0.18);
        box-shadow:
            inset 0 0 0 1px rgba(255,255,255,0.7),
            0 18px 38px rgba(168, 85, 247, 0.13);
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
        filter: drop-shadow(0 12px 18px rgba(217, 70, 239, 0.28));
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
        font-weight: 850;
    }

    .chart-info-card {
        position: absolute;
        right: 28px;
        top: 26px;
        min-width: 160px;
        padding: 16px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.82);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
        backdrop-filter: blur(12px);
    }

    .chart-info-card span {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 5px;
    }

    .chart-info-card strong {
        display: block;
        color: #0f172a;
        font-size: 23px;
        font-weight: 950;
    }

    .chart-info-card small {
        display: block;
        margin-top: 4px;
        color: #7c3aed;
        font-size: 12px;
        font-weight: 850;
    }

    .trend-summary {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 18px;
    }

    .trend-summary div {
        padding: 18px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 10px 22px rgba(168, 85, 247, 0.06);
    }

    .trend-summary div:nth-child(2) {
        background: linear-gradient(135deg, #ffffff, #fce7f3);
    }

    .trend-summary div:nth-child(3) {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .trend-summary small {
        display: block;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 8px;
    }

    .trend-summary strong {
        color: #0f172a;
        font-size: 18px;
        font-weight: 950;
    }

    .trend-summary strong.increasing {
        color: #f59e0b;
    }

    .severity-total-card {
        position: relative;
        z-index: 2;
        margin-top: 24px;
        padding: 24px;
        border-radius: 24px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 14px;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.26), transparent 36%),
            linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
        box-shadow: 0 18px 38px rgba(217, 70, 239, 0.22);
    }

    .severity-total-card small {
        display: block;
        color: rgba(255,255,255,0.82);
        font-size: 12px;
        font-weight: 850;
        margin-bottom: 6px;
    }

    .severity-total-card h2 {
        margin: 0;
        font-size: 42px;
        font-weight: 950;
        line-height: 1;
    }

    .severity-total-card span {
        color: rgba(255,255,255,0.84);
        font-size: 12px;
        font-weight: 850;
    }

    .severity-report-content {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 28px;
        align-items: center;
        margin-top: 28px;
    }

    .severity-donut {
        position: relative;
        width: 210px;
        height: 210px;
        border-radius: 50%;
        background:
            radial-gradient(circle at center, #ffffff 56%, transparent 57%),
            conic-gradient(
                #ef4444 0deg 75deg,
                #f97316 75deg 176deg,
                #f59e0b 176deg 298deg,
                #22c55e 298deg 360deg
            );
        box-shadow: 0 22px 45px rgba(249, 115, 22, 0.18);
    }

    .severity-donut::before {
        content: "";
        position: absolute;
        inset: -14px;
        border-radius: 50%;
        background: conic-gradient(
            rgba(239, 68, 68, 0.20),
            rgba(249, 115, 22, 0.20),
            rgba(245, 158, 11, 0.20),
            rgba(34, 197, 94, 0.20),
            rgba(239, 68, 68, 0.20)
        );
        z-index: -1;
        filter: blur(12px);
    }

    .donut-center {
        position: absolute;
        inset: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background: #ffffff;
    }

    .donut-center h2 {
        margin: 0;
        color: #0f172a;
        font-size: 34px;
        font-weight: 950;
    }

    .donut-center span {
        margin-top: 4px;
        color: #64748b;
        font-size: 13px;
        font-weight: 850;
    }

    .severity-report-list {
        display: grid;
        gap: 14px;
    }

    .severity-report-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 17px 18px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff, #fbf5ff);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.07);
        transition: 0.2s ease;
    }

    .severity-report-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 34px rgba(168, 85, 247, 0.13);
    }

    .severity-report-row.critical {
        background: linear-gradient(135deg, #ffffff, #fff1f2);
    }

    .severity-report-row.high {
        background: linear-gradient(135deg, #ffffff, #fff7ed);
    }

    .severity-report-row.medium {
        background: linear-gradient(135deg, #ffffff, #fef3c7);
    }

    .severity-report-row.low {
        background: linear-gradient(135deg, #ffffff, #dcfce7);
    }

    .severity-report-row div {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .severity-report-row span {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .severity-report-row.critical span {
        background: #ef4444;
    }

    .severity-report-row.high span {
        background: #f97316;
    }

    .severity-report-row.medium span {
        background: #f59e0b;
    }

    .severity-report-row.low span {
        background: #22c55e;
    }

    .severity-report-row strong,
    .severity-report-row b {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    body.dark-mode .reports-hero,
    body.dark .reports-hero,
    body.dark-theme .reports-hero,
    body.dark-mode .report-panel,
    body.dark .report-panel,
    body.dark-theme .report-panel,
    body.dark-mode .attack-chart-box,
    body.dark .attack-chart-box,
    body.dark-theme .attack-chart-box,
    body.dark-mode .trend-summary div,
    body.dark .trend-summary div,
    body.dark-theme .trend-summary div,
    body.dark-mode .severity-report-row,
    body.dark .severity-report-row,
    body.dark-theme .severity-report-row,
    body.dark-mode .hero-badges div,
    body.dark .hero-badges div,
    body.dark-theme .hero-badges div {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    body.dark-mode .hero-content h1,
    body.dark .hero-content h1,
    body.dark-theme .hero-content h1,
    body.dark-mode .panel-header h3,
    body.dark .panel-header h3,
    body.dark-theme .panel-header h3,
    body.dark-mode .chart-info-card strong,
    body.dark .chart-info-card strong,
    body.dark-theme .chart-info-card strong,
    body.dark-mode .trend-summary strong,
    body.dark .trend-summary strong,
    body.dark-theme .trend-summary strong,
    body.dark-mode .donut-center h2,
    body.dark .donut-center h2,
    body.dark-theme .donut-center h2,
    body.dark-mode .severity-report-row strong,
    body.dark .severity-report-row strong,
    body.dark-theme .severity-report-row strong,
    body.dark-mode .severity-report-row b,
    body.dark .severity-report-row b,
    body.dark-theme .severity-report-row b,
    body.dark-mode .hero-badges strong,
    body.dark .hero-badges strong,
    body.dark-theme .hero-badges strong {
        color: #f8fafc !important;
    }

    body.dark-mode .hero-content p,
    body.dark .hero-content p,
    body.dark-theme .hero-content p,
    body.dark-mode .panel-header p,
    body.dark .panel-header p,
    body.dark-theme .panel-header p,
    body.dark-mode .trend-summary small,
    body.dark .trend-summary small,
    body.dark-theme .trend-summary small,
    body.dark-mode .donut-center span,
    body.dark .donut-center span,
    body.dark-theme .donut-center span,
    body.dark-mode .hero-badges small,
    body.dark .hero-badges small,
    body.dark-theme .hero-badges small {
        color: #94a3b8 !important;
    }

    body.dark-mode .chart-info-card,
    body.dark .chart-info-card,
    body.dark-theme .chart-info-card,
    body.dark-mode .donut-center,
    body.dark .donut-center,
    body.dark-theme .donut-center {
        background: #111827 !important;
        border-color: #3b2a55 !important;
    }

    body.dark-mode .severity-donut,
    body.dark .severity-donut,
    body.dark-theme .severity-donut {
        background:
            radial-gradient(circle at center, #111827 56%, transparent 57%),
            conic-gradient(
                #ef4444 0deg 75deg,
                #f97316 75deg 176deg,
                #f59e0b 176deg 298deg,
                #22c55e 298deg 360deg
            ) !important;
    }

    @media (max-width: 1200px) {
        .reports-hero {
            flex-direction: column;
            align-items: flex-start;
        }

        .report-actions {
            width: 100%;
        }

        .reports-grid {
            grid-template-columns: 1fr;
        }

        .severity-report-content {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .report-actions {
            flex-direction: column;
        }

        .export-btn {
            width: 100%;
        }

        .hero-badges {
            width: 100%;
        }

        .hero-badges div {
            width: 100%;
        }

        .trend-summary {
            grid-template-columns: 1fr;
        }

        .attack-chart-box {
            height: 280px;
        }
    }

    @media print {
        .sidebar,
        .topbar,
        .report-actions,
        .theme-switch-container {
            display: none !important;
        }

        .main {
            margin: 0 !important;
            padding: 24px !important;
            background: #ffffff !important;
        }

        .reports-hero,
        .report-panel {
            box-shadow: none !important;
            break-inside: avoid;
        }
    }
</style>

<script>
    function exportCSV() {
        const rows = [
            ['Report Type', 'Value', 'Description'],
            ['Total Attacks', '1244', 'Detected attack activities in the last 7 days'],
            ['Peak Day', 'Friday', 'Highest attack activity'],
            ['Trend Status', 'Increasing', 'Attack trend is increasing'],
            ['Critical', '90', 'Critical severity alerts'],
            ['High', '120', 'High severity alerts'],
            ['Medium', '145', 'Medium severity alerts'],
            ['Low', '75', 'Low severity alerts']
        ];

        const csvContent = rows.map(row => {
            return row.map(value => `"${value}"`).join(',');
        }).join('\n');

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
</script>

@endsection