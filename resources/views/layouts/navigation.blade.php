<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand {{ app()->getLocale() === 'ar' ? 'ms-2' : 'me-2' }}" href="{{ url('/') }}">
            {{ __('app.title') }}
        </a>

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav {{ app()->getLocale() === 'ar' ? 'ms-auto' : 'me-auto' }}">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        {{ __('nav.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('nav.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('nav.services') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('nav.contact') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav {{ app()->getLocale() === 'ar' ? 'me-auto' : 'ms-auto' }} align-items-center">
                <!-- Language Switcher -->
                <li class="nav-item">
                    <select class="form-select form-select-sm" onchange="window.location.href=this.value">
                        <option value="{{ url('lang/ar') }}" {{ app()->getLocale() === 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="{{ url('lang/en') }}" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-white ms-2" href="{{ route('login') }}">
                            {{ __('auth.login') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ms-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->role !== 'user')
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        {{ __('dashboard.title') }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
