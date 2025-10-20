-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 04:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_transactions`
--

CREATE TABLE `booking_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `started_at` date NOT NULL,
  `time_at` time NOT NULL,
  `sub_total` int(11) NOT NULL,
  `tax_total` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_transactions`
--

INSERT INTO `booking_transactions` (`id`, `user_id`, `doctor_id`, `status`, `started_at`, `time_at`, `sub_total`, `tax_total`, `grand_total`, `proof`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Approved', '2025-10-12', '10:30:00', 9000000, 990000, 9990000, 'proofs/muYMsMispVxibiLIccP884YC1Gn36t6VaUgGB7nK.png', '2025-10-10 17:36:49', '2025-10-10 18:11:58', NULL),
(2, 8, 3, 'Rejected', '2025-10-23', '13:30:00', 900000, 99000, 999000, 'proofs/pljUe3YbXIzFsd6wVMpPP9S0oX8eQ3Pse4IUHe03.png', '2025-10-20 04:22:04', '2025-10-20 04:57:09', NULL),
(3, 7, 3, 'Approved', '2025-10-23', '16:30:00', 900000, 99000, 999000, 'proofs/CfRggY1mqZ9t6Nh2L2htZECh6wLfkCsNodszFmTs.png', '2025-10-20 04:58:06', '2025-10-20 04:58:24', NULL),
(4, 10, 1, 'Waiting', '2025-10-22', '15:30:00', 9000000, 990000, 9990000, 'proofs/UwUJJkdoil0rmChx1h92718E68RoAvKDyfvuOE6N.png', '2025-10-20 13:34:43', '2025-10-20 13:34:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `yoe` int(11) NOT NULL,
  `specialist_id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `gender` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `photo`, `about`, `yoe`, `specialist_id`, `hospital_id`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hanif Aulia Kusuma', 'doctors/xGojAhwbZyCxgZVWWZhQNhlyrzVX1bg9xe6jgtLg.jpg', 'Alumni UI', 10, 1, 1, 'Male', '2025-10-10 14:28:45', '2025-10-10 14:28:45', NULL),
