-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 09:06 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
  `level_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_id`, `name`, `level_id`, `created_at`) VALUES
(1, 'faculty_id5c8e1dda3e1bc', 'Science', 'level5c8e198124d11', '2019-03-17 11:13:46'),
(2, 'faculty_id5c8e1f0c7bcfa', 'Social Sciences', 'level5c8e198124d11', '2019-03-17 11:18:52');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `feedback_id` varchar(255) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level_id`, `name`, `created_at`) VALUES
(1, 'level5c8e196811b6b', 'Level 1', '2019-03-17 10:54:48'),
(2, 'level5c8e198124d11', 'Level 2', '2019-03-17 10:55:13'),
(4, 'level5c8e1a269f10c', 'Level 3', '2019-03-17 10:57:58'),
(5, 'level5c8e1a535e01a', 'Level 4', '2019-03-17 10:58:43'),
(6, 'level5c8e1aa185316', 'Level 5', '2019-03-17 11:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `level_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_id`, `name`, `faculty_id`, `level_id`, `created_at`) VALUES
(1, 'location5c8e5a4c16bef', 'Archaeology', 'faculty_id5c8e1dda3e1bc', 'level5c8e198124d11', '2019-03-17 15:31:40'),
(2, 'location5c8e612d8c460', 'Botany', 'faculty_id5c8e1dda3e1bc', 'level5c8e198124d11', '2019-03-17 16:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `location_positions`
--

CREATE TABLE `location_positions` (
  `id` int(11) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_positions`
--

