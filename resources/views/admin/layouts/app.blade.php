<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Shades of Texas</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar (Desktop Only)-->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                    SHADES<span class="light-text">OFTEXAS</span>
                    <span class="admin-badge">ADMIN</span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="icon">📊</span>
                    Dashboard
                </a>
                <a href="{{ route('admin.appointments.index') }}" class="nav-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <span class="icon">📅</span>
                    Appointments
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="badge">{{ $pendingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <span class="icon">✉️</span>
                    Messages
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="badge">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="nav-item {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                    <span class="icon">📈</span>
                    Analytics
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <span class="icon">⚙️</span>
                    Settings
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <div class="admin-name">{{ Auth::guard('admin')->user()->name }}</div>
                    <div class="admin-role">{{ ucfirst(Auth::guard('admin')->user()->role) }}</div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Mobile Hamburger and Drawer -->
        <div class="mobile-header">
            <button id="mobileMenuBtn" class="mobile-menu-btn" aria-label="Open Menu">
                &#9776;
            </button>
            <div class="mobile-header-title">
                @yield('page-title', 'Dashboard')
            </div>
        </div>
        <nav id="mobileNavDrawer" class="mobile-nav-drawer">
            <div class="mobile-nav-header">
                <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                    SHADES<span class="light-text">OFTEXAS</span>
                    <span class="admin-badge">ADMIN</span>
                </a>
                <button id="closeMobileNav" aria-label="Close Menu">&times;</button>
            </div>
            <div class="mobile-nav-links">
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="icon">📊</span> Dashboard
                </a>
                <a href="{{ route('admin.appointments.index') }}" class="nav-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <span class="icon">📅</span> Appointments
                    @if(isset($pendingCount) && $pendingCount > 0)
                        <span class="badge">{{ $pendingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.messages.index') }}" class="nav-item {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <span class="icon">✉️</span> Messages
                    @if(isset($unreadCount) && $unreadCount > 0)
                        <span class="badge">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="nav-item {{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}">
                    <span class="icon">📈</span> Analytics
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <span class="icon">⚙️</span> Settings
                </a>
            </div>
            <div class="mobile-nav-footer">
                <div class="admin-info">
                    <div class="admin-name">{{ Auth::guard('admin')->user()->name }}</div>
                    <div class="admin-role">{{ ucfirst(Auth::guard('admin')->user()->role) }}</div>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </nav>
        <div id="mobileNavOverlay" class="mobile-nav-overlay"></div>
        <!-- End Mobile Hamburger and Drawer -->

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Desktop header below, hidden on mobile. Mobile header is above. -->
            <header class="admin-header">
                <div class="header-left">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="header-right">
                    @yield('header-actions')
                </div>
            </header>

            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    <!-- Simple JavaScript for toggling mobile nav -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let mobileMenuBtn = document.getElementById('mobileMenuBtn');
        let mobileNavDrawer = document.getElementById('mobileNavDrawer');
        let mobileNavOverlay = document.getElementById('mobileNavOverlay');
        let closeMobileNav = document.getElementById('closeMobileNav');

        function openMobileNav() {
            mobileNavDrawer.classList.add('open');
            mobileNavOverlay.classList.add('show');
            document.body.classList.add('no-scroll');
        }
        function closeMobileNavFunc() {
            mobileNavDrawer.classList.remove('open');
            mobileNavOverlay.classList.remove('show');
            document.body.classList.remove('no-scroll');
        }

        mobileMenuBtn && mobileMenuBtn.addEventListener('click', openMobileNav);
        closeMobileNav && closeMobileNav.addEventListener('click', closeMobileNavFunc);
        mobileNavOverlay && mobileNavOverlay.addEventListener('click', closeMobileNavFunc);
    });
    </script>
</body>
</html>