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
        <!-- Sidebar -->
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

        <!-- Main Content -->
        <main class="admin-main">
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

            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Page Content -->
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
