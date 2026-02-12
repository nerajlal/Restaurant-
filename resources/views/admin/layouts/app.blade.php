<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Admin</title>

    <!-- Google Fonts: Inter for Polaris look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            /* Polaris Colors */
            --p-surface: #ffffff;
            --p-background: #f1f2f3;
            --p-text: #202223;
            --p-text-subdued: #6d7175;
            --p-primary: #008060; /* Shopify Green */
            --p-primary-hover: #006e52;
            --p-border: #e1e3e5;
            --p-sidebar-bg: #f1f2f3; /* Or #1a1a1a for dark sidebar */
            --p-sidebar-text: #5c5f62;
            --p-sidebar-active-bg: #edeeef;
            --p-sidebar-active-text: #008060;
            --p-shadow-card: 0px 0px 5px rgba(23, 24, 24, 0.05), 0px 1px 2px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--p-background);
            color: var(--p-text);
            font-size: 0.9rem;
        }

        /* Layout Structure */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #ebebeb; /* Slight contrast */
            border-right: 1px solid var(--p-border);
            flex-shrink: 0;
            padding: 1rem 0.5rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            top: 0;
            left: 0;
        }

        .sidebar-brand {
            padding: 0 1rem 1.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--p-text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: var(--p-sidebar-text);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            background-color: rgba(0,0,0,0.05); /* very subtle hover */
            color: var(--p-text);
        }

        .nav-link.active {
            background-color: #ffffff;
            color: var(--p-primary);
            font-weight: 600;
            box-shadow: 0 1px 0 rgba(0,0,0,0.1);
        }

        .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            margin-left: 240px; /* Sidebar width */
            background-color: var(--p-background);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        .top-bar {
            background-color: #ebebeb; /* Match sidebar */
            border-bottom: 1px solid var(--p-border);
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .content-wrapper {
            padding: 2rem;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        .search-bar {
            background: #ffffff;
            border: 1px solid #d3d3d3;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            width: 400px;
            display: flex;
            align-items: center;
            color: #6d7175;
        }
        
        .search-bar input {
            border: none;
            background: transparent;
            width: 100%;
            margin-left: 0.5rem;
            outline: none;
            color: var(--p-text);
        }

        /* Polaris Card */
        .card {
            background-color: var(--p-surface);
            border: 1px solid var(--p-border); /* subtle border */
            border-radius: 8px;
            box-shadow: var(--p-shadow-card);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--p-border);
            padding: 1rem 1.25rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Typography */
        h1.h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--p-text);
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--p-primary);
            border-color: var(--p-primary);
            font-weight: 500;
            box-shadow: 0 1px 0 rgba(0,0,0,0.05);
        }

        .btn-primary:hover {
            background-color: var(--p-primary-hover);
            border-color: var(--p-primary-hover);
        }
        
        .btn-outline-secondary {
            border-color: var(--p-border);
            color: var(--p-text);
            background: white;
        }

        .btn-outline-secondary:hover {
            background-color: #f6f6f7;
            border-color: #c9cccf;
            color: var(--p-text);
        }

        /* Tables */
        .table thead th {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--p-text-subdued);
            border-bottom: 1px solid var(--p-border);
            font-weight: 600;
        }

        .table td {
            vertical-align: middle;
            color: var(--p-text);
        }
        
        .badge {
            font-weight: 400;
            padding: 0.35em 0.65em;
            border-radius: 4px;
        }
        
        .bg-success {
            background-color: #aee9d1 !important;
            color: #002f24;
        }
        
        .bg-secondary {
            background-color: #e4e5e7 !important;
            color: #454f5b;
        }

        /* Avatar */
        .user-avatar {
            width: 32px;
            height: 32px;
            background-color: #e1e3e5;
            color: #5c5f62;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 1050;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .top-bar {
                justify-content: space-between;
            }
        }
    </style>
</head>
<body>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <i class="fas fa-store text-success"></i>
                <span class="ms-2">Test Resto</span>
                <button class="btn btn-link text-muted d-md-none ms-auto" onclick="toggleSidebar()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                
                <div class="text-muted small fw-bold px-3 mt-3 mb-1 text-uppercase" style="font-size: 0.7rem;">Orders</div>
                <a class="nav-link {{ request()->routeIs('admin.reservations.*') ? 'active' : '' }}" href="{{ route('admin.reservations.index') }}">
                    <i class="fas fa-clock"></i>
                    Reservations
                </a>

                <div class="text-muted small fw-bold px-3 mt-3 mb-1 text-uppercase" style="font-size: 0.7rem;">Products</div>
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-tags"></i>
                    Categories
                </a>
                <a class="nav-link {{ request()->routeIs('admin.menu_items.*') ? 'active' : '' }}" href="{{ route('admin.menu_items.index') }}">
                    <i class="fas fa-utensils"></i>
                    Menu Items
                </a>
                
                <div class="text-muted small fw-bold px-3 mt-3 mb-1 text-uppercase" style="font-size: 0.7rem;">Marketing</div>
                <a class="nav-link {{ request()->routeIs('admin.qr_code.*') ? 'active' : '' }}" href="{{ route('admin.qr_code.index') }}">
                    <i class="fas fa-qrcode"></i>
                    QR Codes
                </a>
                
                <div class="text-muted small fw-bold px-3 mt-3 mb-1 text-uppercase" style="font-size: 0.7rem;">Online Store</div>
                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    View Website
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Header -->
            <div class="top-bar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary d-md-none me-3 border-0 bg-transparent p-0" onclick="toggleSidebar()">
                        <i class="fas fa-bars fa-lg text-secondary"></i>
                    </button>
                    
                    <!-- Search Bar (Visual Only) -->
                    <div class="search-bar d-none d-md-flex">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Notification Icon -->
                    <div class="position-relative cursor-pointer text-secondary">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>

                    <!-- User Menu -->
                    <div class="dropdown">
                        <div class="d-flex align-items-center cursor-pointer p-1 rounded hover-bg-light" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar me-2 bg-success text-white">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <span class="fw-medium d-none d-sm-inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ms-2 small text-muted"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                            <li><h6 class="dropdown-header">Signed in as <br><strong>{{ Auth::user()->email }}</strong></h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4" role="alert" style="background-color: #aee9d1; color: #002f24;">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
