-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306

-- Generation Time: May 24, 2013 at 04:45 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `multichoice`
--

INSERT INTO `multichoice` (`MultiChoiceID`, `Question`, `Answer1`, `Answer2`, `Answer3`, `Answer4`, `TestID`, `correctAns`) VALUES
(1, 'How do you use an insert query in SQL', 'INSERT INTO ', 'INSERT NEW', 'ADD NEW', 'ADD RECORD', 2, '1'),
(2, 'How would you select all the columns from a table named "Persons"', 'SELECT [all] FROM Persons', 'SELECT *. Persons', 'SELECT * FROM Persons', 'SELECT Persons', 2, '3'),
(3, 'How do you select all the records from a table named "Persons" where the value of the column "FirstName" is "Peter"?', 'SELECT [all] FROM Persons WHERE Firstname = ''Peter''', 'SELECT * FROM Persons WHERE Firstname = ''Peter''', 'SELECT * FROM PERSONS WHERE FIRSTNAME<>''Peter''', 'SELECT [all] FROM PERSONS WHERE FIRSTNAME LIKE ''Peter''', 2, '2'),
(4, 'What does SQL stand for?', 'Strong Question Language', 'Structured Query Language', 'Structured Question Language', 'Strong query Language', 2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `ResultID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TestID` int(11) DEFAULT NULL,
  `Result` int(11) DEFAULT NULL,
  PRIMARY KEY (`ResultID`),
  KEY `userid` (`UserID`),
  KEY `testid` (`TestID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`ResultID`, `UserID`, `TestID`, `Result`) VALUES
(1, 4, 1, 50),
(2, 2, 2, 90),
(3, 10, 2, 60),
(4, 3, 3, 50);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectCode` varchar(50) NOT NULL,
  `SubjectName` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Dateupdated` date NOT NULL,
  PRIMARY KEY (`SubjectID`),
  KEY `FK_subject` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectID`, `SubjectCode`, `SubjectName`, `UserID`, `Dateupdated`) VALUES
(1, 'ICA50711', 'Diploma Of Software Development', 3, '2013-02-11'),
(2, 'ICA40511', 'Certificate IV in IT Programming', 5, '2013-04-09'),
(3, 'ICA50712', 'Introduction to Programming', 2, '2013-05-13'),
(4, 'ICA12345', 'Cert IV in Building & Constructions', 10, '2013-05-03'),
(5, 'CUV40303', 'Certificate IV in Design', 8, '2013-05-05'),
(6, 'CPC50210', 'Diploma of Building & Constructions', 9, '2013-05-03'),
(7, 'SIT40307', 'Certificate IV in Hospitality', 6, '2013-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `subtopic`
--

CREATE TABLE `subtopic` (
  `SubtopicID` int(11) NOT NULL AUTO_INCREMENT,
  `SubtopicName` varchar(50) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `TestID` int(11) NOT NULL,
  `SubtopicBriefDescription` text NOT NULL,
  `Content` text NOT NULL,
  `Downloads` int(11) NOT NULL,
  `DateUpdated` date NOT NULL,
  PRIMARY KEY (`SubtopicID`),
  KEY `FK_subtopic` (`TopicID`),
  KEY `FK_subtopicTest` (`TestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `subtopic`
--

INSERT INTO `subtopic` (`SubtopicID`, `SubtopicName`, `TopicID`, `TestID`, `SubtopicBriefDescription`, `Content`, `Downloads`, `DateUpdated`) VALUES
(1, 'Insert Query', 2, 2, 'Learn about the insert SQL query and how they are set up.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.\n\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.\n\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <br>', 5, '2013-05-17'),
(2, 'Connect To WebService', 3, 1, 'Learn how to connect to the web service and how to receive the data as a JSON string', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\n\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\n\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 5, '2013-03-15'),
(3, 'SQL Commands', 2, 2, 'Learn what the most frequently used sql commands are, how they''re used and the syntax when using them', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\n\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\n\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 1, '2013-05-17'),
(4, 'Android Emulator', 4, 1, 'Learn how to receive and display the received JSON data within an android emulator', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\n\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\n\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 10, '2013-03-05'),
(5, 'While loops', 7, 1, 'Learn how a while loop is used, what to use them for and what the syntax is when using a while loop', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\n\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\n\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 5, '2013-02-11'),
(6, 'Installation', 5, 1, 'Learn how to successfully install the SLIM Framework', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <br>', 0, '2013-05-17'),
(7, 'If Statements', 6, 1, 'Learn the syntax for an IF statement and how to successfully use it.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <br>', 0, '2013-05-17'),
(8, 'Dimension', 8, 1, 'Learn about how dimension affects the perspective of houses', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 0, '2013-05-17'),
(9, 'Switch Statement', 9, 1, 'Learn how to use a switch statement, and what syntax is used', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 0, '2013-05-17'),
(10, 'Input Types', 10, 2, 'Learn about the different input types that are used within HTML5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 0, '2013-05-17'),
(11, 'Functions', 11, 1, 'Learn how to create functions and how to implement them within a form', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 0, '2013-05-17'),
(12, 'Incorporate PHP in Ajax', 12, 2, 'Learn about how AJAX can be implemented to use PHP variables', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 0, '2013-05-17'),
(13, 'Post/Put/Delete/Insert', 1, 1, 'Learn the different cURL commands that will be used', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <br>', 2, '2013-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `TestID` int(11) NOT NULL AUTO_INCREMENT,
  `SubtopicID` int(11) NOT NULL,
  `Downloads` int(11) NOT NULL,
  PRIMARY KEY (`TestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`TestID`, `SubtopicID`, `Downloads`) VALUES
(1, 1, 0),
(2, 2, 3),
(3, 13, 5);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `TokenID` int(11) NOT NULL AUTO_INCREMENT,
  `TokenCode` varchar(20) NOT NULL,
  `TokenDate` date NOT NULL,
  PRIMARY KEY (`TokenID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`TokenID`, `TokenCode`, `TokenDate`) VALUES
(1, '10001', '2013-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `TopicID` int(5) NOT NULL AUTO_INCREMENT,
  `TopicName` varchar(50) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `deletionStatus` tinyint(1) NOT NULL COMMENT '0 = display, 1 = not display',
  `dateupdated` date NOT NULL,
  PRIMARY KEY (`TopicID`),
  KEY `FK_topicsub` (`SubjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`TopicID`, `TopicName`, `SubjectID`, `SubjectCode`, `deletionStatus`, `dateupdated`) VALUES
(1, 'cURL Commands', 1, 'ICT33A', 0, '2013-05-20'),
(2, 'SQL Query', 1, 'ICA50711', 0, '2013-05-17'),
(3, 'Restful WebService', 1, 'ICT31A', 0, '2013-05-17'),
(4, 'JSON Strings', 1, 'ICT33A', 0, '2013-05-17'),
(5, 'SLIM Framework', 1, 'ICT31A', 0, '2013-05-17'),
(6, 'Java', 3, 'ICA50712', 0, '2013-05-13'),
(7, 'Eclipse', 1, 'ICA50711', 1, '2013-05-20'),
(8, 'Architecture in Housing', 6, 'ICA123456', 0, '2013-05-05'),
(9, 'PHP', 3, 'ICA50712', 0, '2013-05-16'),
(10, 'HTML5', 2, 'ICT33A', 0, '2013-05-17'),
(11, 'jQuery Mobile', 2, 'ICA40511', 0, '2013-05-17'),
(12, 'Ajax', 2, 'ICA40511', 0, '2013-05-12'),
(13, 'Visual Basic', 3, 'ICA50712', 0, '2013-05-17'),
(14, 'Web Programming', 3, 'ICA50712', 0, '2013-05-17'),
(15, 'SQL Databases', 2, 'ICA40511', 0, '2013-05-17'),
(16, 'Games Programming', 2, 'ICA40511', 0, '2013-05-17'),
(17, 'Games 2', 2, 'ICA40511', 0, '2013-05-17'),
(18, 'OH&S', 7, 'SIT40307', 0, '2013-05-17'),
(19, 'Photo Imaging', 5, 'ICA40511', 0, '2013-05-17'),
(20, 'Customer Service', 7, 'SIT40307', 0, '2013-05-20');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `truefalse`
--

INSERT INTO `truefalse` (`TrueFalseID`, `Question`, `correctAns`, `TestID`) VALUES
(1, 'SQL Stands for Structed Question Language?', 'false', 2),
(2, 'PHP is server side programming?', 'true', 2);

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
  `locked` tinyint(1) NOT NULL COMMENT '0 = unlocked, 1 = locked',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `fName`, `lName`, `username`, `password`, `role`, `locked`) VALUES
(1, 'Kris', 'Vega', 'veg09287209', 'ef89a57af21aea63ec820373fd413c75', 1, 0),
(2, 'Alan', 'Schenk', 'sch01548357', 'ef89a57af21aea63ec820373fd413c75', 2, 0),
(3, 'Bill', 'Kaz', 'billk09540103', 'ef89a57af21aea63ec820373fd413c75', 3, 0),
(4, 'James', 'Smith', 'smit09468153', 'ef89a57af21aea63ec820373fd413c75', 4, 0),
(5, 'Mark', 'Jones', 'jon08134976', 'ef89a57af21aea63ec820373fd413c75', 3, 0),
(6, 'Adam', 'Francis', 'ada08136487', 'ef89a57af21aea63ec820373fd413c75', 3, 0),
(7, 'Glen', 'Holmes', 'hol12345678', 'ef89a57af21aea63ec820373fd413c75', 1, 0),
(8, 'Liam', 'Thompson', 'tom12345678', 'ef89a57af21aea63ec820373fd413c75', 2, 0),
(9, 'Jay', 'Chou', 'cho12345678', 'ef89a57af21aea63ec820373fd413c75', 2, 0),
(10, 'Stuart', 'Little', 'lit12345678', 'ef89a57af21aea63ec820373fd413c75', 4, 0);

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
-- Dumping data for table `usersubject`
--

INSERT INTO `usersubject` (`userID`, `SubjectID`) VALUES
(4, 2),
(10, 1);

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
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `FK_resultsTest` FOREIGN KEY (`TestID`) REFERENCES `test` (`TestID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_results` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `FK_subject` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD CONSTRAINT `FK_subtopic` FOREIGN KEY (`TopicID`) REFERENCES `topic` (`TopicID`),
  ADD CONSTRAINT `FK_subtopicTest` FOREIGN KEY (`TestID`) REFERENCES `test` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `FK_resulttest` FOREIGN KEY (`TestID`) REFERENCES `results` (`testid`) ON UPDATE CASCADE;

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
