@extends('layouts.app-dashboard')

@php
    $dailyTotal = $dailyRows->count();
    $weeklyTotal = $weeklyRows->sum('count');
    $dailyBlocked = $dailyRows->pluck('source')->unique()->count();
    $weeklyBlocked = $weeklyRows->sum('blocked_count');
@endphp

@section('content')

<div class="rpt-page" id="reportsPage">

    @if ($error ?? null)
        <div class="rpt-error-banner">Unable to reach Wazuh: {{ $error }}</div>
    @endif

    <div class="rpt-hero bento-card">
        <div>
            <span>Security Reports</span>
            <h1>Reports</h1>
            <p>Security activity report by day and week, including blocked IP activity and alert severity summary.</p>
        </div>

        <div class="rpt-actions">
            <a href="{{ route('analytics.export.pdf') }}" class="rpt-btn pdf">Export PDF</a>
            <a href="{{ route('analytics.export.csv') }}" class="rpt-btn csv">Export CSV</a>
        </div>
    </div>

    <div class="rpt-summary-grid">
        <div class="rpt-summary-card neutral bento-card featured">
            <div class="rpt-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg></div>
            <div>
                <span>Total Activities</span>
                <h2 id="summaryActivity">{{ $totalActivities }}</h2>
                <p>Detected activities</p>
            </div>
        </div>

        <div class="rpt-summary-card success bento-card">
            <div class="rpt-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM8.28 8.22a.75.75 0 0 0-1.06 1.06L10.94 13l-3.72 3.72a.75.75 0 1 0 1.06 1.06L12 14.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L13.06 13l3.72-3.72a.75.75 0 0 0-1.06-1.06L12 11.94 8.28 8.22Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Blocked IPs</span>
                <h2 id="summaryBlocked">{{ $blockedIpCount }}</h2>
                <p>Suspicious sources blocked</p>
            </div>
        </div>

        <div class="rpt-summary-card danger bento-card">
            <div class="rpt-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Critical Alerts</span>
                <h2>{{ $criticalCount }}</h2>
                <p>Need immediate action</p>
            </div>
        </div>

        <div class="rpt-summary-card success bento-card">
            <div class="rpt-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Response Success</span>
                <h2>{{ $responseSuccessRate }}%</h2>
                <p>Handled response actions</p>
            </div>
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

        <div class="rpt-panel bento-card">
            <div class="rpt-panel-header">
                <span>Attack Activity</span>
                <h3>Activity Trend</h3>
                <p>Activity movement detected from monitored endpoints.</p>
            </div>

            <div class="rpt-chart-box chart-hover-card">
                <div class="chart-hover-grid"></div>
                <div class="chart-hover-glow"></div>

                <div class="chart-hover-badges">
                    <div class="chart-hover-badge">
                        <i style="background: #dc2626;"></i>
                        <span>{{ $totalActivities ? round(($criticalCount / $totalActivities) * 100) : 0 }}% critical</span>
                    </div>
                    <div class="chart-hover-badge">
                        <i style="background: #8b5cf6;"></i>
                        <span>{{ $totalActivities ? round(($blockedIpCount / $totalActivities) * 100) : 0 }}% blocked</span>
                    </div>
                </div>

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

                <div class="rpt-chart-info chart-hover-caption">
                    <span>Peak Activity</span>
                    <strong>{{ $peakDayLabel }}</strong>
                    <small>{{ $totalActivities }} total activities</small>
                </div>
            </div>

            <div class="rpt-trend-summary">
                <div>
                    <small>Total Activities</small>
                    <strong id="trendActivity">{{ $dailyTotal }}</strong>
                </div>

                <div>
                    <small>Blocked IPs</small>
                    <strong id="trendBlocked">{{ $dailyBlocked }}</strong>
                </div>

                <div>
                    <small>Report Mode</small>
                    <strong id="trendMode">Daily</strong>
                </div>
            </div>
        </div>

        <div class="rpt-panel bento-card">
            <div class="rpt-panel-header">
                <span>Severity Distribution</span>
                <h3>Alert Severity Ratio</h3>
                <p>Distribution of alerts based on severity category.</p>
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
                    $sevPct = $totalActivities > 0 ? $sevCount / $totalActivities : 0;
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

            {{-- Vanilla-CSS port of the "AnimatedCard + Visual2" component: a
                 CardVisual hover-reveal chart on top, CardBody caption below. --}}
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
                            <strong>{{ $totalActivities }}</strong>
                            <span>alerts</span>
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
                    <h4 class="sev-card-title">Alert Severity Breakdown</h4>
                    <p class="sev-card-description">
                        {{ $totalActivities }} monitored {{ Str::plural('alert', $totalActivities) }} split across four risk levels — hover the chart above for the full ratio.
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

    <div class="rpt-panel rpt-activity-panel bento-card">
        <div class="rpt-panel-header">
            <span>Activity Details</span>
            <h3 id="activityTitle">Daily Security Activity</h3>
            <p>Security activities including detected alerts and blocked IP actions.</p>
        </div>

        <div class="rpt-activity-header data-table-header">
            <span>Date</span>
            <span>Time</span>
            <span>Activity</span>
            <span>Blocked IP</span>
            <span>Category</span>
            <span>Severity</span>
            <span>Status</span>
        </div>

        <div class="rpt-activity-list xdr-scroll-list-target" id="activityList">

            @forelse ($dailyRows as $index => $row)
                <div class="rpt-activity-row data-list-row {{ ['purple', 'violet', 'red', 'blue'][$index % 4] }} {{ strtolower($row['severity'] ?? '') === 'critical' ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}" data-period="daily">
                    <div>
                        <small>Date</small>
                        <strong>{{ $row['date'] ?? '-' }}</strong>
                    </div>

                    <div>
                        <small>Time</small>
                        <strong>{{ $row['clock'] ?? '-' }}</strong>
                    </div>

                    <div>
                        <small>Activity</small>
                        <strong>{{ $row['rule'] ?? '-' }}</strong>
                    </div>

                    <div>
                        <small>Blocked IP</small>
                        <strong>{{ ($row['response_label'] ?? null) === 'Blocked' ? $row['source'] : '-' }}</strong>
                    </div>

                    <div>
                        <small>Category</small>
                        <strong>{{ $row['category'] ?? 'General' }}</strong>
                    </div>

                    <div>
                        <span class="rpt-badge {{ strtolower($row['severity'] ?? 'low') }}">{{ $row['severity'] ?? 'Low' }}</span>
                    </div>

                    <div>
                        <span class="rpt-status {{ strtolower($row['response_label'] ?? 'pending') }}">{{ $row['response_label'] ?? 'Pending' }}</span>
                    </div>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'No activity recorded yet.'])
            @endforelse

            @forelse ($weeklyRows as $index => $row)
                <div class="rpt-activity-row data-list-row {{ ['purple', 'violet', 'red', 'blue'][$index % 4] }} {{ strtolower($row['severity'] ?? '') === 'critical' ? 'is-urgent' : '' }}" data-period="weekly" style="display:none;">
                    <div>
                        <small>Period</small>
                        <strong>{{ $row['week_label'] }}</strong>
                    </div>

                    <div>
                        <small>Time</small>
                        <strong>-</strong>
                    </div>

                    <div>
                        <small>Activity</small>
                        <strong>Total {{ $row['category'] }} Activities</strong>
                    </div>

                    <div>
                        <small>Blocked IP</small>
                        <strong>{{ $row['blocked_count'] }} IPs</strong>
                    </div>

                    <div>
                        <small>Category</small>
                        <strong>{{ $row['category'] }}</strong>
                    </div>

                    <div>
                        <span class="rpt-badge {{ strtolower($row['severity']) }}">{{ $row['severity'] }}</span>
                    </div>

                    <div>
                        <span class="rpt-status {{ strtolower($row['status']) }}">{{ $row['status'] }}</span>
                    </div>
                </div>
            @empty
                <p style="display:none;" data-period="weekly">No weekly activity recorded yet.</p>
            @endforelse

        </div>
    </div>

    <div class="rpt-panel rpt-blocked-panel bento-card">
        <div class="rpt-panel-header">
            <span>Blocked IP Activity</span>
            <h3>Blocked IP Report</h3>
            <p>List of IP addresses blocked by response action.</p>
        </div>

        <div class="rpt-blocked-grid">
            @forelse ($blockedIpCards as $index => $card)
                <div class="rpt-blocked-card animated-list-item" style="--i: {{ $index }}">
                    <strong>{{ $card['ip'] }}</strong>
                    <span>{{ $card['rule_description'] ?? 'Blocked source' }} • {{ $card['blocked_at'] ? \Illuminate\Support\Carbon::parse($card['blocked_at'])->format('H:i') : '-' }}</span>
                    <b class="rpt-badge {{ strtolower($card['severity']) }}">{{ $card['severity'] }}</b>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'No IPs are currently blocked.'])
            @endforelse
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

    .rpt-error-banner {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-radius: 16px;
        background: #fee2e2 !important;
        border: 1px solid rgba(220, 38, 38, 0.25) !important;
        color: #dc2626 !important;
        font-size: 13px;
        font-weight: 800;
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
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07) !important;
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
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        height: 50px;
        padding: 0 24px;
        border-radius: 999px;
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: 0.2s ease;
        box-shadow: 0 14px 30px rgba(236, 72, 153, 0.22);
    }

    .rpt-btn.pdf,
    .rpt-btn.csv {
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%) !important;
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
        display: flex;
        align-items: center;
        gap: 18px;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.06) !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .rpt-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(139, 92, 246, 0.12) !important;
    }

    /* All summary cards are the same size — see dashboard.blade.php for
       why the asymmetric featured-card span was dropped. */
    .rpt-summary-icon {
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

    .rpt-summary-icon svg {
        width: 24px;
        height: 24px;
    }

    .rpt-summary-card.neutral .rpt-summary-icon { color: #8b5cf6 !important; background: rgba(139, 92, 246, 0.12) !important; }
    .rpt-summary-card.success .rpt-summary-icon { color: #059669 !important; background: rgba(5, 150, 105, 0.12) !important; }
    .rpt-summary-card.danger .rpt-summary-icon { color: #dc2626 !important; background: rgba(220, 38, 38, 0.12) !important; }

    .rpt-summary-card span,
    .rpt-summary-card h2,
    .rpt-summary-card p {
        position: relative;
        z-index: 2;
    }

    .rpt-summary-card span {
        color: var(--text-body) !important;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .rpt-summary-card h2 {
        margin: 8px 0 2px;
        color: var(--text-heading) !important;
        font-size: 34px;
        font-weight: 900;
        letter-spacing: -0.5px;
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
        border-radius: 999px;
        background: #f3e8ff !important;
        color: #7c3aed !important;
        font-size: 13px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .rpt-mode-btn.active {
        color: #ffffff !important;
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%) !important;
        box-shadow: 0 10px 22px rgba(236, 72, 153, 0.22);
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
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07) !important;
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
        background: #FAF8FC !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.06);
    }

    /* Animated chart card treatment — grid backdrop + glow + a caption that
       slides up on hover, vanilla-CSS take on the "Visual3" hover chart card. */
    .chart-hover-grid {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background-image:
            linear-gradient(to right, rgba(139, 92, 246, 0.10) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(139, 92, 246, 0.10) 1px, transparent 1px);
        background-size: 26px 26px;
        background-position: center;
        -webkit-mask-image: radial-gradient(ellipse 60% 60% at 50% 50%, #000 55%, transparent 100%);
        mask-image: radial-gradient(ellipse 60% 60% at 50% 50%, #000 55%, transparent 100%);
    }

    .chart-hover-glow {
        position: absolute;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background: radial-gradient(ellipse 55% 60% at 50% 40%, rgba(217, 70, 239, 0.14), transparent 72%);
    }

    .chart-hover-badges {
        position: absolute;
        top: 16px;
        left: 16px;
        z-index: 3;
        display: flex;
        gap: 8px;
        transition: opacity 0.3s ease;
    }

    .chart-hover-card:hover .chart-hover-badges {
        opacity: 0;
    }

    .chart-hover-badge {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(139, 92, 246, 0.16);
        backdrop-filter: blur(4px);
    }

    .chart-hover-badge i {
        display: block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .chart-hover-badge span {
        font-size: 10px;
        font-weight: 800;
        color: var(--text-heading);
    }

    .rpt-chart-svg {
        position: relative;
        z-index: 1;
        width: 100%;
        height: 100%;
        transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .chart-hover-card:hover .rpt-chart-svg {
        transform: scale(1.04);
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
        left: 18px;
        right: 18px;
        bottom: 18px;
        z-index: 4;
        min-width: 160px;
        padding: 16px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(168, 85, 247, 0.16);
        box-shadow: 0 18px 34px rgba(168, 85, 247, 0.14);
        backdrop-filter: blur(6px);
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.35s ease, transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
        pointer-events: none;
    }

    .chart-hover-card:hover .rpt-chart-info {
        opacity: 1;
        transform: translateY(0);
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

    /* Alert Severity Ratio — vanilla-CSS port of the "AnimatedCard + Visual2"
       component: a CardVisual hover-reveal chart (grid backdrop, glow,
       gradient sweep, idle caption that slides away, donut that rises +
       draws its real per-level share, badges that fly out) sitting on top
       of a CardBody with title/description/legend, mirroring the supplied
       demo's structure instead of the flat purple total+list block. */
    .sev-animated-card {
        position: relative;
        border-radius: 22px;
        overflow: hidden;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.12) !important;
        box-shadow: 0 12px 28px rgba(139, 92, 246, 0.08);
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
        background-size: 18px 18px;
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
        padding-top: 14px;
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
        color: #1e1b2e !important;
    }

    .sev-visual-caption-sub {
        margin: 3px 0 0;
        font-size: 11px;
        font-weight: 600;
        color: #6b6280 !important;
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
       both directions; animating dasharray directly (the old approach)
       is a 2-value list some browsers tween unevenly, which read as
       choppy on hover-out. */
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
        color: #1e1b2e !important;
        font-size: 26px;
        font-weight: 950;
        line-height: 1;
    }

    .severity-ring-label.severity-ring-label-dark span {
        color: #6b6280 !important;
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
        padding: 4px 9px;
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
        font-size: 10px;
        font-weight: 850;
        color: #1e1b2e !important;
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
        color: #1e1b2e !important;
    }

    .sev-card-description {
        margin: 6px 0 0;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.55;
        color: #6b6280 !important;
    }

    .sev-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 14px;
    }

    .sev-legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 5px 11px;
        border-radius: 999px;
        border: 1px solid rgba(139, 92, 246, 0.14) !important;
        background: #faf8fc !important;
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
        color: #6b6280 !important;
    }

    .sev-legend-item b {
        font-size: 12px;
        font-weight: 950;
        color: #1e1b2e !important;
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
        gap: 0;
    }

    .rpt-activity-row {
        display: grid;
        grid-template-columns: 0.9fr 0.55fr 1.9fr 0.9fr 1.35fr 0.85fr 0.9fr;
        align-items: center;
        gap: 14px;
        min-height: 78px;
        padding: 18px 16px;
    }

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
        background: #FAF8FC !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
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

    /* Redesign lock — keep the new light card system regardless of the
       light/dark content toggle. */
    .rpt-hero.rpt-hero,
    .rpt-summary-card.rpt-summary-card,
    .rpt-panel.rpt-panel,
    .rpt-activity-row.rpt-activity-row,
    body.dark-mode .rpt-hero.rpt-hero,
    body.dark .rpt-hero.rpt-hero,
    body.dark-theme .rpt-hero.rpt-hero,
    .rpt-page.rpt-dark .rpt-hero.rpt-hero,
    body.dark-mode .rpt-summary-card.rpt-summary-card,
    body.dark .rpt-summary-card.rpt-summary-card,
    body.dark-theme .rpt-summary-card.rpt-summary-card,
    .rpt-page.rpt-dark .rpt-summary-card.rpt-summary-card,
    body.dark-mode .rpt-panel.rpt-panel,
    body.dark .rpt-panel.rpt-panel,
    body.dark-theme .rpt-panel.rpt-panel,
    .rpt-page.rpt-dark .rpt-panel.rpt-panel,
    body.dark-mode .rpt-activity-row.rpt-activity-row,
    body.dark .rpt-activity-row.rpt-activity-row,
    body.dark-theme .rpt-activity-row.rpt-activity-row,
    .rpt-page.rpt-dark .rpt-activity-row.rpt-activity-row {
        background: var(--card-bg) !important;
        border-color: rgba(139, 92, 246, 0.10) !important;
    }

    body.dark-mode .rpt-hero h1,
    body.dark .rpt-hero h1,
    body.dark-theme .rpt-hero h1,
    .rpt-page.rpt-dark .rpt-hero h1,
    body.dark-mode .rpt-summary-card h2,
    body.dark .rpt-summary-card h2,
    body.dark-theme .rpt-summary-card h2,
    .rpt-page.rpt-dark .rpt-summary-card h2,
    body.dark-mode .rpt-panel-header h3,
    body.dark .rpt-panel-header h3,
    body.dark-theme .rpt-panel-header h3,
    .rpt-page.rpt-dark .rpt-panel-header h3,
    body.dark-mode .rpt-activity-row strong,
    body.dark .rpt-activity-row strong,
    body.dark-theme .rpt-activity-row strong,
    .rpt-page.rpt-dark .rpt-activity-row strong,
    body.dark-mode .rpt-blocked-card strong,
    body.dark .rpt-blocked-card strong,
    body.dark-theme .rpt-blocked-card strong,
    .rpt-page.rpt-dark .rpt-blocked-card strong {
        color: var(--text-heading) !important;
    }

    body.dark-mode .rpt-hero p,
    body.dark .rpt-hero p,
    body.dark-theme .rpt-hero p,
    .rpt-page.rpt-dark .rpt-hero p,
    body.dark-mode .rpt-summary-card span,
    body.dark .rpt-summary-card span,
    body.dark-theme .rpt-summary-card span,
    .rpt-page.rpt-dark .rpt-summary-card span,
    body.dark-mode .rpt-panel-header p,
    body.dark .rpt-panel-header p,
    body.dark-theme .rpt-panel-header p,
    .rpt-page.rpt-dark .rpt-panel-header p,
    body.dark-mode .rpt-activity-row small,
    body.dark .rpt-activity-row small,
    body.dark-theme .rpt-activity-row small,
    .rpt-page.rpt-dark .rpt-activity-row small,
    body.dark-mode .rpt-blocked-card span,
    body.dark .rpt-blocked-card span,
    body.dark-theme .rpt-blocked-card span,
    .rpt-page.rpt-dark .rpt-blocked-card span {
        color: var(--text-body) !important;
    }

    body.dark-mode .rpt-blocked-card,
    body.dark .rpt-blocked-card,
    body.dark-theme .rpt-blocked-card,
    .rpt-page.rpt-dark .rpt-blocked-card {
        background: #FAF8FC !important;
        border-color: rgba(139, 92, 246, 0.10) !important;
    }
</style>

<script>
    const reportTotals = {
        daily: { activity: {{ $dailyTotal }}, blocked: {{ $dailyBlocked }} },
        weekly: { activity: {{ $weeklyTotal }}, blocked: {{ $weeklyBlocked }} },
    };

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

        document.getElementById('summaryActivity').innerText = reportTotals[mode].activity;
        document.getElementById('summaryBlocked').innerText = reportTotals[mode].blocked;
        document.getElementById('trendActivity').innerText = reportTotals[mode].activity;
        document.getElementById('trendBlocked').innerText = reportTotals[mode].blocked;
        document.getElementById('trendMode').innerText = mode === 'daily' ? 'Daily' : 'Weekly';
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

@include('partials.auto-refresh')

@endsection