INSERT INTO `location_positions` (`id`, `location_id`, `position_id`, `created_at`) VALUES
(1, 'location5c8e5a4c16bef', 'pos5c8e555bcd8ad', '2019-03-17 15:31:40'),
(2, 'location5c8e5a4c16bef', 'pos5c8e58a5df456', '2019-03-17 15:31:40'),
(3, 'location5c8e5a4c16bef', 'pos5c8e58b8616da', '2019-03-17 15:31:40'),
(4, 'location5c8e5a4c16bef', 'pos5c8e58c3e1c12', '2019-03-17 15:31:40'),
(5, 'location5c8e5a4c16bef', 'pos5c8e59240579f', '2019-03-17 15:31:40'),
(6, 'location5c8e5a4c16bef', 'pos5c8e59331b889', '2019-03-17 15:31:40'),
(7, 'location5c8e5a4c16bef', 'pos5c8e59401d6dd', '2019-03-17 15:31:40'),
(8, 'location5c8e5a4c16bef', 'pos5c8e5948ea901', '2019-03-17 15:31:40'),
(9, 'location5c8e612d8c460', 'pos5c8e1c26c4d63', '2019-03-17 16:01:01'),
(10, 'location5c8e612d8c460', 'pos5c8e55512d5f7', '2019-03-17 16:01:01'),
(11, 'location5c8e612d8c460', 'pos5c8e569a7cdfb', '2019-03-17 16:01:01'),
(12, 'location5c8e612d8c460', 'pos5c8e58a5df456', '2019-03-17 16:01:01'),
(13, 'location5c8e612d8c460', 'pos5c8e5b984a79f', '2019-03-17 16:01:01'),
(14, 'location5c8e612d8c460', 'pos5c8e5baa2e75a', '2019-03-17 16:01:02'),
(15, 'location5c8e612d8c460', 'pos5c8e5be4a646f', '2019-03-17 16:01:02'),
(16, 'location5c8e612d8c460', 'pos5c8e5c029d76e', '2019-03-17 16:01:02'),
(17, 'location5c8e612d8c460', 'pos5c8e5c377c867', '2019-03-17 16:01:02'),
(18, 'location5c8e612d8c460', 'pos5c8e5c4a0e05e', '2019-03-17 16:01:02'),
(19, 'location5c8e612d8c460', 'pos5c8e5c55a568c', '2019-03-17 16:01:02');

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
(1, 'pos5c8e1c26c4d63', 'Laboratory Assistant I', '2019-03-17 11:06:30'),
(2, 'pos5c8e550da6bfc', 'Assistant Supervisor', '2019-03-17 15:09:17'),
(3, 'pos5c8e55512d5f7', 'Clerical Officer', '2019-03-17 15:10:25'),
(4, 'pos5c8e555bcd8ad', 'Driver Mechanic', '2019-03-17 15:10:35'),
(5, 'pos5c8e556b1c9bb', 'Executive Officer', '2019-03-17 15:10:51'),
(6, 'pos5c8e55886ff68', 'Office Assistant', '2019-03-17 15:11:20'),
(7, 'pos5c8e559460f88', 'Admin Officer', '2019-03-17 15:11:32'),
(8, 'pos5c8e55a60f738', 'Chief Clerical Officer', '2019-03-17 15:11:50'),
(9, 'pos5c8e55b854b21', 'Senior Trans Supervisor', '2019-03-17 15:12:08'),
(10, 'pos5c8e55c31a78f', 'Personal Secretary', '2019-03-17 15:12:19'),
(11, 'pos5c8e55d2e9985', 'Assistant Operations Manager', '2019-03-17 15:12:34'),
(12, 'pos5c8e55e6cd7c1', 'Senior Personal Secretary', '2019-03-17 15:12:54'),
(13, 'pos5c8e55ed2c55e', 'Messenger', '2019-03-17 15:13:01'),
(14, 'pos5c8e56085f728', 'Chief Secretary Assistant', '2019-03-17 15:13:28'),
(15, 'pos5c8e5616ba43c', 'Chief Computer Operator', '2019-03-17 15:13:42'),
(16, 'pos5c8e569a7cdfb', 'Computer Operator', '2019-03-17 15:15:54'),
(17, 'pos5c8e56a582c6a', 'Technologist I', '2019-03-17 15:16:05'),
(18, 'pos5c8e56b2ac586', 'Technologist II', '2019-03-17 15:16:18'),
(19, 'pos5c8e58a5df456', 'Assistant Executive Officer', '2019-03-17 15:24:37'),
(20, 'pos5c8e58b8616da', 'Supervisor', '2019-03-17 15:24:56'),
(21, 'pos5c8e58c3e1c12', 'Senior Photo Assistant', '2019-03-17 15:25:07'),
(22, 'pos5c8e59240579f', 'Assistant Technologist', '2019-03-17 15:26:44'),
(23, 'pos5c8e59331b889', 'Photographer', '2019-03-17 15:26:59'),
(24, 'pos5c8e59401d6dd', 'Senior Tech Officer', '2019-03-17 15:27:12'),
(25, 'pos5c8e5948ea901', 'Museum Officer', '2019-03-17 15:27:20'),
(26, 'pos5c8e59565d5ad', 'Chief Technologist', '2019-03-17 15:27:34'),
(27, 'pos5c8e5b984a79f', 'Foreman Gardener', '2019-03-17 15:37:12'),
(28, 'pos5c8e5baa2e75a', 'Office Assistant II', '2019-03-17 15:37:30'),
(29, 'pos5c8e5be4a646f', 'Laboratory Assistant', '2019-03-17 15:38:28'),
(30, 'pos5c8e5c029d76e', 'Store Keeper', '2019-03-17 15:38:58'),
(31, 'pos5c8e5c25ae7d7', 'Principal Lab Asst', '2019-03-17 15:39:33'),
(32, 'pos5c8e5c377c867', 'Field Assistant I', '2019-03-17 15:39:51'),
(33, 'pos5c8e5c4a0e05e', 'Supervisor Messenger', '2019-03-17 15:40:10'),
(34, 'pos5c8e5c55a568c', 'Secretary I', '2019-03-17 15:40:21'),
(35, 'pos5c8e5c6f7e493', 'Senior Lab Supervisor', '2019-03-17 15:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `request_id` varchar(255) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `last_transfer_date` date NOT NULL,
  `is_movable` tinyint(4) NOT NULL DEFAULT '1',
  `gender` enum('male','female') NOT NULL,
  `level_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_history`
--

CREATE TABLE `transfer_history` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `position_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
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
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_history`
--
ALTER TABLE `transfer_history`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `location_positions`
--
ALTER TABLE `location_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_history`
--
ALTER TABLE `transfer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
