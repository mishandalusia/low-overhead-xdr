@extends('layouts.app-dashboard')

@php
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
    $topThreatsMax = collect($topThreats)->max('count') ?: 1;
    $progressColors = ['', 'red', 'orange', 'green'];
@endphp

@section('content')

<div class="dashboard-overview-page">

    <div class="page-heading">
        <h1>Dashboard Overview</h1>
        <p>Overview monitoring for events, alerts, incidents, blocked IPs, and threat severity.</p>
    </div>

    @if ($error ?? null)
        <div class="dashboard-error-banner">Unable to reach Wazuh: {{ $error }}</div>
    @endif

    <!-- Summary Cards -->
    <div class="dashboard-stats-grid">
        <div class="dashboard-stat-card purple bento-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <span>Total Threats</span>
                <h2>{{ $totalThreats }}</h2>
                <p>Detected from Wazuh</p>
            </div>
        </div>

        <div class="dashboard-stat-card pink bento-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.25c-.966 0-1.75.784-1.75 1.75v.68C7.5 5.36 5.75 7.86 5.75 10.75v3.19c0 .414-.164.81-.457 1.103l-1.086 1.086A1.5 1.5 0 0 0 5.27 18.5h13.46a1.5 1.5 0 0 0 1.06-2.561l-1.086-1.086a1.56 1.56 0 0 1-.457-1.103v-3.19c0-2.89-1.75-5.39-4.5-6.07V4c0-.966-.784-1.75-1.75-1.75ZM9.5 20a2.5 2.5 0 0 0 5 0h-5Z"/></svg>
            </div>
            <div>
                <span>Active Alerts</span>
                <h2>{{ $activeAlerts }}</h2>
                <p>Alerts need attention</p>
            </div>
        </div>

        <div class="dashboard-stat-card yellow bento-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM8.28 8.22a.75.75 0 0 0-1.06 1.06L10.94 13l-3.72 3.72a.75.75 0 1 0 1.06 1.06L12 14.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L13.06 13l3.72-3.72a.75.75 0 0 0-1.06-1.06L12 11.94 8.28 8.22Z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <span>Active Blocks</span>
                <h2>{{ $activeBlocks }}</h2>
                <p>Blocked suspicious sources</p>
            </div>
        </div>

        <div class="dashboard-stat-card blue bento-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <span>Resolved Incidents</span>
                <h2>{{ $resolvedIncidents }}</h2>
                <p>Incidents closed</p>
            </div>
        </div>

        <div class="dashboard-stat-card teal bento-card">
            <div class="stat-icon">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 2 7l10 5 10-5-10-5Zm0 8L2 15l10 5 10-5-10-5Z"/></svg>
            </div>
            <div>
                <span>Network / Behaviour</span>
                <h2>{{ $networkAlerts }} / {{ $behaviourAlerts }}</h2>
                <p>Suricata + Isolation Forest alerts</p>
            </div>
        </div>
    </div>

    <!-- Top Threat + Severity -->
    <div class="dashboard-bottom-grid">

        <div class="dashboard-panel bento-card">
            <div class="panel-header">
                <div>
                    <h3>Top Threat Types</h3>
                    <p>Most detected threat categories from monitored endpoints.</p>
                </div>
            </div>

            <div class="threat-list xdr-scroll-list-target">
                @forelse ($topThreats as $index => $entry)
                    @php $percent = round(($entry['count'] / $topThreatsMax) * 100); @endphp
                    <div class="threat-row data-list-row animated-list-item" style="--i: {{ $index }}">
                        <div>
                            <strong>{{ $entry['rule'] }}</strong>
                            <small>{{ $entry['count'] }} detections</small>
                        </div>
                        <span>{{ $percent }}%</span>
                        <div class="threat-progress {{ $progressColors[$index % 4] }}">
                            <div style="width: {{ $percent }}%;"></div>
                        </div>
                    </div>
                @empty
                    @include('partials.empty-state', ['message' => 'All calm! No threats detected yet.'])
                @endforelse
            </div>
        </div>

        <div class="dashboard-panel bento-card">
            <div class="panel-header">
                <div>
                    <h3>Threat Severity Distribution</h3>
                    <p>Threat distribution based on severity level.</p>
                </div>
            </div>

            @php
                $sevOrder = ['Critical', 'High', 'Medium', 'Low'];
                $sevColors = ['Critical' => '#ef4444', 'High' => '#f97316', 'Medium' => '#f59e0b', 'Low' => '#22c55e'];
                $sevRadius = 50;
                $sevCircumference = 2 * M_PI * $sevRadius;
                $sevCumulative = 0;
                $sevArcs = [];
                foreach ($sevOrder as $sevLevel) {
                    $sevCount = $severity[$sevLevel] ?? 0;
                    $sevPct = $totalThreats > 0 ? $sevCount / $totalThreats : 0;
                    $sevLength = $sevPct * $sevCircumference;
                    $sevArcs[$sevLevel] = [
                        'count' => $sevCount,
                        'pct' => round($sevPct * 100),
                        'length' => round($sevLength, 2),
                        'gap' => round($sevCircumference - $sevLength, 2),
                        'offset' => round(-$sevCumulative, 2),
                        'hideOffset' => round(-$sevCumulative + $sevLength, 2),
                    ];
                    $sevCumulative += $sevLength;
                }
            @endphp

            {{-- Vanilla-CSS port of the "AnimatedCard + Visual2" component, same
                 recipe as the Reports "Alert Severity Ratio" card — bigger here
                 since this panel sits next to the taller Top Threat Types list. --}}
            <div class="sev-animated-card">
                <div class="sev-card-visual">
                    <div class="sev-visual-grid"></div>
                    <div class="sev-visual-ellipse"></div>
                    <div class="sev-visual-sweep"></div>

                    <div class="sev-visual-caption">
                        <div class="sev-visual-caption-box">
                            <div class="sev-visual-caption-row">
                                <i></i>
                                <p>Severity Snapshot</p>
                            </div>
                            <p class="sev-visual-caption-sub">Hover to see the full risk breakdown.</p>
                        </div>
                    </div>

                    <div class="sev-visual-donut">
                        <svg class="severity-ring" width="150" height="150" viewBox="0 0 120 120">
                            <circle cx="60" cy="60" r="{{ $sevRadius }}" stroke="rgba(139,92,246,0.16)" stroke-width="11" fill="transparent" />

                            @foreach ($sevOrder as $sevLevel)
                                <circle
                                    cx="60" cy="60" r="{{ $sevRadius }}"
                                    class="severity-arc severity-arc-{{ strtolower($sevLevel) }}"
                                    stroke="{{ $sevColors[$sevLevel] }}"
                                    stroke-width="13"
                                    fill="transparent"
                                    stroke-linecap="round"
                                    transform="rotate(-90 60 60)"
                                    style="stroke-dasharray: {{ $sevArcs[$sevLevel]['length'] }} {{ $sevArcs[$sevLevel]['gap'] }}; --arc-offset: {{ $sevArcs[$sevLevel]['offset'] }}; --arc-hide-offset: {{ $sevArcs[$sevLevel]['hideOffset'] }};"
                                ></circle>
                            @endforeach
                        </svg>

                        <div class="severity-ring-label severity-ring-label-dark">
                            <strong>{{ $totalThreats }}</strong>
                            <span>threats</span>
                        </div>
                    </div>

                    <div class="severity-badges">
                        @foreach ($sevOrder as $sevLevel)
                            <div class="severity-fly-badge sfb-{{ strtolower($sevLevel) }}">
                                <i style="background: {{ $sevColors[$sevLevel] }}"></i>
                                <span>{{ $sevLevel }} · {{ $sevArcs[$sevLevel]['pct'] }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="sev-card-body">
                    <h4 class="sev-card-title">Threat Severity Breakdown</h4>
                    <p class="sev-card-description">
                        {{ $totalThreats }} detected {{ Str::plural('threat', $totalThreats) }} split across four risk levels — hover the chart above for the full ratio.
                    </p>

                    <div class="sev-legend">
                        @foreach ($sevOrder as $sevLevel)
                            <div class="sev-legend-item sev-legend-{{ strtolower($sevLevel) }}">
                                <i></i>
                                <span>{{ $sevLevel }}</span>
                                <b>{{ $sevArcs[$sevLevel]['count'] }}</b>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Alerts -->
    <div class="dashboard-panel recent-alerts-panel bento-card">
        <div class="panel-header">
            <div>
                <h3>Recent Alerts</h3>
                <p>Latest security alerts detected from monitored endpoints.</p>
            </div>
        </div>

        <div class="recent-alert-list xdr-scroll-list-target">
            @forelse ($recentAlerts as $index => $alert)
                <div class="recent-alert-item data-list-row {{ strtolower($alert['severity']) === 'critical' ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}">
                    <div class="alert-time">{{ $alert['clock'] }}</div>
                    <div class="alert-info">
                        <strong>{{ $alert['rule'] }}</strong>
                        <small>{{ $alert['category'] ?? 'General' }} • Agent: {{ $alert['agent'] }}</small>
                    </div>
                    <span class="alert-severity {{ strtolower($alert['severity']) }}">{{ $alert['severity'] }}</span>
                    <div class="alert-source">{{ $alert['source'] }}</div>
                    <button class="detail-btn" data-alert="{{ json_encode($buildAlertPayload($alert)) }}" onclick="openThreatDetail(this)">Detail</button>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'All clear! No recent alerts to show.'])
            @endforelse
        </div>
    </div>

    <!-- Alert History Filter -->
    <div class="dashboard-panel alert-history-panel bento-card">
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
                <select id="historySeverity" class="xdr-filter-select" onchange="filterAlertHistory()">
                    <option value="all">All Severity</option>
                    <option value="Critical">Critical</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>

            <div>
                <label>Filter Category</label>
                <select id="historyCategory" class="xdr-filter-select" onchange="filterAlertHistory()">
                    <option value="all">All Categories</option>
                    @foreach (collect($threatHistory)->pluck('category')->filter()->unique()->sort() as $categoryName)
                        <option value="{{ $categoryName }}">{{ $categoryName }}</option>
                    @endforeach
                </select>
            </div>

            <button type="button" onclick="resetHistoryFilter()" class="reset-history-btn">
                Reset
            </button>
        </div>

        <div class="alert-history-list xdr-scroll-list-target" id="alertHistoryList">
            @forelse ($threatHistory as $index => $alert)
                <div class="history-alert-row data-list-row {{ strtolower($alert['severity']) === 'critical' ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}" data-date="{{ $alert['date'] }}" data-severity="{{ $alert['severity'] }}" data-category="{{ $alert['category'] ?? 'General' }}">
                    <div>
                        <strong>{{ $alert['rule'] }}</strong>
                        <small>{{ $alert['date'] }} • {{ $alert['clock'] }} • {{ $alert['category'] ?? 'General' }}</small>
                    </div>
                    <span class="alert-severity {{ strtolower($alert['severity']) }}">{{ $alert['severity'] }}</span>
                    <button class="detail-btn small" data-alert="{{ json_encode($buildAlertPayload($alert)) }}" onclick="openThreatDetail(this)">Detail</button>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'All clear! No alert history yet.'])
            @endforelse
        </div>
    </div>

