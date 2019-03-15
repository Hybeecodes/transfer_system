-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2019 at 12:33 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transfer_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_id`, `firstname`, `lastname`, `email`, `password`, `created_at`) VALUES
(1, 'admin1yet5', 'obikoya', 'ibiniyi', 'obikoya11@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2018-11-15 15:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_id`, `name`, `created_at`) VALUES
(1, 'faculty_id5bfa97d25b16c', 'Science', '2018-11-25 13:38:42'),
(2, 'faculty_id5c24f792f1e06', 'Technology', '2018-12-27 17:02:27'),
(3, 'faculty_id5c277c1c13fcc', 'The Social Sciences', '2018-12-29 14:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `location_id`, `faculty_id`, `created_at`) VALUES
(1, 'Computer Science', 'location5bfadc0ee899d', 'faculty_id5bfa97d25b16c', '2018-11-25 18:29:50'),
(2, 'Chemistry', 'location5c0395f087659', 'faculty_id5bfa97d25b16c', '2018-12-02 09:21:04'),
(3, 'Mathematics', 'location5c039601530a3', 'faculty_id5bfa97d25b16c', '2018-12-02 09:21:21'),
(4, 'Statistics', 'location5c03961217647', 'faculty_id5bfa97d25b16c', '2018-12-02 09:21:38'),
(5, 'Mechanical Engineering', 'location5c25a22d591b2', 'faculty_id5c24f792f1e06', '2018-12-28 05:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `location_positions`
--

CREATE TABLE `location_positions` (
  `id` int(11) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_positions`
--

INSERT INTO `location_positions` (`id`, `position_id`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 'pos5c172bc2e875f', 'location5c25a22d591b2', '2018-12-28 05:10:21', '2018-12-28 05:10:21'),
(2, 'pos5c24762aa782b', 'location5c25a22d591b2', '2018-12-28 05:10:21', '2018-12-28 05:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_id`, `name`, `created_at`) VALUES
(1, 'pos5c172bc2e875f', 'Lab Assistant', '2018-12-17 05:53:22'),
(2, 'pos5c24762aa782b', 'Lab Assistant II', '2018-12-27 07:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `transfer_interval` smallint(6) DEFAULT '0' COMMENT 'Transfer Interval'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `transfer_interval`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `year_of_employment` smallint(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `last_transfer_date` date NOT NULL COMMENT 'date of recent transfer date',
  `year_of_retirement` smallint(6) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `firstname`, `lastname`, `email`, `phone`, `year_of_employment`, `date_of_birth`, `qualification`, `last_transfer_date`, `year_of_retirement`, `age`, `gender`, `faculty_id`, `location_id`, `position_id`, `created_at`, `updated_at`) VALUES
(1, 'staff5bf3ffce2b05f', 'Obikoya ', 'Ibiniyi', 'obikoya11@gmail.com', '09032559681', 1970, '1952-09-04', 'PhD', '2019-03-13', 2020, 66, 'Male', '', 'location5c0395f087659', 'pos5c172bc2e875f', '2018-11-20 12:36:30', '2018-11-20 12:36:30'),
(2, 'staff5c0b65b0f2c9b', 'Onwughara ', 'Ndubuagha', 'obikoya11@gmail.com', '09032559622', 1995, '2014-02-05', 'HnD,PhD,', '2019-03-13', 2030, 4, 'Female', '', 'location5c039601530a3', '', '2018-12-08 06:33:20', '2018-12-08 06:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `staff_transfer_history`
--

CREATE TABLE `staff_transfer_history` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_transfer_history`
--

INSERT INTO `staff_transfer_history` (`id`, `staff_id`, `faculty_id`, `location_id`, `created_at`) VALUES
(1, 'staff5bf3ffce2b05f', '', 'location5c039601530a3', '2019-01-04 10:46:01'),
(2, 'staff5bf3ffce2b05f', '', 'Array', '2019-01-04 10:46:40'),
(3, 'staff5bf3ffce2b05f', '', 'location5c25a22d591b2', '2019-01-04 10:47:08'),
(4, 'staff5bf3ffce2b05f', '', 'location5c039601530a3', '2019-01-04 10:51:46'),
(5, 'staff5bf3ffce2b05f', '', 'location5bfadc0ee899d', '2019-01-04 10:52:11'),
(6, 'staff5bf3ffce2b05f', '', 'location5c0395f087659', '2019-01-04 10:52:34'),
(7, 'staff5bf3ffce2b05f', '', 'location5c25a22d591b2', '2019-01-04 10:52:39'),
(8, 'staff5bf3ffce2b05f', '', 'location5c0395f087659', '2019-01-04 10:52:44'),
(9, 'staff5bf3ffce2b05f', '', 'location5c039601530a3', '2019-02-05 20:19:37'),
(10, 'staff5bf3ffce2b05f', '', 'location5c0395f087659', '2019-02-11 14:27:47'),
(11, 'staff5bf3ffce2b05f', '', 'location5c25a22d591b2', '2019-02-11 14:27:53'),
(12, 'staff5bf3ffce2b05f', '', 'location5c0395f087659', '2019-02-11 14:27:57'),
(13, 'staff5bf3ffce2b05f', '', '', '2019-02-11 14:28:02'),
(14, 'staff5bf3ffce2b05f', '', 'location5c0395f087659', '2019-02-11 14:28:06'),
(15, 'staff5bf3ffce2b05f', '', 'location5c039601530a3', '2019-02-17 14:38:12'),
(16, 'staff5bf3ffce2b05f', '', 'location5bfadc0ee899d', '2019-02-17 14:42:46'),
(17, 'staff5bf3ffce2b05f', '', 'location5c0395f087659', '2019-03-04 10:33:09'),
(18, 'staff5c0b65b0f2c9b', '', 'location5c039601530a3', '2019-03-04 10:33:09'),
(19, 'staff5bf3ffce2b05f', '', 'location5c039601530a3', '2019-03-13 11:05:08'),
(20, 'staff5c0b65b0f2c9b', '', 'location5bfadc0ee899d', '2019-03-13 11:05:08'),
(21, 'staff5bf3ffce2b05f', '', 'location5bfadc0ee899d', '2019-03-13 11:06:13'),
(22, 'staff5c0b65b0f2c9b', '', 'location5c03961217647', '2019-03-13 11:06:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_positions`
--
ALTER TABLE `location_positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_transfer_history`
--
ALTER TABLE `staff_transfer_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location_positions`
--
ALTER TABLE `location_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_transfer_history`
--
ALTER TABLE `staff_transfer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
