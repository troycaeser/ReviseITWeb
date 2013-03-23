-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306

-- Generation Time: Mar 08, 2013 at 05:06 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reviseit`
--

-- --------------------------------------------------------

--
-- Table structure for table `helpmob`
--

CREATE TABLE `helpmob` (
  `TopicMobID` int(11) NOT NULL AUTO_INCREMENT,
  `Topic` varchar(60) NOT NULL,
  `Subtopic` varchar(20) NOT NULL,
  `Content` text NOT NULL,
  `Links` text NOT NULL,
  `DateUpdated` date NOT NULL,
  PRIMARY KEY (`TopicMobID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `helpweb`
--

CREATE TABLE `helpweb` (
  `TopicHelpID` int(11) NOT NULL AUTO_INCREMENT,
  `Topic` varchar(60) NOT NULL,
  `Subtopic` varchar(20) NOT NULL,
  `Content` text NOT NULL,
  `Links` text NOT NULL,
  PRIMARY KEY (`TopicHelpID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImageName` int(11) NOT NULL,
  `ImageLink` mediumblob NOT NULL,
  `SubtopicID` int(11) NOT NULL,
  PRIMARY KEY (`ImageID`),
  KEY `FK_image` (`SubtopicID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `multichoice`
--

CREATE TABLE `multichoice` (
  `MultiChoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  `Answer1` text NOT NULL,
  `Answer2` text NOT NULL,
  `Answer3` text NOT NULL,
  `Answer4` text NOT NULL,
  `TestID` int(11) NOT NULL,
  `correctAns` varchar(10) NOT NULL,
  PRIMARY KEY (`MultiChoiceID`),
  KEY `FK_multichoice` (`TestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectID` int(11) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `SubjectName` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Dateupdated` date NOT NULL,
  PRIMARY KEY (`SubjectID`),
  KEY `FK_subject` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subtopic`
--

CREATE TABLE `subtopic` (
  `SubtopicID` int(11) NOT NULL AUTO_INCREMENT,
  `SubtopicName` varchar(50) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `Content` text NOT NULL,
  `Downloads` int(11) NOT NULL,
  `DateUpdated` date NOT NULL,
  PRIMARY KEY (`SubtopicID`),
  KEY `FK_subtopic` (`TopicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `TestID` int(11) NOT NULL AUTO_INCREMENT,
  `SubtopicID` int(11) NOT NULL,
  `Downloads` int(11) NOT NULL,
  PRIMARY KEY (`TestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `TokenID` int(11) NOT NULL AUTO_INCREMENT,
  `TokenCode` varchar(20) NOT NULL,
  `TokenDate` date NOT NULL,
  PRIMARY KEY (`TokenID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `TopicID` int(5) NOT NULL AUTO_INCREMENT,
  `TopicName` varchar(50) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `SubjectCode` int(5) NOT NULL,
  PRIMARY KEY (`TopicID`),
  KEY `FK_topic` (`SubjectCode`),
  KEY `FK_topicsub` (`SubjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `truefalse`
--

CREATE TABLE `truefalse` (
  `TrueFalseID` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  `correctAns` varchar(10) NOT NULL,
  `TestID` int(11) NOT NULL,
  PRIMARY KEY (`TrueFalseID`),
  KEY `FK_truefalse` (`TestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(1) NOT NULL COMMENT '1 = Admin, 2 = Coordinator, 3 = Teacher, 4 = Student',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `fName`, `lName`, `username`, `password`, `role`) VALUES
(1, 'Kris', 'Vega', 'veg09287209', 'eclipse50', 1),
(2, 'Alan', 'Schenk', 'sch01548357', 'tafe123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `usersubject`
--

CREATE TABLE `usersubject` (
  `userID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  KEY `FK_usersubject` (`userID`),
  KEY `FK_subjectuser` (`SubjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_image` FOREIGN KEY (`SubtopicID`) REFERENCES `subtopic` (`SubtopicID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `multichoice`
--
ALTER TABLE `multichoice`
  ADD CONSTRAINT `FK_multichoice` FOREIGN KEY (`TestID`) REFERENCES `test` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `FK_subject` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD CONSTRAINT `FK_subtopic` FOREIGN KEY (`TopicID`) REFERENCES `topic` (`TopicID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `FK_test` FOREIGN KEY (`TestID`) REFERENCES `subtopic` (`TopicID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `FK_topicsub` FOREIGN KEY (`SubjectID`) REFERENCES `subject` (`SubjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `truefalse`
--
ALTER TABLE `truefalse`
  ADD CONSTRAINT `FK_truefalse` FOREIGN KEY (`TestID`) REFERENCES `test` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersubject`
--
ALTER TABLE `usersubject`
  ADD CONSTRAINT `FK_subjectuser` FOREIGN KEY (`SubjectID`) REFERENCES `subject` (`SubjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_usersubject` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
