<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AlSafa') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    @if(app()->getLocale() == 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-mini-width: 70px;
            --primary-color: #0d6efd;
            --primary-gradient: linear-gradient(135deg, #0d6efd, #0099ff);
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        
        .wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin 0.3s ease;
            padding: 1rem;
        }
        
        [dir="rtl"] .content {
            margin-left: 0;
            margin-right: var(--sidebar-width);
        }
        
        .content.expanded {
            margin-left: var(--sidebar-mini-width);
        }
        
        [dir="rtl"] .content.expanded {
            margin-left: 0;
            margin-right: var(--sidebar-mini-width);
        }
        
        @media (max-width: 991.98px) {
            .content {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
        }
        
        .top-navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        
        .language-switcher .btn-group {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        /* Sidebar Styles */
        /* Desktop Sidebar */
        @media (min-width: 992px) {
            .sidebar {
                width: var(--sidebar-width, 280px);
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                background: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                z-index: 1040;
                overflow-y: auto;
            }

            .sidebar.collapsed {
                width: 70px;
            }

            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .logo-container h5,
            .sidebar.collapsed .text-muted {
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, visibility 0.2s ease;
            }

            .sidebar.collapsed .nav-link {
                text-align: center;
                padding: 0.75rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar.collapsed .nav-link i {
                margin: 0 !important;
                font-size: 1.2rem;
                width: auto !important;
                transition: margin 0.3s ease;
            }

            .sidebar.collapsed .sidebar-header {
                justify-content: center;
                padding: 1rem;
            }

            .sidebar.collapsed .logo-container {
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, visibility 0.2s ease;
            }

            /* RTL Support */
            [dir="rtl"] .sidebar {
                right: 0;
                left: auto;
            }

            [dir="rtl"] .sidebar .nav-link i {
                margin-left: 0.5rem;
                margin-right: 0;
            }

            [dir="rtl"] .content {
                margin-right: var(--sidebar-width, 280px);
                margin-left: 0;
                transition: margin-right 0.3s ease;
            }

            [dir="rtl"] .content.expanded {
                margin-right: 70px;
            }
        }

        /* Mobile Dropdown */
        @media (max-width: 991.98px) {
            .sidebar {
                position: absolute;
                top: 100%;
                left: 0;
                width: 100% !important;
                height: auto;
                max-height: calc(100vh - 60px);
                background: #fff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transform: translateY(-10px);
                opacity: 0;
                visibility: hidden;
                transition: all 0.2s ease;
                overflow-y: auto;
                border-radius: 0 0 8px 8px;
            }

            .sidebar.show {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .sidebar .sidebar-header {
                display: none;
            }

            .sidebar .nav-link {
                padding: 0.75rem 1.5rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .sidebar .nav-link:last-child {
                border-bottom: none;
            }
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .logo-container h5,
        .sidebar.collapsed .text-muted {
            display: none;
        }

        .sidebar.collapsed .nav-link {
            text-align: center;
            padding: 0.75rem;
        }

        .sidebar.collapsed .nav-link i {
            margin: 0 !important;
            font-size: 1.2rem;
            width: auto !important;
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 1rem;
        }

        .sidebar.collapsed .logo-container {
            display: none !important;
        }

        @media (max-width: 991.98px) {
            .sidebar.collapsed {
                width: 280px !important;
            }

            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .logo-container h5,
            .sidebar.collapsed .text-muted {
                display: block !important;
            }

            .sidebar.collapsed .nav-link {
                text-align: start;
                padding: 0.75rem 1rem;
            }

            .sidebar.collapsed .nav-link i {
                margin-right: 0.5rem !important;
                width: 1.5rem !important;
            }

            [dir="rtl"] .sidebar.collapsed .nav-link i {
                margin-right: 0 !important;
                margin-left: 0.5rem !important;
            }

            .sidebar.collapsed .sidebar-header {
                justify-content: space-between;
            }

            .sidebar.collapsed .logo-container {
                display: flex !important;
            }
        }

        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
            box-shadow: -2px 0 5px rgba(0,0,0,.1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-mini-width);
        }

        .sidebar-header {
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0,0,0,.1);
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(13, 110, 253, 0.1);
        }

        .sidebar .nav-link i {
            width: 1.5rem;
            text-align: center;
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }

        [dir="rtl"] .sidebar .nav-link i {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        .sidebar.collapsed .nav-link span,
        .sidebar.collapsed .logo-container h5 {
            display: none;
        }

        .sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,.5);
            z-index: 1039;
            display: none;
        }

        .sidebar-backdrop.show {
            display: block;
        }

        /* Toggle Button */
        @media (min-width: 992px) {
            .toggle-sidebar {
                background: transparent;
                border: none;
                color: #6c757d;
                width: 32px;
                height: 32px;
                border-radius: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                position: absolute;
                right: -16px;
                top: 1rem;
                z-index: 1050;
            }

            [dir="rtl"] .toggle-sidebar {
                left: -16px;
                right: auto;
            }

            .toggle-sidebar:hover {
                color: var(--primary-color);
                background: #fff;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }

            .toggle-sidebar i {
                transition: transform 0.3s ease;
            }

            .sidebar.collapsed .toggle-sidebar {
                transform: translateX(50%);
            }

            [dir="rtl"] .sidebar.collapsed .toggle-sidebar {
                transform: translateX(-50%);
            }
        }

        @media (max-width: 991.98px) {
            .toggle-sidebar {
                display: none;
            }
        }

        [dir="rtl"] .toggle-sidebar {
            right: auto;
            left: -16px;
        }

        .toggle-sidebar:hover {
            background: var(--primary-color, #0d6efd);
            color: #fff;
        }

        .toggle-sidebar i {
            font-size: 1rem;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .sidebar.collapsed .toggle-sidebar i {
            transform: rotate(180deg);
        }

        [dir="rtl"] .sidebar.collapsed .toggle-sidebar i {
            transform: rotate(-180deg);
            }
            
            .content.expanded {
                margin-left: var(--sidebar-mini-width);
            }
            
            [dir="rtl"] .content.expanded {
                margin-left: 0;
                margin-right: var(--sidebar-mini-width);
            }
            
            @media (max-width: 991.98px) {
                .content {
                    margin-left: 0 !important;
                    margin-right: 0 !important;
                }
            }
            
            .top-navbar {
                background-color: white;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
                margin-bottom: 1.5rem;
                border-radius: 0.5rem;
            }
            
            .language-switcher .btn-group {
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
            }
            
            /* Sidebar Styles */
            .sidebar {
                width: var(--sidebar-width, 280px);
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                background: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                z-index: 1040;
                overflow-y: auto;
            }

            .sidebar.collapsed {
                width: 70px;
            }

            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .logo-container h5,
            .sidebar.collapsed .text-muted {
                display: none;
            }

            .sidebar.collapsed .nav-link {
                text-align: center;
                padding: 0.5rem;
            }

            .sidebar.collapsed .nav-link i {
                margin: 0;
                font-size: 1.2rem;
            }

            .sidebar.collapsed .sidebar-header {
                justify-content: center;
                padding: 1rem 0;
            }

            .sidebar.collapsed .logo-container {
                display: none !important;
            }

            [dir="rtl"] .sidebar {
                left: auto;
                right: 0;
                box-shadow: -2px 0 5px rgba(0,0,0,.1);
            }

            .sidebar.collapsed {
                width: var(--sidebar-mini-width);
            }

            .sidebar-header {
                padding: 1rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid rgba(0,0,0,.1);
            }

            .sidebar .nav-link {
                display: flex;
                align-items: center;
                padding: 0.75rem 1rem;
                color: #6c757d;
                transition: all 0.3s ease;
            }

            .sidebar .nav-link:hover,
            .sidebar .nav-link.active {
                color: var(--primary-color);
                background-color: rgba(13, 110, 253, 0.1);
            }

            .sidebar .nav-link i {
                width: 1.5rem;
                text-align: center;
                margin-right: 0.5rem;
                font-size: 1.1rem;
            }

            [dir="rtl"] .sidebar .nav-link i {
                margin-right: 0;
                margin-left: 0.5rem;
            }

            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .logo-container h5 {
                display: none;
            }

            .sidebar-backdrop {
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,.5);
                z-index: 1039;
                display: none;
            }

            .sidebar-backdrop.show {
                display: block;
            }

            /* Toggle Button */
            .toggle-sidebar {
                background: transparent;
                border: none;
                color: #6c757d;
                width: 32px;
                height: 32px;
                border-radius: 4px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            [dir="rtl"] .toggle-sidebar {
                right: auto;
                left: -16px;
            }

            .toggle-sidebar:hover {
                background: var(--primary-color, #0d6efd);
                color: #fff;
            }

            .toggle-sidebar i {
                font-size: 1rem;
                transition: transform 0.3s ease;
                display: inline-block;
            }

            .sidebar.collapsed .toggle-sidebar i {
                transform: rotate(180deg);
            }

            [dir="rtl"] .sidebar.collapsed .toggle-sidebar i {
                transform: rotate(-180deg);
            }

            @media (max-width: 991.98px) {
                .sidebar {
                    transform: translateX(-100%);
                    width: 280px !important;
                }

                .sidebar.show {
                    transform: translateX(0);
                }

                .sidebar.collapsed {
                    width: 280px !important;
                }

                .sidebar.collapsed .nav-link span,
                .sidebar.collapsed .logo-container h5 {
                    display: block !important;
                }

                .content {
                    margin-left: 0 !important;
                }

                [dir="rtl"] .content {
                    margin-right: 0 !important;
                }

                .sidebar-backdrop {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 1039;
                }

                .sidebar-backdrop.show {
                    display: block;
                }
            }

            /* Avatar Circle */
            .avatar-circle {
                width: 32px;
                height: 32px;
                background-color: var(--primary-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            @include('layouts.partials.sidebar')
            
            <!-- Main Content -->
            <main class="content" id="content">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg top-navbar">
                    <div class="container-fluid">
                        <!-- Mobile Toggle Button -->
                        <button class="btn btn-primary btn-sm d-lg-none" id="mobileSidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>

                        <!-- Page Title -->
                        <h1 class="h4 mb-0">@yield('title')</h1>

                        <!-- Right Side -->
                        <div class="ms-auto d-flex align-items-center">
                            <!-- Language Switcher -->
                            <div class="language-switcher me-3">
                                <div class="btn-group">
                                    <a href="{{ route('change.language', 'ar') }}" class="btn {{ app()->getLocale() === 'ar' ? 'btn-primary' : 'btn-light' }} btn-sm">
                                        العربية
                                    </a>
                                    <a href="{{ route('change.language', 'en') }}" class="btn {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-light' }} btn-sm">
                                        English
                                    </a>
                                </div>
                            </div>

                            <!-- User Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                    <div class="avatar-circle me-2">
                                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                                    </div>
                                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>{{ __('nav.profile') }}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('nav.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Main Content Area -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Sidebar Toggle Script -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const toggleBtn = document.getElementById('toggleSidebar');
            const mobileToggle = document.getElementById('mobileSidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');

            // Update toggle icon based on sidebar state
            const updateToggleIcon = (isCollapsed) => {
                if (toggleBtn && window.innerWidth >= 992) {
                    const icon = toggleBtn.querySelector('i');
                    if (icon) {
                        icon.style.transform = isCollapsed ? 'rotate(180deg)' : '';
                        icon.style.transition = 'transform 0.3s ease';
                    }
                }
            };

            // Desktop sidebar toggle
            const handleDesktopToggle = () => {
                if (window.innerWidth >= 992) {
                    const isCollapsed = !sidebar.classList.contains('collapsed');
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                    localStorage.setItem('sidebarCollapsed', isCollapsed);
                    updateToggleIcon(isCollapsed);
                }
            };

            // Mobile dropdown toggle
            const handleMobileToggle = () => {
                sidebar.classList.toggle('show');
                sidebarBackdrop.classList.toggle('show');
            };

            // Handle screen size changes
            const handleScreenSize = () => {
                const width = window.innerWidth;
                if (width >= 992) {
                    // Reset mobile states
                    sidebar.classList.remove('show');
                    sidebarBackdrop.classList.remove('show');
                    
                    // Apply desktop collapsed state if saved
                    const storedState = localStorage.getItem('sidebarCollapsed');
                    if (storedState === 'true') {
                        sidebar.classList.add('collapsed');
                        content.classList.add('expanded');
                        updateToggleIcon(true);
                    }
                } else {
                    // Reset desktop states on mobile
                    sidebar.classList.remove('collapsed');
                    content.classList.remove('expanded');
                    updateToggleIcon(false);
                }
            };

            // Event Listeners
            if (toggleBtn) {
                toggleBtn.addEventListener('click', handleDesktopToggle);
            }

            if (mobileToggle) {
                mobileToggle.addEventListener('click', handleMobileToggle);
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (window.innerWidth < 992 && 
                    !sidebar.contains(e.target) && 
                    !mobileToggle.contains(e.target) && 
                    sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    sidebarBackdrop.classList.remove('show');
                }
            });

            // Close dropdown when clicking a menu item on mobile
            sidebar.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        sidebar.classList.remove('show');
                        sidebarBackdrop.classList.remove('show');
                    }
                });
            });

            // Initial setup
            window.addEventListener('resize', handleScreenSize);
            handleScreenSize();
        });

            // Initial setup
            const storedState = localStorage.getItem('sidebarCollapsed');
            if (storedState === 'true' && window.innerWidth >= 992) {
                sidebar.classList.add('collapsed');
                content.classList.add('expanded');
                updateToggleIcon(true);
            }

            // Resize listener
            window.addEventListener('resize', handleScreenSize);

            // Initial screen size check
            handleScreenSize();
        });
    </script>

    @stack('scripts')
