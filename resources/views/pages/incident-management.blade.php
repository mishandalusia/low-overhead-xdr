@extends('layouts.app-dashboard')

@php
    $openCount = collect($incidents)->where('incident_status', 'open')->count();
    $investigatingCount = collect($incidents)->where('incident_status', 'investigating')->count();
    $resolvedCount = collect($incidents)->where('incident_status', 'resolved')->count();

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

<div class="inc-page" id="incidentManagementPage">

    <div class="inc-heading">
        <h1>Incident Management</h1>
        <p>Every incident originating from Threat Detection — status, response outcome, and ownership in one place.</p>
    </div>

    @if ($error ?? null)
        <div class="inc-error-banner">Unable to reach Wazuh: {{ $error }}</div>
    @endif

    <div class="inc-summary-grid">
        <div class="inc-summary-card open bento-card">
            <div class="inc-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Open</span>
                <h2>{{ $openCount }}</h2>
                <p>Not yet triaged</p>
            </div>
        </div>

        <div class="inc-summary-card investigating bento-card">
            <div class="inc-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM1.5 9a7.5 7.5 0 1 1 13.463 4.546l5.746 5.747a1 1 0 0 1-1.414 1.414l-5.747-5.746A7.5 7.5 0 0 1 1.5 9Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Investigating</span>
                <h2>{{ $investigatingCount }}</h2>
                <p>Under active review</p>
            </div>
        </div>

        <div class="inc-summary-card resolved bento-card">
            <div class="inc-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Resolved</span>
                <h2>{{ $resolvedCount }}</h2>
                <p>Closed incidents</p>
            </div>
        </div>
    </div>

    <div class="inc-panel bento-card">
        <div class="inc-panel-header">
            <h3>Incident List</h3>
            <p>Threat, incident status, response outcome, and the analyst assigned to handle it.</p>
        </div>

        <div class="inc-list-header data-table-header">
            <span>Incident</span>
            <span>Incident Status</span>
            <span>Response</span>
            <span>Assigned To</span>
            <span>Detail</span>
        </div>

        <div class="inc-list xdr-scroll-list-target">
            @forelse ($incidents as $index => $incident)
                <div class="inc-row data-list-row {{ strtolower($incident['severity']) }} {{ strtolower($incident['severity']) === 'critical' ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}">
                    <div class="inc-threat-info">
                        <div class="inc-id-row">
                            <span class="inc-id mono">{{ $incident['incident_id'] ? '#INC-'.str_pad($incident['incident_id'], 4, '0', STR_PAD_LEFT) : 'Not yet created' }}</span>
                            <span class="inc-severity-badge {{ strtolower($incident['severity']) }}">{{ $incident['severity'] }}</span>
                        </div>
                        <strong>{{ $incident['rule'] }}</strong>
                        <small class="mono">Source: {{ $incident['source'] }}</small>
                        <small>Detected {{ $incident['date'] }} {{ $incident['clock'] }} • Agent: {{ $incident['agent'] }} • Created: {{ $incident['incident_created_at'] ?? '—' }}</small>
                    </div>

                    <div>
                        <select class="inc-status-select xdr-filter-select"
                            data-signature="{{ $incident['signature'] }}"
                            data-rule-id="{{ $incident['rule_id'] }}"
                            data-agent="{{ $incident['agent'] }}"
                            data-source="{{ $incident['source'] }}"
                            onchange="handleIncidentStatusInline(this)"
                        >
                            <option value="open" {{ $incident['incident_status'] === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="investigating" {{ $incident['incident_status'] === 'investigating' ? 'selected' : '' }}>Investigating</option>
                            <option value="resolved" {{ $incident['incident_status'] === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                    </div>

                    <div>
                        <span class="inc-response-badge {{ strtolower($incident['response_label']) }}">{{ $incident['response_label'] }}</span>
                    </div>

                    <div>
                        <select class="inc-assign-select xdr-filter-select"
                            data-signature="{{ $incident['signature'] }}"
                            data-rule-id="{{ $incident['rule_id'] }}"
                            data-agent="{{ $incident['agent'] }}"
                            data-source="{{ $incident['source'] }}"
                            onchange="handleAssignInline(this)"
                        >
                            <option value="">Unassigned</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ (string) $incident['assigned_to'] === (string) $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button class="detail-btn" data-alert="{{ json_encode($buildAlertPayload($incident)) }}" onclick="openThreatDetail(this)">Detail</button>
                    </div>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'No incidents yet — they will appear here once a threat is detected.'])
            @endforelse
        </div>
    </div>

</div>

@include('partials.threat-detail-modal')

<style>
    .inc-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .inc-heading {
        margin-bottom: 26px;
    }

    .inc-heading h1 {
        margin: 0;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .inc-heading p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .inc-error-banner {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-radius: 16px;
        background: #fee2e2 !important;
        border: 1px solid rgba(220, 38, 38, 0.25) !important;
        color: #dc2626 !important;
        font-size: 13px;
        font-weight: 800;
    }

    .inc-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .inc-summary-card {
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

    .inc-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(139, 92, 246, 0.12) !important;
    }

    .inc-summary-icon {
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

    .inc-summary-icon svg {
        width: 24px;
        height: 24px;
    }

    .inc-summary-card.open .inc-summary-icon { color: #dc2626 !important; }
    .inc-summary-card.investigating .inc-summary-icon { color: #d97706 !important; }
    .inc-summary-card.resolved .inc-summary-icon { color: #059669 !important; }

    .inc-summary-card span {
        color: var(--text-body) !important;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .inc-summary-card h2 {
        margin: 8px 0 2px;
        color: var(--text-heading) !important;
        font-size: 34px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .inc-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .inc-panel {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        padding: 26px;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07) !important;
    }

    .inc-panel-header {
        margin-bottom: 24px;
    }

    .inc-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 23px;
        font-weight: 950;
    }

    .inc-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .inc-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .inc-list-header {
        display: grid;
        grid-template-columns: 1.6fr 1fr 0.8fr 1.1fr 0.6fr;
        gap: 14px;
        padding: 0 16px 10px;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 950;
    }

    .inc-list {
        display: grid;
        gap: 0;
    }

    .inc-row {
        display: grid;
        grid-template-columns: 1.6fr 1fr 0.8fr 1.1fr 0.6fr;
        align-items: center;
        gap: 14px;
        min-height: 78px;
        padding: 18px 16px;
    }

    .inc-id-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 4px;
    }

    .inc-id {
        display: inline-block;
        color: #4f46e5 !important;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .inc-severity-badge {
        display: inline-flex;
        padding: 2px 8px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .inc-severity-badge.critical {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .inc-severity-badge.high {
        background: #ffedd5 !important;
        color: #ea580c !important;
    }

    .inc-severity-badge.medium {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .inc-severity-badge.low {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .inc-threat-info strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .inc-threat-info small {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .inc-status-select,
    .inc-assign-select {
        width: 100%;
        height: 44px;
        padding: 0 12px;
        border-radius: 12px;
        border: 1px solid rgba(168, 85, 247, 0.22) !important;
        background: #ffffff !important;
        color: #0f172a !important;
        font-size: 13px;
        font-weight: 800;
        outline: none;
    }

    .inc-response-badge {
        display: inline-flex;
        justify-content: center;
        min-width: 92px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .inc-response-badge.blocked {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .inc-response-badge.completed {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .inc-response-badge.pending {
        background: #fef3c7 !important;
        color: #d97706 !important;
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

    body.dark-mode .inc-heading h1,
    body.dark .inc-heading h1,
    body.dark-theme .inc-heading h1 {
        color: #ffffff !important;
    }

    body.dark-mode .inc-heading p,
    body.dark .inc-heading p,
    body.dark-theme .inc-heading p,
    body.dark-mode .inc-panel-header p,
    body.dark .inc-panel-header p,
    body.dark-theme .inc-panel-header p,
    body.dark-mode .inc-list-header,
    body.dark .inc-list-header,
    body.dark-theme .inc-list-header,
    body.dark-mode .inc-summary-card span,
    body.dark .inc-summary-card span,
    body.dark-theme .inc-summary-card span,
    body.dark-mode .inc-summary-card p,
    body.dark .inc-summary-card p,
    body.dark-theme .inc-summary-card p,
    body.dark-mode .inc-threat-info small,
    body.dark .inc-threat-info small,
    body.dark-theme .inc-threat-info small {
        color: #cbd5e1 !important;
    }

    body.dark-mode .inc-summary-card,
    body.dark .inc-summary-card,
    body.dark-theme .inc-summary-card,
    body.dark-mode .inc-panel,
    body.dark .inc-panel,
    body.dark-theme .inc-panel,
    body.dark-mode .inc-row,
    body.dark .inc-row,
    body.dark-theme .inc-row {
        background: linear-gradient(135deg, #111827, #241638) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
    }

    body.dark-mode .inc-summary-card h2,
    body.dark .inc-summary-card h2,
    body.dark-theme .inc-summary-card h2,
    body.dark-mode .inc-panel-header h3,
    body.dark .inc-panel-header h3,
    body.dark-theme .inc-panel-header h3,
    body.dark-mode .inc-threat-info strong,
    body.dark .inc-threat-info strong,
    body.dark-theme .inc-threat-info strong {
        color: #ffffff !important;
    }

    body.dark-mode .inc-status-select,
    body.dark .inc-status-select,
    body.dark-theme .inc-status-select,
    body.dark-mode .inc-assign-select,
    body.dark .inc-assign-select,
    body.dark-theme .inc-assign-select {
        background: #0f172a !important;
        border-color: #3b2a55 !important;
        color: #f8fafc !important;
    }

    @media (max-width: 1200px) {
        .inc-summary-grid {
            grid-template-columns: 1fr;
        }

        .inc-list-header,
        .inc-row {
            grid-template-columns: 1fr;
        }

        .inc-list-header {
            display: none;
        }
    }

    /* Redesign lock — keep the new light card system regardless of the
       light/dark content toggle. */
    .inc-summary-card.inc-summary-card,
    .inc-panel.inc-panel,
    .inc-row.inc-row,
    body.dark-mode .inc-summary-card.inc-summary-card,
    body.dark .inc-summary-card.inc-summary-card,
    body.dark-theme .inc-summary-card.inc-summary-card,
    body.dark-mode .inc-panel.inc-panel,
    body.dark .inc-panel.inc-panel,
    body.dark-theme .inc-panel.inc-panel,
    body.dark-mode .inc-row.inc-row,
    body.dark .inc-row.inc-row,
    body.dark-theme .inc-row.inc-row {
        background: var(--card-bg) !important;
        border-color: rgba(139, 92, 246, 0.10) !important;
    }

    /* Summary cards lebih hidup — tinted per status like the other pages'
       colorful stat cards, instead of a plain white card with just a
       colored icon. */
    .inc-summary-card.open.inc-summary-card {
        background: linear-gradient(135deg, #ffffff, #fef2f2) !important;
    }

    .inc-summary-card.investigating.inc-summary-card {
        background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
    }

    .inc-summary-card.resolved.inc-summary-card {
        background: linear-gradient(135deg, #ffffff, #f0fdf4) !important;
    }

    .inc-summary-card::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        right: -40px;
        top: -40px;
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
    }

    .inc-summary-card.open::before { background: rgba(239, 68, 68, 0.10); }
    .inc-summary-card.investigating::before { background: rgba(217, 119, 6, 0.10); }
    .inc-summary-card.resolved::before { background: rgba(5, 150, 105, 0.10); }

    .inc-summary-card > * {
        position: relative;
        z-index: 1;
    }

    .inc-summary-card.open .inc-summary-icon {
        background: rgba(239, 68, 68, 0.12) !important;
    }

    .inc-summary-card.investigating .inc-summary-icon {
        background: rgba(217, 119, 6, 0.12) !important;
    }

    .inc-summary-card.resolved .inc-summary-icon {
        background: rgba(5, 150, 105, 0.12) !important;
    }

    /* Incident List panel lebih hidup — same tinted-wash + faint corner
       icon recipe as the dashboard panels, instead of a flat white box. */
    .inc-panel.inc-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.10), transparent 36%),
            rgba(255, 255, 255, 0.96) !important;
        border-color: rgba(168, 85, 247, 0.16) !important;
        box-shadow: 0 20px 46px rgba(168, 85, 247, 0.10) !important;
    }

    .inc-panel::before {
        content: "📋";
        position: absolute;
        right: 26px;
        top: 14px;
        font-size: 58px;
        opacity: 0.07;
        pointer-events: none;
        z-index: 0;
    }

    .inc-panel-header,
    .inc-list-header,
    .inc-list {
        position: relative;
        z-index: 1;
    }

    body.dark-mode .inc-heading h1,
    body.dark .inc-heading h1,
    body.dark-theme .inc-heading h1,
    body.dark-mode .inc-summary-card h2,
    body.dark .inc-summary-card h2,
    body.dark-theme .inc-summary-card h2,
    body.dark-mode .inc-panel-header h3,
    body.dark .inc-panel-header h3,
    body.dark-theme .inc-panel-header h3,
    body.dark-mode .inc-threat-info strong,
    body.dark .inc-threat-info strong,
    body.dark-theme .inc-threat-info strong {
        color: var(--text-heading) !important;
    }

    body.dark-mode .inc-heading p,
    body.dark .inc-heading p,
    body.dark-theme .inc-heading p,
    body.dark-mode .inc-panel-header p,
    body.dark .inc-panel-header p,
    body.dark-theme .inc-panel-header p,
    body.dark-mode .inc-list-header,
    body.dark .inc-list-header,
    body.dark-theme .inc-list-header,
    body.dark-mode .inc-summary-card span,
    body.dark .inc-summary-card span,
    body.dark-theme .inc-summary-card span,
    body.dark-mode .inc-threat-info small,
    body.dark .inc-threat-info small,
    body.dark-theme .inc-threat-info small {
        color: var(--text-body) !important;
    }

    body.dark-mode .inc-status-select,
    body.dark .inc-status-select,
    body.dark-theme .inc-status-select,
    body.dark-mode .inc-assign-select,
    body.dark .inc-assign-select,
    body.dark-theme .inc-assign-select {
        background: #FAF8FC !important;
        border-color: rgba(139, 92, 246, 0.18) !important;
        color: var(--text-heading) !important;
    }
</style>

<script>
    function handleIncidentStatusInline(select) {
        fetch('{{ route('threat.incident.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                signature: select.dataset.signature,
                status: select.value,
                rule_id: select.dataset.ruleId,
                agent: select.dataset.agent,
                source: select.dataset.source,
            }),
        }).catch(function () {});
    }

    function handleAssignInline(select) {
        fetch('{{ route('incident.assign') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                signature: select.dataset.signature,
                rule_id: select.dataset.ruleId,
                agent: select.dataset.agent,
                source: select.dataset.source,
                user_id: select.value || null,
            }),
        }).catch(function () {});
    }

    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('incidentManagementPage');

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

        function syncIncidentTheme() {
            if (!page) return;
            page.classList.toggle('inc-dark', isDarkTheme());
        }

        syncIncidentTheme();

        const observer = new MutationObserver(syncIncidentTheme);
        observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

        const switcher = document.getElementById('sidebarThemeSwitch');
        if (switcher) {
            switcher.addEventListener('change', function () {
                setTimeout(syncIncidentTheme, 50);
            });
        }

        window.addEventListener('storage', syncIncidentTheme);
    });
</script>

@include('partials.auto-refresh')

@endsection
