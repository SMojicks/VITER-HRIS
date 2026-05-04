-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2026 at 09:41 AM
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
(5, 1, 'FBS Management', 'Employees', '2026-04-22', 'Notice', 'Memo No. 0825, Series 2025\nTO: ALL EMPLOYEES\nRE: LAUNCH OF CLIENT REFERRAL INCENTIVE PROGRAM\n\nTo further grow our client base and expand the reach of our service offerings, we are pleased to launch the Client\nReferral Incentive Program. This program provides monetary incentives to employees, partners, or external\ncontacts who successfully refer a local client that closes a deal with Frontline Business Solutions in any of the\nfollowing services:\n1. Website Development\n2. Web Applications Subscriptions\n3. Customized Web App Development\n4. Web and Graphic Design\n5. Business Registration\n6. Bookkeeping & Business Compliance\n\nPlease note that this incentive applies to all employees, except those whose primary role or job function is to\nacquire clients (e.g, sales, marketing, or business development roles).\n\nThe incentive amount will depend on the size and scope of the closed deal and may range from ₱500 to ₱1,000, as\ndetermined by the management, marketing team, and project lead.\n\nThank you for your continued support in helping us expand our network and client base.', '2026-04-24 07:15:20', '2026-04-24 07:29:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`memo_aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
  MODIFY `memo_aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
