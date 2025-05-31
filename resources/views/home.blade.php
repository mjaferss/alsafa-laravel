@extends('layouts.guest')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center">
        <div class="col-md-8 text-center">
            <!-- Language Switcher -->
            <div class="mb-4 d-flex justify-content-center">
                <div class="btn-group" role="group" aria-label="{{ __('common.language') }}">
                    <a href="{{ route('change.language', 'ar') }}" class="btn {{ app()->getLocale() === 'ar' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fas fa-globe me-1"></i> العربية
                    </a>
                    <a href="{{ route('change.language', 'en') }}" class="btn {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fas fa-globe me-1"></i> English
                    </a>
                </div>
            </div>

            <h1 class="display-4 mb-4">{{ __('home.welcome') }}</h1>
            <p class="lead mb-4">{{ __('home.description') }}</p>
            
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4">
                    {{ __('home.go_to_dashboard') }}
                </a>
            @else
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 gap-3">
                        {{ __('auth.login') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                            {{ __('auth.register') }}
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
