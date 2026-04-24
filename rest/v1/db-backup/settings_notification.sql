-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2026 at 04:33 AM
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
-- Table structure for table `settings_notification`
--

CREATE TABLE `settings_notification` (
  `notification_aid` int(11) NOT NULL,
  `notification_is_active` tinyint(4) NOT NULL,
  `notification_first_name` varchar(128) NOT NULL,
  `notification_last_name` varchar(128) NOT NULL,
  `notification_purpose` varchar(128) NOT NULL,
  `notification_email` varchar(128) NOT NULL,
  `notification_created` datetime NOT NULL,
  `notification_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_notification`
--

INSERT INTO `settings_notification` (`notification_aid`, `notification_is_active`, `notification_first_name`, `notification_last_name`, `notification_purpose`, `notification_email`, `notification_created`, `notification_updated`) VALUES
(4, 1, 'Seb', 'Mojica', 'Leave', 'seb@gmail.com', '2026-04-24 10:04:11', '2026-04-24 10:04:17'),
(5, 1, 'Jhonas', 'Sotero', 'Overtime', 'sotero@gmail.com', '2026-04-24 10:04:53', '2026-04-24 10:04:53'),
(6, 1, 'David', 'Malabanan123', 'Overtime', 'Malabanan@gmail.com', '2026-04-24 10:04:07', '2026-04-24 10:04:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings_notification`
--
ALTER TABLE `settings_notification`
  ADD PRIMARY KEY (`notification_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings_notification`
--
ALTER TABLE `settings_notification`
  MODIFY `notification_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
