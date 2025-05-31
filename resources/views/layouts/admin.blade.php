<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ app()->getLocale() == 'ar' ? 'الصفا' : 'AlSafa' }}</title>

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

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-gradient: linear-gradient(135deg, #0d6efd, #0099ff);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --header-height: 65px;
            --footer-height: 60px;
            --transition-speed: 0.3s;
        }
        
        /* Fix sidebar visibility */
        #sidenav-main {
            display: block !important;
            visibility: visible !important;
            z-index: 1030;
        }
                        body {
            font-family: 'Cairo', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            padding-top: var(--header-height);
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidenav {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1040;
            padding-top: var(--header-height);
        }

        .sidenav.collapsed {
            width: var(--sidebar-mini-width);
        }

        .sidenav .nav-item {
            width: 100%;
            margin-bottom: 5px;
        }

        .sidenav .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #344767;
            border-radius: 10px;
            margin: 0 15px;
            transition: all 0.3s ease;
        }

        .sidenav .nav-link i {
            font-size: 1.2rem;
            margin-right: 10px;
            width: 25px;
            text-align: center;
            transition: margin 0.3s ease;
        }

        .sidenav .nav-link span {
            transition: opacity 0.3s ease;
        }

        .sidenav.collapsed .nav-link span {
            opacity: 0;
            width: 0;
        }

        .sidenav .nav-link:hover,
        .sidenav .nav-link.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 6px rgba(13, 110, 253, 0.1);
        }

        .sidenav .nav-link:hover i,
        .sidenav .nav-link.active i {
            color: white;
        }

        .sidenav-header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
        }

        .sidenav.collapsed .sidenav-header span {
            display: none;
        }
                .navbar {
            height: var(--header-height);
            background: var(--primary-gradient);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 1.5rem;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
        }
        .navbar-brand:hover {
            color: rgba(255, 255, 255, 0.9);
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all var(--transition-speed) ease;
        }
        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
        }
                .wrapper {
            flex: 1;
            display: flex;
            min-height: calc(100vh - var(--header-height) - var(--footer-height));
        }
                .sidenav {
            width: var(--sidebar-width);
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: all var(--transition-speed) ease;
            padding: 1.5rem 1rem;
            position: fixed;
            top: var(--header-height);
            bottom: var(--footer-height);
            overflow-y: auto;
            z-index: 1000;
        }
        .sidenav::-webkit-scrollbar {
            width: 6px;
        }
        .sidenav::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .sidenav::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }
        .sidenav .nav-link {
            color: #444 !important;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            transition: all var(--transition-speed) ease;
        }
        .sidenav .nav-link i {
            font-size: 1.1rem;
            margin-right: 1rem;
            width: 1.5rem;
            text-align: center;
            color: #666;
            transition: all var(--transition-speed) ease;
        }
        .sidenav .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(13, 110, 253, 0.1);
        }
        .sidenav .nav-link:hover i {
            color: var(--primary-color);
        }
        .sidenav .nav-link.active {
            color: white !important;
            background: var(--primary-gradient);
        }
        .sidenav .nav-link.active i {
            color: white;
        }
        .sidenav.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        .sidenav.collapsed .nav-link-text,
        .sidenav.collapsed .sidenav-header span {
            display: none;
        }
                .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all var(--transition-speed) ease;
        }
        .main-content .page-header {
            margin-bottom: 2rem;
        }
        .main-content .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0;
        }
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 1.5rem;
        }
        .card-body {
            padding: 1.5rem;
        }
                .footer {
            height: var(--footer-height);
            background: white;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 0.9rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }
        
        /* RTL Specific Styles */
        [dir="rtl"] .sidenav {
            right: 0;
            left: auto;
        }
        [dir="rtl"] .main-content {
            margin-right: var(--sidebar-width);
            margin-left: 0;
        }
        [dir="rtl"] .sidenav .nav-link i {
            margin-right: 0;
            margin-left: 1rem;
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
        }
        [dir="rtl"] .sidenav {
            right: 0;
            left: auto;
        }
        [dir="rtl"] .main-content {
            margin-right: var(--sidebar-width);
            margin-left: 0;
        }
        [dir="rtl"] .collapsed ~ .main-content {
            margin-right: var(--sidebar-collapsed-width);
            margin-left: 0;
        }
        .toggle-sidebar {
            cursor: pointer;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            color: #6c757d;
            position: absolute;
            right: 1rem;
            top: 1rem;
        }
        [dir="rtl"] .toggle-sidebar {
            right: auto;
            left: 1rem;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="d-flex flex-column h-100" id="app-body">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-gradient-primary">
        <div class="container-fluid px-4">
            <button class="btn btn-link d-block d-xl-none text-white me-0" type="button" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('home') }}">{{ app()->getLocale() == 'ar' ? 'الصفا' : 'AlSafa' }}</a>
            

            <div class="d-flex align-items-center">
                @if(auth()->user()->role === 'admin')
                <!-- Dashboard Link -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>
                            {{ __('dashboard.title') }}
                        </a>
                    </li>
                </ul>
                @endif

                <!-- Language Switcher -->
                <div class="nav-item me-3">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(app()->getLocale() === 'ar')
                                <i class="fas fa-globe me-1"></i> العربية
                            @else
                                <i class="fas fa-globe me-1"></i> English
                            @endif
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item {{ app()->getLocale() === 'ar' ? 'active' : '' }}" href="{{ route('change.language', 'ar') }}">العربية</a></li>
                            <li><a class="dropdown-item {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ route('change.language', 'en') }}">English</a></li>
                        </ul>
                    </div>
                </div>
                <!-- User Dropdown -->
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i>{{ __('profile.edit_profile') }}</a></li>
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
            </div>
        </div>
    </nav>

    <!-- Wrapper -->
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <aside class="sidenav" id="sidenav-main">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ auth()->user()->role === 'admin' ? route('dashboard') : route('home') }}">{{ app()->getLocale() == 'ar' ? 'الصفا' : 'AlSafa' }}</a>
                

            <hr class="horizontal dark mt-0">

            <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line"></i>
                            <span>{{ __('dashboard.title') ?? 'لوحة التحكم' }}</span>
                        </a>
                    </li>

                    <!-- Users Section -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-users"></i>
                            <span>{{ __('users.title') ?? 'المستخدمين' }}</span>
                        </a>
                    </li>

                    <!-- Branches Section -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('branches.*') ? 'active' : '' }}" href="{{ route('branches.index') }}">
                            <i class="fas fa-code-branch"></i>
                            <span>{{ __('branches.title') ?? 'الفروع' }}</span>
                        </a>
                    </li>

                    <!-- Towers Section -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('towers.*') ? 'active' : '' }}" href="{{ route('towers.index') }}">
                            <i class="fas fa-city"></i>
                            <span>{{ __('towers.title') ?? 'الأبراج' }}</span>
                        </a>
                    </li>

                    <!-- Sections Section -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sections.*') ? 'active' : '' }}" href="{{ route('sections.index') }}">
                            <i class="fas fa-th-large"></i>
                            <span>{{ __('sections.title') ?? 'الأقسام الرئيسية' }}</span>
                        </a>
                    </li>

                    <!-- Maintenance Requests -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('maintenance-requests.*') ? 'active' : '' }}" href="{{ route('maintenance-requests.index') }}">
                            <i class="fas fa-tools"></i>
                            <span>{{ __('maintenance.title') ?? 'طلب صيانة' }}</span>
                        </a>
                    </li>

                    <!-- Activities -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('activities.*') ? 'active' : '' }}" href="{{ route('activities.index') }}">
                            <i class="fas fa-history"></i>
                            <span>{{ __('activity.title') ?? 'النشاطات' }}</span>
                        </a>
                    </li>
                    
                    <!-- Profile Section -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user"></i>
                            <span>{{ __('profile.edit_profile') ?? 'الملف الشخصي' }}</span>
                        </a>
                    </li>
                    
                    <!-- Home Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i>
                            <span>{{ __('home.title') ?? 'الرئيسية' }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content w-100 bg-light">
            <div class="container-fluid p-4">
                <!-- Page Title -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2 mb-0">@yield('title')</h1>
                    @yield('actions')
                </div>

                <!-- Content -->
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-white border-top">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <div class="copyright text-center text-sm text-muted">
                        © {{ date('Y') }} {{ config('app.name') }}. جميع الحقوق محفوظة.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Core JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (needed for some Bootstrap plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Sidebar
            const toggleBtn = document.getElementById('toggleSidebar');
            if (toggleBtn) {
                const sidebar = document.getElementById('sidenav-main');
                const mainContent = document.querySelector('.main-content');
                
                // Toggle sidebar on button click
                toggleBtn.addEventListener('click', function() {
                    if (sidebar) {
                        sidebar.classList.toggle('collapsed');
                        if (mainContent) {
                            mainContent.classList.toggle('expanded');
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
