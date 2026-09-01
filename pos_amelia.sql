-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pos_amelia
CREATE DATABASE IF NOT EXISTS `pos_amelia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pos_amelia`;

-- Dumping structure for table pos_amelia.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.cache: ~0 rows (approximately)

-- Dumping structure for table pos_amelia.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.cache_locks: ~0 rows (approximately)

-- Dumping structure for table pos_amelia.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table pos_amelia.item_penjualan
CREATE TABLE IF NOT EXISTS `item_penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `produk_id` bigint unsigned NOT NULL,
  `kuantitas` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  KEY `item_penjualan_produk_id_foreign` (`produk_id`),
  CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`),
  CONSTRAINT `item_penjualan_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.item_penjualan: ~2 rows (approximately)
INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `produk_id`, `kuantitas`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 1, 20000, 20000, '2026-09-01 07:18:30', '2026-09-01 07:18:30'),
	(2, 1, 6, 1, 20000, 20000, '2026-09-01 07:18:37', '2026-09-01 07:18:37'),
	(3, 1, 2, 2, 20000, 40000, '2026-09-01 07:18:49', '2026-09-01 07:18:51'),
	(4, 2, 5, 1, 15000, 15000, '2026-09-01 07:19:14', '2026-09-01 07:19:14'),
	(5, 2, 1, 1, 17000, 17000, '2026-09-01 07:19:16', '2026-09-01 07:19:16');

-- Dumping structure for table pos_amelia.jenis
CREATE TABLE IF NOT EXISTS `jenis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.jenis: ~0 rows (approximately)
INSERT INTO `jenis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
	(1, 'Minuman', '2026-08-31 00:18:07', '2026-08-31 00:18:07'),
	(2, 'Makanan', '2026-09-01 07:10:25', '2026-09-01 07:10:25');

-- Dumping structure for table pos_amelia.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.jobs: ~0 rows (approximately)

-- Dumping structure for table pos_amelia.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.job_batches: ~0 rows (approximately)

-- Dumping structure for table pos_amelia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_roles_table', 1),
	(2, '0001_01_01_000000_create_users_table', 1),
	(3, '0001_01_01_000001_create_cache_table', 1),
	(4, '0001_01_01_000002_create_jobs_table', 1),
	(5, '2026_04_20_073533_create_produk_table', 1),
	(6, '2026_04_20_074317_create_penjualan_table', 1),
	(7, '2026_04_21_005126_create_item_penjualan_table', 1),
	(8, '2026_08_20_043146_create_jenis_table', 1),
	(9, '2026_08_20_043857_add_jenis_id_to_produk_table', 1);

-- Dumping structure for table pos_amelia.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table pos_amelia.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `total_pembayaran` int NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('OPEN','COMPLETED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_user_id_foreign` (`user_id`),
  CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.penjualan: ~2 rows (approximately)
