<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'The White Lotus') }} | Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-gold: #C5A059;
            --light-bg: #FAFAFA;
            --pure-white: #FFFFFF;
            --text-dark: #333333;
            --border-light: #E5E5E5;
        }

        body {
            font-family: 'Lato', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-bg);
            background-image: url('https://images.unsplash.com/photo-1549488391-5843c08cdde0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        
        /* Overlay */
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(8px);
            z-index: -1;
        }

        .login-card {
            background: var(--pure-white);
            border: 1px solid var(--border-light);
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            max-width: 450px;
            width: 100%;
            padding: 3rem;
            position: relative;
        }
        
        .brand-logo {
            font-family: 'Cinzel', serif;
            color: var(--text-dark);
            font-size: 2.2rem;
            text-align: center;
            margin-bottom: 2.5rem;
            text-decoration: none;
            display: block;
            font-weight: 700;
            letter-spacing: 0.05em;
        }

        .form-control {
            background-color: var(--light-bg);
            border: 1px solid transparent;
            border-bottom: 1px solid var(--border-light);
            color: var(--text-dark);
            padding: 12px 15px;
            border-radius: 0;
            font-size: 0.95rem;
            font-family: 'Lato', sans-serif;
        }

        .form-control:focus {
            background-color: var(--pure-white);
            border-color: var(--primary-gold);
            box-shadow: none;
        }

        .btn-gold {
            background-color: var(--primary-gold);
            color: #fff;
            border: 1px solid var(--primary-gold);
            width: 100%;
            padding: 12px;
            font-family: 'Cinzel', serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s ease;
            border-radius: 0;
            margin-top: 1rem;
        }

        .btn-gold:hover {
            background-color: transparent;
            color: var(--primary-gold);
        }

        .form-check-input:checked {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
        }
        
        .form-label {
            font-weight: 500;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.5rem;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.8rem;
            color: #888;
            font-family: 'Lato', sans-serif;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <a href="/" class="brand-logo">The White Lotus</a>
        {{ $slot }}
        
        <div class="footer-text">
            &copy; {{ date('Y') }} The White Lotus. Authenticated Access Only.
        </div>
    </div>
</body>
</html>
