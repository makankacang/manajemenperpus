<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Email</title>
</head>
<body>
    <h2>Verifikasi Email Anda</h2>
    <p>Halo {{ $user->name }},</p>
    <p>Silakan klik tombol di bawah untuk memverifikasi alamat email Anda:</p>
    
    <a href="{{ $verificationUrl }}" 
       style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Verifikasi Email
    </a>
    
    <p>Jika tombol tidak bekerja, copy dan paste link berikut di browser Anda:</p>
    <p>{{ $verificationUrl }}</p>
    
    <p>Terima kasih,<br>Manajemen Perpustakaan</p>
</body>
</html>