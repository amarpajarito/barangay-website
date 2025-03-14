-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 10:03 AM
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
-- Database: `barangay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `document_requests`
--

CREATE TABLE `document_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `reason` text NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_requests`
--

INSERT INTO `document_requests` (`id`, `name`, `document_type`, `address`, `reason`, `request_date`, `status`) VALUES
(1, 'test', 'Barangay Clearance', '23 address st., Laguna', 'The error occurred because the code is not for the default compiler used there.', '2025-02-28 09:17:27', 'Approved'),
(2, 'Amar Pajarito', 'Barangay Clearance', 'Angono, Rizal', 'School Purposes', '2025-03-14 07:37:49', 'Rejected'),
(3, 'Jermaine Chung', 'Indigency Certificate', '23 example st., Laguna', 'Scholarship', '2025-03-14 08:39:47', 'Pending'),
(4, 'Enzo Arinsol', 'Business Permit', '123 Vicente Street, Laguna', 'Business Opening', '2025-03-14 08:40:56', 'Pending'),
(5, 'Adam Atienza', 'Barangay Clearance', '104 Kamagong st., Laguna', 'Job Application', '2025-03-14 08:42:02', 'Pending'),
(6, 'Lamelo Cloma', 'Barangay Clearance', '320 address st., Laguna', 'Good day, I would like to request a barangay clearance for job application. I am a resident of your barangay and can provide the necessary documents if needed. Kindly let me know the requirements and process. Thank you.', '2025-03-14 08:58:42', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `enlistments`
--

CREATE TABLE `enlistments` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `civil_status` varchar(20) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enlistments`
--

