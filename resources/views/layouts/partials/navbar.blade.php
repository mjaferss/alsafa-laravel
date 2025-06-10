<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top bg-white shadow-sm">
    <div class="container-fluid px-4">
        <!-- Mobile Sidebar Toggle -->
        <button class="btn btn-link d-lg-none text-dark me-2" type="button" id="mobileSidebarToggle">
            <i class="fas fa-bars fa-lg"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand me-2" href="{{ route('admin.dashboard') }}">
            <span class="fw-bold">{{ app()->getLocale() == 'ar' ? 'الصفا' : 'AlSafa' }}</span>
        </a>

        <!-- Right Side -->
        <div class="d-flex align-items-center gap-3">
            <!-- Language Switcher -->
            <a href="{{ route('change.language', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="btn btn-language">
                <i class="fas fa-globe me-1"></i>
                @if(app()->getLocale() === 'ar')
                    <span>English</span>
                @else
                    <span>العربية</span>
                @endif
            </a>

            <!-- User Menu -->
            @auth
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar-circle">
                        <span>{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                    </div>
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="userDropdown" style="min-width: 200px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-edit"></i>
                            <span>{{ __('profile.edit_profile') }}</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="px-0">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 text-danger">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>{{ __('auth.logout') }}</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
        </div>
    </div>
</nav>

<style>
.avatar-circle {
    width: 32px;
    height: 32px;
    background: var(--bs-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    flex-shrink: 0;
}

.dropdown-menu {
    padding: 0.5rem;
}

.dropdown-item {
    border-radius: 4px;
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
}

.dropdown-item:hover {
    background-color: var(--bs-light);
}

.dropdown-item.active,
.dropdown-item:active {
    background-color: var(--bs-primary);
    color: white;
}

.dropdown-item.active i,
.dropdown-item:active i {
    color: white;
}

.dropdown-divider {
    margin: 0.5rem 0;
}

form.px-0 .dropdown-item {
    width: 100%;
    border: none;
    background: none;
    text-align: left;
    cursor: pointer;
}

[dir="rtl"] form.px-0 .dropdown-item {
    text-align: right;
}

/* Language Switcher Styles */
.btn-language {
    color: #333;
    text-decoration: none;
    padding: 8px 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: white;
    transition: all 0.3s ease;
}

.btn-language:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd;
    color: #0d6efd;
    text-decoration: none;
}

.btn-language i {
    font-size: 16px;
}

.btn-language span {
    font-weight: 500;
}

/* RTL Support */
[dir="rtl"] .me-2 {
    margin-right: 0 !important;
    margin-left: 0.5rem !important;
}

[dir="rtl"] .dropdown-menu-end {
    --bs-position: start;
}

[dir="rtl"] .btn-language i {
    margin-right: 0;
    margin-left: 8px;
}
</style> 