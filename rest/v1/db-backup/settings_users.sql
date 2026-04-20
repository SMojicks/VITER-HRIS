-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2026 at 09:40 AM
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
(1, 0, 'sb', 'seb', 'seb@gmail', '22', '', '2026-04-20 11:04:57', '2026-04-20 11:04:57'),
(2, 1, 'seb', 'seb', 'seb123@gmail.com', '23', '', '2026-04-20 11:04:06', '2026-04-20 11:04:06'),
(3, 1, 'seb', 'sebbbbbb', 'sebb@yahoo.com', '22', '', '2026-04-20 12:04:50', '2026-04-20 12:04:50'),
(4, 1, 'seb', 'sebbb', 'seb123123123@gmail.com', '23', '', '2026-04-20 13:04:13', '2026-04-20 13:04:13'),
(5, 1, 'seb', 'sen', 'bbbbb@gmail.com', '23', '', '2026-04-20 13:04:11', '2026-04-20 13:04:11'),
(6, 1, 'seb', 'seb', 'seb@888', '22', '', '2026-04-20 14:04:23', '2026-04-20 14:04:23'),
(7, 1, 'mojjk', 'mojicks', 'mojicks@gmailc.om', '22', '', '2026-04-20 15:04:21', '2026-04-20 15:04:21'),
(8, 1, 'mojica', 'mojica', 'mojica@gmail.com', '23', '', '2026-04-20 15:04:40', '2026-04-20 15:04:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings_users`
--
ALTER TABLE `settings_users`
  ADD PRIMARY KEY (`users_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings_users`
--
ALTER TABLE `settings_users`
  MODIFY `users_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
