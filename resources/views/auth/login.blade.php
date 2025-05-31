@extends('layouts.guest')



@section('title', __('auth.login'))

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card">
                    <div class="card-body p-4 p-lg-5">
                        <div class="auth-header">
                            <img src="{{ asset('images/logo.jpeg') }}" alt="AlSafa Logo">
                            <h4>{{ __('auth.login_welcome') }}</h4>
                            <p class="text-muted">{{ __('auth.login_message') }}</p>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        @error('email')
                            <div class="alert alert-danger mb-4">
                                {{ __('auth.messages.'.$message) }}
                            </div>
                        @enderror

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('auth.email') }}" required autofocus>
                                <label for="email">{{ __('auth.email') }}</label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('auth.password') }}" required>
                                <label for="password">{{ __('auth.password') }}</label>
                            </div>

                            <!-- Remember Me -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember_me') }}
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('auth.forgot_password') }}
                                    </a>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-3 mb-4">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                {{ __('auth.login') }}
                            </button>

                            @if (Route::has('register'))
                                <div class="text-center">
                                    <p class="mb-0">{{ __('auth.no_account') }}
                                        <a href="{{ route('register') }}" class="text-primary text-decoration-none">
                                            {{ __('auth.register') }}
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
