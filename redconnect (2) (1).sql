-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2026 at 02:39 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int UNSIGNED NOT NULL,
  `donor_id` int UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `health_declaration` text NOT NULL,
  `status` enum('pending','approved','declined','completed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `donor_id`, `appointment_date`, `appointment_time`, `health_declaration`, `status`) VALUES
(1, 2, '2026-07-11', '10:30:00', 'Healthy', 'completed'),
(4, 2, '2026-07-06', '09:00:03', 'I am feeling healthy', 'approved'),
(5, 3, '2026-07-06', '06:34:19', 'i am healthy forever', 'completed'),
(6, 3, '2026-07-06', '21:39:51', 'healthy\r\n', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `blood_types`
--

CREATE TABLE `blood_types` (
  `id` int UNSIGNED NOT NULL,
  `blood_group` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blood_types`
--

INSERT INTO `blood_types` (`id`, `blood_group`) VALUES
(4, 'A-'),
(3, 'A+'),
(8, 'AB-'),
(7, 'AB+'),
(6, 'B-'),
(5, 'B+'),
(2, 'O-'),
(1, 'O+');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int UNSIGNED NOT NULL,
  `donation_history_id` int UNSIGNED NOT NULL,
  `certificate_code` varchar(50) NOT NULL,
  `issued_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `donation_history_id`, `certificate_code`, `issued_at`) VALUES
(1, 3, 'RC-20260704-0001', '2026-07-04 14:26:10'),
(2, 4, 'RC-20260706-0002', '2026-07-06 07:41:44'),
(3, 2, 'RC-20260712-0003', '2026-07-12 08:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `donation_histories`
--

CREATE TABLE `donation_histories` (
  `id` int UNSIGNED NOT NULL,
  `donor_id` int UNSIGNED NOT NULL,
  `staff_id` int UNSIGNED NOT NULL,
  `appointment_id` int UNSIGNED DEFAULT NULL,
  `donation_date` date NOT NULL,
  `quantity_pack` int NOT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donation_histories`
--

INSERT INTO `donation_histories` (`id`, `donor_id`, `staff_id`, `appointment_id`, `donation_date`, `quantity_pack`, `remarks`) VALUES
(1, 2, 1, 1, '2026-07-07', 2, ''),
(2, 2, 1, 1, '2026-07-07', 1, ''),
(3, 2, 1, 1, '2026-07-07', 1, ''),
(4, 3, 2, 1, '2026-07-06', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `blood_type_id` int UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `ic_number` varchar(12) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` text NOT NULL,
  `last_donation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `user_id`, `blood_type_id`, `full_name`, `ic_number`, `phone_number`, `gender`, `date_of_birth`, `address`, `last_donation`) VALUES
(1, 2, 4, 'Nur Mahirah Nisrina Binti Mahadzir', '060129107777', '+6013-7354901', 'Female', '2006-01-29', '456 Jalan Sinar, Bandar Baru Bangi, 43000 Bangi, Selangor, Malaysia', NULL),
(2, 3, 4, 'Gloria Audrey', '040909131122', '0178038462', 'Female', '2004-09-09', 'Pangsapuri Resak', '2026-07-07'),
(3, 5, 5, 'MELATI', '010720140984', '01140271890', 'Female', '2026-07-31', 'wangsa maju', '2026-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `user_id`, `full_name`, `phone_number`, `position`) VALUES
(1, 1, 'Zulaikha Binti Mohd Khairul Sabastian', '+6019-2910105', 'Admin'),
(2, 4, 'Gloria Audrey Anak Jackson', '0178038462', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','donor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'zu41m11029@gmail.com', 'zushido#00', 'admin', '2026-07-03 01:30:08'),
(2, 'mahirah@gmail.com', 'mahirah1234', 'donor', '2026-07-03 01:31:57'),
(3, 'audreygloria26@gmail.com', '12345', 'donor', '2026-07-04 04:59:55'),
(4, 'audrey@redconnect.mail.com', '12345', 'staff', '2026-07-04 16:29:04'),
(5, 'nuranisahmelati@gmail.com', '123456789', 'donor', '2026-07-06 07:32:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`donor_id`);

--
-- Indexes for table `blood_types`
--
ALTER TABLE `blood_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK` (`blood_group`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK` (`donation_history_id`),
  ADD UNIQUE KEY `FKey` (`certificate_code`);

--
-- Indexes for table `donation_histories`
--
ALTER TABLE `donation_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`donor_id`),
  ADD KEY `FKey` (`staff_id`),
  ADD KEY `ForKey` (`appointment_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK` (`user_id`),
  ADD UNIQUE KEY `ForKey` (`ic_number`),
  ADD KEY `FKey` (`blood_type_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blood_types`
--
ALTER TABLE `blood_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donation_histories`
--
ALTER TABLE `donation_histories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_ibfk_1` FOREIGN KEY (`donation_history_id`) REFERENCES `donation_histories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `donation_histories`
--
ALTER TABLE `donation_histories`
  ADD CONSTRAINT `donation_histories_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_histories_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `donation_histories_ibfk_3` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `donors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `donors_ibfk_2` FOREIGN KEY (`blood_type_id`) REFERENCES `blood_types` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
