-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2019 at 03:12 PM
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
-- Database: `apts`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acctId` int(11) NOT NULL,
  `userId` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `usertype` varchar(100) NOT NULL DEFAULT 'Student',
  `status` varchar(30) NOT NULL DEFAULT 'Active',
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `lastLogin` date DEFAULT NULL,
  `expDate` date NOT NULL,
  `firstLogin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acctId`, `userId`, `fname`, `mname`, `lname`, `contact`, `usertype`, `status`, `password`, `email`, `lastLogin`, `expDate`, `firstLogin`) VALUES
(9, 20115577, 'Halley', '', 'Tarnateee', '92111711', 'Admin', 'Active', '1234', 'halley123@gmail.com', '2019-04-08', '2020-04-08', 0),
(84, 20190007, 'James', 'Rivers', 'Casey', '0917432761', 'Student', 'Active', 'Rivers', 'jCas@gmail.com', NULL, '2020-04-03', 1),
(87, 20190010, 'Pedro', 'Liwayway', 'Penduko', '0917432761', 'Student', 'Active', 'Liwayway', 'pedropenduko123@gmail.com', NULL, '2020-04-03', 1),
(88, 20084787, 'Jason', 'Bam', 'Pinkisan', '0921114762', 'Student', 'Active', '123', 'jasonpinkisan@gmail.com', '2019-04-08', '2020-04-08', 0),
(89, 20097852, 'Frederick', 'Random', 'Layus', '09195466456', 'Student', 'Active', 'Random', 'flayus@gmail.com', NULL, '2020-04-03', 1),
(90, 20110940, 'Rinalyn', 'Maurisio', 'Mercado', '09198859824', 'Student', 'Active', '1234', 'rmercado@gmail.com', '2019-04-06', '2020-04-06', 0),
(91, 20142468, 'Ellen', 'Joy', 'Tiaga', '09142256285', 'Student', 'Active', 'Joy', 'ellen@gmail.com', NULL, '2020-04-03', 1),
(92, 123, 'Jack', 'Martian', 'Desena', '09192258425', 'Admin', 'Active', 'Martian', 'jasdf@asdf.asd', NULL, '2020-04-06', 1),
(97, 20190002, 'Dean', 'Cormack', 'Russel', '0917432765', 'Student', 'Active', 'Cormack', 'dRuss@gmail.com', NULL, '2020-04-10', 1),
(98, 20190003, 'Jace', 'Drew', 'Smith', '917432710', 'Student', 'Active', 'Drew', 'jSmi@gmail.com', NULL, '2020-04-10', 1),
(99, 20190004, 'Diane ', 'Kenning', 'Osborn', '0917432761', 'Student', 'Active', 'Kenning', 'DOsb@gmail.com', NULL, '2020-04-10', 1),
(101, 20190009, 'Rees', 'Lee', 'Amilyn', '917432710', 'Student', 'Active', 'Lee', 'rAmi@gmail.com', NULL, '2020-04-10', 1),
(102, 20190008, 'Fridda', 'Penelope', 'Sanders', '0917432765', 'Student', 'Active', 'Penelope', 'fSand@gmail.com', NULL, '2020-04-10', 1),
(103, 20190001, 'Joan', 'Grant', ' Macfarlane', '0917432761', 'Student', 'Active', 'Grant', 'jMac@gmail.com', NULL, '2020-04-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `no` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `key` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`no`, `email`, `key`, `expDate`) VALUES
(30, 'jasonpinkisan@gmail.com', '768e78024aa8fdb9b8fe87be86f64745f85d391deb', '2019-04-09 02:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjId` int(11) NOT NULL,
  `subjname` varchar(100) NOT NULL,
  `subjdesc` varchar(350) NOT NULL,
  `subjstat` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjId`, `subjname`, `subjdesc`, `subjstat`) VALUES
(7, 'ENGPHS1', 'Engineering Physics ', 'Active'),
(8, 'ENGMAT9', 'Probability and Statistics', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

CREATE TABLE `temporary` (
  `acctId` int(11) NOT NULL,
  `userId` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `usertype` varchar(100) NOT NULL DEFAULT 'Student',
  `status` varchar(30) NOT NULL DEFAULT 'Active',
  `password` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `lastLogin` date DEFAULT NULL,
  `expDate` date NOT NULL,
  `firstLogin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temporary`
--

INSERT INTO `temporary` (`acctId`, `userId`, `fname`, `mname`, `lname`, `contact`, `usertype`, `status`, `password`, `email`, `lastLogin`, `expDate`, `firstLogin`) VALUES
(191, 20190001, 'Joan', 'Grant', ' Macfarlane', '0917432761', 'Student', 'Active', '', 'jMac@gmail.com', NULL, '0000-00-00', 0),
(195, 20190005, 'Keenan', 'Dursley', 'Dunlap', '0917432765', 'Student', 'Active', '', 'kDun@gmail.com', NULL, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topicId` int(11) NOT NULL,
  `subjId` int(11) NOT NULL,
  `topname` varchar(250) NOT NULL,
  `topdesc` varchar(255) NOT NULL,
  `topstatus` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topicId`, `subjId`, `topname`, `topdesc`, `topstatus`) VALUES
(31, 7, 'Frequency', 'This topic involves the computation of an object\'s frequency.', 'Active'),
(32, 7, 'Motion', 'Involves the computation of an object\'s speed, velocity and acceleration. ', 'Active'),
(37, 8, 'Permutation', 'Finding probability of an event through permutation', 'Active'),
(38, 8, 'Combination', 'Find the probability of an event through Combination', 'Active'),
(39, 8, 'asd', 'asd', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `topic_taught`
--

CREATE TABLE `topic_taught` (
  `taughtId` int(11) NOT NULL,
  `topicId` int(11) NOT NULL,
  `tutorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic_taught`
--

INSERT INTO `topic_taught` (`taughtId`, `topicId`, `tutorId`) VALUES
(1, 31, 20084787),
(3, 37, 20084787),
(5, 31, 20097852),
(6, 37, 20097852);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutorId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tutorStatus` varchar(50) NOT NULL,
  `DaysAvail` varchar(50) NOT NULL,
  `TimeAvail` varchar(250) NOT NULL,
  `dateadded` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutorId`, `userId`, `tutorStatus`, `DaysAvail`, `TimeAvail`, `dateadded`) VALUES
(44, 20097852, 'Active', '', '', '2019-03-01'),
(45, 20084787, 'Active', '', '', '2019-03-01'),
(86, 20084787, 'Active', 'Friday', '3:00 PM-4:00 PM', '0000-00-00'),
(93, 20084787, 'Active', 'Thursday', '2:00 PM-3:00 PM', NULL),
(94, 20097852, 'Active', 'Tuesday', '8:00 AM-9:00 AM', NULL),
(106, 20190006, 'Active', '', '', '2019-04-10'),
(107, 20190007, 'Inactive', '', '', '2019-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `t_list`
--

CREATE TABLE `t_list` (
  `tlistId` int(11) NOT NULL,
  `tutor` varchar(80) NOT NULL,
  `tutee` varchar(80) NOT NULL,
  `topic` varchar(80) NOT NULL,
  `tListStatus` varchar(50) NOT NULL,
  `tutorFeed` varchar(80) DEFAULT NULL,
  `tuteeFeed` varchar(80) DEFAULT NULL,
  `cancelBy` varchar(80) DEFAULT NULL,
  `cancelReason` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `time` varchar(25) NOT NULL,
  `tuteeRate` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_list`
