-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2026 at 03:34 AM
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
  `employee_department_id` varchar(20) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_created` datetime NOT NULL,
  `employee_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_aid`, `employee_is_active`, `employee_first_name`, `employee_middle_name`, `employee_last_name`, `employee_department_id`, `employee_email`, `employee_created`, `employee_updated`) VALUES
(7, 1, 'Seb', 'Aus', 'Mojica', '1', 'seb@gmail.com', '2026-04-23 08:38:44', '2026-04-23 08:38:44'),
(8, 1, 'Test', 'test', 'test', '2', 'awd@gmaiul.com', '2026-04-23 09:29:36', '2026-04-23 09:29:46');

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
(6, 1, 'FBS Management', 'FBS Employees', '2026-04-20', 'Notices', 'Memo No. 0825, Series 2025\nTO: ALL EMPLOYEES\nRE: LAUNCH OF CLIENT REFERRAL INCENTIVE PROGRAM\n\nTo further grow our client base and expand the reach of our service offerings, we are pleased to launch the Client\nReferral Incentive Program. This program provides monetary incentives to employees, partners, or external\ncontacts who successfully refer a local client that closes a deal with Frontline Business Solutions in any of the\nfollowing services:\n1. Website Development\n2. Web Applications Subscriptions\n3. Customized Web App Development\n4. Web and Graphic Design\n5. Business Registration\n6. Bookkeeping & Business Compliance \n\nPlease note that this incentive applies to all employees, except those whose primary role or job function is to\nacquire clients (e.g., sales, marketing, or business development roles).\n\nThe incentive amount will depend on the size and scope of the closed deal and may range from P500 to ₱1,000, as\ndetermined by the management, marketing team, and project lead.\n\nThank you for your continued support in helping us expand our network and client base. test test test', '2026-04-22 10:11:13', '2026-04-22 11:44:08'),
(10, 1, 'HR Department', 'All Employees', '2026-04-30', 'Notices', 'Memo No. 101, Series 2026\nTO: All Employees\nFROM: HR Department\nDATE: January 15, 2026\nCATEGORY: Notices\n\nRE: Implementation of New Attendance Monitoring System\n\nTo improve accuracy and efficiency in tracking employee attendance, the company will implement a new digital attendance monitoring system starting February 1, 2026.\n\nKey features include:\n\nBiometric login integration\nReal-time attendance tracking\nAutomated late and absence reports\nEmployee self-service dashboard\n\nAll employees are required to register their biometric data before the implementation date.\n\nThank you for your cooperation.', '2026-04-22 11:52:29', '2026-04-22 11:52:41'),
(11, 1, 'IT Department', 'All Staff', '2026-04-19', 'Advisory', 'RE: Scheduled System Maintenance\n\nPlease be advised that system maintenance will take place on February 20, 2026, from 10:00 PM to 2:00 AM.\n\nDuring this period:\n\nHRIS and Payroll systems will be temporarily unavailable\nUsers may experience intermittent access issues\nData updates will be paused\n\nWe recommend saving all work prior to the scheduled downtime.\n\nThank you for your understanding.', '2026-04-22 11:53:43', '2026-04-22 11:53:43'),
(12, 0, 'Management', 'All Employees', '2026-04-29', 'Announcement', 'RE: Launch of Employee Wellness Program\n\nWe are pleased to introduce our Employee Wellness Program aimed at promoting health and well-being in the workplace.\n\nProgram highlights:\n\nFree monthly health check-ups\nMental health support sessions\nGym membership discounts\nWellness webinars and workshops\n\nParticipation is voluntary but highly encouraged.\n\nLet’s work together toward a healthier workplace.', '2026-04-22 11:54:17', '2026-04-22 12:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `settings_department`
--

CREATE TABLE `settings_department` (
  `department_aid` int(11) NOT NULL,
  `department_is_active` tinyint(4) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `department_created` datetime NOT NULL,
  `department_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_department`
--

INSERT INTO `settings_department` (`department_aid`, `department_is_active`, `department_name`, `department_created`, `department_updated`) VALUES
(1, 1, 'IT Departmentttt', '2026-04-23 08:33:32', '2026-04-23 08:41:35'),
(2, 1, 'Accounting Department', '2026-04-23 08:46:07', '2026-04-23 09:22:35'),
(3, 0, 'HR Department', '2026-04-23 08:46:23', '2026-04-23 09:32:48');

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
(23, 1, 'admin', 'test', '2026-04-16 12:04:38', '2026-04-22 11:04:08'),
(24, 1, 'developer', 'test', '2026-04-22 11:04:00', '2026-04-22 11:04:00');

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
(30, 1, 'Jane', 'Doe', 'Janedoe@gmail.com', '23', '', '2026-04-21 12:04:57', '2026-04-22 11:04:45'),
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
-- Indexes for table `settings_department`
--
ALTER TABLE `settings_department`
  ADD PRIMARY KEY (`department_aid`);

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
  MODIFY `employee_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
  MODIFY `memo_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings_department`
--
ALTER TABLE `settings_department`
  MODIFY `department_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings_roles`
--
ALTER TABLE `settings_roles`
  MODIFY `role_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `settings_users`
--
ALTER TABLE `settings_users`
  MODIFY `users_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
