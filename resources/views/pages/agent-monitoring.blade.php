@extends('layouts.app-dashboard')

@php
    $agents = $agents ?? [];
    $totalAgents = count($agents);
    $onlineAgents = collect($agents)->where('status', 'active')->count();
    $offlineAgents = $totalAgents - $onlineAgents;
    $fleetHealth = $totalAgents ? round(($onlineAgents / $totalAgents) * 100) : 0;
    $rowColors = ['green', 'blue', 'yellow'];

    $initials = function ($name) {
        $name = trim((string) $name);
        return $name === '' ? '??' : strtoupper(substr($name, 0, 2));
    };

    $osLabel = function ($agent) {
        $platform = $agent['os']['platform'] ?? null;
        $name = $agent['os']['name'] ?? null;
        return $name ?: ($platform ? ucfirst($platform) : 'Unknown OS');
    };
@endphp

@section('content')

<div class="agp-page" id="agentMonitoringPage">

    <div class="agp-heading">
        <h1>Agent Monitoring</h1>
        <p>Monitor connected agents, endpoint status, last activity, and operating system.</p>
    </div>

    @if ($error ?? null)
        <div class="agp-error-banner">Unable to reach the Wazuh Manager API: {{ $error }}</div>
    @endif

    <div class="agp-summary-grid">
        <div class="agp-summary-card online bento-card featured">
            <div class="agp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.5a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5ZM7.05 15.05a7 7 0 0 1 9.9 0 1 1 0 0 1 0 1.415l-.601.6a1 1 0 0 1-1.374.036 4.2 4.2 0 0 0-5.95 0 1 1 0 0 1-1.374-.036l-.6-.6a1 1 0 0 1 0-1.415ZM3.222 11.222a11.5 11.5 0 0 1 17.556 0 1 1 0 0 1 .03 1.394l-.6.6a1 1 0 0 1-1.393.012 8.9 8.9 0 0 0-13.63 0 1 1 0 0 1-1.393-.012l-.6-.6a1 1 0 0 1 .03-1.394Z"/></svg></div>
            <div>
                <span>Online Agents</span>
                <h2>{{ $onlineAgents }}</h2>
                <p>Currently connected</p>
            </div>
        </div>

        <div class="agp-summary-card offline bento-card">
            <div class="agp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.5a1.75 1.75 0 1 0 0-3.5 1.75 1.75 0 0 0 0 3.5ZM7.05 15.05a7 7 0 0 1 5.313-2.027l-1.755 1.755a4.2 4.2 0 0 0-1.932 1.108 1 1 0 0 1-1.374-.036l-.6-.6a1 1 0 0 1-.048-1.36l.396.16ZM3.222 11.222a11.5 11.5 0 0 1 13.85-1.89l-1.51 1.51a8.9 8.9 0 0 0-9.746 2.202 1 1 0 0 1-1.393-.012l-.6-.6a1 1 0 0 1 .03-1.394ZM20.778 11.222c.36.363.556.85.556 1.36l-1.83-1.29c.437-.164.918-.184 1.274-.07Z" fill-opacity="0.55"/><path fill-rule="evenodd" d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Offline Agents</span>
                <h2>{{ $offlineAgents }}</h2>
                <p>Need attention</p>
            </div>
        </div>

        <div class="agp-summary-card total bento-card">
            <div class="agp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M4 3h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm2.75 3a1 1 0 1 0 0 2 1 1 0 0 0 0-2ZM4 13h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2Zm2.75 3a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z"/></svg></div>
            <div>
                <span>Total Agents</span>
                <h2>{{ $totalAgents }}</h2>
                <p>Registered endpoints</p>
            </div>
        </div>

        <div class="agp-summary-card health bento-card">
            <div class="agp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.416 2.653a1 1 0 0 0-1.87-.146L8.24 10.2 6.9 7.132A1 1 0 0 0 5.98 6.5H2a1 1 0 1 0 0 2h3.324l2.223 5.076a1 1 0 0 0 1.865.114l3.235-7.463 1.478 8.31a1 1 0 0 0 1.849.322L18.62 10.5H22a1 1 0 1 0 0-2h-4a1 1 0 0 0-.86.49l-1.107 1.87-1.94-10.912a1 1 0 0 0-.677-1.295Z"/></svg></div>
            <div>
                <span>Fleet Health</span>
                <h2>{{ $fleetHealth }}%</h2>
                <p>Share of agents online</p>
            </div>
        </div>
    </div>

    <div class="agp-content-grid">

        <div class="agp-panel bento-card">
            <div class="agp-panel-header">
                <h3>Connected Agents</h3>
                <p>List of endpoints connected to the LOX monitoring system.</p>
            </div>

            <div class="agp-agent-list xdr-scroll-list-target">

                @forelse ($agents as $index => $agent)
                    @php
                        $isOnline = ($agent['status'] ?? null) === 'active';
                        $rowColor = $isOnline ? $rowColors[$index % count($rowColors)] : 'red';
                        $lastSeen = $agent['lastKeepAlive'] ?? null;
                    @endphp
                    <div class="agp-agent-row data-list-row {{ $rowColor }} {{ ! $isOnline ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}">
                        <div class="agp-agent-name">
                            <div class="agp-avatar {{ $rowColor }}">{{ $initials($agent['name'] ?? '') }}</div>
                            <div>
                                <strong>{{ $agent['name'] ?? 'Unknown agent' }}</strong>
                                <span>Agent ID {{ $agent['id'] ?? '-' }} • v{{ $agent['version'] ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="agp-cell">
                            <small>Status</small>
                            <b class="agp-status {{ $isOnline ? 'online' : 'offline' }}">{{ $isOnline ? 'Online' : ucfirst($agent['status'] ?? 'Unknown') }}</b>
                        </div>

                        <div class="agp-cell">
                            <small>Last Seen</small>
                            <strong>{{ $lastSeen ? \Illuminate\Support\Carbon::parse($lastSeen)->format('Y-m-d H:i') : '-' }}</strong>
                        </div>

                        <div class="agp-cell">
                            <small>IP Address</small>
                            <strong>{{ $agent['ip'] ?? '-' }}</strong>
                        </div>

                        <div class="agp-cell">
                            <small>Operating System</small>
                            <strong>{{ $osLabel($agent) }}</strong>
                        </div>
                    </div>
                @empty
                    @include('partials.empty-state', ['message' => 'No agents reported yet — they will appear here once Wazuh is connected.'])
                @endforelse

            </div>
        </div>

        <div class="agp-panel agp-health-panel bento-card">
            <div class="agp-panel-header">
                <h3>Agent Health</h3>
                <p>Endpoint condition based on connection status and activity.</p>
            </div>

            <div class="agp-health-list xdr-scroll-list-target">
                @forelse ($agents as $index => $agent)
                    @php
                        $isOnline = ($agent['status'] ?? null) === 'active';
                        $lastSeen = $agent['lastKeepAlive'] ?? null;
                    @endphp
                    <div class="agp-health-card data-list-row {{ ! $isOnline ? 'is-urgent' : '' }} animated-list-item" style="--i: {{ $index }}">
                        <div>
                            <strong>{{ $agent['name'] ?? 'Unknown agent' }}</strong>
                            <span>{{ $isOnline ? 'Stable connection' : 'No recent communication' }}</span>
                        </div>
                        <b class="{{ $isOnline ? 'good' : 'danger' }}">{{ $isOnline ? 'Online' : 'Offline' }}</b>
                    </div>
                @empty
                    @include('partials.empty-state', ['message' => 'No agent health data yet.'])
                @endforelse
            </div>
        </div>

    </div>

</div>

<style>
    .agp-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .agp-heading {
        margin-bottom: 26px;
    }

    .agp-heading h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
        color: #0f172a !important;
    }

    .agp-heading p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .agp-error-banner {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-radius: 16px;
        background: #fee2e2 !important;
        border: 1px solid rgba(220, 38, 38, 0.25) !important;
        color: #dc2626 !important;
        font-size: 13px;
        font-weight: 800;
    }

    .agp-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .agp-summary-card {
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

    .agp-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(139, 92, 246, 0.12) !important;
    }

    /* All summary cards are the same size — see dashboard.blade.php for
       why the asymmetric featured-card span was dropped. */
    .agp-summary-card > * {
        position: relative;
        z-index: 2;
    }

    .agp-summary-icon {
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

    .agp-summary-icon svg {
        width: 24px;
        height: 24px;
    }

    .agp-summary-card.online .agp-summary-icon { color: #059669 !important; background: rgba(5, 150, 105, 0.12) !important; }
    .agp-summary-card.offline .agp-summary-icon { color: #dc2626 !important; background: rgba(220, 38, 38, 0.12) !important; }
    .agp-summary-card.total .agp-summary-icon { color: #8b5cf6 !important; background: rgba(139, 92, 246, 0.12) !important; }
    .agp-summary-card.health .agp-summary-icon { color: #2563eb !important; background: rgba(37, 99, 235, 0.12) !important; }

    .agp-summary-card span {
        color: var(--text-body) !important;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .agp-summary-card h2 {
        margin: 8px 0 2px;
        color: var(--text-heading) !important;
        font-size: 34px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .agp-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .agp-content-grid {
        display: grid;
        grid-template-columns: 1.65fr 0.9fr;
        gap: 24px;
        align-items: start;
    }

    .agp-panel {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        padding: 26px;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07) !important;
    }

    .agp-panel::before {
        content: "🖥️";
        position: absolute;
        right: 28px;
        top: 18px;
        font-size: 58px;
        opacity: 0.08;
        pointer-events: none;
    }

    .agp-health-panel::before {
        content: "🛡️";
    }

    .agp-panel-header {
        position: relative;
        z-index: 2;
        margin-bottom: 24px;
    }

    .agp-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 22px;
        font-weight: 950;
        letter-spacing: -0.4px;
    }

    .agp-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .agp-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .agp-agent-list {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 0;
    }

    .agp-agent-row {
        display: grid;
        grid-template-columns: 1.55fr 0.8fr 0.65fr 0.9fr 1.25fr;
        align-items: center;
        gap: 18px;
        min-height: 78px;
        padding: 18px 20px;
    }

    .agp-agent-name {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .agp-avatar {
        width: 46px;
        height: 46px;
        border-radius: 15px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff !important;
        font-size: 13px;
        font-weight: 950;
        box-shadow: 0 12px 26px rgba(168, 85, 247, 0.10);
    }

    .agp-avatar.green { color: #16a34a !important; }
    .agp-avatar.red { color: #dc2626 !important; }
    .agp-avatar.blue { color: #2563eb !important; }
    .agp-avatar.yellow { color: #d97706 !important; }

    .agp-agent-name strong,
    .agp-cell strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .agp-agent-name span,
    .agp-cell small,
    .agp-health-cell small {
        display: block;
        margin-bottom: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .agp-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 84px;
        padding: 9px 15px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .agp-status.online {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .agp-status.offline {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .agp-progress-row {
        display: grid;
        grid-template-columns: 45px 1fr;
        align-items: center;
        gap: 12px;
        margin-top: 6px;
    }

    .agp-progress-row span {
        color: #0f172a !important;
        font-size: 13px;
        font-weight: 950;
    }

    .agp-progress {
        height: 9px;
        border-radius: 999px;
        overflow: hidden;
        background: #e2e8f0 !important;
    }

    .agp-progress i {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #22c55e, #8b5cf6) !important;
    }

    .agp-progress.warning i {
        background: linear-gradient(90deg, #f59e0b, #ec4899) !important;
    }

    .agp-health-list {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 0;
    }

    .agp-health-card {
        min-height: 72px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .agp-health-card strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .agp-health-card span {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .agp-health-card b {
        min-width: 62px;
        padding: 10px 14px;
        border-radius: 999px;
        text-align: center;
        font-size: 13px;
        font-weight: 950;
    }

    .agp-health-card b.good {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .agp-health-card b.warning {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .agp-health-card b.danger {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    /* =============================== */
    /* DARK MODE AUTO SUPPORT */
    /* =============================== */

    body.dark-mode .agp-heading h1,
    body.dark .agp-heading h1,
    body.dark-theme .agp-heading h1,
    .agp-page.agp-dark .agp-heading h1 {
        color: #ffffff !important;
        text-shadow: 0 5px 18px rgba(15, 23, 42, 0.35);
    }

    body.dark-mode .agp-heading p,
    body.dark .agp-heading p,
    body.dark-theme .agp-heading p,
    .agp-page.agp-dark .agp-heading p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .agp-summary-card,
    body.dark .agp-summary-card,
    body.dark-theme .agp-summary-card,
    .agp-page.agp-dark .agp-summary-card {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.15), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.14), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .agp-panel,
    body.dark .agp-panel,
    body.dark-theme .agp-panel,
    .agp-page.agp-dark .agp-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .agp-summary-icon,
    body.dark .agp-summary-icon,
    body.dark-theme .agp-summary-icon,
    .agp-page.agp-dark .agp-summary-icon {
        background: rgba(15, 23, 42, 0.92) !important;
        border-color: rgba(168, 85, 247, 0.36) !important;
        color: #a855f7 !important;
    }

    body.dark-mode .agp-summary-card span,
    body.dark .agp-summary-card span,
    body.dark-theme .agp-summary-card span,
    body.dark-mode .agp-summary-card p,
    body.dark .agp-summary-card p,
    body.dark-theme .agp-summary-card p,
    body.dark-mode .agp-panel-header p,
    body.dark .agp-panel-header p,
    body.dark-theme .agp-panel-header p,
    .agp-page.agp-dark .agp-summary-card span,
    .agp-page.agp-dark .agp-summary-card p,
    .agp-page.agp-dark .agp-panel-header p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .agp-summary-card h2,
    body.dark .agp-summary-card h2,
    body.dark-theme .agp-summary-card h2,
    body.dark-mode .agp-panel-header h3,
    body.dark .agp-panel-header h3,
    body.dark-theme .agp-panel-header h3,
    .agp-page.agp-dark .agp-summary-card h2,
    .agp-page.agp-dark .agp-panel-header h3 {
        color: #ffffff !important;
    }

    body.dark-mode .agp-agent-row.green,
    body.dark .agp-agent-row.green,
    body.dark-theme .agp-agent-row.green,
    .agp-page.agp-dark .agp-agent-row.green {
        background: linear-gradient(135deg, #111827, #2e1a26) !important;
    }

    body.dark-mode .agp-agent-row.red,
    body.dark .agp-agent-row.red,
    body.dark-theme .agp-agent-row.red,
    .agp-page.agp-dark .agp-agent-row.red {
        background: linear-gradient(135deg, #111827, #25163d) !important;
    }

    body.dark-mode .agp-agent-row.blue,
    body.dark .agp-agent-row.blue,
    body.dark-theme .agp-agent-row.blue,
    .agp-page.agp-dark .agp-agent-row.blue {
        background: linear-gradient(135deg, #111827, #172554) !important;
    }

    body.dark-mode .agp-agent-row.yellow,
    body.dark .agp-agent-row.yellow,
    body.dark-theme .agp-agent-row.yellow,
    .agp-page.agp-dark .agp-agent-row.yellow {
        background: linear-gradient(135deg, #111827, #3b1a2c) !important;
    }

    body.dark-mode .agp-agent-row,
    body.dark .agp-agent-row,
    body.dark-theme .agp-agent-row,
    body.dark-mode .agp-health-card,
    body.dark .agp-health-card,
    body.dark-theme .agp-health-card,
    .agp-page.agp-dark .agp-agent-row,
    .agp-page.agp-dark .agp-health-card {
        border-color: rgba(168, 85, 247, 0.27) !important;
        color: #ffffff !important;
    }

    body.dark-mode .agp-health-card,
    body.dark .agp-health-card,
    body.dark-theme .agp-health-card,
    .agp-page.agp-dark .agp-health-card {
        background: linear-gradient(135deg, #111827, #241638) !important;
    }

    body.dark-mode .agp-agent-name strong,
    body.dark .agp-agent-name strong,
    body.dark-theme .agp-agent-name strong,
    body.dark-mode .agp-cell strong,
    body.dark .agp-cell strong,
    body.dark-theme .agp-cell strong,
    body.dark-mode .agp-health-card strong,
    body.dark .agp-health-card strong,
    body.dark-theme .agp-health-card strong,
    body.dark-mode .agp-progress-row span,
    body.dark .agp-progress-row span,
    body.dark-theme .agp-progress-row span,
    .agp-page.agp-dark .agp-agent-name strong,
    .agp-page.agp-dark .agp-cell strong,
    .agp-page.agp-dark .agp-health-card strong,
    .agp-page.agp-dark .agp-progress-row span {
        color: #ffffff !important;
    }

    body.dark-mode .agp-agent-name span,
    body.dark .agp-agent-name span,
    body.dark-theme .agp-agent-name span,
    body.dark-mode .agp-cell small,
    body.dark .agp-cell small,
    body.dark-theme .agp-cell small,
    body.dark-mode .agp-health-cell small,
    body.dark .agp-health-cell small,
    body.dark-theme .agp-health-cell small,
    body.dark-mode .agp-health-card span,
    body.dark .agp-health-card span,
    body.dark-theme .agp-health-card span,
    .agp-page.agp-dark .agp-agent-name span,
    .agp-page.agp-dark .agp-cell small,
    .agp-page.agp-dark .agp-health-cell small,
    .agp-page.agp-dark .agp-health-card span {
        color: #cbd5e1 !important;
    }

    body.dark-mode .agp-progress,
    body.dark .agp-progress,
    body.dark-theme .agp-progress,
    .agp-page.agp-dark .agp-progress {
        background: #334155 !important;
    }

    @media (max-width: 1200px) {
        .agp-summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .agp-content-grid {
            grid-template-columns: 1fr;
        }

        .agp-agent-row {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .agp-summary-grid,
        .agp-agent-row {
            grid-template-columns: 1fr;
        }
    }

    /* Redesign lock — keep the new light card system regardless of the
       light/dark content toggle. */
    .agp-summary-card.agp-summary-card,
    .agp-panel.agp-panel,
    body.dark-mode .agp-summary-card.agp-summary-card,
    body.dark .agp-summary-card.agp-summary-card,
    body.dark-theme .agp-summary-card.agp-summary-card,
    .agp-page.agp-dark .agp-summary-card.agp-summary-card,
    body.dark-mode .agp-panel.agp-panel,
    body.dark .agp-panel.agp-panel,
    body.dark-theme .agp-panel.agp-panel,
    .agp-page.agp-dark .agp-panel.agp-panel {
        background: var(--card-bg) !important;
        border-color: rgba(139, 92, 246, 0.10) !important;
    }

    body.dark-mode .agp-heading h1,
    body.dark .agp-heading h1,
    body.dark-theme .agp-heading h1,
    .agp-page.agp-dark .agp-heading h1,
    body.dark-mode .agp-summary-card h2,
    body.dark .agp-summary-card h2,
    body.dark-theme .agp-summary-card h2,
    .agp-page.agp-dark .agp-summary-card h2,
    body.dark-mode .agp-panel-header h3,
    body.dark .agp-panel-header h3,
    body.dark-theme .agp-panel-header h3,
    .agp-page.agp-dark .agp-panel-header h3 {
        color: var(--text-heading) !important;
        text-shadow: none !important;
    }

    body.dark-mode .agp-heading p,
    body.dark .agp-heading p,
    body.dark-theme .agp-heading p,
    .agp-page.agp-dark .agp-heading p,
    body.dark-mode .agp-summary-card span,
    body.dark .agp-summary-card span,
    body.dark-theme .agp-summary-card span,
    .agp-page.agp-dark .agp-summary-card span,
    body.dark-mode .agp-panel-header p,
    body.dark .agp-panel-header p,
    body.dark-theme .agp-panel-header p,
    .agp-page.agp-dark .agp-panel-header p {
        color: var(--text-body) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('agentMonitoringPage');

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

        function syncAgentTheme() {
            if (!page) return;

            if (isDarkTheme()) {
                page.classList.add('agp-dark');
            } else {
                page.classList.remove('agp-dark');
            }
        }

        syncAgentTheme();

        const observer = new MutationObserver(syncAgentTheme);

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
                setTimeout(syncAgentTheme, 50);
            });
        }

        window.addEventListener('storage', syncAgentTheme);
    });
</script>

@include('partials.auto-refresh')

@endsection