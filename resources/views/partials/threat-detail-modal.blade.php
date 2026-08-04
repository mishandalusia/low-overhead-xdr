<!-- Threat Detail Modal — Shared landscape view for Dashboard, Threat Detection, & Incident Management -->
<div class="alert-detail-modal" id="alertDetailModal">
    <div class="alert-detail-card landscape">
        <button class="modal-close-btn" onclick="closeAlertDetail()" title="Close detail">×</button>

        <!-- Modal Header -->
        <div class="detail-modal-header">
            <div class="detail-header-tags">
                <span id="detailSeverityBadge" class="severity-badge-pill">High Risk</span>
                <span class="detail-category-badge" id="detailCategory">Behaviour Anomaly</span>
                <span class="detail-engine-badge" id="detailDetectionCategory">Network Detection</span>
            </div>
            <h2 id="detailAlertName">-</h2>
        </div>

        <!-- Section 1: Overview Grid (4 Columns in Landscape) -->
        <div class="detail-section-label">Overview & Transaction Metadata</div>
        <div class="detail-modal-grid">
            <div class="detail-card-item">
                <small>Date & Time</small>
                <strong><span id="detailDate">-</span> <span id="detailTime"></span></strong>
            </div>

            <div class="detail-card-item">
                <small>Rule ID & Name</small>
                <strong id="detailRuleId">-</strong>
            </div>

            <div class="detail-card-item">
                <small>Detection Source</small>
                <strong id="detailDetectionSource">-</strong>
            </div>

            <div class="detail-card-item">
                <small>Detection Engine</small>
                <strong id="detailDetectionEngine">-</strong>
            </div>

            <div class="detail-card-item">
                <small>Source IP</small>
                <strong id="detailSource" class="mono-text">-</strong>
            </div>

            <div class="detail-card-item">
                <small>Destination IP</small>
                <strong id="detailDestination" class="mono-text">-</strong>
            </div>

            <div class="detail-card-item">
                <small>Monitored Agent</small>
                <strong id="detailAgent">-</strong>
            </div>

            <div class="detail-card-item">
                <small>ML Prediction</small>
                <strong id="detailDetectionPrediction">-</strong>
            </div>

            <!-- Transaction Fields (Highlighted) -->
            <div class="detail-card-item highlight-card">
                <small>User Transaction</small>
                <strong id="detailUser" class="accent-text">-</strong>
            </div>

            <div class="detail-card-item highlight-card">
                <small>Transaction Amount</small>
                <strong id="detailAmount" class="accent-text">-</strong>
            </div>

            <div class="detail-card-item highlight-card">
                <small>Transaction Status</small>
                <strong id="detailTransactionStatus" class="accent-text">-</strong>
            </div>

            <div class="detail-card-item">
                <small>Risk Level</small>
                <strong id="detailRisk">-</strong>
            </div>
        </div>

        <!-- Section 2: Description & Recommended Actions (2 Columns in Landscape) -->
        <div class="detail-two-col">
            <div class="detail-reason-box" id="detailDescriptionBox">
                <small>Alert Description & Context</small>
                <p id="detailDescription">-</p>
            </div>

            <div class="detail-reason-box">
                <small>Recommended Mitigation</small>
                <ul id="detailRecommendation" class="detail-recommendation-list"></ul>
            </div>
        </div>

        <!-- Section 3: MITRE ATT&CK & Automated Response (2 Columns in Landscape) -->
        <div class="detail-two-col">
            <div class="detail-reason-box" id="detailMitreBox">
                <small>MITRE ATT&CK Framework Mapping</small>
                <div class="detail-mitre-grid">
                    <div>
                        <span>Technique ID</span>
                        <strong id="detailMitreId">-</strong>
                    </div>
                    <div>
                        <span>Technique Name</span>
                        <strong id="detailMitreName">-</strong>
                    </div>
                    <div>
                        <span>Tactic</span>
                        <strong id="detailMitreTactic">-</strong>
                    </div>
                </div>
            </div>

            <div class="detail-reason-box detail-response-box">
                <small>Automated Response Status</small>
                <div class="detail-response-grid" id="detailResponseGrid" style="display:none;">
                    <div>
                        <span>Detected</span>
                        <strong id="detailRespDetected">-</strong>
                    </div>
                    <div>
                        <span>Blocked At</span>
                        <strong id="detailRespBlocked">-</strong>
                    </div>
                    <div>
                        <span>Recovered At</span>
                        <strong id="detailRespRecovered">-</strong>
                    </div>
                    <div>
                        <span>Response Type</span>
                        <strong id="detailRespType">-</strong>
                    </div>
                    <div>
                        <span>Duration</span>
                        <strong id="detailRespDuration">-</strong>
                    </div>
                    <div>
                        <span>Status</span>
                        <strong id="detailRespStatus">-</strong>
                    </div>
                </div>
                <p id="detailResponseEmpty">No automated response recorded for this source IP yet.</p>
            </div>
        </div>

        <!-- Section 4: Incident Status & Response Timeline -->
        <div class="detail-workflow-container">
            <div class="detail-reason-box detail-status-box">
                <small>Incident Management Status</small>
                <select id="detailIncidentStatus" class="xdr-status-select" onchange="handleIncidentStatusChange(this)">
                    <option value="open">Open</option>
                    <option value="investigating">Investigating</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>

            <div class="detail-reason-box detail-timeline-box">
                <small>Incident Response Timeline</small>
                <div class="detail-timeline" id="detailTimeline">
                    <div class="detail-timeline-step" id="tlStepDetected">
                        <span class="detail-timeline-dot"></span>
                        <div>
                            <strong>Threat Detected</strong>
                            <small id="tlDetectedTime">-</small>
                        </div>
                    </div>
                    <div class="detail-timeline-step" id="tlStepBlock">
                        <span class="detail-timeline-dot"></span>
                        <div>
                            <strong>Firewall Block</strong>
                            <small id="tlBlockTime">-</small>
                        </div>
                    </div>
                    <div class="detail-timeline-step" id="tlStepUnblock">
                        <span class="detail-timeline-dot"></span>
                        <div>
                            <strong>Firewall Unblock</strong>
                            <small id="tlUnblockTime">-</small>
                        </div>
                    </div>
                    <div class="detail-timeline-step" id="tlStepResolved">
                        <span class="detail-timeline-dot"></span>
                        <div>
                            <strong>Resolved</strong>
                            <small id="tlResolvedTime">-</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .alert-detail-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: rgba(15, 23, 42, 0.55);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
    }

    .alert-detail-modal.show {
        display: flex;
    }

    .alert-detail-card.landscape {
        position: relative;
        width: 100%;
        max-width: 1040px;
        max-height: 88vh;
        overflow-y: auto;
        overflow-x: hidden;
        border-radius: 28px;
        padding: 32px 36px;
        background:
            radial-gradient(circle at top right, rgba(236, 72, 153, 0.12), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 36%),
            linear-gradient(135deg, #ffffff 0%, #fcf9ff 100%);
        border: 1px solid rgba(168, 85, 247, 0.22);
        box-shadow: 0 36px 90px rgba(15, 23, 42, 0.28);
    }

    .alert-detail-card::-webkit-scrollbar {
        width: 6px;
    }

    .alert-detail-card::-webkit-scrollbar-track {
        background: transparent;
    }

    .alert-detail-card::-webkit-scrollbar-thumb {
        background: rgba(139, 92, 246, 0.25);
        border-radius: 999px;
    }

    .alert-detail-card::-webkit-scrollbar-thumb:hover {
        background: rgba(139, 92, 246, 0.45);
    }

    .modal-close-btn {
        position: absolute;
        top: 22px;
        right: 26px;
        width: 38px;
        height: 38px;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        color: #ffffff;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        font-size: 22px;
        font-weight: 900;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 18px rgba(139, 92, 246, 0.3);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .modal-close-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 12px 24px rgba(139, 92, 246, 0.45);
    }

    .detail-modal-header {
        margin-bottom: 22px;
        padding-right: 50px;
    }

    .detail-header-tags {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .severity-badge-pill {
        display: inline-flex;
        padding: 6px 14px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(135deg, #8b5cf6, #d946ef);
        font-size: 12px;
        font-weight: 950;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
    }

    .detail-category-badge {
        display: inline-flex;
        padding: 6px 14px;
        border-radius: 999px;
        background: rgba(139, 92, 246, 0.12);
        color: #7c3aed;
        font-size: 12px;
        font-weight: 850;
    }

    .detail-engine-badge {
        display: inline-flex;
        padding: 6px 14px;
        border-radius: 999px;
        background: rgba(236, 72, 153, 0.12);
        color: #db2777;
        font-size: 12px;
        font-weight: 850;
    }

    .detail-modal-header h2 {
        margin: 0;
        color: #0f172a;
        font-size: 26px;
        font-weight: 950;
        line-height: 1.35;
        letter-spacing: -0.4px;
    }

    .detail-section-label {
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #8b5cf6;
        margin: 20px 0 12px;
    }

    .detail-modal-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .detail-card-item {
        padding: 14px 16px;
        border-radius: 18px;
        background: #ffffff;
        border: 1px solid rgba(168, 85, 247, 0.15);
        box-shadow: 0 4px 14px rgba(139, 92, 246, 0.04);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .detail-card-item.highlight-card {
        background: linear-gradient(135deg, rgba(236, 72, 153, 0.06), rgba(139, 92, 246, 0.08));
        border: 1px solid rgba(236, 72, 153, 0.28);
    }

    .detail-card-item small {
        display: block;
        color: #64748b;
        font-size: 11px;
        font-weight: 850;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 4px;
    }

    .detail-card-item strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
        word-break: break-word;
    }

    .detail-card-item strong.accent-text {
        color: #7c3aed;
        font-size: 15px;
    }

    .mono-text {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 13px !important;
    }

    .detail-two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 20px;
    }

    .detail-reason-box {
        padding: 20px 22px;
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid rgba(168, 85, 247, 0.15);
        box-shadow: 0 4px 14px rgba(139, 92, 246, 0.04);
    }

    .detail-reason-box small {
        display: block;
        color: #64748b;
        font-size: 12px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 8px;
    }

    .detail-reason-box p {
        margin: 0;
        color: #334155;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.65;
    }

    .detail-recommendation-list {
        margin: 0;
        padding-left: 20px;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.85;
    }

    .detail-mitre-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 10px;
    }

    .detail-mitre-grid span {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 850;
        margin-bottom: 3px;
    }

    .detail-mitre-grid strong {
        color: #0f172a;
        font-size: 13px;
        font-weight: 950;
    }

    .detail-response-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 10px;
    }

    .detail-response-grid span {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 850;
        margin-bottom: 3px;
    }

    .detail-response-grid strong {
        display: block;
        color: #0f172a;
        font-size: 13px;
        font-weight: 950;
    }

    #detailResponseEmpty {
        margin: 10px 0 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 650;
    }

    .detail-workflow-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 18px;
        margin-top: 10px;
    }

    .xdr-status-select {
        width: 100%;
        height: 46px;
        margin-top: 8px;
        border-radius: 14px;
        border: 1px solid rgba(168, 85, 247, 0.25);
        background: #faf8fc;
        padding: 0 16px;
        color: #0f172a;
        font-size: 14px;
        font-weight: 850;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .xdr-status-select:focus {
        border-color: #8b5cf6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
    }

    .detail-timeline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 14px;
        position: relative;
    }

    .detail-timeline-step {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .detail-timeline-step::before {
        content: "";
        position: absolute;
        top: 13px;
        left: -50%;
        width: 100%;
        height: 3px;
        background: #e2e8f0;
        z-index: 0;
    }

    .detail-timeline-step:first-child::before {
        display: none;
    }

    .detail-timeline-step.completed::before {
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .detail-timeline-dot {
        position: relative;
        z-index: 1;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid #cbd5e1;
        margin-bottom: 8px;
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    .detail-timeline-step.completed .detail-timeline-dot {
        background: #ec4899;
        border-color: #8b5cf6;
        box-shadow: 0 0 10px rgba(236, 72, 153, 0.4);
    }

    .detail-timeline-step strong {
        font-size: 11px;
        font-weight: 850;
        color: #94a3b8;
    }

    .detail-timeline-step.completed strong {
        color: #0f172a;
    }

    .detail-timeline-step small {
        display: block;
        margin-top: 3px;
        font-size: 10px;
        font-weight: 650;
        color: #cbd5e1;
    }

    .detail-timeline-step.completed small {
        color: #64748b;
    }

    /* Responsive Breakpoints */
    @media (max-width: 1024px) {
        .detail-modal-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .alert-detail-card.landscape {
            padding: 24px 20px;
        }

        .detail-modal-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .detail-two-col,
        .detail-workflow-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .detail-modal-grid {
            grid-template-columns: 1fr;
        }

        .detail-mitre-grid,
        .detail-response-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Dark Mode Auto Support */
    body.dark-mode .alert-detail-card.landscape,
    body.dark .alert-detail-card.landscape,
    body.dark-theme .alert-detail-card.landscape {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 34%),
            linear-gradient(135deg, #111827, #241638) !important;
        border-color: rgba(168, 85, 247, 0.35) !important;
    }

    body.dark-mode .detail-card-item,
    body.dark .detail-card-item,
    body.dark-theme .detail-card-item,
    body.dark-mode .detail-reason-box,
    body.dark .detail-reason-box,
    body.dark-theme .detail-reason-box {
        background: rgba(17, 24, 39, 0.95) !important;
        border-color: rgba(168, 85, 247, 0.25) !important;
    }

    body.dark-mode .detail-card-item.highlight-card,
    body.dark .detail-card-item.highlight-card,
    body.dark-theme .detail-card-item.highlight-card {
        background: linear-gradient(135deg, rgba(236, 72, 153, 0.12), rgba(139, 92, 246, 0.18)) !important;
        border-color: rgba(236, 72, 153, 0.45) !important;
    }

    body.dark-mode .detail-modal-header h2,
    body.dark .detail-modal-header h2,
    body.dark-theme .detail-modal-header h2,
    body.dark-mode .detail-card-item strong,
    body.dark .detail-card-item strong,
    body.dark-theme .detail-card-item strong,
    body.dark-mode .detail-mitre-grid strong,
    body.dark .detail-mitre-grid strong,
    body.dark-theme .detail-mitre-grid strong,
    body.dark-mode .detail-response-grid strong,
    body.dark .detail-response-grid strong,
    body.dark-theme .detail-response-grid strong {
        color: #f8fafc !important;
    }

    body.dark-mode .detail-reason-box p,
    body.dark .detail-reason-box p,
    body.dark-theme .detail-reason-box p,
    body.dark-mode .detail-recommendation-list,
    body.dark .detail-recommendation-list,
    body.dark-theme .detail-recommendation-list,
    body.dark-mode #detailResponseEmpty,
    body.dark #detailResponseEmpty,
    body.dark-theme #detailResponseEmpty {
        color: #cbd5e1 !important;
    }

    body.dark-mode .xdr-status-select,
    body.dark .xdr-status-select,
    body.dark-theme .xdr-status-select {
        background: #0f172a !important;
        border-color: rgba(168, 85, 247, 0.35) !important;
        color: #f8fafc !important;
    }
</style>

<script>
    let currentDetailAlert = null;

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    function openThreatDetail(button) {
        const alertData = JSON.parse(button.dataset.alert);
        currentDetailAlert = alertData;
        fillAlertDetail(alertData);
        document.getElementById('alertDetailModal').classList.add('show');
    }

    function fillAlertDetail(data) {
        const badge = document.getElementById('detailSeverityBadge');

        document.getElementById('detailAlertName').innerText = data.rule || 'Security Alert';
        document.getElementById('detailCategory').innerText = data.category || 'General';
        document.getElementById('detailDate').innerText = data.date || '-';
        document.getElementById('detailTime').innerText = data.clock ? 'at ' + data.clock : '';
        document.getElementById('detailRuleId').innerText = data.rule_id
            ? (data.rule_label ? data.rule_id + ' (' + data.rule_label + ')' : data.rule_id)
            : '-';
        document.getElementById('detailDetectionCategory').innerText = data.detection_category || 'Network Detection';
        document.getElementById('detailSource').innerText = data.source || 'N/A';
        document.getElementById('detailDestination').innerText = data.destination || 'N/A';
        document.getElementById('detailAgent').innerText = data.agent || 'N/A';

        document.getElementById('detailUser').innerText = data.user || '-';

        let formattedAmount = '-';
        if (data.amount !== null && data.amount !== undefined && data.amount !== '') {
            const num = Number(data.amount);
            formattedAmount = isNaN(num) ? data.amount : num.toLocaleString('id-ID');
        }
        document.getElementById('detailAmount').innerText = formattedAmount;

        document.getElementById('detailTransactionStatus').innerText =
            data.transaction_status || data.prediction || '-';

        document.getElementById('detailRisk').innerText = data.severity || 'Medium';

        const descBox = document.getElementById('detailDescriptionBox');
        if (data.description) {
            descBox.style.display = 'block';
            document.getElementById('detailDescription').innerText = data.description;
        } else {
            descBox.style.display = 'none';
        }

        badge.innerText = (data.severity || 'Medium') + ' Risk';

        if (data.severity === 'Critical') {
            badge.style.background = 'linear-gradient(135deg, #ef4444, #ec4899)';
        } else if (data.severity === 'High') {
            badge.style.background = 'linear-gradient(135deg, #f97316, #ec4899)';
        } else if (data.severity === 'Medium') {
            badge.style.background = 'linear-gradient(135deg, #f59e0b, #d946ef)';
        } else {
            badge.style.background = 'linear-gradient(135deg, #22c55e, #8b5cf6)';
        }

        const recList = document.getElementById('detailRecommendation');
        recList.innerHTML = '';
        (data.recommendations || []).forEach(function (item) {
            const li = document.createElement('li');
            li.innerText = item;
            recList.appendChild(li);
        });

        document.getElementById('detailDetectionSource').innerText = data.detection_source || 'Suricata IDS';
        document.getElementById('detailDetectionEngine').innerText = data.detection_engine || 'Suricata';
        document.getElementById('detailDetectionPrediction').innerText = data.prediction || 'N/A';

        const mitreBox = document.getElementById('detailMitreBox');
        if (data.mitre) {
            mitreBox.style.display = 'block';
            document.getElementById('detailMitreId').innerText = data.mitre.technique_id || '-';
            document.getElementById('detailMitreName').innerText = data.mitre.technique_name || '-';
            document.getElementById('detailMitreTactic').innerText = data.mitre.tactic || '-';
        } else {
            mitreBox.style.display = 'none';
        }

        document.getElementById('detailIncidentStatus').value = data.incident_status || 'open';
        renderResponseStatus(data.block_status, data);
        renderTimeline(data.block_status, data);
    }

    function formatTimestamp(iso) {
        if (!iso) return '-';
        const d = new Date(iso);
        if (isNaN(d.getTime())) return iso;
        return d.toLocaleString();
    }

    function renderResponseStatus(blockStatus, alertData) {
        const grid = document.getElementById('detailResponseGrid');
        const empty = document.getElementById('detailResponseEmpty');

        if (!blockStatus) {
            grid.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        grid.style.display = 'grid';
        empty.style.display = 'none';

        document.getElementById('detailRespDetected').innerText =
            (alertData.date || '-') + ' ' + (alertData.clock || '');
        document.getElementById('detailRespBlocked').innerText = formatTimestamp(blockStatus.blocked_at);
        document.getElementById('detailRespType').innerText =
            String(alertData.rule_id) === '100200' ? 'Blocked using iptables (firewall-drop)' : 'Firewall-drop Executed';
        document.getElementById('detailRespStatus').innerText = blockStatus.status;

        if (blockStatus.unblocked_at) {
            const durationSec = Math.round((new Date(blockStatus.unblocked_at) - new Date(blockStatus.blocked_at)) / 1000);
            document.getElementById('detailRespRecovered').innerText = formatTimestamp(blockStatus.unblocked_at);
            document.getElementById('detailRespDuration').innerText = durationSec + 's';
        } else {
            document.getElementById('detailRespRecovered').innerText = 'Still blocked';
            document.getElementById('detailRespDuration').innerText = '60 seconds (configured timeout)';
        }
    }

    function setTimelineStep(id, completed, timeText) {
        const el = document.getElementById(id);
        if (!el) return;
        el.className = 'detail-timeline-step' + (completed ? ' completed' : '');
        const smallEl = el.querySelector('small');
        if (smallEl) smallEl.innerText = timeText;
    }

    function renderTimeline(blockStatus, alertData) {
        setTimelineStep('tlStepDetected', true, (alertData.date || '-') + ' ' + (alertData.clock || ''));

        const blocked = !!(blockStatus && blockStatus.blocked_at);
        const unblocked = !!(blockStatus && blockStatus.unblocked_at);
        const resolved = alertData.incident_status === 'resolved';

        setTimelineStep('tlStepBlock', blocked, blocked ? formatTimestamp(blockStatus.blocked_at) : 'Pending');
        setTimelineStep('tlStepUnblock', unblocked, unblocked ? formatTimestamp(blockStatus.unblocked_at) : (blocked ? 'Still blocked' : 'Pending'));
        setTimelineStep('tlStepResolved', resolved, resolved ? 'Resolved' : 'Pending');
    }

    function closeAlertDetail() {
        document.getElementById('alertDetailModal').classList.remove('show');
        currentDetailAlert = null;
    }

    function handleIncidentStatusChange(select) {
        if (!currentDetailAlert) return;

        fetch('{{ route('threat.incident.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                signature: currentDetailAlert.signature,
                status: select.value,
                rule_id: currentDetailAlert.rule_id,
                agent: currentDetailAlert.agent,
                source: currentDetailAlert.source,
            }),
        }).catch(function () {
            // keep state silently on failure
        });
    }
</script>
