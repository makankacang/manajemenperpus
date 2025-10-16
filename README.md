# 📚 Manajemen Perpustakaan - Laravel

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Sistem manajemen perpustakaan modern yang keren dan fun!** 🚀

*Aplikasi untuk mengelola buku, peminjaman, dan anggota perpustakaan dengan gaya*

</div>

## ✨ Fitur Seru yang Tersedia

### 📖 Manajemen Buku
- ✅ Tambah, edit, hapus buku dengan mudah
- 🖼️ Upload gambar cover buku
- 🏷️ Kelola kategori dan penulis
- 🔍 Pencarian buku yang super cepat

### 👥 Manajemen Anggota  
- 👑 Role-based system (Admin & User)
- 📧 Verifikasi email untuk keamanan
- 👤 Profil anggota yang customizable

### 🔄 Sistem Peminjaman
- 📅 Pinjam & kembalikan buku secara digital
- ⏰ Tracking durasi peminjaman
- 📊 Status peminjaman real-time
- 🎯 Konfirmasi & reject otomatis

### 📊 Laporan & Analytics
- 📈 Statistik peminjaman
- 📋 Laporan lengkap
- 🧮 Dashboard informatif
- 📄 Export data mudah

## 🎯 Quick Start

### Prerequisites
- PHP 8.1+
- Composer
- MySQL
- Node.js (optional)

### 🚀 Installation

```bash
# Clone repo ini
git clone https://github.com/yourusername/manajemenperpus.git

# Masuk direktori
cd manajemenperpus

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database di .env
DB_DATABASE=manajemenperpus
DB_USERNAME=root
DB_PASSWORD=

# Run migrations & seeding
php artisan migrate --seed

# Start development server
php artisan serve
```

🎉 **Boom!** Aplikasi ready di `http://localhost:8000`

### 👤 Default Accounts
- **Admin**: `admin@perpus.com` / `password`
- **User**: `user@perpus.com` / `password`

## 🛠️ Tech Stack

**Backend:**
- 🎯 Laravel 10.x
- 🗄️ Eloquent ORM
- 🔐 Sanctum Authentication
- 📧 Email Verification

**Frontend:**
- 🎨 Bootstrap 5
- ⚡ Vanilla JavaScript  
- 📱 Responsive Design
- 🎭 Sweet Animations

**Database:**
- 🐬 MySQL
- 🔄 Database Migrations
- 🌱 Seeding Data

## 🎨 Screenshots

*(Coming soon - bakal ada screenshot keren di sini!)*

## 🔧 Development

```bash
# Run tests
php artisan test

# Generate ide-helper
php artisan ide-helper:generate

# Clear cache
php artisan optimize:clear

# Watch assets (mix)
npm run dev
```

## 🤝 Contributing

Mau bikin fitur keren? Ayo collab! 

1. Fork project ini
2. Create feature branch (`git checkout -b amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push branch (`git push origin amazing-feature`)
5. Open Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🎊 Fun Facts

- 🚀 Dibangun dengan ❤️ menggunakan Laravel
- 📚 Bisa handle ribuan buku sekaligus
- 👥 Support multi-user dengan role berbeda
- 🔒 Super secure dengan email verification
- 📱 Responsive di semua device

---

<div align="center">

**Dibuat dengan ☕ dan 🎵 oleh Tim Keren**

*"Membaca adalah jendela dunia, kita yang buat sistemnya!"* 📖✨

</div>
