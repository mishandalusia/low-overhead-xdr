<!DOCTYPE html>
<html lang="en" class="light-mode">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOX Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&family=Roboto+Condensed:wght@500;600;700;800;900&family=Roboto+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;800&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/lox-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: 'Inter', 'Poppins', system-ui, sans-serif;
        }

        body {
            background: #f8f3ff;
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
            margin-left: 86px;
            width: calc(100% - 86px);
            min-height: 100vh;
            padding: 36px 42px 46px;
            overflow: visible;
            transition: 0.25s ease;
            background:
                radial-gradient(circle at top left, rgba(168, 85, 247, 0.18), transparent 35%),
                radial-gradient(circle at top right, rgba(236, 72, 153, 0.18), transparent 34%),
                radial-gradient(circle at bottom right, rgba(96, 165, 250, 0.18), transparent 36%),
                linear-gradient(135deg, #f8f3ff 0%, #fde7f7 48%, #e0f2fe 100%) !important;
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
            gap: 12px;
            cursor: pointer;
            transition: 0.22s ease;
        }

        .sidebar:hover .sidebar-user-trigger {
            justify-content: flex-start;
            padding: 10px 12px;
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
            border-radius: 15px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: linear-gradient(135deg, #8b5cf6, #d946ef, #ec4899);
            box-shadow: 0 12px 26px rgba(217, 70, 239, 0.28);
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

        .sidebar-user-arrow {
            font-size: 11px;
            opacity: 0;
            visibility: hidden;
            transition: 0.22s ease;
        }

        .sidebar:hover .sidebar-user-arrow {
            opacity: 1;
            visibility: visible;
        }

        .sidebar-user-menu:hover .sidebar-user-arrow {
            transform: rotate(90deg);
        }

        body.light-mode .sidebar-user-arrow,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-user-arrow {
            color: #7c3aed;
        }

        body.dark-mode .sidebar-user-arrow,
        body.dark .sidebar-user-arrow,
        body.dark-theme .sidebar-user-arrow {
            color: rgba(226, 232, 240, 0.72);
        }

        .sidebar-profile-dropdown {
            position: absolute;
            left: 0;
            top: calc(100% + 2px);
            width: 100%;
            min-width: 230px;
            padding: 14px;
            border-radius: 22px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-4px);
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

        .sidebar-profile-link,
        .sidebar-theme-row,
        .sidebar-profile-logout {
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

        .sidebar-theme-row {
            justify-content: space-between;
        }

        .sidebar-theme-row > div {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        body.light-mode .sidebar-profile-link,
        body.light-mode .sidebar-theme-row,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-link,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-theme-row {
            color: #2e1065;
        }

        body.light-mode .sidebar-profile-link:hover,
        body.light-mode .sidebar-theme-row:hover,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-profile-link:hover,
        body:not(.dark-mode):not(.dark):not(.dark-theme) .sidebar-theme-row:hover {
            background: rgba(243, 232, 255, 0.90);
            color: #7c3aed;
        }

        body.dark-mode .sidebar-profile-link,
        body.dark-mode .sidebar-theme-row,
        body.dark .sidebar-profile-link,
        body.dark .sidebar-theme-row,
        body.dark-theme .sidebar-profile-link,
        body.dark-theme .sidebar-theme-row {
            color: #e5e7eb;
        }

        body.dark-mode .sidebar-profile-link:hover,
        body.dark-mode .sidebar-theme-row:hover,
        body.dark .sidebar-profile-link:hover,
        body.dark .sidebar-theme-row:hover,
        body.dark-theme .sidebar-profile-link:hover,
        body.dark-theme .sidebar-theme-row:hover {
            background: rgba(99, 102, 241, 0.20);
            color: #ffffff;
        }

        .sidebar-profile-logout {
            cursor: pointer;
            color: #ef4444;
        }

        body.dark-mode .sidebar-profile-logout,
        body.dark .sidebar-profile-logout,
        body.dark-theme .sidebar-profile-logout {
            color: #fb7185;
        }

        .sidebar-profile-logout:hover {
            background: rgba(239, 68, 68, 0.12);
        }

        .sidebar-theme-switch {
            position: relative;
            width: 48px;
            height: 26px;
            flex-shrink: 0;
        }

        .sidebar-theme-switch input {
            display: none;
        }

        .sidebar-theme-switch span {
            position: absolute;
            inset: 0;
            border-radius: 999px;
            cursor: pointer;
            background: rgba(148, 163, 184, 0.35);
            transition: 0.2s ease;
        }

        .sidebar-theme-switch span::before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 3px;
            left: 3px;
            border-radius: 50%;
            background: #ffffff;
            transition: 0.2s ease;
        }

        .sidebar-theme-switch input:checked + span {
            background: linear-gradient(135deg, #8b5cf6, #d946ef);
        }

        .sidebar-theme-switch input:checked + span::before {
            transform: translateX(22px);
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
    font-family: 'Sora', system-ui, sans-serif !important;
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
    font-family: 'Space Grotesk', system-ui, sans-serif !important;
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
    font-family: 'Manrope', system-ui, sans-serif !important;
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
    font-family: 'Manrope', system-ui, sans-serif !important;
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

/* ROW / TABLE */
body.light-mode .threat-row,
body.light-mode .severity-row,
body.light-mode .recent-alert-item,
body.light-mode .history-alert-row,
body.light-mode .agp-agent-row,
body.light-mode .agp-health-card,
body.light-mode .tdx-threat-row,
body.light-mode .brp-ip-row,
body.light-mode .brp-detail-box,
body.light-mode .brp-history-row,
body.light-mode .rpt-activity-row,
body.light-mode .rpt-blocked-card,
body.light-mode .rpt-trend-summary div,
body.light-mode .rpt-severity-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .threat-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .severity-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .recent-alert-item,
body:not(.dark-mode):not(.dark):not(.dark-theme) .history-alert-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .agp-agent-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .agp-health-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .tdx-threat-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-ip-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-detail-box,
body:not(.dark-mode):not(.dark):not(.dark-theme) .brp-history-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-activity-row,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-blocked-card,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-trend-summary div,
body:not(.dark-mode):not(.dark):not(.dark-theme) .rpt-severity-row {
    background: rgba(255, 255, 255, 0.68) !important;
    border: 1px solid rgba(180, 148, 255, 0.18) !important;
    box-shadow: 0 12px 28px rgba(155, 92, 246, 0.08) !important;
    color: #1f2440 !important;
}

/* ROW VARIATION SOFT */
body.light-mode .brp-ip-row:nth-child(odd),
body.light-mode .rpt-activity-row:nth-child(odd),
body.light-mode .tdx-threat-row:nth-child(odd),
body.light-mode .agp-agent-row:nth-child(odd) {
    background: rgba(255, 244, 250, 0.74) !important;
}

body.light-mode .brp-ip-row:nth-child(even),
body.light-mode .rpt-activity-row:nth-child(even),
body.light-mode .tdx-threat-row:nth-child(even),
body.light-mode .agp-agent-row:nth-child(even) {
    background: rgba(240, 235, 255, 0.72) !important;
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

/* ICON BOX */
body.light-mode .device-icon,
body.light-mode .ip-icon,
body.light-mode .tdx-summary-icon,
body.light-mode .agp-summary-icon,
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
    font-family: 'Roboto', system-ui, sans-serif !important;
}

/* Judul utama halaman */
h1,
.page-heading h1,
.brp-heading h1,
.agp-heading h1,
.tdx-heading h1,
.rpt-hero h1 {
    font-family: 'Roboto Condensed', system-ui, sans-serif !important;
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
    font-family: 'Roboto Condensed', system-ui, sans-serif !important;
    font-weight: 800 !important;
    letter-spacing: -0.45px !important;
}

/* Menu sidebar */
.nav-item,
.nav-item span,
.sidebar-logo-text strong,
.sidebar-user-text strong {
    font-family: 'Roboto Condensed', system-ui, sans-serif !important;
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
    font-family: 'Roboto', system-ui, sans-serif !important;
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
    font-family: 'Roboto Mono', monospace !important;
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
    font-family: 'Roboto Mono', monospace !important;
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
    font-family: 'Roboto Condensed', system-ui, sans-serif !important;
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
    font-family: 'Roboto Condensed', system-ui, sans-serif !important;
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
    font-family: 'Roboto', system-ui, sans-serif !important;
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
    font-family: 'Roboto', system-ui, sans-serif !important;
    font-style: normal !important;
    font-weight: 500 !important;
}

/* Logo text lebih tegas */
.sidebar-logo-text strong {
    font-size: 25px !important;
    font-style: normal !important;
}

.sidebar-logo-text span {
    font-family: 'Roboto', system-ui, sans-serif !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    font-style: italic !important;
}
    </style>
</head>

<body class="light-mode">
@php
    $activeUser = session('active_user', [
        'name' => 'Administrator',
        'email' => 'dev@lox.com',
        'role' => 'Web Developer',
    ]);
@endphp

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
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('agent.monitoring') }}"
               class="nav-item {{ request()->routeIs('agent.monitoring') ? 'active' : '' }}">
                <i class="fa-regular fa-square"></i>
                <span>Agent Monitoring</span>
            </a>

            <a href="{{ route('threat.detection') }}"
               class="nav-item {{ request()->routeIs('threat.detection') ? 'active' : '' }}">
                <i class="fa-regular fa-gem"></i>
                <span>Threat Detection</span>
            </a>

            <a href="{{ route('response.management') }}"
               class="nav-item {{ request()->routeIs('response.management') ? 'active' : '' }}">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Blocked IP</span>
            </a>

            <a href="{{ route('analytics') }}"
               class="nav-item {{ request()->routeIs('analytics') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-column"></i>
                <span>Reports</span>
            </a>
        </nav>

        <div class="sidebar-user-menu">
            <div class="sidebar-user-trigger">
                <div class="sidebar-user-icon">
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="sidebar-user-text">
                    <strong>{{ $activeUser['name'] }}</strong>
                    <span>{{ $activeUser['email'] }}</span>
                </div>

                <i class="fa-solid fa-chevron-right sidebar-user-arrow"></i>
            </div>

            <div class="sidebar-profile-dropdown">
                <a href="{{ \Illuminate\Support\Facades\Route::has('my.account') ? route('my.account') : '#' }}"
                   class="sidebar-profile-link">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>My Account</span>
                </a>

                <div class="sidebar-theme-row">
                    <div>
                        <i class="fa-solid fa-moon"></i>
                        <span>Dark Mode</span>
                    </div>

                    <label class="sidebar-theme-switch">
                        <input type="checkbox" id="sidebarThemeSwitch">
                        <span></span>
                    </label>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-profile-logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
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
        </style>
    </main>

</div>

<script src="{{ asset('js/lox-dashboard.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const switcher = document.getElementById('sidebarThemeSwitch');

        function applyTheme(mode) {
            const isDark = mode === 'dark';

            document.documentElement.classList.toggle('dark-mode', isDark);
            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.classList.toggle('dark-theme', isDark);
            document.documentElement.classList.toggle('light-mode', !isDark);

            document.body.classList.toggle('dark-mode', isDark);
            document.body.classList.toggle('dark', isDark);
            document.body.classList.toggle('dark-theme', isDark);
            document.body.classList.toggle('light-mode', !isDark);

            const app = document.querySelector('.app');

            if (app) {
                app.classList.toggle('dark-mode', isDark);
                app.classList.toggle('dark', isDark);
                app.classList.toggle('dark-theme', isDark);
                app.classList.toggle('light-mode', !isDark);
            }

            localStorage.setItem('lox_theme', mode);
            localStorage.setItem('theme', mode);
            localStorage.setItem('color-theme', mode);

            if (switcher) {
                switcher.checked = isDark;
            }

            window.dispatchEvent(new Event('storage'));
        }

        const savedTheme =
            localStorage.getItem('lox_theme') ||
            localStorage.getItem('theme') ||
            localStorage.getItem('color-theme') ||
            'light';

        applyTheme(savedTheme === 'dark' ? 'dark' : 'light');

        if (switcher) {
            switcher.addEventListener('change', function () {
                applyTheme(this.checked ? 'dark' : 'light');
            });
        }
    });
</script>

</body>
</html>