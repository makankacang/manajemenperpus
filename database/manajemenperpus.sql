-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 16, 2025 at 07:28 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemenperpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `penulis_id` bigint UNSIGNED DEFAULT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit` year DEFAULT NULL,
  `jumlah_halaman` int DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `stok` int NOT NULL DEFAULT '0',
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `isbn`, `kategori_id`, `penulis_id`, `penerbit`, `tahun_terbit`, `jumlah_halaman`, `deskripsi`, `stok`, `cover`, `created_at`, `updated_at`) VALUES
(1, 'Bumi', '9786021234567', 1, 1, 'Gramedia', '2014', 400, 'Novel fantasi karya Tere Liye', 3, 'images/bum.jpg', '2025-10-15 00:05:50', '2025-10-15 21:03:48'),
(3, 'ttttt', 'tttt', 1, 2, '222', '2010', 2, 'dsadas', 5, NULL, '2025-10-15 03:32:57', '2025-10-15 21:08:41'),
(6, 'ewqewq', '232323', 2, 2, '23232', '2020', 2, 'wqeqweqw', 3, NULL, '2025-10-15 03:38:08', '2025-10-15 03:38:08'),
(7, '5555', '5555', 1, 1, '555', '2020', 3, '23232', 4, NULL, '2025-10-15 04:03:00', '2025-10-15 04:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `buku_copies`
--

CREATE TABLE `buku_copies` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `kode_unik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('tersedia','dipinjam','hilang','rusak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku_copies`
--

INSERT INTO `buku_copies` (`id`, `buku_id`, `kode_unik`, `lokasi`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'B001-A', 'Rak A1', 'dipinjam', '2025-10-15 00:05:50', '2025-10-15 07:25:53'),
(2, 1, 'B001-B', 'Rak A1', 'dipinjam', '2025-10-15 00:05:50', '2025-10-15 00:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `buku_images`
--

CREATE TABLE `buku_images` (
  `id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utama` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku_images`
--

INSERT INTO `buku_images` (`id`, `buku_id`, `path`, `alt`, `utama`, `created_at`, `updated_at`) VALUES
(3, 3, 'buku-images/livPQ7OomgSVtDoEFQs9nRzLTTa3oLMAtc7o7mAC.jpg', 'ttt', 0, '2025-10-15 03:32:57', '2025-10-15 21:07:25'),
(9, 7, 'buku-images/DkKgBZYAkOWpVmBHykJTAxPDf5yMfzTjXTKHFrVc.jpg', '5555', 1, '2025-10-15 04:03:00', '2025-10-15 04:03:00'),
(10, 6, 'buku-images/b1lYJTUD40SE3yWUPKqa5xFKEZjqNhk8mlsj3Qcq.jpg', 'ewqewq', 1, '2025-10-15 17:19:50', '2025-10-15 23:46:55'),
(11, 6, 'buku-images/mZaThweRtooitWda1fvyE6ih0RKQziQTBMyj74sr.jpg', 'ewqewq', 0, '2025-10-15 17:20:06', '2025-10-15 23:46:55'),
(12, 1, 'buku-images/lPeQqZREh6M5yDbNlV9jAirbEPTDTq6E4a7OL8op.jpg', 'Bumiii', 0, '2025-10-15 19:15:48', '2025-10-15 19:16:05'),
(13, 1, 'buku-images/X7vMBSlxqwcjpkkWUVtmJNtoH4bebix2nNNFMyfC.jpg', 'Bumiii', 1, '2025-10-15 19:16:01', '2025-10-15 19:16:05'),
(14, 3, 'buku-images/1n9bKIA60Mm9QY1zta8OJcPEYwRyyw6IA22MJY8L.jpg', 'ttttt', 1, '2025-10-15 21:07:15', '2025-10-15 21:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Fiksi', 'Cerita rekaan atau khayalan', '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(2, 'Teknologi', 'Buku tentang ilmu pengetahuan dan teknologi', '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(3, 'Sejarahh', 'Buku yang membahas sejarah dan peradaban', '2025-10-15 00:05:50', '2025-10-15 08:39:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_15_033230_create_roles_table', 1),
(5, '2025_10_15_033231_create_kategori_table', 1),
(6, '2025_10_15_033232_create_penulis_table', 1),
(7, '2025_10_15_033234_create_buku_table', 1),
(8, '2025_10_15_033235_create_buku_copies_table', 1),
(9, '2025_10_15_033235_create_buku_images_table', 1),
(10, '2025_10_15_033246_create_peminjaman_table', 1),
(11, '2025_10_15_033248_create_pengembalian_table', 1),
(12, '2025_10_15_125624_remove_unique_constraint_from_role_id_in_users_table', 2),
(13, '2025_10_15_133448_add_kode_peminjaman_to_peminjaman_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('keplainyewler@gmail.com', '$2y$12$QdNkP30Pf8hQ94csUnFeQer11PNDymvG4lkHriCH1FUoR0QjUL1cS', '2025-10-15 21:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_peminjaman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('menunggu_konfirmasi','dipinjam','dikembalikan','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_konfirmasi',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `kode_peminjaman`, `user_id`, `buku_id`, `tanggal_pinjam`, `tanggal_jatuh_tempo`, `tanggal_kembali`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 'PJM-JLOEC7B8', 2, 1, '2025-10-15', '2025-10-22', '2025-10-15', 'dikembalikan', NULL, '2025-10-15 07:07:34', '2025-10-15 09:13:31'),
(8, 'PJM-4O5UYP2H', 2, 1, '2025-10-15', '2025-10-22', NULL, 'menunggu_konfirmasi', NULL, '2025-10-15 07:17:34', '2025-10-15 07:17:34'),
(9, 'PJM-WVRJ2E71', 2, 1, '2025-10-15', '2025-10-22', NULL, 'menunggu_konfirmasi', NULL, '2025-10-15 07:17:46', '2025-10-15 07:17:46'),
(11, 'PJM-VMLXQ31W', 2, 1, '2025-10-15', '2025-10-22', NULL, 'menunggu_konfirmasi', NULL, '2025-10-15 07:25:53', '2025-10-15 07:25:53'),
(15, 'PJM-B1S0NGT6', 2, 3, '2025-10-16', '2025-10-23', '2025-10-16', 'dikembalikan', NULL, '2025-10-15 17:21:31', '2025-10-15 19:30:16'),
(19, 'PJM-G0FU6K7R', 10, 1, '2025-10-16', '2025-10-25', '2025-10-16', 'dikembalikan', NULL, '2025-10-15 21:01:35', '2025-10-15 21:03:48'),
(20, 'PJM-HFRBEUIK', 10, 3, '2025-10-16', '2025-10-23', NULL, 'dipinjam', NULL, '2025-10-15 21:08:26', '2025-10-15 21:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` bigint UNSIGNED NOT NULL,
  `peminjaman_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `buku_id` bigint UNSIGNED NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `kondisi_buku` enum('baik','rusak_ringan','rusak_berat','hilang') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'baik',
  `denda` decimal(10,2) NOT NULL DEFAULT '0.00',
  `petugas_id` bigint UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `peminjaman_id`, `user_id`, `buku_id`, `tanggal_pengembalian`, `kondisi_buku`, `denda`, `petugas_id`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 1, '2025-10-15', 'rusak_ringan', 10000.00, 1, '44444', '2025-10-15 09:13:31', '2025-10-15 09:13:31'),
(5, 15, 2, 3, '2025-10-16', 'rusak_berat', 50000.00, 1, 'sgdsgsd', '2025-10-15 19:30:16', '2025-10-15 19:30:16'),
(6, 19, 10, 1, '2025-10-16', 'rusak_ringan', 10000.00, 1, 'rusak euy', '2025-10-15 21:03:48', '2025-10-15 21:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id`, `nama`, `bio`, `created_at`, `updated_at`) VALUES
(1, 'Tere Liye', 'Penulis novel terkenal asal Indonesia.', '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(2, 'Andrea Hirata', 'Penulis \"Laskar Pelangi\".', '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(3, 'Yuval Noah Harari', 'Sejarawan dan penulis \"Sapiens\".', '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(4, 'Budi Santoso', 'ds', '2025-10-15 04:44:45', '2025-10-15 04:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Memiliki akses penuh ke sistem', '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(2, 'User', 'Pengguna umum yang dapat meminjam buku', '2025-10-15 00:05:50', '2025-10-15 00:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FUEcWNUeJNRpLXlwaZGTxM2mAOmdAC7KkLJr7Ctv', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmYxZ3gxRE5lM29hZExCZjdNZG5rSHNiN1VLVUVMZm9EQnM5aVVrYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9tYW5hamVtZW5wZXJwdXMudGVzdC9wZW1pbmphbWFuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7fQ==', 1760597880),
('rtAuC8JRPMzJgs1cPPorKvG00EZ7qsyUf13hLXqF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMGpjRDhIS3BUVTRpYlZLbGg0SW1tWExjT1NmSm5pUjBWcVpSWW9paiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9tYW5hamVtZW5wZXJwdXMudGVzdC9hbmdnb3RhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1760597886);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rey', 'rey@gmail.com', '1', '2025-10-15 00:05:50', '$2y$12$EVwr6.r82japcMaENJSj0eOn14TA4oPtwS.fMHac2YYoIji7ZGHDa', NULL, '2025-10-15 00:05:50', '2025-10-15 00:05:50'),
(2, 'inay', 'inay@gmail.com', '2', '2025-10-15 00:05:50', '$2y$12$2223edC2byn0hxMRreO0Zu9LKOIn5lubFlansgx9JWqkBO8aolst.', NULL, '2025-10-15 00:05:50', '2025-10-15 05:57:22'),
(3, 'yer', 'yer@gmail.com', '2', NULL, '$2y$12$g4Ugrf3OBrC6BAhdcXp8CehBpsvdpvB8RV/62YETT0INFHqb5PUjO', NULL, '2025-10-15 08:42:05', '2025-10-15 08:42:05'),
(4, 'ed', 'ed@gmail.com', '2', NULL, '$2y$12$zUC86WtwCVlaDLTeElwMaOvYvntsvLBukZLWVuDxSrP7N1MpL.L0.', NULL, '2025-10-15 18:40:32', '2025-10-15 18:40:32'),
(5, 'reyhan', 'nowyouseelone@gmail.com', '1', '2025-10-15 20:04:45', '$2y$12$5Jwx9QS4rGZlNRa3u9Lt7OpMEufb6FLv3y9hbYhUJ.z4niEm6atdm', NULL, '2025-10-15 19:52:20', '2025-10-15 21:13:16'),
(10, 'dewi', 'keplainyewler@gmail.com', '2', NULL, '$2y$12$ebl3Jc.vdWCyyuhuOHUD8ePGv7ByHgMYmvq3o9kH/NRJt0m4YMDO6', NULL, '2025-10-15 20:59:30', '2025-10-15 21:01:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buku_isbn_unique` (`isbn`),
  ADD KEY `buku_kategori_id_foreign` (`kategori_id`),
  ADD KEY `buku_penulis_id_foreign` (`penulis_id`);

--
-- Indexes for table `buku_copies`
--
ALTER TABLE `buku_copies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `buku_copies_kode_unik_unique` (`kode_unik`),
  ADD KEY `buku_copies_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `buku_images`
--
ALTER TABLE `buku_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_images_buku_id_foreign` (`buku_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_nama_unique` (`nama`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peminjaman_kode_peminjaman_unique` (`kode_peminjaman`),
  ADD KEY `peminjaman_user_id_foreign` (`user_id`),
  ADD KEY `peminjaman_buku_copy_id_foreign` (`buku_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengembalian_peminjaman_id_foreign` (`peminjaman_id`),
  ADD KEY `pengembalian_user_id_foreign` (`user_id`),
  ADD KEY `pengembalian_petugas_id_foreign` (`petugas_id`),
  ADD KEY `pengembalian_buku_copy_id_foreign` (`buku_id`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_nama_unique` (`nama`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `buku_copies`
--
ALTER TABLE `buku_copies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `buku_images`
--
ALTER TABLE `buku_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `buku_penulis_id_foreign` FOREIGN KEY (`penulis_id`) REFERENCES `penulis` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `buku_copies`
--
ALTER TABLE `buku_copies`
  ADD CONSTRAINT `buku_copies_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buku_images`
--
ALTER TABLE `buku_images`
  ADD CONSTRAINT `buku_images_buku_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_buku_copy_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `peminjaman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_buku_copy_id_foreign` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `pengembalian_peminjaman_id_foreign` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pengembalian_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengembalian_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
