@php
    use Illuminate\Support\Facades\Auth;

    $activeUser = Auth::user();
    $activeEmail = $activeUser?->email ?? 'dev@lox.com';

    $roleLabel = match ($activeEmail) {
        'lead@lox.com' => 'Group Leader',
        'webadmin@lox.com' => 'Developer',
        'analyst@lox.com' => 'Security Analyst',
        default => 'Administrator',
    };
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOX Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/lox-dashboard.css') }}">
</head>

<body class="dashboard-enter">


    <div class="app">
    <aside class="sidebar collapsed" id="sidebar">

        <!-- LOGO -->
        <div class="logo">
            <img src="{{ asset('images/lox-logo.png') }}" class="logo-image">
            <div class="logo-text">
                <h2>LOX</h2>
                <p>Low-Overhead XDR</p>
            </div>
        </div>

        <p class="menu-title">MENU</p>

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}"
        class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="nav-icon">⌂</span>
            <span class="nav-text">Dashboard</span>
        </a>

        <!-- AGENT -->
        <a href="{{ route('agent.monitoring') }}"
        class="nav-item {{ request()->routeIs('agent.monitoring') ? 'active' : '' }}">
            <span class="nav-icon">▣</span>
            <span class="nav-text">Agent Monitoring</span>
        </a>

        <!-- EVENT -->
        <a href="{{ route('event.monitoring') }}"
        class="nav-item {{ request()->routeIs('event.monitoring') ? 'active' : '' }}">
            <span class="nav-icon">☷</span>
            <span class="nav-text">Event Monitoring</span>
        </a>

        <!-- ALERT -->
        <a href="{{ route('alert.management') }}"
        class="nav-item {{ request()->routeIs('alert.management') ? 'active' : '' }}">
            <span class="nav-icon">♧</span>
            <span class="nav-text">Alert Management</span>
        </a>

        <!-- THREAT -->
        <a href="{{ route('threat.detection') }}"
        class="nav-item {{ request()->routeIs('threat.detection') ? 'active' : '' }}">
            <span class="nav-icon">◇</span>
            <span class="nav-text">Threat Detection</span>
        </a>

        <!-- INCIDENT -->
        <a href="{{ route('incident.tracking') }}"
        class="nav-item {{ request()->routeIs('incident.tracking') ? 'active' : '' }}">
            <span class="nav-icon">▤</span>
            <span class="nav-text">Incident Tracking</span>
        </a>

        <!-- RESPONSE -->
        <a href="{{ route('response.management') }}"
        class="nav-item {{ request()->routeIs('response.management') ? 'active' : '' }}">
            <span class="nav-icon">⛨</span>
            <span class="nav-text">Response Management</span>
        </a>

        <!-- ANALYTICS -->
        <a href="{{ route('analytics') }}"
        class="nav-item {{ request()->routeIs('analytics') ? 'active' : '' }}">
            <span class="nav-icon">▥</span>
            <span class="nav-text">Analytics & Reports</span>
        </a>

        <!-- THEME TOGGLE (FIXED ON/OFF SWITCH) -->
<div class="theme-switch-container">
    <label class="onoff-switch">
        <input type="checkbox" id="themeSwitch" onchange="toggleThemeSwitch()">
        <span class="onoff-slider">
            <span class="switch-ball"></span>
        </span>
    </label>
</div>
    </aside>
        <main class="main">
            <div class="topbar">
                <div class="page-title">
                    <h1>@yield('title')</h1>
                    <p>@yield('subtitle')</p>
                </div>

                <div class="top-actions">
                    <div class="search-box">
                        <span>⌕</span>
                        <input type="text" placeholder="Search...">
                    </div>

                    <div class="notification-wrapper">
                        <button class="icon-btn notification-btn" onclick="toggleNotificationMenu()">
                            🔔
                            <span class="notification-dot"></span>
                        </button>

                        <div class="notification-menu" id="notificationMenu">
                            <div class="dropdown-header">
                                <h4>Notifications</h4>
                                <span>3 New</span>
                            </div>

                            <div class="notification-item danger">
                                <strong>Anomaly Attack Detected</strong>
                                <p>Unusual login pattern detected from endpoint agent.</p>
                                <small>2 minutes ago</small>
                            </div>

                            <div class="notification-item warning">
                                <strong>Brute Force Attempt</strong>
                                <p>Multiple failed login attempts were recorded.</p>
                                <small>10 minutes ago</small>
                            </div>

                            <div class="notification-item info">
                                <strong>Agent Status Changed</strong>
                                <p>Endpoint agent returned to active monitoring.</p>
                                <small>25 minutes ago</small>
                            </div>

                            <button class="dropdown-footer">View all notifications</button>
                        </div>
                    </div>

                    <div class="profile-wrapper">
                        <div class="user-profile">
                            <div class="avatar"></div>
                            <div>
                                <h4>{{ $roleLabel }}</h4>
                                <p>{{ $activeEmail }}</p>
                            </div>
                        </div>

                        <div class="profile-menu">
                            <div class="profile-card">
                                <div class="avatar small-avatar"></div>
                                <div>
                                    <h4>{{ $roleLabel }}</h4>
                                    <p>{{ $activeEmail }}</p>
                                </div>
                            </div>

                            <a href="#">My Account</a>

                            <hr>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-button">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/lox-dashboard.js') }}"></script>

<script>
function toggleThemeSwitch() {
    const body = document.body;

    body.classList.toggle("dark");

    // simpan status theme
    if (body.classList.contains("dark")) {
        localStorage.setItem("theme", "dark");
    } else {
        localStorage.setItem("theme", "light");
    }
}

// auto load theme saat halaman dibuka
window.onload = function () {
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark");

        // sync toggle UI
        const toggle = document.getElementById("themeSwitch");
        if (toggle) toggle.checked = true;
    }
};
</script>
</body>
</html>