<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AlSafa') }} - @yield('title', __('common.welcome'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: {{ app()->getLocale() == 'ar' ? 'Almarai' : 'Roboto' }}, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand img {
            height: 50px;
            width: auto;
            object-fit: contain;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-header img {
            height: 70px;
            width: auto;
            object-fit: contain;
            margin-bottom: 1rem;
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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/login">
                <img src="{{ asset('images/logo.jpeg') }}" alt="AlSafa Logo">
            </a>

            <div class="d-flex align-items-center">
                <!-- Language Switcher -->
                <a href="{{ route('change.language', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="btn btn-language">
                    <i class="fas fa-globe me-1"></i>
                    @if(app()->getLocale() === 'ar')
                        <span>English</span>
                    @else
                        <span>العربية</span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">&copy; {{ date('Y') }} AlSafa. {{ __('common.rights') }}</span>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
