-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 10:34 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `status`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `enablesmart` int(11) NOT NULL,
  `smtp` text NOT NULL,
  `smtp_port` text NOT NULL,
  `smtp_username` text NOT NULL,
  `smtp_password` text NOT NULL,
  `admin_email` text NOT NULL,
  `refresh` int(11) NOT NULL,
  `alert_limit` int(11) NOT NULL,
  `rowcount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `enablesmart`, `smtp`, `smtp_port`, `smtp_username`, `smtp_password`, `admin_email`, `refresh`, `alert_limit`, `rowcount`) VALUES
(1, 0, '10.129.14.10', '25', 'pstatus@compuageindia.com', '123456', 'ithelpdesk@compuageindia.com', 60, 10, 100);

-- --------------------------------------------------------

--
-- Table structure for table `pushover`
--

CREATE TABLE `pushover` (
  `id` int(11) NOT NULL,
  `setToken` text NOT NULL,
  `SetUser` text NOT NULL,
  `SetSound` text NOT NULL,
  `SetPriority` text NOT NULL,
  `SetExpire` text NOT NULL,
  `SetRetry` text NOT NULL,
  `SetCallback` text NOT NULL,
  `SetTimestamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `device` text NOT NULL,
  `type` text NOT NULL,
  `ip` text NOT NULL,
  `info` text NOT NULL,
  `purpose` text NOT NULL,
  `count` int(11) DEFAULT 0,
  `ups` int(11) DEFAULT 0,
  `downs` int(11) DEFAULT 0,
  `state` text DEFAULT NULL,
  `Email_Sent` text DEFAULT NULL,
  `lastup` datetime DEFAULT NULL,
  `lastdown` datetime DEFAULT NULL,
  `lastreset` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `device`, `type`, `ip`, `info`, `purpose`, `count`, `ups`, `downs`, `state`, `Email_Sent`, `lastup`, `lastdown`, `lastreset`) VALUES
