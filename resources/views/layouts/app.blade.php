<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #6C63FF;
                --primary-hover: #5a52e0;
                --secondary: #FF6584;
                --accent: #36D1DC;
                --success: #1cc88a;
                --warning: #f6c23e;
                --info: #36b9cc;
                --light: #f8f9fa;
                --dark: #2D2B55;
                --border-radius: 0.75rem;
                
                /* Light theme */
                --bg-primary: #ffffff;
                --bg-secondary: #f8f9fa;
                --bg-sidebar: #ffffff;
                --text-primary: #212529;
                --text-secondary: #6c757d;
                --border-color: #dee2e6;
                --card-bg: #ffffff;
                --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                --hover-bg: #e9ecef;
                --table-bg: #ffffff;
                --table-border: #dee2e6;
                --dropdown-bg: #ffffff;
            }

            [data-theme="dark"] {
                /* Dark theme */
                --bg-primary: #1a1a2e;
                --bg-secondary: #16213e;
                --bg-sidebar: #0f3460;
                --text-primary: #e9ecef;
                --text-secondary: #adb5bd;
                --border-color: #2d3748;
                --card-bg: #16213e;
                --shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
                --hover-bg: #2d3748;
                --table-bg: #16213e;
                --table-border: #2d3748;
                --dropdown-bg: #16213e;
            }

            /* ===== GLOBAL STYLES ===== */
            body {
                font-family: 'Figtree', sans-serif;
                background-color: var(--bg-primary);
                color: var(--text-primary);
                transition: background-color 0.3s ease, color 0.3s ease;
            }

            /* ===== TEXT COLORS ===== */
            .text-dark { color: var(--text-primary) !important; }
            .text-muted { color: var(--text-secondary) !important; }
            .text-gray-800 { color: var(--text-primary) !important; }
            .text-gray-300 { color: var(--text-secondary) !important; }
            .text-primary { color: var(--primary) !important; }
            .text-success { color: var(--success) !important; }
            .text-warning { color: var(--warning) !important; }
            .text-info { color: var(--info) !important; }
            .text-danger { color: var(--secondary) !important; }

            /* ===== BACKGROUND COLORS ===== */
            .bg-light { background-color: var(--bg-secondary) !important; }
            .bg-white { background-color: var(--card-bg) !important; }
            .bg-primary { background-color: var(--primary) !important; }
            .bg-success { background-color: var(--success) !important; }
            .bg-warning { background-color: var(--warning) !important; }
            .bg-info { background-color: var(--info) !important; }
            .bg-danger { background-color: var(--secondary) !important; }

            /* ===== BORDER COLORS ===== */
            .border { border-color: var(--border-color) !important; }
            .border-bottom { border-bottom-color: var(--border-color) !important; }
            .border-top { border-top-color: var(--border-color) !important; }
            .border-start { border-left-color: var(--border-color) !important; }
            .border-end { border-right-color: var(--border-color) !important; }

            /* ===== CARD STYLES ===== */
            .card {
                transition: transform 0.2s, background-color 0.3s ease, border-color 0.3s ease;
                border: 1px solid var(--border-color);
                background-color: var(--card-bg);
                box-shadow: var(--shadow);
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(0,0,0,0.15);
            }

            .card-header {
                background-color: var(--card-bg);
                border-bottom: 1px solid var(--border-color);
            }

            .border-left-primary { border-left: 4px solid var(--primary) !important; }
            .border-left-success { border-left: 4px solid var(--success) !important; }
            .border-left-info { border-left: 4px solid var(--info) !important; }
            .border-left-warning { border-left: 4px solid var(--warning) !important; }

            /* ===== TABLE STYLES ===== */
            .table {
                color: var(--text-primary);
                background-color: var(--table-bg);
                border-color: var(--table-border);
            }

            .table th {
                border-top: none;
                font-weight: 600;
                font-size: 0.875rem;
                background-color: var(--bg-secondary);
                border-bottom: 1px solid var(--border-color);
                color: var(--text-primary);
            }

            .table td {
                border-color: var(--border-color);
                background-color: var(--table-bg);
                color: var(--text-primary);
            }

            .table-hover tbody tr:hover {
                background-color: var(--hover-bg);
                color: var(--text-primary);
            }

            .table-bordered {
                border: 1px solid var(--border-color);
            }

            .table-bordered th,
            .table-bordered td {
                border: 1px solid var(--border-color);
            }

            .table-light {
                background-color: var(--bg-secondary);
            }

            .table-light th {
                background-color: var(--bg-secondary);
                color: var(--text-primary);
            }

            /* ===== BUTTON STYLES ===== */
            .btn {
                transition: all 0.3s ease;
            }

            .btn-primary {
                background-color: var(--primary);
                border-color: var(--primary);
            }

            .btn-primary:hover {
                background-color: var(--primary-hover);
                border-color: var(--primary-hover);
            }

            .btn-outline-primary {
                color: var(--primary);
                border-color: var(--primary);
            }

            .btn-outline-primary:hover {
                background-color: var(--primary);
                border-color: var(--primary);
                color: white;
            }

            .btn-outline-secondary {
                color: var(--text-secondary);
                border-color: var(--border-color);
                background-color: transparent;
            }

            .btn-outline-secondary:hover {
                background-color: var(--border-color);
                border-color: var(--border-color);
                color: var(--text-primary);
            }

            .btn-outline-success {
                color: var(--success);
                border-color: var(--success);
            }

            .btn-outline-success:hover {
                background-color: var(--success);
                border-color: var(--success);
                color: white;
            }

            .btn-outline-info {
                color: var(--info);
                border-color: var(--info);
            }

            .btn-outline-info:hover {
                background-color: var(--info);
                border-color: var(--info);
                color: white;
            }

            .btn-light {
                background-color: var(--card-bg);
                border-color: var(--border-color);
                color: var(--text-primary);
            }

            .btn-light:hover {
                background-color: var(--hover-bg);
                border-color: var(--border-color);
                color: var(--text-primary);
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }

            /* ===== ALERT STYLES ===== */
            .alert {
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
                color: var(--text-primary);
            }

            .alert-success {
                background-color: rgba(28, 200, 138, 0.1);
                border-color: rgba(28, 200, 138, 0.3);
                color: var(--text-primary);
            }

            .alert-warning {
                background-color: rgba(246, 194, 62, 0.1);
                border-color: rgba(246, 194, 62, 0.3);
                color: var(--text-primary);
            }

            .alert-info {
                background-color: rgba(54, 185, 204, 0.1);
                border-color: rgba(54, 185, 204, 0.3);
                color: var(--text-primary);
            }

            .alert-danger {
                background-color: rgba(255, 101, 132, 0.1);
                border-color: rgba(255, 101, 132, 0.3);
                color: var(--text-primary);
            }

            /* ===== FORM STYLES ===== */
            .form-control, .form-select {
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
                color: var(--text-primary);
            }

            .form-control:focus, .form-select:focus {
                background-color: var(--card-bg);
                border-color: var(--primary);
                color: var(--text-primary);
                box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.25);
            }

            .form-label {
                color: var(--text-primary);
            }

            .form-text {
                color: var(--text-secondary) !important;
            }

            .is-invalid {
                border-color: var(--secondary) !important;
            }

            .invalid-feedback {
                color: var(--secondary);
            }

            /* ===== DROPDOWN STYLES ===== */
            .dropdown-menu {
                background-color: var(--dropdown-bg);
                border: 1px solid var(--border-color);
                box-shadow: var(--shadow);
            }

            .dropdown-item {
                color: var(--text-primary);
                transition: background-color 0.2s;
            }

            .dropdown-item:hover {
                background-color: var(--hover-bg);
                color: var(--text-primary);
            }

            .dropdown-divider {
                border-color: var(--border-color);
            }

            /* ===== MODAL STYLES ===== */
            .modal-content {
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
            }

            .modal-header {
                border-bottom: 1px solid var(--border-color);
            }

            .modal-footer {
                border-top: 1px solid var(--border-color);
            }

            /* ===== LIST GROUP STYLES ===== */
            .list-group-item {
                background-color: var(--card-bg);
                border-color: var(--border-color);
                color: var(--text-primary);
            }

            .list-group-flush .list-group-item {
                border-color: var(--border-color);
            }

            /* ===== CODE STYLES ===== */
            code {
                background-color: var(--bg-secondary);
                color: var(--text-primary);
                border: 1px solid var(--border-color);
            }

            /* ===== BADGE STYLES ===== */
            .badge {
                font-size: 0.75rem;
            }

            .badge.bg-light {
                background-color: var(--bg-secondary) !important;
                color: var(--text-primary) !important;
            }

            /* ===== SIDEBAR STYLES ===== */
            .sidebar {
                width: 250px;
                height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                background: var(--bg-sidebar);
                border-right: 1px solid var(--border-color);
                z-index: 1000;
                transition: all 0.3s;
            }

            .sidebar-header {
                padding: 1.5rem 1rem;
                border-bottom: 1px solid var(--border-color);
                text-align: center;
            }

            .sidebar-nav {
                padding: 1rem 0;
            }

            .nav-link {
                color: var(--text-primary);
                padding: 0.75rem 1.5rem;
                margin: 0.25rem 0.5rem;
                border-radius: var(--border-radius);
                text-decoration: none;
                display: flex;
                align-items: center;
                transition: all 0.2s;
            }

            .nav-link:hover {
                background-color: var(--hover-bg);
                color: var(--text-primary);
            }

            .nav-link.active {
                background-color: var(--primary);
                color: white;
            }

            .nav-link i {
                width: 20px;
                margin-right: 0.75rem;
            }

            /* ===== MAIN CONTENT STYLES ===== */
            .main-content {
                margin-left: 250px;
                min-height: 100vh;
                transition: all 0.3s;
                background-color: var(--bg-primary);
            }

            .top-header {
                background: var(--bg-primary);
                border-bottom: 1px solid var(--border-color);
                padding: 1rem 2rem;
            }

            .page-content {
                padding: 2rem;
                background-color: var(--bg-primary);
            }

            .page-header {
                border-bottom: 1px solid var(--border-color);
                padding-bottom: 1rem;
            }

            /* ===== BOOK CARD STYLES ===== */
            .book-card {
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                border: none;
                box-shadow: var(--shadow);
                border-radius: 12px;
                overflow: hidden;
                cursor: pointer;
                position: relative;
                background-color: var(--card-bg);
            }

            .book-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .book-cover {
                height: 280px;
                object-fit: cover;
                width: 100%;
                transition: all 0.4s ease;
            }

            .book-card:hover .book-cover {
                transform: scale(1.1);
                filter: brightness(0.7);
            }

            .book-info {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
                color: white;
                padding: 2rem 1rem 1rem;
                transform: translateY(100%);
                opacity: 0;
            }

            .book-card:hover .book-info {
                transform: translateY(0);
                opacity: 1;
            }

            .book-actions {
                position: absolute;
                top: 1rem;
                right: 1rem;
                display: flex;
                gap: 0.5rem;
                opacity: 0;
                transform: translateY(-10px);
                transition: all 0.3s ease;
            }

            .book-card:hover .book-actions {
                opacity: 1;
                transform: translateY(0);
            }

            .book-title {
                font-size: 1.1rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                line-height: 1.3;
            }

            .book-meta {
                font-size: 0.85rem;
                opacity: 0.9;
                line-height: 1.4;
            }

            .book-badge {
                position: absolute;
                top: 1rem;
                left: 1rem;
                z-index: 2;
            }

            /* ===== ACTION BUTTONS ===== */
            .btn-action {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                border: none;
                transition: all 0.3s ease;
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.2);
                color: white;
            }

            .btn-action:hover {
                transform: scale(1.1);
                background: rgba(255, 255, 255, 0.3);
            }

            /* ===== DARK MODE TOGGLE ===== */
            .theme-toggle {
                background: none;
                border: none;
                color: var(--text-primary);
                font-size: 1.25rem;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0.5rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .theme-toggle:hover {
                background-color: var(--hover-bg);
                transform: rotate(15deg);
            }

            .theme-toggle .fa-sun {
                display: none;
            }

            [data-theme="dark"] .theme-toggle .fa-moon {
                display: none;
            }

            [data-theme="dark"] .theme-toggle .fa-sun {
                display: block;
            }

            /* ===== EMPTY STATE ===== */
            .empty-state-icon {
                color: var(--text-secondary);
            }

            /* ===== PAGINATION ===== */
            .pagination .page-link {
                background-color: var(--card-bg);
                border-color: var(--border-color);
                color: var(--text-primary);
            }

            .pagination .page-link:hover {
                background-color: var(--hover-bg);
                border-color: var(--border-color);
                color: var(--text-primary);
            }

            .pagination .page-item.active .page-link {
                background-color: var(--primary);
                border-color: var(--primary);
            }

            /* ===== GRADIENT BACKGROUNDS ===== */
            .bg-gradient-primary {
                background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%) !important;
            }

            /* ===== MOBILE RESPONSIVE ===== */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                }
                
                .sidebar.show {
                    transform: translateX(0);
                }
                
                .main-content {
                    margin-left: 0;
                }
                
                .book-card:hover {
                    transform: translateY(-4px) scale(1.01);
                }
                
                .book-info {
                    transform: translateY(0);
                    opacity: 1;
                    position: relative;
                    background: var(--bg-secondary);
                    color: var(--text-primary);
                    padding: 1rem;
                }
                
                .book-actions {
                    opacity: 1;
                    transform: translateY(0);
                    position: relative;
                    top: 0;
                    right: 0;
                    justify-content: center;
                    margin-top: 1rem;
                }
                
                .btn-action {
                    background: var(--text-secondary);
                    color: white;
                }
            }

            .search-container {
                position: relative;
            }

            .search-results {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                z-index: 1050;
                background-color: var(--card-bg);
                border: 1px solid var(--border-color);
                border-radius: var(--border-radius);
                box-shadow: var(--shadow);
            }

            .search-category {
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--text-secondary);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                padding: 0.5rem 1rem;
                background-color: var(--bg-secondary);
                border-bottom: 1px solid var(--border-color);
            }

            .search-item {
                display: flex;
                align-items: center;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid var(--border-color);
                text-decoration: none;
                color: var(--text-primary);
                transition: background-color 0.2s;
                cursor: pointer;
            }

            .search-item:hover {
                background-color: var(--hover-bg);
                text-decoration: none;
                color: var(--text-primary);
            }

            .search-item:last-child {
                border-bottom: none;
            }

            .search-item-image {
                width: 40px;
                height: 50px;
                object-fit: cover;
                border-radius: 4px;
                margin-right: 1rem;
                flex-shrink: 0;
            }

            .search-item-icon {
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: var(--bg-secondary);
                border-radius: 4px;
                margin-right: 1rem;
                flex-shrink: 0;
                color: var(--text-secondary);
            }

            .search-item-content {
                flex: 1;
                min-width: 0;
            }

            .search-item-title {
                font-weight: 600;
                font-size: 0.9rem;
                margin-bottom: 0.25rem;
                color: var(--text-primary);
            }

            .search-item-subtitle {
                font-size: 0.8rem;
                color: var(--text-secondary);
                margin-bottom: 0.25rem;
            }

            .search-item-info {
                font-size: 0.75rem;
                color: var(--text-secondary);
            }

            .search-item-badge {
                font-size: 0.7rem;
                margin-left: 0.5rem;
            }

            .search-no-results {
                padding: 2rem 1rem;
                text-align: center;
                color: var(--text-secondary);
            }

            .search-no-results i {
                font-size: 2rem;
                margin-bottom: 0.5rem;
                opacity: 0.5;
            }

            .text-gray-900 {
    color: var(--text-primary) !important;
}

