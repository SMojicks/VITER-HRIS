-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2026 at 09:15 AM
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
  `employee_start_work_date` datetime NOT NULL,
  `employee_birthday` datetime NOT NULL,
  `employee_department_id` varchar(20) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_supervisor_id` int(11) NOT NULL,
  `employee_supervisor_first_name` varchar(128) NOT NULL,
  `employee_supervisor_last_name` varchar(128) NOT NULL,
  `employee_supervisor_email` varchar(255) NOT NULL,
  `employee_created` datetime NOT NULL,
  `employee_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_aid`, `employee_is_active`, `employee_first_name`, `employee_middle_name`, `employee_last_name`, `employee_start_work_date`, `employee_birthday`, `employee_department_id`, `employee_email`, `employee_supervisor_id`, `employee_supervisor_first_name`, `employee_supervisor_last_name`, `employee_supervisor_email`, `employee_created`, `employee_updated`) VALUES
(48, 0, 'Jhonas', 'test', 'Sotero', '2026-06-06 00:00:00', '2026-06-06 00:00:00', '5', 'jhonas@gmail.com', 0, '', '', '', '2026-05-06 14:12:11', '2026-05-07 15:13:42'),
(49, 1, 'David', 'test', 'Malabanan', '2026-07-06 00:00:00', '2026-08-06 00:00:00', '5', 'david@gmail.com', 0, '', '', '', '2026-05-06 14:12:30', '2026-05-07 15:05:16'),
(51, 1, 'Jeremy', 'test', 'Viterbo', '2026-08-06 00:00:00', '2026-08-06 00:00:00', '5', 'jeremy@gmail.com', 0, '', '', '', '2026-05-06 14:13:08', '2026-05-07 14:05:00'),
(52, 1, 'Khent', 'test', 'Adelino', '2026-04-06 00:00:00', '2026-04-15 00:00:00', '5', 'khent@gmail.com', 54, 'Fae', 'Tubo', 'fae@gmail.com', '2026-05-06 14:14:02', '2026-05-07 15:05:38'),
(53, 1, 'Ratten', 'test', 'Padilla', '2026-03-06 00:00:00', '2026-02-06 00:00:00', '5', 'ratten@gmail.com', 0, '', '', '', '2026-05-06 14:14:17', '2026-05-07 14:56:12'),
(54, 1, 'Fae', 'test', 'Tubo', '2026-03-06 00:00:00', '2026-01-06 00:00:00', '5', 'fae@gmail.com', 0, '', '', '', '2026-05-06 14:14:36', '2026-05-07 14:56:18'),
(55, 1, 'IT test employee', 'test', 'test', '2026-12-06 00:00:00', '2026-12-06 00:00:00', '1', 'test@gmail.com', 0, '', '', '', '2026-05-06 14:14:56', '2026-05-07 14:56:24'),
(56, 1, 'Accounting test employee', 'test', 'test', '2026-08-06 00:00:00', '2026-08-06 00:00:00', '2', 'test@gmail.com', 0, '', '', '', '2026-05-06 14:15:12', '2026-05-07 14:56:28'),
(57, 1, 'HR test employee', 'test', 'test', '2026-12-06 00:00:00', '2026-02-06 00:00:00', '3', 'test@gmail.com', 0, '', '', '', '2026-05-06 14:15:27', '2026-05-07 14:56:38'),
(62, 1, 'Kristeen', 'test', 'Arocena', '2026-05-06 00:00:00', '2026-12-06 00:00:00', '5', 'kristeen@gmail.com', 0, '', '', '', '2026-05-06 14:30:12', '2026-05-07 14:56:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
