-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 11:55 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `tr_booking_status`
--

CREATE TABLE `tr_booking_status` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL DEFAULT '0',
  `full_name` varchar(500) NOT NULL,
  `contact_no` varchar(100) NOT NULL,
  `booking_from_date` date NOT NULL,
  `booking_from_time` time NOT NULL,
  `bookin_time_stamp` bigint(17) NOT NULL,
  `booking_to_date` date NOT NULL,
  `booking_to_time` time NOT NULL,
  `booking_to_time_stamp` bigint(17) NOT NULL DEFAULT '0',
  `currentmill` bigint(17) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_booking_status`
--

INSERT INTO `tr_booking_status` (`id`, `coach_id`, `full_name`, `contact_no`, `booking_from_date`, `booking_from_time`, `bookin_time_stamp`, `booking_to_date`, `booking_to_time`, `booking_to_time_stamp`, `currentmill`) VALUES
(1, 4, 'Prathmesh Karekar', '', '2021-06-18', '07:00:00', 1623979800000, '2021-06-18', '08:00:00', 1623983400000, 1624029534918),
(3, 4, 'Sunny Tailor', '', '2021-06-18', '08:00:00', 1623983400000, '2021-06-18', '08:57:00', 1623986820000, 1624029753144),
(4, 4, 'Rishi Tailor', '', '2021-06-18', '09:00:00', 1623987000000, '2021-06-18', '10:00:00', 1623990600000, 1624030860854),
(5, 18, 'pappapa', '', '2021-06-19', '15:00:00', 1624095000000, '2021-06-19', '16:00:00', 1624098600000, 1624096283998);

-- --------------------------------------------------------

--
-- Table structure for table `tr_report`
--

CREATE TABLE `tr_report` (
  `id` int(11) NOT NULL,
  `coach_name` varchar(500) DEFAULT NULL,
  `timezone` varchar(500) DEFAULT NULL,
  `day_of_week` varchar(500) DEFAULT NULL,
  `available_at_from_time` time NOT NULL,
  `available_at_to_time` time NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_report`
--

INSERT INTO `tr_report` (`id`, `coach_name`, `timezone`, `day_of_week`, `available_at_from_time`, `available_at_to_time`, `booking_status`) VALUES
(1, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Monday', '09:00:00', '17:30:00', 0),
(2, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Tuesday', '08:00:00', '16:00:00', 0),
(3, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Thursday', '09:00:00', '16:00:00', 0),
(4, 'John Doe', '(GMT-06:00) America/North_Dakota/New_Salem', 'Friday', '07:00:00', '14:00:00', 1),
(5, 'John Doe', '(GMT-06:00) Central Time (US & Canada)', 'Tuesday', '08:00:00', '10:00:00', 0),
(6, 'John Doe', '(GMT-06:00) Central Time (US & Canada)', 'Wednesday', '11:00:00', '18:00:00', 0),
(7, 'John Doe', '(GMT-06:00) Central Time (US & Canada)', 'Saturday', '09:00:00', '15:00:00', 0),
(8, 'John Doe', '(GMT-06:00) Central Time (US & Canada)', 'Sunday', '08:00:00', '15:00:00', 0),
(9, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Monday', '08:00:00', '10:00:00', 0),
(10, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Tuesday', '11:00:00', '13:00:00', 0),
(11, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Wednesday', '08:00:00', '10:00:00', 0),
(12, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Saturday', '08:00:00', '11:00:00', 0),
(13, 'Rachel Green', '(GMT-09:00) America/Yakutat', 'Sunday', '07:00:00', '09:00:00', 0),
(14, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Monday', '09:00:00', '15:00:00', 0),
(15, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Tuesday', '06:00:00', '13:00:00', 0),
(16, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Wednesday', '06:00:00', '11:00:00', 0),
(17, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Friday', '08:00:00', '12:00:00', 0),
(18, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Saturday', '15:00:00', '16:00:00', 1),
(19, 'Margaret Houlihan', '(GMT-06:00) Central Time (US & Canada)', 'Sunday', '08:00:00', '10:00:00', 0),
(20, 'Hawkeye Pierce', '(GMT-06:00) Central Time (US & Canada)', 'Thursday', '07:00:00', '14:00:00', 0),
(21, 'Hawkeye Pierce', '(GMT-06:00) Central Time (US & Canada)', 'Thursday', '15:00:00', '17:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tr_booking_status`
--
ALTER TABLE `tr_booking_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_report`
--
ALTER TABLE `tr_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tr_booking_status`
--
ALTER TABLE `tr_booking_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tr_report`
--
ALTER TABLE `tr_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
