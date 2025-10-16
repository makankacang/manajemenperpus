<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Perpustakaan Digital') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6C63FF;
            --secondary: #FF6584;
            --accent: #36D1DC;
            --dark: #2D2B55;
            --light: #F8F9FA;
            --success: #4CAF50;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9f7fe;
            color: #333;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5 {
            font-family: 'Figtree', sans-serif;
            font-weight: 600;
        }
        
        .navbar-brand {
            font-family: 'Figtree', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary) !important;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #6C63FF 0%, #36D1DC 100%);
            color: white;
            padding: 120px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .btn-hero {
            background: white;
            color: var(--primary);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .floating-books {
            position: relative;
            height: 400px;
        }
        
        .book {
            position: absolute;
            width: 120px;
            height: 160px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transform-origin: center;
            animation: float 6s ease-in-out infinite;
        }
        
        .book:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
            background: linear-gradient(135deg, #FF9A9E 0%, #FAD0C4 100%);
        }
        
        .book:nth-child(2) {
            top: 10%;
            right: 15%;
            animation-delay: 1s;
            background: linear-gradient(135deg, #A1C4FD 0%, #C2E9FB 100%);
        }
        
        .book:nth-child(3) {
            bottom: 15%;
            left: 20%;
            animation-delay: 2s;
            background: linear-gradient(135deg, #FFECD2 0%, #FCB69F 100%);
        }
        
        .book:nth-child(4) {
            bottom: 25%;
            right: 10%;
            animation-delay: 3s;
            background: linear-gradient(135deg, #84FAB0 0%, #8FD3F4 100%);
        }
        
        .book i {
            font-size: 2.5rem;
            color: white;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--primary);
            border-radius: 2px;
        }
        
        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.03);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }
        
        .feature-1 .feature-icon {
            background: linear-gradient(135deg, #6C63FF 0%, #8B85FF 100%);
        }
        
        .feature-2 .feature-icon {
            background: linear-gradient(135deg, #FF6584 0%, #FF8CA1 100%);
        }
        
        .feature-3 .feature-icon {
            background: linear-gradient(135deg, #36D1DC 0%, #5B86E5 100%);
        }
        
        .book-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        
        .book-cover {
            height: 250px;
            background-size: cover;
            background-position: center;
        }
        
        .book-info {
            padding: 1.5rem;
        }
        
        .book-category {
            display: inline-block;
            background: rgba(108, 99, 255, 0.1);
            color: var(--primary);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .stats-section {
            background: linear-gradient(135deg, #2D2B55 0%, #434190 100%);
            color: white;
            padding: 80px 0;
            border-radius: 20px;
            margin: 100px 0;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--accent);
        }
        
        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .cta-section {
            background: white;
            border-radius: 20px;
            padding: 60px 40px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            margin: 80px 0;
            text-align: center;
        }
        
        .btn-primary-custom {
            background: var(--primary);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary-custom:hover {
            background: #5a52e0;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }
        
        .btn-secondary-custom {
            background: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 10px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-secondary-custom:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }
        
        footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-links h5 {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .footer-links h5::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--accent);
        }
        
        .footer-links ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        .social-icons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin-right: 10px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        .copyright {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 40px;
            text-align: center;
            color: rgba(255,255,255,0.6);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .floating-books {
                height: 200px;
                margin-top: 2rem;
            }
            
            .book {
                width: 80px;
                height: 110px;
            }
            
            .book i {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-book-open me-2"></i><span class="fw-bold ms-2 text-dark">E-Library</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="btn btn btn-primary-custom ms-2">
                                    Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn btn-primary-custom ms-2">
                                    Masuk
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-primary-custom ms-2">
                                        Daftar
                                    </a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title">Jelajahi Dunia Melalui Buku</h1>
                    <p class="hero-subtitle">Akses ribuan buku digital, jurnal, dan materi pembelajaran dari perpustakaan digital terbaik. Baca kapan saja, di mana saja.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-hero">
                                Jelajahi Koleksi <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-hero">
                                Mulai Sekarang <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="floating-books">
                        <div class="book">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="book">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="book">
                            <i class="fas fa-feather-alt"></i>
                        </div>
                        <div class="book">
                            <i class="fas fa-pencil-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer>
                
            <div class="copyright">
                <p>&copy; {{ date('Y') }} E-Library. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.feature-card, .book-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            elements.forEach(el => {
                el.style.opacity = 0;
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(el);
            });
        });
    </script>
</body>
</html>