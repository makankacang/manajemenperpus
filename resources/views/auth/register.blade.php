<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - E-Library</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        
        .register-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
        }
        
        .register-left {
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
        
        .register-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        .register-right {
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
        
        .password-strength {
            margin-top: 5px;
            height: 5px;
            border-radius: 5px;
            background: #f0f0f0;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 5px;
        }
        
        .password-strength.weak .password-strength-bar {
            background: #FF6584;
            width: 33%;
        }
        
        .password-strength.medium .password-strength-bar {
            background: #FFB74D;
            width: 66%;
        }
        
        .password-strength.strong .password-strength-bar {
            background: #4CAF50;
            width: 100%;
        }
        
        .password-requirements {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .checkbox-group input {
            margin-right: 10px;
            margin-top: 3px;
            width: 18px;
            height: 18px;
        }
        
        .checkbox-group label {
            margin-bottom: 0;
            color: #666;
            font-size: 0.9rem;
        }
        
        .checkbox-group a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .checkbox-group a:hover {
            text-decoration: underline;
        }
        
        .btn-register {
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
        
        .btn-register:hover {
            background: #5a52e0;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 99, 255, 0.3);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link a:hover {
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
            .register-container {
                flex-direction: column;
            }
            
            .register-left {
                padding: 30px;
            }
            
            .register-right {
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
    <div class="register-container">
        <!-- Left Side - Welcome Section -->
        <div class="register-left">
            <h1 class="welcome-title">Bergabunglah Dengan Kami!</h1>
            <p class="welcome-subtitle">Daftar sekarang untuk mengakses ribuan buku digital</p>
            
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
        
        <!-- Right Side - Register Form -->
        <div class="register-right">
            <div class="logo">
                <i class="fas fa-book-open me-2"></i>E-Library
            </div>
            
            <h2 class="mb-4">Buat Akun Baru</h2>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap">
                    @if ($errors->has('name'))
                        <div class="error-message">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan alamat email">
                    @if ($errors->has('email'))
                        <div class="error-message">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Buat password">
                    <div class="password-strength" id="password-strength">
                        <div class="password-strength-bar"></div>
                    </div>
                    <div class="password-requirements">
                        <small>Password harus minimal 8 karakter dan mengandung huruf dan angka</small>
                    </div>
                    @if ($errors->has('password'))
                        <div class="error-message">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                    @if ($errors->has('password_confirmation'))
                        <div class="error-message">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                <!-- Terms and Conditions -->
                <div class="checkbox-group">
                    <input id="terms" type="checkbox" name="terms" required>
                    <label for="terms">Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a></label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </button>
            </form>
            
            <!-- Login Link -->
            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.querySelector('.password-strength-bar');
            const strengthContainer = document.getElementById('password-strength');
            
            // Reset classes
            strengthContainer.classList.remove('weak', 'medium', 'strong');
            
            if (password.length === 0) {
                strengthBar.style.width = '0';
                return;
            }
            
            // Calculate strength
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength += 1;
            
            // Contains both letters and numbers
            if (/[a-zA-Z]/.test(password) && /[0-9]/.test(password)) strength += 1;
            
            // Contains special characters
            if (/[^a-zA-Z0-9]/.test(password)) strength += 1;
            
            // Update UI based on strength
            if (strength === 1) {
                strengthContainer.classList.add('weak');
            } else if (strength === 2) {
                strengthContainer.classList.add('medium');
            } else if (strength >= 3) {
                strengthContainer.classList.add('strong');
            }
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const terms = document.getElementById('terms').checked;
            
            // Check if passwords match
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Password dan konfirmasi password tidak cocok!');
                return;
            }
            
            // Check if terms are accepted
            if (!terms) {
                e.preventDefault();
                alert('Anda harus menyetujui Syarat & Ketentuan untuk mendaftar!');
                return;
            }
        });
    </script>
</body>
</html>