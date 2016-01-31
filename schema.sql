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
  `Minutes` int(11) NOT NULL DEFAULT 60,
  PRIMARY KEY (Player_ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `TaskLinks`
--
CREATE TABLE `TaskLinks` (
  `TaskList_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Player_ID` int(11) NOT NULL,
  `Task_ID` int(11) NOT NULL,
  PRIMARY KEY (TaskList_ID)
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
  `Task` varchar(1000) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Feedback` varchar(1000) DEFAULT NULL,
  `TimeConsumption` int(11) DEFAULT NULL,
  `TaskList_ID` varchar(255) DEFAULT NULL,
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
  `TaskList_ID` varchar(255) NOT NULL,
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
    (Task, Description, Feedback, TimeConsumption, TaskList_ID, Req_Task, Req_Room)
VALUES
    ("Find Rita's sandwhich", "\"You, human. Over here now or I will make sure your department is dumped with overtime for the next three months. I need to eat but I can't leave my desk because I'm expecting a call for the Boss. Bring me my sandwich.\" And with that, she returns to her desk, ignoring you.\", \"Well... It seems you do understand your place.\"", "\"Well... It seems you do understand your place.\"", 10,"SecretaryTask", 0, 1),
    ("Go get report","\"Heeyy, you're here. Listen, I'm really tied up with this, uh, um, something. Important businessy things to do, very complex, way above your pay grade. I need you to do me a favor, I'm meeting the board representatives later and I can't find the report I'm supposed to present. I sent it to the copier to print. Could you fetch it?  Sweet, thanks. I gotta run. Big things to do, big things.\"", "\"Oh, yeah, I know you will. Just find me when you get it.\"", 10,"SlackerTask", 0, 5),
    ("Find IT to fix the copier","The printer is acting crazy! Whoop! Beep! Bee-beep-beep! Ka-chaw-kachaaaarr...", "It sounds like it might explode at any moment. Maybe back away.", 20,"CopyRoomTask", 0, 13),
    ("Get Jack a coffee","\"Huurgh.\" Jack the IT looks he just woke from a 48hour hangover. The kind that you remember in crisp detail and want to forget all of it. \"Hur. Hur hur huuurrgh.\" He's just slunched over in his chair and staring at his monitor. The only thing he can muster are low, whiny moans. \"Hur hurugh.\" He keeps poking his coffee mug like he was willing it to refill by magic."
     , "\"Hurga, hurga, huuurrr...\" he seems to be attempting a smile. Or a smirk.", 20,"ITTask", 3, 0),
    ("Accept Sally's offer to make you coffee","\"I've been told I make the best coffee. Do you want me to make you one?", "\"Sally hands you a coffee \"Someitmes I wonder, what would this company do without me?\"", 30,"SlackerTask", 4, 3),
    ("Give Jack your coffee","You enter and Jack looks up at the smell of espresso. He looks longingly at the coffee in your hand. \"Hur gur gur gur.\"", "Like Super Mario getting the super star, Jack knocks back the coffee in one gulp, smashes the cup on the desk, jumps on top of it and poses with a majestic grin on his face and his hands on his hips. In a single bound he leaps out the door and rushes down the hall chanting, \"I HAVE THE POWWAAAA!!!\"", 20,"ITTask", 5, 0),
    ("Take report","Jack has fixed the computer, and somehow turned it into a Formula One style go-kart with an onboard AI companion. At least the report got printed, although it does smell a little like exhaust and coffee.", "You take the report, and give it a quick glance. You can't help but question Sally's choice of words. \"How many Die Hard puns can you fit into economic theory? Now we know.\"", 20,"BossTask", 6, 13),
    ("Give report to Sally","You walk into Sally's office to find her sleeping on her couch with her feet up and a copy of The Hunger Games: Mockingjay Part 7 on her face. She snores like a buzzsaw dropped in a well. You give a ahem and she jolts upright. \"I didn't do it! I was working! I have witnesses!\" Then she realizes where she is. \"Oh, hi, um, wha-what are you doing here?\"", "You hand Sally the report which she quizzically stares at like she doesn't recognize it. Seven awkward seconds go by when she finally puts two and two together. \"Oh, yeah! That uh, thing! Paper... board report thingy. Thanks, man. I owe you one.\" As she walks away a thought occurs to her, like the idea of being in your pocket is inconvenient. She turns back to you. \"By the way,\" she whispers, \"I hear you've been trying to get in to see the Bossman. He keeps a spare key in the pot by his door.\" And with that, she is gone.", 10,"SlackerTask", 5, 5),
    ("Pick up sandwhich","You enter the bathroom. As you walk by a stall you hear flies buzzing. Curiousity getting the better of hygiene concen, you tentatively push the door open. You peak in and see a sandwich sitting on the toilet seat.", "\"Well... five second rule.\"", 30,"SanwichTask", 0, 2),
    ("Give Rita the sandwich","Rita looks at you like you have a third head. \"Are you just going to hover there all day or are you going to give me that sandwich?\"", "Then she sees the sandwich in your hand. \"Oh, for God's sake what took you so long?\" She snatches it out of your hand and starts eating it at her desk. No thank you. No nothing. Then she puts a hand over her stomach. \"Eurgh, I don't feel so well, let everyone know I won't be around the rest of the day, will you?\" She gets up, grabs her coat and bag, and heads toward the elevator.", 20,"SecretaryTask", 9, 1),
    ("Take key you notice in plant pot","You see a glint of something shiny in the plant's pot", "You pick the key out from the plant's roots, dust it off, and put it in your pocket", 10,"ReceptionTask", 8, 13),
    ("YOU WIN!","\"...\" The air hangs still as you go in. A layer of dust covers all the furniture in the room. And in the chair is the Boss, or rather his skeleton. No wonder you never see him around. He's been dead for at least three months.", "\"...\" The air hangs still as you go in. A layer of dust covers all the furniture in the room. And in the chair is the Boss, or rather his skeleton. No wonder you never see him around. He's been dead for at least three months.", 5,"LunchRoomTask", 11, 6);
-- --------------------------------------------------------
--
-- insert for table `NPC`
--
INSERT INTO NPC
    (TaskList_ID, Name, Location)
VALUES
    ("DanTask", "Douche Dan", 3),
    ("SecretaryTask", "Secretary", 1),
    ("SlackerTask", "Sally Slacker", 5),
    ("JokerTask", "Jenny Joker", 4),
    ("ITTask", "IT Guy", 0),
    ("ReceptionTask", "Reception", 13),
    ("BathroomTask", "Bathroom", 2),
    ("BreakRoomTask", "BreakRoom", 13),
    ("CustomerSupportTask", "CustomerSupport", 13),
    ("HRTask", "HR", 13),
    ("BossOfficeTask", "BossOffice", 13),
    ("LobbyTask", "Lobby", 13),
    ("CopyRoomTask", "CopyRoom", 8),
    ("BoardRoomTask", "BoardRoom", 9),
    ("SanwichTask", "BreakRoom", 9);
    UPDATE Players SET Location = 4 WHERE Player_ID = 1;
    UPDATE NPC SET Location = 4 WHERE ID = 2;
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
-- insert for table `TBLTODO`
--
INSERT INTO TBLTime
    (Day, Hour)
VALUES
    (1, 8);
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
