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

            <!-- Apartments Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/apartments*') || request()->is('admin/apartment-types*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#apartmentsCollapse" aria-expanded="{{ request()->is('admin/apartments*') || request()->is('admin/apartment-types*') ? 'true' : 'false' }}" aria-controls="apartmentsCollapse">
                    <i class="fas fa-building"></i>
                    <span>{{ __('menu.apartments') }}</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <div class="collapse {{ request()->is('admin/apartments*') || request()->is('admin/apartment-types*') ? 'show' : '' }}" id="apartmentsCollapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/apartment-types*') ? 'active' : '' }}" href="{{ route('admin.apartment-types.index') }}">
                                <i class="fas fa-tags"></i>
                                <span>{{ __('menu.apartment_types') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/apartments*') ? 'active' : '' }}" href="{{ route('admin.apartments.index') }}">
                                <i class="fas fa-list"></i>
                                <span>{{ __('menu.apartment_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
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

<style>
/* Submenu styles */
.nav-link[data-bs-toggle="collapse"] {
    position: relative;
}

.nav-link[data-bs-toggle="collapse"] .fa-chevron-down {
    transition: transform 0.3s ease;
    font-size: 0.75rem;
}

.nav-link[aria-expanded="true"] .fa-chevron-down {
    transform: rotate(180deg);
}

.collapse .nav-link {
    padding-left: 2.5rem;
}

[dir="rtl"] .collapse .nav-link {
    padding-left: 1rem;
    padding-right: 2.5rem;
}

.collapse .nav-link i {
    font-size: 0.875rem;
}

/* RTL support for submenu chevron */
[dir="rtl"] .nav-link[data-bs-toggle="collapse"] .fa-chevron-down {
    margin-left: 0;
    margin-right: auto;
}
</style>
