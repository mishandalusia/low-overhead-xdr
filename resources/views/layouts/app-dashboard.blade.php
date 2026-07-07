@php
    use Illuminate\Support\Facades\Auth;

    $activeUser = Auth::user();

    $roleLabel = match ($activeUser->email) {
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
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/lox-logo.png') }}" class="logo-image" alt="LOX Logo">

                <div class="logo-text">
                    <h2>LOX</h2>
                    <p>Low-Overhead XDR</p>
                </div>
            </div>

            <p class="menu-title">Menu</p>

            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon">⌂</span>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="{{ route('agent.monitoring') }}" class="nav-link {{ request()->routeIs('agent.monitoring') ? 'active' : '' }}">
                <span class="nav-icon">▣</span>
                <span class="nav-text">Agent Monitoring</span>
            </a>

            <a href="{{ route('threat.detection') }}" class="nav-link {{ request()->routeIs('threat.detection') ? 'active' : '' }}">
                <span class="nav-icon">◇</span>
                <span class="nav-text">Threat Detection</span>
            </a>

            <a href="{{ route('alert.management') }}" class="nav-link {{ request()->routeIs('alert.management') ? 'active' : '' }}">
                <span class="nav-icon">♧</span>
                <span class="nav-text">Alert Management</span>
            </a>

            <a href="{{ route('incident.tracking') }}" class="nav-link {{ request()->routeIs('incident.tracking') ? 'active' : '' }}">
                <span class="nav-icon">▤</span>
                <span class="nav-text">Incident Tracking</span>
            </a>

            <a href="{{ route('response.management') }}" class="nav-link {{ request()->routeIs('response.management') ? 'active' : '' }}">
                <span class="nav-icon">⛨</span>
                <span class="nav-text">Response Management</span>
            </a>

            <a href="{{ route('analytics') }}" class="nav-link {{ request()->routeIs('analytics') ? 'active' : '' }}">
                <span class="nav-icon">▥</span>
                <span class="nav-text">Analytics</span>
            </a>

            <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                <span class="nav-icon">⚙</span>
                <span class="nav-text">Settings</span>
            </a>

            <p class="menu-title">Support</p>

            <a href="#" class="nav-link">
                <span class="nav-icon">☰</span>
                <span class="nav-text">Documentation</span>
            </a>

            <a href="#" class="nav-link">
                <span class="nav-icon">?</span>
                <span class="nav-text">Help Center</span>
            </a>

            <a href="#" class="nav-link">
                <span class="nav-icon">✎</span>
                <span class="nav-text">Feedback</span>
            </a>

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
<div class="user-profile flex items-center gap-3">

<!-- AVATAR PROFIL -->
@if($activeUser->avatar)
    <img src="{{ asset('storage/avatars/'.$activeUser->avatar) }}"
         class="w-10 h-10 rounded-full object-cover border border-white shadow">
@else
    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 via-pink-500 to-purple-700 flex items-center justify-center text-white font-bold shadow">
        {{ strtoupper(substr($activeUser->name ?? 'U', 0, 1)) }}
    </div>
@endif

    <!-- INFO USER -->
    <div>
        <h4 class="font-semibold text-sm text-gray-800">
            {{ $roleLabel }}
        </h4>
        <p class="text-xs text-gray-500">
            {{ $activeUser->email }}
        </p>
    </div>

</div>

        <div class="profile-menu">
            <div class="profile-card">
                <div class="avatar small-avatar"></div>
                <div>
                    <h4>{{ $roleLabel }}</h4>
                    <p>{{ $activeUser->email }}</p>
                </div>
            </div>

            <a href="{{ route('my.account') }}">My Account</a>


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
</body>
</html>