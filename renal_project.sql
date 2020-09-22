-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2020 at 10:16 AM
-- Server version: 8.0.21-0ubuntu0.20.04.4
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renal_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `cip` varchar(21) DEFAULT NULL,
  `cby` int NOT NULL DEFAULT '0',
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `phone_no`, `status`, `cip`, `cby`, `cdate`) VALUES
(1, 'Admin', 'first_admin', 'admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', '6845745615', 1, '', 1, '2020-09-21 08:41:51'),
(3, 'Ankit', 'ankit_123', 'agu@gmail.com', '25f9e794323b453885f5181f1b624d0b', '7777777777', 0, '', 1, '2020-09-21 08:43:15'),
(4, 'Sanjay', 'sanjay_111', 'sanjay@gmail.com', '7416b09465ba5efbaefb6501665f36c9', '7849746124', 0, '', 1, '2020-09-21 08:42:22'),
(5, 'SSJ', 'ssj999', 'ssj999@gmail.com', '4f75566b81b0119503d5a55ba38a545a', '7894567894', 0, '', 1, '2020-09-21 08:41:43'),
(14, 'Test Admin', 'test_admin@gmail.com', 'test_admin@gmail.com', '25f9e794323b453885f5181f1b624d0b', '487975416', 1, '', 1, '2020-09-21 01:20:21'),
(15, 'Admin X', 'admin_x', 'adminX@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '7414741777', 0, '', 1, '2020-09-22 02:30:15'),
(16, 'test_admin_x', 'testAdmin@gmail.com', 'testAdmin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '7417417417', 1, '', 1, '2020-09-22 03:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cost_per_patient` varchar(50) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `cip` varchar(21) DEFAULT NULL,
  `cby` int DEFAULT '0',
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `cost_per_patient`, `status`, `cip`, `cby`, `cdate`) VALUES
(1, 'Patna Branch', '20.58', 1, '', 1, '2020-09-21 02:29:20'),
(2, 'Kolkata Branch', '50', 1, '', 1, '2020-09-21 02:35:07'),
(3, 'Mumbai', '150', 1, '', 1, '2020-09-21 08:44:16'),
(4, 'Pune Branch', '1000.50', 1, '', 1, '2020-09-22 02:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `cip` varchar(21) DEFAULT NULL,
  `cby` int NOT NULL DEFAULT '0',
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `username`, `email`, `password`, `phone_no`, `status`, `cip`, `cby`, `cdate`) VALUES
(1, 'Dr. Strange', 'doc_strange', 'drsrange@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1234567890', 1, '', 1, '2020-09-21 08:43:48'),
(2, 'Doc', 'doc_123', 'doc@gmail.com', '25f9e794323b453885f5181f1b624d0b', '7894561874', 0, '', 1, '2020-09-21 01:44:35'),
(3, 'Doc2', 'doc_321', 'doc2@gmail.com', 'ca239895db3465d563b933262974e5c0', '8745614560', 0, '', 1, '2020-09-21 01:36:27'),
(4, 'Doctor 3', 'doc_3', 'doc3@gmail.com', 'f9f16d97c90d8c6f2cab37bb6d1f1992', '8888888888', 0, '', 1, '2020-09-22 02:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `phone_no` varchar(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `cip` varchar(21) DEFAULT NULL,
  `cby` int NOT NULL DEFAULT '0',
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `branch_id`, `name`, `phone_no`, `dob`, `status`, `cip`, `cby`, `cdate`) VALUES
(1, 2, 'Patient 1', '7829741963', '2022-09-21', 0, '', 1, '2020-09-22 02:42:07'),
(2, 2, 'Patient 2', '7829741949', '2010-02-22', 1, '', 1, '2020-09-21 07:46:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int NOT NULL,
  `branch_id` int NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_no` varchar(11) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `cip` varchar(21) DEFAULT NULL,
  `cby` int NOT NULL DEFAULT '0',
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `branch_id`, `name`, `username`, `email`, `password`, `phone_no`, `status`, `cip`, `cby`, `cdate`) VALUES
(1, 1, 'Uppal Singh', 'upp@gmail.com', 'upp@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1234567890', 0, '', 1, '2020-09-21 05:23:52'),
(2, 2, 'Staff_1', 'staff_1', 'staff@gmail.com', '25f9e794323b453885f5181f1b624d0b', '123456789', 1, '', 1, '2020-09-21 04:56:45'),
(3, 1, 'Staff X', 'staff_x', 'staffx@gmail.com', '312f04f99be9e857bfb2c033eeb1d3e2', '8888888800', 1, '', 1, '2020-09-22 02:33:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
