-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306

-- Generation Time: Aug 23, 2011 at 08:10 PM
-- Server version: 5.5.15
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `opadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblGlobalissue`
--

CREATE TABLE `tblGlobalissue` (
  `intGlobalissueID` int(11) NOT NULL AUTO_INCREMENT,
  `intProjectID` int(11) DEFAULT NULL,
  `intIssueID` int(11) DEFAULT NULL,
  `intRiskID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intGlobalissueID`),
  KEY `FK_tblGlobalissue_tblProject` (`intProjectID`),
  KEY `FK_tblGlobalissue_tblIssue` (`intIssueID`),
  KEY `FK_tblGlobalissue_tblRisk` (`intRiskID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblGlobalissue`
--

INSERT INTO `tblGlobalissue` (`intGlobalissueID`, `intProjectID`, `intIssueID`, `intRiskID`) VALUES
(1, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblIssue`
--

CREATE TABLE `tblIssue` (
  `intIssueID` int(11) NOT NULL AUTO_INCREMENT,
  `strIssueDescription` varchar(256) DEFAULT NULL,
  `dmtIssueRequirementFinishDate` date DEFAULT NULL,
  `intIssueRating` int(11) DEFAULT NULL,
  `strIssueOutcome` varchar(20) DEFAULT NULL,
  `strIssueAssignedTo` varchar(256) DEFAULT NULL,
  `strIssueStatusCondition` varchar(20) DEFAULT NULL,
  `dmtIssueDateRaised` date DEFAULT NULL,
  `dmtIssueDateClosed` date DEFAULT NULL,
  `strIssueType` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`intIssueID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblProject`
--

CREATE TABLE `tblProject` (
  `intProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `strProjectName` varchar(50) DEFAULT NULL,
  `strProjectSponsor` varchar(50) DEFAULT NULL,
  `strProjectAddress` varchar(50) DEFAULT NULL,
  `strProjectSuburb` varchar(30) DEFAULT NULL,
  `strProjectState` varchar(3) DEFAULT NULL,
  `intProjectPostcode` int(11) DEFAULT NULL,
  `strProjectPhone` varchar(12) DEFAULT NULL,
  `strProjectMobile` varchar(12) DEFAULT NULL,
  `strProjectEmail` varchar(50) DEFAULT NULL,
  `strProjectDescription` varchar(100) DEFAULT NULL,
  `dtmProjectStartDate` date DEFAULT NULL,
  `dtmProjectEndDate` date DEFAULT NULL,
  PRIMARY KEY (`intProjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblProject`
--

INSERT INTO `tblProject` (`intProjectID`, `strProjectName`, `strProjectSponsor`, `strProjectAddress`, `strProjectSuburb`, `strProjectState`, `intProjectPostcode`, `strProjectPhone`, `strProjectMobile`, `strProjectEmail`, `strProjectDescription`, `dtmProjectStartDate`, `dtmProjectEndDate`) VALUES
(1, 'Red Cross Admin System', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-07-13', NULL),
(2, 'MITUP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-07-13', NULL),
(3, 'New Touch Laser Software', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-07-13', NULL),
(4, 'Online Project Timesheets', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-08-24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblRisk`
--

CREATE TABLE `tblRisk` (
  `intRiskID` int(11) NOT NULL AUTO_INCREMENT,
  `intRiskAssignedTo` int(11) DEFAULT NULL,
  `intRiskStatusCondition` int(11) DEFAULT NULL,
  `intRiskDateRaised` date DEFAULT NULL,
  `intRiskDateClosed` date DEFAULT NULL,
  `strRiskDescription` varchar(256) DEFAULT NULL,
  `intRiskImpactDescription` varchar(4096) DEFAULT NULL,
  `intRiskLevelOfImpact` varchar(256) DEFAULT NULL,
  `intRiskConsequenceOfImpact` varchar(256) DEFAULT NULL,
  `intRiskMitigationStrategy` varchar(4096) DEFAULT NULL,
  `intRiskContingencyStrategy` varchar(4096) DEFAULT NULL,
  `strRiskType` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`intRiskID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblRisk`
--

INSERT INTO `tblRisk` (`intRiskID`, `intRiskAssignedTo`, `intRiskStatusCondition`, `intRiskDateRaised`, `intRiskDateClosed`, `strRiskDescription`, `intRiskImpactDescription`, `intRiskLevelOfImpact`, `intRiskConsequenceOfImpact`, `intRiskMitigationStrategy`, `intRiskContingencyStrategy`, `strRiskType`) VALUES
(1, NULL, NULL, NULL, NULL, 'newRisk1', NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, 'newRisk2', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblRole`
--

CREATE TABLE `tblRole` (
  `intRoleID` int(11) NOT NULL AUTO_INCREMENT,
  `strRoleName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`intRoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblStatus`
--

CREATE TABLE `tblStatus` (
  `intStatusID` int(11) NOT NULL AUTO_INCREMENT,
  `intProjectID` int(11) DEFAULT NULL,
  `strStatusName` varchar(50) DEFAULT NULL,
  `intStatusTeamMemberID` int(11) DEFAULT NULL,
  `dmtStatusCurrentDate` date DEFAULT NULL,
  `strStatusCondition` varchar(256) DEFAULT NULL,
  `strStatusActual` varchar(256) DEFAULT NULL,
  `strStatusDifference` varchar(256) DEFAULT NULL,
  `strStatusWhy` varchar(256) DEFAULT NULL,
  `strStatusLinkName` varchar(50) DEFAULT NULL,
  `strStatusLink` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intStatusID`),
  KEY `FK_tblStatus_tblProject` (`intProjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblTeam`
--

CREATE TABLE `tblTeam` (
  `intTeamID` int(11) NOT NULL AUTO_INCREMENT,
  `strTeamName` varchar(50) NOT NULL,
  `strTeamLeader` varchar(50) DEFAULT NULL,
  `intCourseID` int(11) DEFAULT NULL,
  `strSiteURL` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`intTeamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblTeam`
--

INSERT INTO `tblTeam` (`intTeamID`, `strTeamName`, `strTeamLeader`, `intCourseID`, `strSiteURL`) VALUES
(1, 'SwinCross', 'Adam Vandoorn', NULL, NULL),
(2, 'P.T.S.', 'Kevin Rush', NULL, NULL),
(3, 'LaserWatch', 'Shaun Wheater', NULL, NULL),
(4, 'OPT', 'Karen Mok', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblTeamMember`
--

CREATE TABLE `tblTeamMember` (
  `intTeamMemberID` int(11) NOT NULL AUTO_INCREMENT,
  `intUserID` int(11) DEFAULT NULL,
  `intRoleID` int(11) DEFAULT NULL,
  `intTeamID` int(11) DEFAULT NULL,
  `intTeamMemberGlobalissueID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intTeamMemberID`),
  KEY `FK_tblTeamMember_tblUser` (`intUserID`),
  KEY `FK_tblTeamMember_tblRole` (`intRoleID`),
  KEY `FK_tblTeamMember_tblTeam` (`intTeamID`),
  KEY `FK_tblTeamMember_tblTeamMemberGlobalissue` (`intTeamMemberGlobalissueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblTeamMember`
--

INSERT INTO `tblTeamMember` (`intTeamMemberID`, `intUserID`, `intRoleID`, `intTeamID`, `intTeamMemberGlobalissueID`) VALUES
(1, 1, NULL, 1, 1),
(2, 1, NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblTeamMemberGlobalissue`
--

CREATE TABLE `tblTeamMemberGlobalissue` (
  `intTeamMemberGlobalissueID` int(11) NOT NULL AUTO_INCREMENT,
  `intGlobalissueID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intTeamMemberGlobalissueID`),
  KEY `FK_tblTeamMemberGlobalissue_tblGlobalissue` (`intGlobalissueID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblTeamMemberGlobalissue`
--

INSERT INTO `tblTeamMemberGlobalissue` (`intTeamMemberGlobalissueID`, `intGlobalissueID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblTeamProject`
--

CREATE TABLE `tblTeamProject` (
  `intTeamProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `intTeamID` int(11) DEFAULT NULL,
  `intProjectID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intTeamProjectID`),
  KEY `FK_tblTeamProject_tblTeam` (`intTeamID`),
  KEY `FK_tblTeamProject_tblProject` (`intProjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblTeamProject`
--

INSERT INTO `tblTeamProject` (`intTeamProjectID`, `intTeamID`, `intProjectID`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE `tblUser` (
  `intUserID` int(11) NOT NULL AUTO_INCREMENT,
  `strUserName` varchar(20) DEFAULT NULL,
  `strPassword` varchar(32) DEFAULT NULL,
  `strFirstName` varchar(30) DEFAULT NULL,
  `strLastName` varchar(30) DEFAULT NULL,
  `strEmail` varchar(50) DEFAULT NULL,
  `strPhone` varchar(12) DEFAULT NULL,
  `strMobile` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`intUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`intUserID`, `strUserName`, `strPassword`, `strFirstName`, `strLastName`, `strEmail`, `strPhone`, `strMobile`) VALUES
(1, 'andrea', '5991ec6e95f3a6497a29d83c5a2d8bfd', NULL, NULL, NULL, NULL, NULL),
(2, 'karen', 'd1084b81019b9d544a5ef89392a77ebc', NULL, NULL, NULL, NULL, NULL),
(3, 'teacher', '098f6bcd4621d373cade4e832627b4f6', NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblGlobalissue`
--
ALTER TABLE `tblGlobalissue`
  ADD CONSTRAINT `FK_tblGlobalissue_tblIssue` FOREIGN KEY (`intIssueID`) REFERENCES `tblIssue` (`intIssueID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tblGlobalissue_tblProject` FOREIGN KEY (`intProjectID`) REFERENCES `tblProject` (`intProjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tblGlobalissue_tblRisk` FOREIGN KEY (`intRiskID`) REFERENCES `tblRisk` (`intRiskID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblStatus`
--
ALTER TABLE `tblStatus`
  ADD CONSTRAINT `FK_tblStatus_tblProject` FOREIGN KEY (`intProjectID`) REFERENCES `tblProject` (`intProjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblTeamMember`
--
ALTER TABLE `tblTeamMember`
  ADD CONSTRAINT `FK_tblTeamMember_tblRole` FOREIGN KEY (`intRoleID`) REFERENCES `tblRole` (`intRoleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tblTeamMember_tblTeam` FOREIGN KEY (`intTeamID`) REFERENCES `tblTeam` (`intTeamID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tblTeamMember_tblTeamMemberGlobalissue` FOREIGN KEY (`intTeamMemberGlobalissueID`) REFERENCES `tblTeamMemberGlobalissue` (`intTeamMemberGlobalissueID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tblTeamMember_tblUser` FOREIGN KEY (`intUserID`) REFERENCES `tblUser` (`intUserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblTeamMemberGlobalissue`
--
ALTER TABLE `tblTeamMemberGlobalissue`
  ADD CONSTRAINT `FK_tblTeamMemberGlobalissue_tblGlobalissue` FOREIGN KEY (`intGlobalissueID`) REFERENCES `tblGlobalissue` (`intGlobalissueID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblTeamProject`
--
ALTER TABLE `tblTeamProject`
  ADD CONSTRAINT `FK_tblTeamProject_tblProject` FOREIGN KEY (`intProjectID`) REFERENCES `tblProject` (`intProjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tblTeamProject_tblTeam` FOREIGN KEY (`intTeamID`) REFERENCES `tblTeam` (`intTeamID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
