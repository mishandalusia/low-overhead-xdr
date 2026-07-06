@extends('layouts.app-dashboard')

@section('content')
<div class="threat-detection-page">

    <div class="page-heading">
        <div>
            <h1>Threat Detection</h1>
            <p>Analyze detected threats, anomaly score, risk level, and detection history.</p>
        </div>
    </div>

    <div class="threat-layout">

        <section class="threat-panel threat-list-panel">
            <div class="panel-title">
                <span>Threat List</span>
                <h2>Detected Threats</h2>
                <p>Latest suspicious activity found from monitored agents.</p>
            </div>

            <div class="threat-list">
                <button class="threat-item active" data-threat="1">
                    <div>
                        <strong>Suspicious Login Pattern</strong>
                        <small>Web Server • 2 minutes ago</small>
                    </div>
                    <span class="risk-badge critical">Critical</span>
                </button>

                <button class="threat-item" data-threat="2">
                    <div>
                        <strong>Abnormal Network Traffic</strong>
                        <small>Firewall Node • 12 minutes ago</small>
                    </div>
                    <span class="risk-badge high">High</span>
                </button>

                <button class="threat-item" data-threat="3">
                    <div>
                        <strong>Unauthorized File Access</strong>
                        <small>Database Server • 25 minutes ago</small>
                    </div>
                    <span class="risk-badge medium">Medium</span>
                </button>

                <button class="threat-item" data-threat="4">
                    <div>
                        <strong>Unusual Process Activity</strong>
                        <small>Endpoint Client • 1 hour ago</small>
                    </div>
                    <span class="risk-badge low">Low</span>
                </button>
            </div>
        </section>

        <section class="threat-panel score-panel">
            <div class="panel-title">
                <span>Anomaly Score Display</span>
                <h2 id="scoreTitle">Suspicious Login Pattern</h2>
                <p id="scoreDescription">Multiple login attempts were detected outside normal behavior.</p>
            </div>

            <div class="score-display">
                <div class="score-ring">
                    <h3 id="anomalyScore">94</h3>
                    <small>/100</small>
                </div>

                <div class="score-info">
                    <strong id="scoreLabel">Severe anomaly detected</strong>
                    <p id="scoreNote">This activity needs immediate review because the score is above the critical threshold.</p>
                </div>
            </div>

            <div class="score-bar">
                <div id="scoreBarFill" style="width: 94%;"></div>
            </div>
        </section>

        <section class="threat-panel risk-panel">
            <div class="panel-title">
                <span>Risk Classification</span>
                <h2>Current Risk Level</h2>
                <p>Threat priority based on anomaly score and potential impact.</p>
            </div>

            <div class="risk-current">
                <span id="riskDot" class="risk-dot critical"></span>
                <div>
                    <h3 id="riskLevel">Critical Risk</h3>
                    <p id="riskSummary">Immediate investigation is required to prevent possible system compromise.</p>
                </div>
            </div>

            <div class="risk-scale">
                <div class="risk-scale-item">
                    <span class="risk-dot low"></span>
                    <strong>Low</strong>
                    <small>0 - 39</small>
                </div>

                <div class="risk-scale-item">
                    <span class="risk-dot medium"></span>
                    <strong>Medium</strong>
                    <small>40 - 69</small>
                </div>

                <div class="risk-scale-item">
                    <span class="risk-dot high"></span>
                    <strong>High</strong>
                    <small>70 - 89</small>
                </div>

                <div class="risk-scale-item">
                    <span class="risk-dot critical"></span>
                    <strong>Critical</strong>
                    <small>90 - 100</small>
                </div>
            </div>
        </section>

    </div>

    <section class="threat-panel detection-history-panel">
        <div class="panel-title">
            <span>Detection History</span>
            <h2>Recent Detection Activity</h2>
            <p>Timeline of detected threat activity from monitored endpoints.</p>
        </div>

        <div class="history-list">
            <div class="history-item">
                <span class="history-line critical"></span>
                <div class="history-content">
                    <div>
                        <strong>Suspicious Login Pattern</strong>
                        <small>Critical Risk</small>
                    </div>
                    <p>Repeated failed login attempts detected on Web Server.</p>
                    <b>2 minutes ago</b>
                </div>
            </div>

            <div class="history-item">
                <span class="history-line high"></span>
                <div class="history-content">
                    <div>
                        <strong>Abnormal Network Traffic</strong>
                        <small>High Risk</small>
                    </div>
                    <p>Unusual outbound traffic pattern detected from Firewall Node.</p>
                    <b>12 minutes ago</b>
                </div>
            </div>

            <div class="history-item">
                <span class="history-line medium"></span>
                <div class="history-content">
                    <div>
                        <strong>Unauthorized File Access</strong>
                        <small>Medium Risk</small>
                    </div>
                    <p>Restricted file access attempt detected on Database Server.</p>
                    <b>25 minutes ago</b>
                </div>
            </div>

            <div class="history-item">
                <span class="history-line low"></span>
                <div class="history-content">
                    <div>
                        <strong>Unusual Process Activity</strong>
                        <small>Low Risk</small>
                    </div>
                    <p>Unknown background process was detected on Endpoint Client.</p>
                    <b>1 hour ago</b>
                </div>
            </div>
        </div>
    </section>

