-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2025 at 10:34 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi-heru`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_test`
--

CREATE TABLE `jadwal_test` (
  `id_jadwal` bigint UNSIGNED NOT NULL,
  `tanggal_test` date NOT NULL,
  `jam_test` time NOT NULL,
  `lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuota` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_test`
--

INSERT INTO `jadwal_test` (`id_jadwal`, `tanggal_test`, `jam_test`, `lokasi`, `kuota`, `created_at`, `updated_at`) VALUES
(1, '2025-06-06', '08:00:00', 'UPT BAHASA BUKIT INDAH', 6, '2025-01-05 01:37:49', '2025-03-18 14:36:38'),
(2, '2025-01-07', '10:00:00', 'UPT BAHASA BUKIT INDAH', 35, '2025-01-05 07:57:45', '2025-01-05 07:57:45'),
(5, '2025-01-08', '10:00:00', 'UPT BAHASA BUKIT INDAH', 39, '2025-01-05 08:05:42', '2025-03-14 12:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_12_25_060053_create_jadwal_test', 1),
(2, '0001_01_01_000000_create_users_table', 2),
(3, '2024_12_31_141843_pendaftaran', 3),
(4, '0001_01_01_000001_create_cache_table', 4),
(5, '0001_01_01_000002_create_jobs_table', 4),
(6, '2024_12_25_060101_create_riwayat_nilai', 4),
(7, '2025_02_15_071823_add_status_pembayaran_to_pendaftaran_table', 5),
(8, '2025_02_15_072513_create_transaksi_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` bigint UNSIGNED NOT NULL,
  `id_users` bigint UNSIGNED NOT NULL,
  `id_jadwal` bigint UNSIGNED NOT NULL,
  `status_pendaftaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_url` varchar(299) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `id_users`, `id_jadwal`, `status_pendaftaran`, `payment_url`, `created_at`, `updated_at`, `status_pembayaran`) VALUES