--

INSERT INTO `t_list` (`tlistId`, `tutor`, `tutee`, `topic`, `tListStatus`, `tutorFeed`, `tuteeFeed`, `cancelBy`, `cancelReason`, `date`, `time`, `tuteeRate`) VALUES
(4, 'Frederick Layus', 'Jason Pinkisan', 'Permutation', 'Completed', 'I taught.', 'I learned.', NULL, NULL, '2019-04-02', '8:00 AM-9:00 AM', 3),
(5, 'Jason Pinkisan', 'Frederick Layus', 'Permutation', 'Cancelled', NULL, NULL, 'Jason Pinkisan', 'Feeling Ill', '2019-04-02', '8:00 AM-9:00 AM', NULL),
(12, 'Frederick Layus', 'Jason Pinkisan', 'Permutation', 'Active', NULL, NULL, NULL, NULL, '2019-04-09', '8:00 AM-9:00 AM', NULL),
(13, 'Jason Pinkisan', 'Rinalyn Mercado', 'Frequency', 'Completed', NULL, 'This tutorial was satisfactory. Would ask for tutorial again. 5 stars out of 5.', NULL, NULL, '2019-04-04', '2:00 PM-3:00 PM', NULL),
(14, 'Jason Pinkisan', 'Rinalyn Mercado', 'Permutation', 'Pending', NULL, NULL, NULL, NULL, '2019-04-04', '2:00 PM-3:00 PM', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acctId`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjId`);

--
-- Indexes for table `temporary`
--
ALTER TABLE `temporary`
  ADD PRIMARY KEY (`acctId`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topicId`);

--
-- Indexes for table `topic_taught`
--
ALTER TABLE `topic_taught`
  ADD PRIMARY KEY (`taughtId`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutorId`);

--
-- Indexes for table `t_list`
--
ALTER TABLE `t_list`
  ADD PRIMARY KEY (`tlistId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acctId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `temporary`
--
ALTER TABLE `temporary`
  MODIFY `acctId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `topicId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `topic_taught`
--
ALTER TABLE `topic_taught`
  MODIFY `taughtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `t_list`
--
ALTER TABLE `t_list`
  MODIFY `tlistId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
