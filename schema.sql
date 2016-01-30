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

DROP TABLE IF EXISTS Players;
DROP TABLE IF EXISTS Tasks;
DROP TABLE IF EXISTS TasksComplete;
DROP TABLE IF EXISTS TaskLinks;
DROP TABLE IF EXISTS TBLTime;
DROP TABLE IF EXISTS TBLTODO;
DROP TABLE IF EXISTS NPC;

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
  `PlayerID` int(11) NOT NULL AUTO_INCREMENT,
  `TurnID` int(11) NOT NULL,
  `Name` VARCHAR(50) NOT NULL,
   PRIMARY KEY (PlayerID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TaskLinks`
--

CREATE TABLE `TaskLinks` (
  `TaskLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `Player_ID` int(11) NOT NULL,
  `Task_ID` int(11) NOT NULL,
   PRIMARY KEY (TaskLinkID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TBLTODO`
--

CREATE TABLE `TBLTODO` (
  `TODOID` int(11) NOT NULL AUTO_INCREMENT,
  `Player_ID` int(11) NOT NULL,
  `Task_ID` int(11) NOT NULL,
  PRIMARY KEY (TODOID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `Task` varchar(255) DEFAULT NULL,
  `TimeConsumption` int(11) DEFAULT NULL,
  `TaskLinkID` int(11) DEFAULT NULL,
   PRIMARY KEY (TaskID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TasksComplete`
--

CREATE TABLE `TasksComplete` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PlayerID` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Time`
--

CREATE TABLE `TBLTime` (
  `Day` int(11) NOT NULL,
  `Hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `NPC`
--

CREATE TABLE `NPC` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskLinkID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


--
-- Indexes for table `TaskLinks`
--
-- ALTER TABLE `TaskLinks`
  -- ADD KEY `Player_ID` (`Player_ID`),
  -- ADD KEY `Task_ID` (`Task_ID`);

--
-- Constraints for table `TaskLinks`
--
-- ALTER TABLE `TaskLinks`
  -- ADD CONSTRAINT `tasklinks_ibfk_1` FOREIGN KEY (`Player_ID`) REFERENCES `Players` (`PlayerID`),
  -- ADD CONSTRAINT `tasklinks_ibfk_2` FOREIGN KEY (`Task_ID`) REFERENCES `Tasks` (`TaskID`);