(173, 35, 1, 'Pending', 'https://app.sandbox.midtrans.com/snap/v4/redirection/7c20951f-f93a-4179-a877-217d63f2c2bb', '2025-03-18 14:32:16', '2025-03-18 14:32:21', 'Belum Lunas'),
(174, 35, 1, 'Pending', 'https://app.sandbox.midtrans.com/snap/v4/redirection/8b346bda-8131-4e03-bb15-43df26d6747a', '2025-03-18 14:32:54', '2025-03-18 14:33:01', 'Belum Lunas'),
(175, 35, 1, 'Pending', 'https://app.sandbox.midtrans.com/snap/v4/redirection/f6d7a2a8-8ab9-46fb-baa0-24a1a58fa640', '2025-03-18 14:33:28', '2025-03-18 14:33:34', 'Belum Lunas'),
(176, 35, 1, 'Pending', 'https://app.sandbox.midtrans.com/snap/v4/redirection/5b04a6d7-0123-45c2-acdb-61384e8ecb8e', '2025-03-18 14:33:45', '2025-03-18 14:33:53', 'Belum Lunas'),
(177, 35, 1, 'Pending', 'https://app.sandbox.midtrans.com/snap/v4/redirection/0c6644a8-e067-4855-ba43-8498bd834c1d', '2025-03-18 14:34:46', '2025-03-18 14:34:53', 'Belum Lunas'),
(178, 35, 1, 'Pending', 'https://app.sandbox.midtrans.com/snap/v4/redirection/c5d11d5f-7303-423f-9adb-8ad07af089bd', '2025-03-18 14:36:38', '2025-03-18 14:36:40', 'Belum Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_nilai`
--

CREATE TABLE `riwayat_nilai` (
  `id_riwayat` bigint UNSIGNED NOT NULL,
  `id_pendaftaran` bigint UNSIGNED NOT NULL,
  `tanggal_test` date NOT NULL,
  `listening` float NOT NULL,
  `structure` float NOT NULL,
  `reading` float NOT NULL,
  `total_nilai` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('YxTyUqVIj4ugewFr6dRM973US05q9CyNCeTeDJRW', 35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZG12RG9mbHBqV0FySjV4Yzd6R1FYSzZtbURYUTZ3SDNjaDdtemFGayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly90b2VmbC50ZXN0L3VzZXIvdGFuZ2dhbC10ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzU7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQyMzMzNzg2O319', 1742333802),
('zTvOekjETwQ7fYWfADnLVGugP9xYOBsTwMR1OSQk', 35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTkxBSncxZGhCRExNZVpqS2pUOGRVelMzT092YzRFQkZseWN6OFR0ZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly90b2VmbC50ZXN0L3VzZXIvdGFuZ2dhbC10ZXN0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzU7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQyMzI1NTg4O319', 1742337073),
('ZxRMwIsGdMC9oDlCmV3OOwNXFv91zdv3B5PSsfEv', NULL, '127.0.0.1', 'PostmanRuntime/7.43.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmRVNVpIZ3lPaTVJSVV2ZzB5WndxV1ZWNEc5QlAyV2czTm85OXNwcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly90b2VmbC50ZXN0L2FwaS9nZXQtbWlkdHJhbnMtdG9rZW4vMS8zNSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742333633);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_pendaftaran` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_url` varchar(299) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pendaftaran`, `order_id`, `amount`, `payment_url`, `payment_type`, `transaction_status`, `transaction_time`, `created_at`, `updated_at`) VALUES
(20, 173, 'ORDER-67d9e660ecd55', 50000.00, 'https://app.sandbox.midtrans.com/snap/v4/redirection/7c20951f-f93a-4179-a877-217d63f2c2bb', 'midtrans', 'pending', '2025-03-18 14:32:21', '2025-03-18 14:32:21', '2025-03-18 14:32:21'),
(21, 174, 'ORDER-67d9e686e46d0', 50000.00, 'https://app.sandbox.midtrans.com/snap/v4/redirection/8b346bda-8131-4e03-bb15-43df26d6747a', 'midtrans', 'pending', '2025-03-18 14:33:01', '2025-03-18 14:33:01', '2025-03-18 14:33:01'),
(22, 175, 'ORDER-67d9e6a8e91ef', 50000.00, 'https://app.sandbox.midtrans.com/snap/v4/redirection/f6d7a2a8-8ab9-46fb-baa0-24a1a58fa640', 'midtrans', 'pending', '2025-03-18 14:33:34', '2025-03-18 14:33:34', '2025-03-18 14:33:34'),
(23, 176, 'ORDER-67d9e6b90ec2d', 50000.00, 'https://app.sandbox.midtrans.com/snap/v4/redirection/5b04a6d7-0123-45c2-acdb-61384e8ecb8e', 'midtrans', 'pending', '2025-03-18 14:33:53', '2025-03-18 14:33:53', '2025-03-18 14:33:53'),
(24, 177, 'ORDER-67d9e6f6cfabd', 50000.00, 'https://app.sandbox.midtrans.com/snap/v4/redirection/0c6644a8-e067-4855-ba43-8498bd834c1d', 'midtrans', 'pending', '2025-03-18 14:34:53', '2025-03-18 14:34:53', '2025-03-18 14:34:53'),
(25, 178, 'ORDER-67d9e7669cb0d', 50000.00, 'https://app.sandbox.midtrans.com/snap/v4/redirection/c5d11d5f-7303-423f-9adb-8ad07af089bd', 'midtrans', 'pending', '2025-03-18 14:36:40', '2025-03-18 14:36:40', '2025-03-18 14:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_jadwal` bigint UNSIGNED DEFAULT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `password`, `nim`, `fakultas`, `prodi`, `email`, `no_hp`, `foto`, `id_jadwal`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Heru Aryasuta', '$2y$12$ngxWCxXziwd00.W5RaBeuewJuQRjl6dJyrScXZoGGDUQnDoWzZtt.', '210180105', 'Teknik', 'Sistem Informasi', 'heru@gmail.com', '089530229611', NULL, NULL, 'admin', '2025-01-05 01:35:47', '2025-01-05 01:35:47'),
(27, 'Teuku Muhammad Cesar', '$2y$12$4ElOpsrYUcAHTG1qNEGj7OJeJuGkPaak9QqzEFfqgD.1iqUEgaJe2', '1234567890', 'Ekonomi', 'Sistem Informasi', 'teuku.cesar@email.com', '81234567890', NULL, NULL, 'user', '2025-01-05 08:03:57', '2025-01-05 08:03:57'),
(28, 'Siti Aisyah', '$2y$12$u9I4Xhcu.DenTU/DhfI1ce8WzrHwFJ6Q6XvKIdfsnKHOq2wd/RAVe', '1234567891', 'Teknik', 'Informatika', 'siti.aisyah@email.com', '81234567891', NULL, NULL, 'user', '2025-01-05 08:03:57', '2025-01-05 08:03:57'),
(29, 'Ahmad Zaki', '$2y$12$6JRbKEo9lvl5xU4LAxcRu.s3NeqVFFDSGHba40EfxU4plcGqj6.YK', '1234567892', 'Hukum', 'Ilmu Hukum', 'ahmad.zaki@email.com', '81234567892', NULL, NULL, 'user', '2025-01-05 08:03:57', '2025-01-05 08:03:57'),
(30, 'Fitria Rahmawati', '$2y$12$C9AEWEsUobZfFmsdlu.Brucya1Uuzyz4gLyqBZ5qXFr/DGTew.8gm', '1234567893', 'Pertanian', 'Agribisnis', 'fitria.rahmawati@email.com', '81234567893', NULL, NULL, 'user', '2025-01-05 08:03:58', '2025-01-05 08:03:58'),
(31, 'Muhammad Rizki', '$2y$12$Vp2dYtj0Kv9XH8nrLjgIYeLZvS.DtBEzp0Kw8I6931i6QWeM4LaL.', '1234567894', 'Kedokteran', 'Psikologi', 'rizki.muhammad@email.com', '81234567894', NULL, NULL, 'user', '2025-01-05 08:03:58', '2025-01-05 08:03:58'),
(32, 'Dr. Maria Ulfa', '$2y$12$Fa3hS87HNqxDPjzvT9K1tuWudlxG2hNPFbzYCjbEgkvNiZCTHeFju', '9876543210', 'Ekonomi', 'Manajemen', 'maria.ulfa@unimal.ac.id', '81234567895', NULL, NULL, 'user', '2025-01-05 08:03:58', '2025-01-05 08:03:58'),
(33, 'Heru Aryasuta', '$2y$12$ca8g5vx03JBes/mUA1dwJuNSRJlHFI0J7L2yr3LdVNXxYsN3m1Rgy', '2101801059', 'Teknik', 'Sistem Informasi', 'aryasutaheru08@gmail.com', '08293839323', NULL, NULL, 'user', '2025-01-05 09:38:02', '2025-01-05 09:38:02'),
(34, 'Reyhan Nugroho', '$2y$12$jffjlmvTPo/XKhL./R1mHuJRSzOZOW9Q5.1Eytyp4VR4uzG1NO9Gu', '210180181', 'Teknik', 'Sistem Informasi', 'reyhan@gmail.com', '089530229632', NULL, NULL, 'user', '2025-02-14 23:49:52', '2025-02-14 23:49:52'),
(35, 'Abdul Halim Arif', '$2y$12$sCJwSR0j7IJWQ9bZ/pgZxOVjeQmTG0AbywZMWmHgSS8KrQhe2GLnS', '200180088', 'Teknik', 'Sistem Informasi', 'ahadaulay@gmail.com', '089621389305', NULL, NULL, 'user', '2025-02-16 01:28:08', '2025-02-16 01:28:08');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `jadwal_test`
--
ALTER TABLE `jadwal_test`
  ADD PRIMARY KEY (`id_jadwal`);

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
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `pendaftaran_id_users_foreign` (`id_users`),
  ADD KEY `pendaftaran_id_jadwal_foreign` (`id_jadwal`);

--
-- Indexes for table `riwayat_nilai`
--
ALTER TABLE `riwayat_nilai`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `riwayat_nilai_id_pendaftaran_foreign` (`id_pendaftaran`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_order_id_unique` (`order_id`),
  ADD KEY `transaksi_id_pendaftaran_foreign` (`id_pendaftaran`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_nim_unique` (`nim`),
  ADD KEY `users_id_jadwal_foreign` (`id_jadwal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_test`
--
ALTER TABLE `jadwal_test`
  MODIFY `id_jadwal` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `riwayat_nilai`
--
ALTER TABLE `riwayat_nilai`
  MODIFY `id_riwayat` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_test` (`id_jadwal`) ON DELETE CASCADE,
  ADD CONSTRAINT `pendaftaran_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_nilai`
--
ALTER TABLE `riwayat_nilai`
  ADD CONSTRAINT `riwayat_nilai_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_pendaftaran_foreign` FOREIGN KEY (`id_pendaftaran`) REFERENCES `pendaftaran` (`id_pendaftaran`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_test` (`id_jadwal`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
