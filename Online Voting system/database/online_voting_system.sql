-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 12:55 PM
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
-- Database: `online_voting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `login_id` text NOT NULL,
  `password` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `login_id`, `password`, `photo`) VALUES
(1, 'Vachhani Priyanshu K.', 'SOU', '123', 'SOU.png');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `name`) VALUES
(1, 'Isanpur'),
(2, 'Maninagar'),
(3, 'Ghodasar'),
(4, 'Vasna'),
(5, 'Chandkhada');

-- --------------------------------------------------------

--
-- Table structure for table `booth_manager`
--

CREATE TABLE `booth_manager` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `login_id` text NOT NULL,
  `password` text NOT NULL,
  `area` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booth_manager`
--

INSERT INTO `booth_manager` (`id`, `name`, `login_id`, `password`, `area`, `photo`) VALUES
(1, 'Patel Nihar', 'pqr@456', '456@pqr', 'Ghodasar', 'pqr@456.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `no` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `party` text NOT NULL,
  `candidate` text NOT NULL,
  `canimage` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`no`, `logo`, `party`, `candidate`, `canimage`, `area`) VALUES
(1, 'Bharatiya Janata Party.jpg', 'Bharatiya Janata Party', 'Hasmukhbhai Somabhai Patel', 'Hasmukhbhai Somabhai Patel.jpg', 'Ghodasar'),
(2, 'Aam Aadmi Party.jpg', 'Aam Aadmi Party', 'Arvind Kejriwal', 'Arvind Kejriwal.jpg', 'Ghodasar'),
(3, 'Indian National Congress.jpg', 'Indian National Congress', 'Rahul Rajiv Gandhi', 'Rahul Rajiv Gandhi.jpg', 'Ghodasar'),
(4, 'None of the above.jpg', 'None of the above', 'NOTA', 'NOTA.jpg', 'Ghodasar'),
(5, 'Bharatiya Janata Party.jpg', 'Bharatiya Janata Party', 'Narendra Damodardas Modi', 'Narendra Damodardas Modi.jpg', 'Isanpur'),
(6, 'Aam Aadmi Party.jpg', 'Aam Aadmi Party', 'Arvind Kejriwal', 'Arvind Kejriwal.jpg', 'Isanpur'),
(7, 'Indian National Congress.jpg', 'Indian National Congress', 'Rahul Rajiv Gandhi', 'Rahul Rajiv Gandhi.jpg', 'Isanpur'),
(8, 'None of the above.jpg', 'None of the above', 'NOTA', 'NOTA.jpg', 'Isanpur'),
(9, 'Bharatiya Janata Party.jpg', 'Bharatiya Janata Party', 'Amul Bhatt', 'Amul Bhatt.jpg', 'Maninagar'),
(10, 'Aam Aadmi Party.jpg', 'Aam Aadmi Party', 'Arvind Kejriwal', 'Arvind Kejriwal.jpg', 'Maninagar'),
(11, 'Indian National Congress.jpg', 'Indian National Congress', 'Rahul Rajiv Gandhi', 'Rahul Rajiv Gandhi.jpg', 'Maninagar'),
(12, 'None of the above.jpg', 'None of the above', 'NOTA', 'NOTA.jpg', 'Maninagar');

-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE `control` (
  `no` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`no`, `name`, `status`) VALUES
(1, 'svoting', 0),
(2, 'sverifying', 0),
(3, 'dresult', 0);

-- --------------------------------------------------------

--
-- Table structure for table `countvote`
--