</body>
</html>

    <title>{{ config('app.name', 'AlSafa') }} - @yield('title', 'لوحة التحكم')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    @if(app()->getLocale() == 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-mini-width: 70px;
            --primary-color: #0d6efd;
            --primary-gradient: linear-gradient(135deg, #0d6efd, #0099ff);
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 0;
            box-shadow: 0 4px 6px rgba(0,0,0,.1);
            background-color: #fff;
            width: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        .sidebar.collapsed {
            width: var(--sidebar-mini-width);
        }
        
        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
        }
        
        .sidebar-header {
            padding: 1rem;
            background: var(--primary-gradient);
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .toggle-sidebar {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .sidebar .nav-link {
            color: #333;
            padding: 0.75rem 1rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
        }
        
        .sidebar .nav-link i {
            margin-right: 0.75rem;
            min-width: 24px;
            text-align: center;
            font-size: 1.1rem;
            transition: margin 0.3s ease;
        }
        
        .sidebar.collapsed .nav-link span {
            opacity: 0;
            display: none;
        }
        
        .sidebar.collapsed .nav-link i {
            margin-right: 0;
            margin-left: 0;
        }
        
        /* Hide logo when sidebar is collapsed - مهم جداً */
        .sidebar.collapsed .logo-container {
            display: none !important;
            visibility: hidden;
            width: 0;
            height: 0;
            opacity: 0;
            overflow: hidden;
        }
        
        /* Ensure toggle button is centered when sidebar is collapsed */
        .sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 0.75rem;
        }
        
        /* Hide brand name on smaller screens */
        @media (max-width: 991.98px) {
            .sidebar:not(.collapsed) .sidebar-header .toggle-sidebar {
                margin-left: auto;
            }
            
            [dir="rtl"] .sidebar:not(.collapsed) .sidebar-header .toggle-sidebar {
                margin-right: auto;
                margin-left: 0;
            }
        }
        
        [dir="rtl"] .sidebar .nav-link i {
            margin-right: 0;
            margin-left: 0.75rem;
        }
        
        .sidebar .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }
        
        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Content for expanded sidebar - with 5px spacing */
        @media (min-width: 768px) {
            .content {
                margin-left: calc(var(--sidebar-width) + 5px);
                transition: all 0.3s ease;
            }
            
            .content.expanded {
                margin-left: calc(var(--sidebar-mini-width) + 5px);
            }
        }
        
        /* Fix sidebar visibility */
        #sidenav-main {
            display: block !important;
            visibility: visible !important;
            z-index: 1030;
        }
        
        /* RTL specific styles */
        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
        }
        
        [dir="rtl"] .content {
            margin-left: 0;
            margin-right: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        
        [dir="rtl"] .content.expanded {
            margin-right: var(--sidebar-mini-width);
        }
        
        [dir="rtl"] .sidebar.collapsed {
            width: var(--sidebar-mini-width);
        }
        
        [dir="rtl"] .sidebar .nav-link i {
            margin-right: 0;
            margin-left: 0.75rem;
        }
        
        [dir="rtl"] .sidebar.collapsed .nav-link i {
            margin-left: 0;
        }
        
        [dir="rtl"] .me-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }
        
        [dir="rtl"] .me-3 {
            margin-right: 0 !important;
            margin-left: 1rem !important;
        }
        
        [dir="rtl"] .mobile-toggle {
            margin-right: 0;
            margin-left: 0.5rem;
        }
        
        /* Fix dropdown behavior on hover */
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
        
        /* Navbar & Header Styles */
        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 99;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        
        .avatar-circle {
            width: 30px;
            height: 30px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
        }
        
        .initials {
            font-size: 14px;
        }
        
        /* Language Switcher Styles */
        .language-switcher .btn-group {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 50px;
            overflow: hidden;
        }
        
        .language-switcher .btn {
            border-radius: 0;
            padding: 0.25rem 0.75rem;
            transition: all 0.2s ease;
        }
        
        .language-switcher .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }
        
        /* Make the primary btn-sm more visible */
        .btn-primary.btn-sm {
            font-weight: 500;
        }
        
        /* Mobile optimizations */
        @media (max-width: 767.98px) {
            .top-navbar .language-switcher .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
            
            .top-navbar h1.h4 {
                font-size: 1.1rem;
                max-width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            
            .top-navbar .user-info .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
            
            .content {
                padding: 1rem;
            }
            
            .navbar {
                padding: 0.5rem 1rem;
            }
            
            /* Make language switcher more visible on mobile */
            .language-switcher {
                position: fixed;
                bottom: 1rem;
                right: 1rem;
                z-index: 1030;
                margin: 0 !important;
            }
            
            [dir="rtl"] .language-switcher {
                right: auto;
                left: 1rem;
            }
            
            .language-switcher .btn-group {
                box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            }
        }
        
        /* Improved content padding and spacing */
        .content {
            padding: 1.5rem 0.5rem;
            width: 100%;
        }
        
        /* Add padding to direct children of content for breathing space */
        .content > .container-fluid,
        .content > .container,
        .content > .row,
        .content > .card,
        .content > div {
            padding-right: 5px;
            padding-left: 5px;
        }
        
        /* Add padding to container-fluid */
        .content .container-fluid {
            padding-left: 5px;
            padding-right: 5px;
        }
        
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
        }
        
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 1rem 1.25rem;
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        /* Top navbar */
        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 99;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .mobile-toggle {
            display: none;
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border: none;
            background: transparent;
            color: var(--primary-color);
        }
        
        .language-switcher .dropdown-menu {
            min-width: 120px;
        }
        
        .top-navbar .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            }
        
            .language-switcher .btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            }
        
            /* Make the primary btn-sm more visible */
            .btn-primary.btn-sm {
                font-weight: 500;
            }
        
            /* Mobile optimizations */
            @media (max-width: 767.98px) {
                .top-navbar .language-switcher .btn {
                    padding: 0.25rem 0.5rem;
                    font-size: 0.75rem;
                }
            
                .top-navbar h1.h4 {
                    font-size: 1.1rem;
                    max-width: 120px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                }
            
                .top-navbar .user-info .btn {
                    padding: 0.25rem 0.5rem;
                    font-size: 0.75rem;
                }
            
                .content {
                    padding: 1rem;
                }
            
                .navbar {
                    padding: 0.5rem 1rem;
                }
            
                /* Make language switcher more visible on mobile */
                .language-switcher {
                    position: fixed;
                    bottom: 1rem;
                    right: 1rem;
                    z-index: 1030;
                    margin: 0 !important;
                }
            
                [dir="rtl"] .language-switcher {
                    right: auto;
                    left: 1rem;
                }
            
                .language-switcher .btn-group {
                    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
                }
            }
        
            /* Improved content padding and spacing */
            .content {
                padding: 1.5rem 0.5rem;
                width: 100%;
            }
        
            /* Add padding to direct children of content for breathing space */
            .content > .container-fluid,
            .content > .container,
            .content > .row,
            .content > .card,
            .content > div {
                padding-right: 5px;
                padding-left: 5px;
            }
        
            /* Add padding to container-fluid */
            .content .container-fluid {
                padding-left: 5px;
                padding-right: 5px;
            }
        
            .card {
                margin-bottom: 1.5rem;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                border: none;
            }
        
            .card-header {
                background-color: transparent;
                border-bottom: 1px solid rgba(0, 0, 0, 0.125);
                padding: 1rem 1.25rem;
            }
        
            .card-body {
                padding: 1.25rem;
            }
        
            /* Top navbar */
            .top-navbar {
                position: sticky;
                top: 0;
                z-index: 99;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0,0,0,.1);
            }
        
            .mobile-toggle {
                display: none;
                font-size: 1.25rem;
                cursor: pointer;
                padding: 0.5rem;
                border: none;
                background: transparent;
                color: var(--primary-color);
            }
        
            .language-switcher .dropdown-menu {
                min-width: 120px;
            }
        
            .top-navbar .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }
        
            /* Responsive */
            @media (max-width: 991.98px) {
                .sidebar {
                    width: var(--sidebar-mini-width);
                }
                .sidebar .nav-link span {
                    opacity: 0;
                    display: none;
                }
                .sidebar .nav-link i {
                    margin-right: 0;
                    margin-left: 0;
                }
                .content {
                    margin-left: var(--sidebar-mini-width);
                }
                [dir="rtl"] .content {
                    margin-right: var(--sidebar-mini-width);
                    margin-left: 0;
                }
            }
        
            @media (max-width: 767.98px) {
                .mobile-toggle {
                    display: block;
                }
                .sidebar {
                    transform: translateX(-100%);
                    width: 240px;
                    z-index: 1031;
                }
                .sidebar.show {
                    transform: translateX(0);
                }
                [dir="rtl"] .sidebar {
                    transform: translateX(100%);
                }
                [dir="rtl"] .sidebar.show {
                    transform: translateX(0);
                }
                .sidebar .nav-link span {
                    display: inline;
                    opacity: 1;
                }
                .content {
                    margin-left: 0;
                }
                [dir="rtl"] .content {
                    margin-right: 0;
                }
                .sidebar-backdrop {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.5);
                    z-index: 1030;
                    display: none;
                }
                .sidebar-backdrop.show {
                    display: block;
                }
            }
        
            /* Content and sidebar spacing */
            @media (min-width: 768px) {
                .content {
                    margin-left: 255px; /* 250px + 5px gap */
                    margin-right: 0;
                    padding-left: 5px;
                }
            
                .content.expanded {
                    margin-left: 85px; /* 80px + 5px gap */
                }
            
                [dir="rtl"] .content {
                    margin-left: 0;
                    margin-right: 255px; /* 250px + 5px gap */
                    padding-right: 5px;
                }
            
                [dir="rtl"] .content.expanded {
                    margin-right: 85px; /* 80px + 5px gap */
                }
            }
    </style>
