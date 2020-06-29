-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 01:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercise`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_06_29_063937_create_routers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `routers`
--

CREATE TABLE `routers` (
  `id` int(10) UNSIGNED NOT NULL,
  `sap_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('AG1','CSS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AG1',
  `host_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loopback` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mac_address` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routers`
--

INSERT INTO `routers` (`id`, `sap_id`, `type`, `host_name`, `loopback`, `mac_address`) VALUES
(1, '65739', 'AG1', 'welch4378', '97.109.181.200', 'D6:3A:FF:BC:0D:33'),
(2, '1818725', 'AG1', 'windler3345', '151.15.190.102', '19:21:0F:7B:F5:A7'),
(3, '611802', 'CSS', 'osinski3361', '215.153.56.246', '50:63:AC:18:36:5F'),
(4, '3888224', 'AG1', 'sauer4545', '224.134.61.35', 'C3:F2:A4:07:D7:B1'),
(5, '3777821', 'CSS', 'greenfelder1358', '22.235.161.10', 'EB:8C:18:2B:4E:8B'),
(6, '3864933', 'AG1', 'mclaughlin2219', '235.124.90.45', '2E:14:16:05:47:6B'),
(7, '1263790', 'CSS', 'beatty668', '20.74.172.224', 'C7:AB:8E:94:5E:00'),
(8, '4723624', 'CSS', 'armstrong1382', '140.107.27.103', 'E0:B1:AB:BD:B0:05'),
(9, '3234472', 'CSS', 'hartmann3355', '103.196.158.98', 'E0:EF:6C:63:BD:32'),
(10, '1110299', 'AG1', 'koch2886', '19.194.142.14', '1A:B8:5C:FC:23:85'),
(11, '2981054', 'AG1', 'bednar522', '243.146.94.92', '13:2D:30:FD:77:20'),
(12, '3288903', 'AG1', 'carter4459', '183.137.116.38', '69:46:8C:2B:D3:36'),
(13, '3643602', 'CSS', 'keebler1488', '63.221.5.47', 'DB:35:A2:CD:12:80'),
(14, '1793088', 'AG1', 'hilpert3713', '98.104.243.206', 'CA:67:6F:BE:6E:12'),
(15, '3842917', 'AG1', 'deckow2714', '191.99.193.141', '9F:AD:CF:83:B8:D4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'dev.test@gmail.com', '$2y$10$Rd0tFWqKjz0azTGHQZ7JDelFGP6GPYBYck1DcOe.Hr735HV0Vh8sS', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `routers`
--
ALTER TABLE `routers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `routers_sap_id_unique` (`sap_id`),
  ADD UNIQUE KEY `routers_host_name_unique` (`host_name`),
  ADD UNIQUE KEY `routers_loopback_unique` (`loopback`),
  ADD UNIQUE KEY `routers_mac_address_unique` (`mac_address`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `routers`
--
ALTER TABLE `routers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
