@extends('layouts.guest')

@section('content')
<div class="welcome-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="welcome-content">
                    <!-- شعار الموقع -->
                    <img src="{{ asset('images/logo.jpeg') }}" alt="{{ config('app.name') }}" class="welcome-logo mb-4">
                    
                    <h1 class="welcome-title mb-4">{{ __('home.welcome') }}</h1>
                    <p class="welcome-description mb-5">{{ __('home.description') }}</p>

                    <div class="welcome-buttons">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                {{ __('home.go_to_dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                {{ __('auth.login') }}
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>
                                    {{ __('auth.register') }}
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- قسم الخدمات -->
                    <div class="services-section mt-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="service-card">
                                    <i class="fas fa-tools service-icon"></i>
                                    <h3>{{ __('app.services.title') }}</h3>
                                    <p>{{ __('app.services.description') }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-card">
                                    <i class="fas fa-calendar-check service-icon"></i>
                                    <h3>{{ __('app.scheduling.title') }}</h3>
                                    <p>{{ __('app.scheduling.description') }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="service-card">
                                    <i class="fas fa-chart-line service-icon"></i>
                                    <h3>{{ __('app.progress.title') }}</h3>
                                    <p>{{ __('app.progress.description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.welcome-page {
    padding: 4rem 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.welcome-logo {
    max-width: 200px;
    height: auto;
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #2c3e50;
}

.welcome-description {
    font-size: 1.2rem;
    color: #6c757d;
}

.service-card {
    padding: 2rem;
    text-align: center;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    margin-bottom: 1rem;
}

.service-card:hover {
    transform: translateY(-5px);
}

.service-icon {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 1rem;
}

.service-card h3 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.service-card p {
    color: #6c757d;
}

.welcome-buttons .btn {
    padding: 0.8rem 2rem;
    font-weight: 600;
}

[dir="rtl"] .me-2 {
    margin-left: 0.5rem !important;
    margin-right: 0 !important;
}

[dir="rtl"] .me-3 {
    margin-left: 1rem !important;
    margin-right: 0 !important;
}
</style>
@endsection 