(25, 'Outlook', 'Email', '10.129.14.36', 'Server', 'Email', 2644, 2644, 0, 'online', '', '2022-03-09 15:04:00', NULL, NULL),
(26, 'Lotus Server', 'Email', '10.129.14.10', 'Server', 'Email', 2644, 2644, 0, 'online', '', '2022-03-09 15:04:00', NULL, NULL),
(27, 'HP RX2800 Primary', 'SAP HOST Server', '10.129.14.85', 'Server', 'SAP', 2644, 2644, 0, 'online', '', '2022-03-09 15:04:00', NULL, NULL),
(28, 'HP RX2800 Secondary', 'SAP HOST Server', '10.129.14.86', 'Server', 'SAP', 2644, 2631, 0, 'online', '', '2022-03-09 15:04:00', '2022-03-09 00:35:00', NULL),
(29, 'SAP BO PRD 1', 'SAP BO Server', '10.129.14.109\r\n', 'Server', 'SAP', 2650, 2648, 0, 'online', '', '2022-03-09 15:04:00', '2022-03-09 14:49:00', NULL),
(30, 'SAP BO PRD 2', 'SAP BO Server', '10.129.14.117', 'Server', 'SAP', 2650, 2649, 0, 'online', '', '2022-03-09 15:04:00', '2022-03-07 19:41:00', NULL),
(31, 'HRMS', 'HRMS', '10.129.14.11', 'Server', 'HRMS', 2650, 2645, 0, 'online', '', '2022-03-09 15:04:00', '2022-03-08 06:20:00', NULL),
(32, 'Service APP', 'Service', '10.129.14.39', 'Server', 'Service', 2650, 2650, 0, 'online', '', '2022-03-09 15:04:00', NULL, NULL),
(33, 'SAP ECC PRD', 'SAP APP', '10.129.14.90', 'Server', 'SAP', 1382, 1381, 0, 'online', '', '2022-03-09 15:04:00', '2022-03-09 13:08:00', '0000-00-00 00:00:00'),
(34, 'SAP BI PRD', 'SAP APP', '10.129.14.96', 'Server', 'SAP', 1382, 1382, 0, 'online', '', '2022-03-09 15:04:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'SAP ECC PRD APP1', 'SAP APP', '10.129.14.92', 'Server', 'SAP', 1382, 1382, 0, 'online', '', '2022-03-09 15:04:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'SAP ECC PRD APP2', 'SAP APP', '10.129.14.102', 'Server', 'SAP', 1382, 1380, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 12:00:01', '0000-00-00 00:00:00'),
(37, 'SAP BI PRD APP2', 'SAP APP', '10.129.14.106', 'Server', 'SAP', 1382, 1378, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 10:54:01', '0000-00-00 00:00:00'),
(40, 'Core Data SW', 'Switch', '172.16.2.253', 'Network', 'Network', 1333, 1329, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 08:10:01', '0000-00-00 00:00:00'),
(41, 'Data SW1', 'Switch', '172.16.2.1', 'Network', 'Network', 1333, 1332, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 14:04:01', '0000-00-00 00:00:00'),
(42, 'Data SW2', 'Switch', '172.16.2.2', 'Network', 'Network', 1333, 1333, 0, 'online', '', '2022-03-09 15:04:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'Data SW3', 'Switch', '172.16.2.3', 'Network', 'Network', 1333, 1333, 0, 'online', '', '2022-03-09 15:04:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Data SW4', 'Switch', '172.16.2.4', 'Network', 'Network', 1333, 1333, 0, 'online', '', '2022-03-09 15:04:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Data SW5', 'Switch', '172.16.2.5', 'Network', 'Network', 1333, 1333, 0, 'online', '', '2022-03-09 15:04:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Data SW6', 'Switch', '172.16.2.6', 'Network', 'Network', 1333, 1332, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-08 22:59:01', '0000-00-00 00:00:00'),
(47, 'Data SW7', 'Switch', '172.16.2.7', 'Network', 'Network', 1333, 1320, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 13:43:01', '0000-00-00 00:00:00'),
(48, 'Data SW8', 'Switch', '172.16.2.8', 'Network', 'Network', 1333, 1303, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 11:11:01', '0000-00-00 00:00:00'),
(49, 'Data SW9', 'Switch', '172.16.2.9', 'Network', 'Network', 1333, 1326, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 08:09:01', '0000-00-00 00:00:00'),
(50, 'Cisco Meeting Place', 'Server', '172.16.1.6', 'Server', 'Server', 1333, 1333, 0, 'online', '', '2022-03-09 15:04:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Cisco Meeting Server', 'Server', '10.129.14.125', 'Server', 'Server', 1333, 1332, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 14:09:01', '0000-00-00 00:00:00'),
(52, 'Cisco Call Manager 1', 'Server', '172.16.1.12', 'Server', 'Server', 1333, 1332, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 01:04:02', '0000-00-00 00:00:00'),
(53, 'Cisco Call Manager 2', 'Server', '172.16.1.14', 'Server', 'Server', 1333, 1333, 0, 'online', '', '2022-03-09 15:04:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Voice Gateway', 'Switch', '172.16.1.2', 'Network', 'Network', 1333, 1332, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-08 23:15:02', '0000-00-00 00:00:00'),
(55, 'Voice Core Switch', 'Switch', '172.16.2.254', 'Network', 'Network', 1333, 1326, 0, 'online', '', '2022-03-09 15:04:01', '2022-03-09 12:03:02', '0000-00-00 00:00:00'),
(56, 'Voice Stack Switch 1', 'Switch', '172.16.1.7', 'Network', 'Network', 1333, 1318, 0, 'online', '', '2022-03-09 15:04:02', '2022-03-09 12:00:02', '0000-00-00 00:00:00'),
(57, 'Voice Stack Switch 2', 'Switch', '172.16.1.8', 'Network', 'Network', 1333, 1326, 0, 'online', '', '2022-03-09 15:04:02', '2022-03-09 09:15:02', '0000-00-00 00:00:00'),
(58, 'Voice Switch', 'Switch', '172.16.1.9', 'Network', 'Network', 1332, 1328, 0, 'online', '', '2022-03-09 15:04:02', '2022-03-09 04:16:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `port` int(11) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `port`, `parent`) VALUES
(25, 'SMTPS', 465, 25),
(26, 'POPS', 995, 25),
(27, 'IMAPS', 993, 25),
(28, 'SMTP', 25, 26),
(29, 'LotusPort', 1352, 26),
(30, 'Outlook HTTPS', 443, 25);

-- --------------------------------------------------------

--
-- Table structure for table `smartdevices`
--

CREATE TABLE `smartdevices` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `count` int(11) DEFAULT NULL,
  `ups` int(11) DEFAULT NULL,
  `downs` int(11) DEFAULT NULL,
  `state` text DEFAULT NULL,
  `lastup` datetime DEFAULT NULL,
  `lastdown` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pushover`
--
ALTER TABLE `pushover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smartdevices`
--
ALTER TABLE `smartdevices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pushover`
--
ALTER TABLE `pushover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `smartdevices`
--
ALTER TABLE `smartdevices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