</div>

<style>
    .threat-detection-page {
        width: 100%;
        animation: threatFadeIn 0.45s ease;
    }

    @keyframes threatFadeIn {
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

    .threat-layout {
        display: grid;
        grid-template-columns: 1.1fr 1fr 1fr;
        gap: 22px;
        margin-bottom: 22px;
    }

    .threat-panel {
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
        line-height: 1.5;
    }

    .threat-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .threat-item {
        width: 100%;
        border: 1px solid #edf0f5;
        background: #ffffff;
        border-radius: 16px;
        padding: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        text-align: left;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .threat-item:hover,
    .threat-item.active {
        border-color: #c084fc;
        background: #faf5ff;
        transform: translateY(-1px);
    }

    .threat-item strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .threat-item small {
        display: block;
        margin-top: 5px;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
    }

    .risk-badge {
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 850;
        white-space: nowrap;
    }

    .risk-badge.critical {
        background: #fee2e2;
        color: #dc2626;
    }

    .risk-badge.high {
        background: #ffedd5;
        color: #ea580c;
    }

    .risk-badge.medium {
        background: #fef3c7;
        color: #d97706;
    }

    .risk-badge.low {
        background: #dcfce7;
        color: #059669;
    }

    .score-display {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 22px;
    }

    .score-ring {
        width: 124px;
        height: 124px;
        border-radius: 50%;
        background: radial-gradient(circle at center, #ffffff 58%, transparent 59%),
                    conic-gradient(#ef4444 0deg 338deg, #edf0f5 338deg 360deg);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        flex-shrink: 0;
    }

    .score-ring h3 {
        margin: 0;
        color: #0f172a;
        font-size: 34px;
        font-weight: 950;
        letter-spacing: -1px;
    }

    .score-ring small {
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
    }

    .score-info strong {
        display: block;
        color: #0f172a;
        font-size: 16px;
        font-weight: 900;
        margin-bottom: 7px;
    }

    .score-info p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 600;
    }

    .score-bar {
        width: 100%;
        height: 9px;
        background: #edf0f5;
        border-radius: 999px;
        overflow: hidden;
    }

    .score-bar div {
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(90deg, #8b5cf6, #ef4444);
        transition: 0.25s ease;
    }

    .risk-current {
        display: flex;
        gap: 14px;
        padding: 18px;
        border-radius: 16px;
        background: #faf5ff;
        border: 1px solid #eadcff;
        margin-bottom: 20px;
    }

    .risk-current h3 {
        margin: 0;
        color: #0f172a;
        font-size: 19px;
        font-weight: 900;
    }

    .risk-current p {
        margin: 7px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        font-weight: 600;
    }

    .risk-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
        margin-top: 5px;
    }

    .risk-dot.critical {
        background: #ef4444;
        box-shadow: 0 0 0 5px rgba(239, 68, 68, 0.12);
    }

    .risk-dot.high {
        background: #f97316;
        box-shadow: 0 0 0 5px rgba(249, 115, 22, 0.12);
    }

    .risk-dot.medium {
        background: #f59e0b;
        box-shadow: 0 0 0 5px rgba(245, 158, 11, 0.12);
    }

    .risk-dot.low {
        background: #22c55e;
        box-shadow: 0 0 0 5px rgba(34, 197, 94, 0.12);
    }

    .risk-scale {
        display: grid;
        grid-template-columns: 1fr;
        gap: 11px;
    }

    .risk-scale-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border-top: 1px solid #edf0f5;
        padding-top: 13px;
    }

    .risk-scale-item strong {
        flex: 1;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .risk-scale-item small {
        color: #64748b;
        font-size: 12px;
        font-weight: 800;
    }

    .detection-history-panel {
        margin-bottom: 24px;
    }

    .history-list {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .history-item {
        display: flex;
        gap: 13px;
        border: 1px solid #edf0f5;
        border-radius: 16px;
        padding: 17px;
        background: #ffffff;
    }

    .history-line {
        width: 5px;
        border-radius: 999px;
        flex-shrink: 0;
    }

    .history-line.critical {
        background: #ef4444;
    }

    .history-line.high {
        background: #f97316;
    }

    .history-line.medium {
        background: #f59e0b;
    }

    .history-line.low {
        background: #22c55e;
    }

    .history-content strong {
        display: block;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
    }

    .history-content small {
        display: block;
        color: #7c3aed;
        font-size: 12px;
        font-weight: 800;
        margin-top: 4px;
    }

    .history-content p {
        margin: 10px 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
        font-weight: 600;
    }

    .history-content b {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 850;
    }

    @media (max-width: 1200px) {
        .threat-layout {
            grid-template-columns: 1fr;
        }

        .history-list {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .page-heading h1 {
            font-size: 25px;
        }

        .threat-panel {
            padding: 20px;
            border-radius: 16px;
        }

        .threat-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .score-display {
            flex-direction: column;
            align-items: flex-start;
        }

        .history-list {
            grid-template-columns: 1fr;
        }
    }
    /* ================================================= */
/* Threat Detection - Pink Purple UI Upgrade */
/* Paste paling bawah CSS threat-detection.blade.php */
/* ================================================= */

.threat-detection-page {
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
.threat-panel {
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

/* Threat List */
.threat-item {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.threat-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.threat-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.threat-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.threat-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.threat-item:hover,
.threat-item.active {
    background: linear-gradient(90deg, rgba(243, 232, 255, 0.95), rgba(252, 231, 243, 0.95)) !important;
    border-color: #a855f7 !important;
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.15);
}

.threat-item strong {
    color: #0f172a !important;
}

.threat-item small {
    color: #64748b !important;
}

/* Risk badge lebih soft */
.risk-badge.critical {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}

.risk-badge.high {
    background: #ffedd5 !important;
    color: #ea580c !important;
}

.risk-badge.medium {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.risk-badge.low {
    background: #dcfce7 !important;
    color: #059669 !important;
}

/* Anomaly Score Panel */
.score-panel {
    background:
        radial-gradient(circle at top right, rgba(239, 68, 68, 0.10), transparent 35%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
        rgba(255, 255, 255, 0.92) !important;
}

/* Ring score */
.score-ring {
    box-shadow: 0 18px 38px rgba(239, 68, 68, 0.16);
}

.score-ring h3 {
    color: #0f172a !important;
}

.score-ring small {
    color: #64748b !important;
}

.score-info strong {
    color: #0f172a !important;
}

.score-info p {
    color: #64748b !important;
}

/* Score bar */
.score-bar {
    background: rgba(203, 213, 225, 0.55) !important;
}

.score-bar div {
    background: linear-gradient(90deg, #8b5cf6, #ec4899, #ef4444) !important;
}

/* Risk Classification */
.risk-current {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.13), transparent 35%),
        linear-gradient(135deg, #ffffff, #f3e8ff) !important;
    border: 1px solid rgba(168, 85, 247, 0.18) !important;
    box-shadow: 0 14px 30px rgba(168, 85, 247, 0.10);
}

.risk-current h3 {
    color: #0f172a !important;
}

.risk-current p {
    color: #64748b !important;
}

/* Risk scale rows */
.risk-scale-item {
    border-top: 1px solid rgba(168, 85, 247, 0.14) !important;
    padding: 14px 12px !important;
    border-radius: 14px;
}

.risk-scale-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #dcfce7) !important;
}

.risk-scale-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.risk-scale-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.risk-scale-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.risk-scale-item strong {
    color: #0f172a !important;
}

.risk-scale-item small {
    color: #64748b !important;
}

/* Detection History */
.detection-history-panel {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.11), transparent 32%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.11), transparent 35%),
        rgba(255, 255, 255, 0.90) !important;
}

.history-item {
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(168, 85, 247, 0.16) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08);
    transition: 0.2s ease;
}

.history-item:nth-child(1) {
    background: linear-gradient(135deg, #ffffff, #fff1f2) !important;
}

.history-item:nth-child(2) {
    background: linear-gradient(135deg, #ffffff, #ffedd5) !important;
}

.history-item:nth-child(3) {
    background: linear-gradient(135deg, #ffffff, #fef3c7) !important;
}

.history-item:nth-child(4) {
    background: linear-gradient(135deg, #ffffff, #f3e8ff) !important;
}

.history-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
}

.history-content strong {
    color: #0f172a !important;
}

.history-content small {
    color: #7c3aed !important;
}

.history-content p {
    color: #64748b !important;
}

.history-content b {
    color: #94a3b8 !important;
}

/* Risk dots */
.risk-dot.critical,
.history-line.critical {
    background: #ef4444 !important;
}

.risk-dot.high,
.history-line.high {
    background: #f97316 !important;
}

.risk-dot.medium,
.history-line.medium {
    background: #f59e0b !important;
}

.risk-dot.low,
.history-line.low {
    background: #22c55e !important;
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

body.dark-mode .threat-panel,
body.dark .threat-panel,
body.dark-theme .threat-panel,
body.dark-mode .threat-item,
body.dark .threat-item,
body.dark-theme .threat-item,
body.dark-mode .risk-current,
body.dark .risk-current,
body.dark-theme .risk-current,
body.dark-mode .risk-scale-item,
body.dark .risk-scale-item,
body.dark-theme .risk-scale-item,
body.dark-mode .history-item,
body.dark .history-item,
body.dark-theme .history-item {
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
body.dark-mode .threat-item strong,
body.dark .threat-item strong,
body.dark-theme .threat-item strong,
body.dark-mode .score-ring h3,
body.dark .score-ring h3,
body.dark-theme .score-ring h3,
body.dark-mode .score-info strong,
body.dark .score-info strong,
body.dark-theme .score-info strong,
body.dark-mode .risk-current h3,
body.dark .risk-current h3,
body.dark-theme .risk-current h3,
body.dark-mode .risk-scale-item strong,
body.dark .risk-scale-item strong,
body.dark-theme .risk-scale-item strong,
body.dark-mode .history-content strong,
body.dark .history-content strong,
body.dark-theme .history-content strong {
    color: #f8fafc !important;
}

body.dark-mode .page-heading p,
body.dark .page-heading p,
body.dark-theme .page-heading p,
body.dark-mode .panel-title p,
body.dark .panel-title p,
body.dark-theme .panel-title p,
body.dark-mode .threat-item small,
body.dark .threat-item small,
body.dark-theme .threat-item small,
body.dark-mode .score-ring small,
body.dark .score-ring small,
body.dark-theme .score-ring small,
body.dark-mode .score-info p,
body.dark .score-info p,
body.dark-theme .score-info p,
body.dark-mode .risk-current p,
body.dark .risk-current p,
body.dark-theme .risk-current p,
body.dark-mode .risk-scale-item small,
body.dark .risk-scale-item small,
body.dark-theme .risk-scale-item small,
body.dark-mode .history-content p,
body.dark .history-content p,
body.dark-theme .history-content p {
    color: #94a3b8 !important;
}
</style>

<script>
    const threatData = {
        1: {
            title: 'Suspicious Login Pattern',
            description: 'Multiple login attempts were detected outside normal behavior.',
            score: 94,
            risk: 'Critical Risk',
            dot: 'risk-dot critical',
            label: 'Severe anomaly detected',
            note: 'This activity needs immediate review because the score is above the critical threshold.',
            summary: 'Immediate investigation is required to prevent possible system compromise.',
            color: 'linear-gradient(90deg, #8b5cf6, #ef4444)',
            ring: 'radial-gradient(circle at center, #ffffff 58%, transparent 59%), conic-gradient(#ef4444 0deg 338deg, #edf0f5 338deg 360deg)'
        },
        2: {
            title: 'Abnormal Network Traffic',
            description: 'Unusual outbound traffic was detected from a monitored network node.',
            score: 82,
            risk: 'High Risk',
            dot: 'risk-dot high',
            label: 'High anomaly detected',
            note: 'This activity should be reviewed because it may indicate suspicious traffic movement.',
            summary: 'Investigation is recommended to confirm whether the traffic is legitimate.',
            color: 'linear-gradient(90deg, #8b5cf6, #f97316)',
            ring: 'radial-gradient(circle at center, #ffffff 58%, transparent 59%), conic-gradient(#f97316 0deg 295deg, #edf0f5 295deg 360deg)'
        },
        3: {
            title: 'Unauthorized File Access',
            description: 'Restricted file access was detected from a user session.',
            score: 63,
            risk: 'Medium Risk',
            dot: 'risk-dot medium',
            label: 'Moderate anomaly detected',
            note: 'This activity needs validation to confirm whether the access was authorized.',
            summary: 'Review user permission and file access logs for possible policy violation.',
            color: 'linear-gradient(90deg, #8b5cf6, #f59e0b)',
            ring: 'radial-gradient(circle at center, #ffffff 58%, transparent 59%), conic-gradient(#f59e0b 0deg 227deg, #edf0f5 227deg 360deg)'
        },
        4: {
            title: 'Unusual Process Activity',
            description: 'Unknown background process activity was detected on an endpoint.',
            score: 34,
            risk: 'Low Risk',
            dot: 'risk-dot low',
            label: 'Minor anomaly detected',
            note: 'This activity is currently low priority but still recorded for monitoring.',
            summary: 'Continue monitoring the endpoint for repeated or escalating behavior.',
            color: 'linear-gradient(90deg, #8b5cf6, #22c55e)',
            ring: 'radial-gradient(circle at center, #ffffff 58%, transparent 59%), conic-gradient(#22c55e 0deg 122deg, #edf0f5 122deg 360deg)'
        }
    };

    const threatItems = document.querySelectorAll('.threat-item');
    const scoreRing = document.querySelector('.score-ring');
    const scoreBarFill = document.getElementById('scoreBarFill');

    threatItems.forEach(item => {
        item.addEventListener('click', () => {
            threatItems.forEach(threat => threat.classList.remove('active'));
            item.classList.add('active');

            const data = threatData[item.dataset.threat];

            document.getElementById('scoreTitle').textContent = data.title;
            document.getElementById('scoreDescription').textContent = data.description;
            document.getElementById('anomalyScore').textContent = data.score;
            document.getElementById('scoreLabel').textContent = data.label;
            document.getElementById('scoreNote').textContent = data.note;
            document.getElementById('riskLevel').textContent = data.risk;
            document.getElementById('riskSummary').textContent = data.summary;
            document.getElementById('riskDot').className = data.dot;

            scoreBarFill.style.width = data.score + '%';
            scoreBarFill.style.background = data.color;
            scoreRing.style.background = data.ring;
        });
    });
</script>
@endsection