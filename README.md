# 📚 Manajemen Perpustakaan - Laravel

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Breeze](https://img.shields.io/badge/Laravel_Breeze-4A90E2?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

**Sistem manajemen perpustakaan**  
*Dibangun dengan Laravel 12 + Breeze — ringan, cepat, dan mudah digunakan.*

</div>

---

## ✨ Fitur Utama

### 📖 Manajemen Buku
- ✅ Tambah, edit, hapus, dan cari buku
- 🖼️ Upload cover buku
- 🏷️ Kelola kategori, penerbit, dan penulis
- 🔍 Fitur pencarian cepat

### 👥 Manajemen Anggota  
- 👤 Registrasi & login via Laravel Breeze
- 🧩 Update profil user
- 💾 Data anggota tersimpan otomatis di database

### 🔄 Sistem Peminjaman
- 📅 Catat peminjaman & pengembalian buku
- ⏰ Lacak status pinjaman (aktif, terlambat, selesai)
- 🔔 Notifikasi sederhana di dashboard

### 📊 Laporan & Dashboard
- 📈 Statistik buku & anggota
- 📋 Laporan transaksi
- 🧮 Tampilan dashboard informatif

---

## 🛠️ Tech Stack
**Backend:**

- Reyhan – Developer
- Inayah - Developer

**Backend:**
- ⚙️ Laravel 12.x
- 🧱 Laravel Breeze (auth)
- 🗄️ Eloquent ORM

**Frontend:**
- 🎨 Blade Template + Bootstrap 5
- 📱 Responsive Layout

**Database:**
- 🐬 MySQL / MariaDB
- 🌱 Seeder & Migration support

**Environment:**
- 💻 Laragon (development)
- 🧩 PHP 8.2+
- 🔑 Composer & NPM

---

## 🚀 Instalasi Cepat

```bash
# 1️⃣ Clone repository
git clone https://github.com/makankacang/manajemenperpus.git
cd manajemenperpus

# 2️⃣ Install dependencies
composer install
npm install && npm run dev

# 3️⃣ Setup environment
cp .env.example .env
php artisan key:generate

# 4️⃣ Atur koneksi database di .env
DB_DATABASE=manajemenperpus
DB_USERNAME=root
DB_PASSWORD=

# 5️⃣ Migrasi & seeding (jika perlu)
php artisan migrate --seed

# 6️⃣ Jalankan server
php artisan serve
Akses di: 👉 http://localhost:8000

💾 Database
Kamu bisa impor file SQL bawaan:

pgsql
Copy code
/database/manajemenperpus.sql
Atau biarkan Laravel membuat otomatis lewat migrate --seed.

👤 Akun Default (Opsional)
Role	Email	Password
Admin	admin@perpus.com	password
User	user@perpus.com	password

🧑‍💻 Perintah Penting
bash
Copy code
# Jalankan test
php artisan test

# Clear cache dan config
php artisan optimize:clear

# Watch asset development
npm run dev
🤝 Kontribusi
Pengen bantu nambah fitur? Yuk bareng!

Fork repository ini

Buat branch fitur (git checkout -b fitur-baru)

Commit perubahan (git commit -m "Tambah fitur baru")

Push branch (git push origin fitur-baru)

Buat Pull Request 🚀

📝 Lisensi
Proyek ini dirilis di bawah lisensi MIT.
Bebas digunakan untuk pembelajaran dan pengembangan.

<div align="center">
💡 Dibuat oleh Rey dengan ☕ dan semangat belajar!

"Membaca adalah jendela dunia — Laravel adalah framework-nya." 📖✨

</div> ```
