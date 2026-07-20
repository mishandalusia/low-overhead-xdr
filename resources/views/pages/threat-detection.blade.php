@extends('layouts.app-dashboard')

@php
    $threats = $threats ?? [];
    $severityCounts = collect($threats)->countBy('severity');
    $agentOptions = collect($threats)->pluck('agent')->filter()->unique()->sort()->values();

    $buildAlertPayload = function ($alert) {
        return [
            'signature' => $alert['signature'],
            'rule_id' => $alert['rule_id'],
            'rule' => $alert['rule'],
            'category' => $alert['category'] ?? 'General',
            'agent' => $alert['agent'],
            'agent_id' => $alert['agent_id'] ?? null,
            'source' => $alert['source'],
            'destination' => $alert['destination'] ?? 'N/A',
            'description' => $alert['description'] ?? '',
            'severity' => $alert['severity'],
            'date' => $alert['date'] ?? ($alert['time'] ? substr($alert['time'], 0, 10) : ''),
            'clock' => $alert['clock'] ?? ($alert['time'] ? substr($alert['time'], 11, 5) : ''),
            'incident_status' => $alert['incident_status'],
            'block_status' => $alert['block_status'],
            'recommendations' => $alert['recommendations'],
            'mitre' => $alert['mitre'],
            'detection_source' => $alert['detection_source'] ?? null,
            'detection_engine' => $alert['detection_engine'] ?? null,
            'prediction' => $alert['prediction'] ?? null,
            'detection_category' => $alert['detection_category'] ?? null,
            'rule_label' => $alert['rule_label'] ?? null,
        ];
    };
@endphp

@section('content')

<div class="tdx-page" id="threatDetectionPage">

    <div class="tdx-heading">
        <h1>Threat Detection</h1>
        <p>Detected threats from monitored endpoints and suspicious activities.</p>
    </div>

    @if ($error ?? null)
        <div class="tdx-error-banner">Unable to reach Wazuh: {{ $error }}</div>
    @endif

    <div class="tdx-summary-grid">
        <div class="tdx-summary-card critical bento-card featured">
            <div class="tdx-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Critical Threats</span>
                <h2>{{ $severityCounts->get('Critical', 0) }}</h2>
                <p>Need immediate attention</p>
            </div>
        </div>

        <div class="tdx-summary-card high bento-card">
            <div class="tdx-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>High Threats</span>
                <h2>{{ $severityCounts->get('High', 0) }}</h2>
                <p>Potential security risks</p>
            </div>
        </div>

        <div class="tdx-summary-card medium bento-card">
            <div class="tdx-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 2 12l10 10 10-10L12 2Zm0 5a1 1 0 0 1 1 1v4a1 1 0 1 1-2 0V8a1 1 0 0 1 1-1Zm0 9.75a1.1 1.1 0 1 1 0-2.2 1.1 1.1 0 0 1 0 2.2Z"/></svg></div>
            <div>
                <span>Medium Threats</span>
                <h2>{{ $severityCounts->get('Medium', 0) }}</h2>
                <p>Require monitoring</p>
            </div>
        </div>

        <div class="tdx-summary-card low bento-card">
            <div class="tdx-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Low Threats</span>
                <h2>{{ $severityCounts->get('Low', 0) }}</h2>
                <p>Informational activity</p>
            </div>
        </div>
    </div>

    <div class="tdx-filter-panel bento-card">
        <div class="tdx-filter-group">
            <label>Search</label>
            <input type="text" id="tdxSearch" placeholder="Threat name or source IP" oninput="filterThreats()">
        </div>

        <div class="tdx-filter-group">
            <label>Severity</label>
            <select id="tdxSeverity" class="xdr-filter-select" onchange="filterThreats()">
                <option value="all">All Severities</option>
                <option value="critical">Critical</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>

        <div class="tdx-filter-group">
            <label>Rule ID</label>
            <input type="text" id="tdxRuleId" placeholder="e.g. 100200" oninput="filterThreats()">
        </div>

        <div class="tdx-filter-group">
            <label>Agent</label>
            <select id="tdxAgent" class="xdr-filter-select" onchange="filterThreats()">
                <option value="all">All Agents</option>
                @foreach ($agentOptions as $agentName)
                    <option value="{{ $agentName }}">{{ $agentName }}</option>
                @endforeach
            </select>
        </div>

        <div class="tdx-filter-group">
            <label>Date</label>
            <input type="date" id="tdxDate" onchange="filterThreats()">
        </div>

        <button type="button" class="tdx-reset-btn" onclick="resetThreatFilter()">Reset Filter</button>
    </div>

    <div class="tdx-panel bento-card">
        <div class="tdx-panel-header">
            <h3>Detected Threat List</h3>
            <p>Threat records detected from Wazuh alerts and behavioral anomaly monitoring.</p>
        </div>

        <div class="tdx-list-header data-table-header">
            <span>Time</span>
            <span>Threat</span>
            <span>Source</span>
            <span>Severity</span>
            <span>Detail</span>
        </div>

        <div class="tdx-threat-list xdr-scroll-list-target" id="tdxThreatList">

            @forelse ($threats as $index => $threat)
                <div class="tdx-threat-row data-list-row {{ strtolower($threat['severity']) }} {{ strtolower($threat['severity']) === 'critical' ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}"
                    data-severity="{{ strtolower($threat['severity']) }}"
                    data-rule-id="{{ $threat['rule_id'] }}"
                    data-agent="{{ $threat['agent'] }}"
                    data-date="{{ $threat['date'] }}"
                    data-search="{{ strtolower($threat['rule'] . ' ' . $threat['source']) }}"
                >
                    <div class="tdx-time">{{ $threat['clock'] }}</div>

                    <div class="tdx-threat-info">
                        <strong>{{ $threat['rule'] }}</strong>
                        <small>{{ $threat['category'] ?? 'General' }} • Agent: {{ $threat['agent'] }} • {{ $threat['date'] }}</small>
                    </div>

                    <div class="tdx-source">{{ $threat['source'] }}</div>

                    <div>
                        <span class="tdx-severity {{ strtolower($threat['severity']) }}">{{ $threat['severity'] }}</span>
                    </div>

                    <div>
                        <button type="button" class="detail-btn" data-alert="{{ json_encode($buildAlertPayload($threat)) }}" onclick="openThreatDetail(this)">Detail</button>
                    </div>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'All calm! No threats detected yet.'])
            @endforelse

        </div>
    </div>

