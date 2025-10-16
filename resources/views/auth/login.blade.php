<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - LibraRead</title>

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
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
        }
        
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #6C63FF 0%, #8B85FF 100%);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .login-right {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .logo {
            font-family: 'Figtree', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 30px;
            color: var(--primary);
        }
        
        .welcome-title {
            font-family: 'Figtree', sans-serif;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .floating-books {
            position: relative;
            height: 200px;
            margin: 30px 0;
        }
        
        .book {
            position: absolute;
            width: 80px;
            height: 110px;
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
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            background: linear-gradient(135deg, #FF9A9E 0%, #FAD0C4 100%);
        }
        
        .book:nth-child(2) {
            top: 5%;
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
            bottom: 10%;
            right: 10%;
            animation-delay: 3s;
            background: linear-gradient(135deg, #84FAB0 0%, #8FD3F4 100%);
        }
        
        .book i {
            font-size: 1.8rem;
            color: white;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-15px) rotate(5deg);
            }
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e1e1e1;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(108, 99, 255, 0.25);
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .checkbox-group input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }
        
        .checkbox-group label {
            margin-bottom: 0;
            color: #666;
        }
        
        .btn-login {
            background: var(--primary);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .btn-login:hover {
            background: #5a52e0;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }
        
        .forgot-password {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        
        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e1e1e1;
        }
        
        .divider-text {
            padding: 0 15px;
            color: #666;
            font-size: 0.9rem;
        }
        
        .social-login {
            display: flex;
            gap: 15px;
            margin-bottom: 1.5rem;
        }
        
        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            background: white;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }
        
        .social-btn i {
            margin-right: 8px;
        }
        
        .register-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 1.5rem;
        }
        
        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            border: 1px solid rgba(76, 175, 80, 0.2);
            color: #2e7d32;
        }
        
        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            border: 1px solid rgba(244, 67, 54, 0.2);
            color: #c62828;
        }
        
        .error-message {
            color: #c62828;
            font-size: 0.875rem;
            margin-top: 5px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-left {
                padding: 30px;
            }
            
            .login-right {
                padding: 30px;
            }
            
            .welcome-title {
                font-size: 2rem;
            }
            
            .floating-books {
                height: 150px;
            }
            
            .book {
                width: 60px;
                height: 80px;
            }
            
            .book i {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <h1 class="welcome-title">Selamat Datang Kembali!</h1>
            <p class="welcome-subtitle">Masuk ke akun Anda untuk melanjutkan</p>
            
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
        
        <!-- Right Side - Login Form -->
        <div class="login-right">
            <div class="logo">
                <i class="fas fa-book-open me-2"></i>E-Library
            </div>
            
            <h2 class="mb-4">Masuk ke Akun Anda</h2>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan alamat email">
                    @if ($errors->has('email'))
                        <div class="error-message">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password">
                    @if ($errors->has('password'))
                        <div class="error-message">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="checkbox-group">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Ingat saya</label>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </button>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">Lupa password?</a>
                    </div>
                @endif
            
            </form>
            
            <!-- Register Link -->
            <div class="register-link">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>