CREATE TABLE `countvote` (
  `no` int(11) NOT NULL,
  `party` text NOT NULL,
  `area` varchar(255) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countvote`
--

INSERT INTO `countvote` (`no`, `party`, `area`, `vote`) VALUES
(1, 'Bharatiya Janata Party', 'Ghodasar', 0),
(2, 'Aam Aadmi Party', 'Ghodasar', 0),
(3, 'Indian National Congress', 'Ghodasar', 0),
(4, 'None of the above', 'Ghodasar', 0),
(5, 'Bharatiya Janata Party', 'Isanpur', 0),
(6, 'Aam Aadmi Party', 'Isanpur', 0),
(7, 'Indian National Congress', 'Isanpur', 0),
(8, 'None of the above', 'Isanpur', 0),
(9, 'Bharatiya Janata Party', 'Maninagar', 0),
(10, 'Aam Aadmi Party', 'Maninagar', 0),
(11, 'Indian National Congress', 'Maninagar', 0),
(12, 'None of the above', 'Maninagar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `home_verification`
--

CREATE TABLE `home_verification` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `login_id` text NOT NULL,
  `password` text NOT NULL,
  `area` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_verification`
--

INSERT INTO `home_verification` (`id`, `name`, `login_id`, `password`, `area`, `photo`) VALUES
(1, 'Patel Nihar', 'abc@123', '123@abc', 'Ghodasar', 'abc@123.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `political_party`
--

CREATE TABLE `political_party` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `political_party`
--

INSERT INTO `political_party` (`id`, `name`, `logo`) VALUES
(1, 'Bharatiya Janata Party', 'Bharatiya Janata Party.jpg'),
(2, 'Aam Aadmi Party', 'Aam Aadmi Party.jpg'),
(3, 'Indian National Congress', 'Indian National Congress.jpg'),
(4, 'None of the above', 'None of the above.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voted`
--

CREATE TABLE `voted` (
  `no` int(11) NOT NULL,
  `vid` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `no` int(11) NOT NULL,
  `name` text NOT NULL,
  `acid` double NOT NULL,
  `vid` varchar(10) NOT NULL,
  `area` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`no`, `name`, `acid`, `vid`, `area`, `photo`) VALUES
(1, 'Vachhani Priyanshu Kiritbhai', 732564918237, 'FDE5241215', 'Ghodasar', 'FDE5241215.jpg'),
(2, 'Chatterjee Priya Aniketbhai', 189724537612, 'AWS1248532', 'Maninagar', 'voter.jpg'),
(3, 'Gupta Meera Rakeshbhai', 562487316295, 'AXW1532415', 'Isanpur', 'voter.jpg'),
(4, 'Reddy Karthik Rameshbhai', 235681947562, 'DYG4532714', 'Ghodasar', 'voter.jpg'),
(5, 'Singh Amarjeet Singhbhai', 673592841357, 'EMY2157486', 'Isanpur', 'voter.jpg'),
(6, 'Joshi Rishi Sureshbhai', 847512396248, 'EUJ1532485', 'Maninagar', 'voter.jpg'),
(7, 'Singh Arjun Amarbhai', 625819374582, 'ADC2541325', 'Ghodasar', 'voter.jpg'),
(8, 'Patel Ayesha Kamalbhai', 918273645198, 'GME3251489', 'Ghodasar', 'voter.jpg'),
(9, 'Gupta Neha Arjunbhai', 258136794875, 'PEL2561482', 'Isanpur', 'voter.jpg'),
(10, 'Sharma Rajesh Kumarbhai', 527864319587, 'RBT5348527', 'Isanpur', 'voter.jpg'),
(11, 'Verma Ritu Sanjaybhai', 389647251893, 'RFD1257456', 'Maninagar', 'voter.jpg'),
(12, 'Patel Neha Kamalbhai', 893712568475, 'SGE1252035', 'Isanpur', 'voter.jpg'),
(13, 'Sharma Aarav Rajeshbhai', 174829356781, 'SIU4569325', 'Ghodasar', 'voter.jpg'),
(14, 'Reddy Naveen Kumarbhai', 149285763521, 'WKF5213682', 'Maninagar', 'voter.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vote_counter`
--

CREATE TABLE `vote_counter` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `login_id` text NOT NULL,
  `password` text NOT NULL,
  `area` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote_counter`
--

INSERT INTO `vote_counter` (`id`, `name`, `login_id`, `password`, `area`, `photo`) VALUES
(1, 'Patel Nihar', 'xyz@789', '789@xyz', 'Ghodasar', 'xyz@789.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_id` (`login_id`,`password`) USING HASH;

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booth_manager`
--
ALTER TABLE `booth_manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_id` (`login_id`,`password`) USING HASH;

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `countvote`
--
ALTER TABLE `countvote`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `home_verification`
--
ALTER TABLE `home_verification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_id` (`login_id`,`password`) USING HASH;

--
-- Indexes for table `political_party`
--
ALTER TABLE `political_party`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
-- Indexes for table `vote_counter`
--
ALTER TABLE `vote_counter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_id` (`login_id`,`password`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booth_manager`
--
ALTER TABLE `booth_manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `control`
--
ALTER TABLE `control`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countvote`
--
ALTER TABLE `countvote`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `home_verification`
--
ALTER TABLE `home_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `political_party`
--
ALTER TABLE `political_party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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

--
-- AUTO_INCREMENT for table `vote_counter`
--
ALTER TABLE `vote_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
