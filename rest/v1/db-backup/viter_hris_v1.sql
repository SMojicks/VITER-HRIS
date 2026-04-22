-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2026 at 04:03 AM
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
-- Database: `viter_hris_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_aid` int(11) NOT NULL,
  `employee_is_active` tinyint(1) NOT NULL,
  `employee_first_name` varchar(128) NOT NULL,
  `employee_middle_name` varchar(128) NOT NULL,
  `employee_last_name` varchar(128) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_created` datetime NOT NULL,
  `employee_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_aid`, `employee_is_active`, `employee_first_name`, `employee_middle_name`, `employee_last_name`, `employee_email`, `employee_created`, `employee_updated`) VALUES
(1, 0, 'Johnnyy', 'Yess', 'Papaa', 'Johnny@gmail.commm', '2026-04-21 07:04:25', '2026-04-21 07:04:13'),
(2, 1, 'seb', 'seb', 'seb', 'seb@gmail.com', '2026-04-21 09:04:41', '2026-04-21 09:04:41'),
(3, 1, 'seb123', '123', 'seb', '123@gmail.com', '2026-04-21 09:04:18', '2026-04-21 09:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE `memo` (
  `memo_aid` int(11) NOT NULL,
  `memo_is_active` tinyint(1) NOT NULL,
  `memo_from` varchar(200) NOT NULL,
  `memo_to` varchar(200) NOT NULL,
  `memo_date` varchar(20) NOT NULL,
  `memo_category` varchar(128) NOT NULL,
  `memo_text` text NOT NULL,
  `memo_created` datetime NOT NULL,
  `memo_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`memo_aid`, `memo_is_active`, `memo_from`, `memo_to`, `memo_date`, `memo_category`, `memo_text`, `memo_created`, `memo_updated`) VALUES
(2, 1, 'asdasd', 'asdasd', '2026-04-21', 'asdasdas', 'Memo No. 0825, Series 2025\nTO: ALL EMPLOYEES\nRE: LAUNCH OF CLIENT REFERRAL INCENTIVE PROGRAM\n\nTo further grow our client base and expand the reach of our service offerings, we are pleased to launch the Client\nReferral Incentive Program. This program provides monetary incentives to employees, partners, or external\ncontacts who successfully refer a local client that closes a deal with Frontline Business Solutions in any of the\nfollowing services:\n1. Website Development\n2 Web Applications Subscriptions\n3. Customized Web App Development\n4. Web and Graphic Design\n5. Business Registration\n6. Bookkeeping & Business Compliance\n\nPlease note that this incentive applies to all employees, except those whose primary role or job function is to\nacquire clients (e.g., sales, marketing, or business development roles).\n\nThe incentive amount will depend on the size and scope of the closed deal and may range from P500 to ₱1,000, as\ndetermined by the management, marketing team, and project lead.\n\nThank you for your continued support in helping us expand our network and client base.', '2026-04-22 08:37:34', '2026-04-22 09:13:35'),
(3, 1, 'www', 'www', '2026-03-31', 'www', 'wwwaaa', '2026-04-22 08:46:59', '2026-04-22 08:47:08'),
(4, 1, 'awd', 'awd', '2026-04-14', 'www', 'awd', '2026-04-22 10:01:31', '2026-04-22 10:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `settings_roles`
--

CREATE TABLE `settings_roles` (
  `role_aid` int(11) NOT NULL,
  `role_is_active` tinyint(1) NOT NULL,
  `role_name` varchar(128) NOT NULL,
  `role_description` text NOT NULL,
  `role_created` datetime NOT NULL,
  `role_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_roles`
--

INSERT INTO `settings_roles` (`role_aid`, `role_is_active`, `role_name`, `role_description`, `role_created`, `role_updated`) VALUES
(22, 1, 'developer', 'test', '2026-04-16 12:04:30', '2026-04-21 07:04:45'),
(23, 1, 'admin', 'test', '2026-04-16 12:04:38', '2026-04-21 07:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `settings_users`
--

CREATE TABLE `settings_users` (
  `users_aid` int(11) NOT NULL,
  `users_is_active` tinyint(1) NOT NULL,
  `users_first_name` varchar(255) NOT NULL,
  `users_last_name` varchar(255) NOT NULL,
  `users_email` varchar(255) NOT NULL,
  `users_role_id` varchar(20) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_created` datetime NOT NULL,
  `users_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_users`
--

INSERT INTO `settings_users` (`users_aid`, `users_is_active`, `users_first_name`, `users_last_name`, `users_email`, `users_role_id`, `users_password`, `users_created`, `users_updated`) VALUES
(29, 1, 'John', 'Doe', 'Johndoe@gmail.com', '22', '', '2026-04-21 12:04:38', '2026-04-21 12:04:38'),
(30, 1, 'Jane', 'Doe', 'Janedoe@gmail.com', '23', '', '2026-04-21 12:04:57', '2026-04-21 12:04:57'),
(32, 1, 'Sarah', 'Cruz', 'sarah@gmail.com', '23', '', '2026-04-21 12:04:46', '2026-04-21 12:04:46'),
(33, 0, 'Gojo', 'Satoru', 'satoru@gmail.com', '22', '', '2026-04-21 12:04:10', '2026-04-21 12:04:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_aid`);

--
-- Indexes for table `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`memo_aid`);

--
-- Indexes for table `settings_roles`
--
ALTER TABLE `settings_roles`
  ADD PRIMARY KEY (`role_aid`);

--
-- Indexes for table `settings_users`
--
ALTER TABLE `settings_users`
  ADD PRIMARY KEY (`users_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
  MODIFY `memo_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings_roles`
--
ALTER TABLE `settings_roles`
  MODIFY `role_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `settings_users`
--
ALTER TABLE `settings_users`
  MODIFY `users_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
