-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2024 at 12:03 AM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u684904720_ovendb`
--

-- --------------------------------------------------------

--
-- Table structure for table `inv_settings`
--

CREATE TABLE `inv_settings` (
  `id` int(11) NOT NULL,
  `set_title` varchar(500) NOT NULL,
  `set_logo_small` varchar(500) NOT NULL,
  `set_logo_large` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inv_settings`
--

INSERT INTO `inv_settings` (`id`, `set_title`, `set_logo_small`, `set_logo_large`) VALUES
(1, 'PTC App', 'logo2.png', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `oven_log_tbl`
--

CREATE TABLE `oven_log_tbl` (
  `id` int(11) NOT NULL,
  `oven_id` int(11) NOT NULL,
  `oven_date` varchar(500) NOT NULL,
  `oven_temp` varchar(500) NOT NULL DEFAULT '0',
  `oven_humi` varchar(500) NOT NULL,
  `oven_current` varchar(500) NOT NULL DEFAULT '0',
  `oven_kwh` varchar(500) NOT NULL DEFAULT '0',
  `oven_name` varchar(500) NOT NULL,
  `oven_operator` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oven_log_tbl`
--

INSERT INTO `oven_log_tbl` (`id`, `oven_id`, `oven_date`, `oven_temp`, `oven_humi`, `oven_current`, `oven_kwh`, `oven_name`, `oven_operator`) VALUES
(2, 1, '2023-11-20 09:35:54', 'nan', 'nan', '0.00', '0', 'testasd', 'asd'),
(3, 1, '2023-11-20 09:36:03', 'nan', 'nan', '0.00', '0', 'testasd', 'asd'),
(4, 1, '2023-11-20 09:36:14', 'nan', 'nan', '0.00', '0', 'testasd', 'asd'),
(5, 1, '2023-11-20 09:36:24', 'nan', 'nan', '0.00', '0', 'testasd', 'asd'),
(6, 1, '2023-11-20 09:36:34', 'nan', 'nan', '0.00', '0', 'testasd', 'asd'),
(7, 1, '2023-11-20 09:36:45', 'nan', 'nan', '0.00', '0', 'testasd', 'asd'),
(8, 1, '2023-11-20 10:19:41', '35.90', '52.00', '0.01', '0.0528', 'testasd', 'asd'),
(9, 1, '2023-11-20 10:19:50', '35.90', '52.00', '0.01', '0.0528', 'testasd', 'asd'),
(10, 1, '2023-11-20 10:22:29', '36.40', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(11, 1, '2023-11-20 10:22:39', '36.40', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(12, 1, '2023-11-20 10:22:48', '36.40', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(13, 1, '2023-11-20 10:22:57', '36.30', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(14, 1, '2023-11-20 10:23:06', '36.30', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(15, 1, '2023-11-20 10:23:15', '36.30', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(16, 1, '2023-11-20 10:23:24', '36.30', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(17, 1, '2023-11-20 10:23:32', '36.20', '50.00', '0.01', '0.0528', 'testasd', 'asd'),
(18, 1, '2023-12-23 11:56:31', '30.60', '71.00', '117.50', '620.4', 'testasd', 'asd'),
(19, 1, '2023-12-23 11:56:39', '30.50', '71.00', '120.34', '635.3952', 'testasd', 'asd'),
(20, 1, '2023-12-23 11:56:44', '30.50', '71.00', '120.62', '636.8736', 'testasd', 'asd'),
(21, 1, '2023-12-23 11:56:49', '30.50', '71.00', '119.41', '630.4848', 'testasd', 'asd'),
(22, 1, '2023-12-23 11:56:54', '30.50', '71.00', '120.35', '635.448', 'testasd', 'asd'),
(23, 1, '2023-12-23 11:56:59', '30.50', '70.00', '118.33', '624.7824', 'testasd', 'asd'),
(24, 1, '2023-12-23 11:57:03', '30.50', '70.00', '117.69', '621.4032', 'testasd', 'asd'),
(25, 1, '2023-12-23 11:57:08', '30.60', '70.00', '119.24', '629.5872', 'testasd', 'asd'),
(26, 1, '2023-12-23 11:57:14', '30.70', '70.00', '117.36', '619.6608', 'testasd', 'asd'),
(27, 1, '2023-12-23 11:57:18', '30.70', '70.00', '118.94', '628.0032', 'testasd', 'asd'),
(28, 1, '2023-12-23 11:57:24', '30.80', '69.00', '118.51', '625.7328', 'testasd', 'asd'),
(29, 1, '2023-12-23 11:57:32', '30.80', '69.00', '119.07', '628.6896', 'testasd', 'asd'),
(30, 1, '2023-12-23 11:57:38', '30.90', '69.00', '119.30', '629.904', 'testasd', 'asd'),
(31, 1, '2024-01-03 14:55:00', '29.50', '79.00', '0.00', '0', 'Tawilis', 'Tawi'),
(32, 1, '2024-01-03 15:55:09', '55.80', '31.00', '124.88', '659.3664', 'Sapsap', 'Sapsap'),
(33, 1, '2024-01-03 16:55:11', '63.30', '1.00', '124.64', '658.0992', 'Sapsap', 'Sapsap'),
(34, 1, '2024-01-03 17:55:17', '63.10', '0.00', '125.87', '664.5936', 'Sapsap', 'Sapsap'),
(35, 1, '2024-01-29 14:46:49', '27.90', '53.00', '0.00', '0', 'Sapsap', 'Sapsap'),
(36, 1, '2024-01-29 15:54:39', '35.50', '30.00', '0.00', '0', 'Sapsap', 'Sapsap');

-- --------------------------------------------------------

--
-- Table structure for table `oven_tbl`
--

CREATE TABLE `oven_tbl` (
  `id` int(11) NOT NULL,
  `oven_name` varchar(500) NOT NULL,
  `oven_operator` varchar(500) NOT NULL,
  `oven_timer` int(11) NOT NULL DEFAULT 0,
  `oven_timermain` int(11) NOT NULL DEFAULT 0,
  `oven_stock` varchar(500) NOT NULL DEFAULT '0' COMMENT 'item count',
  `oven_temp` varchar(500) NOT NULL DEFAULT '0',
  `oven_humi` varchar(500) NOT NULL DEFAULT '0',
  `oven_current` varchar(500) NOT NULL DEFAULT '0',
  `oven_kwh` varchar(500) NOT NULL DEFAULT '0',
  `oven_lock` int(11) NOT NULL DEFAULT 0,
  `oven_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 - idle\r\n1 - in use\r\n2 - complete',
  `oven_connected` int(11) NOT NULL DEFAULT 0,
  `oven_lastlog` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oven_tbl`
--

INSERT INTO `oven_tbl` (`id`, `oven_name`, `oven_operator`, `oven_timer`, `oven_timermain`, `oven_stock`, `oven_temp`, `oven_humi`, `oven_current`, `oven_kwh`, `oven_lock`, `oven_status`, `oven_connected`, `oven_lastlog`) VALUES
(1, 'Tawilis', 'Tawilis', 0, 60, '10', '35.50', '30.00', '0.00', '0', 0, 0, 1706519311, 1706514879),
(7, 'Daing', '', 0, 60, '0', '0', '0', '0', '0', 0, 0, 0, 0),
(8, 'Sapsap', 'Sapsap', 0, 0, '0', '0', '0', '0', '0', 0, 0, 0, 0),
(9, 'Salinas', '', 0, 0, '', '0', '0', '0', '0', 0, 0, 0, 0),
(10, 'Hito', 'hito', 0, 60, '0', '0', '0', '0', '0', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `user_date` varchar(500) NOT NULL,
  `user_token` varchar(500) NOT NULL,
  `user_archive` int(11) NOT NULL DEFAULT 0,
  `user_block` int(11) NOT NULL DEFAULT 0,
  `user_uname` varchar(500) NOT NULL,
  `user_pword` varchar(500) NOT NULL,
  `user_pos` int(11) NOT NULL DEFAULT 0,
  `user_fname` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `user_date`, `user_token`, `user_archive`, `user_block`, `user_uname`, `user_pword`, `user_pos`, `user_fname`) VALUES
(1, '', '42AC66CB', 0, 0, 'admin', 'admin', 0, 'ADMINISTRATOR'),
(2, '2023-10-02', '8E17B754', 0, 0, 'operator', 'operator', 1, 'operator'),
(3, '2023-10-11', '', 1, 0, 'operator1', '1234', 1, 'Rence'),
(4, '2023-10-11', '63456F5D', 1, 0, 'Operator200', '1234', 1, 'Rence'),
(5, '2023-10-11', '5DEF8484', 0, 0, 'Serdan', 'Serdan', 1, 'Elijah Serdan'),
(6, '2024-01-29', 'B059890A', 0, 0, 'jhan', 'frior', 1, 'Jhan frior bermudez'),
(7, '2024-01-29', '0550A93B', 0, 0, 'Krizia', 'Krizia', 1, 'Krizia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inv_settings`
--
ALTER TABLE `inv_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oven_log_tbl`
--
ALTER TABLE `oven_log_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oven_tbl`
--
ALTER TABLE `oven_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inv_settings`
--
ALTER TABLE `inv_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oven_log_tbl`
--
ALTER TABLE `oven_log_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `oven_tbl`
--
ALTER TABLE `oven_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
