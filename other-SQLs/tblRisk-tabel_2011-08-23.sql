-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306

-- Generation Time: Aug 23, 2011 at 08:07 PM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
