-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2024 at 07:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hajj-umrah`
--

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `validity` date NOT NULL,
  `current_currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `item_id`, `item_type`, `cost`, `validity`, `current_currency`, `created_at`, `updated_at`) VALUES
(14, 4, 'transports', 11.00, '2024-03-10', NULL, '2024-02-10 05:16:48', '2024-02-10 06:12:12'),
(15, 4, 'transports', 12.00, '2024-02-17', NULL, '2024-02-10 06:11:58', '2024-02-10 06:12:12'),
(16, 4, 'transports', 13.00, '2024-02-23', NULL, '2024-02-10 06:12:55', '2024-02-10 06:12:55'),
(17, 4, 'transports', 14.00, '2024-02-17', NULL, '2024-02-10 07:29:49', '2024-02-10 07:29:49'),
(18, 5, 'transports', 20.00, '2024-02-13', NULL, '2024-02-10 07:50:17', '2024-02-10 07:51:28'),
(19, 5, 'transports', 21.00, '2024-02-12', NULL, '2024-02-10 07:50:58', '2024-02-10 07:50:58'),
(20, 6, 'transports', 20.00, '2024-02-12', NULL, '2024-02-10 07:52:04', '2024-02-10 07:52:32'),
(21, 6, 'transports', 22.00, '2024-02-14', NULL, '2024-02-10 07:54:13', '2024-02-10 07:54:13'),
(22, 6, 'transports', 23.00, '2024-02-15', NULL, '2024-02-10 08:09:54', '2024-02-10 08:09:54'),
(23, 7, 'transports', 12.00, '2024-02-14', NULL, '2024-02-10 08:55:31', '2024-02-10 08:56:50'),
(24, 7, 'transports', 13.00, '2024-02-21', NULL, '2024-02-10 08:56:50', '2024-02-10 08:56:50'),
(25, 7, 'transports', 14.00, '2024-02-29', NULL, '2024-02-10 08:57:17', '2024-02-10 08:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `currency_conversions`
--

CREATE TABLE `currency_conversions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usd` double(8,2) NOT NULL,
  `sar` double(8,2) NOT NULL,
  `default_currency` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_conversions`
--

INSERT INTO `currency_conversions` (`id`, `usd`, `sar`, `default_currency`, `created_at`, `updated_at`) VALUES
(1, 80.00, 60.00, 'usd', '2024-02-04 14:05:48', '2024-02-04 14:05:48');

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
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `excerpt` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `google_map` longtext NOT NULL,
  `city` varchar(255) NOT NULL,
  `validity` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `excerpt`, `description`, `google_map`, `city`, `validity`, `created_at`, `updated_at`) VALUES
(1, 'hotel1', '123', 'ssss', 'NA', 'Makkah', '2024-02-11', '2024-02-10 09:15:43', '2024-02-11 23:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_rooms`
--

CREATE TABLE `hotel_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `weekdays_price` double(8,2) NOT NULL,
  `weekend_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotel_rooms`
--

INSERT INTO `hotel_rooms` (`id`, `hotel_id`, `room_id`, `weekdays_price`, `weekend_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10.00, 10.00, NULL, '2024-02-11 23:47:59'),
(2, 1, 2, 10.00, 10.00, NULL, '2024-02-11 23:47:59'),
(3, 1, 3, 10.00, 10.00, NULL, '2024-02-11 23:47:59'),
(4, 1, 4, 10.00, 10.00, NULL, '2024-02-11 23:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_special_offers`
--

CREATE TABLE `hotel_special_offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel_special_offer_rooms`
--

CREATE TABLE `hotel_special_offer_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `path`, `hotel_id`, `created_at`, `updated_at`) VALUES
(1, '1707574543_1.jpeg', 'uploads/1707574543_1.jpeg', 1, '2024-02-10 09:15:43', '2024-02-10 09:15:43');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_07_18_191518_create_permission_tables', 1),
(7, '2023_07_21_172608_create_transport_types_table', 1),
(8, '2023_07_21_173630_create_routes_table', 1),
(9, '2023_07_21_175446_create_transports_table', 1),
(10, '2023_07_29_063116_create_rooms_table', 1),
(11, '2023_07_29_170239_create_weekends_table', 1),
(12, '2023_08_03_193324_create_hotels_table', 1),
(13, '2023_08_03_193801_create_hotel_rooms_table', 1),
(14, '2023_09_23_202706_create_images_table', 1),
(15, '2023_09_29_183857_create_hotel_special_offers_table', 1),
(16, '2023_09_30_180144_create_hotel_special_offer_rooms_table', 1),
(17, '2024_02_04_091654_create_currency_conversions_table', 1),
(18, '2024_02_04_111557_create_costs_table', 1),
(19, '2024_02_10_144954_add_currency_column_to_cost_name', 2),
(20, '2024_02_11_161210_create_visas_table', 2),
(21, '2024_02_11_185710_add_title_to_hotel', 2),
(22, '2014_10_12_000000_create_users_table', 3);

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
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'role-list', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(2, 'role-create', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(3, 'role-edit', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(4, 'role-delete', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(5, 'route-list', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(6, 'route-create', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(7, 'route-edit', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(8, 'route-delete', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(9, 'user-list', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(10, 'user-create', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(11, 'user-edit', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(12, 'user-delete', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(13, 'transport-list', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(14, 'transport-create', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(15, 'transport-edit', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(16, 'transport-delete', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(17, 'hotel-list', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(18, 'hotel-create', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(19, 'hotel-edit', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(20, 'hotel-delete', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(21, 'package-list', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(22, 'package-create', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(23, 'package-edit', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(24, 'package-delete', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(25, 'add-weekend-days', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(26, 'package-calculation', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20'),
(27, 'currency-conversion', 'web', '2024-02-12 01:01:20', '2024-02-12 01:01:20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'admin', 'web', NULL, NULL),
(2, 'SuperAdmin', 'web', '2024-02-12 01:07:35', '2024-02-12 01:07:35');

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
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Single', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(2, 'Double', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(3, 'Triple', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(4, 'quad', '2024-02-04 06:54:53', '2024-02-04 06:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Jeddah Airport  to Makkah Hotel', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(2, 'Makkah to Jeddah Airport', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(3, 'Makkah Hotel to Madina Hotel', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(4, 'Madina Hotel to Makkah Hotel', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(5, 'Madina Airport to Madina Hotel', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(6, 'Madina Hotel to Madina Airport', '2024-02-04 06:54:53', '2024-02-04 06:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transport_type_id` bigint(20) UNSIGNED NOT NULL,
  `make` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `route_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `transport_type_id`, `make`, `capacity`, `route_id`, `created_at`, `updated_at`) VALUES
(4, 1, '11', 11, 1, '2024-02-10 05:16:48', '2024-02-10 05:16:48'),
(5, 2, '22', 20, 3, '2024-02-10 07:50:16', '2024-02-10 07:50:16'),
(6, 1, '24', 20, 1, '2024-02-10 07:52:04', '2024-02-10 07:52:04'),
(7, 3, '20', 22, 3, '2024-02-10 08:55:31', '2024-02-10 08:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `transport_types`
--

CREATE TABLE `transport_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transport_types`
--

INSERT INTO `transport_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bus', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(2, 'Car', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(3, 'Wagon', '2024-02-04 06:54:53', '2024-02-04 06:54:53'),
(4, 'Coach', '2024-02-04 06:54:53', '2024-02-04 06:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `dob`, `gender`, `id_card`, `designation`, `phone`, `address`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'alii', 'ahmedd', '2024-02-15', 'M', '123456789999', 'developr', 12345666, 'my address', 'ali@gmail.com', NULL, '$2y$10$8sQO8FleKWe1Zv9XDzP8IOP9ErNxZmVqfGWjGEMVG1Lpqw/WU22l2', NULL, NULL, '2024-02-12 01:15:05'),
(2, 'user1', 'user1', '2020-02-14', 'M', '1212121212121', 'Developer', 1212121, 'skdjhdksjhdkshkds', 'user1@gmail.com', NULL, '$2y$10$yMoM/ZNRA181yEE/U1dmy.df5KE4mjGRdbdOY2T.7VpjpTxUD781S', NULL, '2024-02-12 01:08:57', '2024-02-12 01:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `visas`
--

CREATE TABLE `visas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hajj_charges` decimal(10,2) DEFAULT NULL,
  `umrah_charges` decimal(10,2) DEFAULT NULL,
  `current_currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visas`
--

INSERT INTO `visas` (`id`, `hajj_charges`, `umrah_charges`, `current_currency`, `created_at`, `updated_at`) VALUES
(1, 150.00, 250.00, 'usd', NULL, '2024-02-11 23:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `weekends`
--

CREATE TABLE `weekends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weekends`
--

INSERT INTO `weekends` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '[\"Monday\",\"Sunday\"]', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `costs_item_id_item_type_index` (`item_id`,`item_type`);

--
-- Indexes for table `currency_conversions`
--
ALTER TABLE `currency_conversions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_rooms_hotel_id_foreign` (`hotel_id`),
  ADD KEY `hotel_rooms_room_id_foreign` (`room_id`);

--
-- Indexes for table `hotel_special_offers`
--
ALTER TABLE `hotel_special_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_special_offers_hotel_id_foreign` (`hotel_id`);

--
-- Indexes for table `hotel_special_offer_rooms`
--
ALTER TABLE `hotel_special_offer_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_special_offer_rooms_package_id_foreign` (`package_id`),
  ADD KEY `hotel_special_offer_rooms_room_id_foreign` (`room_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_hotel_id_foreign` (`hotel_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transports_transport_type_id_foreign` (`transport_type_id`),
  ADD KEY `transports_route_id_foreign` (`route_id`);

--
-- Indexes for table `transport_types`
--
ALTER TABLE `transport_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visas`
--
ALTER TABLE `visas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekends`
--
ALTER TABLE `weekends`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `currency_conversions`
--
ALTER TABLE `currency_conversions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hotel_special_offers`
--
ALTER TABLE `hotel_special_offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel_special_offer_rooms`
--
ALTER TABLE `hotel_special_offer_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transport_types`
--
ALTER TABLE `transport_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visas`
--
ALTER TABLE `visas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weekends`
--
ALTER TABLE `weekends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hotel_rooms`
--
ALTER TABLE `hotel_rooms`
  ADD CONSTRAINT `hotel_rooms_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  ADD CONSTRAINT `hotel_rooms_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `hotel_special_offers`
--
ALTER TABLE `hotel_special_offers`
  ADD CONSTRAINT `hotel_special_offers_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

--
-- Constraints for table `hotel_special_offer_rooms`
--
ALTER TABLE `hotel_special_offer_rooms`
  ADD CONSTRAINT `hotel_special_offer_rooms_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `hotel_special_offers` (`id`),
  ADD CONSTRAINT `hotel_special_offer_rooms_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_hotel_id_foreign` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`);

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

--
-- Constraints for table `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `transports_transport_type_id_foreign` FOREIGN KEY (`transport_type_id`) REFERENCES `transport_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
