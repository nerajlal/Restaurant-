<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Test Resto') }} | Premium Dining Experience</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #121212;
            --card-bg: #1e1e1e;
            --text-light: #f8f9fa;
            --text-muted: #adb5bd;
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-light);
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar */
        .navbar {
            padding: 1.5rem 0;
            transition: all 0.3s ease;
            background: transparent;
        }

        .navbar.scrolled {
            background-color: rgba(18, 18, 18, 0.95);
            padding: 0.8rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .navbar-brand {
            font-size: 1.8rem;
            color: var(--primary-gold) !important;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .nav-link {
            color: white !important;
            font-weight: 400;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            margin: 0 10px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background: var(--primary-gold);
            bottom: -5px;
            left: 0;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .btn-gold {
            background-color: var(--primary-gold);
            color: #000;
            border: 2px solid var(--primary-gold);
            padding: 10px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .btn-gold:hover {
            background-color: transparent;
            color: var(--primary-gold);
        }

        .btn-outline-gold {
            background-color: transparent;
            color: var(--primary-gold);
            border: 2px solid var(--primary-gold);
            padding: 10px 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .btn-outline-gold:hover {
            background-color: var(--primary-gold);
            color: #000;
        }

        /* Footer */
        footer {
            background-color: #000;
            padding: 80px 0 40px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .footer-logo {
            font-family: 'Playfair Display', serif;
            color: var(--primary-gold);
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--primary-gold);
        }

        /* Utilities */
        .text-gold {
            color: var(--primary-gold) !important;
        }

        .bg-dark-overlay {
            background: rgba(0,0,0,0.6);
        }

        .section-padding {
            padding: 100px 0;
        }
    </style>
    @stack('styles')
</head>
<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Test Resto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu.index') ? 'active' : '' }}" href="{{ route('menu.index') }}">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-gold" href="{{ route('reservation.index') }}">Book a Table</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h3 class="footer-logo">Test Resto</h3>
                    <p class="text-muted">Experience the finest dining with a blend of modern atmosphere and culinary excellence.</p>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Opening Hours</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2">Mon - Fri: 11:00 AM - 11:00 PM</li>
                        <li class="mb-2">Sat - Sun: 10:00 AM - 12:00 AM</li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="text-white mb-3">Contact Us</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-gold"></i> 123 Luxury Avenue, New York</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-gold"></i> +1 234 567 8900</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-gold"></i> info@testresto.com</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary mt-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-muted mb-0">&copy; {{ date('Y') }} Test Resto. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-muted mb-0">Designed for Luxury.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar Scrolled Effect
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('scrolled');
            } else {
                document.querySelector('.navbar').classList.remove('scrolled');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
