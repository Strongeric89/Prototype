-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2018 at 02:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saprello`
--

-- --------------------------------------------------------

--
-- Table structure for table `board`
--

CREATE TABLE `board` (
  `BOARD_ID` int(11) NOT NULL,
  `BOARD_TITLE` varchar(100) NOT NULL,
  `BOARD_DESCRIPTION` varchar(1000) NOT NULL,
  `DATE_ADDED` DATE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `CARD_ID` int(11) NOT NULL,
  `DATE_ADDED` date NOT NULL,
  `TITLE` varchar(50) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `CARD_STATUS` varchar(4) NOT NULL,
  `BOARD_ID` int(11) NOT NULL,
  `USER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribed`
--

CREATE TABLE `subscribed` (
  `USER_ID` varchar(10) NOT NULL,
  `BOARD_ID` int(11) NOT NULL,
  `BOARD_DISPLAY` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USER_ID` varchar(10) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `USERPASSWORD` varchar(50) NOT NULL DEFAULT 'Password',
  `EMAIL` varchar(50) NOT NULL,
  `IS_ADMIN` tinyint(1) NOT NULL DEFAULT '0',
  `PROFILE_IMG` varchar(100) NOT NULL DEFAULT 'userprofiles/profiler.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `NAME`, `USERPASSWORD`, `EMAIL`, `IS_ADMIN`, `PROFILE_IMG`) VALUES
('i000000', 'Paul O Connor', 'dc647eb65e6711e155375218212b3964', 'pauloc@sap.com', 1, 'userprofiles/profiler.png'),
('i348507', 'Eric Strong', 'dc647eb65e6711e155375218212b3964', 'eric.strong@sap.com', 0, 'userprofiles/eric.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `VOTE_ID` varchar(20) NOT NULL,
  `AGREE_COUNT` int(11) DEFAULT '0',
  `CARD_ID` int(11) NOT NULL,
  `USER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`BOARD_ID`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`CARD_ID`),
  ADD KEY `BOARD_ID` (`BOARD_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `BOARD_ID` (`BOARD_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`CARD_ID`,`USER_ID`),
  ADD KEY `USER_ID` (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board`
--
ALTER TABLE `board`
  MODIFY `BOARD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `CARD_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`BOARD_ID`) REFERENCES `board` (`BOARD_ID`),
  ADD CONSTRAINT `card_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Constraints for table `subscribed`
--
ALTER TABLE `subscribed`
  ADD CONSTRAINT `subscribed_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`),
  ADD CONSTRAINT `subscribed_ibfk_2` FOREIGN KEY (`BOARD_ID`) REFERENCES `board` (`BOARD_ID`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`CARD_ID`) REFERENCES `card` (`CARD_ID`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
