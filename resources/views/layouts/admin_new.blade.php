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
                overflow-x: hidden;
            }

            .sidebar.collapsed {
                width: var(--sidebar-mini-width, 70px);
            }

            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .logo-container h5 {
                opacity: 0;
                visibility: hidden;
            }

            .sidebar.collapsed .nav-link i {
                margin: 0 !important;
                font-size: 1.25rem;
            }

            #toggleSidebar {
                cursor: pointer;
                background: transparent;
                border: none;
                color: var(--primary-color);
                padding: 0.5rem;
                transition: transform 0.3s ease;
            }

            #toggleSidebar:hover {
                color: var(--primary-color);
                transform: scale(1.1);
            }

            [dir="rtl"] .sidebar {
                left: auto;
                right: 0;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .sidebar.collapsed {
                width: var(--sidebar-mini-width, 70px);
            }

            .sidebar .logo-container {
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            .sidebar.collapsed .nav-link span,
            .sidebar.collapsed .logo-container h5,
            .sidebar.collapsed .text-muted {
                opacity: 0;
                visibility: hidden;
                transition: opacity 0.2s ease, visibility 0.2s ease;
            }

            .sidebar .nav-link {
                display: flex;
                align-items: center;
                padding: 0.75rem 1rem;
                transition: padding 0.3s ease;
            }

            .sidebar.collapsed .nav-link {
                text-align: center;
                padding: 0.75rem;
                justify-content: center;
            }

            .sidebar .nav-link i {
                width: 1.5rem;
                text-align: center;
                margin-right: 0.75rem;
                transition: margin 0.3s ease, transform 0.3s ease;
            }

            [dir="rtl"] .sidebar .nav-link i {
                margin-right: 0;
                margin-left: 0.75rem;
            }

            .sidebar.collapsed .nav-link i {
                margin: 0;
                width: auto;
                font-size: 1.2rem;
            }

            .sidebar-header {
                display: flex;
                align-items: center;
                padding: 1rem;
                transition: padding 0.3s ease, justify-content 0.3s ease;
            }

            .sidebar.collapsed .sidebar-header {
                justify-content: center;
                padding: 1rem 0.5rem;
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
                position: fixed;
                top: 0;
                left: 0;
                width: 280px !important;
                height: 100vh;
                background: #fff;
                box-shadow: 2px 0 5px rgba(0,0,0,.1);
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 1040;
                overflow-y: auto;
            }

            [dir="rtl"] .sidebar {
                left: auto;
                right: 0;
                transform: translateX(100%);
                box-shadow: -2px 0 5px rgba(0,0,0,.1);
            }

            .sidebar.show {
                transform: translateX(0);
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
            <nav class="navbar navbar-expand-lg top-navbar mb-4 px-3">
                <div class="container-fluid">
                    <!-- Mobile Sidebar Toggle -->
                    <button class="toggle-sidebar" id="toggleSidebar">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <div class="navbar-collapse">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <!-- Page Title -->
                            <h4 class="mb-0">@yield('title')</h4>

                            <div class="d-flex align-items-center">
                                <!-- Language Switcher -->
                                <div class="language-switcher">
                                    <div class="btn-group">
                                        <a href="{{ route('change.language', 'ar') }}" class="btn btn-sm {{ app()->getLocale() == 'ar' ? 'btn-primary' : 'btn-outline-primary' }}">
                                            العربية
                                        </a>
                                        <a href="{{ route('change.language', 'en') }}" class="btn btn-sm {{ app()->getLocale() == 'en' ? 'btn-primary' : 'btn-outline-primary' }}">
                                            English
                                        </a>
                                    </div>
                                </div>

                                <!-- User Dropdown -->
                                <div class="dropdown ms-3">
                                    <button class="btn btn-link dropdown-toggle d-flex align-items-center text-decoration-none" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="avatar me-2">
                                            @if(auth()->user()->avatar)
                                            <img src="{{ asset(auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle" width="32" height="32">
                                            @else
                                            <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; background: var(--primary-gradient);">
                                                <span class="text-white">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            @endif
                                        </div>
                                        <span class="d-none d-md-inline text-dark">{{ auth()->user()->name ?? 'User' }}</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i>{{ __('profile.edit_profile') }}</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('auth.logout') }}
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Action Buttons -->
                                <div class="btn-toolbar ms-3">
                                    @yield('actions')
                                </div>
                            </div>
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
    </script>

    @stack('scripts')
</body>
</html>
