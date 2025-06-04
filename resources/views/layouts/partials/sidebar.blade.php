<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- Sidebar Navigation -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center logo-container" id="logoContainer">
            <i class="fas fa-building me-2"></i>
            <h5 class="mb-0">{{ app()->getLocale() == 'ar' ? 'الصفا' : 'AlSafa' }}</h5>
        </div>
        <button class="toggle-sidebar" id="toggleSidebar">
            <i class="fas fa-angle-double-left"></i>
        </button>
    </div>
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line"></i>
                    <span>{{ __('nav.dashboard') }}</span>
                </a>
            </li>

            <!-- Users Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i>
                    <span>{{ __('menu.users') }}</span>
                </a>
            </li>

            <!-- Branches Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/branches*') ? 'active' : '' }}" href="{{ route('admin.branches.index') }}">
                    <i class="fas fa-code-branch"></i>
                    <span>{{ __('menu.branches') }}</span>
                </a>
            </li>

            <!-- Towers Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/towers*') ? 'active' : '' }}" href="{{ route('admin.towers.index') }}">
                    <i class="fas fa-city"></i>
                    <span>{{ __('menu.towers') }}</span>
                </a>
            </li>

            <!-- Departments Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/sections*') ? 'active' : '' }}" href="{{ route('admin.sections.index') }}">
                    <i class="fas fa-sitemap"></i>
                    <span>{{ __('menu.departments') }}</span>
                </a>
            </li>

            <!-- Maintenance Requests -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/maintenance-requests*') ? 'active' : '' }}" href="{{ route('admin.maintenance-requests.index') }}">
                    <i class="fas fa-tools"></i>
                    <span>{{ __('menu.maintenance') }}</span>
                </a>
            </li>

            <!-- Activities -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/activities*') ? 'active' : '' }}" href="{{ route('admin.activities.index') }}">
                    <i class="fas fa-history"></i>
                    <span>{{ __('menu.activities') }}</span>
                </a>
            </li>
            
            <!-- Profile Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user"></i>
                    <span>{{ __('nav.profile') }}</span>
                </a>
            </li>
            
            <!-- Home Link -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    <span>{{ __('nav.home') }}</span>
                </a>
            </li>
            
            <!-- Logout -->
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>{{ __('nav.logout') }}</span>
                    </button>
                </form>
            </li>
        </ul>
        
        <!-- Footer info in sidebar -->
        <div class="mt-4 mx-3 text-muted small">
            <p>Laravel © {{ date('Y') }}</p>
        </div>
    </div>
</nav>