.text-gray-600 {
    color: var(--text-secondary) !important;
}

.text-gray-800 {
    color: var(--text-primary) !important;
}

/* Background colors untuk Breeze */
.bg-white {
    background-color: var(--card-bg) !important;
}

/* Form inputs untuk Breeze */
.mt-1 block w-full {
    background-color: var(--card-bg) !important;
    border-color: var(--border-color) !important;
    color: var(--text-primary) !important;
}

/* Focus states untuk Breeze */
.focus\:ring-indigo-500:focus {
    --tw-ring-color: var(--primary) !important;
}

.focus\:border-indigo-500:focus {
    border-color: var(--primary) !important;
}

/* Button styles untuk Breeze */
.bg-indigo-600 {
    background-color: var(--primary) !important;
}

.bg-indigo-600:hover {
    background-color: var(--primary-hover) !important;
}

/* Alert colors untuk Breeze */
.text-green-600 {
    color: var(--success) !important;
}

.text-red-600 {
    color: var(--secondary) !important;
}

/* Verification message */
.bg-gray-100 {
    background-color: var(--bg-secondary) !important;
}
        </style>
    </head>
    <body>
        <div class="d-flex">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-header">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fas fa-book-open me-2"></i><span class="fw-bold ms-2">E-Library</span>
                        </div>
                    </a>
                </div>
                
                <div class="sidebar-nav">
                    <!-- Dashboard -->
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>

                    <!-- Data Buku -->
                    <a class="nav-link {{ request()->routeIs('buku*') ? 'active' : '' }}" href="{{ route('buku') }}">
                        <i class="bi bi-book"></i> Data Buku
                    </a>
                    
                    @if(Auth::user()->role->nama === 'Admin')
                    <!-- Data Anggota -->
                    <a class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                        <i class="bi bi-people"></i> Data Anggota
                    </a>
                    @endif

                    <!-- Peminjaman -->
                    <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                        <i class="bi bi-journal-text"></i> Peminjaman
                    </a>

                    <!-- Pengembalian -->
                    @if(Auth::user()->role->nama === 'Admin')
                    <a class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
                        <i class="bi bi-arrow-return-left"></i> Pengembalian
                    </a>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content flex-grow-1">
                <!-- Top Header -->
                <div class="top-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary d-md-none menu-toggle me-3">
                            <i class="bi bi-list"></i>
                        </button>
                        <h4 class="mb-0 fw-bold">
                            {{ $pageTitle ?? 'Data Buku' }}
                        </h4>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <!-- Dark Mode Toggle -->
                        <button class="theme-toggle me-3" id="themeToggle" title="Toggle dark mode">
                            <i class="fas fa-moon"></i>
                            <i class="fas fa-sun"></i>
                        </button>

                        <!-- Search Box -->
                        <div class="search-container position-relative me-3">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" 
                                    class="form-control" 
                                    id="globalSearch" 
                                    placeholder="Cari buku, peminjaman, kategori..."
                                    aria-label="Search">
                                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                            
                            <!-- Search Results Dropdown -->
                            <div class="search-results dropdown-menu w-100" id="searchResults" 
                                style="max-height: 400px; overflow-y: auto; display: none;">
                                <div class="p-2 text-center text-muted" id="searchLoading">
                                    <div class="spinner-border spinner-border-sm me-2" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    Mencari...
                                </div>
                                <div id="searchResultsContent"></div>
                            </div>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                <div class="me-2 text-end">
                                    <div class="fw-semibold">{{ Auth::user()->name }}</div>
                                    <small class="text-muted text-capitalize">{{ Auth::user()->role->nama ?? 'User' }}</small>
                                </div>
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Mobile menu toggle
            document.addEventListener('DOMContentLoaded', function() {
                const menuToggle = document.querySelector('.menu-toggle');
                const sidebar = document.querySelector('.sidebar');
                
                if (menuToggle && sidebar) {
                    menuToggle.addEventListener('click', function() {
                        sidebar.classList.toggle('show');
                    });
                }
                
                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 768) {
                        if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                            sidebar.classList.remove('show');
                        }
                    }
                });

                // Dark Mode Toggle
                const themeToggle = document.getElementById('themeToggle');
                const currentTheme = localStorage.getItem('theme') || 'light';
                
                // Set initial theme
                document.documentElement.setAttribute('data-theme', currentTheme);
                
                themeToggle.addEventListener('click', function() {
                    const currentTheme = document.documentElement.getAttribute('data-theme');
                    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                    
                    document.documentElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    
                    // Add animation class
                    themeToggle.classList.add('theme-transition');
                    setTimeout(() => {
                        themeToggle.classList.remove('theme-transition');
                    }, 300);
                });
                
                // Detect system preference
                if (currentTheme === 'system' || !currentTheme) {
                    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                    }
                }
                
                // Listen for system theme changes
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
                    if (localStorage.getItem('theme') === 'system' || !localStorage.getItem('theme')) {
                        const newTheme = event.matches ? 'dark' : 'light';
                        document.documentElement.setAttribute('data-theme', newTheme);
                    }
                });
            });


