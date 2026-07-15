@extends('layouts.app-dashboard')

@section('content')

<div class="tdx-page" id="threatDetectionPage">

    <div class="tdx-heading">
        <h1>Threat Detection</h1>
        <p>Detected threats from monitored endpoints and suspicious activities.</p>
    </div>

    <div class="tdx-summary-grid">
        <div class="tdx-summary-card critical">
            <div class="tdx-summary-icon">CR</div>
            <div>
                <span>Critical Threats</span>
                <h2>8</h2>
                <p>Need immediate attention</p>
            </div>
        </div>

        <div class="tdx-summary-card high">
            <div class="tdx-summary-icon">HI</div>
            <div>
                <span>High Threats</span>
                <h2>15</h2>
                <p>Potential security risks</p>
            </div>
        </div>

        <div class="tdx-summary-card medium">
            <div class="tdx-summary-icon">ME</div>
            <div>
                <span>Medium Threats</span>
                <h2>21</h2>
                <p>Require monitoring</p>
            </div>
        </div>

        <div class="tdx-summary-card low">
            <div class="tdx-summary-icon">LO</div>
            <div>
                <span>Low Threats</span>
                <h2>31</h2>
                <p>Informational activity</p>
            </div>
        </div>
    </div>

    <div class="tdx-panel">
        <div class="tdx-panel-header">
            <h3>Detected Threat List</h3>
            <p>Threat records detected from Wazuh alerts and behavioral anomaly monitoring.</p>
        </div>

        <div class="tdx-list-header">
            <span>Time</span>
            <span>Threat</span>
            <span>Source</span>
            <span>Severity</span>
        </div>

        <div class="tdx-threat-list">

            <div class="tdx-threat-row high">
                <div class="tdx-time">11:20</div>

                <div class="tdx-threat-info">
                    <strong>Nmap Reconnaissance</strong>
                    <small>Network scanning activity detected</small>
                </div>

                <div class="tdx-source">10.67.xx.xx</div>

                <div>
                    <span class="tdx-severity high">High</span>
                </div>
            </div>

            <div class="tdx-threat-row critical">
                <div class="tdx-time">11:25</div>

                <div class="tdx-threat-info">
                    <strong>Transaction Behaviour Anomaly</strong>
                    <small>Unusual transaction pattern detected</small>
                </div>

                <div class="tdx-source">User A</div>

                <div>
                    <span class="tdx-severity critical">Critical</span>
                </div>
            </div>

            <div class="tdx-threat-row medium">
                <div class="tdx-time">11:32</div>

                <div class="tdx-threat-info">
                    <strong>Brute Force Login Attempt</strong>
                    <small>Repeated failed login activity</small>
                </div>

                <div class="tdx-source">192.168.1.20</div>

                <div>
                    <span class="tdx-severity medium">Medium</span>
                </div>
            </div>

            <div class="tdx-threat-row critical">
                <div class="tdx-time">11:40</div>

                <div class="tdx-threat-info">
                    <strong>Malware Communication</strong>
                    <small>Suspicious outbound connection</small>
                </div>

                <div class="tdx-source">192.168.1.45</div>

                <div>
                    <span class="tdx-severity critical">Critical</span>
                </div>
            </div>

            <div class="tdx-threat-row high">
                <div class="tdx-time">11:46</div>

                <div class="tdx-threat-info">
                    <strong>SQL Injection Attempt</strong>
                    <small>Suspicious database query pattern</small>
                </div>

                <div class="tdx-source">172.16.xx.xx</div>

                <div>
                    <span class="tdx-severity high">High</span>
                </div>
            </div>

        </div>
    </div>

</div>

