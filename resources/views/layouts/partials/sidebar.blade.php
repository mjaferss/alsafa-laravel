<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- Sidebar Navigation -->
<nav class="sidenav" id="sidenav-main">
    <div class="sidenav-header">
        <div class="d-flex align-items-center">
            <i class="fas fa-building me-2"></i>
            <span class="nav-link-text">{{ app()->getLocale() == 'ar' ? 'الصفا' : 'AlSafa' }}</span>
        </div>
        <button class="toggle-sidebar" id="sidebarCollapseBtn">
            @if(app()->getLocale() == 'ar')
            <i class="fas fa-angle-double-right"></i>
            @else
            <i class="fas fa-angle-double-left"></i>
            @endif
        </button>
    </div>

    <div class="position-sticky">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line"></i>
                    <span class="nav-link-text">{{ __('nav.dashboard') }}</span>
                </a>
            </li>

            <!-- Users Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i>
                    <span class="nav-link-text">{{ __('menu.users') }}</span>
                </a>
            </li>

            <!-- Branches Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/branches*') ? 'active' : '' }}" href="{{ route('admin.branches.index') }}">
                    <i class="fas fa-code-branch"></i>
                    <span class="nav-link-text">{{ __('menu.branches') }}</span>
                </a>
            </li>

            <!-- Towers Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/towers*') ? 'active' : '' }}" href="{{ route('admin.towers.index') }}">
                    <i class="fas fa-city"></i>
                    <span class="nav-link-text">{{ __('menu.towers') }}</span>
                </a>
            </li>

            <!-- Apartments Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/apartments*') || request()->is('admin/apartment-types*') ? 'active' : '' }}" 
                   href="#" 
                   data-bs-toggle="collapse" 
                   data-bs-target="#apartmentsCollapse" 
                   aria-expanded="{{ request()->is('admin/apartments*') || request()->is('admin/apartment-types*') ? 'true' : 'false' }}">
                    <i class="fas fa-building"></i>
                    <span class="nav-link-text">{{ __('menu.apartments') }}</span>
                    <i class="fas fa-chevron-down ms-auto"></i>
                </a>
                <div class="collapse {{ request()->is('admin/apartments*') || request()->is('admin/apartment-types*') ? 'show' : '' }}" id="apartmentsCollapse">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/apartment-types*') ? 'active' : '' }}" href="{{ route('admin.apartment-types.index') }}">
                                <i class="fas fa-tags"></i>
                                <span class="nav-link-text">{{ __('menu.apartment_types') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/apartments*') ? 'active' : '' }}" href="{{ route('admin.apartments.index') }}">
                                <i class="fas fa-list"></i>
                                <span class="nav-link-text">{{ __('menu.apartment_list') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Departments Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/sections*') ? 'active' : '' }}" href="{{ route('admin.sections.index') }}">
                    <i class="fas fa-sitemap"></i>
                    <span class="nav-link-text">{{ __('menu.departments') }}</span>
                </a>
            </li>

            <!-- Maintenance Requests -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/maintenance-requests*') ? 'active' : '' }}" href="{{ route('admin.maintenance-requests.index') }}">
                    <i class="fas fa-tools"></i>
                    <span class="nav-link-text">{{ __('menu.maintenance') }}</span>
                </a>
            </li>

            <!-- Activities -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/activities*') ? 'active' : '' }}" href="{{ route('admin.activities.index') }}">
                    <i class="fas fa-history"></i>
                    <span class="nav-link-text">{{ __('menu.activities') }}</span>
                </a>
            </li>
            
            <!-- Profile Section -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                    <i class="fas fa-user"></i>
                    <span class="nav-link-text">{{ __('nav.profile') }}</span>
                </a>
            </li>
            
            <!-- Home Link -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-link-text">{{ __('nav.home') }}</span>
                </a>
            </li>
            
            <!-- Logout -->
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-link-text">{{ __('nav.logout') }}</span>
                    </button>
                </form>
            </li>
        </ul>
        
        <!-- Footer info in sidebar -->
        <div class="mt-4 mx-3 text-muted small">
            <p class="mb-0">Laravel © {{ date('Y') }}</p>
        </div>
    </div>
</nav>

<style>
/* Sidebar Transitions */
.sidenav {
    transition: all 0.3s ease;
}

.sidenav.collapsed .nav-link-text,
.sidenav.collapsed .sidenav-footer {
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.2s ease, visibility 0.2s ease;
}

.sidenav .nav-link {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.sidenav .nav-link i,
.sidenav .nav-link svg {
    transition: margin 0.3s ease;
    min-width: 1.5rem;
    font-size: 1.1rem;
    text-align: center;
    flex-shrink: 0;
}

.sidenav .nav-link svg {
    width: 1.1rem;
    height: 1.1rem;
}

.sidenav .nav-link-text {
    transition: opacity 0.3s ease, visibility 0.3s ease;
    opacity: 1;
    visibility: visible;
}

/* Submenu Transitions */
.nav-link[data-bs-toggle="collapse"] {
    position: relative;
}

.nav-link[data-bs-toggle="collapse"] .fa-chevron-down {
    transition: transform 0.3s ease;
    font-size: 0.75rem;
    margin-inline-start: auto !important;
    margin-inline-end: 0 !important;
}

.nav-link[aria-expanded="true"] .fa-chevron-down {
    transform: rotate(180deg);
}

/* Submenu Padding */
.collapse .nav-link {
    padding-left: 3rem;
}

[dir="rtl"] .collapse .nav-link {
    padding-left: 1rem;
    padding-right: 3rem;
}

/* Mobile Styles */
@media (max-width: 992px) {
    .sidenav {
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    [dir="rtl"] .sidenav {
        transform: translateX(100%);
    }

    .sidenav.show {
        transform: translateX(0);
    }
}

/* RTL Specific Styles */
[dir="rtl"] .sidenav .nav-link i {
    margin-right: 0;
    margin-left: 0.75rem;
}

[dir="rtl"] .nav-link[data-bs-toggle="collapse"] .fa-chevron-down {
    margin-left: 0;
    margin-right: auto;
}

/* Hover Effects */
.sidenav .nav-link:hover {
    background: var(--primary-gradient);
    color: white;
    transform: translateX(5px);
}

[dir="rtl"] .sidenav .nav-link:hover {
    transform: translateX(-5px);
}

.sidenav .nav-link.active {
    background: var(--primary-gradient);
    color: white;
    box-shadow: 0 4px 6px rgba(13, 110, 253, 0.1);
}

/* Collapsed State Styles */
.sidenav.collapsed .nav-link {
    padding: 0.75rem;
    justify-content: center;
}

.sidenav.collapsed .nav-link i {
    margin: 0;
    font-size: 1.25rem;
}

.sidenav.collapsed .nav-link[data-bs-toggle="collapse"] .fa-chevron-down,
.sidenav.collapsed .collapse {
    display: none;
}
</style>