INSERT INTO `enlistments` (`id`, `first_name`, `last_name`, `address`, `contact_number`, `civil_status`, `purpose`, `created_at`, `status`) VALUES
(6, 'test', 'last', '23 address st., Laguna', '09429494924', 'Single', 'Residency', '2025-02-28 08:34:56', 'Rejected'),
(7, 'test2', 'last2', '23 address st., Laguna', '09429494933', 'Married', 'Residency', '2025-02-28 12:14:04', 'Approved'),
(8, 'Andre', 'Penolio', '43 Vicente Street, Laguna', '0947374838294', 'Divorced', 'Residency', '2025-03-14 08:45:59', 'Pending'),
(9, 'Paul', 'Atienza', '123 Vicente Street, Laguna', '0995403432', 'Married', 'Voter Registration', '2025-03-14 08:46:42', 'Pending'),
(10, 'Darrell', 'Cloma', '52 Lapaz st., Laguna', '09649543924', 'Widowed', 'Barangay ID', '2025-03-14 08:47:27', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_requests`
--

CREATE TABLE `equipment_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `reason` text NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment_requests`
--

INSERT INTO `equipment_requests` (`id`, `name`, `item_type`, `address`, `reason`, `request_date`, `status`) VALUES
(1, 'test', 'Projector', '23 address st., Laguna', 'barangay event', '2025-02-28 09:14:37', 'Rejected'),
(2, 'Paul Tan', 'Sound System', '23 address st., Laguna', 'Birthday Party', '2025-03-14 08:44:01', 'Approved'),
(3, 'Andre Penolio', 'Chairs and Tables', '123 Vicente Street, Laguna', 'Wake', '2025-03-14 08:45:06', 'Pending'),
(4, 'Kolby Hernandez', 'Projector', '24 Caton st., Laguna', 'Outreach Program', '2025-03-14 08:49:44', 'Pending'),
(5, 'Josh Legaspi', 'Sound System', '213 Vicente Street, Laguna', 'Street Dance Event', '2025-03-14 08:50:19', 'Pending'),
(6, 'Kyle Santos', 'Projector', '142 Vicente Street, Laguna', 'Good day, I would like to request the use of a projector for presentation on March 20, 2025. The venue will be at 142 Vicente Street, and I will ensure the proper handling and return of the equipment. Please let me know the requirements and availability. Thank you', '2025-03-14 09:00:11', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT '/images/barangay-logo.png',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(64) DEFAULT NULL,
  `remember_expiry` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `created_at`, `profile_pic`, `is_admin`, `remember_token`, `remember_expiry`) VALUES
(1, 'Admin', 'User', 'Admin', 'admin-barangaysanvicente@gmail.com', '$2y$10$7K0kgTGBhMRxA3FvY.1dj.DIpd6V8aO2CsdHWGyJhsVKVK2UG0V.m', '2025-02-28 02:34:10', '/images/barangay-logo.png', 1, NULL, NULL),
(2, 'Enzo', 'Arinsol', 'enzoarinsol', 'enzoarinsol@gmail.com', '$2y$10$ICpl.yJ/QlXft29bxktLAuuU0M6zqgudwDrUO0G6JvBUEtq5HfrOm', '2025-02-28 02:35:58', '/images/barangay-logo.png', 0, NULL, NULL),
(3, 'Peter', 'Camaya', 'petercamaya', 'petercamaya@gmail.com', '$2y$10$9yVuzNqfQDsztqNk3NUrA.NNPPWTYU8WcIoMKWe2AgkA3yi5orVtO', '2025-02-28 02:36:27', '/images/barangay-logo.png', 0, NULL, NULL),
(4, 'Jermaine', 'Chung', 'jermainechung', 'jermainechung@gmail.com', '$2y$10$NkVdtlxgPXSz7U.c6ZBimew4.d795rrXwdjiGyXcD9wm4jgUEXJdK', '2025-02-28 02:37:12', '/images/barangay-logo.png', 0, NULL, NULL),
(5, 'Railey', 'De Guzman', 'raileydeguzman', 'raileydeguzman@gmail.com', '$2y$10$6zZU01zQlGWFjNe7xhvgW.4o/OJjrlO21aq/tg0kWTOUZ07RMCasm', '2025-02-28 02:37:44', '/images/barangay-logo.png', 0, NULL, NULL),
(6, 'Josh', 'Legaspi', 'joshlegaspi', 'joshlegaspi@gmail.com', '$2y$10$xmuxvujEgHAnUqPYBp2dpOZwprkS87TV/OEc5OidMy6.BQeRw1NMm', '2025-02-28 02:38:21', '/images/barangay-logo.png', 0, NULL, NULL),
(7, 'Kenneth', 'Mejia', 'kennethmejia', 'kennethmejia@gmail.com', '$2y$10$Yv1gqxQmmQFBEw7Mk72bPe0XvOQrLzABQ/oJydJQ1e/5b/BZgYVLK', '2025-02-28 02:39:07', '/images/barangay-logo.png', 0, NULL, NULL),
(8, 'Amar', 'Pajarito', 'amarpajarito', 'amarpajarito@gmail.com', '$2y$10$Lu4sZLzIQkH0uV.piYAQd.chur8CIVFJeGv.WJ33OXS0JAZXqM3jy', '2025-02-28 02:39:33', '/images/barangay-logo.png', 0, '7ac9414394f10c06a4630e00829d8e70efff9feea3311a309675250dc2531bf6', 1744528661),
(17, 'Kyle', 'Santos', 'kyle', 'kylesantos@gmail.com', '$2y$10$HK2cCToXWDWfaNZ42KqMReRqNQbVZbMSLxAHCc/JnHxtGQ6Vje1Pi', '2025-03-07 04:11:51', '/images/barangay-logo.png', 0, NULL, NULL),
(23, 'Gg', 'Bro', 'ggbro', 'ggbro@gmail.com', '$2y$10$6clm2oZjmHxA6nx8BKNX0e3L2XXH0vZsNyu1ucKiPnzh5mora7Pru', '2025-03-14 06:46:21', '/images/barangay-logo.png', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document_requests`
--
ALTER TABLE `document_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enlistments`
--
ALTER TABLE `enlistments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_requests`
--
ALTER TABLE `equipment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document_requests`
--
ALTER TABLE `document_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enlistments`
--
ALTER TABLE `enlistments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `equipment_requests`
--
ALTER TABLE `equipment_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