(2, 'Xaviera', 'doctors/e0ZSs6sv7QB3znWuIjZlaSiFYFQqo13m50s4OPW9.jpg', 'Ahli menangani minus dan epilepsi', 3, 5, 2, 'Female', '2025-10-19 09:16:06', '2025-10-19 09:16:06', NULL),
(3, 'Dr. Alexander', 'doctors/pYvOSRn3dcqASweyRdrVtY75ze9OHRjiwPaPGnWC.jpg', 'Cool comander', 5, 4, 2, 'Male', '2025-10-19 09:28:07', '2025-10-19 15:09:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `photo`, `about`, `address`, `city`, `post_code`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RS Juanda Bakti', 'hospitals/cLgOrR0XXs7uwnT6REc4VMYMRWS1G70ysdBJKvrn.webp', 'RS Spesialis Otak', 'Jauh', 'Sidoarjo', '61262', '082222222', '2025-10-10 13:19:00', '2025-10-10 13:19:00', NULL),
(2, 'Anjay Medika', 'hospitals/u4602m76cQDI0wbRkgNrIjufJBtuf5liPeJpOHO6.jpg', 'Di jalan jauh', 'Di jalan jauh', 'Sidoarjo kota', '61263', '089111112', '2025-10-17 16:47:55', '2025-10-18 14:02:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_specialists`
--

CREATE TABLE `hospital_specialists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `specialist_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_specialists`
--

INSERT INTO `hospital_specialists` (`id`, `hospital_id`, `specialist_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2025-10-10 14:26:42', NULL, NULL),
(3, 2, 5, '2025-10-18 15:05:38', NULL, NULL),
(4, 2, 4, '2025-10-19 09:25:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_01_185832_create_hospitals_table', 1),
(5, '2025_10_01_185832_create_specialists_table', 1),
(6, '2025_10_01_185833_create_hospital_specialists_table', 1),
(7, '2025_10_01_185834_create_doctors_table', 1),
(8, '2025_10_01_190059_create_booking_transactions_table', 1),
(9, '2025_10_01_234755_create_permission_tables', 1),
(10, '2025_10_02_104852_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create role', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(2, 'edit role', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(3, 'delete role', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(4, 'view role', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'API Token', '8e5e82b047c9e361594e66145d38ce3c1e302f5ef5d139850c8879004926c8f0', '[\"*\"]', '2025-10-10 11:42:42', NULL, '2025-10-10 11:31:54', '2025-10-10 11:42:42'),
(2, 'App\\Models\\User', 2, 'API Token', '5da954487322a34f9a434c86ced2dd18e69a413913c761fc0f3c3577b9a2b9ea', '[\"*\"]', '2025-10-10 13:17:33', NULL, '2025-10-10 11:57:55', '2025-10-10 13:17:33'),
(3, 'App\\Models\\User', 1, 'API Token', '1ab8d13b489738aa173d43e2fdce5f2327a45286df2da1baf88e777c344cfe5b', '[\"*\"]', NULL, NULL, '2025-10-10 13:17:22', '2025-10-10 13:17:22'),
(4, 'App\\Models\\User', 1, 'API Token', '98fa5e4ba7f6a6e535f88751e588638b8929e7f1bc3e2d31961b5894c1d4af03', '[\"*\"]', '2025-10-10 14:09:22', NULL, '2025-10-10 13:17:49', '2025-10-10 14:09:22'),
(5, 'App\\Models\\User', 1, 'API Token', '4803d8f2c20ced3bf5887e2cb871088a64f623512ca7f8e34e08f903af2c5d9c', '[\"*\"]', NULL, NULL, '2025-10-10 14:10:02', '2025-10-10 14:10:02'),
(6, 'App\\Models\\User', 1, 'API Token', '60a2184d7868a652f2e36410ec969d0c6bf0cb3237e63434f5b06f10ad10834a', '[\"*\"]', '2025-10-10 14:29:44', NULL, '2025-10-10 14:20:53', '2025-10-10 14:29:44'),
(7, 'App\\Models\\User', 2, 'API Token', 'afcb5c6abbe2286f59a6e6cb0968341c8603601361ce5002523663a2fc21dbdf', '[\"*\"]', '2025-10-10 17:58:05', NULL, '2025-10-10 15:39:36', '2025-10-10 17:58:05'),
(8, 'App\\Models\\User', 1, 'API Token', '0e7d9b5b401fc4bb9c15cc962c81e42cefe195e1a30d36f4e7f3a2378d24fa15', '[\"*\"]', '2025-10-10 18:11:58', NULL, '2025-10-10 17:57:58', '2025-10-10 18:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manager', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(2, 'customer', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(3, 'doctor', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(4, 'patient', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(5, 'insurance', 'web', '2025-10-10 03:52:03', '2025-10-10 03:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('L5Rqtfhmib6Iz8IvCelZ7RbqsomDqPBEIjTpAhrO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYVB2dXRIYWJrTG9aajR3R3dSSlhlNWlFeFZncGQ5aDI1M0RwQ21lYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvZG9jdG9ycyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMiRlUnNLMmVtclRxVWl1RVkzSWs3UGh1RTRwRFlnUzhuWjlHRDd2U2ZNUUkub0lVSW9xd0pGMiI7fQ==', 1760968551),
('UHcLwSyKOkn1wwHqIuv0AJCZNSlP6uQ2yfWssWjz', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36 Edg/141.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYlEzYUZrRkh2M240YlNBc25BSlljV29pVm1TNTRtU0FkUmd4bm9IUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hcGkvdXNlciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkMVpGVzdpMDBLWVpZMWVxREtjVnF2LmI4SHE1ZmI2WDZUVkxpc25tM2FUdnp1UGdNU0ZmdW0iO30=', 1760967288);

-- --------------------------------------------------------

--
-- Table structure for table `specialists`
--

CREATE TABLE `specialists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialists`
--

INSERT INTO `specialists` (`id`, `name`, `photo`, `about`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ginjal', 'specialists/x3Pbh0SrVUwJtlNjorzp3AwqLHYOCX63aEYGdbxV.png', 'Lorem ipsum dolor', 9000000, '2025-10-10 13:18:27', '2025-10-10 13:18:27', NULL),
(2, 'Jantung', 'specialists/BSa3mFyBUqnytkoxFu4uAdYIvbbdbEbxwEDCqd9D.png', 'organ paling penting manusia', 30000000, '2025-10-10 14:22:17', '2025-10-13 06:27:30', NULL),
(3, 'Neurologi', 'specialists/nZMsfANp0umONd0VJyeDIzijdjX6p8q07h6pQ54A.jpg', 'Specialist otak terutama syaraf', 6000000, '2025-10-13 03:39:07', '2025-10-13 03:39:07', NULL),
(4, 'Paru', 'specialists/nE39vJ5o7jtanNpRUsA4oz1rKjyd43I1EGDuTHGk.jpg', 'Menangani asthma, pneumonia, TBC maupun penyakit yang berhubungan dengan paru paru lainnya', 900000, '2025-10-17 16:26:53', '2025-10-17 16:26:53', NULL),
(5, 'Mata', 'specialists/38ntHfvsWioAcYIUaWejZ0gs5zejg0Fz0WjsIWBJ.jpg', 'Bisa konsultasi rabun, minus', 30000, '2025-10-18 04:15:00', '2025-10-18 05:00:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `phone`, `gender`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Manager User', 'manager@gmail.com', 'https://via.placeholder.com/200x200.png/007700?text=people+profile+et', '+1.318.603.2291', 'Male', '2025-10-10 03:52:03', '$2y$12$eRsK2emrTqUiuEY3Ik7PhuE4pDYgS8nZ9GD7vSfMQI.oIUIoqwJF2', 'OhO95wYjEkkxq4zw8o9m5p3hKrwH6nfk3Q8ZPT244eVjAejolvLxHeEkZJxf', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(2, 'Customer User', 'customer@gmail.com', 'https://via.placeholder.com/200x200.png/0022cc?text=people+profile+ut', '+1 (916) 569-6655', 'Female', '2025-10-10 03:52:03', '$2y$12$wXhMMI.Yt1Qk81gU/Eq7xOCniY.0ykY5btTRJw/l0RdSRvf3i0ynm', '8OOxmgjCwaErJULtjRM4OMX1XoYQQQDLukbrUOD0hdRq1NSskAgvWysZThhC', '2025-10-10 03:52:03', '2025-10-10 03:52:03'),
(3, 'Doctor User', 'doctor@gmail.com', 'https://via.placeholder.com/200x200.png/000033?text=people+profile+maiores', '1-231-708-2889', 'Male', '2025-10-10 03:52:04', '$2y$12$zvS.4Ss2Sz3kta2MY06jHeOszI4C3VpNiGhnvffARTsJZ7iRPgHXe', 'uTvtht6Hkb', '2025-10-10 03:52:04', '2025-10-10 03:52:04'),
(4, 'Patient User', 'patient@gmail.com', 'https://via.placeholder.com/200x200.png/0077aa?text=people+profile+consequatur', '+17625274125', 'Male', '2025-10-10 03:52:04', '$2y$12$S14poe9MAZBKXToBkaf3OuqklfKVeRFZcQhNmv9/IJTYXbjZz8s6S', 'fAYx87AhHN', '2025-10-10 03:52:04', '2025-10-10 03:52:04'),
(5, 'Insurance User', 'insurance@gmail.com', 'https://via.placeholder.com/200x200.png/007722?text=people+profile+quis', '442.978.0730', 'Female', '2025-10-10 03:52:04', '$2y$12$qpfNpS9I6zt5jQkR./f2T./YZ6N7ikHSJvMfA1fdhFrK31vR8plA6', 'sk4CuSerbc', '2025-10-10 03:52:04', '2025-10-10 03:52:04'),
(6, 'Hanif', 'hanif@gmail.com', 'C:\\xampp\\tmp\\php5D9D.tmp', '081111111', 'Male', NULL, '$2y$12$4fmFo42YfFErEWyk.yVabOcQzO1jd6EcqSHqcL0ErVviXzrfB5pHu', NULL, '2025-10-10 13:07:14', '2025-10-10 13:07:14'),
(7, 'Magnus Carlsen', 'magnus@gmail.com', 'C:\\xampp\\tmp\\phpBE36.tmp', '0811111111', 'Male', NULL, '$2y$12$FsdnJUFqiferma9I9X0gk.tbbu8m4wMmoh.RAJQRGp1XNEi/0kJsW', NULL, '2025-10-13 09:24:46', '2025-10-13 09:24:46'),
(8, 'Napoleon', 'napoleon@gmail.com', 'C:\\xampp\\tmp\\phpB5A2.tmp', '08111111', 'Male', NULL, '$2y$12$WJF8lHn3WRtPIcVWITdCPefTNLD/WaN2XqwccCDxPPKK7K1Lp5xb.', NULL, '2025-10-20 03:46:19', '2025-10-20 03:46:19'),
(9, 'Kaspy', 'kasparov@gmail.com', 'C:\\xampp\\tmp\\phpA0D0.tmp', '089999999', 'Male', NULL, '$2y$12$YP0MZmCMPrJWIDKHFhd5LuCbO6Ndiju/lx2P8kHxmnR7nyQxWQAmW', NULL, '2025-10-20 12:25:03', '2025-10-20 12:25:03'),
(10, 'bobby', 'fischer@gmail.com', 'user/EwReLs8Oi22Xam7PGN2ZMcy0xzh1atkeSjD03WoV.jpg', '0899999000', 'Male', NULL, '$2y$12$1ZFW7i00KYZY1eqDKcVqv.b8Hq5fb6X6TVLisnm3aTvzuPgMSFfum', NULL, '2025-10-20 13:33:19', '2025-10-20 13:33:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_transactions`
--
ALTER TABLE `booking_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_transactions_user_id_foreign` (`user_id`),
  ADD KEY `booking_transactions_doctor_id_foreign` (`doctor_id`),
  ADD KEY `booking_transactions_started_at_index` (`started_at`);

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
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_specialist_id_foreign` (`specialist_id`),
  ADD KEY `doctors_hospital_id_foreign` (`hospital_id`),
  ADD KEY `doctors_name_index` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospitals_name_index` (`name`),
  ADD KEY `hospitals_city_index` (`city`);

--
-- Indexes for table `hospital_specialists`
--
ALTER TABLE `hospital_specialists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hospital_specialists_hospital_id_specialist_id_unique` (`hospital_id`,`specialist_id`),
  ADD KEY `hospital_specialists_specialist_id_foreign` (`specialist_id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `specialists`
--
ALTER TABLE `specialists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialists_name_index` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_phone_index` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_transactions`
--
ALTER TABLE `booking_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hospital_specialists`
--
ALTER TABLE `hospital_specialists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `specialists`
--
ALTER TABLE `specialists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_transactions`
--
ALTER TABLE `booking_transactions`
  ADD CONSTRAINT `booking_transactions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctors_specialist_id_foreign` FOREIGN KEY (`specialist_id`) REFERENCES `specialists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospital_specialists`
--
ALTER TABLE `hospital_specialists`
  ADD CONSTRAINT `hospital_specialists_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hospital_specialists_specialist_id_foreign` FOREIGN KEY (`specialist_id`) REFERENCES `specialists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
