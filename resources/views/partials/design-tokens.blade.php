<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-main: #F2F4F7;
        --card-bg: #FFFFFF;
        --sidebar-bg: #2D1B3D;
        --sidebar-bg-soft: #3B1F4D;
        --sidebar-text: #E8DEF0;
        --accent-purple: #8b5cf6;
        --accent-pink: #d946ef;
        --accent-magenta: #ec4899;
        --text-heading: #1e1b2e;
        --text-body: #6b6280;
        --font-main: 'Inter', -apple-system, 'Segoe UI', sans-serif;
        --font-mono: 'JetBrains Mono', 'Consolas', monospace;
        --radius-card: 10px;
        --radius-sm: 6px;
        --radius-md: 8px;
    }


    body {
        font-family: var(--font-main);
    }

    /* ==========================================================================
       CUSTOM SLEEK PURPLE SCROLLBAR SYSTEM (GLOBAL & PANELS)
       ========================================================================== */
    * {
        scrollbar-width: thin;
        scrollbar-color: #a855f7 rgba(15, 23, 42, 0.06);
    }

    ::-webkit-scrollbar {
        width: 8px !important;
        height: 8px !important;
    }

    ::-webkit-scrollbar-track {
        background: rgba(15, 23, 42, 0.04) !important;
        border-radius: 10px !important;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #8b5cf6, #a855f7) !important;
        border-radius: 10px !important;
        border: 2px solid transparent !important;
        background-clip: padding-box !important;
        transition: all 0.2s ease !important;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #7c3aed, #9333ea) !important;
        box-shadow: 0 0 10px rgba(168, 85, 247, 0.5) !important;
    }

    ::-webkit-scrollbar-corner {
        background: transparent !important;
    }

    ::-webkit-scrollbar-button {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
    }

    body.dark-mode,
    body.dark,
    body.dark-theme {
        scrollbar-color: #a855f7 rgba(255, 255, 255, 0.05);
    }

    body.dark-mode ::-webkit-scrollbar-track,
    body.dark ::-webkit-scrollbar-track,
    body.dark-theme ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03) !important;
    }

    body.dark-mode ::-webkit-scrollbar-thumb,
    body.dark ::-webkit-scrollbar-thumb,
    body.dark-theme ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #9333ea, #c084fc) !important;
    }

    /* Magic Bento — cursor-follow spotlight glow, paired with the mousemove
       listener in layouts/app-dashboard.blade.php that sets --mx/--my.
       Entrance animation used to be a page-load CSS keyframe here, but
       that plays on a wall-clock timer from page load — a card below the
       fold had already finished animating by the time you scrolled to it,
       so it just appeared static. Entrance is now driven by the
       .reveal-on-scroll / .in-view system (see partials/scroll-reveal.blade.php),
       auto-applied to every .bento-card by that script. */
    .bento-card {
        position: relative;
        overflow: hidden;
    }

    .bento-card::after {
        display: none !important;
    }

    .bento-card > * {
        position: relative;
        z-index: 1;
    }

    /* ============================================= */
    /* ANIMATED GROUP — scale + blur + slide entrance */
    /* Keyframes-based so it ALWAYS triggers on load  */
    /* ============================================= */

    @keyframes animGroupScale {
        0% {
            opacity: 0;
            transform: translateY(35px) scale(0.88);
            filter: blur(8px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    }

    @keyframes animGroupPanel {
        0% {
            opacity: 0;
            transform: translateY(45px);
            filter: blur(6px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
            filter: blur(0);
        }
    }

    @keyframes animGroupHeading {
        0% {
            opacity: 0;
            transform: translateX(-25px);
            filter: blur(4px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
            filter: blur(0);
        }
    }

    @keyframes animGroupListItem {
        0% {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
            filter: blur(4px);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
            filter: blur(0);
        }
    }

    /* Initial hidden state */
    .reveal-on-scroll,
    .reveal-panel,
    .reveal-heading,
    .animated-list-item {
        opacity: 0;
    }

    /* Active entrance animations */
    .reveal-on-scroll.in-view {
        animation: animGroupScale 0.65s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: var(--reveal-delay, 0s);
    }

    .reveal-panel.in-view {
        animation: animGroupPanel 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: var(--reveal-delay, 0.12s);
    }

    .reveal-heading.in-view {
        animation: animGroupHeading 0.55s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: 0.05s;
    }

    .animated-list-item.in-view {
        animation: animGroupListItem 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        animation-delay: calc(var(--i, 0) * 0.06s + 0.1s);
    }

    /* Bottom scroll-fade */
    .scroll-fade-bottom {
        position: fixed;
        left: 86px;
        right: 0;
        bottom: 0;
        height: 52px;
        z-index: 40;
        pointer-events: none;
        background: linear-gradient(to bottom, transparent, #ffffff 85%);
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .scroll-fade-bottom.is-visible {
        opacity: 1;
    }

    @media (prefers-reduced-motion: reduce) {
        .animated-list-item,
        .reveal-on-scroll,
        .reveal-panel,
        .reveal-heading {
            opacity: 1;
            transform: none;
            filter: none;
            transition: none;
        }

        .bento-card::after {
            display: none;
        }

        .scroll-fade-bottom {
            transition: none;
        }
    }

    /* xdr-combo — vanilla-CSS/JS port of the HeroUI ComboBox, dropped in as
       a progressive-enhancement layer over existing <select> filters (see
       the enhancer script in layouts/app-dashboard.blade.php). The native
       select stays in the DOM untouched — same id/class/onchange/data
       attributes, same options — so every existing filter function keeps
       working; only the visual chrome changes. Popover renders as a
       fixed-position body-level layer so it never gets clipped by an
       ancestor panel's overflow:hidden. */
    .xdr-combo-native-hidden {
        display: none !important;
    }

    .xdr-combo {
        position: relative;
        width: 100%;
    }

    .xdr-combo-trigger {
        width: 100%;
        height: 44px;
        padding: 0 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        border-radius: 12px;
        border: 1px solid #E5DFF0;
        background: #ffffff;
        color: var(--text-heading);
        font-family: var(--font-main);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        text-align: left;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .xdr-combo-trigger:hover {
        border-color: #8B5CF6;
    }

    .xdr-combo-trigger.is-open {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .xdr-combo-trigger-label {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .xdr-combo-chevron {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        color: #94a3b8;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .xdr-combo-trigger.is-open .xdr-combo-chevron {
        transform: rotate(180deg);
        color: var(--accent-purple);
    }

    .xdr-combo-popover {
        /* display:none by default and only switched to flex via the
           .is-visible class (not the `hidden` attribute) — `[hidden]` and
           a plain `.xdr-combo-popover { display:flex }` rule have the exact
           same specificity, and since author CSS loads after the
           UA stylesheet it used to win, making `popover.hidden = true`
           visually inert (popovers stayed on screen forever). */
        position: fixed;
        z-index: 3000;
        min-width: 200px;
        max-width: 320px;
        max-height: 280px;
        display: none;
        flex-direction: column;
        overflow: hidden;
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid rgba(139, 92, 246, 0.16);
        box-shadow: 0 20px 46px rgba(88, 28, 135, 0.18), 0 4px 14px rgba(88, 28, 135, 0.10);
    }

    .xdr-combo-popover.is-visible {
        display: flex;
        animation: xdrComboIn 0.16s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .xdr-combo-popover.xdr-combo-popover--up {
        animation: xdrComboInUp 0.16s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes xdrComboIn {
        from { opacity: 0; transform: translateY(-6px) scale(0.97); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    @keyframes xdrComboInUp {
        from { opacity: 0; transform: translateY(6px) scale(0.97); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .xdr-combo-search-wrap {
        flex-shrink: 0;
        padding: 8px 8px 6px;
        border-bottom: 1px solid rgba(139, 92, 246, 0.10);
    }

    .xdr-combo-search {
        width: 100%;
        height: 34px;
        padding: 0 10px;
        border-radius: 10px;
        border: 1px solid #E5DFF0;
        background: #FAF8FC;
        font-family: var(--font-main);
        font-size: 12px;
        font-weight: 700;
        color: var(--text-heading);
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .xdr-combo-search:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .xdr-combo-list {
        overflow-y: auto;
        padding: 6px;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .xdr-combo-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        width: 100%;
        padding: 9px 10px;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: var(--text-heading);
        font-family: var(--font-main);
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }

    /* Same [hidden]-vs-class specificity fix as the popover itself, for the
       search-filtered items inside it. */
    .xdr-combo-item[hidden] {
        display: none;
    }

    .xdr-combo-item:hover {
        background: #F3E8FF;
    }

    .xdr-combo-item.is-selected {
        background: #FAF5FF;
        color: var(--accent-purple);
    }

    .xdr-combo-check {
        width: 13px;
        height: 13px;
        opacity: 0;
        color: var(--accent-purple);
        flex-shrink: 0;
    }

    .xdr-combo-item.is-selected .xdr-combo-check {
        opacity: 1;
    }

    @media (prefers-reduced-motion: reduce) {
        .xdr-combo-popover,
        .xdr-combo-popover.xdr-combo-popover--up {
            animation: none;
        }
    }

    /* xdr-date — progressive-enhancement layer that turns any
       <input type="date"> into a vanilla port of the shadcn/react-day-picker
       Calendar (rounded day cells, ghost nav chevrons, today dot, purple
       selected-day highlight). The native input stays in the DOM untouched
       (same id/onchange/value format) so every existing filter function
       keeps working unmodified — only the visual chrome changes. */
    .xdr-date {
        position: relative;
        width: 100%;
    }

    .xdr-date-trigger {
        width: 100%;
        height: 44px;
        padding: 0 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        border-radius: 12px;
        border: 1px solid #E5DFF0;
        background: #ffffff;
        color: #94a3b8;
        font-family: var(--font-main);
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        text-align: left;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .xdr-date-trigger.has-value {
        color: var(--text-heading);
    }

    .xdr-date-trigger:hover {
        border-color: #8B5CF6;
    }

    .xdr-date-trigger.is-open {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .xdr-date-trigger-icon {
        flex-shrink: 0;
        color: var(--accent-purple);
    }

    .xdr-date-trigger-label {
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .xdr-date-clear {
        flex-shrink: 0;
        width: 16px;
        height: 16px;
        display: none;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        border-radius: 50%;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .xdr-date-trigger.has-value .xdr-date-clear {
        display: flex;
    }

    .xdr-date-clear:hover {
        background: #F3E8FF;
        color: var(--accent-purple);
    }

    .xdr-date-popover {
        position: fixed;
        z-index: 3000;
        width: 272px;
        padding: 12px;
        display: none;
        flex-direction: column;
        border-radius: 20px;
        background: #ffffff;
        border: 1px solid rgba(139, 92, 246, 0.16);
        box-shadow: 0 20px 46px rgba(88, 28, 135, 0.18), 0 4px 14px rgba(88, 28, 135, 0.10);
    }

    .xdr-date-popover.is-visible {
        display: flex;
        animation: xdrComboIn 0.16s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .xdr-date-popover.xdr-date-popover--up {
        animation: xdrComboInUp 0.16s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .xdr-date-nav {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 32px;
        margin-bottom: 6px;
    }

    .xdr-date-caption {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-heading);
    }

    .xdr-date-nav-btn {
        position: absolute;
        top: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .xdr-date-nav-btn:hover {
        background: #F3E8FF;
        color: var(--accent-purple);
    }

    .xdr-date-nav-btn[data-nav="prev"] {
        left: 0;
    }

    .xdr-date-nav-btn[data-nav="next"] {
        right: 0;
    }

    .xdr-date-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        margin-bottom: 2px;
    }

    .xdr-date-weekdays span {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
    }

    .xdr-date-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
    }

    .xdr-date-cell {
        position: relative;
        height: 32px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: var(--text-heading);
        font-family: var(--font-main);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.15s ease, color 0.15s ease;
    }

    .xdr-date-cell:hover {
        background: #F3E8FF;
    }

    .xdr-date-cell.outside {
        color: #cbd5e1;
    }

    .xdr-date-cell.today::after {
        content: "";
        position: absolute;
        bottom: 4px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: var(--accent-purple);
    }

    .xdr-date-cell.selected {
        background: var(--accent-purple) !important;
        color: #ffffff !important;
    }

    .xdr-date-cell.selected.today::after {
        background: #ffffff;
    }

    .xdr-date-today-btn {
        margin-top: 8px;
        height: 34px;
        border: 1px solid rgba(139, 92, 246, 0.16);
        border-radius: 10px;
        background: #FAF8FC;
        color: var(--accent-purple);
        font-family: var(--font-main);
        font-size: 12px;
        font-weight: 800;
        cursor: pointer;
        transition: background-color 0.15s ease;
    }

    .xdr-date-today-btn:hover {
        background: #F3E8FF;
    }

    @media (prefers-reduced-motion: reduce) {
        .xdr-date-popover,
        .xdr-date-popover.xdr-date-popover--up {
            animation: none;
        }
    }

    /* xdr-scroll-list — vanilla port of the React Bits AnimatedList's
       scroll behaviour: caps a long row list to ~5 visible rows with an
       internal scrollbar, plus top/bottom fade gradients tracking scroll
       position. Applied by the enhancer script in
       layouts/app-dashboard.blade.php to any .xdr-scroll-list-target
       container that ends up with more than 5 rows — containers with
       fewer rows are left completely untouched. */
    .xdr-scroll-list {
        position: relative;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(139, 92, 246, 0.35) transparent;
    }

    .xdr-scroll-list::-webkit-scrollbar {
        width: 7px;
    }

    .xdr-scroll-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .xdr-scroll-list::-webkit-scrollbar-thumb {
        background: rgba(139, 92, 246, 0.35);
        border-radius: 999px;
    }

    .xdr-scroll-list::-webkit-scrollbar-thumb:hover {
        background: rgba(139, 92, 246, 0.55);
    }

    .xdr-scroll-gradient {
        position: absolute;
        left: 0;
        right: 0;
        height: 42px;
        pointer-events: none;
        z-index: 2;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .xdr-scroll-gradient--top {
        top: 0;
        background: linear-gradient(to bottom, var(--card-bg), transparent);
    }

    .xdr-scroll-gradient--bottom {
        bottom: 0;
        background: linear-gradient(to top, var(--card-bg), transparent);
    }

    /* data-table-header / data-list-row — shared header + zebra-row recipe
       used by every list across the app (Alert History, Detected Threat
       List, Incident List, IP Response List, Response History, Daily
       Security Activity), so the look lives in one place instead of being
       hand-rolled per page. Added ALONGSIDE each list's own layout class
       (grid-template-columns etc. stay page-specific) — this only owns
       background/border/text. Rows sit flush (no gap, no per-row radius/
       shadow) so the zebra stripe reads as one continuous table instead of
       a stack of separately-shadowed cards — the gap/radius/shadow removal
       is done per-page since it lives in each list's own layout rule. */
    .data-table-header {
        background: #F0EAFA !important;
        border-bottom: 1px solid #E5DFF0 !important;
        padding-top: 14px !important;
        padding-bottom: 14px !important;
    }

    .data-table-header span {
        color: #5B3E7A !important;
        text-transform: uppercase !important;
        font-weight: 600 !important;
        font-size: 12px !important;
        letter-spacing: 0.04em !important;
    }

    .data-list-row.data-list-row.data-list-row {
        border-radius: 0 !important;
        box-shadow: none !important;
        border: none !important;
        border-bottom: 1px solid #EFE9F7 !important;
        background: #ffffff !important;
        transition: background 0.2s ease !important;
    }

    .data-list-row.data-list-row.data-list-row:last-of-type {
        border-bottom: none !important;
    }

    .data-list-row.data-list-row.data-list-row:nth-of-type(even) {
        background: #FBF8FD !important;
    }

    .data-list-row.data-list-row.data-list-row:hover {
        background: #F5EFFB !important;
        transform: none !important;
    }

    /* Urgent override — Critical/Offline/Disconnected rows win over the
       zebra pattern instead of alternating normally. */
    .data-list-row.data-list-row.data-list-row.is-urgent {
        background: #FEF2F5 !important;
    }

    .data-list-row.data-list-row.data-list-row.is-urgent:hover {
        background: #FCE7EC !important;
    }

    /* UNIVERSAL COLORED STAT CARDS MASTER RULE (EXACT MATCH FOR USER SPEC) */
    .dashboard-stat-card,
    .agp-summary-card,
    .tdx-summary-card,
    .brp-summary-card,
    .inc-summary-card,
    .rpt-summary-card {
        position: relative !important;
        overflow: hidden !important;
        border: none !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12) !important;
        border-radius: 14px !important;
    }

    .dashboard-stat-card span,
    .agp-summary-card span,
    .tdx-summary-card span,
    .brp-summary-card span,
    .inc-summary-card span,
    .rpt-summary-card span {
        color: #ffffff !important;
        opacity: 0.95 !important;
        font-size: 11px !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
    }

    .dashboard-stat-card h2,
    .agp-summary-card h2,
    .tdx-summary-card h2,
    .brp-summary-card h2,
    .inc-summary-card h2,
    .rpt-summary-card h2 {
        color: #ffffff !important;
        opacity: 1 !important;
        font-size: 32px !important;
        font-weight: 900 !important;
        margin: 4px 0 2px !important;
        letter-spacing: -0.5px !important;
    }

    .dashboard-stat-card p,
    .agp-summary-card p,
    .tdx-summary-card p,
    .brp-summary-card p,
    .inc-summary-card p,
    .rpt-summary-card p {
        color: #ffffff !important;
        opacity: 0.90 !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }

    .dashboard-stat-card .stat-icon,
    .agp-summary-card .agp-summary-icon,
    .tdx-summary-card .tdx-summary-icon,
    .brp-summary-card .brp-summary-icon,
    .inc-summary-card .inc-summary-icon,
    .rpt-summary-card .rpt-summary-icon {
        background: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
        border-radius: 12px !important;
        width: 48px !important;
        height: 48px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
        box-shadow: none !important;
    }

    .dashboard-stat-card svg,
    .agp-summary-card svg,
    .tdx-summary-card svg,
    .brp-summary-card svg,
    .inc-summary-card svg,
    .rpt-summary-card svg {
        fill: #ffffff !important;
        color: #ffffff !important;
        width: 22px !important;
        height: 22px !important;
    }

    /* MASTER OVERRIDE: SIDEBAR LOGO TRANSPARENT NO BACKGROUND */
    .sidebar-logo-mark,
    body .sidebar-logo-mark,
    body.light-mode .sidebar-logo-mark,
    body.dark-mode .sidebar-logo-mark,
    body:not(.dark-mode) .sidebar-logo-mark {
        background: transparent !important;
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
        outline: none !important;
        padding: 0 !important;
    }

    .lox-sidebar-logo,
    .sidebar-logo-mark img {
        width: 64px !important;
        height: 64px !important;
        max-width: 64px !important;
        max-height: 64px !important;
        min-width: 64px !important;
        min-height: 64px !important;
        object-fit: contain !important;
        background: transparent !important;
        border: none !important;
        transform: scale(1.15) !important;
        filter: drop-shadow(0 4px 12px rgba(139, 92, 246, 0.50)) !important;
    }

    /* ==========================================================================
       1. LIVE STATUS PULSE ANIMATION (SOC RADAR EFFECT FOR ONLINE/OFFLINE BADGES)
       ========================================================================== */
    @keyframes statusPulseGreen {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }

    @keyframes statusPulseRed {
        0% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }
        70% {
            box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
        }
    }

    .status-badge.online,
    .status-badge.connected,
    .badge-success,
    .agp-status.online,
    .agp-status-pill.online,
    .is-online-dot,
    .agp-health-card b.good {
        position: relative !important;
        animation: statusPulseGreen 2s infinite !important;
    }

    .status-badge.offline,
    .status-badge.disconnected,
    .badge-danger,
    .agp-status.offline,
    .agp-status-pill.offline,
    .is-offline-dot,
    .agp-health-card b.danger {
        position: relative !important;
        animation: statusPulseRed 2s infinite !important;
    }

    .status-badge.online::before,
    .agp-status.online::before,
    .agp-status-pill.online::before {
        content: '' !important;
        display: inline-block !important;
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background-color: #10b981 !important;
        margin-right: 6px !important;
        vertical-align: middle !important;
        box-shadow: 0 0 6px #10b981 !important;
    }

    .status-badge.offline::before,
    .agp-status.offline::before,
    .agp-status-pill.offline::before {
        content: '' !important;
        display: inline-block !important;
        width: 7px !important;
        height: 7px !important;
        border-radius: 50% !important;
        background-color: #ef4444 !important;
        margin-right: 6px !important;
        vertical-align: middle !important;
        box-shadow: 0 0 6px #ef4444 !important;
    }

    /* ==========================================================================
       2. QUICK FILTER BUTTON ACTIVE STATE GLOW & INTERACTIVE POLISH
       ========================================================================== */
    .tdx-filter-btn,
    .rpt-mode-btn,
    .table-filter-btn,
    .status-filter-btn,
    .filter-btn,
    .tdx-reset-btn,
    .xdr-combo-button,
    .tdx-filter-group input,
    .tdx-filter-group select,
    .xdr-filter-select {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        cursor: pointer !important;
    }

    .tdx-filter-btn:hover,
    .rpt-mode-btn:hover,
    .table-filter-btn:hover,
    .status-filter-btn:hover,
    .filter-btn:hover,
    .tdx-reset-btn:hover,
    .xdr-combo-button:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 16px rgba(124, 58, 237, 0.25) !important;
    }

    .tdx-filter-btn.active,
    .rpt-mode-btn.active,
    .table-filter-btn.active,
    .status-filter-btn.active,
    .filter-btn.active,
    .tdx-reset-btn:active {
        background: linear-gradient(135deg, #7c3aed, #6d28d9) !important;
        color: #ffffff !important;
        font-weight: 800 !important;
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.40) !important;
        transform: translateY(-1px) !important;
        border: none !important;
    }

    .tdx-filter-group input:focus,
    .tdx-filter-group select:focus,
    .xdr-filter-select:focus {
        border-color: #7c3aed !important;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.18) !important;
        outline: none !important;
    }

    /* ==========================================================================
       PROGRESS BAR COLOR FIX (TOP THREAT TYPES & SEVERITY BREAKDOWNS)
       ========================================================================== */
    .threat-progress {
        height: 10px !important;
        border-radius: 999px !important;
        background: #e2e8f0 !important;
        overflow: hidden !important;
        width: 120px !important;
        flex-shrink: 0 !important;
        display: block !important;
    }

    .threat-progress div {
        height: 100% !important;
        border-radius: 999px !important;
        background: linear-gradient(90deg, #8b5cf6, #d946ef) !important;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    .threat-progress.purple div {
        background: linear-gradient(90deg, #7c3aed, #a855f7) !important;
    }

    .threat-progress.red div {
        background: linear-gradient(90deg, #dc2626, #ef4444) !important;
    }

    .threat-progress.orange div {
        background: linear-gradient(90deg, #ea580c, #f97316) !important;
    }

    .threat-progress.green div {
        background: linear-gradient(90deg, #059669, #10b981) !important;
    }

    .threat-progress.blue div {
        background: linear-gradient(90deg, #2563eb, #3b82f6) !important;
    }

    .threat-progress.teal div {
        background: linear-gradient(90deg, #0d9488, #14b8a6) !important;
    }
</style>
