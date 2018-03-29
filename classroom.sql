-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2016 at 06:58 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iba`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `ID` varchar(15) NOT NULL DEFAULT '',
  `PASSWORD` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `PASSWORD`) VALUES
('pollob', '1');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `batch_id` varchar(15) NOT NULL,
  `course1` varchar(15) DEFAULT NULL,
  `course2` varchar(15) DEFAULT NULL,
  `course3` varchar(15) DEFAULT NULL,
  `course4` varchar(15) DEFAULT NULL,
  `course5` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`batch_id`),
  KEY `f1_idx` (`course1`),
  KEY `f2_idx` (`course2`),
  KEY `f3_idx` (`course3`),
  KEY `f4_idx` (`course4`),
  KEY `f5_idx` (`course5`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batch_id`, `course1`, `course2`, `course3`, `course4`, `course5`) VALUES
('39', 'it3101', 'it3102', 'it3103', NULL, NULL),
('40', 'it2101', 'it2103', NULL, NULL, NULL),
('41', 'it1101', 'it1103', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` varchar(15) NOT NULL,
  `course_name` varchar(45) NOT NULL,
  `teacher_id` varchar(15) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `course_ibfk_1` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `teacher_id`) VALUES
('it1101', 'c', 'js'),
('it1103', 'math', 'ft'),
('it2101', 'java', 'sam'),
('it2103', 'algorithm', 'msk'),
('it3101', 'c#', 'sam'),
('it3102', 'c# lab', 'sam'),
('it3103', 'micro', 'msk');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `notice_id` int(11) NOT NULL AUTO_INCREMENT,
  `notice` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `notice`, `date`) VALUES
(2, 'polldfgj  uihd du  dsgu db hu dsnu dn ue dby sdnbu sdautar  asgdy as sut f asydt as b as  asyt asegyas  asvdta awgduys advywr vhasbgs tfawvds ftas asdftyfv dsa tf asdufasd ahsvasdhtfyashdvahd ydadasdya sduas dasdasyu', '2015-03-23 01:04:50'),
(4, 'xgsgdagdfgdfg', '2015-03-22 23:42:13'),
(5, 'hi tanji', '2015-03-23 01:04:55'),
(6, 'this section is maintained by the ultimate boss pollob. u are warned', '2015-03-22 23:52:21'),
(7, 'Working newly\r\n', '2016-08-16 22:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` varchar(15) NOT NULL,
  `student_name` varchar(45) NOT NULL,
  `batch` varchar(15) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `f1_idx` (`batch`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_name`, `batch`, `password`, `email`, `mobile`) VALUES
('123', 'asad', '40', '1', NULL, ''),
('1586', 'tonu', '41', '1', NULL, ''),
('1587', 'tanji', '41', '111', 'tanjila.tanji15@gmail.com', '01988284658'),
('23', 'leon', '39', '1', 'leonit@yahoo.com', '01726578765'),
('25', 'sajib', '39', '1', NULL, ''),
('2605', 'imran', '41', '1', 'polboy777@gmail.com', '01923482066'),
('7', 'seven', '39', '', NULL, ''),
('777', 'test', '41', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` varchar(15) NOT NULL,
  `batch_id` varchar(15) NOT NULL,
  `course_id` varchar(15) NOT NULL,
  `task_type` varchar(15) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `ta1_idx` (`teacher_id`),
  KEY `ta2_idx` (`batch_id`),
  KEY `ta3_idx` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `teacher_id`, `batch_id`, `course_id`, `task_type`, `title`, `content`, `date`) VALUES
(3, 'sam', '39', 'it3101', 'ass', 'sds', 'fd', '2015-03-05 00:00:00'),
(6, 'sam', '39', 'it3102', 'ass', 'i am edited ', 'asf', '2015-03-30 00:00:00'),
(30, 'ft', '41', 'it1103', 'exam', 'try1', '', '2015-12-31 00:00:00'),
(31, 'ft', '41', 'it1103', 'ass', 'sdfr', 'fgf', '2015-11-30 00:00:00'),
(32, 'js', '41', 'it1101', 'exam', 'jasmin task', '', '2015-03-04 00:10:17'),
(49, 'sam', '41', 'it3102', 'ass', 'today is a', '', '2015-03-18 00:00:00'),
(50, 'ft', '41', 'it1103', 'exam', 'fahima mam', '', '2015-03-15 00:00:00'),
(51, 'sam', '41', 'it3102', 'exam', '29 tarik', 'dddddd', '2015-03-31 00:00:00'),
(52, 'sam', '41', 'it3102', 'exam', '29 tarik', 'dddddd', '2015-03-10 02:00:00'),
(57, 'js', '41', 'it1101', 'exam', 'ami pol', 'sdf', '2015-03-05 00:00:00'),
(59, 'js', '41', 'it1101', 'ass', 'ghj', 'tt', '2015-03-26 00:00:00'),
(96, 'sam', '41', 'it2101', 'exam', 'rohul', '', '2015-03-01 21:00:00'),
(104, 'js', '39', 'it1101', 'exam', 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddd', NULL, '2015-03-10 23:08:00'),
(109, 'sam', '41', 'it2101', 'exam', 'pol is like a boss', 'xfgb', '2015-03-14 06:00:00'),
(110, 'sam', '41', 'it2101', 'exam', 'sas', '', '2015-03-22 01:00:00'),
(111, 'sam', '41', 'it2101', 'exam', 'bos1', 'fd', '2015-03-04 19:03:00'),
(112, 'sam', '41', 'it2101', 'ass', 'dg', '', '2015-03-11 19:10:00'),
(113, 'sam', '41', 'it3101', 'exam', 'fdf', '', '2015-03-25 05:00:00'),
(114, 'msk', '41', 'it2103', 'exam', 'new task', 'chapter 2 signal and', '2016-08-18 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` varchar(15) NOT NULL,
  `teacher_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_name`, `password`, `mobile`, `designation`, `email`) VALUES
('ft', 'fahima', '1', '4454', NULL, NULL),
('js', 'Jasmin Akter', '1', '01676025450', 'Assistant Professor', 'jasminit@gmail.com'),
('msk', 'kaiser', '1', NULL, NULL, NULL),
('sam', 'Shamim Al Mamun', '1', '01923482066', 'Assistant Professor', 'samiit@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `f1` FOREIGN KEY (`course1`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f2` FOREIGN KEY (`course2`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f3` FOREIGN KEY (`course3`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f4` FOREIGN KEY (`course4`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f5` FOREIGN KEY (`course5`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `s1` FOREIGN KEY (`batch`) REFERENCES `batch` (`batch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `ta1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ta2` FOREIGN KEY (`batch_id`) REFERENCES `batch` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ta3` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
