@extends('layouts.app-dashboard')

@php
    $blockedIps = $blockedIps ?? collect();
    $history = $history ?? collect();
    $alertOptions = $blockedIps->pluck('rule_description')->filter()->unique()->sort()->values();
    $categoryOptions = $blockedIps->pluck('category')->filter()->unique()->sort()->values();
    $totalBlockedNow = $blockedIps->where('status', 'Blocked')->count();
    $pendingNow = $history->where('status', 'pending')->count();
    $successToday = $history->where('status', 'success')->filter(fn ($h) => optional($h->executed_at)->isToday())->count();
@endphp

@section('content')

<div class="brp-page" id="blockedIpPage">

    <div class="brp-heading">
        <h1>Response Management</h1>
        <p>Manage suspicious IP addresses with filters, pending status, block and unblock actions.</p>
    </div>

    <!-- Filter -->
    <div class="brp-filter-panel bento-card">
        <div class="brp-filter-group">
            <label>Filter Date</label>
            <input type="date" id="filterDate" onchange="filterBlockedIp()">
        </div>

        <div class="brp-filter-group">
            <label>Filter Alert</label>
            <select id="filterAlert" class="xdr-filter-select" onchange="filterBlockedIp()">
                <option value="all">All Alerts</option>
                @foreach ($alertOptions as $alertName)
                    <option value="{{ $alertName }}">{{ $alertName }}</option>
                @endforeach
            </select>
        </div>

        <div class="brp-filter-group">
            <label>Filter Category</label>
            <select id="filterCategory" class="xdr-filter-select" onchange="filterBlockedIp()">
                <option value="all">All Categories</option>
                @foreach ($categoryOptions as $categoryName)
                    <option value="{{ $categoryName }}">{{ $categoryName }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" class="brp-reset-btn" onclick="resetBlockedFilter()">Reset Filter</button>
    </div>

    <!-- Summary -->
    <div class="brp-summary-grid">
        <div class="brp-summary-card bento-card featured danger">
            <div class="brp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM8.28 8.22a.75.75 0 0 0-1.06 1.06L10.94 13l-3.72 3.72a.75.75 0 1 0 1.06 1.06L12 14.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L13.06 13l3.72-3.72a.75.75 0 0 0-1.06-1.06L12 11.94 8.28 8.22Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Total Blocked IPs</span>
                <h2 id="totalBlockedCount">{{ $totalBlockedNow }}</h2>
                <p>Currently blocked sources</p>
            </div>
        </div>

        <div class="brp-summary-card bento-card amber">
            <div class="brp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .285.136.553.366.722l3.5 2.5a.75.75 0 0 0 .868-1.222L12.75 11.6V6Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Pending Actions</span>
                <h2 id="pendingCount">{{ $pendingNow }}</h2>
                <p>Waiting for confirmation</p>
            </div>
        </div>

        <div class="brp-summary-card bento-card success">
            <div class="brp-summary-icon"><svg viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg></div>
            <div>
                <span>Success Actions</span>
                <h2 id="successCount">{{ $successToday }}</h2>
                <p>Completed today</p>
            </div>
        </div>
    </div>

    <div class="brp-main-grid">

        <!-- IP Response List -->
        <div class="brp-panel bento-card">
            <div class="brp-panel-header">
                <h3>IP Response List</h3>
                <p>Suspicious IP addresses detected from security alerts.</p>
            </div>

            <div class="brp-list-header data-table-header">
                <span>Date</span>
                <span>IP Address</span>
                <span>Alert</span>
                <span>Category</span>
                <span>Status</span>
                <span>Action</span>
            </div>

            <div class="brp-ip-list xdr-scroll-list-target" id="ipList">

                @forelse ($blockedIps as $index => $entry)
                    @php
                        $isBlocked = $entry['status'] === 'Blocked';
                        $blockedAt = $entry['blocked_at'] ? \Illuminate\Support\Carbon::parse($entry['blocked_at']) : null;
                        $rowColor = ['purple', 'violet', 'red', 'blue'][$index % 4];
                    @endphp
                    <div class="brp-ip-row data-list-row {{ $rowColor }} animated-list-item" style="--i: {{ $index }}"
                        data-date="{{ $blockedAt?->format('Y-m-d') }}"
                        data-ip="{{ $entry['ip'] }}"
                        data-time="{{ $blockedAt?->format('H:i') }}"
                        data-alert="{{ $entry['rule_description'] }}"
                        data-category="{{ $entry['category'] }}"
                        data-status="{{ strtolower($entry['status']) }}"
                        data-source="{{ $entry['rule_description'] }}"
                        data-signature="{{ $entry['signature'] }}"
                        data-rule-id="{{ $entry['rule_id'] }}"
                        data-agent="{{ $entry['agent_name'] }}"
                    >
                        <div>
                            <small>Date</small>
                            <strong>{{ $blockedAt?->format('Y-m-d') ?? '-' }}</strong>
                            <em>{{ $blockedAt?->format('H:i') ?? '-' }}</em>
                        </div>

                        <div>
                            <small>IP Address</small>
                            <strong>{{ $entry['ip'] }}</strong>
                            <em>{{ $isBlocked ? 'Currently blocked' : 'Unblocked at ' . (\Illuminate\Support\Carbon::parse($entry['unblocked_at'])->format('Y-m-d H:i')) }}</em>
                        </div>

                        <div>
                            <small>Alert</small>
                            <strong>{{ $entry['rule_description'] ?? 'Unknown alert' }}</strong>
                        </div>

                        <div>
                            <small>Category</small>
                            <strong>{{ $entry['category'] }}</strong>
                        </div>

                        <div>
                            <span class="brp-status {{ strtolower($entry['status']) }}">{{ $entry['status'] }}</span>
                            @if ($entry['response_status'] ?? null)
                                <small class="brp-response-detail">
                                    {{ $entry['response_status'] }}
                                    @if ($entry['response_duration'] ?? null)
                                        · {{ $entry['response_duration'] }}
                                    @endif
                                </small>
                            @endif
                        </div>

                        <div>
                            <button type="button" class="brp-action-btn {{ $isBlocked ? 'unblock' : 'block' }}" onclick="handleIpAction(this)">{{ $isBlocked ? 'Unblock' : 'Block' }}</button>
                        </div>
                    </div>
                @empty
                    @include('partials.empty-state', ['message' => 'No IPs blocked yet — actions will appear here once Active Response runs.'])
                @endforelse

            </div>
        </div>

        <!-- Action Detail -->
        <div class="brp-panel brp-action-panel bento-card">
            <div class="brp-panel-header">
                <h3>Action Detail</h3>
                <p>Selected IP action process.</p>
            </div>

            <div class="brp-selected-card">
                <div class="brp-selected-hero">
                    <small>Selected IP</small>
                    <h2 id="selectedIp">-</h2>
                </div>

                <div class="brp-detail-box">
                    <small>Alert Type</small>
                    <strong id="selectedAlert">-</strong>
                </div>

                <div class="brp-detail-box">
                    <small>Category</small>
                    <strong id="selectedCategory">-</strong>
                </div>

                <div class="brp-detail-box">
                    <small>Current Process</small>
                    <strong id="selectedProcess">Waiting for action</strong>
                </div>
            </div>
        </div>

    </div>

    <!-- History -->
    <div class="brp-panel brp-history-panel bento-card">
        <div class="brp-panel-header">
            <h3>Response History</h3>
            <p>History of block, unblock, pending, and success actions.</p>
        </div>

        <div class="brp-history-list xdr-scroll-list-target" id="historyList">
            @forelse ($history as $index => $entry)
                <div class="brp-history-row data-list-row animated-list-item" style="--i: {{ $index }}">
                    <div>
                        <strong>{{ $entry->source_ip }} {{ $entry->action === 'block_ip' ? 'blocked' : 'unblocked' }}</strong>
                        <span>{{ $entry->rule_description ?? 'Manual action' }} • {{ optional($entry->executed_at)->format('Y-m-d H:i:s') }}</span>
                    </div>
                    <b>{{ ucfirst($entry->status) }}</b>
                </div>
            @empty
                @include('partials.empty-state', ['message' => 'No response actions recorded yet.'])
            @endforelse
        </div>
    </div>

</div>

<style>
    .brp-page {
        width: 100%;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .brp-heading {
        margin-bottom: 26px;
    }

    .brp-heading h1 {
        margin: 0;
        color: #0f172a !important;
        font-size: 32px;
        font-weight: 950;
        letter-spacing: -0.8px;
    }

    .brp-heading p {
        margin: 8px 0 0;
        color: #64748b !important;
        font-size: 15px;
        font-weight: 650;
    }

    .brp-filter-panel {
        position: relative;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 16px;
        align-items: end;
        margin-bottom: 24px;
        padding: 22px 24px;
        border-radius: 26px;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 12px 30px rgba(139, 92, 246, 0.06) !important;
    }

    .brp-filter-group {
        position: relative;
        z-index: 2;
    }

    .brp-filter-group label {
        display: block;
        margin-bottom: 8px;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 900;
    }

    .brp-filter-group input,
    .brp-filter-group select {
        width: 100%;
        height: 50px;
        padding: 0 16px;
        border-radius: 16px;
        border: 1px solid #E5DFF0 !important;
        background: rgba(255, 255, 255, 0.92) !important;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 800;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .brp-filter-group input:focus,
    .brp-filter-group select:focus {
        border-color: #8B5CF6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
    }

    .brp-reset-btn {
        position: relative;
        z-index: 2;
        height: 50px;
        padding: 0 22px;
        border: none;
        border-radius: 999px;
        cursor: pointer;
        color: #ffffff;
        font-size: 13px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%) !important;
        box-shadow: 0 14px 30px rgba(236, 72, 153, 0.26);
    }

    .brp-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 24px;
    }

    .brp-summary-card {
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

    .brp-summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(139, 92, 246, 0.12) !important;
    }

    .brp-summary-icon {
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

    .brp-summary-icon svg {
        width: 24px;
        height: 24px;
    }

    .brp-summary-card span {
        color: var(--text-body) !important;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .brp-summary-card h2 {
        margin: 8px 0 2px;
        color: var(--text-heading) !important;
        font-size: 34px;
        font-weight: 900;
        letter-spacing: -0.5px;
    }

    .brp-summary-card p {
        margin: 0;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 650;
    }

    .brp-main-grid {
        display: grid;
        grid-template-columns: 1.55fr 0.8fr;
        gap: 24px;
        align-items: start;
    }

    .brp-panel {
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        padding: 26px;
        background: var(--card-bg) !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 16px 40px rgba(139, 92, 246, 0.07) !important;
    }

    .brp-panel-header {
        position: relative;
        z-index: 2;
        margin-bottom: 24px;
    }

    .brp-panel-header h3 {
        margin: 0;
        color: #0f172a !important;
        font-size: 23px;
        font-weight: 950;
    }

    .brp-panel-header h3::after {
        content: "";
        display: block;
        width: 50px;
        height: 4px;
        margin-top: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, #8b5cf6, #ec4899);
    }

    .brp-panel-header p {
        margin: 10px 0 0;
        color: #64748b !important;
        font-size: 14px;
        font-weight: 650;
    }

    .brp-list-header {
        display: grid;
        grid-template-columns: 0.75fr 1.2fr 1.35fr 1.15fr 0.8fr 0.65fr;
        gap: 14px;
        padding: 0 16px 10px;
        color: #64748b !important;
        font-size: 13px;
        font-weight: 950;
    }

    .brp-ip-list {
        display: grid;
        gap: 0;
    }

    .brp-ip-row {
        display: grid;
        grid-template-columns: 0.75fr 1.2fr 1.35fr 1.15fr 0.8fr 0.65fr;
        align-items: center;
        gap: 14px;
        min-height: 78px;
        padding: 18px 16px;
    }

    .brp-ip-row small,
    .brp-detail-box small {
        display: block;
        margin-bottom: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 850;
    }

    .brp-ip-row strong,
    .brp-detail-box strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .brp-ip-row em {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-style: normal;
        font-size: 12px;
        font-weight: 700;
    }

    .brp-status {
        display: inline-flex;
        justify-content: center;
        min-width: 92px;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
    }

    .brp-status.blocked {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .brp-status.unblocked {
        background: #dcfce7 !important;
        color: #059669 !important;
    }

    .brp-status.pending {
        background: #fef3c7 !important;
        color: #d97706 !important;
    }

    .brp-response-detail {
        display: block;
        margin-top: 6px;
        text-align: center;
        color: #64748b !important;
        font-size: 11px;
        font-weight: 750;
    }

    .brp-action-btn {
        border: none;
        cursor: pointer;
        min-width: 88px;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 950;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.2s ease;
    }

    .brp-action-btn.unblock {
        background: #f3e8ff !important;
        color: #7c3aed !important;
    }

    .brp-action-btn.block {
        background: #fee2e2 !important;
        color: #dc2626 !important;
    }

    .brp-action-btn.pending {
        background: #fef3c7 !important;
        color: #d97706 !important;
        cursor: not-allowed;
    }

    .brp-action-btn:hover:not(.pending) {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #f9a8d4 0%, #ec4899 45%, #8b5cf6 100%) !important;
        color: #ffffff !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .brp-selected-card {
        position: relative;
        z-index: 2;
        display: grid;
        gap: 14px;
    }

    .brp-selected-hero {
        position: relative;
        overflow: hidden;
        padding: 24px;
        border-radius: 24px;
        color: #ffffff;
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.24), transparent 35%),
            linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
        box-shadow: 0 18px 42px rgba(217, 70, 239, 0.24);
    }

    .brp-selected-hero::after {
        content: "";
        position: absolute;
        width: 115px;
        height: 115px;
        right: -35px;
        bottom: -45px;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
    }

    .brp-selected-hero small {
        display: block;
        color: rgba(255,255,255,0.88) !important;
        font-size: 13px;
        font-weight: 900;
    }

    .brp-selected-hero h2 {
        margin: 10px 0 0;
        color: #ffffff !important;
        font-size: 28px;
        font-weight: 950;
    }

    .brp-detail-box {
        padding: 18px;
        border-radius: 18px;
        background: #FAF8FC !important;
        border: 1px solid rgba(139, 92, 246, 0.10) !important;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.05);
    }

    .brp-history-panel {
        margin-top: 24px;
    }

    .brp-history-list {
        display: grid;
        gap: 0;
        position: relative;
        z-index: 2;
    }

    .brp-history-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        padding: 18px 20px;
    }

    .brp-history-row strong {
        display: block;
        color: #0f172a !important;
        font-size: 14px;
        font-weight: 950;
    }

    .brp-history-row span {
        display: block;
        margin-top: 5px;
        color: #64748b !important;
        font-size: 12px;
        font-weight: 750;
    }

    .brp-history-row b {
        padding: 9px 14px;
        border-radius: 999px;
        background: #dcfce7 !important;
        color: #059669 !important;
        font-size: 12px;
        font-weight: 950;
    }

    /* =============================== */
    /* DARK MODE AUTO SUPPORT */
    /* =============================== */

    body.dark-mode .brp-heading h1,
    body.dark .brp-heading h1,
    body.dark-theme .brp-heading h1,
    .brp-page.brp-dark .brp-heading h1 {
        color: #ffffff !important;
        text-shadow: 0 5px 18px rgba(15, 23, 42, 0.35);
    }

    body.dark-mode .brp-heading p,
    body.dark .brp-heading p,
    body.dark-theme .brp-heading p,
    .brp-page.brp-dark .brp-heading p {
        color: #cbd5e1 !important;
    }

    body.dark-mode .brp-filter-panel,
    body.dark .brp-filter-panel,
    body.dark-theme .brp-filter-panel,
    body.dark-mode .brp-summary-card,
    body.dark .brp-summary-card,
    body.dark-theme .brp-summary-card,
    body.dark-mode .brp-panel,
    body.dark .brp-panel,
    body.dark-theme .brp-panel,
    .brp-page.brp-dark .brp-filter-panel,
    .brp-page.brp-dark .brp-summary-card,
    .brp-page.brp-dark .brp-panel {
        background:
            radial-gradient(circle at top right, rgba(217, 70, 239, 0.14), transparent 34%),
            radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.12), transparent 35%),
            linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
        border-color: rgba(168, 85, 247, 0.30) !important;
        box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
    }

    body.dark-mode .brp-filter-group input,
    body.dark .brp-filter-group input,
    body.dark-theme .brp-filter-group input,
    body.dark-mode .brp-filter-group select,
    body.dark .brp-filter-group select,
    body.dark-theme .brp-filter-group select,
    .brp-page.brp-dark .brp-filter-group input,
    .brp-page.brp-dark .brp-filter-group select {
        background: #111827 !important;
        border-color: #334155 !important;
        color: #ffffff !important;
    }

    body.dark-mode .brp-filter-group label,
    body.dark .brp-filter-group label,
    body.dark-theme .brp-filter-group label,
    body.dark-mode .brp-summary-card span,
    body.dark .brp-summary-card span,
    body.dark-theme .brp-summary-card span,
    body.dark-mode .brp-summary-card p,
    body.dark .brp-summary-card p,
    body.dark-theme .brp-summary-card p,
    body.dark-mode .brp-panel-header p,
    body.dark .brp-panel-header p,
    body.dark-theme .brp-panel-header p,
    body.dark-mode .brp-list-header,
    body.dark .brp-list-header,
    body.dark-theme .brp-list-header,
    .brp-page.brp-dark .brp-filter-group label,
    .brp-page.brp-dark .brp-summary-card span,
    .brp-page.brp-dark .brp-summary-card p,
    .brp-page.brp-dark .brp-panel-header p,
    .brp-page.brp-dark .brp-list-header {
        color: #cbd5e1 !important;
    }

    body.dark-mode .brp-summary-card h2,
    body.dark .brp-summary-card h2,
    body.dark-theme .brp-summary-card h2,
    body.dark-mode .brp-panel-header h3,
    body.dark .brp-panel-header h3,
    body.dark-theme .brp-panel-header h3,
    .brp-page.brp-dark .brp-summary-card h2,
    .brp-page.brp-dark .brp-panel-header h3 {
        color: #ffffff !important;
    }

    body.dark-mode .brp-ip-row.purple,
    body.dark .brp-ip-row.purple,
    body.dark-theme .brp-ip-row.purple,
    .brp-page.brp-dark .brp-ip-row.purple {
        background: linear-gradient(135deg, #111827, #2e1a26) !important;
    }

    body.dark-mode .brp-ip-row.violet,
    body.dark .brp-ip-row.violet,
    body.dark-theme .brp-ip-row.violet,
    .brp-page.brp-dark .brp-ip-row.violet {
        background: linear-gradient(135deg, #111827, #25163d) !important;
    }

    body.dark-mode .brp-ip-row.red,
    body.dark .brp-ip-row.red,
    body.dark-theme .brp-ip-row.red,
    .brp-page.brp-dark .brp-ip-row.red {
        background: linear-gradient(135deg, #111827, #3b1a2c) !important;
    }

    body.dark-mode .brp-ip-row.blue,
    body.dark .brp-ip-row.blue,
    body.dark-theme .brp-ip-row.blue,
    .brp-page.brp-dark .brp-ip-row.blue {
        background: linear-gradient(135deg, #111827, #172554) !important;
    }

    body.dark-mode .brp-ip-row,
    body.dark .brp-ip-row,
    body.dark-theme .brp-ip-row,
    body.dark-mode .brp-detail-box,
    body.dark .brp-detail-box,
    body.dark-theme .brp-detail-box,
    body.dark-mode .brp-history-row,
    body.dark .brp-history-row,
    body.dark-theme .brp-history-row,
    .brp-page.brp-dark .brp-ip-row,
    .brp-page.brp-dark .brp-detail-box,
    .brp-page.brp-dark .brp-history-row {
        border-color: rgba(168, 85, 247, 0.27) !important;
        color: #ffffff !important;
    }

    body.dark-mode .brp-detail-box,
    body.dark .brp-detail-box,
    body.dark-theme .brp-detail-box,
    body.dark-mode .brp-history-row,
    body.dark .brp-history-row,
    body.dark-theme .brp-history-row,
    .brp-page.brp-dark .brp-detail-box,
    .brp-page.brp-dark .brp-history-row {
        background: linear-gradient(135deg, #111827, #241638) !important;
    }

    body.dark-mode .brp-ip-row strong,
    body.dark .brp-ip-row strong,
    body.dark-theme .brp-ip-row strong,
    body.dark-mode .brp-detail-box strong,
    body.dark .brp-detail-box strong,
    body.dark-theme .brp-detail-box strong,
    body.dark-mode .brp-history-row strong,
    body.dark .brp-history-row strong,
    body.dark-theme .brp-history-row strong,
    .brp-page.brp-dark .brp-ip-row strong,
    .brp-page.brp-dark .brp-detail-box strong,
    .brp-page.brp-dark .brp-history-row strong {
        color: #ffffff !important;
    }

    body.dark-mode .brp-ip-row small,
    body.dark .brp-ip-row small,
    body.dark-theme .brp-ip-row small,
    body.dark-mode .brp-ip-row em,
    body.dark .brp-ip-row em,
    body.dark-theme .brp-ip-row em,
    body.dark-mode .brp-detail-box small,
    body.dark .brp-detail-box small,
    body.dark-theme .brp-detail-box small,
    body.dark-mode .brp-history-row span,
    body.dark .brp-history-row span,
    body.dark-theme .brp-history-row span,
    .brp-page.brp-dark .brp-ip-row small,
    .brp-page.brp-dark .brp-ip-row em,
    .brp-page.brp-dark .brp-detail-box small,
    .brp-page.brp-dark .brp-history-row span {
        color: #cbd5e1 !important;
    }

    @media (max-width: 1300px) {
        .brp-main-grid {
            grid-template-columns: 1fr;
        }

        .brp-list-header,
        .brp-ip-row {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media (max-width: 900px) {
        .brp-filter-panel,
        .brp-summary-grid,
        .brp-list-header,
        .brp-ip-row {
            grid-template-columns: 1fr;
        }

        .brp-list-header {
            display: none;
        }
    }

    /* ================================================= */
/* FIX Action Detail supaya ikut dark mode penuh */
/* Paste paling bawah style response-management.blade.php */
/* ================================================= */

body.dark-mode .brp-selected-card,
body.dark .brp-selected-card,
body.dark-theme .brp-selected-card,
.brp-page.brp-dark .brp-selected-card {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
}

/* Hilangkan kotak putih yang membungkus Action Detail */
body.dark-mode .brp-action-panel .brp-selected-card,
body.dark .brp-action-panel .brp-selected-card,
body.dark-theme .brp-action-panel .brp-selected-card,
.brp-page.brp-dark .brp-action-panel .brp-selected-card {
    background: transparent !important;
}

/* Selected IP tetap gradient, tapi tanpa background putih luar */
body.dark-mode .brp-selected-hero,
body.dark .brp-selected-hero,
body.dark-theme .brp-selected-hero,
.brp-page.brp-dark .brp-selected-hero {
    background:
        radial-gradient(circle at top right, rgba(255,255,255,0.22), transparent 35%),
        linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899) !important;
    border: 1px solid rgba(255, 255, 255, 0.14) !important;
    color: #ffffff !important;
}

/* Detail box dark */
body.dark-mode .brp-detail-box,
body.dark .brp-detail-box,
body.dark-theme .brp-detail-box,
.brp-page.brp-dark .brp-detail-box {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        linear-gradient(135deg, #111827, #241638) !important;
    border: 1px solid rgba(168, 85, 247, 0.28) !important;
    box-shadow: 0 12px 26px rgba(0, 0, 0, 0.18) !important;
    color: #ffffff !important;
}

/* Text detail */
body.dark-mode .brp-detail-box small,
body.dark .brp-detail-box small,
body.dark-theme .brp-detail-box small,
.brp-page.brp-dark .brp-detail-box small {
    color: #cbd5e1 !important;
}

body.dark-mode .brp-detail-box strong,
body.dark .brp-detail-box strong,
body.dark-theme .brp-detail-box strong,
.brp-page.brp-dark .brp-detail-box strong {
    color: #ffffff !important;
}

/* Paksa semua div dalam action detail tidak punya background putih */
body.dark-mode .brp-action-panel div,
body.dark .brp-action-panel div,
body.dark-theme .brp-action-panel div,
.brp-page.brp-dark .brp-action-panel div {
    border-color: rgba(168, 85, 247, 0.28) !important;
}

/* Kalau ada style lama yang kasih background putih */
body.dark-mode .brp-action-panel .selected-detail,
body.dark .brp-action-panel .selected-detail,
body.dark-theme .brp-action-panel .selected-detail,
body.dark-mode .brp-action-panel .selected-card,
body.dark .brp-action-panel .selected-card,
body.dark-theme .brp-action-panel .selected-card {
    background: transparent !important;
    border: none !important;
}

/* Redesign lock — keep the new light card system regardless of the
   light/dark content toggle. */
.brp-summary-card.brp-summary-card,
.brp-panel.brp-panel,
.brp-filter-panel.brp-filter-panel,
.brp-ip-row.brp-ip-row,
.brp-history-row.brp-history-row,
body.dark-mode .brp-summary-card.brp-summary-card,
body.dark .brp-summary-card.brp-summary-card,
body.dark-theme .brp-summary-card.brp-summary-card,
.brp-page.brp-dark .brp-summary-card.brp-summary-card,
body.dark-mode .brp-panel.brp-panel,
body.dark .brp-panel.brp-panel,
body.dark-theme .brp-panel.brp-panel,
.brp-page.brp-dark .brp-panel.brp-panel,
body.dark-mode .brp-filter-panel.brp-filter-panel,
body.dark .brp-filter-panel.brp-filter-panel,
body.dark-theme .brp-filter-panel.brp-filter-panel,
.brp-page.brp-dark .brp-filter-panel.brp-filter-panel,
body.dark-mode .brp-ip-row.brp-ip-row,
body.dark .brp-ip-row.brp-ip-row,
body.dark-theme .brp-ip-row.brp-ip-row,
.brp-page.brp-dark .brp-ip-row.brp-ip-row,
body.dark-mode .brp-history-row.brp-history-row,
body.dark .brp-history-row.brp-history-row,
body.dark-theme .brp-history-row.brp-history-row,
.brp-page.brp-dark .brp-history-row.brp-history-row {
    background: var(--card-bg) !important;
    border-color: rgba(139, 92, 246, 0.10) !important;
}

/* Summary cards lebih hidup — tinted per status, same recipe as the
   Incident Management + Dashboard stat cards instead of a plain white
   card with only a purple icon. */
.brp-summary-card.danger.brp-summary-card {
    background: linear-gradient(135deg, #ffffff, #fef2f2) !important;
}

.brp-summary-card.amber.brp-summary-card {
    background: linear-gradient(135deg, #ffffff, #fff7ed) !important;
}

.brp-summary-card.success.brp-summary-card {
    background: linear-gradient(135deg, #ffffff, #f0fdf4) !important;
}

.brp-summary-card::before {
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

.brp-summary-card.danger::before { background: rgba(239, 68, 68, 0.10); }
.brp-summary-card.amber::before { background: rgba(217, 119, 6, 0.10); }
.brp-summary-card.success::before { background: rgba(5, 150, 105, 0.10); }

.brp-summary-card > * {
    position: relative;
    z-index: 1;
}

.brp-summary-card.danger .brp-summary-icon {
    background: rgba(239, 68, 68, 0.12) !important;
    color: #dc2626 !important;
}

.brp-summary-card.amber .brp-summary-icon {
    background: rgba(217, 119, 6, 0.12) !important;
    color: #d97706 !important;
}

.brp-summary-card.success .brp-summary-icon {
    background: rgba(5, 150, 105, 0.12) !important;
    color: #059669 !important;
}

body.dark-mode .brp-heading h1,
body.dark .brp-heading h1,
body.dark-theme .brp-heading h1,
.brp-page.brp-dark .brp-heading h1,
body.dark-mode .brp-summary-card h2,
body.dark .brp-summary-card h2,
body.dark-theme .brp-summary-card h2,
.brp-page.brp-dark .brp-summary-card h2,
body.dark-mode .brp-panel-header h3,
body.dark .brp-panel-header h3,
body.dark-theme .brp-panel-header h3,
.brp-page.brp-dark .brp-panel-header h3,
body.dark-mode .brp-ip-row strong,
body.dark .brp-ip-row strong,
body.dark-theme .brp-ip-row strong,
.brp-page.brp-dark .brp-ip-row strong,
body.dark-mode .brp-history-row strong,
body.dark .brp-history-row strong,
body.dark-theme .brp-history-row strong,
.brp-page.brp-dark .brp-history-row strong {
    color: var(--text-heading) !important;
    text-shadow: none !important;
}

body.dark-mode .brp-heading p,
body.dark .brp-heading p,
body.dark-theme .brp-heading p,
.brp-page.brp-dark .brp-heading p,
body.dark-mode .brp-summary-card span,
body.dark .brp-summary-card span,
body.dark-theme .brp-summary-card span,
.brp-page.brp-dark .brp-summary-card span,
body.dark-mode .brp-panel-header p,
body.dark .brp-panel-header p,
body.dark-theme .brp-panel-header p,
.brp-page.brp-dark .brp-panel-header p,
body.dark-mode .brp-list-header,
body.dark .brp-list-header,
body.dark-theme .brp-list-header,
.brp-page.brp-dark .brp-list-header,
body.dark-mode .brp-ip-row small,
body.dark .brp-ip-row small,
body.dark-theme .brp-ip-row small,
.brp-page.brp-dark .brp-ip-row small,
body.dark-mode .brp-ip-row em,
body.dark .brp-ip-row em,
body.dark-theme .brp-ip-row em,
.brp-page.brp-dark .brp-ip-row em,
body.dark-mode .brp-history-row span,
body.dark .brp-history-row span,
body.dark-theme .brp-history-row span,
.brp-page.brp-dark .brp-history-row span,
body.dark-mode .brp-filter-group label,
body.dark .brp-filter-group label,
body.dark-theme .brp-filter-group label,
.brp-page.brp-dark .brp-filter-group label {
    color: var(--text-body) !important;
}

body.dark-mode .brp-filter-group input,
body.dark .brp-filter-group input,
body.dark-theme .brp-filter-group input,
body.dark-mode .brp-filter-group select,
body.dark .brp-filter-group select,
body.dark-theme .brp-filter-group select,
.brp-page.brp-dark .brp-filter-group input,
.brp-page.brp-dark .brp-filter-group select {
    background: #FAF8FC !important;
    border-color: rgba(139, 92, 246, 0.18) !important;
    color: var(--text-heading) !important;
}
</style>

<script>
    function filterBlockedIp() {
        const date = document.getElementById('filterDate').value;
        const alert = document.getElementById('filterAlert').value;
        const category = document.getElementById('filterCategory').value;

        const rows = document.querySelectorAll('.brp-ip-row');

        rows.forEach(row => {
            const matchDate = !date || row.dataset.date === date;
            const matchAlert = alert === 'all' || row.dataset.alert === alert;
            const matchCategory = category === 'all' || row.dataset.category === category;

            row.style.display = matchDate && matchAlert && matchCategory ? '' : 'none';
        });
    }

    function resetBlockedFilter() {
        document.getElementById('filterDate').value = '';
        document.getElementById('filterAlert').value = 'all';
        document.getElementById('filterCategory').value = 'all';

        filterBlockedIp();
    }

    function updateSummaryCounts() {
        const rows = document.querySelectorAll('.brp-ip-row');

        let blocked = 0;
        let pending = 0;

        rows.forEach(row => {
            if (row.dataset.status === 'blocked') blocked++;
            if (row.dataset.status === 'pending') pending++;
        });

        document.getElementById('totalBlockedCount').innerText = blocked;
        document.getElementById('pendingCount').innerText = pending;
    }

    function setActionDetail(row, processText) {
        document.getElementById('selectedIp').innerText = row.dataset.ip;
        document.getElementById('selectedAlert').innerText = row.dataset.alert;
        document.getElementById('selectedCategory').innerText = row.dataset.category;
        document.getElementById('selectedProcess').innerText = processText;
    }

    function addHistory(ip, alert, action, status) {
        const historyList = document.getElementById('historyList');

        const now = new Date();
        const pad = (n) => String(n).padStart(2, '0');
        const timeLabel = pad(now.getHours()) + ':' + pad(now.getMinutes()) + ':' + pad(now.getSeconds());

        const item = document.createElement('div');
        item.className = 'brp-history-row';
        item.innerHTML = `
            <div>
                <strong>${ip} ${action}</strong>
                <span>${alert} • ${timeLabel}</span>
            </div>
            <b>${status}</b>
        `;

        historyList.prepend(item);
    }

    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    function handleIpAction(button) {
        const row = button.closest('.brp-ip-row');
        const statusBadge = row.querySelector('.brp-status');

        const currentStatus = row.dataset.status;
        const nextAction = currentStatus === 'blocked' ? 'unblock' : 'block';
        const routeUrl = nextAction === 'unblock'
            ? '{{ route('response.unblock') }}'
            : '{{ route('response.block') }}';

        row.dataset.status = 'pending';
        statusBadge.className = 'brp-status pending';
        statusBadge.innerText = 'Pending';

        button.className = 'brp-action-btn pending';
        button.innerText = 'Pending';
        button.disabled = true;

        setActionDetail(row, `${nextAction.charAt(0).toUpperCase() + nextAction.slice(1)} pending`);

        fetch(routeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                signature: row.dataset.signature,
                rule_id: row.dataset.ruleId,
                rule: row.dataset.alert,
                agent: row.dataset.agent,
                source: row.dataset.ip,
            }),
        })
            .then(response => response.json())
            .then(data => {
                const succeeded = data.status === 'success';

                if (nextAction === 'unblock') {
                    row.dataset.status = succeeded ? 'unblocked' : 'blocked';
                    statusBadge.className = succeeded ? 'brp-status unblocked' : 'brp-status blocked';
                    statusBadge.innerText = succeeded ? 'Unblocked' : 'Blocked';

                    button.className = succeeded ? 'brp-action-btn block' : 'brp-action-btn unblock';
                    button.innerText = succeeded ? 'Block' : 'Unblock';
                } else {
                    row.dataset.status = succeeded ? 'blocked' : 'unblocked';
                    statusBadge.className = succeeded ? 'brp-status blocked' : 'brp-status unblocked';
                    statusBadge.innerText = succeeded ? 'Blocked' : 'Unblocked';

                    button.className = succeeded ? 'brp-action-btn unblock' : 'brp-action-btn block';
                    button.innerText = succeeded ? 'Unblock' : 'Block';
                }

                button.disabled = false;
                setActionDetail(row, data.note || (succeeded ? `${nextAction} success` : `${nextAction} failed`));
                addHistory(row.dataset.ip, row.dataset.alert, succeeded ? `${nextAction}ed` : `${nextAction} failed`, succeeded ? 'Success' : 'Failed');

                if (succeeded) {
                    const successCount = document.getElementById('successCount');
                    successCount.innerText = Number(successCount.innerText) + 1;
                }

                updateSummaryCounts();
            })
            .catch(() => {
                row.dataset.status = currentStatus;
                statusBadge.className = `brp-status ${currentStatus}`;
                statusBadge.innerText = currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1);
                button.className = currentStatus === 'blocked' ? 'brp-action-btn unblock' : 'brp-action-btn block';
                button.innerText = currentStatus === 'blocked' ? 'Unblock' : 'Block';
                button.disabled = false;
                setActionDetail(row, 'Request failed — please try again.');
                updateSummaryCounts();
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const page = document.getElementById('blockedIpPage');

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

        function syncBlockedTheme() {
            if (!page) return;

            if (isDarkTheme()) {
                page.classList.add('brp-dark');
            } else {
                page.classList.remove('brp-dark');
            }
        }

        syncBlockedTheme();
        updateSummaryCounts();

        const observer = new MutationObserver(syncBlockedTheme);

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
                setTimeout(syncBlockedTheme, 50);
            });
        }

        window.addEventListener('storage', syncBlockedTheme);
    });
</script>

@include('partials.auto-refresh')

@endsection