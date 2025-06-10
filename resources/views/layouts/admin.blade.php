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

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-mini-width: 70px;
            --primary-color: #0d6efd;
            --primary-gradient: linear-gradient(135deg, #0d6efd, #0099ff);
            --header-height: 65px;
            --transition-speed: 0.3s;
        }
        
        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            background-color: #f8f9fa;
            overflow-x: hidden;
            padding-top: var(--header-height);
        }
        
        /* Sidebar Styles */
        .sidenav {
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: all var(--transition-speed) ease;
            z-index: 1040;
            overflow-y: auto;
        }

        [dir="rtl"] .sidenav {
            left: auto;
            right: 0;
        }

        .sidenav.collapsed {
            width: var(--sidebar-mini-width);
        }

        .sidenav-header {
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
        }

        .sidenav .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #344767;
            border-radius: 0.5rem;
            margin: 0.5rem 1rem;
            transition: all var(--transition-speed) ease;
            white-space: nowrap;
        }

        .sidenav .nav-link i {
            min-width: 32px;
            font-size: 1.2rem;
            margin-right: 0.75rem;
            text-align: center;
            transition: margin var(--transition-speed) ease;
        }

        [dir="rtl"] .sidenav .nav-link i {
            margin-right: 0;
            margin-left: 0.75rem;
        }

        .sidenav .nav-link-text {
            opacity: 1;
            transition: opacity var(--transition-speed) ease;
        }

        .sidenav.collapsed .nav-link-text {
            opacity: 0;
            width: 0;
            display: none;
        }

        .sidenav .nav-link:hover,
        .sidenav .nav-link.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.1);
        }

        .toggle-sidebar {
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            color: #6c757d;
            transition: all var(--transition-speed) ease;
            border-radius: 50%;
        }

        .toggle-sidebar:hover {
            background: rgba(108, 117, 125, 0.1);
        }

        .toggle-sidebar i {
            font-size: 1.25rem;
            transition: transform var(--transition-speed) ease;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: margin var(--transition-speed) ease;
            min-height: calc(100vh - var(--header-height));
        }

        [dir="rtl"] .main-content {
            margin-left: 0;
            margin-right: var(--sidebar-width);
        }

        .collapsed ~ .main-content {
            margin-left: var(--sidebar-mini-width);
        }

        [dir="rtl"] .collapsed ~ .main-content {
            margin-left: 0;
            margin-right: var(--sidebar-mini-width);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidenav {
                transform: translateX(-100%);
            }

            [dir="rtl"] .sidenav {
                transform: translateX(100%);
            }

            .sidenav.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            .toggle-sidebar {
                display: none;
            }
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: rgba(40, 199, 111, 0.1);
            color: #28c76f;
        }

        .alert-danger {
            background-color: rgba(234, 84, 85, 0.1);
            color: #ea5455;
        }

        .alert-warning {
            background-color: rgba(255, 159, 67, 0.1);
            color: #ff9f43;
        }

        .alert-info {
            background-color: rgba(0, 207, 232, 0.1);
            color: #00cfe8;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Table Styles */
        .table {
            margin-bottom: 0;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            padding: 1rem;
            white-space: nowrap;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Form Styles */
        .form-control {
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* Button Styles */
        .btn {
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .btn-primary:hover {
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.2);
        }

        /* Avatar Styles */
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 1rem;
        }

        .avatar-lg {
            width: 48px;
            height: 48px;
        }

        .avatar-xl {
            width: 64px;
            height: 64px;
        }
    </style>

    @stack('styles')
</head>
<body>
    @auth
        @if(in_array(auth()->user()->role, ['super_admin', 'manager']))
            <!-- Include Navbar -->
            @include('layouts.partials.navbar')

            <!-- Include Sidebar -->
            @include('layouts.partials.sidebar')

            <!-- Main Content -->
            <main class="main-content">
                <div class="container-fluid">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info">
                            {{ session('info') }}
                        </div>
                    @endif

                    @if (isset($header))
                        <header class="mb-4">
                            {{ $header }}
                        </header>
                    @endif

                    @yield('content')
                </div>
            </main>

            <!-- Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            
            <!-- SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

            <!-- Include Scripts -->
            @include('layouts.partials.scripts')
            
            @stack('scripts')
        @else
            <script>window.location = "{{ route('home') }}";</script>
        @endif
    @else
        <script>window.location = "{{ route('login') }}";</script>
    @endauth

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get elements
            const sidebar = document.querySelector('.sidenav');
            const mainContent = document.querySelector('.main-content');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const mobileToggleBtn = document.getElementById('mobileSidebarToggle');

            // Function to toggle sidebar
            function toggleSidebar() {
                if (sidebar && mainContent) {
                    sidebar.classList.toggle('collapsed');
                    
                    // Update margins based on RTL
                    const isRTL = document.dir === 'rtl';
                    const margin = sidebar.classList.contains('collapsed') ? 
                        'var(--sidebar-mini-width)' : 'var(--sidebar-width)';
                    
                    if (isRTL) {
                        mainContent.style.marginRight = margin;
                        mainContent.style.marginLeft = '0';
                    } else {
                        mainContent.style.marginLeft = margin;
                        mainContent.style.marginRight = '0';
                    }

                    // Save state to localStorage
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                }
            }

            // Desktop sidebar toggle
            if (sidebarCollapseBtn) {
                sidebarCollapseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleSidebar();
                });
            }

            // Mobile sidebar toggle
            if (mobileToggleBtn && sidebar) {
                mobileToggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('show');
                });

                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(e) {
                    if (window.innerWidth < 992 && 
                        !sidebar.contains(e.target) && 
                        !mobileToggleBtn.contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                });
            }

            // Restore sidebar state from localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed && sidebar && mainContent) {
                sidebar.classList.add('collapsed');
                const margin = 'var(--sidebar-mini-width)';
                if (document.dir === 'rtl') {
                    mainContent.style.marginRight = margin;
                    mainContent.style.marginLeft = '0';
                } else {
                    mainContent.style.marginLeft = margin;
                    mainContent.style.marginRight = '0';
                }
            }

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth < 992) {
                    if (sidebar) {
                        sidebar.classList.remove('collapsed');
                        sidebar.classList.remove('show');
                    }
                    if (mainContent) {
                        mainContent.style.marginLeft = '0';
                        mainContent.style.marginRight = '0';
                    }
                } else {
                    if (mainContent) {
                        const margin = sidebar && sidebar.classList.contains('collapsed') ? 
                            'var(--sidebar-mini-width)' : 'var(--sidebar-width)';
                        if (document.dir === 'rtl') {
                            mainContent.style.marginRight = margin;
                            mainContent.style.marginLeft = '0';
                        } else {
                            mainContent.style.marginLeft = margin;
                            mainContent.style.marginRight = '0';
                        }
                    }
                }
            });

            // Auto-hide alerts
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 150);
                }, 3000);
            });
        });
    </script>
</body>
</html> 