</div>

@include('partials.threat-detail-modal')

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

    .dashboard-error-banner {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-radius: 16px;
        background: #fee2e2 !important;
        border: 1px solid rgba(220, 38, 38, 0.25) !important;
        color: #dc2626 !important;
        font-size: 13px;
        font-weight: 800;
    }

    .dashboard-stats-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
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
        background: var(--card-bg);
        border: 1px solid rgba(139, 92, 246, 0.10);
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.06);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .dashboard-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(139, 92, 246, 0.12);
    }

    /* All 5 stat cards are the same size — the previous asymmetric bento
       span (purple 2x2 + the rest 2x1) only actually worked out evenly
       for exactly 4 cards; adding a 5th broke the math and left visible
       gaps. Equal sizing keeps gap/height consistent regardless of how
       many cards end up in this row. */
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: var(--accent-purple);
        background: #FAF8FC;
        box-shadow: 0 10px 22px rgba(139, 92, 246, 0.10);
    }

    .dashboard-stat-card.purple .stat-icon { color: #8b5cf6 !important; background: rgba(139, 92, 246, 0.12) !important; }
    .dashboard-stat-card.pink .stat-icon { color: #ec4899 !important; background: rgba(236, 72, 153, 0.12) !important; }
    .dashboard-stat-card.yellow .stat-icon { color: #ea580c !important; background: rgba(234, 88, 12, 0.12) !important; }
    .dashboard-stat-card.blue .stat-icon { color: #2563eb !important; background: rgba(37, 99, 235, 0.12) !important; }
    .dashboard-stat-card.teal .stat-icon { color: #0d9488 !important; background: rgba(13, 148, 136, 0.12) !important; }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .dashboard-stat-card span {
        color: var(--text-body);
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .dashboard-stat-card h2 {
        margin: 8px 0 2px;
        color: var(--text-heading);
        font-size: 34px;
        font-weight: 900;
        letter-spacing: -0.5px;
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
        background: var(--card-bg);
        border: 1px solid rgba(139, 92, 246, 0.10);
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07);
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

    /* These lists sit flush (zebra table look via .data-list-row) instead
       of the gapped card-stack look. */
    .alert-history-list,
    .threat-list,
    .recent-alert-list {
        gap: 0;
    }

    .threat-row {
        display: grid;
        grid-template-columns: 1fr 60px 150px;
        align-items: center;
        gap: 18px;
        padding: 18px 20px;
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

    /* Threat Severity Distribution — vanilla-CSS port of the "AnimatedCard +
       Visual2" component (same recipe as Reports' Alert Severity Ratio),
       sized up since this panel sits next to the taller Top Threat Types
       list and was getting lost at the old compact size. */
    .sev-animated-card {
        position: relative;
        margin-top: 18px;
        border-radius: 24px;
        overflow: hidden;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.12) !important;
        box-shadow: 0 14px 32px rgba(139, 92, 246, 0.08);
    }

    .sev-card-visual {
        position: relative;
        height: 260px;
        width: 100%;
        overflow: hidden;
        background: linear-gradient(160deg, #faf8fc 0%, #f6effc 100%);
    }

    .sev-visual-grid {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        opacity: 0.6;
        background-image:
            linear-gradient(to right, rgba(139, 92, 246, 0.12) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(139, 92, 246, 0.12) 1px, transparent 1px);
        background-size: 20px 20px;
        background-position: center;
        -webkit-mask-image: radial-gradient(ellipse 60% 60% at 50% 50%, #000 55%, transparent 100%);
        mask-image: radial-gradient(ellipse 60% 60% at 50% 50%, #000 55%, transparent 100%);
    }

    .sev-visual-ellipse {
        position: absolute;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        background: radial-gradient(ellipse 60% 55% at 50% 45%, rgba(139, 92, 246, 0.16), transparent 72%);
    }

    .sev-visual-sweep {
        position: absolute;
        inset: 0;
        z-index: 2;
        pointer-events: none;
        opacity: 0;
        transform: translateY(100%);
        background: linear-gradient(to top, rgba(139, 92, 246, 0.22), transparent 65%);
        transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .sev-animated-card:hover .sev-visual-sweep {
        opacity: 1;
        transform: translateY(0);
    }

    .sev-visual-caption {
        position: absolute;
        inset: 0;
        z-index: 4;
        display: flex;
        justify-content: center;
        padding-top: 16px;
        transition: opacity 0.4s ease, transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
        pointer-events: none;
    }

    .sev-animated-card:hover .sev-visual-caption {
        opacity: 0;
        transform: translateY(16px);
    }

    .sev-visual-caption-box {
        border-radius: 12px;
        padding: 8px 14px;
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(139, 92, 246, 0.16);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        text-align: left;
    }

    .sev-visual-caption-row {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .sev-visual-caption-row i {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--accent-purple);
        flex-shrink: 0;
    }

    .sev-visual-caption-row p {
        margin: 0;
        font-size: 12px;
        font-weight: 850;
        color: #1e1b2e;
    }

    .sev-visual-caption-sub {
        margin: 3px 0 0;
        font-size: 11px;
        font-weight: 600;
        color: #6b6280;
    }

    .sev-visual-donut {
        position: absolute;
        inset: 0;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .sev-animated-card:hover .sev-visual-donut {
        transform: translateY(-18px) scale(1.06);
    }

    .severity-ring {
        position: relative;
        z-index: 1;
    }

    /* Each arc's dasharray (its real share of the ring) is fixed and never
       animated — only stroke-dashoffset transitions, sliding the arc from
       a tucked-away "hidden" position into its resting spot. dashoffset
       is a single number, so browsers always interpolate it smoothly in
       both directions; animating dasharray directly is a 2-value list
       some browsers tween unevenly, which read as choppy on hover-out. */
    .severity-arc {
        stroke-dashoffset: var(--arc-hide-offset);
        transition: stroke-dashoffset 0.6s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .severity-arc-critical { transition-delay: 0s; }
    .severity-arc-high { transition-delay: 0.08s; }
    .severity-arc-medium { transition-delay: 0.16s; }
    .severity-arc-low { transition-delay: 0.24s; }

    .sev-animated-card:hover .severity-arc {
        stroke-dashoffset: var(--arc-offset);
    }

    .severity-ring-label {
        position: absolute;
        z-index: 1;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .severity-ring-label.severity-ring-label-dark strong {
        color: #1e1b2e;
        font-size: 26px;
        font-weight: 950;
        line-height: 1;
    }

    .severity-ring-label.severity-ring-label-dark span {
        color: #6b6280;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 4px;
    }

    .severity-badges {
        position: absolute;
        inset: 0;
        z-index: 6;
        pointer-events: none;
    }

    .severity-fly-badge {
        position: absolute;
        top: 50%;
        left: 50%;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.96);
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.2);
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.6);
        transition: opacity 0.45s cubic-bezier(0.22, 1, 0.36, 1), transform 0.45s cubic-bezier(0.22, 1, 0.36, 1);
        white-space: nowrap;
    }

    .severity-fly-badge i {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .severity-fly-badge span {
        font-size: 11px;
        font-weight: 850;
        color: #1e1b2e;
    }

    .sev-animated-card:hover .sfb-critical {
        opacity: 1;
        transform: translate(calc(-50% - 130px), calc(-50% - 66px)) scale(1);
        transition-delay: 0.05s;
    }

    .sev-animated-card:hover .sfb-high {
        opacity: 1;
        transform: translate(calc(-50% + 130px), calc(-50% - 66px)) scale(1);
        transition-delay: 0.1s;
    }

    .sev-animated-card:hover .sfb-medium {
        opacity: 1;
        transform: translate(calc(-50% - 130px), calc(-50% + 66px)) scale(1);
        transition-delay: 0.15s;
    }

    .sev-animated-card:hover .sfb-low {
        opacity: 1;
        transform: translate(calc(-50% + 130px), calc(-50% + 66px)) scale(1);
        transition-delay: 0.2s;
    }

    .sev-card-body {
        border-top: 1px solid rgba(139, 92, 246, 0.10);
        padding: 20px 24px 24px;
        background: var(--card-bg) !important;
    }

    .sev-card-title {
        margin: 0;
        font-size: 17px;
        font-weight: 900;
        color: #1e1b2e;
    }

    .sev-card-description {
        margin: 6px 0 0;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.55;
        color: #6b6280;
    }

    .sev-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
    }

    .sev-legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        border: 1px solid rgba(139, 92, 246, 0.14);
        background: #faf8fc;
    }

    .sev-legend-item i {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .sev-legend-critical i { background: #ef4444; }
    .sev-legend-high i { background: #f97316; }
    .sev-legend-medium i { background: #f59e0b; }
    .sev-legend-low i { background: #22c55e; }

    .sev-legend-item span {
        font-size: 11px;
        font-weight: 800;
        color: #6b6280;
    }

    .sev-legend-item b {
        font-size: 13px;
        font-weight: 950;
        color: #1e1b2e;
        margin-left: 1px;
    }

    @media (prefers-reduced-motion: reduce) {
        .severity-arc {
            transition: none;
            stroke-dashoffset: var(--arc-offset);
        }

        .severity-fly-badge,
        .sev-visual-grid,
        .sev-visual-ellipse,
        .sev-visual-sweep,
        .sev-visual-caption,
        .sev-visual-donut {
            transition: none;
        }
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
    }

    .history-alert-row {
        grid-template-columns: 1fr 120px 100px;
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
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%);
        font-size: 12px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 22px rgba(236, 72, 153, 0.22);
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
        border: 1px solid #E5DFF0;
        background: #ffffff;
        padding: 0 16px;
        color: #0f172a;
        font-weight: 800;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .reset-history-btn {
        height: 48px;
        border: none;
        border-radius: 999px;
        padding: 0 22px;
        cursor: pointer;
        color: #ffffff;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%);
        box-shadow: 0 10px 22px rgba(236, 72, 153, 0.22);
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

.dashboard-stat-card.teal {
    background:
        radial-gradient(circle at top right, rgba(20, 184, 166, 0.22), transparent 36%),
        linear-gradient(135deg, #ffffff, #ccfbf1) !important;
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

/* Top Threat Types / Recent Alerts / Alert History — background, radius,
   shadow, and hover are now fully owned by the shared .data-list-row
   zebra system (see partials/design-tokens.blade.php); the row-specific
   text styling below stays. */

/* Detail button */
.detail-btn {
    background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%) !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 10px 24px rgba(236, 72, 153, 0.24);
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
    border-color: #8B5CF6 !important;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
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

/* Redesign lock — keep the new light card system regardless of the
   light/dark content toggle (only the sidebar and top bar follow it). */
.dashboard-stat-card.dashboard-stat-card,
.dashboard-panel.dashboard-panel,
body.dark-mode .dashboard-stat-card.dashboard-stat-card,
body.dark .dashboard-stat-card.dashboard-stat-card,
body.dark-theme .dashboard-stat-card.dashboard-stat-card,
body.dark-mode .dashboard-panel.dashboard-panel,
body.dark .dashboard-panel.dashboard-panel,
body.dark-theme .dashboard-panel.dashboard-panel {
    background: var(--card-bg) !important;
    border-color: rgba(139, 92, 246, 0.10) !important;
}

body.dark-mode .page-heading h1,
body.dark .page-heading h1,
body.dark-theme .page-heading h1,
body.dark-mode .panel-header h3,
body.dark .panel-header h3,
body.dark-theme .panel-header h3,
.page-heading h1,
.panel-header h3 {
    color: var(--text-heading) !important;
}

body.dark-mode .page-heading p,
body.dark .page-heading p,
body.dark-theme .page-heading p,
body.dark-mode .panel-header p,
body.dark .panel-header p,
body.dark-theme .panel-header p {
    color: var(--text-body) !important;
}

body.dark-mode .dashboard-stat-card h2,
body.dark .dashboard-stat-card h2,
body.dark-theme .dashboard-stat-card h2 {
    color: var(--text-heading) !important;
}
</style>

<script>
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

@include('partials.auto-refresh')

@endsection