</div>

@include('partials.threat-detail-modal')

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
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.06) !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .tdx-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(139, 92, 246, 0.12) !important;
    }

    /* All summary cards are the same size — see dashboard.blade.php for
       why the asymmetric featured-card span was dropped. */
    .tdx-summary-card > * {
        position: relative;
        z-index: 2;
    }

    .tdx-summary-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #FAF8FC !important;
        color: var(--accent-purple) !important;
        box-shadow: 0 10px 22px rgba(139, 92, 246, 0.10);
    }

    .tdx-summary-card.critical .tdx-summary-icon { color: #dc2626 !important; background: rgba(220, 38, 38, 0.12) !important; }
    .tdx-summary-card.high .tdx-summary-icon { color: #ea580c !important; background: rgba(234, 88, 12, 0.12) !important; }
    .tdx-summary-card.medium .tdx-summary-icon { color: #d97706 !important; background: rgba(217, 119, 6, 0.12) !important; }
    .tdx-summary-card.low .tdx-summary-icon { color: #059669 !important; background: rgba(5, 150, 105, 0.12) !important; }

    .tdx-summary-icon svg {
        width: 24px;
        height: 24px;
    }

    .tdx-summary-card span {
        color: var(--text-body) !important;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .tdx-summary-card h2 {
        margin: 8px 0 2px;
        color: var(--text-heading) !important;
        font-size: 34px;
        font-weight: 900;
        letter-spacing: -0.5px;
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
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07) !important;
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

    .tdx-error-banner {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-radius: 16px;
        background: #fee2e2 !important;
        border: 1px solid rgba(220, 38, 38, 0.25) !important;
        color: #dc2626 !important;
        font-size: 13px;
        font-weight: 800;
    }

    .tdx-filter-panel {
        display: flex;
        flex-wrap: wrap;
        align-items: end;
        gap: 16px;
        margin-bottom: 24px;
        padding: 22px 24px;
        border-radius: 26px;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.06) !important;
    }

    .tdx-filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 150px;
        flex: 1;
    }

    .tdx-filter-group label {
        color: #64748b !important;
        font-size: 12px;
        font-weight: 900;
    }

    .tdx-filter-group input,
    .tdx-filter-group select {
        height: 44px;
        padding: 0 14px;
        border-radius: 12px;
        border: 1px solid #E5DFF0 !important;
        background: #ffffff !important;
        color: #0f172a !important;
        font-size: 13px;
        font-weight: 700;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .tdx-filter-group input:focus,
    .tdx-filter-group select:focus {
        border-color: #8B5CF6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
    }

    .tdx-reset-btn {
        height: 44px;
        padding: 0 20px;
        border: none;
        cursor: pointer;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%);
        font-size: 13px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 22px rgba(236, 72, 153, 0.22);
    }

    .detail-btn {
        border: none;
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 999px;
        color: #ffffff;
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%);
        font-size: 12px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 22px rgba(236, 72, 153, 0.22);
    }

    .tdx-list-header {
        display: grid;
        grid-template-columns: 150px 1.6fr 0.75fr 0.65fr 0.6fr;
        gap: 18px;
        padding: 0 20px 10px;
        color: #64748b;
        font-size: 13px;
        font-weight: 950;
    }

    .tdx-threat-list {
        display: grid;
        gap: 0;
    }

    .tdx-threat-row {
        display: grid;
        grid-template-columns: 150px 1.6fr 0.75fr 0.65fr 0.6fr;
        align-items: center;
        gap: 18px;
        min-height: 78px;
        padding: 18px 20px;
        border-left: 3px solid transparent !important;
    }

    .tdx-threat-row.critical {
        border-left-color: #dc2626 !important;
    }

    .tdx-threat-row.high {
        border-left-color: #ea580c !important;
    }

    .tdx-threat-row.medium {
        border-left-color: #d97706 !important;
    }

    .tdx-threat-row.low {
        border-left-color: #059669 !important;
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

    body.dark-mode .tdx-filter-panel,
    body.dark .tdx-filter-panel,
    body.dark-theme .tdx-filter-panel,
    .tdx-page.tdx-dark .tdx-filter-panel {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
    }

    body.dark-mode .tdx-filter-group input,
    body.dark .tdx-filter-group input,
    body.dark-theme .tdx-filter-group input,
    body.dark-mode .tdx-filter-group select,
    body.dark .tdx-filter-group select,
    body.dark-theme .tdx-filter-group select {
        background: #0f172a !important;
        border-color: #3b2a55 !important;
        color: #f8fafc !important;
    }

    @media (max-width: 1200px) {
        .tdx-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .tdx-list-header,
        .tdx-threat-row {
            grid-template-columns: 120px 1.4fr 0.8fr 0.7fr 0.6fr;
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

    /* Redesign lock — keep the new light card system regardless of the
       light/dark content toggle. */
    .tdx-summary-card.tdx-summary-card,
    .tdx-panel.tdx-panel,
    .tdx-filter-panel.tdx-filter-panel,
    .tdx-threat-row.tdx-threat-row,
    body.dark-mode .tdx-summary-card.tdx-summary-card,
    body.dark .tdx-summary-card.tdx-summary-card,
    body.dark-theme .tdx-summary-card.tdx-summary-card,
    .tdx-page.tdx-dark .tdx-summary-card.tdx-summary-card,
    body.dark-mode .tdx-panel.tdx-panel,
    body.dark .tdx-panel.tdx-panel,
    body.dark-theme .tdx-panel.tdx-panel,
    .tdx-page.tdx-dark .tdx-panel.tdx-panel,
    body.dark-mode .tdx-filter-panel.tdx-filter-panel,
    body.dark .tdx-filter-panel.tdx-filter-panel,
    body.dark-theme .tdx-filter-panel.tdx-filter-panel,
    .tdx-page.tdx-dark .tdx-filter-panel.tdx-filter-panel,
    body.dark-mode .tdx-threat-row.tdx-threat-row,
    body.dark .tdx-threat-row.tdx-threat-row,
    body.dark-theme .tdx-threat-row.tdx-threat-row,
    .tdx-page.tdx-dark .tdx-threat-row.tdx-threat-row {
        background: var(--card-bg) !important;
        border-color: rgba(139, 92, 246, 0.10) !important;
    }

    body.dark-mode .tdx-heading h1,
    body.dark .tdx-heading h1,
    body.dark-theme .tdx-heading h1,
    .tdx-page.tdx-dark .tdx-heading h1,
    body.dark-mode .tdx-summary-card h2,
    body.dark .tdx-summary-card h2,
    body.dark-theme .tdx-summary-card h2,
    .tdx-page.tdx-dark .tdx-summary-card h2,
    body.dark-mode .tdx-panel-header h3,
    body.dark .tdx-panel-header h3,
    body.dark-theme .tdx-panel-header h3,
    .tdx-page.tdx-dark .tdx-panel-header h3,
    body.dark-mode .tdx-time,
    body.dark .tdx-time,
    body.dark-theme .tdx-time,
    .tdx-page.tdx-dark .tdx-time,
    body.dark-mode .tdx-source,
    body.dark .tdx-source,
    body.dark-theme .tdx-source,
    .tdx-page.tdx-dark .tdx-source,
    body.dark-mode .tdx-threat-info strong,
    body.dark .tdx-threat-info strong,
    body.dark-theme .tdx-threat-info strong,
    .tdx-page.tdx-dark .tdx-threat-info strong {
        color: var(--text-heading) !important;
        text-shadow: none !important;
    }

    body.dark-mode .tdx-heading p,
    body.dark .tdx-heading p,
    body.dark-theme .tdx-heading p,
    .tdx-page.tdx-dark .tdx-heading p,
    body.dark-mode .tdx-summary-card span,
    body.dark .tdx-summary-card span,
    body.dark-theme .tdx-summary-card span,
    .tdx-page.tdx-dark .tdx-summary-card span,
    body.dark-mode .tdx-panel-header p,
    body.dark .tdx-panel-header p,
    body.dark-theme .tdx-panel-header p,
    .tdx-page.tdx-dark .tdx-panel-header p,
    body.dark-mode .tdx-threat-info small,
    body.dark .tdx-threat-info small,
    body.dark-theme .tdx-threat-info small,
    .tdx-page.tdx-dark .tdx-threat-info small,
    body.dark-mode .tdx-filter-group input,
    body.dark .tdx-filter-group input,
    body.dark-theme .tdx-filter-group input,
    body.dark-mode .tdx-filter-group select,
    body.dark .tdx-filter-group select,
    body.dark-theme .tdx-filter-group select {
        color: var(--text-body) !important;
        background: #FAF8FC !important;
        border-color: rgba(139, 92, 246, 0.18) !important;
    }
</style>

<script>
    function filterThreats() {
        const search = document.getElementById('tdxSearch').value.toLowerCase();
        const severity = document.getElementById('tdxSeverity').value;
        const ruleId = document.getElementById('tdxRuleId').value.toLowerCase();
        const agent = document.getElementById('tdxAgent').value;
        const date = document.getElementById('tdxDate').value;

        document.querySelectorAll('.tdx-threat-row').forEach(function (row) {
            const matchSearch = !search || row.dataset.search.includes(search);
            const matchSeverity = severity === 'all' || row.dataset.severity === severity;
            const matchRuleId = !ruleId || (row.dataset.ruleId || '').toLowerCase().includes(ruleId);
            const matchAgent = agent === 'all' || row.dataset.agent === agent;
            const matchDate = !date || row.dataset.date === date;

            row.style.display = (matchSearch && matchSeverity && matchRuleId && matchAgent && matchDate) ? '' : 'none';
        });
    }

    function resetThreatFilter() {
        document.getElementById('tdxSearch').value = '';
        document.getElementById('tdxSeverity').value = 'all';
        document.getElementById('tdxRuleId').value = '';
        document.getElementById('tdxAgent').value = 'all';
        document.getElementById('tdxDate').value = '';
        filterThreats();
    }

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

@include('partials.auto-refresh')

@endsection