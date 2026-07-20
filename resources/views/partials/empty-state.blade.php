@php
    $message = $message ?? 'All clear! Nothing here yet.';
@endphp

<div class="lox-empty-state">
    <svg width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2 4 5v6c0 5 3.4 8.5 8 11 4.6-2.5 8-6 8-11V5l-8-3Z"/>
        <path d="m9 12 2 2 4-4"/>
    </svg>
    <p>{{ $message }}</p>
</div>

<style>
    .lox-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 40px 20px;
        text-align: center;
    }

    .lox-empty-state svg {
        color: var(--accent-purple, #8b5cf6);
        opacity: 0.35;
    }

    .lox-empty-state p {
        margin: 0;
        max-width: 280px;
        color: #9c94ad;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.6;
    }
</style>