<style>
    .tdx-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .tdx-heading {
        margin-bottom: 26px;
    }

    .tdx-heading h1 {
        margin: 0;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .tdx-heading p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .tdx-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .tdx-summary-card {
        position: relative;
        overflow: hidden;
        min-height: 128px;
        padding: 24px;
        border-radius: 26px;
        display: flex;
        align-items: center;
        gap: 18px;
        background:
            radial-gradient(circle at top right, rgba(168, 85, 247, 0.20), transparent 36%),
            radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.16), transparent 36%),
            linear-gradient(135deg, #ffffff, #f8f3ff) !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 18px 42px rgba(168, 85, 247, 0.10) !important;
    }

    .tdx-summary-card::before {
        content: "";
        position: absolute;
        width: 135px;
        height: 135px;
        right: -45px;
        top: -48px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.18);
    }

    .tdx-summary-card::after {
        content: "";
        position: absolute;
        width: 95px;
        height: 95px;
        right: 28px;
        bottom: -44px;
        border-radius: 50%;
        background: rgba(236, 72, 153, 0.15);
    }

    .tdx-summary-card > * {
        position: relative;
        z-index: 2;
    }

    .tdx-summary-card.critical {
        background:
            radial-gradient(circle at top right, rgba(239, 68, 68, 0.20), transparent 36%),
            linear-gradient(135deg, #ffffff, #fee2e2) !important;
    }

    .tdx-summary-card.high {
        background:
            radial-gradient(circle at top right, rgba(249, 115, 22, 0.20), transparent 36%),
            linear-gradient(135deg, #ffffff, #ffedd5) !important;
    }

    .tdx-summary-card.medium {
        background:
            radial-gradient(circle at top right, rgba(245, 158, 11, 0.20), transparent 36%),
            linear-gradient(135deg, #ffffff, #fef3c7) !important;
    }

    .tdx-summary-card.low {
        background:
            radial-gradient(circle at top right, rgba(34, 197, 94, 0.20), transparent 36%),
            linear-gradient(135deg, #ffffff, #dcfce7) !important;
    }

    .tdx-summary-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #ffffff !important;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        color: #7c3aed !important;
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 14px 30px rgba(168, 85, 247, 0.14);
    }

    .tdx-summary-card span {
        color: #64748b !important;
        font-size: 13px;
        font-weight: 900;
    }

    .tdx-summary-card h2 {
        margin: 7px 0 4px;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .tdx-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .tdx-panel {
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

    .tdx-panel::before {
        content: "💎";
        position: absolute;
        right: 30px;
        top: 20px;
        font-size: 58px;
        opacity: 0.08;
        pointer-events: none;
    }

    .tdx-panel-header {
        position: relative;
        z-index: 2;
        margin-bottom: 24px;
    }

    .tdx-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 23px;
        font-weight: 950;
        letter-spacing: -0.4px;
    }

    .tdx-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .tdx-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .tdx-list-header {
        display: grid;
        grid-template-columns: 150px 1.6fr 0.75fr 0.65fr;
        gap: 18px;
        padding: 0 20px 10px;
        color: #64748b;
        font-size: 13px;
        font-weight: 950;
    }

    .tdx-threat-list {
        display: grid;
        gap: 14px;
    }

    .tdx-threat-row {
        display: grid;
        grid-template-columns: 150px 1.6fr 0.75fr 0.65fr;
        align-items: center;
        gap: 18px;
        min-height: 78px;
        padding: 18px 20px;
        border-radius: 20px;
        border: 1px solid rgba(168, 85, 247, 0.18) !important;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    }

    .tdx-threat-row.high {
        background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
    }

    .tdx-threat-row.critical {
        background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
    }

    .tdx-threat-row.medium {
        background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
    }

    .tdx-time,
    .tdx-source {
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .tdx-threat-info strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .tdx-threat-info small {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .tdx-severity {
        display: inline-flex;
        justify-content: center;
        min-width: 92px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .tdx-severity.critical {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .tdx-severity.high {
        background: #ffedd5 !important;
        color: #ea580c !important;
    }

    .tdx-severity.medium {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .tdx-severity.low {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    /* =============================== */
    /* DARK MODE AUTO SUPPORT */
    /* =============================== */

    body.dark-mode .tdx-heading h1,
    body.dark .tdx-heading h1,
    body.dark-theme .tdx-heading h1,
    .tdx-page.tdx-dark .tdx-heading h1 {
        color: #ffffff !important;
        text-shadow: 0 5px 18px rgba(15, 23, 42, 0.35);
    }

    body.dark-mode .tdx-heading p,
    body.dark .tdx-heading p,
    body.dark-theme .tdx-heading p,
    .tdx-page.tdx-dark .tdx-heading p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .tdx-summary-card,
    body.dark .tdx-summary-card,
    body.dark-theme .tdx-summary-card,
    .tdx-page.tdx-dark .tdx-summary-card {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.14), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .tdx-panel,
    body.dark .tdx-panel,
    body.dark-theme .tdx-panel,
    .tdx-page.tdx-dark .tdx-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .tdx-summary-icon,
    body.dark .tdx-summary-icon,
    body.dark-theme .tdx-summary-icon,
    .tdx-page.tdx-dark .tdx-summary-icon {
        background: rgba(15, 23, 42, 0.92) !important;
        border-color: rgba(168, 85, 247, 0.36) !important;
        color: #a855f7 !important;
    }

    body.dark-mode .tdx-summary-card span,
    body.dark .tdx-summary-card span,
    body.dark-theme .tdx-summary-card span,
    body.dark-mode .tdx-summary-card p,
    body.dark .tdx-summary-card p,
    body.dark-theme .tdx-summary-card p,
    body.dark-mode .tdx-panel-header p,
    body.dark .tdx-panel-header p,
    body.dark-theme .tdx-panel-header p,
    body.dark-mode .tdx-list-header,
    body.dark .tdx-list-header,
    body.dark-theme .tdx-list-header,
    .tdx-page.tdx-dark .tdx-summary-card span,
    .tdx-page.tdx-dark .tdx-summary-card p,
    .tdx-page.tdx-dark .tdx-panel-header p,
    .tdx-page.tdx-dark .tdx-list-header {
        color: #cbd5e1 !important;
    }

    body.dark-mode .tdx-summary-card h2,
    body.dark .tdx-summary-card h2,
    body.dark-theme .tdx-summary-card h2,
    body.dark-mode .tdx-panel-header h3,
    body.dark .tdx-panel-header h3,
    body.dark-theme .tdx-panel-header h3,
    .tdx-page.tdx-dark .tdx-summary-card h2,
    .tdx-page.tdx-dark .tdx-panel-header h3 {
        color: #ffffff !important;
    }

    body.dark-mode .tdx-threat-row.high,
    body.dark .tdx-threat-row.high,
    body.dark-theme .tdx-threat-row.high,
    .tdx-page.tdx-dark .tdx-threat-row.high {
        background: linear-gradient(135deg, #111827, #2e1a26) !important;
    }

    body.dark-mode .tdx-threat-row.critical,
    body.dark .tdx-threat-row.critical,
    body.dark-theme .tdx-threat-row.critical,
    .tdx-page.tdx-dark .tdx-threat-row.critical {
        background: linear-gradient(135deg, #111827, #25163d) !important;
    }

    body.dark-mode .tdx-threat-row.medium,
    body.dark .tdx-threat-row.medium,
    body.dark-theme .tdx-threat-row.medium,
    .tdx-page.tdx-dark .tdx-threat-row.medium {
        background: linear-gradient(135deg, #111827, #3b1a2c) !important;
    }

    body.dark-mode .tdx-threat-row,
    body.dark .tdx-threat-row,
    body.dark-theme .tdx-threat-row,
    .tdx-page.tdx-dark .tdx-threat-row {
        border-color: rgba(168, 85, 247, 0.27) !important;
        color: #ffffff !important;
    }

    body.dark-mode .tdx-time,
    body.dark .tdx-time,
    body.dark-theme .tdx-time,
    body.dark-mode .tdx-source,
    body.dark .tdx-source,
    body.dark-theme .tdx-source,
    body.dark-mode .tdx-threat-info strong,
    body.dark .tdx-threat-info strong,
    body.dark-theme .tdx-threat-info strong,
    .tdx-page.tdx-dark .tdx-time,
    .tdx-page.tdx-dark .tdx-source,
    .tdx-page.tdx-dark .tdx-threat-info strong {
        color: #ffffff !important;
    }

    body.dark-mode .tdx-threat-info small,
    body.dark .tdx-threat-info small,
    body.dark-theme .tdx-threat-info small,
    .tdx-page.tdx-dark .tdx-threat-info small {
        color: #cbd5e1 !important;
    }

    @media (max-width: 1200px) {
        .tdx-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .tdx-list-header,
        .tdx-threat-row {
            grid-template-columns: 120px 1.4fr 0.8fr 0.7fr;
        }
    }

    @media (max-width: 768px) {
        .tdx-summary-grid {
            grid-template-columns: 1fr;
        }

        .tdx-list-header {
            display: none;
        }

        .tdx-threat-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('threatDetectionPage');

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

        function syncThreatTheme() {
            if (!page) return;

            if (isDarkTheme()) {
                page.classList.add('tdx-dark');
            } else {
                page.classList.remove('tdx-dark');
            }
        }

        syncThreatTheme();

        const observer = new MutationObserver(syncThreatTheme);

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
                setTimeout(syncThreatTheme, 50);
            });
        }

        window.addEventListener('storage', syncThreatTheme);
    });
</script>

@endsection