-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2024 at 06:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

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
(1, 'role-list', 'web', '2024-02-06 02:44:49', '2024-02-06 02:44:49'),
(2, 'role-create', 'web', '2024-02-06 02:44:49', '2024-02-06 02:44:49'),
(3, 'role-edit', 'web', '2024-02-06 02:44:49', '2024-02-06 02:44:49'),
(4, 'role-delete', 'web', '2024-02-06 02:44:49', '2024-02-06 02:44:49'),
(5, 'route-list', 'web', '2024-02-06 07:17:57', '2024-02-06 07:17:57'),
(6, 'route-create', 'web', '2024-02-06 07:17:57', '2024-02-06 07:17:57'),
(7, 'route-edit', 'web', '2024-02-06 07:17:57', '2024-02-06 07:17:57'),
(8, 'route-delete', 'web', '2024-02-06 07:17:57', '2024-02-06 07:17:57'),
(9, 'user-list', 'web', '2024-02-11 11:57:55', '2024-02-11 11:57:55'),
(10, 'user-create', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(11, 'user-edit', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(12, 'user-delete', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(13, 'transport-list', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(14, 'transport-create', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(15, 'transport-edit', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(16, 'transport-delete', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(17, 'hotel-list', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(18, 'hotel-create', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(19, 'hotel-edit', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(20, 'hotel-delete', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(21, 'add-weekend-days', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(22, 'package-list', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(23, 'package-create', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(24, 'package-edit', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(25, 'package-delete', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(26, 'package-calculation', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56'),
(27, 'currency-conversion', 'web', '2024-02-11 11:57:56', '2024-02-11 11:57:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
