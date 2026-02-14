<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts: Cinzel (Headers) & Lato (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-gold: #C5A059; /* Muted Gold */
            --light-bg: #FAFAFA; /* Alabaster */
            --pure-white: #FFFFFF;
            --text-dark: #333333; /* Dark Slate */
            --text-muted: #666666;
            --border-light: #E5E5E5;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
            line-height: 1.8;
        }

        h1, h2, h3, h4, h5, h6, .font-cinzel {
            font-family: 'Cinzel', serif;
            letter-spacing: 0.05em;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-light);
            transition: all 0.3s ease;
            padding: 1.5rem 0;
        }

        .navbar-brand {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--text-dark) !important;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .nav-link {
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            color: var(--text-dark) !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.15em;
            margin: 0 1rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 1px;
            background: var(--primary-gold);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        /* Buttons */
        .btn-gold {
            background-color: var(--primary-gold);
            color: #fff;
            border: 1px solid var(--primary-gold);
            padding: 0.8rem 2rem;
            font-family: 'Cinzel', serif;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: transparent;
            color: var(--primary-gold);
        }

        .btn-outline-gold {
            background-color: transparent;
            color: var(--primary-gold);
            border: 1px solid var(--primary-gold);
            padding: 0.8rem 2rem;
            font-family: 'Cinzel', serif;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            border-radius: 0;
            transition: all 0.3s ease;
        }

        .btn-outline-gold:hover {
            background-color: var(--primary-gold);
            color: #fff;
        }

        /* Utilities */
        .text-gold { color: var(--primary-gold) !important; }
        .bg-light-texture { background-color: var(--light-bg); }
        
        /* Footer */
        footer {
            background-color: var(--pure-white);
            border-top: 1px solid var(--border-light);
            padding: 4rem 0;
        }

        .footer-link {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            font-family: 'Lato', sans-serif;
        }

        .footer-link:hover {
            color: var(--primary-gold);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand mx-auto d-lg-none" href="/">The White Lotus</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center text-center" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu.*') ? 'active' : '' }}" href="{{ route('menu.index') }}">Menu</a></li>
                    
                    <li class="nav-item mx-4 d-none d-lg-block">
                        <a class="navbar-brand" href="/">The White Lotus</a>
                    </li>
                    
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            
            <!-- Right Actions (Cart/Auth) -->
            <div class="position-absolute end-0 top-50 translate-middle-y me-4 d-none d-lg-flex gap-3 align-items-center">
                @if(session('table_id'))
                    <a href="#" class="text-dark position-relative" data-bs-toggle="modal" data-bs-target="#cartModal">
                        <i class="fas fa-shopping-bag fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            {{ count(session('cart', [])) }}
                        </span>
                    </a>
                @else
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-dark"><i class="fas fa-user fa-lg"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="text-dark"><i class="far fa-user fa-lg"></i></a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main style="padding-top: 100px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <h2 class="font-cinzel text-dark mb-4">The White Lotus</h2>
            <div class="d-flex justify-content-center gap-4 mb-5">
                <a href="{{ route('home') }}" class="footer-link">Home</a>
                <a href="{{ route('menu.index') }}" class="footer-link">Menu</a>
                <a href="{{ route('about') }}" class="footer-link">About</a>
                <a href="{{ route('contact') }}" class="footer-link">Contact</a>
            </div>
            <div class="mb-4">
                <a href="#" class="text-muted mx-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-muted mx-2"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-muted mx-2"><i class="fab fa-twitter"></i></a>
            </div>
            <p class="text-muted small mb-0">&copy; {{ date('Y') }} The White Lotus. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50
        });
    </script>
</body>
</html>
