-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306

-- Generation Time: Aug 10, 2011 at 07:47 AM
-- Server version: 5.5.15
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `optime`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblactivity`
--

CREATE TABLE `tblactivity` (
  `intActivityID` int(11) NOT NULL AUTO_INCREMENT,
  `intActivityTypeID` int(11) NOT NULL,
  `strDescription` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intActivityID`),
  KEY `FK_tblavtivitytypeactivity` (`intActivityTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblactivitytype`
--

CREATE TABLE `tblactivitytype` (
  `intActivityType` int(11) NOT NULL AUTO_INCREMENT,
  `intDescription` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intActivityType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblclient`
--

CREATE TABLE `tblclient` (
  `intClientID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(50) DEFAULT NULL,
  `strAddress` varchar(50) DEFAULT NULL,
  `strSuburb` varchar(30) DEFAULT NULL,
  `strState` varchar(3) DEFAULT NULL,
  `intPostcode` int(11) DEFAULT NULL,
  `strPhone` varchar(12) DEFAULT NULL,
  `strMobile` varchar(12) DEFAULT NULL,
  `strEmail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intClientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `intCourseID` int(11) NOT NULL AUTO_INCREMENT,
  `strCourseCode` varchar(20) DEFAULT NULL,
  `strDescription` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intCourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblnonworkperiod`
--

CREATE TABLE `tblnonworkperiod` (
  `intTeamID` int(11) NOT NULL,
  `dtmStart` date NOT NULL,
  `dtmEnd` date NOT NULL,
  PRIMARY KEY (`intTeamID`,`dtmStart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblperiod`
--

CREATE TABLE `tblperiod` (
  `intPeriodID` int(11) NOT NULL AUTO_INCREMENT,
  `intTeamID` int(11) NOT NULL,
  `dtmStart` date NOT NULL,
  `dtmEnd` date NOT NULL,
  `strName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`intPeriodID`),
  KEY `FK_tblteamperiod` (`intTeamID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblproject`
--

CREATE TABLE `tblproject` (
  `intProjectID` int(11) NOT NULL AUTO_INCREMENT,
  `intClientID` int(11) NOT NULL,
  `strName` varchar(50) DEFAULT NULL,
  `strSponsor` varchar(50) DEFAULT NULL,
  `strAddress` varchar(50) DEFAULT NULL,
  `strSuburb` varchar(30) DEFAULT NULL,
  `strState` varchar(3) DEFAULT NULL,
  `intPostcode` int(11) DEFAULT NULL,
  `strPhone` varchar(12) DEFAULT NULL,
  `strMobile` varchar(12) DEFAULT NULL,
  `strEmail` varchar(50) DEFAULT NULL,
  `strDescription` varchar(100) DEFAULT NULL,
  `strStudentDesctiption` longtext,
  PRIMARY KEY (`intProjectID`),
  KEY `FK_tblprojectclient` (`intClientID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblprojectcourse`
--

CREATE TABLE `tblprojectcourse` (
  `intCourseID` int(11) NOT NULL,
  `intProjectID` int(11) NOT NULL,
  PRIMARY KEY (`intCourseID`,`intProjectID`),
  KEY `FK_tblprojectcourse` (`intProjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblprojectteam`
--

CREATE TABLE `tblprojectteam` (
  `intProjectID` int(11) NOT NULL,
  `intTeamID` int(11) NOT NULL,
  PRIMARY KEY (`intProjectID`,`intTeamID`),
  KEY `FK_tblteamprojectteam` (`intTeamID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblteam`
--

CREATE TABLE `tblteam` (
  `intTeamID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(30) DEFAULT NULL,
  `intCourseID` int(11) NOT NULL,
  `strSiteURL` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`intTeamID`),
  KEY `FK_tblteamcourse` (`intCourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblteammember`
--

CREATE TABLE `tblteammember` (
  `intTeamMemberID` int(11) NOT NULL AUTO_INCREMENT,
  `intTeamID` int(11) NOT NULL,
  `intUserID` int(11) NOT NULL,
  `blnProjectManager` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`intTeamMemberID`),
  KEY `FK_tblteammemberteam` (`intTeamID`),
  KEY `FK_tblteammemberuser` (`intUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblteammentor`
--

CREATE TABLE `tblteammentor` (
  `intTeamID` int(11) NOT NULL,
  `intUserID` int(11) NOT NULL,
  PRIMARY KEY (`intTeamID`,`intUserID`),
  KEY `FK_tblgroupmentor` (`intUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltimesheet`
--

CREATE TABLE `tbltimesheet` (
  `intTimesheetID` int(11) NOT NULL AUTO_INCREMENT,
  `intPeriodID` int(11) DEFAULT NULL,
  `intTeamMemberID` int(11) DEFAULT NULL,
  `blnSubmitted` tinyint(1) DEFAULT NULL,
  `blnLeaderApproved` tinyint(1) DEFAULT NULL,
  `blnMentorApproved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`intTimesheetID`),
  KEY `FK_tbltimesheetperiod` (`intPeriodID`),
  KEY `FK_tblteammembertimesheet` (`intTeamMemberID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbltimesheetactivity`
--

CREATE TABLE `tbltimesheetactivity` (
  `intActivityID` int(11) NOT NULL,
  `intTimesheetID` int(11) NOT NULL,
  `dtmDate` date NOT NULL,
  `strDescription` varchar(50) DEFAULT NULL,
  `intDuration` int(11) DEFAULT NULL,
  PRIMARY KEY (`intActivityID`,`intTimesheetID`,`dtmDate`),
  KEY `FK_activitytbltimesheetactivity` (`intTimesheetID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `intUserID` int(11) NOT NULL AUTO_INCREMENT,
  `strUserName` varchar(20) DEFAULT NULL,
  `strPassword` varchar(32) DEFAULT NULL,
  `intUserTypeID` int(11) DEFAULT NULL,
  `strFirstName` varchar(30) DEFAULT NULL,
  `strLastName` varchar(30) DEFAULT NULL,
  `strEmail` varchar(50) DEFAULT NULL,
  `strPhone` varchar(12) DEFAULT NULL,
  `strMobile` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`intUserID`),
  KEY `FK_tblusertypeuser` (`intUserTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblusertype`
--

CREATE TABLE `tblusertype` (
  `intUserTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `strDescription` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`intUserTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblactivity`
--
ALTER TABLE `tblactivity`
  ADD CONSTRAINT `FK_tblavtivitytypeactivity` FOREIGN KEY (`intActivityTypeID`) REFERENCES `tblactivitytype` (`intActivityType`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblnonworkperiod`
--
ALTER TABLE `tblnonworkperiod`
  ADD CONSTRAINT `FK_tblteamnonworkperiod` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblperiod`
--
ALTER TABLE `tblperiod`
  ADD CONSTRAINT `FK_tblteamperiod` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblproject`
--
ALTER TABLE `tblproject`
  ADD CONSTRAINT `FK_tblprojectclient` FOREIGN KEY (`intClientID`) REFERENCES `tblclient` (`intClientID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblprojectcourse`
--
ALTER TABLE `tblprojectcourse`
  ADD CONSTRAINT `FK_tblcourseprojectcourse` FOREIGN KEY (`intCourseID`) REFERENCES `tblcourse` (`intCourseID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tblprojectcourse` FOREIGN KEY (`intProjectID`) REFERENCES `tblproject` (`intProjectID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblprojectteam`
--
ALTER TABLE `tblprojectteam`
  ADD CONSTRAINT `FK_tblteamprojectteam` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tblprojectteamproject` FOREIGN KEY (`intProjectID`) REFERENCES `tblproject` (`intProjectID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblteam`
--
ALTER TABLE `tblteam`
  ADD CONSTRAINT `FK_tblteamcourse` FOREIGN KEY (`intCourseID`) REFERENCES `tblcourse` (`intCourseID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblteammember`
--
ALTER TABLE `tblteammember`
  ADD CONSTRAINT `FK_tblteammemberuser` FOREIGN KEY (`intUserID`) REFERENCES `tbluser` (`intUserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tblteammemberteam` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblteammentor`
--
ALTER TABLE `tblteammentor`
  ADD CONSTRAINT `FK_tblmentorteammentor` FOREIGN KEY (`intTeamID`) REFERENCES `tblteam` (`intTeamID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tblgroupmentor` FOREIGN KEY (`intUserID`) REFERENCES `tbluser` (`intUserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbltimesheet`
--
ALTER TABLE `tbltimesheet`
  ADD CONSTRAINT `FK_tblteammembertimesheet` FOREIGN KEY (`intTeamMemberID`) REFERENCES `tblteammember` (`intTeamMemberID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tbltimesheetperiod` FOREIGN KEY (`intPeriodID`) REFERENCES `tblperiod` (`intPeriodID`) ON DELETE NO ACTION;

--
-- Constraints for table `tbltimesheetactivity`
--
ALTER TABLE `tbltimesheetactivity`
  ADD CONSTRAINT `FK_activitytbltimesheetactivity` FOREIGN KEY (`intActivityID`) REFERENCES `tblactivity` (`intActivityID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_tbltimesheetactivitytimesheet` FOREIGN KEY (`intTimesheetID`) REFERENCES `tbltimesheet` (`intTimesheetID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `FK_tblusertypeuser` FOREIGN KEY (`intUserTypeID`) REFERENCES `tblusertype` (`intUserTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
