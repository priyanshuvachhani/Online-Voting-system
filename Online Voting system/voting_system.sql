-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 07:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `no` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `party` text NOT NULL,
  `candidate` text NOT NULL,
  `canimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`no`, `logo`, `party`, `candidate`, `canimage`) VALUES
(1, 'BJP-logo.png', 'Bharatiya Janata Party\r\n', 'Narendra Damodardas Modi', 'Narendra Modi.png'),
(2, 'AAP-logo.png', 'Aam Aadmi Party\r\n', 'Arvind Kejriwal', 'Arvind Kejriwal.png'),
(3, 'Congress-logo.png', 'Indian National Congress', 'Rahul Rajiv Gandhi', 'Rahul Gandhi.png'),
(4, 'NOTA-Logo.png', 'NOTA', 'None of the above', 'NOTA-Logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE `control` (
  `no` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`no`, `name`, `status`) VALUES
(1, 'vstart', 0);

-- --------------------------------------------------------

--
-- Table structure for table `countvote`
--

CREATE TABLE `countvote` (
  `no` int(11) NOT NULL,
  `party` text NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countvote`
--

INSERT INTO `countvote` (`no`, `party`, `vote`) VALUES
(1, 'Bharatiya Janata Party\r\n', 0),
(2, 'Aam Aadmi Party\r\n', 0),
(3, 'Indian National Congress', 0),
(4, 'NOTA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voted`
--

CREATE TABLE `voted` (
  `no` int(11) NOT NULL,
  `vid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `no` int(11) NOT NULL,
  `name` text NOT NULL,
  `acid` double NOT NULL,
  `vid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`no`, `name`, `acid`, `vid`) VALUES
(1, 'Singh Arjun Amarbhai', 625819374582, 'ADC2541325'),
(2, 'Chatterjee Priya Aniketbhai', 189724537612, 'AWS1248532'),
(3, 'Gupta Meera Rakeshbhai', 562487316295, 'AXW1532415'),
(4, 'Reddy Karthik Rameshbhai', 235681947562, 'DYG4532714'),
(5, 'Singh Amarjeet Singhbhai', 673592841357, 'EMY2157486'),
(6, 'Joshi Rishi Sureshbhai', 847512396248, 'EUJ1532485'),
(7, 'Vachhani Priyanshu Kiritbhai', 732564918237, 'FDE5241215'),
(8, 'Patel Ayesha Kamalbhai', 918273645198, 'GME3251489'),
(9, 'Gupta Neha Arjunbhai', 258136794875, 'PEL2561482'),
(10, 'Sharma Rajesh Kumarbhai', 527864319587, 'RBT5348527'),
(11, 'Verma Ritu Sanjaybhai', 389647251893, 'RFD1257456'),
(12, 'Patel Neha Kamalbhai', 893712568475, 'SGE1252035'),
(13, 'Sharma Aarav Rajeshbhai', 174829356781, 'SIU4569325'),
(14, 'Reddy Naveen Kumarbhai', 149285763521, 'WKF5213682');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `party` (`party`) USING HASH;

--
-- Indexes for table `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `countvote`
--
ALTER TABLE `countvote`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `party` (`party`) USING HASH;

--
-- Indexes for table `voted`
--
ALTER TABLE `voted`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `vid` (`vid`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `vid` (`vid`),
  ADD UNIQUE KEY `acid` (`acid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `control`
--
ALTER TABLE `control`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countvote`
--
ALTER TABLE `countvote`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voted`
--
ALTER TABLE `voted`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voter`
--
ALTER TABLE `voter`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
