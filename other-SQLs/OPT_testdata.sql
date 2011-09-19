-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2009 at 08:30 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opt`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity`
--

CREATE TABLE IF NOT EXISTS `tblactivity` (
  `intActivityID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intActivityTypeID` int(10) unsigned NOT NULL,
  `strActivityDetails` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`intActivityID`),
  KEY `tblActivity_FKIndex2` (`intActivityTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblactivity`
--

INSERT INTO `tblactivity` (`intActivityID`, `intActivityTypeID`, `strActivityDetails`) VALUES
(1, 3, 'Initial Prototype'),
(2, 4, 'SRS'),
(3, 1, 'General tasks, e.g. email, timesheet, printing etc.'),
(4, 8, 'read PHP, MySQL and Apache notes & books'),
(5, 7, 'with teachers'),
(8, 8, 'ICAI5187 Authentication and sescurity wiki notes'),
(9, 5, 'coding'),
(10, 1, 'prepare for technical presentation');

-- --------------------------------------------------------

--
-- Table structure for table `tblactivitycommitment`
--

CREATE TABLE IF NOT EXISTS `tblactivitycommitment` (
  `intTimesheetID` int(10) unsigned NOT NULL,
  `intActivityID` int(10) unsigned NOT NULL,
  `dtmActivityDate` date NOT NULL,
  `fltActivityHours` float DEFAULT NULL,
  PRIMARY KEY (`dtmActivityDate`,`intActivityID`,`intTimesheetID`),
  KEY `tblActivityCommitment_FKIndex1` (`intActivityID`),
  KEY `tblActivityCommitment_FKIndex2` (`intTimesheetID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblactivitycommitment`
--

INSERT INTO `tblactivitycommitment` (`intTimesheetID`, `intActivityID`, `dtmActivityDate`, `fltActivityHours`) VALUES
(8, 1, '2009-07-13', 0.5),
(8, 1, '2009-07-14', 2),
(8, 2, '2009-07-14', 1.5),
(61, 3, '2009-11-09', 1),
(61, 4, '2009-11-09', 1),
(61, 8, '2009-11-09', 0),
(61, 9, '2009-11-09', 7),
(61, 3, '2009-11-10', 0.5),
(61, 4, '2009-11-10', 3),
(61, 5, '2009-11-10', 1.5),
(61, 9, '2009-11-10', 3),
(61, 9, '2009-11-11', 6),
(61, 3, '2009-11-12', 0.5),
(61, 9, '2009-11-12', 7),
(61, 9, '2009-11-13', 7),
(61, 9, '2009-11-14', 4),
(61, 10, '2009-11-14', 1),
(61, 3, '2009-11-15', 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `tblactivitytype`
--

CREATE TABLE IF NOT EXISTS `tblactivitytype` (
  `intActivityTypeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strActivityType` varchar(50) NOT NULL,
  PRIMARY KEY (`intActivityTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblactivitytype`
--

INSERT INTO `tblactivitytype` (`intActivityTypeID`, `strActivityType`) VALUES
(1, 'Project Admin'),
(2, 'Project Management'),
(3, 'Analysis & Design'),
(4, 'Documentation'),
(5, 'Implementation'),
(6, 'Testing'),
(7, 'Meeting'),
(8, 'Training');

-- --------------------------------------------------------

--
-- Table structure for table `tblclient`
--

CREATE TABLE IF NOT EXISTS `tblclient` (
  `intClientID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strClientName` varchar(50) NOT NULL DEFAULT '',
  `strClientAddress` varchar(200) DEFAULT NULL,
  `strClientPhone` varchar(10) DEFAULT NULL,
  `strClientEmail` varchar(50) DEFAULT NULL,
  `strClientMobile` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`intClientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblclient`
--

INSERT INTO `tblclient` (`intClientID`, `strClientName`, `strClientAddress`, `strClientPhone`, `strClientEmail`, `strClientMobile`) VALUES
(1, 'Jude Rus', 'Red Cross, 23-47 Villiers St, NORTH MELBOURNE, VIC 3051 ', '83277773', 'jrus@redcross.org.au', '0409513793'),
(2, 'David Mackieson', 'MITUP', NULL, NULL, NULL),
(3, 'Brad Drury', 'New Touch Laser Cutting, 43 Malvern Street, Bayswater, VIC 3153', NULL, 'brad@newtouchlaser.com.au', NULL),
(4, 'James Hallinan', 'Swinburne University TAFE Division\r\n369 Stud Road, Wantirna VIC 3152', '92101194', 'jhallinan@swin.edu.au', '0414712492');

-- --------------------------------------------------------

--
-- Table structure for table `tblenvironment`
--

CREATE TABLE IF NOT EXISTS `tblenvironment` (
  `intEnvironmentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strEnvironmentName` varchar(50) NOT NULL,
  PRIMARY KEY (`intEnvironmentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblenvironment`
--

INSERT INTO `tblenvironment` (`intEnvironmentID`, `strEnvironmentName`) VALUES
(1, 'Software/Website Development'),
(2, 'Networking'),
(3, 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE IF NOT EXISTS `tblgroup` (
  `intGroupID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strGroupCode` varchar(25) NOT NULL,
  `strGroupName` varchar(50) NOT NULL,
  PRIMARY KEY (`intGroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`intGroupID`, `strGroupCode`, `strGroupName`) VALUES
(1, 'WANCW1S1', 'Wantirna SWD Yr 1 Sem 1'),
(2, 'WANCW1S2', 'Wantirna SWD Yr 1 Sem 2'),
(3, 'WANCW2S1', 'Wantirna SWD Yr 2 Sem 1'),
(4, 'WANCW2S2', 'Wantirna SWD Yr 2 Sem 2'),
(5, 'LILCL1S1', 'Lilydale SWD Yr 1 Sem 1'),
(6, 'LILCL1S2', 'Lilydale SWD Yr 1 Sem 2'),
(7, 'LILCL2S1', 'Lilydale SWD Yr 2 Sem 1'),
(8, 'LILCL2S2', 'Lilydale SWD Yr 2 Sem 2');

-- --------------------------------------------------------

--
-- Table structure for table `tblmentor`
--

CREATE TABLE IF NOT EXISTS `tblmentor` (
  `intMentorID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strMentorLastName` varchar(25) NOT NULL DEFAULT '',
  `strMentorFirstName` varchar(25) NOT NULL DEFAULT '',
  `strMentorEmail` varchar(50) DEFAULT NULL,
  `strMentorPhone` varchar(10) DEFAULT NULL,
  `strMentorMobile` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`intMentorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblmentor`
--

INSERT INTO `tblmentor` (`intMentorID`, `strMentorLastName`, `strMentorFirstName`, `strMentorEmail`, `strMentorPhone`, `strMentorMobile`) VALUES
(1, 'White', 'Graeme', 'GRAEMEWHITE@groupwise.swin.edu.au', '92141176', '0409706039'),
(2, 'Lovell', 'Ursula', 'ULovell@groupwise.swin.edu.au', NULL, NULL),
(3, 'Ganly', 'Tony', 'TGanly@groupwise.swin.edu.au', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblproject`
--

CREATE TABLE IF NOT EXISTS `tblproject` (
  `intProjectID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intClientID` int(10) unsigned NOT NULL,
  `intEnvironmentID` int(10) unsigned NOT NULL,
  `strProjectName` varchar(50) NOT NULL,
  `dtmProjectStartDate` date DEFAULT NULL,
  `dtmProjectEndDate` date DEFAULT NULL,
  PRIMARY KEY (`intProjectID`),
  KEY `tblProject_FKIndex1` (`intEnvironmentID`),
  KEY `tblProject_FKIndex2` (`intClientID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblproject`
--

INSERT INTO `tblproject` (`intProjectID`, `intClientID`, `intEnvironmentID`, `strProjectName`, `dtmProjectStartDate`, `dtmProjectEndDate`) VALUES
(1, 1, 1, 'Red Cross Admin System', '2009-07-13', NULL),
(2, 2, 1, 'MITUP', '2009-07-13', NULL),
(3, 3, 1, 'New Touch Laser Software', '2009-07-13', NULL),
(4, 4, 1, 'Online Project Timesheets', '2009-08-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblproject_team`
--

CREATE TABLE IF NOT EXISTS `tblproject_team` (
  `intProject_TeamID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intMentorID` int(10) unsigned NOT NULL,
  `intTeamID` int(10) unsigned NOT NULL,
  `intProjectID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`intProject_TeamID`),
  KEY `tblProject_Team_FKIndex1` (`intProjectID`),
  KEY `tblProject_Team_FKIndex2` (`intTeamID`),
  KEY `tblProject_Team_FKIndex3` (`intMentorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblproject_team`
--

INSERT INTO `tblproject_team` (`intProject_TeamID`, `intMentorID`, `intTeamID`, `intProjectID`) VALUES
(1, 1, 1, 1),
(2, 1, 4, 4),
(3, 2, 2, 2),
(4, 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblreports`
--

CREATE TABLE IF NOT EXISTS `tblreports` (
  `strReportName` varchar(30) NOT NULL,
  `strReportType` varchar(30) NOT NULL,
  `strPHPfile` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`strReportName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tblreports`
--

INSERT INTO `tblreports` (`strReportName`, `strReportType`, `strPHPfile`) VALUES
('Team Summary', 'Summary Report', 'teamSummary.php');

-- --------------------------------------------------------

--
-- Table structure for table `tblresource`
--

CREATE TABLE IF NOT EXISTS `tblresource` (
  `intResourceID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intGroupID` int(10) unsigned NOT NULL,
  `strResourceLastName` varchar(25) NOT NULL,
  `strResourceFirstName` varchar(25) NOT NULL DEFAULT '',
  `strResourceCode` varchar(25) DEFAULT NULL,
  `strResourcePhone` varchar(10) DEFAULT NULL,
  `strResourceEmail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intResourceID`),
  KEY `tblResource_FKIndex1` (`intGroupID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tblresource`
--

INSERT INTO `tblresource` (`intResourceID`, `intGroupID`, `strResourceLastName`, `strResourceFirstName`, `strResourceCode`, `strResourcePhone`, `strResourceEmail`) VALUES
(1, 4, 'Vandoorn', 'Adam', '6109373', NULL, '6109373@swin.edu.au'),
(2, 8, 'Wallace', 'Jared', '6330797', NULL, '6330797@swin.edu.au'),
(3, 4, 'Buckle', 'Will', '6317871', NULL, '6317871@swin.edu.au'),
(4, 4, 'Grover', 'Kellie', '220312x', NULL, '220312x@swin.edu.au'),
(5, 8, 'Crampton', 'Josh', '6330843', NULL, '6330843@swin.edu.au'),
(6, 4, 'Mok', 'Karen', '6088732', 'NULL', '6088732@swin.edu.au'),
(7, 4, 'Bainbridge', 'Andrea', NULL, NULL, NULL),
(8, 8, 'Rush', 'Kevin', '4530365', NULL, '4530365@swin.edu.au'),
(9, 8, 'Cunningham', 'Brenton', '633080', NULL, '633080@swin.edu.au'),
(11, 8, 'Leonard', 'Justine', '633107', NULL, '633107@swin.edu.au'),
(12, 4, 'Rae', 'Sean', NULL, NULL, NULL),
(13, 4, 'Killingback', 'Greg', NULL, NULL, NULL),
(14, 8, 'Hayes', 'Greg', NULL, NULL, NULL),
(15, 8, 'Wheater', 'Shaun', NULL, NULL, NULL),
(16, 8, 'Warner', 'Fiona', NULL, NULL, NULL),
(17, 4, 'Johnson', 'Luke', NULL, NULL, NULL),
(18, 8, 'Walker', 'Rae', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblteam`
--

CREATE TABLE IF NOT EXISTS `tblteam` (
  `intTeamID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strTeamName` varchar(50) NOT NULL,
  `strTeamLeader` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intTeamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblteam`
--

INSERT INTO `tblteam` (`intTeamID`, `strTeamName`, `strTeamLeader`) VALUES
(1, 'SwinCross', 'Adam Vandoorn'),
(2, 'P.T.S.', 'Kevin Rush'),
(3, 'LaserWatch', 'Shaun Wheater'),
(4, 'OPT', 'Karen Mok');

-- --------------------------------------------------------

--
-- Table structure for table `tblteam_resource`
--

CREATE TABLE IF NOT EXISTS `tblteam_resource` (
  `intTeam_ResourceID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intResourceID` int(10) unsigned NOT NULL,
  `intTeamID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`intTeam_ResourceID`),
  KEY `tblTeam_Resource_FKIndex1` (`intTeamID`),
  KEY `tblTeam_Resource_FKIndex2` (`intResourceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblteam_resource`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbltimesheet`
--

CREATE TABLE IF NOT EXISTS `tbltimesheet` (
  `intTimesheetID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intProject_TeamID` int(10) unsigned NOT NULL,
  `intResourceID` int(10) unsigned NOT NULL,
  `intWeekNumber` int(2) unsigned DEFAULT NULL,
  `dtmStartDate` date NOT NULL,
  `floatTotalHours` float DEFAULT NULL,
  `blnSubmitted` tinyint(1) DEFAULT NULL,
  `blnApprovedByLeader` tinyint(1) DEFAULT NULL,
  `blnApprovedByMentor` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`intTimesheetID`),
  KEY `tblTimesheet_FKIndex1` (`intResourceID`),
  KEY `tblTimesheet_FKIndex2` (`intProject_TeamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100 ;

--
-- Dumping data for table `tbltimesheet`
--

INSERT INTO `tbltimesheet` (`intTimesheetID`, `intProject_TeamID`, `intResourceID`, `intWeekNumber`, `dtmStartDate`, `floatTotalHours`, `blnSubmitted`, `blnApprovedByLeader`, `blnApprovedByMentor`) VALUES
(3, 1, 1, 1, '2009-07-13', 20.5, 0, 0, 0),
(4, 1, 4, 1, '2009-07-13', 28.25, 0, 0, 0),
(5, 1, 5, 1, '2009-07-13', 32, 0, 0, 0),
(6, 1, 3, 1, '2009-07-13', 29.5, 0, 0, 0),
(7, 1, 2, 1, '2009-07-13', 28, 0, 0, 0),
(8, 1, 6, 1, '2009-07-13', 36.5, 0, 0, 0),
(10, 1, 1, 2, '2009-07-20', 31.5, 0, 0, 0),
(11, 1, 4, 2, '2009-07-20', 31, 0, 0, 0),
(12, 1, 5, 2, '2009-07-20', 32.5, 0, 0, 0),
(13, 1, 3, 2, '2009-07-20', 32, 0, 0, 0),
(14, 1, 2, 2, '2009-07-20', 29.5, 0, 0, 0),
(15, 1, 6, 2, '2009-07-20', 41, 0, 0, 0),
(22, 1, 1, 3, '2009-07-27', 28, 0, 0, 0),
(23, 1, 4, 3, '2009-07-27', 30.3, 0, 0, 0),
(24, 1, 5, 3, '2009-07-27', 31, 0, 0, 0),
(25, 1, 3, 3, '2009-07-27', 26, 0, 0, 0),
(26, 1, 2, 3, '2009-07-27', 32, 0, 0, 0),
(27, 1, 6, 3, '2009-07-27', 30.5, 0, 0, 0),
(28, 1, 1, 4, '2009-08-03', 25, 0, 0, 0),
(29, 1, 4, 4, '2009-08-03', 29.5, 0, 0, 0),
(30, 1, 5, 4, '2009-08-03', 30, 0, 0, 0),
(31, 1, 3, 4, '2009-08-03', 27.5, 0, 0, 0),
(32, 1, 2, 4, '2009-08-03', 28.5, 0, 0, 0),
(33, 1, 6, 4, '2009-08-03', 38, 0, 0, 0),
(34, 1, 1, 5, '2009-08-10', 29.5, 0, 0, 0),
(35, 1, 4, 5, '2009-08-10', 24.5, 0, 0, 0),
(36, 1, 5, 5, '2009-08-10', 23, 0, 0, 0),
(37, 1, 3, 5, '2009-08-10', 19, 0, 0, 0),
(38, 1, 2, 5, '2009-08-10', 23.5, 0, 0, 0),
(39, 1, 6, 5, '2009-08-10', 21.5, 0, 0, 0),
(40, 1, 1, 6, '2009-08-17', 24, 0, 0, 0),
(41, 1, 4, 6, '2009-08-17', 24, 0, 0, 0),
(42, 1, 5, 6, '2009-08-17', 25, 0, 0, 0),
(43, 1, 3, 6, '2009-08-17', 21.5, 0, 0, 0),
(44, 1, 2, 6, '2009-08-17', 26.5, 0, 0, 0),
(45, 1, 6, 6, '2009-08-17', 26.5, 0, 0, 0),
(47, 2, 7, 15, '2009-11-02', 30, 0, 0, 0),
(50, 2, 6, 15, '2009-11-02', 40, 0, 0, 0),
(51, 2, 6, 17, '2009-11-16', 37.5, 0, 0, 0),
(52, 2, 6, 7, '2009-08-24', 14.5, 0, 0, 0),
(53, 2, 6, 8, '2009-08-31', 26.5, 0, 0, 0),
(54, 2, 6, 9, '2009-09-07', 30, 0, 0, 0),
(56, 2, 6, 10, '2009-09-14', 28, 0, 0, 0),
(57, 2, 6, 11, '2009-10-05', 38, 0, 0, 0),
(58, 2, 6, 12, '2009-10-12', 28, 0, 0, 0),
(59, 2, 6, 13, '2009-10-19', 28, 0, 0, 0),
(60, 2, 6, 14, '2009-10-26', 21, 0, 0, 0),
(61, 2, 6, 16, '2009-11-09', 43, 0, 0, 0),
(63, 2, 6, 18, '2009-11-23', NULL, 0, 0, 0),
(64, 1, 1, 7, '2009-08-24', 27, 0, 0, 0),
(65, 1, 1, 8, '2009-08-31', 29, 0, 0, 0),
(66, 1, 1, 9, '2009-09-07', 28, 0, 0, 0),
(67, 1, 1, 10, '2009-09-14', 28, 0, 0, 0),
(68, 1, 1, 11, '2009-10-05', 47, 0, 0, 0),
(69, 1, 4, 7, '2009-08-24', 22.5, 0, 0, 0),
(70, 1, 4, 8, '2009-08-31', 28.75, 0, 0, 0),
(71, 1, 4, 9, '2009-09-07', 23, 0, 0, 0),
(72, 1, 4, 10, '2009-09-14', 32, 0, 0, 0),
(73, 1, 4, 11, '2009-10-05', 20, 0, 0, 0),
(74, 1, 5, 7, '2009-08-24', 24, 0, 0, 0),
(75, 1, 5, 8, '2009-08-31', 29, 0, 0, 0),
(76, 1, 5, 9, '2009-09-07', 27.5, 0, 0, 0),
(77, 1, 5, 10, '2009-09-14', 26, 0, 0, 0),
(78, 1, 5, 11, '2009-10-05', 69, 0, 0, 0),
(79, 1, 3, 11, '2009-10-05', 35.5, 0, 0, 0),
(80, 1, 3, 7, '2009-08-24', 25.5, 0, 0, 0),
(81, 1, 3, 8, '2009-08-31', 25.5, 0, 0, 0),
(82, 1, 3, 9, '2009-09-07', 23, 0, 0, 0),
(83, 1, 3, 10, '2009-09-14', 32, 0, 0, 0),
(84, 1, 2, 7, '2009-08-24', 24, 0, 0, 0),
(85, 1, 2, 8, '2009-08-31', 28, 0, 0, 0),
(86, 1, 2, 9, '2009-09-07', 25, 0, 0, 0),
(87, 1, 2, 10, '2009-09-14', 32, 0, 0, 0),
(88, 1, 2, 11, '2009-10-05', 40.5, 0, 0, 0),
(89, 2, 7, 16, '2009-11-09', 30, 0, 0, 0),
(90, 3, 8, 1, '2009-07-13', 33, 0, 0, 0),
(91, 3, 9, 1, '2009-07-13', 29.25, 0, 0, 0),
(92, 3, 11, 1, '2009-07-13', 25, 0, 0, 0),
(93, 3, 12, 1, '2009-07-13', 25, 0, 0, 0),
(94, 3, 13, 1, '2009-07-13', 32.5, 0, 0, 0),
(95, 3, 14, 1, '2009-07-13', 0, 0, 0, 0),
(96, 4, 15, 1, '2009-07-13', 33.3, 0, 0, 0),
(97, 4, 16, 1, '2009-07-13', 31.5, 0, 0, 0),
(98, 4, 17, 1, '2009-07-13', 27.5, 0, 0, 0),
(99, 4, 18, 1, '2009-07-13', 36, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `strUsername` varchar(30) NOT NULL,
  `strPassword` varchar(32) NOT NULL,
  `intLevel` int(11) NOT NULL DEFAULT '0',
  `intResourceID` int(10) DEFAULT NULL,
  PRIMARY KEY (`strUsername`),
  KEY `tblusers` (`intResourceID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`strUsername`, `strPassword`, `intLevel`, `intResourceID`) VALUES
('andrea', '5991ec6e95f3a6497a29d83c5a2d8bfd', 1, 7),
('karen', 'd1084b81019b9d544a5ef89392a77ebc', 0, 6),
('teacher', '098f6bcd4621d373cade4e832627b4f6', 3, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblactivity`
--
ALTER TABLE `tblactivity`
  ADD CONSTRAINT `tblActivity_ibfk_1` FOREIGN KEY (`intActivityTypeID`) REFERENCES `tblactivitytype` (`intActivityTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblactivitycommitment`
--
ALTER TABLE `tblactivitycommitment`
  ADD CONSTRAINT `tblActivityCommitment_ibfk_1` FOREIGN KEY (`intActivityID`) REFERENCES `tblactivity` (`intActivityID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblActivityCommitment_ibfk_2` FOREIGN KEY (`intTimesheetID`) REFERENCES `tbltimesheet` (`intTimesheetID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblproject`
--
ALTER TABLE `tblproject`
  ADD CONSTRAINT `tblProject_ibfk_1` FOREIGN KEY (`intEnvironmentID`) REFERENCES `tblenvironment` (`intEnvironmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblProject_ibfk_2` FOREIGN KEY (`intClientID`) REFERENCES `tblclient` (`intClientID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblproject_team`
--
ALTER TABLE `tblproject_team`
  ADD CONSTRAINT `tblProject_Team_ibfk_1` FOREIGN KEY (`intProjectID`) REFERENCES `tblproject` (`intProjectID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblProject_Team_ibfk_2` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblProject_Team_ibfk_3` FOREIGN KEY (`intMentorID`) REFERENCES `tblmentor` (`intMentorID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblresource`
--
ALTER TABLE `tblresource`
  ADD CONSTRAINT `tblResource_ibfk_1` FOREIGN KEY (`intGroupID`) REFERENCES `tblgroup` (`intGroupID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblteam_resource`
--
ALTER TABLE `tblteam_resource`
  ADD CONSTRAINT `tblTeam_Resource_ibfk_1` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblTeam_Resource_ibfk_2` FOREIGN KEY (`intResourceID`) REFERENCES `tblresource` (`intResourceID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbltimesheet`
--
ALTER TABLE `tbltimesheet`
  ADD CONSTRAINT `tblTimesheet_ibfk_1` FOREIGN KEY (`intResourceID`) REFERENCES `tblresource` (`intResourceID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tblTimesheet_ibfk_2` FOREIGN KEY (`intProject_TeamID`) REFERENCES `tblproject_team` (`intProject_TeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
