<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Test Resto') }} | Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-gold: #d4af37;
            --dark-bg: #fdfbf7; /* Cream/Light Background */
            --card-bg: #ffffff;
            --text-light: #333333; /* Dark Text */
        }

        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-light);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(rgba(255,255,255,0.4), rgba(255,255,255,0.4)), url('https://images.unsplash.com/photo-1514362545857-3bc16549766b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }

        .login-card {
            background-color: #ffffff;
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
            padding: 2rem;
        }

        .brand-logo {
            font-family: 'Playfair Display', serif;
            color: var(--text-light);
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .form-control {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            color: #333;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary-gold);
            color: #333;
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        .btn-gold {
            background-color: var(--primary-gold);
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background-color: #b5952f;
            color: #fff;
        }

        .form-check-input:checked {
            background-color: var(--primary-gold);
            border-color: var(--primary-gold);
        }
        
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-card animate__animated animate__fadeIn">
        <a href="/" class="brand-logo">Test Resto</a>
        {{ $slot }}
    </div>
</body>
</html>