</head>
<body>
    <!-- Mobile Sidebar Backdrop -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
            
        <!-- Main Content -->
        <main class="content" id="content">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg bg-white shadow-sm top-navbar mb-4 rounded">
                <div class="container-fluid">
                    <!-- Mobile Toggle Button -->
                    <button class="mobile-toggle btn btn-primary btn-sm me-2 d-lg-none shadow-sm" id="mobileSidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <!-- Page Title -->
                    <h1 class="h4 mb-0 text-primary">@yield('title', 'لوحة التحكم')</h1>
                    
                    <!-- Navbar Right Side -->
                    <div class="ms-auto d-flex align-items-center">
                        <!-- Language Switcher - More Prominent -->
                        <div class="language-switcher me-3">
                            <div class="btn-group shadow-sm">
                                <a href="{{ route('change.language', 'ar') }}" class="btn {{ app()->getLocale() === 'ar' ? 'btn-primary' : 'btn-light' }} btn-sm fw-bold">
                                    <i class="fas fa-globe-africa me-1 d-none d-sm-inline-block"></i> العربية
                                </a>
                                <a href="{{ route('change.language', 'en') }}" class="btn {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-light' }} btn-sm fw-bold">
                                    <i class="fas fa-globe-americas me-1 d-none d-sm-inline-block"></i> English
                                </a>
                            </div>
                        </div>
                        
                        <!-- User Info -->
                        <div class="user-info d-flex align-items-center ms-3">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar-circle me-2 d-none d-sm-inline-block">
                                        <span class="initials">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                    <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'User' }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>{{ __('profile.edit_profile') ?? 'الملف الشخصي' }}</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i>{{ __('auth.logout') ?? 'تسجيل الخروج' }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="btn-toolbar ms-2">
                            @yield('actions')
                        </div>
                    </div>
                </div>
            </nav>
                <!-- Content Area -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                                            <span class="initials">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                        </div>
                                        <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'User' }}</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>{{ __('profile.edit_profile') ?? 'الملف الشخصي' }}</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('auth.logout') ?? 'تسجيل الخروج' }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="btn-toolbar ms-2">
                                @yield('actions')
                            </div>
                        </div>
                    </div>
                </nav>
                
                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Sidebar Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const toggleSidebar = document.getElementById('toggleSidebar');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            
            // Utility function to update toggle icon
            const updateToggleIcon = (isCollapsed) => {
                if (toggleSidebar) {
                    toggleSidebar.innerHTML = isCollapsed ? 
                        '<i class="fas fa-angle-double-right"></i>' : 
                        '<i class="fas fa-exchange-alt"></i>';
                }
            };
            
            // Toggle sidebar on desktop
            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                    
                    // Update toggle icon based on state
                    const isCollapsed = sidebar.classList.contains('collapsed');
                    updateToggleIcon(isCollapsed);
                    
                    // Hide logo container when collapsed
                    const logoContainer = document.getElementById('logoContainer');
                    if (logoContainer) {
                        logoContainer.style.display = isCollapsed ? 'none' : 'flex';
                    }
                    
                    // Save state to localStorage
                    localStorage.setItem('sidebarCollapsed', isCollapsed);
                });
            }
            
            // Toggle sidebar on mobile
            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebarBackdrop.classList.toggle('show');
                });
            }
            
            // Hide sidebar when clicking on backdrop
            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarBackdrop.classList.remove('show');
                });
            }
            
            // Auto-collapse for tablet screens
            const handleScreenSize = () => {
                const logoContainer = document.getElementById('logoContainer');
                
                if (window.innerWidth > 767.98 && window.innerWidth <= 991.98) {
                    // For tablet screens, always collapse sidebar
                    sidebar.classList.add('collapsed');
                    content.classList.add('expanded');
                    updateToggleIcon(true);
                    if (logoContainer) logoContainer.style.display = 'none';
                } else if (window.innerWidth > 991.98) {
                    // For desktop, use stored preference
                    const sidebarState = localStorage.getItem('sidebarCollapsed');
                    if (sidebarState === 'true') {
                        sidebar.classList.add('collapsed');
                        content.classList.add('expanded');
                        updateToggleIcon(true);
                        if (logoContainer) logoContainer.style.display = 'none';
                    } else {
                        sidebar.classList.remove('collapsed');
                        content.classList.remove('expanded');
                        updateToggleIcon(false);
                        if (logoContainer) logoContainer.style.display = 'flex';
                    }
                } else {
                    // For mobile
                    sidebar.classList.remove('collapsed');
                    content.classList.remove('expanded');
                    updateToggleIcon(false);
                    if (logoContainer) logoContainer.style.display = 'flex';
                }
            };
            
            // Initial setup
            handleScreenSize();
            
            // Resize listener
            window.addEventListener('resize', handleScreenSize);
            
            // Dropdown functionality enhancement
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                if (dropdownMenu) {
                    dropdown.addEventListener('mouseenter', () => {
                        if (window.innerWidth > 991.98) {
                            dropdownMenu.classList.add('show');
                        }
                    });
                    dropdown.addEventListener('mouseleave', () => {
                        if (window.innerWidth > 991.98) {
                            dropdownMenu.classList.remove('show');
                        }
                    });
                }
            });
        });
    </script>
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
