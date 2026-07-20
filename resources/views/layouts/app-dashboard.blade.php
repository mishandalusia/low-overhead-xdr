<!DOCTYPE html>
<html lang="en" class="light-mode">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LOX Dashboard</title>

    @include('partials.design-tokens')

    <link rel="stylesheet" href="{{ asset('css/lox-dashboard.css') }}">


    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: var(--font-main);
        }

        body {
            background: var(--bg-main);
            color: #0f172a;
        }

        body.dark-mode,
        body.dark,
        body.dark-theme {
            background: #07111f;
            color: #f8fafc;
        }

        .app {
            min-height: 100vh;
            display: flex;
            overflow: visible;
        }

        /* ========================= */
        /* MAIN BACKGROUND */
        /* ========================= */

        .main {
            position: relative;
            z-index: 1;
            margin-left: 86px;
            width: calc(100% - 86px);
            min-height: 100vh;
            padding: 36px 42px 46px;
            overflow: visible;
            transition: 0.25s ease;
            background: transparent !important;
        }

        body.dark-mode .main,
        body.dark .main,
        body.dark-theme .main {
            background:
                radial-gradient(circle at top left, rgba(79, 70, 229, 0.26), transparent 35%),
                radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 34%),
                radial-gradient(circle at bottom right, rgba(30, 64, 175, 0.25), transparent 38%),
                linear-gradient(135deg, #0f172a 0%, #1e1b4b 45%, #3b123c 100%) !important;
        }

        .content-wrapper {
            width: 100%;
            overflow: visible;
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* ========================= */
        /* SIDEBAR */
        /* ========================= */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 86px;
            padding: 28px 14px;
            z-index: 10000;
            overflow: visible;
            color: #ffffff;
            transition: 0.25s ease;
        }

        .sidebar:hover {
            width: 285px;
            padding: 30px 24px;
        }

        body.light-mode .sidebar,
        html.light-mode .sidebar,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar {
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.75), transparent 30%),
                radial-gradient(circle at 88% 12%, rgba(147, 197, 253, 0.58), transparent 30%),
                radial-gradient(circle at 20% 78%, rgba(236, 72, 153, 0.38), transparent 35%),
                linear-gradient(180deg, #f8e8ff 0%, #e9d5ff 28%, #dbeafe 62%, #fce7f3 100%) !important;
            border-right: 1px solid rgba(168, 85, 247, 0.18);
            box-shadow: 18px 0 55px rgba(168, 85, 247, 0.18);
        }

        body.dark-mode .sidebar,
        body.dark .sidebar,
        body.dark-theme .sidebar,
        html.dark-mode .sidebar,
        html.dark .sidebar,
        html.dark-theme .sidebar {
            background:
                radial-gradient(circle at top left, rgba(79, 70, 229, 0.18), transparent 34%),
                radial-gradient(circle at bottom right, rgba(30, 64, 175, 0.20), transparent 38%),
                linear-gradient(180deg, #020617 0%, #07111f 42%, #111827 70%, #1e1238 100%) !important;
            border-right: 1px solid rgba(99, 102, 241, 0.30);
            box-shadow: 18px 0 60px rgba(2, 6, 23, 0.58);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-bottom: 58px;
        }

        .sidebar:hover .sidebar-logo {
            justify-content: flex-start;
        }

        .sidebar-logo-mark {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff;
            font-size: 18px;
            font-weight: 950;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            box-shadow: 0 14px 30px rgba(168, 85, 247, 0.24);
        }

        body.dark-mode .sidebar-logo-mark,
        body.dark .sidebar-logo-mark,
        body.dark-theme .sidebar-logo-mark {
            background: linear-gradient(135deg, #4f46e5, #9333ea, #db2777);
            box-shadow: 0 14px 30px rgba(79, 70, 229, 0.24);
        }

        .sidebar-logo-text {
            opacity: 0;
            visibility: hidden;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
            transition: 0.22s ease;
        }

        .sidebar:hover .sidebar-logo-text {
            opacity: 1;
            visibility: visible;
            width: auto;
        }

        .sidebar-logo-text strong {
            display: block;
            font-size: 24px;
            font-weight: 950;
            line-height: 1;
        }

        .sidebar-logo-text span {
            display: block;
            margin-top: 6px;
            font-size: 13px;
            font-weight: 800;
        }

        body.light-mode .sidebar-logo-text strong,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-text strong {
            color: #2e1065;
        }

        body.light-mode .sidebar-logo-text span,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-text span {
            color: #6b21a8;
        }

        body.dark-mode .sidebar-logo-text strong,
        body.dark .sidebar-logo-text strong,
        body.dark-theme .sidebar-logo-text strong {
            color: #ffffff;
        }

        body.dark-mode .sidebar-logo-text span,
        body.dark .sidebar-logo-text span,
        body.dark-theme .sidebar-logo-text span {
            color: rgba(226, 232, 240, 0.78);
        }

        .menu-label {
            margin: 0 0 18px;
            font-size: 12px;
            font-weight: 850;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            opacity: 0;
            visibility: hidden;
        }

        .sidebar:hover .menu-label {
            opacity: 1;
            visibility: visible;
        }

        body.light-mode .menu-label,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .menu-label {
            color: rgba(88, 28, 135, 0.62);
        }

        body.dark-mode .menu-label,
        body.dark .menu-label,
        body.dark-theme .menu-label {
            color: rgba(203, 213, 225, 0.60);
        }

        .sidebar-nav {
            display: grid;
            gap: 11px;
        }

        .nav-item {
            height: 54px;
            border-radius: 18px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            text-decoration: none;
            font-size: 15px;
            font-weight: 850;
            transition: 0.22s ease;
        }

        .sidebar:hover .nav-item {
            justify-content: flex-start;
            gap: 16px;
            padding: 0 18px;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .nav-item span {
            opacity: 0;
            visibility: hidden;
            width: 0;
            overflow: hidden;
            white-space: nowrap;
            transition: 0.22s ease;
        }

        .sidebar:hover .nav-item span {
            opacity: 1;
            visibility: visible;
            width: auto;
        }

        body.light-mode .nav-item,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item {
            color: #5b21b6;
        }

        body.light-mode .nav-item:hover,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item:hover {
            background: rgba(255, 255, 255, 0.62);
            color: #7c3aed;
            box-shadow: 0 12px 28px rgba(168, 85, 247, 0.12);
        }

        body.light-mode .nav-item.active,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.active {
            background: rgba(255, 255, 255, 0.94);
            color: #7c3aed;
            box-shadow: 0 16px 36px rgba(168, 85, 247, 0.18);
        }

        body.dark-mode .nav-item,
        body.dark .nav-item,
        body.dark-theme .nav-item {
            color: rgba(226, 232, 240, 0.76);
        }

        body.dark-mode .nav-item:hover,
        body.dark .nav-item:hover,
        body.dark-theme .nav-item:hover {
            background: rgba(99, 102, 241, 0.20);
            color: #ffffff;
        }

        body.dark-mode .nav-item.active,
        body.dark .nav-item.active,
        body.dark-theme .nav-item.active {
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.42), rgba(147, 51, 234, 0.36));
            color: #ffffff;
            box-shadow: 0 16px 36px rgba(79, 70, 229, 0.20);
        }

        /* ========================= */
        /* SIDEBAR PROFILE */
        /* ========================= */

        .sidebar-user-menu {
            position: relative;
            width: 58px;
            margin: 32px auto 0;
            padding-bottom: 8px;
            transition: 0.25s ease;
        }

        .sidebar:hover .sidebar-user-menu {
            width: 100%;
        }

        .sidebar-user-trigger {
            min-height: 58px;
            padding: 8px;
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            cursor: pointer;
            transition: 0.22s ease;
        }

        .sidebar:hover .sidebar-user-trigger {
            justify-content: flex-start;
            padding: 10px 12px;
            gap: 12px;
        }

        body.light-mode .sidebar-user-trigger,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-trigger {
            background: rgba(255, 255, 255, 0.56);
            border: 1px solid rgba(168, 85, 247, 0.18);
            box-shadow: 0 14px 30px rgba(168, 85, 247, 0.12);
        }

        body.light-mode .sidebar:not(:hover) .sidebar-user-trigger,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar:not(:hover) .sidebar-user-trigger {
            background: transparent;
            border: none;
            box-shadow: none;
        }

        body.dark-mode .sidebar-user-trigger,
        body.dark .sidebar-user-trigger,
        body.dark-theme .sidebar-user-trigger {
            background: rgba(30, 41, 59, 0.34);
            border: 1px solid rgba(99, 102, 241, 0.24);
            box-shadow: 0 14px 30px rgba(2, 6, 23, 0.34);
        }

        body.dark-mode .sidebar:not(:hover) .sidebar-user-trigger,
        body.dark .sidebar:not(:hover) .sidebar-user-trigger,
        body.dark-theme .sidebar:not(:hover) .sidebar-user-trigger {
            background: transparent;
            border: none;
            box-shadow: none;
        }

        .sidebar-user-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            flex-shrink: 0;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
            box-shadow: 0 12px 26px rgba(217, 70, 239, 0.28);
        }

        .sidebar-user-initials {
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 0.2px;
        }

        .sidebar-user-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar:not(:hover) .sidebar-user-icon {
            background: transparent;
            box-shadow: none;
        }

        body.light-mode .sidebar:not(:hover) .sidebar-user-icon,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar:not(:hover) .sidebar-user-icon {
            color: #7c3aed;
        }

        body.dark-mode .sidebar:not(:hover) .sidebar-user-icon,
        body.dark .sidebar:not(:hover) .sidebar-user-icon,
        body.dark-theme .sidebar:not(:hover) .sidebar-user-icon {
            color: rgba(226, 232, 240, 0.78);
        }

        .sidebar-user-text {
            min-width: 0;
            flex: 1;
            opacity: 0;
            visibility: hidden;
            width: 0;
            overflow: hidden;
            transition: 0.22s ease;
        }

        .sidebar:hover .sidebar-user-text {
            opacity: 1;
            visibility: visible;
            width: auto;
        }

        .sidebar-user-text strong {
            display: block;
            font-size: 13px;
            font-weight: 950;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user-text span {
            display: block;
            margin-top: 3px;
            font-size: 11px;
            font-weight: 750;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        body.light-mode .sidebar-user-text strong,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-text strong {
            color: #2e1065;
        }

        body.light-mode .sidebar-user-text span,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-text span {
            color: #6b21a8;
        }

        body.dark-mode .sidebar-user-text strong,
        body.dark .sidebar-user-text strong,
        body.dark-theme .sidebar-user-text strong {
            color: #ffffff;
        }

        body.dark-mode .sidebar-user-text span,
        body.dark .sidebar-user-text span,
        body.dark-theme .sidebar-user-text span {
            color: rgba(226, 232, 240, 0.70);
        }

        .sidebar-user-logout-form {
            flex-shrink: 0;
            opacity: 0;
            visibility: hidden;
            width: 0;
            overflow: hidden;
            transition: 0.22s ease;
        }

        .sidebar:hover .sidebar-user-logout-form {
            opacity: 1;
            visibility: visible;
            width: auto;
        }

        .sidebar-user-logout-btn {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 10px;
            background: transparent;
            color: #ef4444;
            cursor: pointer;
            transition: 0.18s ease;
        }

        .sidebar-user-logout-btn:hover {
            background: rgba(239, 68, 68, 0.14);
        }

        body.dark-mode .sidebar-user-logout-btn,
        body.dark .sidebar-user-logout-btn,
        body.dark-theme .sidebar-user-logout-btn {
            color: #fb7185;
        }

        .sidebar-profile-dropdown {
            position: absolute;
            left: 0;
            bottom: calc(100% + 2px);
            top: auto;
            width: 100%;
            min-width: 230px;
            padding: 14px;
            border-radius: 22px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(4px);
            transition: 0.18s ease;
            z-index: 99999;
        }

        .sidebar:hover .sidebar-user-menu:hover .sidebar-profile-dropdown,
        .sidebar:hover .sidebar-profile-dropdown:hover {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }

        body.light-mode .sidebar-profile-dropdown,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-dropdown {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(168, 85, 247, 0.22);
            box-shadow: 0 24px 60px rgba(168, 85, 247, 0.20);
        }

        body.dark-mode .sidebar-profile-dropdown,
        body.dark .sidebar-profile-dropdown,
        body.dark-theme .sidebar-profile-dropdown {
            background:
                radial-gradient(circle at top right, rgba(79, 70, 229, 0.18), transparent 34%),
                linear-gradient(135deg, #020617, #111827 55%, #1e1238);
            border: 1px solid rgba(99, 102, 241, 0.30);
            box-shadow: 0 24px 60px rgba(2, 6, 23, 0.55);
        }

        .sidebar-profile-link {
            width: 100%;
            min-height: 46px;
            border-radius: 16px;
            padding: 0 13px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 850;
            background: transparent;
            border: none;
            transition: 0.2s ease;
        }

        body.light-mode .sidebar-profile-link,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-link {
            color: #2e1065;
        }

        body.light-mode .sidebar-profile-link:hover,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-link:hover {
            background: rgba(243, 232, 255, 0.90);
            color: #7c3aed;
        }

        body.dark-mode .sidebar-profile-link,
        body.dark .sidebar-profile-link,
        body.dark-theme .sidebar-profile-link {
            color: #e5e7eb;
        }

        body.dark-mode .sidebar-profile-link:hover,
        body.dark .sidebar-profile-link:hover,
        body.dark-theme .sidebar-profile-link:hover {
            background: rgba(99, 102, 241, 0.20);
            color: #ffffff;
        }

        /* ========================= */
        /* TOPBAR */
        /* ========================= */

        .topbar {
            min-height: 62px;
            margin-bottom: 36px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 16px;
        }

        .search-box {
            width: 300px;
            height: 48px;
            border-radius: 999px;
            padding: 0 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 12px 28px rgba(168, 85, 247, 0.08);
        }

        body.light-mode .search-box,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .search-box {
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(168, 85, 247, 0.14);
        }

        body.dark-mode .search-box,
        body.dark .search-box,
        body.dark-theme .search-box {
            background: #111827;
            border: 1px solid #334155;
        }

        .search-box i {
            color: #64748b;
            font-size: 13px;
        }

        .search-box input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-weight: 750;
        }

        body.light-mode .search-box input,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .search-box input {
            color: #0f172a;
        }

        body.dark-mode .search-box input,
        body.dark .search-box input,
        body.dark-theme .search-box input {
            color: #f8fafc;
        }

        .notification-btn {
            position: relative;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            flex-shrink: 0;
            box-shadow: 0 12px 28px rgba(168, 85, 247, 0.10);
        }

        body.light-mode .notification-btn,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .notification-btn {
            background: rgba(255, 255, 255, 0.92);
            color: #0f172a;
        }

        body.dark-mode .notification-btn,
        body.dark .notification-btn,
        body.dark-theme .notification-btn {
            background: #111827;
            color: #f8fafc;
            border: 1px solid #334155;
        }

        .notification-btn::after {
            content: "";
            position: absolute;
            right: 10px;
            top: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #ffffff;
        }

        @media (max-width: 768px) {
            .main {
                padding: 28px 20px;
            }

            .search-box {
                width: 220px;
            }
        }
      /* ================================================= */
/* FIX LOGO SIDEBAR BIAR GA GEDE / GA NGE-BLEED */
/* ================================================= */

.sidebar-logo {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 14px !important;
    margin-bottom: 58px !important;
    overflow: hidden !important;
}

.sidebar:hover .sidebar-logo {
    justify-content: flex-start !important;
}

.sidebar-logo-mark {
    width: 44px !important;
    height: 44px !important;
    min-width: 44px !important;
    max-width: 44px !important;
    min-height: 44px !important;
    max-height: 44px !important;
    padding: 6px !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
    background: rgba(255, 255, 255, 0.45) !important;
    box-shadow: 0 12px 26px rgba(168, 85, 247, 0.18) !important;
}

/* Logo image dipaksa kecil */
.lox-sidebar-logo,
.sidebar-logo-mark img {
    width: 30px !important;
    height: 30px !important;
    max-width: 30px !important;
    max-height: 30px !important;
    min-width: 30px !important;
    min-height: 30px !important;
    object-fit: contain !important;
    display: block !important;
    position: static !important;
    transform: none !important;
    opacity: 1 !important;
}

/* Jangan sampai logo lama muncul sebagai background besar */
.sidebar-logo::before,
.sidebar-logo::after,
.sidebar-logo-mark::before,
.sidebar-logo-mark::after {
    display: none !important;
    content: none !important;
}

/* Light mode */
body.light-mode .sidebar-logo-mark,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-mark {
    background: rgba(255, 255, 255, 0.60) !important;
}

/* Dark mode */
body.dark-mode .sidebar-logo-mark,
body.dark .sidebar-logo-mark,
body.dark-theme .sidebar-logo-mark {
    background: rgba(255, 255, 255, 0.18) !important;
}

/* Logo text */
.sidebar-logo-text strong {
    font-size: 24px !important;
    font-weight: 950 !important;
    line-height: 1 !important;
}

.sidebar-logo-text span {
    font-size: 13px !important;
    font-weight: 800 !important;
}  
/* GLOBAL FONT UPGRADE */
body,
button,
input,
select,
textarea {
    font-family: var(--font-main) !important;
}

h1,
h2,
h3,
h4,
.sidebar-logo-text strong,
.nav-item,
.page-heading h1,
.brp-heading h1,
.agp-heading h1,
.tdx-heading h1,
.rpt-hero h1 {
    font-family: var(--font-main) !important;
    letter-spacing: -0.6px;
}

/* ================================================= */
/* GLOBAL SHARP UI FIX - BIAR GA TERLALU MELENGKUNG */
/* Paste paling bawah style app-dashboard.blade.php */
/* ================================================= */

/* Panel besar / container utama */
.dashboard-panel,
.agp-panel,
.tdx-panel,
.brp-panel,
.rpt-panel,
.rpt-hero,
.rpt-mode-panel,
.brp-filter-panel {
    border-radius: 18px !important;
}

/* Card summary atas */
.dashboard-stat-card,
.agp-summary-card,
.tdx-summary-card,
.brp-summary-card,
.rpt-summary-card {
    border-radius: 16px !important;
}

/* Row/table/card list */
.threat-row,
.severity-row,
.recent-alert-item,
.history-alert-row,
.agp-agent-row,
.agp-health-card,
.tdx-threat-row,
.brp-ip-row,
.brp-detail-box,
.brp-history-row,
.rpt-activity-row,
.rpt-blocked-card,
.rpt-trend-summary div,
.rpt-severity-row {
    border-radius: 12px !important;
}

/* Chart box / visual box */
.rpt-chart-box,
.rpt-severity-total,
.severity-total,
.brp-selected-hero,
.selected-ip-box {
    border-radius: 16px !important;
}

/* Input, select, search */
input,
select,
textarea,
.search-box,
.brp-filter-group input,
.brp-filter-group select,
.agent-filter input,
.agent-filter select {
    border-radius: 12px !important;
}

/* Tombol biasa */
button,
.rpt-btn,
.rpt-mode-btn,
.brp-reset-btn,
.brp-action-btn,
.table-action {
    border-radius: 12px !important;
}

/* Badge/status tetap agak rounded tapi tidak terlalu kapsul */
.status,
.badge,
.brp-status,
.rpt-badge,
.rpt-status,
.tdx-severity,
.incident-status,
.agent-status {
    border-radius: 10px !important;
}

/* Sidebar menu tetap modern tapi tidak terlalu bulet */
.nav-item,
.sidebar-user-trigger,
.sidebar-profile-dropdown,
.sidebar-profile-link,
.sidebar-theme-row,
.sidebar-profile-logout {
    border-radius: 12px !important;
}

/* Logo/profile icon jangan terlalu kotak, tetap aman */
.sidebar-logo-mark,
.sidebar-user-icon,
.device-icon,
.ip-icon,
.tdx-summary-icon,
.agp-summary-icon {
    border-radius: 12px !important;
}

/* Hilangkan rasa terlalu soft dari shadow */
.dashboard-panel,
.agp-panel,
.tdx-panel,
.brp-panel,
.rpt-panel {
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.12) !important;
}

/* Dark mode tetap clean */
body.dark-mode .dashboard-panel,
body.dark-mode .agp-panel,
body.dark-mode .tdx-panel,
body.dark-mode .brp-panel,
body.dark-mode .rpt-panel,
body.dark .dashboard-panel,
body.dark .agp-panel,
body.dark .tdx-panel,
body.dark .brp-panel,
body.dark .rpt-panel,
body.dark-theme .dashboard-panel,
body.dark-theme .agp-panel,
body.dark-theme .tdx-panel,
body.dark-theme .brp-panel,
body.dark-theme .rpt-panel {
    box-shadow: 0 14px 34px rgba(0, 0, 0, 0.18) !important;
}

/* Kalau ada pseudo decoration yang bikin terlalu rounded besar */
.dashboard-stat-card::before,
.dashboard-stat-card::after,
.agp-summary-card::before,
.agp-summary-card::after,
.tdx-summary-card::before,
.tdx-summary-card::after,
.brp-summary-card::before,
.brp-summary-card::after,
.rpt-summary-card::before,
.rpt-summary-card::after {
    opacity: 0.55 !important;
}
/* ================================================= */
/* SOFT LAVENDER PINK THEME - LIKE REFERENCE IMAGE */
/* Paste paling bawah style app-dashboard.blade.php */
/* ================================================= */

:root {
    --soft-bg-1: #f7ecff;
    --soft-bg-2: #ffe8f4;
    --soft-bg-3: #e9f0ff;
    --soft-sidebar: rgba(255, 255, 255, 0.42);
    --soft-panel: rgba(255, 255, 255, 0.58);
    --soft-panel-strong: rgba(255, 255, 255, 0.78);
    --soft-border: rgba(180, 148, 255, 0.25);
    --soft-purple: #9b5cf6;
    --soft-pink: #ec6bb8;
    --soft-blue: #86a8ff;
    --soft-text: #1f2440;
    --soft-muted: #6b7280;
}

body,
button,
input,
select,
textarea {
    font-family: var(--font-main) !important;
}

/* MAIN BACKGROUND LIGHT */
body.light-mode .main,
body:not(.dark-mode):not(.dark):not(.dark-theme) .main {
    background:
        radial-gradient(circle at top left, rgba(155, 92, 246, 0.25), transparent 32%),
        radial-gradient(circle at top right, rgba(236, 107, 184, 0.22), transparent 34%),
        radial-gradient(circle at bottom left, rgba(134, 168, 255, 0.24), transparent 36%),
        linear-gradient(135deg, #f7ecff 0%, #ffe8f4 48%, #e9f0ff 100%) !important;
    color: var(--soft-text) !important;
}

/* SIDEBAR LIGHT */
body.light-mode .sidebar,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar {
    background:
        radial-gradient(circle at top left, rgba(155, 92, 246, 0.22), transparent 34%),
        radial-gradient(circle at bottom right, rgba(236, 107, 184, 0.18), transparent 38%),
        linear-gradient(180deg, rgba(255,255,255,0.50), rgba(245,231,255,0.70), rgba(255,232,244,0.62)) !important;
    border-right: 1px solid rgba(180, 148, 255, 0.30) !important;
    box-shadow: 14px 0 44px rgba(155, 92, 246, 0.14) !important;
    backdrop-filter: blur(18px) !important;
}

/* SIDEBAR LOGO */
body.light-mode .sidebar-logo-mark,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-mark {
    background: rgba(255, 255, 255, 0.72) !important;
    border: 1px solid rgba(180, 148, 255, 0.24) !important;
    box-shadow: 0 12px 26px rgba(155, 92, 246, 0.14) !important;
}

body.light-mode .sidebar-logo-text strong,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-text strong {
    color: #35225f !important;
}

body.light-mode .sidebar-logo-text span,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-text span {
    color: #7c5db8 !important;
}

/* MENU LABEL */
body.light-mode .menu-label,
body:not(.dark-mode):not(.dark):not(.dark-theme) .menu-label {
    color: #9b6fd6 !important;
}

/* SIDEBAR NAV */
body.light-mode .nav-item,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item {
    color: #6f58a8 !important;
    font-weight: 850 !important;
}

body.light-mode .nav-item i,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item i {
    color: #8b63d9 !important;
}

body.light-mode .nav-item:hover,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item:hover {
    background: rgba(255, 255, 255, 0.52) !important;
    color: #7c3aed !important;
    box-shadow: 0 12px 26px rgba(155, 92, 246, 0.12) !important;
}

body.light-mode .nav-item.active,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.active {
    background: rgba(255, 255, 255, 0.86) !important;
    color: #7c3aed !important;
    border: 1px solid rgba(180, 148, 255, 0.22) !important;
    box-shadow: 0 16px 34px rgba(155, 92, 246, 0.16) !important;
}

body.light-mode .nav-item.active i,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.active i {
    color: #7c3aed !important;
}

/* PROFILE SIDEBAR */
body.light-mode .sidebar-user-trigger,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-trigger {
    background: rgba(255, 255, 255, 0.60) !important;
    border: 1px solid rgba(180, 148, 255, 0.24) !important;
    box-shadow: 0 16px 34px rgba(155, 92, 246, 0.13) !important;
}

body.light-mode .sidebar-user-icon,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-icon {
    background: linear-gradient(135deg, #9b5cf6, #ec6bb8) !important;
    color: #ffffff !important;
    box-shadow: 0 12px 26px rgba(236, 107, 184, 0.24) !important;
}

body.light-mode .sidebar-user-text strong,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-text strong {
    color: #35225f !important;
}

body.light-mode .sidebar-user-text span,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-text span {
    color: #7c5db8 !important;
}

/* DROPDOWN PROFILE */
body.light-mode .sidebar-profile-dropdown,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-dropdown {
    background: rgba(255, 255, 255, 0.90) !important;
    border: 1px solid rgba(180, 148, 255, 0.25) !important;
    box-shadow: 0 24px 60px rgba(155, 92, 246, 0.18) !important;
    backdrop-filter: blur(18px) !important;
}

body.light-mode .sidebar-profile-link,
body.light-mode .sidebar-theme-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-link,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-theme-row {
    color: #5b3c91 !important;
}

/* PAGE TITLE */
body.light-mode h1,
body.light-mode h2,
body.light-mode h3,
body:not(.dark-mode):not(.dark):not(.dark-theme) h1,
body:not(.dark-mode):not(.dark):not(.dark-theme) h2,
body:not(.dark-mode):not(.dark):not(.dark-theme) h3 {
    color: #1f2440 !important;
    font-family: var(--font-main) !important;
    font-weight: 900 !important;
    letter-spacing: -0.45px;
}

body.light-mode p,
body.light-mode small,
body:not(.dark-mode):not(.dark):not(.dark-theme) p,
body:not(.dark-mode):not(.dark):not(.dark-theme) small {
    color: #667085 !important;
}

/* PANEL / CARD UTAMA */
body.light-mode .dashboard-panel,
body.light-mode .dashboard-stat-card,
body.light-mode .agp-summary-card,
body.light-mode .agp-panel,
body.light-mode .tdx-summary-card,
body.light-mode .tdx-panel,
body.light-mode .brp-filter-panel,
body.light-mode .brp-summary-card,
body.light-mode .brp-panel,
body.light-mode .rpt-hero,
body.light-mode .rpt-summary-card,
body.light-mode .rpt-mode-panel,
body.light-mode .rpt-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .dashboard-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .dashboard-stat-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .agp-summary-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .agp-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .tdx-summary-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .tdx-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-filter-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-summary-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-hero,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-summary-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-mode-panel,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-panel {
    background:
        radial-gradient(circle at top right, rgba(236, 107, 184, 0.12), transparent 34%),
        radial-gradient(circle at bottom left, rgba(134, 168, 255, 0.13), transparent 36%),
        rgba(255, 255, 255, 0.64) !important;
    border: 1px solid rgba(180, 148, 255, 0.24) !important;
    box-shadow: 0 22px 45px rgba(155, 92, 246, 0.12) !important;
    color: #1f2440 !important;
    backdrop-filter: blur(18px) !important;
}

/* SUMMARY CARD COLORS SOFT */
body.light-mode .dashboard-stat-card:nth-child(1),
body.light-mode .agp-summary-card:nth-child(1),
body.light-mode .tdx-summary-card:nth-child(1),
body.light-mode .brp-summary-card:nth-child(1),
body.light-mode .rpt-summary-card:nth-child(1) {
    background: linear-gradient(135deg, rgba(255,255,255,0.72), rgba(239,230,255,0.86)) !important;
}

body.light-mode .dashboard-stat-card:nth-child(2),
body.light-mode .agp-summary-card:nth-child(2),
body.light-mode .tdx-summary-card:nth-child(2),
body.light-mode .brp-summary-card:nth-child(2),
body.light-mode .rpt-summary-card:nth-child(2) {
    background: linear-gradient(135deg, rgba(255,255,255,0.72), rgba(255,226,244,0.86)) !important;
}

body.light-mode .dashboard-stat-card:nth-child(3),
body.light-mode .agp-summary-card:nth-child(3),
body.light-mode .tdx-summary-card:nth-child(3),
body.light-mode .brp-summary-card:nth-child(3),
body.light-mode .rpt-summary-card:nth-child(3) {
    background: linear-gradient(135deg, rgba(255,255,255,0.72), rgba(226,237,255,0.90)) !important;
}

body.light-mode .dashboard-stat-card:nth-child(4),
body.light-mode .agp-summary-card:nth-child(4),
body.light-mode .tdx-summary-card:nth-child(4),
body.light-mode .rpt-summary-card:nth-child(4) {
    background: linear-gradient(135deg, rgba(255,255,255,0.72), rgba(246,226,255,0.88)) !important;
}

/* TEXT CARD */
body.light-mode .dashboard-stat-card h2,
body.light-mode .dashboard-stat-card span,
body.light-mode .dashboard-stat-card p,
body.light-mode .agp-summary-card h2,
body.light-mode .agp-summary-card span,
body.light-mode .agp-summary-card p,
body.light-mode .tdx-summary-card h2,
body.light-mode .tdx-summary-card span,
body.light-mode .tdx-summary-card p,
body.light-mode .brp-summary-card h2,
body.light-mode .brp-summary-card span,
body.light-mode .brp-summary-card p,
body.light-mode .rpt-summary-card h2,
body.light-mode .rpt-summary-card span,
body.light-mode .rpt-summary-card p {
    color: #1f2440 !important;
}

/* ROW / TABLE — the row classes now governed by the shared .data-list-row
   zebra system (see partials/design-tokens.blade.php) were removed from
   this selector list. They used to sit here with higher specificity than
   .data-list-row's own rule, silently winning and making the zebra
   striping invisible no matter what .data-list-row said. */
body.light-mode .brp-detail-box,
body.light-mode .rpt-blocked-card,
body.light-mode .rpt-trend-summary div,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-detail-box,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-blocked-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-trend-summary div {
    background: rgba(255, 255, 255, 0.68) !important;
    border: 1px solid rgba(180, 148, 255, 0.18) !important;
    box-shadow: 0 12px 28px rgba(155, 92, 246, 0.08) !important;
    color: #1f2440 !important;
}

/* INPUT SELECT */
body.light-mode input,
body.light-mode select,
body.light-mode textarea,
body:not(.dark-mode):not(.dark):not(.dark-theme) input,
body:not(.dark-mode):not(.dark):not(.dark-theme) select,
body:not(.dark-mode):not(.dark):not(.dark-theme) textarea {
    background: rgba(255, 255, 255, 0.76) !important;
    border: 1px solid rgba(180, 148, 255, 0.26) !important;
    color: #1f2440 !important;
    box-shadow: none !important;
}

/* BUTTON */
body.light-mode .brp-reset-btn,
body.light-mode .rpt-btn.pdf,
body.light-mode .rpt-mode-btn.active,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-reset-btn,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-btn.pdf,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-mode-btn.active {
    background: linear-gradient(135deg, #9b5cf6, #ec6bb8) !important;
    color: #ffffff !important;
    box-shadow: 0 14px 28px rgba(155, 92, 246, 0.18) !important;
}

/* GRADIENT BOX */
body.light-mode .brp-selected-hero,
body.light-mode .rpt-severity-total,
body.light-mode .severity-total,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-selected-hero,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-severity-total,
body:not(.dark-mode):not(.dark):not(.dark-theme) .severity-total {
    background: linear-gradient(135deg, #9b5cf6, #d96ee8, #ec6bb8) !important;
    color: #ffffff !important;
}

/* ICON BOX — .tdx-summary-icon and .agp-summary-icon used to be forced
   into this purple-pink gradient regardless of severity/status, which is
   also why their own page-specific color-coded backgrounds never showed:
   this rule's higher specificity (body.light-mode + class) silently beat
   their plain single-class rule. Each page now owns its own soft, icon-
   color-matched tint instead (see threat-detection.blade.php,
   agent-monitoring.blade.php) — pale background, not gradient. */
body.light-mode .device-icon,
body.light-mode .ip-icon,
body.light-mode .sidebar-user-icon {
    background: linear-gradient(135deg, #9b5cf6, #ec6bb8) !important;
    color: #ffffff !important;
}

/* DECORATION CIRCLE BIAR GA TERLALU NORAK */
body.light-mode .dashboard-stat-card::before,
body.light-mode .dashboard-stat-card::after,
body.light-mode .agp-summary-card::before,
body.light-mode .agp-summary-card::after,
body.light-mode .tdx-summary-card::before,
body.light-mode .tdx-summary-card::after,
body.light-mode .brp-summary-card::before,
body.light-mode .brp-summary-card::after,
body.light-mode .rpt-summary-card::before,
body.light-mode .rpt-summary-card::after {
    opacity: 0.22 !important;
}
/* ================================================= */
/* FINAL SHARP RADIUS FIX - BIAR GA TERLALU MELENGKUNG */
/* Paste paling bawah semua CSS app-dashboard.blade.php */
/* ================================================= */

/* Panel besar seperti Top Threat Types, Severity, Recent Alerts */
.dashboard-panel,
.agp-panel,
.tdx-panel,
.brp-panel,
.rpt-panel,
.rpt-hero,
.rpt-mode-panel,
.brp-filter-panel {
    border-radius: 14px !important;
}

/* Card atas seperti Total Events, Active Alerts, Blocked IPs */
.dashboard-stat-card,
.agp-summary-card,
.tdx-summary-card,
.brp-summary-card,
.rpt-summary-card {
    border-radius: 12px !important;
}

/* Isi table / list / row */
.threat-row,
.severity-row,
.recent-alert-item,
.history-alert-row,
.agp-agent-row,
.agp-health-card,
.tdx-threat-row,
.brp-ip-row,
.brp-detail-box,
.brp-history-row,
.rpt-activity-row,
.rpt-blocked-card,
.rpt-trend-summary div,
.rpt-severity-row {
    border-radius: 9px !important;
}

/* Gradient box besar seperti 430 total threats */
.severity-total,
.rpt-severity-total,
.brp-selected-hero,
.selected-ip-box,
.rpt-chart-box {
    border-radius: 12px !important;
}

/* Input, filter, search */
input,
select,
textarea,
.search-box,
.brp-filter-group input,
.brp-filter-group select,
.agent-filter input,
.agent-filter select {
    border-radius: 9px !important;
}

/* Button */
button,
.rpt-btn,
.rpt-mode-btn,
.brp-reset-btn,
.brp-action-btn,
.table-action {
    border-radius: 9px !important;
}

/* Badge/status tetap rounded tapi tidak terlalu kapsul */
.status,
.badge,
.brp-status,
.rpt-badge,
.rpt-status,
.tdx-severity,
.incident-status,
.agent-status {
    border-radius: 8px !important;
}

/* Sidebar item biar ikut lebih clean */
.nav-item,
.sidebar-user-trigger,
.sidebar-profile-dropdown,
.sidebar-profile-link,
.sidebar-theme-row,
.sidebar-profile-logout {
    border-radius: 10px !important;
}

/* Icon box kecil */
.sidebar-logo-mark,
.sidebar-user-icon,
.device-icon,
.ip-icon,
.tdx-summary-icon,
.agp-summary-icon {
    border-radius: 10px !important;
}

/* Kalau masih ada elemen dashboard spesifik */
.dashboard-overview-page .dashboard-panel,
.dashboard-overview-page .dashboard-stat-card,
.dashboard-overview-page .threat-row,
.dashboard-overview-page .severity-row,
.dashboard-overview-page .recent-alert-item {
    border-radius: 10px !important;
}

/* Biar dekorasi bulat di pojok card tidak terlalu kelihatan AI */
.dashboard-stat-card::before,
.dashboard-stat-card::after,
.agp-summary-card::before,
.agp-summary-card::after,
.tdx-summary-card::before,
.tdx-summary-card::after,
.brp-summary-card::before,
.brp-summary-card::after,
.rpt-summary-card::before,
.rpt-summary-card::after {
    opacity: 0.12 !important;
}

/* Kalau mau kesan lebih kotak, kecilkan padding bayangan juga */
.dashboard-panel,
.agp-panel,
.tdx-panel,
.brp-panel,
.rpt-panel,
.dashboard-stat-card,
.agp-summary-card,
.tdx-summary-card,
.brp-summary-card,
.rpt-summary-card {
    box-shadow: 0 12px 28px rgba(155, 92, 246, 0.10) !important;
}

/* Dark mode shadow tetap soft */
body.dark-mode .dashboard-panel,
body.dark-mode .agp-panel,
body.dark-mode .tdx-panel,
body.dark-mode .brp-panel,
body.dark-mode .rpt-panel,
body.dark .dashboard-panel,
body.dark .agp-panel,
body.dark .tdx-panel,
body.dark .brp-panel,
body.dark .rpt-panel,
body.dark-theme .dashboard-panel,
body.dark-theme .agp-panel,
body.dark-theme .tdx-panel,
body.dark-theme .brp-panel,
body.dark-theme .rpt-panel {
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.16) !important;
}
/* ================================================= */
/* FINAL ROBOTO FONT SYSTEM */
/* Paste paling bawah style app-dashboard.blade.php */
/* ================================================= */

/* Semua teks utama */
body,
button,
input,
select,
textarea,
p,
small,
span,
label,
a,
td,
th {
    font-family: var(--font-main) !important;
}

/* Judul utama halaman */
h1,
.page-heading h1,
.brp-heading h1,
.agp-heading h1,
.tdx-heading h1,
.rpt-hero h1 {
    font-family: var(--font-main) !important;
    font-weight: 900 !important;
    letter-spacing: -0.8px !important;
}

/* Judul panel/card */
h2,
h3,
.panel-header h3,
.brp-panel-header h3,
.agp-panel-header h3,
.tdx-panel-header h3,
.rpt-panel-header h3,
.rpt-mode-panel h3,
.dashboard-panel h3 {
    font-family: var(--font-main) !important;
    font-weight: 800 !important;
    letter-spacing: -0.45px !important;
}

/* Menu sidebar */
.nav-item,
.nav-item span,
.sidebar-logo-text strong,
.sidebar-user-text strong {
    font-family: var(--font-main) !important;
    font-weight: 800 !important;
    letter-spacing: 0.1px !important;
}

/* Subtitle kecil dibuat Roboto italic biar beda */
.page-heading p,
.brp-heading p,
.agp-heading p,
.tdx-heading p,
.rpt-hero p,
.panel-header p,
.brp-panel-header p,
.agp-panel-header p,
.tdx-panel-header p,
.rpt-panel-header p {
    font-family: var(--font-main) !important;
    font-style: italic !important;
    font-weight: 500 !important;
    letter-spacing: 0 !important;
}

/* Angka statistik */
.dashboard-stat-card h2,
.agp-summary-card h2,
.tdx-summary-card h2,
.brp-summary-card h2,
.rpt-summary-card h2,
.severity-total h2,
.rpt-severity-total h2,
#selectedIp,
#summaryActivity,
#summaryBlocked,
#trendActivity,
#trendBlocked {
    font-family: var(--font-main) !important;
    font-weight: 700 !important;
    letter-spacing: -1px !important;
}

/* Angka di table dan percentage */
.threat-row b,
.severity-row b,
.rpt-severity-row b,
.brp-history-row b,
.agp-cell strong,
.agp-health-percent,
.tdx-count,
.rpt-badge,
.brp-status,
.brp-action-btn {
    font-family: var(--font-main) !important;
    font-weight: 700 !important;
}

/* Label kecil di card */
.dashboard-stat-card span,
.agp-summary-card span,
.tdx-summary-card span,
.brp-summary-card span,
.rpt-summary-card span,
.brp-filter-group label,
.menu-label {
    font-family: var(--font-main) !important;
    font-weight: 700 !important;
    letter-spacing: 0.25px !important;
}

/* Button */
button,
.rpt-btn,
.rpt-mode-btn,
.brp-reset-btn,
.brp-action-btn,
.table-action {
    font-family: var(--font-main) !important;
    font-weight: 800 !important;
    letter-spacing: 0.15px !important;
}

/* Nama agent, alert, threat dibuat bold clean */
.threat-row strong,
.recent-alert-item strong,
.history-alert-row strong,
.agp-agent-row strong,
.agp-health-card strong,
.tdx-threat-row strong,
.brp-ip-row strong,
.brp-detail-box strong,
.rpt-activity-row strong,
.rpt-blocked-card strong {
    font-family: var(--font-main) !important;
    font-weight: 800 !important;
}

/* Text kecil dalam row */
.threat-row small,
.recent-alert-item small,
.history-alert-row small,
.agp-agent-row small,
.agp-agent-row em,
.tdx-threat-row small,
.brp-ip-row small,
.brp-ip-row em,
.rpt-activity-row small,
.rpt-blocked-card span {
    font-family: var(--font-main) !important;
    font-style: normal !important;
    font-weight: 500 !important;
}

/* Logo text lebih tegas */
.sidebar-logo-text strong {
    font-size: 25px !important;
    font-style: normal !important;
}

.sidebar-logo-text span {
    font-family: var(--font-main) !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    font-style: italic !important;
}
    </style>
</head>

<body class="light-mode">
@php
    $activeUser = auth()->user();
    $activeUserInitials = collect(explode(' ', trim($activeUser->name)))
        ->filter()
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

@include('partials.flickering-grid-bg')

<div class="app light-mode">

    <aside class="sidebar">
<div class="sidebar-logo">
    <div class="sidebar-logo-mark">
        <img class="lox-sidebar-logo" src="{{ asset('images/lox-logo.png') }}" alt="LOX Logo">
    </div>

    <div class="sidebar-logo-text">
        <strong>LOX</strong>
        <span>Low-Overhead XDR</span>
    </div>
</div>

        <p class="menu-label">Menu</p>

        <nav class="sidebar-nav">
            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               title="Dashboard">
                <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M11.47 3.84a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 1-1.06 1.06l-.44-.44v6.6a2.25 2.25 0 0 1-2.25 2.25h-3a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75h-3A2.25 2.25 0 0 1 3 19.5v-6.6l-.44.44a.75.75 0 1 1-1.06-1.06l8.69-8.69Z"/></svg></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('agent.monitoring') }}"
               class="nav-item {{ request()->routeIs('agent.monitoring') ? 'active' : '' }}"
               title="Agent Monitoring">
                <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M4 3h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Zm2.75 3a1 1 0 1 0 0 2 1 1 0 0 0 0-2ZM4 13h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2Zm2.75 3a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z"/></svg></i>
                <span>Agent Monitoring</span>
            </a>

            <a href="{{ route('threat.detection') }}"
               class="nav-item {{ request()->routeIs('threat.detection') ? 'active' : '' }}"
               title="Threat Detection">
                <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M6.24 3a1 1 0 0 0-.83.445L2.13 8.4a1 1 0 0 0 .062 1.202l9.09 11.036a1 1 0 0 0 1.542 0l9.09-11.036A1 1 0 0 0 21.87 8.4l-3.28-4.955A1 1 0 0 0 17.76 3H6.24Z"/></svg></i>
                <span>Threat Detection</span>
            </a>

            <a href="{{ route('incident.management') }}"
               class="nav-item {{ request()->routeIs('incident.management') ? 'active' : '' }}"
               title="Incident Management">
                <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd"/></svg></i>
                <span>Incident Management</span>
            </a>

            <a href="{{ route('response.management') }}"
               class="nav-item {{ request()->routeIs('response.management') ? 'active' : '' }}"
               title="Response Management">
                <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Z" clip-rule="evenodd"/></svg></i>
                <span>Response Management</span>
            </a>

            <a href="{{ route('analytics') }}"
               class="nav-item {{ request()->routeIs('analytics') ? 'active' : '' }}"
               title="Reports">
                <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg></i>
                <span>Reports</span>
            </a>
        </nav>

        <div class="sidebar-user-menu">
            <div class="sidebar-user-trigger">
                <div class="sidebar-user-icon">
                    @if ($activeUser->avatar_path)
                        <img src="{{ asset('storage/'.$activeUser->avatar_path) }}" alt="{{ $activeUser->name }}">
                    @else
                        <span class="sidebar-user-initials">{{ $activeUserInitials }}</span>
                    @endif
                </div>

                <div class="sidebar-user-text">
                    <strong>{{ $activeUser->name }}</strong>
                    <span>{{ $activeUser->email }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="sidebar-user-logout-form">
                    @csrf
                    <button type="submit" class="sidebar-user-logout-btn" title="Logout" onclick="event.stopPropagation()">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/></svg>
                    </button>
                </form>
            </div>

            <div class="sidebar-profile-dropdown">
                <a href="{{ \Illuminate\Support\Facades\Route::has('my.account') ? route('my.account') : '#' }}"
                   class="sidebar-profile-link">
                    <i><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"/></svg></i>
                    <span>My Account</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="topbar">
        <div class="content-wrapper">
            @yield('content')
        </div>

        <style>
            /* ================================================= */
            /* FINAL PAGE THEME OVERRIDE - setelah semua page CSS */
            /* ================================================= */

            .content-wrapper,
            .content-wrapper > *,
            .dashboard-overview-page,
            .agent-monitoring-page,
            .threat-detection-page,
            .response-management-page,
            .reports-page,
            .agp-page,
            .tdx-page,
            .brp-page,
            .rpt-page {
                background: transparent !important;
                border: none !important;
                box-shadow: none !important;
                outline: none !important;
            }

            /* LIGHT MODE - fitur nyatu dengan background */
            body.light-mode .dashboard-panel,
            body.light-mode .dashboard-stat-card,
            body.light-mode .agp-summary-card,
            body.light-mode .agp-panel,
            body.light-mode .tdx-summary-card,
            body.light-mode .tdx-panel,
            body.light-mode .brp-filter-panel,
            body.light-mode .brp-summary-card,
            body.light-mode .brp-panel,
            body.light-mode .rpt-hero,
            body.light-mode .rpt-summary-card,
            body.light-mode .rpt-mode-panel,
            body.light-mode .rpt-panel {
                background:
                    radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
                    radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.08), transparent 35%),
                    rgba(255, 255, 255, 0.88) !important;
                border: 1px solid rgba(168, 85, 247, 0.17) !important;
                box-shadow: 0 24px 55px rgba(168, 85, 247, 0.12) !important;
                color: #0f172a !important;
            }

            body.light-mode .dashboard-panel,
            body.light-mode .agp-panel,
            body.light-mode .tdx-panel,
            body.light-mode .brp-panel,
            body.light-mode .rpt-panel {
                backdrop-filter: blur(10px);
            }

            /* DARK MODE - fitur purple dark, beda dari sidebar */
            body.dark-mode .dashboard-panel,
            body.dark-mode .dashboard-stat-card,
            body.dark-mode .agp-summary-card,
            body.dark-mode .agp-panel,
            body.dark-mode .tdx-summary-card,
            body.dark-mode .tdx-panel,
            body.dark-mode .brp-filter-panel,
            body.dark-mode .brp-summary-card,
            body.dark-mode .brp-panel,
            body.dark-mode .rpt-hero,
            body.dark-mode .rpt-summary-card,
            body.dark-mode .rpt-mode-panel,
            body.dark-mode .rpt-panel,
            body.dark .dashboard-panel,
            body.dark .dashboard-stat-card,
            body.dark .agp-summary-card,
            body.dark .agp-panel,
            body.dark .tdx-summary-card,
            body.dark .tdx-panel,
            body.dark .brp-filter-panel,
            body.dark .brp-summary-card,
            body.dark .brp-panel,
            body.dark .rpt-hero,
            body.dark .rpt-summary-card,
            body.dark .rpt-mode-panel,
            body.dark .rpt-panel,
            body.dark-theme .dashboard-panel,
            body.dark-theme .dashboard-stat-card,
            body.dark-theme .agp-summary-card,
            body.dark-theme .agp-panel,
            body.dark-theme .tdx-summary-card,
            body.dark-theme .tdx-panel,
            body.dark-theme .brp-filter-panel,
            body.dark-theme .brp-summary-card,
            body.dark-theme .brp-panel,
            body.dark-theme .rpt-hero,
            body.dark-theme .rpt-summary-card,
            body.dark-theme .rpt-mode-panel,
            body.dark-theme .rpt-panel {
                background:
                    radial-gradient(circle at top right, rgba(217, 70, 239, 0.13), transparent 34%),
                    radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.11), transparent 35%),
                    linear-gradient(135deg, #111827 0%, #1f1737 58%, #241638 100%) !important;
                border: 1px solid rgba(168, 85, 247, 0.28) !important;
                box-shadow: 0 24px 55px rgba(0, 0, 0, 0.20) !important;
                color: #f8fafc !important;
            }

            /* LIGHT TEXT */
            body.light-mode .page-heading h1,
            body.light-mode .panel-header h3,
            body.light-mode .agp-heading h1,
            body.light-mode .agp-panel-header h3,
            body.light-mode .tdx-heading h1,
            body.light-mode .tdx-panel-header h3,
            body.light-mode .brp-heading h1,
            body.light-mode .brp-panel-header h3,
            body.light-mode .rpt-hero h1,
            body.light-mode .rpt-panel-header h3,
            body.light-mode .rpt-mode-panel h3 {
                color: #0f172a !important;
                text-shadow: none !important;
            }

            body.light-mode .page-heading p,
            body.light-mode .panel-header p,
            body.light-mode .agp-heading p,
            body.light-mode .agp-panel-header p,
            body.light-mode .tdx-heading p,
            body.light-mode .tdx-panel-header p,
            body.light-mode .brp-heading p,
            body.light-mode .brp-panel-header p,
            body.light-mode .rpt-hero p,
            body.light-mode .rpt-panel-header p,
            body.light-mode .rpt-mode-panel p {
                color: #64748b !important;
            }

            /* DARK TEXT */
            body.dark-mode .page-heading h1,
            body.dark-mode .panel-header h3,
            body.dark-mode .agp-heading h1,
            body.dark-mode .agp-panel-header h3,
            body.dark-mode .tdx-heading h1,
            body.dark-mode .tdx-panel-header h3,
            body.dark-mode .brp-heading h1,
            body.dark-mode .brp-panel-header h3,
            body.dark-mode .rpt-hero h1,
            body.dark-mode .rpt-panel-header h3,
            body.dark-mode .rpt-mode-panel h3,
            body.dark .page-heading h1,
            body.dark .panel-header h3,
            body.dark .agp-heading h1,
            body.dark .agp-panel-header h3,
            body.dark .tdx-heading h1,
            body.dark .tdx-panel-header h3,
            body.dark .brp-heading h1,
            body.dark .brp-panel-header h3,
            body.dark .rpt-hero h1,
            body.dark .rpt-panel-header h3,
            body.dark .rpt-mode-panel h3,
            body.dark-theme .page-heading h1,
            body.dark-theme .panel-header h3,
            body.dark-theme .agp-heading h1,
            body.dark-theme .agp-panel-header h3,
            body.dark-theme .tdx-heading h1,
            body.dark-theme .tdx-panel-header h3,
            body.dark-theme .brp-heading h1,
            body.dark-theme .brp-panel-header h3,
            body.dark-theme .rpt-hero h1,
            body.dark-theme .rpt-panel-header h3,
            body.dark-theme .rpt-mode-panel h3 {
                color: #ffffff !important;
                text-shadow: 0 5px 18px rgba(15, 23, 42, 0.35) !important;
            }

            body.dark-mode .page-heading p,
            body.dark-mode .panel-header p,
            body.dark-mode .agp-heading p,
            body.dark-mode .agp-panel-header p,
            body.dark-mode .tdx-heading p,
            body.dark-mode .tdx-panel-header p,
            body.dark-mode .brp-heading p,
            body.dark-mode .brp-panel-header p,
            body.dark-mode .rpt-hero p,
            body.dark-mode .rpt-panel-header p,
            body.dark-mode .rpt-mode-panel p,
            body.dark .page-heading p,
            body.dark .panel-header p,
            body.dark .agp-heading p,
            body.dark .agp-panel-header p,
            body.dark .tdx-heading p,
            body.dark .tdx-panel-header p,
            body.dark .brp-heading p,
            body.dark .brp-panel-header p,
            body.dark .rpt-hero p,
            body.dark .rpt-panel-header p,
            body.dark .rpt-mode-panel p,
            body.dark-theme .page-heading p,
            body.dark-theme .panel-header p,
            body.dark-theme .agp-heading p,
            body.dark-theme .agp-panel-header p,
            body.dark-theme .tdx-heading p,
            body.dark-theme .tdx-panel-header p,
            body.dark-theme .brp-heading p,
            body.dark-theme .brp-panel-header p,
            body.dark-theme .rpt-hero p,
            body.dark-theme .rpt-panel-header p,
            body.dark-theme .rpt-mode-panel p {
                color: #cbd5e1 !important;
            }

            /* LIGHT ROWS */
            body.light-mode .agp-health-card,
            body.light-mode .brp-detail-box,
            body.light-mode .brp-history-row,
            body.light-mode .rpt-trend-summary div,
            body.light-mode .rpt-severity-row,
            body.light-mode .rpt-blocked-card,
            body.light-mode .threat-row,
            body.light-mode .severity-row,
            body.light-mode .recent-alert-item,
            body.light-mode .history-alert-row {
                background: linear-gradient(135deg, #ffffff, #fbf5ff) !important;
                border: 1px solid rgba(168, 85, 247, 0.16) !important;
                box-shadow: 0 12px 26px rgba(168, 85, 247, 0.08) !important;
                color: #0f172a !important;
            }

            /* DARK ROWS */
            body.dark-mode .agp-health-card,
            body.dark-mode .brp-detail-box,
            body.dark-mode .brp-history-row,
            body.dark-mode .rpt-trend-summary div,
            body.dark-mode .rpt-severity-row,
            body.dark-mode .rpt-blocked-card,
            body.dark-mode .threat-row,
            body.dark-mode .severity-row,
            body.dark-mode .recent-alert-item,
            body.dark-mode .history-alert-row,
            body.dark .agp-health-card,
            body.dark .brp-detail-box,
            body.dark .brp-history-row,
            body.dark .rpt-trend-summary div,
            body.dark .rpt-severity-row,
            body.dark .rpt-blocked-card,
            body.dark .threat-row,
            body.dark .severity-row,
            body.dark .recent-alert-item,
            body.dark .history-alert-row,
            body.dark-theme .agp-health-card,
            body.dark-theme .brp-detail-box,
            body.dark-theme .brp-history-row,
            body.dark-theme .rpt-trend-summary div,
            body.dark-theme .rpt-severity-row,
            body.dark-theme .rpt-blocked-card,
            body.dark-theme .threat-row,
            body.dark-theme .severity-row,
            body.dark-theme .recent-alert-item,
            body.dark-theme .history-alert-row {
                background: linear-gradient(135deg, #111827, #241638) !important;
                border: 1px solid rgba(168, 85, 247, 0.26) !important;
                box-shadow: 0 12px 26px rgba(0, 0, 0, 0.18) !important;
                color: #ffffff !important;
            }

            /* ================================================= */
/* FINAL DARK BACKGROUND FIX - BIAR GA ADA BATAS HITAM */
/* Paste paling bawah style app-dashboard.blade.php */
/* ================================================= */

/* Background utama dark disamain dengan warna panel/table */
body.dark-mode .main,
body.dark .main,
body.dark-theme .main,
html.dark-mode .main,
html.dark .main,
html.dark-theme .main {
    background:
        radial-gradient(circle at top left, rgba(139, 92, 246, 0.18), transparent 35%),
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.13), transparent 34%),
        linear-gradient(135deg, #111827 0%, #1f1737 55%, #241638 100%) !important;
}

/* Hilangkan background/border wrapper halaman */
body.dark-mode .content-wrapper,
body.dark .content-wrapper,
body.dark-theme .content-wrapper,
body.dark-mode .content-wrapper > *,
body.dark .content-wrapper > *,
body.dark-theme .content-wrapper > *,
body.dark-mode .brp-page,
body.dark .brp-page,
body.dark-theme .brp-page,
body.dark-mode .agp-page,
body.dark .agp-page,
body.dark-theme .agp-page,
body.dark-mode .tdx-page,
body.dark .tdx-page,
body.dark-theme .tdx-page,
body.dark-mode .rpt-page,
body.dark .rpt-page,
body.dark-theme .rpt-page {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Heading jangan punya kotak/background */
body.dark-mode .brp-heading,
body.dark .brp-heading,
body.dark-theme .brp-heading,
body.dark-mode .agp-heading,
body.dark .agp-heading,
body.dark-theme .agp-heading,
body.dark-mode .tdx-heading,
body.dark .tdx-heading,
body.dark-theme .tdx-heading,
body.dark-mode .rpt-heading,
body.dark .rpt-heading,
body.dark-theme .rpt-heading {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Panel fitur dibuat sama dengan background dark utama */
body.dark-mode .dashboard-panel,
body.dark .dashboard-panel,
body.dark-theme .dashboard-panel,
body.dark-mode .dashboard-stat-card,
body.dark .dashboard-stat-card,
body.dark-theme .dashboard-stat-card,
body.dark-mode .brp-filter-panel,
body.dark .brp-filter-panel,
body.dark-theme .brp-filter-panel,
body.dark-mode .brp-summary-card,
body.dark .brp-summary-card,
body.dark-theme .brp-summary-card,
body.dark-mode .brp-panel,
body.dark .brp-panel,
body.dark-theme .brp-panel,
body.dark-mode .agp-summary-card,
body.dark .agp-summary-card,
body.dark-theme .agp-summary-card,
body.dark-mode .agp-panel,
body.dark .agp-panel,
body.dark-theme .agp-panel,
body.dark-mode .tdx-summary-card,
body.dark .tdx-summary-card,
body.dark-theme .tdx-summary-card,
body.dark-mode .tdx-panel,
body.dark .tdx-panel,
body.dark-theme .tdx-panel,
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
body.dark-theme .rpt-panel {
    background:
        radial-gradient(circle at top right, rgba(217, 70, 239, 0.10), transparent 34%),
        radial-gradient(circle at bottom left, rgba(139, 92, 246, 0.08), transparent 35%),
        linear-gradient(135deg, #111827 0%, #1f1737 55%, #241638 100%) !important;
    border: 1px solid rgba(168, 85, 247, 0.22) !important;
    box-shadow: none !important;
}

/* Row/table juga disamain tone-nya */
body.dark-mode .brp-ip-row,
body.dark .brp-ip-row,
body.dark-theme .brp-ip-row,
body.dark-mode .tdx-threat-row,
body.dark .tdx-threat-row,
body.dark-theme .tdx-threat-row,
body.dark-mode .agp-agent-row,
body.dark .agp-agent-row,
body.dark-theme .agp-agent-row,
body.dark-mode .rpt-activity-row,
body.dark .rpt-activity-row,
body.dark-theme .rpt-activity-row {
    background: linear-gradient(135deg, #111827 0%, #1f1737 55%, #241638 100%) !important;
    border: 1px solid rgba(168, 85, 247, 0.22) !important;
    box-shadow: none !important;
}

/* Input/select filter dark biar nyatu */
body.dark-mode input,
body.dark select,
body.dark-theme input,
body.dark-theme select,
body.dark-mode .brp-filter-group input,
body.dark .brp-filter-group input,
body.dark-theme .brp-filter-group input,
body.dark-mode .brp-filter-group select,
body.dark .brp-filter-group select,
body.dark-theme .brp-filter-group select {
    background: #111827 !important;
    border: 1px solid rgba(168, 85, 247, 0.24) !important;
    color: #ffffff !important;
}

/* Sidebar tetap beda: lebih navy/black supaya tidak nyatu dengan fitur */
body.dark-mode .sidebar,
body.dark .sidebar,
body.dark-theme .sidebar {
    background:
        radial-gradient(circle at top left, rgba(79, 70, 229, 0.16), transparent 34%),
        radial-gradient(circle at bottom right, rgba(30, 64, 175, 0.20), transparent 38%),
        linear-gradient(180deg, #020617 0%, #07111f 45%, #0f172a 75%, #111827 100%) !important;
    border-right: 1px solid rgba(99, 102, 241, 0.32) !important;
    box-shadow: 18px 0 60px rgba(2, 6, 23, 0.55) !important;

    
}

/* ================================================= */
/* FIX SIDEBAR DARK MODE - LEBIH TERANG & BEDA DARI BACKGROUND */
/* Paste paling bawah <style> app-dashboard.blade.php */
/* ================================================= */

body.dark-mode .sidebar,
body.dark .sidebar,
body.dark-theme .sidebar,
html.dark-mode .sidebar,
html.dark .sidebar,
html.dark-theme .sidebar {
    background:
        radial-gradient(circle at top left, rgba(236, 72, 153, 0.32), transparent 34%),
        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.45), transparent 36%),
        radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.34), transparent 40%),
        linear-gradient(180deg, #312e81 0%, #5b21b6 42%, #7e22ce 72%, #be185d 100%) !important;
    border-right: 1px solid rgba(216, 180, 254, 0.42) !important;
    box-shadow: 18px 0 60px rgba(126, 34, 206, 0.34) !important;
}

/* Logo biar tetap kontras */
body.dark-mode .sidebar-logo-mark,
body.dark .sidebar-logo-mark,
body.dark-theme .sidebar-logo-mark {
    background: linear-gradient(135deg, #ffffff, #fce7f3) !important;
    color: #7e22ce !important;
    box-shadow: 0 14px 30px rgba(255, 255, 255, 0.18) !important;
}

/* Icon sidebar saat tertutup */
body.dark-mode .sidebar:not(:hover) .nav-item,
body.dark .sidebar:not(:hover) .nav-item,
body.dark-theme .sidebar:not(:hover) .nav-item {
    color: rgba(255, 255, 255, 0.86) !important;
}

/* Menu text saat sidebar dibuka */
body.dark-mode .nav-item,
body.dark .nav-item,
body.dark-theme .nav-item {
    color: rgba(255, 255, 255, 0.82) !important;
}

/* Hover menu */
body.dark-mode .nav-item:hover,
body.dark .nav-item:hover,
body.dark-theme .nav-item:hover {
    background: rgba(255, 255, 255, 0.16) !important;
    color: #ffffff !important;
    box-shadow: 0 14px 32px rgba(255, 255, 255, 0.08) !important;
}

/* Active menu lebih jelas */
body.dark-mode .nav-item.active,
body.dark .nav-item.active,
body.dark-theme .nav-item.active {
    background: rgba(255, 255, 255, 0.24) !important;
    color: #ffffff !important;
    box-shadow: 0 16px 36px rgba(255, 255, 255, 0.12) !important;
}

/* Profile trigger sidebar */
body.dark-mode .sidebar-user-trigger,
body.dark .sidebar-user-trigger,
body.dark-theme .sidebar-user-trigger {
    background: rgba(255, 255, 255, 0.13) !important;
    border: 1px solid rgba(255, 255, 255, 0.18) !important;
    box-shadow: 0 14px 30px rgba(255, 255, 255, 0.08) !important;
}

/* Saat sidebar tertutup, profile icon jangan ada kotak */
body.dark-mode .sidebar:not(:hover) .sidebar-user-trigger,
body.dark .sidebar:not(:hover) .sidebar-user-trigger,
body.dark-theme .sidebar:not(:hover) .sidebar-user-trigger {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

/* Icon profile */
body.dark-mode .sidebar-user-icon,
body.dark .sidebar-user-icon,
body.dark-theme .sidebar-user-icon {
    background: rgba(255, 255, 255, 0.20) !important;
    color: #ffffff !important;
    box-shadow: 0 12px 26px rgba(255, 255, 255, 0.10) !important;
}

/* Text logo dan profile */
body.dark-mode .sidebar-logo-text strong,
body.dark .sidebar-logo-text strong,
body.dark-theme .sidebar-logo-text strong,
body.dark-mode .sidebar-user-text strong,
body.dark .sidebar-user-text strong,
body.dark-theme .sidebar-user-text strong {
    color: #ffffff !important;
}

body.dark-mode .sidebar-logo-text span,
body.dark .sidebar-logo-text span,
body.dark-theme .sidebar-logo-text span,
body.dark-mode .sidebar-user-text span,
body.dark .sidebar-user-text span,
body.dark-theme .sidebar-user-text span,
body.dark-mode .menu-label,
body.dark .menu-label,
body.dark-theme .menu-label {
    color: rgba(255, 255, 255, 0.72) !important;
}

/* Dropdown profile dark, ikut sidebar tapi tetap beda */
body.dark-mode .sidebar-profile-dropdown,
body.dark .sidebar-profile-dropdown,
body.dark-theme .sidebar-profile-dropdown {
    background:
        radial-gradient(circle at top right, rgba(236, 72, 153, 0.26), transparent 34%),
        linear-gradient(135deg, #4c1d95, #6b21a8, #86198f) !important;
    border: 1px solid rgba(255, 255, 255, 0.20) !important;
    box-shadow: 0 24px 60px rgba(76, 29, 149, 0.45) !important;
}

/* Isi dropdown */
body.dark-mode .sidebar-profile-link,
body.dark-mode .sidebar-theme-row,
body.dark .sidebar-profile-link,
body.dark .sidebar-theme-row,
body.dark-theme .sidebar-profile-link,
body.dark-theme .sidebar-theme-row {
    color: rgba(255, 255, 255, 0.88) !important;
}

body.dark-mode .sidebar-profile-link:hover,
body.dark-mode .sidebar-theme-row:hover,
body.dark .sidebar-profile-link:hover,
body.dark .sidebar-theme-row:hover,
body.dark-theme .sidebar-profile-link:hover,
body.dark-theme .sidebar-theme-row:hover {
    background: rgba(255, 255, 255, 0.16) !important;
    color: #ffffff !important;
}

/* ================================================= */
/* MAIN BACKGROUND REDESIGN LOCK — force the new      */
/* neutral --bg-main regardless of theme, overriding  */
/* the older heavy gradient rules defined earlier.    */
/* ================================================= */

.main.main.main,
body.light-mode .main.main.main,
body:not(.dark-mode):not(.dark):not(.dark-theme) .main.main.main,
body.dark-mode .main.main.main,
body.dark .main.main.main,
body.dark-theme .main.main.main,
html.dark-mode .main.main.main,
html.dark .main.main.main,
html.dark-theme .main.main.main {
    background: transparent !important;
}

/* ================================================= */
/* SIDEBAR REDESIGN — fixed dark plum brand color,   */
/* independent of the light/dark content theme.      */
/* ================================================= */

.sidebar.sidebar.sidebar,
body.dark-mode .sidebar.sidebar.sidebar,
body.dark .sidebar.sidebar.sidebar,
body.dark-theme .sidebar.sidebar.sidebar,
html.dark-mode .sidebar.sidebar.sidebar,
html.dark .sidebar.sidebar.sidebar,
html.dark-theme .sidebar.sidebar.sidebar,
body.light-mode .sidebar.sidebar.sidebar,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar.sidebar.sidebar {
    background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-soft) 100%) !important;
    border-right: 1px solid rgba(232, 222, 240, 0.14) !important;
    box-shadow: 18px 0 60px rgba(45, 27, 61, 0.35) !important;
}

.nav-item.nav-item.nav-item,
body.dark-mode .nav-item.nav-item.nav-item,
body.dark .nav-item.nav-item.nav-item,
body.dark-theme .nav-item.nav-item.nav-item,
body.light-mode .nav-item.nav-item.nav-item,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.nav-item.nav-item,
.sidebar:not(:hover) .nav-item.nav-item.nav-item,
body.dark-mode .sidebar:not(:hover) .nav-item.nav-item.nav-item,
body.dark .sidebar:not(:hover) .nav-item.nav-item.nav-item,
body.dark-theme .sidebar:not(:hover) .nav-item.nav-item.nav-item,
.nav-item.nav-item.nav-item i,
body.dark-mode .nav-item.nav-item.nav-item i,
body.dark .nav-item.nav-item.nav-item i,
body.dark-theme .nav-item.nav-item.nav-item i,
body.light-mode .nav-item.nav-item.nav-item i,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.nav-item.nav-item i {
    color: var(--sidebar-text) !important;
}

.nav-item.nav-item.nav-item:hover,
body.dark-mode .nav-item.nav-item.nav-item:hover,
body.dark .nav-item.nav-item.nav-item:hover,
body.dark-theme .nav-item.nav-item.nav-item:hover {
    background: rgba(232, 222, 240, 0.14) !important;
    color: #ffffff !important;
}

.nav-item.nav-item.nav-item.active,
body.dark-mode .nav-item.nav-item.nav-item.active,
body.dark .nav-item.nav-item.nav-item.active,
body.dark-theme .nav-item.nav-item.nav-item.active,
body.light-mode .nav-item.nav-item.nav-item.active,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.nav-item.nav-item.active {
    background: #ffffff !important;
    color: var(--sidebar-bg) !important;
    box-shadow: 0 14px 30px rgba(45, 27, 61, 0.25) !important;
}

.nav-item.nav-item.nav-item.active i,
body.dark-mode .nav-item.nav-item.nav-item.active i,
body.dark .nav-item.nav-item.nav-item.active i,
body.dark-theme .nav-item.nav-item.nav-item.active i,
body.light-mode .nav-item.nav-item.nav-item.active i,
body:not(.dark-mode):not(.dark):not(.dark-theme) .nav-item.nav-item.nav-item.active i {
    color: var(--accent-purple) !important;
}

.sidebar-logo-text strong.sidebar-logo-text-strong,
body.dark-mode .sidebar-logo-text strong,
body.dark .sidebar-logo-text strong,
body.dark-theme .sidebar-logo-text strong,
body.light-mode .sidebar-logo-text strong,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-text strong {
    color: #ffffff !important;
}

body.dark-mode .sidebar-logo-text span,
body.dark .sidebar-logo-text span,
body.dark-theme .sidebar-logo-text span,
body.light-mode .sidebar-logo-text span,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-logo-text span,
body.dark-mode .menu-label,
body.dark .menu-label,
body.dark-theme .menu-label,
body.light-mode .menu-label,
body:not(.dark-mode):not(.dark):not(.dark-theme) .menu-label {
    color: var(--sidebar-text) !important;
    opacity: 0.72;
}

.sidebar-logo-text strong,
.sidebar-logo-text span {
    font-family: var(--font-main) !important;
}

/* Profile card — pinned to the bottom of the sidebar, purple family
   instead of the old neutral grey so it stays inside the sidebar's palette. */
.sidebar-user-menu.sidebar-user-menu {
    position: absolute;
    bottom: 24px;
    left: 0;
    right: 0;
    margin: 0 auto;
}

.sidebar-user-trigger.sidebar-user-trigger,
body.dark-mode .sidebar-user-trigger.sidebar-user-trigger,
body.dark .sidebar-user-trigger.sidebar-user-trigger,
body.dark-theme .sidebar-user-trigger.sidebar-user-trigger,
body.light-mode .sidebar-user-trigger.sidebar-user-trigger,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-trigger.sidebar-user-trigger {
    background: #4A2F5E !important;
    border: 1px solid rgba(232, 222, 240, 0.16) !important;
    box-shadow: 0 14px 30px rgba(45, 27, 61, 0.3) !important;
}

.sidebar:not(:hover) .sidebar-user-trigger.sidebar-user-trigger,
body.dark-mode .sidebar:not(:hover) .sidebar-user-trigger.sidebar-user-trigger,
body.dark .sidebar:not(:hover) .sidebar-user-trigger.sidebar-user-trigger,
body.dark-theme .sidebar:not(:hover) .sidebar-user-trigger.sidebar-user-trigger,
body.light-mode .sidebar:not(:hover) .sidebar-user-trigger.sidebar-user-trigger,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar:not(:hover) .sidebar-user-trigger.sidebar-user-trigger {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

.sidebar-user-icon.sidebar-user-icon,
body.dark-mode .sidebar-user-icon.sidebar-user-icon,
body.dark .sidebar-user-icon.sidebar-user-icon,
body.dark-theme .sidebar-user-icon.sidebar-user-icon,
body.light-mode .sidebar-user-icon.sidebar-user-icon,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-icon.sidebar-user-icon {
    background: rgba(232, 222, 240, 0.18) !important;
    color: #ffffff !important;
    border-radius: 50% !important;
}

.sidebar-user-text strong,
body.dark-mode .sidebar-user-text strong,
body.dark .sidebar-user-text strong,
body.dark-theme .sidebar-user-text strong,
body.light-mode .sidebar-user-text strong,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-text strong {
    color: #ffffff !important;
    font-family: var(--font-main) !important;
}

.sidebar-user-text span,
body.dark-mode .sidebar-user-text span,
body.dark .sidebar-user-text span,
body.dark-theme .sidebar-user-text span,
body.light-mode .sidebar-user-text span,
body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-text span {
    color: var(--sidebar-text) !important;
    font-family: var(--font-main) !important;
}

/* Smooth label reveal — animating to width:auto causes the text to "pop" in
   late instead of fading in with the sidebar's own expand transition, so we
   animate opacity + a generous max-width instead (both are transitionable). */
.nav-item.nav-item span {
    opacity: 0 !important;
    visibility: visible !important;
    width: auto !important;
    max-width: 0;
    overflow: hidden;
    white-space: nowrap;
    transition: opacity 0.28s ease, max-width 0.28s ease !important;
}

.sidebar:hover .nav-item.nav-item span {
    opacity: 1 !important;
    max-width: 160px;
}
        </style>
    </main>

</div>

<script src="{{ asset('js/lox-dashboard.js') }}"></script>

<script>
    // Magic Bento — cursor-follow spotlight glow on any .bento-card.
    // Cards are queried once (not per event) and updates are batched to one
    // per animation frame instead of firing getBoundingClientRect() for
    // every card on every raw mousemove event, which was the main source of
    // jank on pages with many cards.
    (function () {
        let bentoCards = [];
        let pendingEvent = null;
        let ticking = false;

        function refreshBentoCards() {
            bentoCards = Array.prototype.slice.call(document.querySelectorAll('.bento-card'));
        }

        function applySpotlight() {
            ticking = false;
            if (!pendingEvent) return;
            const clientX = pendingEvent.clientX;
            const clientY = pendingEvent.clientY;
            pendingEvent = null;

            for (let i = 0; i < bentoCards.length; i++) {
                const card = bentoCards[i];
                const rect = card.getBoundingClientRect();
                const x = clientX - rect.left;
                const y = clientY - rect.top;

                if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
                    card.style.setProperty('--mx', x + 'px');
                    card.style.setProperty('--my', y + 'px');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', refreshBentoCards);

        document.addEventListener('mousemove', function (e) {
            pendingEvent = e;
            if (!ticking) {
                ticking = true;
                requestAnimationFrame(applySpotlight);
            }
        }, { passive: true });
    })();

    // Animated List — staggered scroll-reveal for .animated-list-item
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.animated-list-item');

        if (!items.length) return;

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        items.forEach(function (item) {
            observer.observe(item);
        });
    });

    // xdr-combo — progressive-enhancement layer that turns any
    // <select class="xdr-filter-select"> into a searchable combobox-style
    // dropdown (vanilla port of the HeroUI ComboBox) without touching the
    // underlying select's id/onchange/data attributes — every existing
    // filter function keeps working untouched, only the chrome changes.
    (function () {
        var registry = [];
        var popovers = [];
        var openState = null;
        var openedAt = 0;

        function closeOpen() {
            if (!openState) return;
            openState.popover.classList.remove('is-visible');
            openState.trigger.classList.remove('is-open');
            openState = null;
        }

        // Belt-and-suspenders: force every OTHER popover closed too, so a
        // stray desync can never leave two dropdowns visibly open at once.
        function closeAllExcept(popover) {
            popovers.forEach(function (entry) {
                if (entry.popover !== popover) {
                    entry.popover.classList.remove('is-visible');
                    entry.trigger.classList.remove('is-open');
                }
            });
        }

        function positionPopover(trigger, popover) {
            var rect = trigger.getBoundingClientRect();
            popover.style.minWidth = Math.max(rect.width, 200) + 'px';
            popover.style.left = Math.min(rect.left, window.innerWidth - 260) + 'px';

            var estHeight = Math.min(280, popover.scrollHeight || 260);
            var top = rect.bottom + 6;

            if (top + estHeight > window.innerHeight && rect.top - estHeight - 6 > 0) {
                top = rect.top - estHeight - 6;
                popover.classList.add('xdr-combo-popover--up');
            } else {
                popover.classList.remove('xdr-combo-popover--up');
            }

            popover.style.top = Math.max(8, top) + 'px';
        }

        function escapeHtml(text) {
            return text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        }

        function buildCombo(select) {
            if (select.dataset.comboEnhanced) return;
            select.dataset.comboEnhanced = '1';

            var wrapper = document.createElement('div');
            wrapper.className = 'xdr-combo';
            select.insertAdjacentElement('afterend', wrapper);

            var trigger = document.createElement('button');
            trigger.type = 'button';
            trigger.className = 'xdr-combo-trigger';
            trigger.innerHTML = '<span class="xdr-combo-trigger-label"></span>' +
                '<svg class="xdr-combo-chevron" viewBox="0 0 16 16" fill="currentColor"><path d="M8 11 3 6h10L8 11Z"/></svg>';
            wrapper.appendChild(trigger);

            var popover = document.createElement('div');
            popover.className = 'xdr-combo-popover';
            popover.innerHTML = '<div class="xdr-combo-search-wrap"><input type="text" class="xdr-combo-search" placeholder="Search..."></div>' +
                '<div class="xdr-combo-list" role="listbox"></div>';
            document.body.appendChild(popover);
            popovers.push({ popover: popover, trigger: trigger });

            var search = popover.querySelector('.xdr-combo-search');
            var list = popover.querySelector('.xdr-combo-list');
            var label = trigger.querySelector('.xdr-combo-trigger-label');

            var entries = Array.prototype.map.call(select.options, function (opt) {
                var item = document.createElement('button');
                item.type = 'button';
                item.className = 'xdr-combo-item';
                item.setAttribute('role', 'option');
                item.innerHTML = '<span>' + escapeHtml(opt.textContent) + '</span>' +
                    '<svg class="xdr-combo-check" viewBox="0 0 16 16" fill="currentColor"><path d="M6.4 12.2 2.6 8.4a1 1 0 1 1 1.4-1.4l2.4 2.4 5.8-5.8a1 1 0 1 1 1.4 1.4l-6.5 6.5a1 1 0 0 1-.7.3.97.97 0 0 1-.7-.3Z"/></svg>';
                item.addEventListener('click', function () {
                    select.value = opt.value;
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                    sync();
                    closeOpen();
                });
                list.appendChild(item);
                return { opt: opt, item: item };
            });

            function sync() {
                var selected = select.options[select.selectedIndex];
                label.textContent = selected ? selected.textContent : '';
                entries.forEach(function (entry) {
                    entry.item.classList.toggle('is-selected', entry.opt.value === select.value);
                });
            }

            function filter(query) {
                var q = query.trim().toLowerCase();
                entries.forEach(function (entry) {
                    entry.item.hidden = !(!q || entry.opt.textContent.toLowerCase().indexOf(q) !== -1);
                });
            }

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                var isOpen = popover.classList.contains('is-visible');
                closeAllExcept(popover);
                if (!isOpen) {
                    popover.classList.add('is-visible');
                    trigger.classList.add('is-open');
                    openState = { popover: popover, trigger: trigger };
                    openedAt = Date.now();
                    search.value = '';
                    filter('');
                    positionPopover(trigger, popover);
                    search.focus();
                } else {
                    popover.classList.remove('is-visible');
                    trigger.classList.remove('is-open');
                    openState = null;
                }
            });

            search.addEventListener('input', function () {
                filter(search.value);
            });

            popover.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            select.classList.add('xdr-combo-native-hidden');
            sync();
            registry.push({ select: select, sync: sync });
        }

        function enhanceAll() {
            document.querySelectorAll('select.xdr-filter-select').forEach(buildCombo);

            document.querySelectorAll('.tdx-reset-btn, .brp-reset-btn, .reset-history-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    setTimeout(function () {
                        registry.forEach(function (entry) { entry.sync(); });
                    }, 0);
                });
            });
        }

        document.addEventListener('click', closeOpen);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeOpen();
        });
        // Only close on scroll happening OUTSIDE the open popover — this
        // used to fire on every scroll unconditionally, which made it
        // impossible to scroll a long option list (it closed itself the
        // instant you tried to scroll it). Also ignore scroll events firing
        // right at open time — clicking a trigger near the viewport edge
        // makes the browser auto-scroll the newly-focused element into full
        // view a few ms later, which used to be misread as "user scrolled
        // away" and closed the popover instantly after it opened.
        window.addEventListener('scroll', function (e) {
            if (openState && !openState.popover.contains(e.target) && (Date.now() - openedAt) > 200) {
                closeOpen();
            }
        }, true);
        window.addEventListener('resize', closeOpen);
        document.addEventListener('DOMContentLoaded', enhanceAll);
    })();

    // xdr-date — progressive-enhancement layer that turns any
    // <input type="date"> into a vanilla port of the shadcn/react-day-picker
    // Calendar, following the exact same pattern as xdr-combo above: the
    // native input stays in the DOM (same id/onchange/value), only the
    // chrome is replaced, so filterAlertHistory()/filterBlockedIp()/
    // filterThreats() keep working untouched.
    (function () {
        var MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'];
        var MONTH_SHORT = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var WEEKDAY_LABELS = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];

        var registry = [];
        var popovers = [];
        var openState = null;
        var openedAt = 0;

        function closeOpen() {
            if (!openState) return;
            openState.popover.classList.remove('is-visible');
            openState.trigger.classList.remove('is-open');
            openState = null;
        }

        function closeAllExcept(popover) {
            popovers.forEach(function (entry) {
                if (entry.popover !== popover) {
                    entry.popover.classList.remove('is-visible');
                    entry.trigger.classList.remove('is-open');
                }
            });
        }

        function positionPopover(trigger, popover) {
            var rect = trigger.getBoundingClientRect();
            popover.style.left = Math.min(rect.left, window.innerWidth - 288) + 'px';

            var estHeight = 340;
            var top = rect.bottom + 6;

            if (top + estHeight > window.innerHeight && rect.top - estHeight - 6 > 0) {
                top = rect.top - estHeight - 6;
                popover.classList.add('xdr-date-popover--up');
            } else {
                popover.classList.remove('xdr-date-popover--up');
            }

            popover.style.top = Math.max(8, top) + 'px';
        }

        function pad(n) {
            return String(n).padStart(2, '0');
        }

        function toISO(date) {
            return date.getFullYear() + '-' + pad(date.getMonth() + 1) + '-' + pad(date.getDate());
        }

        function parseISO(str) {
            if (!str) return null;
            var parts = str.split('-').map(Number);
            if (!parts[0] || !parts[1] || !parts[2]) return null;
            return new Date(parts[0], parts[1] - 1, parts[2]);
        }

        function isSameDay(a, b) {
            return a && b && a.getFullYear() === b.getFullYear() &&
                a.getMonth() === b.getMonth() && a.getDate() === b.getDate();
        }

        function formatDisplay(date) {
            return MONTH_SHORT[date.getMonth()] + ' ' + date.getDate() + ', ' + date.getFullYear();
        }

        function buildDatePicker(input) {
            if (input.dataset.dpEnhanced) return;
            input.dataset.dpEnhanced = '1';

            var wrapper = document.createElement('div');
            wrapper.className = 'xdr-date';
            input.insertAdjacentElement('afterend', wrapper);

            var trigger = document.createElement('button');
            trigger.type = 'button';
            trigger.className = 'xdr-date-trigger';
            trigger.innerHTML = '<svg class="xdr-date-trigger-icon" width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd"/></svg>' +
                '<span class="xdr-date-trigger-label">Pick a date</span>' +
                '<span class="xdr-date-clear" title="Clear"><svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm3.36 12.3a1 1 0 0 1-1.42 1.42L12 13.83l-1.94 1.89a1 1 0 1 1-1.4-1.42L10.59 12.4 8.66 10.46a1 1 0 0 1 1.4-1.42L12 10.97l1.94-1.93a1 1 0 0 1 1.42 1.42L13.41 12.4l1.95 1.9Z"/></svg></span>';
            wrapper.appendChild(trigger);

            var popover = document.createElement('div');
            popover.className = 'xdr-date-popover';
            document.body.appendChild(popover);
            popovers.push({ popover: popover, trigger: trigger });

            var selected = parseISO(input.value);
            var viewDate = selected ? new Date(selected.getFullYear(), selected.getMonth(), 1) : new Date();

            function syncLabel() {
                var labelEl = trigger.querySelector('.xdr-date-trigger-label');
                labelEl.textContent = selected ? formatDisplay(selected) : 'Pick a date';
                trigger.classList.toggle('has-value', !!selected);
            }

            function commit(date) {
                selected = date;
                input.value = toISO(date);
                input.dispatchEvent(new Event('change', { bubbles: true }));
                syncLabel();
            }

            function render() {
                var year = viewDate.getFullYear();
                var month = viewDate.getMonth();
                var firstDay = new Date(year, month, 1);
                var startWeekday = firstDay.getDay();
                var daysInMonth = new Date(year, month + 1, 0).getDate();
                var daysInPrevMonth = new Date(year, month, 0).getDate();
                var today = new Date();

                var html = '<div class="xdr-date-nav">' +
                    '<button type="button" class="xdr-date-nav-btn" data-nav="prev"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M14.5 6 8 12l6.5 6V6Z"/></svg></button>' +
                    '<span class="xdr-date-caption">' + MONTH_NAMES[month] + ' ' + year + '</span>' +
                    '<button type="button" class="xdr-date-nav-btn" data-nav="next"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M9.5 6 16 12l-6.5 6V6Z"/></svg></button>' +
                    '</div>';
                html += '<div class="xdr-date-weekdays">' + WEEKDAY_LABELS.map(function (w) { return '<span>' + w + '</span>'; }).join('') + '</div>';
                html += '<div class="xdr-date-grid">';

                for (var i = startWeekday - 1; i >= 0; i--) {
                    var pd = daysInPrevMonth - i;
                    html += '<button type="button" class="xdr-date-cell outside" data-date="' + toISO(new Date(year, month - 1, pd)) + '">' + pd + '</button>';
                }
                for (var d = 1; d <= daysInMonth; d++) {
                    var cellDate = new Date(year, month, d);
                    var cls = 'xdr-date-cell';
                    if (isSameDay(cellDate, today)) cls += ' today';
                    if (selected && isSameDay(cellDate, selected)) cls += ' selected';
                    html += '<button type="button" class="' + cls + '" data-date="' + toISO(cellDate) + '">' + d + '</button>';
                }
                var totalCells = startWeekday + daysInMonth;
                var remaining = (7 - (totalCells % 7)) % 7;
                for (var nd = 1; nd <= remaining; nd++) {
                    html += '<button type="button" class="xdr-date-cell outside" data-date="' + toISO(new Date(year, month + 1, nd)) + '">' + nd + '</button>';
                }

                html += '</div>';
                html += '<button type="button" class="xdr-date-today-btn">Today</button>';

                popover.innerHTML = html;

                popover.querySelectorAll('[data-nav]').forEach(function (btn) {
                    btn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        viewDate = new Date(year, month + (btn.dataset.nav === 'next' ? 1 : -1), 1);
                        render();
                    });
                });

                popover.querySelectorAll('.xdr-date-cell').forEach(function (cell) {
                    cell.addEventListener('click', function (e) {
                        e.stopPropagation();
                        var date = parseISO(cell.dataset.date);
                        viewDate = new Date(date.getFullYear(), date.getMonth(), 1);
                        commit(date);
                        closeOpen();
                    });
                });

                popover.querySelector('.xdr-date-today-btn').addEventListener('click', function (e) {
                    e.stopPropagation();
                    var t = new Date();
                    viewDate = new Date(t.getFullYear(), t.getMonth(), 1);
                    commit(t);
                    closeOpen();
                });
            }

            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                var isOpen = popover.classList.contains('is-visible');
                closeAllExcept(popover);
                if (!isOpen) {
                    selected = parseISO(input.value);
                    viewDate = selected ? new Date(selected.getFullYear(), selected.getMonth(), 1) : new Date();
                    render();
                    popover.classList.add('is-visible');
                    trigger.classList.add('is-open');
                    positionPopover(trigger, popover);
                    openState = { popover: popover, trigger: trigger };
                    openedAt = Date.now();
                } else {
                    popover.classList.remove('is-visible');
                    trigger.classList.remove('is-open');
                    openState = null;
                }
            });

            trigger.querySelector('.xdr-date-clear').addEventListener('click', function (e) {
                e.stopPropagation();
                selected = null;
                input.value = '';
                input.dispatchEvent(new Event('change', { bubbles: true }));
                syncLabel();
                closeOpen();
            });

            popover.addEventListener('click', function (e) {
                e.stopPropagation();
            });

            input.classList.add('xdr-combo-native-hidden');
            syncLabel();
            registry.push({ input: input, sync: syncLabel });
        }

        function enhanceAll() {
            document.querySelectorAll('input[type="date"]').forEach(buildDatePicker);

            document.querySelectorAll('.tdx-reset-btn, .brp-reset-btn, .reset-history-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    setTimeout(function () {
                        registry.forEach(function (entry) { entry.sync(); });
                    }, 0);
                });
            });
        }

        document.addEventListener('click', closeOpen);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeOpen();
        });
        window.addEventListener('scroll', function (e) {
            // Ignore scroll events firing in the same tick the popover opened —
            // clicking a trigger near the viewport edge makes the browser
            // auto-scroll the newly-focused button into full view a few ms
            // later, which used to be misread as "user scrolled away" and
            // closed the popover instantly after it opened.
            if (openState && !openState.popover.contains(e.target) && (Date.now() - openedAt) > 200) {
                closeOpen();
            }
        }, true);
        window.addEventListener('resize', closeOpen);
        document.addEventListener('DOMContentLoaded', enhanceAll);
    })();

    // xdr-scroll-list — vanilla port of the React Bits AnimatedList's
    // scroll behaviour. Any .xdr-scroll-list-target container with more
    // than 5 direct .animated-list-item rows gets capped to a ~5-row
    // viewport height (measured from real rendered row height, since row
    // size varies a lot between pages) with an internal scrollbar and
    // top/bottom fade gradients that track scroll position. Containers
    // with 5 rows or fewer are left completely untouched.
    (function () {
        var VISIBLE_ITEMS = 5;

        function setupList(container) {
            if (container.dataset.scrollListReady) return;

            var items = container.querySelectorAll(':scope > .animated-list-item');
            if (items.length <= VISIBLE_ITEMS) return;

            container.dataset.scrollListReady = '1';

            var containerRect = container.getBoundingClientRect();
            var targetRect = items[VISIBLE_ITEMS - 1].getBoundingClientRect();
            container.style.maxHeight = (Math.ceil(targetRect.bottom - containerRect.top) + 4) + 'px';
            container.classList.add('xdr-scroll-list');

            var topGradient = document.createElement('div');
            topGradient.className = 'xdr-scroll-gradient xdr-scroll-gradient--top';
            var bottomGradient = document.createElement('div');
            bottomGradient.className = 'xdr-scroll-gradient xdr-scroll-gradient--bottom';
            container.appendChild(topGradient);
            container.appendChild(bottomGradient);

            function updateGradients() {
                var scrollTop = container.scrollTop;
                var scrollHeight = container.scrollHeight;
                var clientHeight = container.clientHeight;
                topGradient.style.opacity = Math.min(scrollTop / 50, 1);
                var bottomDistance = scrollHeight - (scrollTop + clientHeight);
                bottomGradient.style.opacity = scrollHeight <= clientHeight ? 0 : Math.min(bottomDistance / 50, 1);
            }

            container.addEventListener('scroll', updateGradients, { passive: true });
            updateGradients();
        }

        function setupAll() {
            document.querySelectorAll('.xdr-scroll-list-target').forEach(setupList);
        }

        window.addEventListener('load', setupAll);
    })();
</script>

@include('partials.scroll-reveal')

</body>
</html>