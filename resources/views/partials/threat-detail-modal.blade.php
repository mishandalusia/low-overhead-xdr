<!-- Threat Detail Modal — shared by dashboard.blade.php and pages/threat-detection.blade.php -->
<div class="alert-detail-modal" id="alertDetailModal">
    <div class="alert-detail-card">
        <button class="modal-close-btn" onclick="closeAlertDetail()">×</button>

        <div class="detail-modal-header">
            <span id="detailSeverityBadge">High</span>
            <h2 id="detailAlertName">-</h2>
            <p id="detailCategory">-</p>
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
                <small>Rule ID</small>
                <strong id="detailRuleId">-</strong>
            </div>

            <div>
                <small>Detection Source</small>
                <strong id="detailDetectionSource">-</strong>
            </div>

            <div>
                <small>Detection Engine</small>
                <strong id="detailDetectionEngine">-</strong>
            </div>

            <div>
                <small>Category</small>
                <strong id="detailDetectionCategory">-</strong>
            </div>

            <div>
                <small>Prediction</small>
                <strong id="detailDetectionPrediction">-</strong>
            </div>

            <div>
                <small>Source IP</small>
                <strong id="detailSource">-</strong>
            </div>

            <div>
                <small>Destination IP</small>
                <strong id="detailDestination">-</strong>
            </div>

            <div>
                <small>Agent</small>
                <strong id="detailAgent">-</strong>
            </div>

            <div>
                <small>Risk Level</small>
                <strong id="detailRisk">-</strong>
            </div>
        </div>

        <div class="detail-reason-box" id="detailDescriptionBox" style="display:none;">
            <small>Alert Description</small>
            <p id="detailDescription">-</p>
        </div>

        <div class="detail-reason-box">
            <small>Recommendation</small>
            <ul id="detailRecommendation" class="detail-recommendation-list"></ul>
        </div>

        <div class="detail-reason-box" id="detailMitreBox" style="display:none;">
            <small>MITRE ATT&CK</small>
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

        <div class="detail-workflow-grid">
            <div class="detail-reason-box">
                <small>Incident Status</small>
                <select id="detailIncidentStatus" onchange="handleIncidentStatusChange(this)">
                    <option value="open">Open</option>
                    <option value="investigating">Investigating</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>

            <div class="detail-reason-box detail-response-box">
                <small>Response Status</small>

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

                <p id="detailResponseEmpty">No automated response recorded for this source yet.</p>
            </div>

            <div class="detail-reason-box">
                <small>Timeline</small>
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
        max-height: 90vh;
        overflow-y: auto;
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

    @media (max-width: 768px) {
        .detail-modal-grid {
            grid-template-columns: 1fr;
        }
    }

    body.dark-mode .alert-detail-card,
    body.dark .alert-detail-card,
    body.dark-theme .alert-detail-card {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 34%),
            linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    body.dark-mode .detail-modal-grid div,
    body.dark .detail-modal-grid div,
    body.dark-theme .detail-modal-grid div,
    body.dark-mode .detail-reason-box,
    body.dark .detail-reason-box,
    body.dark-theme .detail-reason-box {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: #3b2a55 !important;
    }

    body.dark-mode .detail-modal-header h2,
    body.dark .detail-modal-header h2,
    body.dark-theme .detail-modal-header h2,
    body.dark-mode .detail-modal-grid strong,
    body.dark .detail-modal-grid strong,
    body.dark-theme .detail-modal-grid strong {
        color: #f8fafc !important;
    }

    body.dark-mode .detail-modal-header p,
    body.dark .detail-modal-header p,
    body.dark-theme .detail-modal-header p,
    body.dark-mode .detail-reason-box p,
    body.dark .detail-reason-box p,
    body.dark-theme .detail-reason-box p,
    body.dark-mode .detail-modal-grid small,
    body.dark .detail-modal-grid small,
    body.dark-theme .detail-modal-grid small,
    body.dark-mode .detail-reason-box small,
    body.dark .detail-reason-box small,
    body.dark-theme .detail-reason-box small {
        color: #94a3b8 !important;
    }

    .detail-recommendation-list {
        margin: 6px 0 0;
        padding-left: 18px;
        color: #334155;
        font-size: 14px;
        font-weight: 650;
        line-height: 1.8;
    }

    .detail-mitre-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-top: 8px;
    }

    .detail-mitre-grid span {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 850;
        margin-bottom: 4px;
    }

    .detail-mitre-grid strong {
        color: #0f172a;
        font-size: 14px;
        font-weight: 950;
    }

    .detail-workflow-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
        margin-top: 14px;
    }

    .detail-workflow-grid select {
        width: 100%;
        height: 46px;
        margin-top: 8px;
        border-radius: 14px;
        border: 1px solid rgba(168, 85, 247, 0.22);
        background: #ffffff;
        padding: 0 14px;
        color: #0f172a;
        font-weight: 800;
        outline: none;
    }

    .detail-response-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 8px;
    }

    .detail-response-grid span {
        display: block;
        color: #94a3b8;
        font-size: 11px;
        font-weight: 850;
        margin-bottom: 4px;
    }

    .detail-response-grid strong {
        display: block;
        color: #0f172a;
        font-size: 13px;
        font-weight: 950;
    }

    #detailResponseEmpty {
        margin: 8px 0 0;
        color: #334155;
        font-size: 13px;
        font-weight: 650;
    }

    body.dark-mode .detail-recommendation-list,
    body.dark .detail-recommendation-list,
    body.dark-theme .detail-recommendation-list,
    body.dark-mode #detailResponseEmpty,
    body.dark #detailResponseEmpty,
    body.dark-theme #detailResponseEmpty {
        color: #cbd5e1 !important;
    }

    body.dark-mode .detail-response-grid strong,
    body.dark .detail-response-grid strong,
    body.dark-theme .detail-response-grid strong {
        color: #f8fafc !important;
    }

    @media (max-width: 640px) {
        .detail-response-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .detail-timeline {
        display: flex;
        margin-top: 12px;
    }

    .detail-timeline-step {
        position: relative;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding-top: 4px;
    }

    .detail-timeline-step::before {
        content: "";
        position: absolute;
        top: 13px;
        left: -50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: 0;
    }

    .detail-timeline-step:first-child::before {
        display: none;
    }

    .detail-timeline-step.completed::before {
        background: #4f46e5;
    }

    .detail-timeline-dot {
        position: relative;
        z-index: 1;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #cbd5e1;
        margin-bottom: 8px;
    }

    .detail-timeline-step.completed .detail-timeline-dot {
        background: #4f46e5;
        border-color: #4f46e5;
    }

    .detail-timeline-step strong {
        font-size: 11px;
        font-weight: 800;
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

    body.dark-mode .detail-timeline-step strong,
    body.dark .detail-timeline-step strong,
    body.dark-theme .detail-timeline-step strong {
        color: #475569;
    }

    body.dark-mode .detail-timeline-step.completed strong,
    body.dark .detail-timeline-step.completed strong,
    body.dark-theme .detail-timeline-step.completed strong {
        color: #f8fafc;
    }

    @media (max-width: 500px) {
        .detail-timeline-step strong {
            font-size: 9px;
        }
    }

    body.dark-mode .detail-mitre-grid strong,
    body.dark .detail-mitre-grid strong,
    body.dark-theme .detail-mitre-grid strong {
        color: #f8fafc !important;
    }

    body.dark-mode .detail-workflow-grid select,
    body.dark .detail-workflow-grid select,
    body.dark-theme .detail-workflow-grid select {
        background: #0f172a !important;
        border-color: #3b2a55 !important;
        color: #f8fafc !important;
    }

    @media (max-width: 640px) {
        .detail-mitre-grid,
        .detail-workflow-grid {
            grid-template-columns: 1fr;
        }
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

        document.getElementById('detailAlertName').innerText = data.rule;
        document.getElementById('detailCategory').innerText = data.category;
        document.getElementById('detailDate').innerText = data.date;
        document.getElementById('detailTime').innerText = data.clock;
        document.getElementById('detailRuleId').innerText = data.rule_id
            ? (data.rule_label ? data.rule_id + ' (' + data.rule_label + ')' : data.rule_id)
            : '-';
        document.getElementById('detailDetectionCategory').innerText = data.detection_category || 'Network Detection';
        document.getElementById('detailSource').innerText = data.source;
        document.getElementById('detailDestination').innerText = data.destination || 'N/A';
        document.getElementById('detailAgent').innerText = data.agent;
        document.getElementById('detailRisk').innerText = data.severity;

        const descBox = document.getElementById('detailDescriptionBox');
        if (data.description) {
            descBox.style.display = 'block';
            document.getElementById('detailDescription').innerText = data.description;
        } else {
            descBox.style.display = 'none';
        }

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
            document.getElementById('detailMitreId').innerText = data.mitre.technique_id;
            document.getElementById('detailMitreName').innerText = data.mitre.technique_name;
            document.getElementById('detailMitreTactic').innerText = data.mitre.tactic;
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
        // Rule 100200 (Nmap Reconnaissance Scan) is blocked via the agent's
        // iptables active-response script specifically — every other rule
        // still goes through the same firewall-drop Active Response command,
        // just described more generically.
        document.getElementById('detailRespType').innerText =
            String(alertData.rule_id) === '100200' ? 'Blocked using iptables (firewall-drop)' : 'Firewall-drop Executed';
        document.getElementById('detailRespStatus').innerText = blockStatus.status;

        if (blockStatus.unblocked_at) {
            const durationSec = Math.round((new Date(blockStatus.unblocked_at) - new Date(blockStatus.blocked_at)) / 1000);
            document.getElementById('detailRespRecovered').innerText = formatTimestamp(blockStatus.unblocked_at);
            document.getElementById('detailRespDuration').innerText = durationSec + 's';
        } else {
            // Still blocked — no observed unblock time yet, so show the
            // configured Active Response timeout instead of a blank dash.
            document.getElementById('detailRespRecovered').innerText = 'Still blocked';
            document.getElementById('detailRespDuration').innerText = '60 seconds (configured timeout)';
        }
    }

    function setTimelineStep(id, completed, timeText) {
        const el = document.getElementById(id);
        el.className = 'detail-timeline-step' + (completed ? ' completed' : '');
        el.querySelector('small').innerText = timeText;
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
            // silently keep the selected value even if the request fails
        });
    }
</script>
