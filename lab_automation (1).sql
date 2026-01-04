-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 04:12 PM
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
-- Database: `lab_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpri_submissions`
--

CREATE TABLE `cpri_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `submission_date` date NOT NULL,
  `cpri_reference` varchar(50) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `remarks` text DEFAULT NULL,
  `submitted_by` bigint(20) UNSIGNED DEFAULT NULL
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
(2, '2025_01_01_000001_create_products_table', 1),
(3, '2025_01_01_000002_create_test_types_table', 1),
(4, '2025_01_01_000003_create_tests_table', 1),
(5, '2025_01_01_000004_create_cpri_submissions_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_code` varchar(4) NOT NULL,
  `product_type` varchar(50) NOT NULL DEFAULT 'General',
  `revision` varchar(2) NOT NULL,
  `manufacturing_number` varchar(4) NOT NULL,
  `status` enum('Pending','Pass','Fail','Remaking','CPRI_Pending','CPRI_Approved') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` varchar(12) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `test_code` varchar(3) NOT NULL,
  `department` varchar(50) NOT NULL,
  `tester_name` varchar(100) NOT NULL,
  `testing_criteria` text DEFAULT NULL,
  `expected_output` text DEFAULT NULL,
  `output_observed` text DEFAULT NULL,
  `final_result_explanation` text DEFAULT NULL,
  `status` enum('Pending','Pass','Fail') NOT NULL DEFAULT 'Pending',
  `test_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_types`
--

CREATE TABLE `test_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_code` varchar(10) NOT NULL,
  `test_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `criteria` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_types`
--

INSERT INTO `test_types` (`id`, `test_code`, `test_name`, `description`, `department`, `criteria`) VALUES
(1, 'HV-TEST', 'High Voltage Test', 'Tests insulation integrity under high voltage stress.', 'Electrical', 'Must withstand 2.5kV for 60 seconds without breakdown.'),
(2, 'INS-RES', 'Insulation Resistance', 'Measures resistance of insulation.', 'Electrical', 'Resistance must be > 500 Mega Ohms.'),
(3, 'MECH-OP', 'Mechanical Operation', 'Verifies mechanical switching operations.', 'Mechanical', 'Smooth operation for 50 cycles.'),
(4, 'VISUAL', 'Visual Inspection', 'Check for physical defects, finish, and labels.', 'Quality Control', 'No scratches, dents, or missing labels.'),
(5, 'TEMP-RISE', 'Temperature Rise', 'Checks heating under load.', 'Thermal', 'Max temp rise < 40°C above ambient.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `user_type` enum('admin','tester') NOT NULL DEFAULT 'tester',
  `department` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `full_name`, `user_type`, `department`, `is_active`, `email_verified_at`, `password`, `remember_token`) VALUES
(1, 'Administrator', 'admin', NULL, 'System Administrator', 'admin', 'IT', 1, NULL, '$2y$12$l.jbD03ChluxJeHXw.ULsuD87GI/tDKpNEc1ERAxzS.q5bY1Lnu3q', NULL),
(2, 'Test User', 'tester', NULL, 'Standard Tester', 'tester', 'Electrical', 1, NULL, '$2y$12$w1yyfFfeOCptd7GMK87SFelCRms.1say012.zsYJRcme/4U0762X.', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpri_submissions`
--
ALTER TABLE `cpri_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpri_submissions_submitted_by_foreign` (`submitted_by`),
  ADD KEY `cpri_submissions_product_id_index` (`product_id`),
  ADD KEY `cpri_submissions_status_index` (`status`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_id_unique` (`product_id`),
  ADD KEY `products_product_id_index` (`product_id`),
  ADD KEY `products_status_index` (`status`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tests_test_id_unique` (`test_id`),
  ADD KEY `tests_test_id_index` (`test_id`),
  ADD KEY `tests_product_id_index` (`product_id`),
  ADD KEY `tests_status_index` (`status`);

--
-- Indexes for table `test_types`
--
ALTER TABLE `test_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_types_test_code_unique` (`test_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpri_submissions`
--
ALTER TABLE `cpri_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_types`
--
ALTER TABLE `test_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpri_submissions`
--
ALTER TABLE `cpri_submissions`
  ADD CONSTRAINT `cpri_submissions_submitted_by_foreign` FOREIGN KEY (`submitted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
