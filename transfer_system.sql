-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2019 at 09:38 PM
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
  `level_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_id`, `name`, `level_id`, `created_at`) VALUES
(1, 'faculty_id5c8e1dda3e1bc', 'Science', 'level5c8e198124d11', '2019-03-17 11:13:46'),
(2, 'faculty_id5c8e1f0c7bcfa', 'Social Sciences', 'level5c8e198124d11', '2019-03-17 11:18:52'),
(3, 'faculty_id5ca2864ce5849', 'Arts', 'level5c8e198124d11', '2019-04-01 22:44:45'),
(4, 'faculty_id5ca286571ab4b', 'Law', 'level5c8e198124d11', '2019-04-01 22:44:55'),
(5, 'faculty_id5ca28662002b7', 'Pharmacy', 'level5c8e198124d11', '2019-04-01 22:45:06'),
(6, 'faculty_id5ca28671f2b23', 'Technology', 'level5c8e198124d11', '2019-04-01 22:45:21'),
(7, 'faculty_id5ca2867fb53e5', 'Education', 'level5c8e198124d11', '2019-04-01 22:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `feedback_id` varchar(255) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `supervisor_name` varchar(255) NOT NULL,
  `location_id` varchar(255) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `feedback_id`, `supervisor_id`, `supervisor_name`, `location_id`, `staff_id`, `title`, `details`, `created_at`) VALUES