INSERT INTO `penjualan` (`id`, `user_id`, `total_pembayaran`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
	(1, 2, 80000, 'QRIS', 'COMPLETED', '2026-09-01 07:18:25', '2026-09-01 07:19:00'),
	(2, 2, 32000, 'CASH', 'COMPLETED', '2026-09-01 07:19:12', '2026-09-01 07:19:26');

-- Dumping structure for table pos_amelia.produk
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `jenis_id` bigint unsigned DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produk_user_id_foreign` (`user_id`),
  KEY `produk_nama_index` (`nama`),
  KEY `produk_jenis_id_foreign` (`jenis_id`),
  CONSTRAINT `produk_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `produk_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.produk: ~1 rows (approximately)
INSERT INTO `produk` (`id`, `user_id`, `jenis_id`, `foto`, `nama`, `harga_beli`, `harga_jual`, `stok`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'products/wkXE9GMVMJYmr2MEcWOGG16EFjEg7IAV0ESBqjVA.jpg', 'Red Velvet', 15000, 17000, 4, '2026-09-01 07:08:22', '2026-09-01 07:19:16'),
	(2, 2, 1, 'products/ojYh0AwLhahPAwLeu4Zis90GfOUUIVY6GZkNeGbq.jpg', 'Thai Tea', 17000, 20000, 5, '2026-09-01 07:09:00', '2026-09-01 07:18:51'),
	(3, 2, 1, 'products/LNnq3yhyL3PAxgDL7CRsdF6JN5cccBGI5mK5Ms91.jpg', 'MatchaLate', 17000, 20000, 10, '2026-09-01 07:09:56', '2026-09-01 07:09:56'),
	(4, 2, 2, 'products/F2TaA8AMluAioGXCKykX7yc1M7ztXEA7ce9IYtte.jpg', 'Bakso Mercon', 15000, 20000, 19, '2026-09-01 07:15:24', '2026-09-01 07:18:30'),
	(5, 2, 2, 'products/LsBQ3OnNm7EjCetrvozX1f80oeY2K2rhKyGUiflO.jpg', 'Ceker Mercon', 10000, 15000, 9, '2026-09-01 07:16:02', '2026-09-01 07:19:14'),
	(6, 2, 2, 'products/SEaHsCQ2xuogFW3Aggf85lpsrpbXtXrOC0drVHeH.jpg', 'Seblak', 15000, 20000, 24, '2026-09-01 07:16:45', '2026-09-01 07:18:37'),
	(7, 2, 1, 'products/s4JSOFdGuNnDQHCq4XTEuUSBmaiQAU3a3CgvVGn0.jpg', 'Choco Oreo', 15000, 17000, 5, '2026-09-01 07:34:00', '2026-09-01 07:34:00'),
	(8, 2, 1, 'products/461eL5eBnu5yOkEFSKAOnIQYwKUhNBv0r7XcGarD.jpg', 'Pink Lava', 15000, 20000, 10, '2026-09-01 07:38:19', '2026-09-01 07:38:19'),
	(9, 2, 2, 'products/k6eK4xjscCgdJUygpCdy3I9xS4RnqKzDkcHn8p2U.jpg', 'Dimsum', 25000, 30000, 15, '2026-09-01 07:39:26', '2026-09-01 07:39:26'),
	(10, 2, 2, 'products/2r2XIDdndLUK6JlXej5WG1N9a6sBFfYgAW1LnNfU.jpg', 'Mie Jebew', 10000, 15000, 5, '2026-09-01 07:39:55', '2026-09-01 07:39:55');

-- Dumping structure for table pos_amelia.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.roles: ~2 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2026-08-30 20:05:11', '2026-08-30 20:05:11'),
	(2, 'kasir', '2026-08-30 20:05:11', '2026-08-30 20:05:11');

-- Dumping structure for table pos_amelia.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.sessions: ~3 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('CkuXR9oxUuKDYuISS1tmoSj3zZ8TpHXHsyKQOK5e', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmgxTHE2aDZSOEhLS05RUG5DNkg2aGkyUUlOZTUzUXMySTlvcnR5ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1788246065),
	('rk8e77KBWXZXyuBb6hadN7XXTnVbO8AEDnAkZvNU', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRmVab3E5Wlp0ckw1S1lDa3hkc2ZyR2lCd0hiTlhHMjZRVFV3Vk9jSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWsiO3M6NToicm91dGUiO3M6MTI6InByb2R1ay5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1788248395);

-- Dumping structure for table pos_amelia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  FULLTEXT KEY `users_name_email_fulltext` (`name`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table pos_amelia.users: ~6 rows (approximately)
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Heloise Heller', 'afton.jacobs@example.net', '2026-08-30 20:05:13', '$2y$12$7SJkQnSnTAq17hXF8hGKmeJqs75yEfMV11tu1CHkwRfLjuNbQlOdO', 'zMuash3IvnVh6jlbrgMHtaCCPLYI3u81p0xtFNDOOKhmuoCJhOJo1PDL2bly', '2026-08-30 20:05:13', '2026-08-30 20:05:13'),
	(2, 1, 'Stacey Sanford III', 'fmonahan@example.com', '2026-08-30 20:05:13', '$2y$12$7SJkQnSnTAq17hXF8hGKmeJqs75yEfMV11tu1CHkwRfLjuNbQlOdO', 'RBfrflUq7j', '2026-08-30 20:05:13', '2026-08-30 20:05:13'),
	(3, 2, 'Anais Cummerata', 'fankunding@example.org', '2026-08-30 20:05:13', '$2y$12$7SJkQnSnTAq17hXF8hGKmeJqs75yEfMV11tu1CHkwRfLjuNbQlOdO', 'AHdxiaTlum', '2026-08-30 20:05:13', '2026-08-30 20:05:13'),
	(4, 1, 'Philip Murray I', 'thaddeus.goodwin@example.org', '2026-08-30 20:05:13', '$2y$12$7SJkQnSnTAq17hXF8hGKmeJqs75yEfMV11tu1CHkwRfLjuNbQlOdO', 'DxHKo8NMEZ', '2026-08-30 20:05:13', '2026-08-30 20:05:13'),
	(5, 2, 'Miss Leta Bahringer II', 'ryan.eliezer@example.com', '2026-08-30 20:05:13', '$2y$12$7SJkQnSnTAq17hXF8hGKmeJqs75yEfMV11tu1CHkwRfLjuNbQlOdO', 'V0a2wyvdaE', '2026-08-30 20:05:13', '2026-08-30 20:05:13'),
	(6, 2, 'Test User', 'test@example.com', '2026-08-30 20:05:15', '$2y$12$7SJkQnSnTAq17hXF8hGKmeJqs75yEfMV11tu1CHkwRfLjuNbQlOdO', 'lgwhWxnQcB', '2026-08-30 20:05:15', '2026-08-30 20:05:15');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
