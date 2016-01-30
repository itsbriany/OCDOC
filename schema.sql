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
  `Player_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Turn_ID` int(11) NOT NULL,
  `Name` VARCHAR(50) NOT NULL,
  `Location` int(11) NOT NULL,
   PRIMARY KEY (Player_ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TaskLinks`
--

CREATE TABLE `TaskLinks` (
  `TaskLink_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Player_ID` int(11) NOT NULL,
  `Task_ID` int(11) NOT NULL,
   PRIMARY KEY (TaskLink_ID)
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
  `Task_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Task` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `TimeConsumption` int(11) DEFAULT NULL,
  `TaskLink_ID` varchar(255) DEFAULT NULL,
  `Req_Task` int(11) DEFAULT NULL,
  `Req_Room` int(11) DEFAULT NULL,
   PRIMARY KEY (Task_ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TasksComplete`
--

CREATE TABLE `TasksComplete` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Player_ID` int(11) NOT NULL,
  `Task_ID` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `NPC`
--

CREATE TABLE `NPC` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskLink_ID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Location` int(11) NOT NULL,
  PRIMARY KEY (ID)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- insert for table `Players`
--

INSERT INTO Players
    (Turn_ID, Name)
VALUES
    (1, "Developer"),
    (2, "Designer"),
    (3, "Artist");

-- --------------------------------------------------------

--
-- insert for table `Tasks`
--

INSERT INTO Tasks
    (Task, Description, TimeConsumption, TaskLink_ID, Req_Task, Req_Room)
VALUES
    ("Get coffie","get some coffie for me please!", 15,"SecretaryTask", 0, 4),
    ("watch the office","can you please watch the office for me!", 60,"SecretaryTask", 0, 1),
    ("answer the phone","you hear the phone right and pick it up.", 20,"ITTask", 1, 5),
    ("answer the phone","you hear the phone right and pick it up.", 20,"BossTask", 2, 3),
    ("answer the phone","samig.", 20,"LunchRoomTask", 0, 7);

-- --------------------------------------------------------

--
-- insert for table `NPC`
--

INSERT INTO NPC
    (TaskLink_ID, Name, Location)
VALUES
    ("SecretaryTask", "Secretary", 4),
    ("ITTask", "IT", 5),
    ("BossTask", "Boss", 3),
    ("LunchRoomTask", "LunchRoom", 7);

-- --------------------------------------------------------

--
-- insert for table `TBLTODO`
--


INSERT INTO TBLTODO
    (Player_ID, Task_ID)
VALUES
    (1, 1),
    (1, 3),
    (2, 1),
    (2, 2),
    (3, 4);

-- --------------------------------------------------------

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