(3, 'feedback5ca3038e5443b', 'superv5c922a988a31a', ' Akinola Solomon', 'location5c8e612d8c460', 'staffs5c92a4e1813cc', 'Incompetence', 'The Above staff has shown high level of incompetence during his time here. I request that he is transferred away from here as soon as possible. Thank You', '2019-04-02 07:39:10'),
(4, 'feedback5ca3055f7219f', 'superv5c922a988a31a', 'Akinola Solomon', 'location5c8e612d8c460', 'staffs5ca2fb09852c8', 'Transfer Request', 'The concerned Staff has been very incompetence during his stay here. I request that he is transferred away from this department. Thank You.', '2019-04-02 07:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hierachy` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level_id`, `name`, `hierachy`, `created_at`) VALUES
(1, 'level5c8e196811b6b', 'Level 1', 1, '2019-03-17 10:54:48'),
(2, 'level5c8e198124d11', 'Level 2', 2, '2019-03-17 10:55:13'),
(4, 'level5c8e1a269f10c', 'Level 3', 3, '2019-03-17 10:57:58');

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
(2, 'location5c8e612d8c460', 'Botany', 'faculty_id5c8e1dda3e1bc', 'level5c8e198124d11', '2019-03-17 16:01:01'),
(3, 'location5ca2f16560da3', 'Chemistry', 'faculty_id5c8e1dda3e1bc', 'level5c8e198124d11', '2019-04-02 06:21:41'),
(4, 'location5ca2f1ba20d3a', 'Computer Science', 'faculty_id5c8e1dda3e1bc', 'level5c8e198124d11', '2019-04-02 06:23:06'),
(5, 'location5ca2f2e3185e3', 'Deans Office', 'faculty_id5c8e1dda3e1bc', 'level5c8e196811b6b', '2019-04-02 06:28:03'),
(6, 'location5ca3117a78ad7', 'CENTER FOR URBAN AND RURAL', 'faculty_id5c8e1f0c7bcfa', 'level5c8e198124d11', '2019-04-02 08:38:34'),
(7, 'location5ca311babc6c1', 'FINANCE LAW ARTS AND SOC', 'faculty_id5c8e1f0c7bcfa', 'level5c8e198124d11', '2019-04-02 08:39:38'),
(8, 'location5ca311dadd126', 'Geography', 'faculty_id5c8e1f0c7bcfa', 'level5c8e198124d11', '2019-04-02 08:40:10'),
(9, 'location5ca311f909085', 'Political Science', 'faculty_id5c8e1f0c7bcfa', 'level5c8e198124d11', '2019-04-02 08:40:41'),
(10, 'location5ca3121332ce0', 'PSYCHOLOGY', 'faculty_id5c8e1f0c7bcfa', 'level5c8e198124d11', '2019-04-02 08:41:07'),
(11, 'location5ca3123a59d76', 'ARABIC AND ISLAMIC', 'faculty_id5ca2864ce5849', 'level5c8e198124d11', '2019-04-02 08:41:46'),
(12, 'location5ca3125f467ad', 'Classics', 'faculty_id5ca2864ce5849', 'level5c8e198124d11', '2019-04-02 08:42:23'),
(13, 'location5ca3129dcfead', 'DEANS OFFICE ARTS', 'faculty_id5ca2864ce5849', 'level5c8e196811b6b', '2019-04-02 08:43:25');

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
(19, 'location5c8e612d8c460', 'pos5c8e5c55a568c', '2019-03-17 16:01:02'),
(20, 'location5ca2f16560da3', 'pos5c8e1c26c4d63', '2019-04-02 06:21:41'),
(21, 'location5ca2f16560da3', 'pos5c8e555bcd8ad', '2019-04-02 06:21:41'),
(22, 'location5ca2f16560da3', 'pos5c8e569a7cdfb', '2019-04-02 06:21:41'),
(23, 'location5ca2f16560da3', 'pos5c8e59240579f', '2019-04-02 06:21:41'),
(24, 'location5ca2f16560da3', 'pos5c8e5be4a646f', '2019-04-02 06:21:41'),
(25, 'location5ca2f16560da3', 'pos5c9e3126d3b9b', '2019-04-02 06:21:41'),
(26, 'location5ca2f1ba20d3a', 'pos5c8e1c26c4d63', '2019-04-02 06:23:06'),
(27, 'location5ca2f1ba20d3a', 'pos5c8e550da6bfc', '2019-04-02 06:23:06'),
(28, 'location5ca2f1ba20d3a', 'pos5c8e55512d5f7', '2019-04-02 06:23:06'),
(29, 'location5ca2f1ba20d3a', 'pos5c8e555bcd8ad', '2019-04-02 06:23:06'),
(30, 'location5ca2f1ba20d3a', 'pos5c8e556b1c9bb', '2019-04-02 06:23:06'),
(31, 'location5ca2f1ba20d3a', 'pos5c8e5616ba43c', '2019-04-02 06:23:06'),
(32, 'location5ca2f2e3185e3', 'pos5c8e55512d5f7', '2019-04-02 06:28:03'),
(33, 'location5ca2f2e3185e3', 'pos5c8e55886ff68', '2019-04-02 06:28:03'),
(34, 'location5ca2f2e3185e3', 'pos5c8e559460f88', '2019-04-02 06:28:03'),
(35, 'location5ca2f2e3185e3', 'pos5c8e55a60f738', '2019-04-02 06:28:03'),
(36, 'location5ca2f2e3185e3', 'pos5c8e55b854b21', '2019-04-02 06:28:03'),
(37, 'location5ca2f2e3185e3', 'pos5c8e55c31a78f', '2019-04-02 06:28:03'),
(38, 'location5ca3117a78ad7', 'pos5c8e1c26c4d63', '2019-04-02 08:38:34'),
(39, 'location5ca3117a78ad7', 'pos5c8e550da6bfc', '2019-04-02 08:38:34'),
(40, 'location5ca3117a78ad7', 'pos5c8e555bcd8ad', '2019-04-02 08:38:34'),
(41, 'location5ca3117a78ad7', 'pos5c8e556b1c9bb', '2019-04-02 08:38:34'),
(42, 'location5ca3117a78ad7', 'pos5c8e55ed2c55e', '2019-04-02 08:38:34'),
(43, 'location5ca311babc6c1', 'pos5c8e55512d5f7', '2019-04-02 08:39:38'),
(44, 'location5ca311babc6c1', 'pos5c8e556b1c9bb', '2019-04-02 08:39:38'),
(45, 'location5ca311babc6c1', 'pos5c8e55a60f738', '2019-04-02 08:39:39'),
(46, 'location5ca311babc6c1', 'pos5c8e55ed2c55e', '2019-04-02 08:39:39'),
(47, 'location5ca311dadd126', 'pos5c8e1c26c4d63', '2019-04-02 08:40:10'),
(48, 'location5ca311dadd126', 'pos5c8e550da6bfc', '2019-04-02 08:40:10'),
(49, 'location5ca311dadd126', 'pos5c8e55512d5f7', '2019-04-02 08:40:11'),
(50, 'location5ca311dadd126', 'pos5c8e555bcd8ad', '2019-04-02 08:40:11'),
(51, 'location5ca311dadd126', 'pos5c8e55d2e9985', '2019-04-02 08:40:11'),
(52, 'location5ca311dadd126', 'pos5c8e56085f728', '2019-04-02 08:40:11'),
(53, 'location5ca311f909085', 'pos5c8e1c26c4d63', '2019-04-02 08:40:41'),
(54, 'location5ca311f909085', 'pos5c8e55512d5f7', '2019-04-02 08:40:41'),
(55, 'location5ca311f909085', 'pos5c8e556b1c9bb', '2019-04-02 08:40:41'),
(56, 'location5ca311f909085', 'pos5c8e55886ff68', '2019-04-02 08:40:41'),
(57, 'location5ca311f909085', 'pos5c8e55d2e9985', '2019-04-02 08:40:41'),
(58, 'location5ca3121332ce0', 'pos5c8e1c26c4d63', '2019-04-02 08:41:07'),
(59, 'location5ca3121332ce0', 'pos5c8e55512d5f7', '2019-04-02 08:41:07'),
(60, 'location5ca3121332ce0', 'pos5c8e555bcd8ad', '2019-04-02 08:41:07'),
(61, 'location5ca3121332ce0', 'pos5c8e556b1c9bb', '2019-04-02 08:41:07'),
(62, 'location5ca3121332ce0', 'pos5c8e559460f88', '2019-04-02 08:41:07'),
(63, 'location5ca3123a59d76', 'pos5c8e550da6bfc', '2019-04-02 08:41:46'),
(64, 'location5ca3123a59d76', 'pos5c8e55512d5f7', '2019-04-02 08:41:46'),
(65, 'location5ca3123a59d76', 'pos5c8e555bcd8ad', '2019-04-02 08:41:46'),
(66, 'location5ca3123a59d76', 'pos5c8e556b1c9bb', '2019-04-02 08:41:46'),
(67, 'location5ca3123a59d76', 'pos5c8e55e6cd7c1', '2019-04-02 08:41:46'),
(68, 'location5ca3125f467ad', 'pos5c8e1c26c4d63', '2019-04-02 08:42:23'),
(69, 'location5ca3125f467ad', 'pos5c8e555bcd8ad', '2019-04-02 08:42:23'),
(70, 'location5ca3125f467ad', 'pos5c8e56085f728', '2019-04-02 08:42:23'),
(71, 'location5ca3125f467ad', 'pos5c8e56a582c6a', '2019-04-02 08:42:23'),
(72, 'location5ca3125f467ad', 'pos5c8e56b2ac586', '2019-04-02 08:42:23'),
(73, 'location5ca3125f467ad', 'pos5c8e5c4a0e05e', '2019-04-02 08:42:23'),
(74, 'location5ca3129dcfead', 'pos5c8e55512d5f7', '2019-04-02 08:43:25'),
(75, 'location5ca3129dcfead', 'pos5c8e559460f88', '2019-04-02 08:43:25'),
(76, 'location5ca3129dcfead', 'pos5c8e55b854b21', '2019-04-02 08:43:26'),
(77, 'location5ca3129dcfead', 'pos5c8e569a7cdfb', '2019-04-02 08:43:26'),
(78, 'location5ca3129dcfead', 'pos5c8e58a5df456', '2019-04-02 08:43:26'),
(79, 'location5c8e5a4c16bef', 'pos5c8e5948ea901', '2019-04-02 08:57:13');

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
(35, 'pos5c8e5c6f7e493', 'Senior Lab Supervisor', '2019-03-17 15:40:47'),
(36, 'pos5c9e3126d3b9b', 'Artisan II', '2019-03-29 15:52:22'),
(37, 'pos5c9e319a72e69', 'Higher Exe Officer', '2019-03-29 15:54:18'),
(38, 'pos5c9e31c74f139', 'Senior Workshop Supervisor', '2019-03-29 15:55:03'),
(39, 'pos5c9e31d95fab9', 'Workshop Supervisor', '2019-03-29 15:55:21');

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

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`) VALUES
(1, 'transfer_interval', '2', '2019-03-20 14:25:07');

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

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `staff_id`, `firstname`, `lastname`, `email`, `phone`, `dob`, `age`, `qualification`, `last_transfer_date`, `is_movable`, `gender`, `level_id`, `location_id`, `position_id`, `created_at`) VALUES
(1, 'staffs5c92a4e1813cc', 'Isreal', 'Adeniran', 'isrealadeniran@gmail.com', '09088446634', '2009-02-05', 10, 'BSc', '2019-04-02', 1, 'male', 'level5c8e198124d11', 'location5ca2f16560da3', 'pos5c8e1c26c4d63', '2019-03-20 21:38:57'),
(2, 'staffs5ca2f57672bce', 'Adeniyi', 'Isaac Olufemi', 'adeniyiolufemi@gmail.com', '9032559681', '1996-03-07', 23, 'BSc', '2019-04-02', 1, 'male', 'level5c8e198124d11', 'location5c8e612d8c460', 'pos5c8e58a5df456', '2019-04-02 06:39:02'),
(3, 'staffs5ca2fb0975072', 'Alabi', 'Adekunle', 'Adekunle@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', 'level5c8e198124d11', 'location5c8e5a4c16bef', 'pos5c8e5948ea901', '2019-04-02 07:02:49'),
(4, 'staffs5ca2fb09852c8', 'Olufemi', 'Olusola', 'Olusola@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', 'level5c8e198124d11', 'location5c8e612d8c460', 'pos5c8e5c377c867', '2019-04-02 07:02:49'),
(5, 'staffs5ca2fb906a98c', 'Agbola', 'Oluyemisi', 'AgbolaOluyemisi@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5ca2f1ba20d3a', 'pos5c8e1c26c4d63', '2019-04-02 07:05:04'),
(6, 'staffs5ca2fb907ddf0', 'Alabi', 'Adekunle', 'AlabiAdekunle@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', 'level5c8e198124d11', 'location5ca2f16560da3', 'pos5c8e59240579f', '2019-04-02 07:05:04'),
(7, 'staffs5ca2fb908deed', 'Jimoh', 'Timothy', 'JimohTimothy@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5c8e612d8c460', 'pos5c8e5b984a79f', '2019-04-02 07:05:04'),
(8, 'staffs5ca2fb9096b56', 'Kasim', 'Usman', 'KasimUsman@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5ca2f2e3185e3', 'pos5c8e55886ff68', '2019-04-02 07:05:04'),
(9, 'staffs5ca2fb909ebd2', 'Olatubara', 'Oluwafisayomi', 'OlatubaraOluwafisayomi@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', 'level5c8e198124d11', 'location5ca2f1ba20d3a', 'pos5c8e1c26c4d63', '2019-04-02 07:05:04'),
(10, 'staffs5ca2fb90a6c50', 'Olufemi', 'Olusola', 'OlufemiOlusola@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5ca2f1ba20d3a', 'pos5c8e550da6bfc', '2019-04-02 07:05:04'),
(11, 'staffs5ca2fb90af27a', 'Omirin', 'Adebola', 'OmirinAdebola@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5ca2f1ba20d3a', 'pos5c8e1c26c4d63', '2019-04-02 07:05:04'),
(12, 'staffs5ca2fb90ba180', 'Sanni', 'Isaiah', 'SanniIsaiah@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5ca2f1ba20d3a', 'pos5c8e5616ba43c', '2019-04-02 07:05:04'),
(13, 'staffs5ca2fb90c4f17', 'Wahab', 'Adeola', 'WahabAdeola@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5c8e612d8c460', 'pos5c8e55512d5f7', '2019-04-02 07:05:04'),
(14, 'staffs5ca2fb90cf933', 'Farotimi', 'Idowu', 'FarotimiIdowu@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', 'level5c8e198124d11', 'location5ca2f16560da3', 'pos5c9e3126d3b9b', '2019-04-02 07:05:04'),
(15, 'staffs5ca312a56621d', 'Rachel', 'Roger', 'RachelRoger@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311f909085', 'pos5c8e1c26c4d63', '2019-04-02 08:43:33'),
(16, 'staffs5ca312a574e31', 'Edwards', 'Johnson', 'EdwardsJohnson@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca311f909085', 'pos5c8e55886ff68', '2019-04-02 08:43:33'),
(17, 'staffs5ca312a58028d', 'Christopher', 'Marilyn', 'ChristopherMarilyn@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3117a78ad7', 'pos5c8e550da6bfc', '2019-04-02 08:43:33'),
(18, 'staffs5ca312a595404', 'Perez', 'Thompson', 'PerezThompson@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3121332ce0', 'pos5c8e559460f88', '2019-04-02 08:43:33'),
(19, 'staffs5ca312a5ab4fc', 'Thomas', 'Anthony', 'ThomasAnthony@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3121332ce0', 'pos5c8e555bcd8ad', '2019-04-02 08:43:33'),
(20, 'staffs5ca312a5b60fc', 'Baker', 'Evans', 'BakerEvans@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca311dadd126', 'pos5c8e1c26c4d63', '2019-04-02 08:43:33'),
(21, 'staffs5ca312a5c0f0a', 'Sara', 'Julie', 'SaraJulie@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311dadd126', 'pos5c8e555bcd8ad', '2019-04-02 08:43:33'),
(22, 'staffs5ca312a5cb975', 'Moore', 'Hall', 'MooreHall@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3117a78ad7', 'pos5c8e555bcd8ad', '2019-04-02 08:43:33'),
(23, 'staffs5ca312a5df8b9', 'Chris', 'Paula', 'ChrisPaula@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311babc6c1', 'pos5c8e55ed2c55e', '2019-04-02 08:43:33'),
(24, 'staffs5ca312a5eec2b', 'Bailey', 'Phillips', 'BaileyPhillips@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca311f909085', 'pos5c8e1c26c4d63', '2019-04-02 08:43:33'),
(25, 'staffs5ca312c467317', 'Rachel', 'Roger', 'RachelRoger@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311f909085', 'pos5c8e55d2e9985', '2019-04-02 08:44:04'),
(26, 'staffs5ca312c4759a5', 'Edwards', 'Johnson', 'EdwardsJohnson@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca311dadd126', 'pos5c8e55d2e9985', '2019-04-02 08:44:04'),
(27, 'staffs5ca312c488d5a', 'Christopher', 'Marilyn', 'ChristopherMarilyn@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311babc6c1', 'pos5c8e55ed2c55e', '2019-04-02 08:44:04'),
(28, 'staffs5ca312c49e90f', 'Perez', 'Thompson', 'PerezThompson@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311dadd126', 'pos5c8e555bcd8ad', '2019-04-02 08:44:04'),
(29, 'staffs5ca312c4b187e', 'Thomas', 'Anthony', 'ThomasAnthony@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311babc6c1', 'pos5c8e55ed2c55e', '2019-04-02 08:44:04'),
(30, 'staffs5ca312c4d997a', 'Baker', 'Evans', 'BakerEvans@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3121332ce0', 'pos5c8e556b1c9bb', '2019-04-02 08:44:04'),
(31, 'staffs5ca312c4eac2f', 'Sara', 'Julie', 'SaraJulie@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3117a78ad7', 'pos5c8e1c26c4d63', '2019-04-02 08:44:04'),
(32, 'staffs5ca312c4f2b79', 'Moore', 'Hall', 'MooreHall@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca311babc6c1', 'pos5c8e55512d5f7', '2019-04-02 08:44:04'),
(33, 'staffs5ca312c506d9c', 'Chris', 'Paula', 'ChrisPaula@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'female', '', 'location5ca3121332ce0', 'pos5c8e55512d5f7', '2019-04-02 08:44:05'),
(34, 'staffs5ca312c50ed33', 'Bailey', 'Phillips', 'BaileyPhillips@gmail.com', '08077473536', '1960-02-05', 59, 'BSc', '2014-02-05', 1, 'male', '', 'location5ca3121332ce0', 'pos5c8e556b1c9bb', '2019-04-02 08:44:05');

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
  `location_id` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `supervisor_id`, `name`, `email`, `password`, `location_id`, `created_at`) VALUES
(1, 'superv5c922a988a31a', 'Akinola Solomon', 'akin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'location5c8e612d8c460', '2019-03-20 12:58:36');

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
-- Dumping data for table `transfer_history`
--

INSERT INTO `transfer_history` (`id`, `staff_id`, `location_id`, `position_id`, `created_at`) VALUES
(1, 'staffs5c92a4e1813cc', 'location5c8e612d8c460', 'pos5c8e1c26c4d63', '2019-03-30 08:14:06'),
(2, 'staffs5c92a4e1813cc', 'location5ca2f16560da3', 'pos5c8e1c26c4d63', '2019-04-02 08:18:26'),
(3, 'staffs5ca2f57672bce', 'location5c8e612d8c460', 'pos5c8e58a5df456', '2019-04-02 08:18:48');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `location_positions`
--
ALTER TABLE `location_positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfer_history`
--
ALTER TABLE `transfer_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
