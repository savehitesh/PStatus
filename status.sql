-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2022 at 01:48 PM
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
(1, 1, '10.129.14.10', '25', '', '', 'hitesh.save@compuageindia.com', 5, 2, 5);

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
(25, 'Test', 'Email', '10.129.14.36', '', 'Email', 7, 6, 0, 'online', '', '2022-03-04 13:46:29', '2022-03-04 13:42:42', '2022-03-04 13:38:55');

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
(25, 'SMTP', 466, 25);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `smartdevices`
--
ALTER TABLE `smartdevices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