document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('globalSearch');
    const searchButton = document.getElementById('searchButton');
    const searchResults = document.getElementById('searchResults');
    const searchResultsContent = document.getElementById('searchResultsContent');
    const searchLoading = document.getElementById('searchLoading');
    
    let searchTimeout;
    let currentSearchQuery = '';

    // Function to perform search
    function performSearch(query) {
        if (query.length < 2) {
            hideSearchResults();
            return;
        }

        currentSearchQuery = query;
        showLoading();

        fetch(`/search?q=${encodeURIComponent(query)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (query === currentSearchQuery) {
                displaySearchResults(data);
            }
        })
        .catch(error => {
            console.error('Search error:', error);
            if (query === currentSearchQuery) {
                displaySearchResults([]);
            }
        });
    }

    // Function to display search results
    function displaySearchResults(results) {
        searchResultsContent.innerHTML = '';

        if (results.length === 0) {
            searchResultsContent.innerHTML = `
                <div class="search-no-results">
                    <i class="bi bi-search"></i>
                    <p class="mb-0">Tidak ada hasil ditemukan</p>
                    <small>Coba dengan kata kunci lain</small>
                </div>
            `;
        } else {
            results.forEach(category => {
                const categoryElement = document.createElement('div');
                categoryElement.className = 'search-category';
                categoryElement.textContent = category.category;
                searchResultsContent.appendChild(categoryElement);

                category.items.forEach(item => {
                    const itemElement = document.createElement('a');
                    itemElement.href = item.url;
                    itemElement.className = 'search-item';
                    
                    // Determine icon based on type
                    let iconClass = 'bi-book';
                    if (item.type === 'peminjaman') iconClass = 'bi-journal-text';
                    if (item.type === 'kategori') iconClass = 'bi-tag';
                    if (item.type === 'penulis') iconClass = 'bi-person';
                    
                    // Determine badge color based on status
                    let badgeClass = 'bg-secondary';
                    if (item.status === 'dipinjam') badgeClass = 'bg-primary';
                    if (item.status === 'dikembalikan') badgeClass = 'bg-success';
                    if (item.status === 'menunggu_konfirmasi') badgeClass = 'bg-warning';
                    if (item.status === 'ditolak') badgeClass = 'bg-danger';
                    
                    const badgeHtml = item.status ? 
                        `<span class="badge ${badgeClass} search-item-badge">${item.status}</span>` : 
                        (item.stok !== undefined ? 
                            `<span class="badge ${item.stok > 0 ? 'bg-success' : 'bg-danger'} search-item-badge">
                                ${item.stok} stok
                            </span>` : 
                            ''
                        );

                    const imageHtml = item.image ? 
                        `<img src="${item.image}" alt="${item.title}" class="search-item-image">` :
                        `<div class="search-item-icon">
                            <i class="bi ${iconClass}"></i>
                         </div>`;

                    itemElement.innerHTML = `
                        ${imageHtml}
                        <div class="search-item-content">
                            <div class="search-item-title">${item.title} ${badgeHtml}</div>
                            <div class="search-item-subtitle">${item.subtitle}</div>
                            <div class="search-item-info">${item.info}</div>
                        </div>
                    `;
                    
                    searchResultsContent.appendChild(itemElement);
                });
            });
        }

        hideLoading();
        showSearchResults();
    }

    // Helper functions
    function showLoading() {
        searchLoading.style.display = 'block';
        searchResultsContent.style.display = 'none';
        showSearchResults();
    }

    function hideLoading() {
        searchLoading.style.display = 'none';
        searchResultsContent.style.display = 'block';
    }

    function showSearchResults() {
        searchResults.style.display = 'block';
    }

    function hideSearchResults() {
        searchResults.style.display = 'none';
    }

    // Event listeners
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length >= 2) {
            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        } else {
            hideSearchResults();
        }
    });

    searchInput.addEventListener('focus', function() {
        if (currentSearchQuery.length >= 2) {
            showSearchResults();
        }
    });

    searchButton.addEventListener('click', function() {
        const query = searchInput.value.trim();
        if (query.length >= 2) {
            performSearch(query);
        }
    });

    // Hide search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            hideSearchResults();
        }
    });

    // Keyboard navigation
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideSearchResults();
            searchInput.blur();
        }
        
        if (e.key === 'Enter') {
            const query = searchInput.value.trim();
            if (query.length >= 2) {
                performSearch(query);
                e.preventDefault();
            }
        }
    });
});
        </script>

        @stack('scripts')
    </body>
</html>