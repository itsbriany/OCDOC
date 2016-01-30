-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 30, 2016 at 08:37 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ocdoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
  `PlayerID` int(11) NOT NULL,
  `TurnID` int(11) NOT NULL,
  `Stamina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TaskLinks`
--

CREATE TABLE `TaskLinks` (
  `TaskLinkID` int(11) NOT NULL,
  `Player_ID` int(11) NOT NULL,
  `Task_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
  `TaskID` int(11) NOT NULL,
  `Task` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TasksComplete`
--

CREATE TABLE `TasksComplete` (
  `ID` int(11) NOT NULL,
  `PlayerID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Time`
--

CREATE TABLE `Time` (
  `Day` int(11) NOT NULL,
  `Hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Players`
--
ALTER TABLE `Players`
  ADD PRIMARY KEY (`PlayerID`);

--
-- Indexes for table `TaskLinks`
--
ALTER TABLE `TaskLinks`
  ADD PRIMARY KEY (`TaskLinkID`),
  ADD KEY `Player_ID` (`Player_ID`),
  ADD KEY `Task_ID` (`Task_ID`);

--
-- Indexes for table `Tasks`
--
ALTER TABLE `Tasks`
  ADD PRIMARY KEY (`TaskID`);

--
-- Indexes for table `TasksComplete`
--
ALTER TABLE `TasksComplete`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TasksComplete`
--
ALTER TABLE `TasksComplete`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `TaskLinks`
--
ALTER TABLE `TaskLinks`
  ADD CONSTRAINT `tasklinks_ibfk_1` FOREIGN KEY (`Player_ID`) REFERENCES `Players` (`PlayerID`),
  ADD CONSTRAINT `tasklinks_ibfk_2` FOREIGN KEY (`Task_ID`) REFERENCES `Tasks` (`TaskID`);
