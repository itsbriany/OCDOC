-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 30, 2016 at 06:38 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `OCDOC`
--

-- --------------------------------------------------------

--
-- Table structure for table `Players`
--

CREATE TABLE `Players` (
    `PlayerID` int(11) NOT NULL,
    `TaskLinkID` int(11) NOT NULL,
    `Stamina` int(11) NOT NULL,
    PRIMARY KEY (PlayerID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE `Tasks` (
    `TaskID` int(11) NOT NULL,
    `Task` varchar(255) DEFAULT NULL,
    PRIMARY KEY (TaskID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TaskLinks`
--

CREATE TABLE `TaskLinks` (
    `TaskLinkID` int(11) NOT NULL,
    `Player_ID` int(11) NOT NULL,
    `Task_ID` int(11) NOT NULL,

    INDEX (Player_ID),
    INDEX (Task_ID),

    FOREIGN KEY (Player_ID)
    REFERENCES Players(PlayerID),

    FOREIGN KEY (Task_ID)
    REFERENCES Tasks(TaskID),

    PRIMARY KEY (TaskLinkID)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Time`
--

CREATE TABLE `Time` (
    `Day` int(11) NOT NULL,
    `Hour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
