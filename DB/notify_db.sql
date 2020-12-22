-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2019 at 04:13 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notify_daily`
--

CREATE TABLE `notify_daily` (
  `ID` int(10) NOT NULL,
  `Start_Date` varchar(20) NOT NULL,
  `End_Date` varchar(20) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Detail` varchar(1000) NOT NULL,
  `Creator` varchar(45) NOT NULL,
  `Group_Post` varchar(100) NOT NULL,
  `Approve_by` varchar(100) NOT NULL,
  `SENT` varchar(20) NOT NULL,
  `Approve_Status` varchar(100) NOT NULL,
  `Approve_Time` varchar(20) NOT NULL,
  `SENT_Time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_daily`
--

INSERT INTO `notify_daily` (`ID`, `Start_Date`, `End_Date`, `Title`, `Detail`, `Creator`, `Group_Post`, `Approve_by`, `SENT`, `Approve_Status`, `Approve_Time`, `SENT_Time`) VALUES
(61, '27/09/19', '27/09/19', 'Test', 'test', 'EPG-Pearaphat-W', 'PDM', 'ByAdmin Pearaphat-W', '27/09/19', 'Approve By Admin', '', '04:38 PM');

-- --------------------------------------------------------

--
-- Table structure for table `notify_department`
--

CREATE TABLE `notify_department` (
  `ID` int(10) NOT NULL,
  `Department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_department`
--

INSERT INTO `notify_department` (`ID`, `Department`) VALUES
(9, 'IT'),
(10, 'HR'),
(12, 'PDM');

-- --------------------------------------------------------

--
-- Table structure for table `notify_log`
--

CREATE TABLE `notify_log` (
  `ID` int(11) NOT NULL,
  `Creator` varchar(100) NOT NULL,
  `GroupPost` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notify_monthly`
--

CREATE TABLE `notify_monthly` (
  `ID` int(100) NOT NULL,
  `Month_select` varchar(200) NOT NULL,
  `Date_select` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Detail` varchar(1000) NOT NULL,
  `Creator` varchar(100) NOT NULL,
  `Group_Post` varchar(100) NOT NULL,
  `Approve_by` varchar(100) NOT NULL,
  `SENT` varchar(20) NOT NULL,
  `Approve_Status` varchar(20) NOT NULL,
  `Approve_Time` varchar(20) NOT NULL,
  `SENT_Time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_monthly`
--

INSERT INTO `notify_monthly` (`ID`, `Month_select`, `Date_select`, `Title`, `Detail`, `Creator`, `Group_Post`, `Approve_by`, `SENT`, `Approve_Status`, `Approve_Time`, `SENT_Time`) VALUES
(28, 'Sep', '30', 'Test', 'test', 'EPG-bunthurng', 'PDM', 'bunthurng', 'Unsent', 'Abort', '10:58 AM', '');

-- --------------------------------------------------------

--
-- Table structure for table `notify_token`
--

CREATE TABLE `notify_token` (
  `ID` int(10) NOT NULL,
  `Token` varchar(100) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `GroupPriority` varchar(100) NOT NULL,
  `GroupName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_token`
--

INSERT INTO `notify_token` (`ID`, `Token`, `Department`, `GroupPriority`, `GroupName`) VALUES
(18, 'BvvOcrN8paVwanhasgZmMoxfZKvikWKKeRUIqQgtV5f/', 'HR', 'Hight', 'HR'),
(19, 'agY7O9zCUKBTGqvcysMvC3f668K5BCHVN9ObtfQCxRH', 'PDM', 'Mid', 'PDM'),
(21, 'MMJXtbuHzHrOLXREyMparCmcbf1USatujfhDVqHsjDW', 'IT', 'Hight', 'PP');

-- --------------------------------------------------------

--
-- Table structure for table `notify_user`
--

CREATE TABLE `notify_user` (
  `ID` int(10) NOT NULL,
  `Institution` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Priority` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notify_user`
--

INSERT INTO `notify_user` (`ID`, `Institution`, `Username`, `Password`, `Department`, `Priority`) VALUES
(7, 'EPG', 'bunthurng', '1234', 'PDM', 'Hight'),
(9, 'EPG', 'Jarukit', '1234', 'PDM', 'Mid'),
(10, 'EPG', 'Pearaphat-W', '1234', 'IT', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `notify_weekly`
--

CREATE TABLE `notify_weekly` (
  `ID` int(100) NOT NULL,
  `Day_select` varchar(100) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Detail` varchar(1000) NOT NULL,
  `Creator` varchar(100) NOT NULL,
  `Group_Post` varchar(100) NOT NULL,
  `Approve_BY` varchar(100) NOT NULL,
  `SENT` varchar(20) NOT NULL,
  `Approve_Status` varchar(20) NOT NULL,
  `Approve_Time` varchar(20) NOT NULL,
  `SENT_Time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notify_daily`
--
ALTER TABLE `notify_daily`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notify_department`
--
ALTER TABLE `notify_department`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notify_log`
--
ALTER TABLE `notify_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notify_monthly`
--
ALTER TABLE `notify_monthly`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notify_token`
--
ALTER TABLE `notify_token`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notify_user`
--
ALTER TABLE `notify_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notify_weekly`
--
ALTER TABLE `notify_weekly`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notify_daily`
--
ALTER TABLE `notify_daily`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notify_department`
--
ALTER TABLE `notify_department`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notify_log`
--
ALTER TABLE `notify_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notify_monthly`
--
ALTER TABLE `notify_monthly`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `notify_token`
--
ALTER TABLE `notify_token`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notify_user`
--
ALTER TABLE `notify_user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notify_weekly`
--
ALTER TABLE `notify_weekly`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
