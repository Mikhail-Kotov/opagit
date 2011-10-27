#DROP DATABASE IF EXISTS opadmin;
#CREATE DATABASE opadmin character set utf8;

USE opadmin;

DROP TABLE IF EXISTS tblSession;
DROP TABLE IF EXISTS tblAttachment;
DROP TABLE IF EXISTS tblIssue;
DROP TABLE IF EXISTS tblIssueType;
DROP TABLE IF EXISTS tblRisk;
DROP TABLE IF EXISTS tblRiskType;
DROP TABLE IF EXISTS tblMemberCourse;
DROP TABLE IF EXISTS tblStatus;
DROP TABLE IF EXISTS tblProjectMember;
DROP TABLE IF EXISTS tblProject;
DROP TABLE IF EXISTS tblCourse;
DROP TABLE IF EXISTS tblPermission;
DROP TABLE IF EXISTS tblClient;
DROP TABLE IF EXISTS tblTeacher;
DROP TABLE IF EXISTS tblStudent;
DROP TABLE IF EXISTS tblMember;

CREATE TABLE `tblMember` (
  intMemberID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. OPT Table',
  strMemberName VARCHAR(32) NULL,
  strMemberPassword VARCHAR(32) NULL,
  strMemberFirstName VARCHAR(32) NULL,
  strMemberLastName VARCHAR(32) NULL,
  strMemberEmail VARCHAR(64) NULL,
  PRIMARY KEY (intMemberID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblStudent` (
  intMemberID INT(11) NOT NULL COMMENT 'PK, FK. OPT Table',
  PRIMARY KEY (intMemberID),
  KEY `FK_tblStudent_tblMember` (intMemberID),
  CONSTRAINT `FK_tblStudent_tblMember` FOREIGN KEY (intMemberID) REFERENCES `tblMember` (intMemberID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblTeacher` (
  intMemberID INT(11) NOT NULL COMMENT 'PK, FK. OPT Table',
  strTeacherJobTitle VARCHAR(30),
  strTeacherPhone VARCHAR(32) NULL,
  strTeacherMobile VARCHAR(32)NULL,
  PRIMARY KEY (intMemberID),
  KEY `FK_tblTeacher_tblMember` (intMemberID),
  CONSTRAINT `FK_tblTeacher_tblMember` FOREIGN KEY (intMemberID) REFERENCES `tblMember` (intMemberID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblClient` (
  intMemberID INT(11) NOT NULL COMMENT 'PK, FK. OPT Table',
  strClientCompanyName VARCHAR(30),
  strClientCompanyDepartmentName VARCHAR(50),
  strClientCompanyAddress VARCHAR(50),
  strClientCompanySuburb VARCHAR(30),
  strClientCompanyState VARCHAR(4),
  intClientCompanyPostcode INT(10),
  strClientPhone VARCHAR(32) NULL,
  strClientMobile VARCHAR(32)NULL,
  PRIMARY KEY (intMemberID),
  KEY `FK_tblClient_tblMember` (intMemberID),
  CONSTRAINT `FK_tblClient_tblMember` FOREIGN KEY (intMemberID) REFERENCES `tblMember` (intMemberID) ON DELETE CASCADE ON UPDATE CASCADE  
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblPermission` (
  intPermissionID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. We are not sure how OPT will implement permissions',
  strPermissionDescription VARCHAR(32) NULL,
  PRIMARY KEY (intPermissionID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblCourse` (
  intCourseID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. OPT Table',
  strCourseCode VARCHAR(32) NULL,
  strDescription VARCHAR(128) NULL,
  PRIMARY KEY (intCourseID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblProject` (
  intProjectID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. OPT Table',
  intCourseID INT(11) NULL COMMENT 'FK',
  strProjectName VARCHAR(64) NULL,
  strProjectSponsor VARCHAR(64) NULL,
  strProjectDescription VARCHAR(100) NULL,
  dmtProjectStartDate DATE NULL,
  dmtProjectEndDate DATE NULL,
  strProjectTeamName VARCHAR(64) NULL,
  strProjectTeamLeader VARCHAR(64) NULL,
  strProjectSiteURL VARCHAR(100) NULL,
  PRIMARY KEY (intProjectID),
  KEY `FK_tblProject_tblCourse` (intCourseID),
  CONSTRAINT `FK_tblProject_tblCourse` FOREIGN KEY (intCourseID) REFERENCES `tblCourse` (intCourseID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblProjectMember` (
  intProjectMemberID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. OPT Table',
  intMemberID INT(11) NULL COMMENT 'FK',
  intProjectID INT(11) NULL COMMENT 'FK',
  intPermissionID INT(11) NULL COMMENT 'FK',
  PRIMARY KEY (intProjectMemberID),
  KEY `FK_tblProjectMember_tblMember` (intMemberID),
  KEY `FK_tblProjectMember_tblProject` (intProjectID),
  KEY `FK_tblProjectMember_tblPermission` (intPermissionID),
  CONSTRAINT `FK_tblProjectMember_tblMember` FOREIGN KEY (intMemberID) REFERENCES tblMember (intMemberID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblProjectMember_tblProject` FOREIGN KEY (intProjectID) REFERENCES tblProject (intProjectID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblProjectMember_tblPermission` FOREIGN KEY (intPermissionID) REFERENCES tblPermission (intPermissionID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblStatus` (
  intStatusID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. Project Status for OPA',  
  intProjectID INT(11) NOT NULL COMMENT 'FK',
  intProjectMemberID INT(11) NOT NULL COMMENT 'FK', # author
  dmtStatusCurrentDate DATE NOT NULL,
  strActualBaseline VARCHAR(1000) NULL,
  strPlanBaseline VARCHAR(1000) NULL,
  strStatusVariation VARCHAR(5000) NULL,
  strStatusNotes VARCHAR(5000) NULL,
  PRIMARY KEY (intStatusID),
  KEY `FK_tblStatus_tblProject` (intProjectID),
  KEY `FK_tblStatus_tblProjectMember` (intProjectMemberID),
  CONSTRAINT `FK_tblStatus_tblProject` FOREIGN KEY (intProjectID) REFERENCES tblProject (intProjectID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblStatus_tblProjectMember` FOREIGN KEY (intProjectMemberID) REFERENCES tblProjectMember (intProjectMemberID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblMemberCourse` (
  intMemberCourseID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. OPT Table',
  intCourseID INT(11) NULL COMMENT 'FK',
  intMemberID INT(11) NULL COMMENT 'FK',
  PRIMARY KEY (intMemberCourseID),
  KEY `FK_tblMemberCourse_tblCourse` (intCourseID),
  KEY `FK_tblMemberCourse_tblMember` (intMemberID),
  CONSTRAINT `FK_tblMemberCourse_tblCourse` FOREIGN KEY (intCourseID) REFERENCES `tblCourse` (intCourseID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblMemberCourse_tblMember` FOREIGN KEY (intMemberID) REFERENCES `tblMember` (intMemberID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblRiskType` (
  strRiskTypeID VARCHAR(255) NOT NULL COMMENT 'PK. Lookup type of Risk',
  strRiskTypeDescription VARCHAR(255) NULL,
  PRIMARY KEY (strRiskTypeID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblRisk` (
  intRiskID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. Project Risk for OPA',
  intProjectMemberID INT(11) NOT NULL COMMENT 'FK',
  intProjectID INT(11) NOT NULL COMMENT 'FK',
  strRiskTypeID VARCHAR(255) NULL COMMENT 'FK',
  strRiskDescription VARCHAR(1000) NULL,
  strRiskImpactDescription VARCHAR(5000) NULL,  
  enmRiskStatus ENUM('Opened','Closed','Assigned') DEFAULT NULL,
  strRiskLevelOfImpact VARCHAR(255) NULL,
  strLikelihoodOfImpact VARCHAR(255) NULL,
  strRiskConsequenceOfImpact VARCHAR(255) NULL,
  strRiskMitigationStrategy VARCHAR(5000) NULL,
  strRiskContingencyStrategy VARCHAR(5000) NULL,
  dmtRiskDateRaised DATE NULL,
  dmtRiskDateClosed DATE NULL,
  PRIMARY KEY (intRiskID),
  KEY `FK_tblRisk_tblProjectMember` (intProjectMemberID),
  KEY `FK_tblRisk_tblProject` (intProjectID),
  KEY `FK_tblRisk_tblRiskType` (strRiskTypeID),
  CONSTRAINT `FK_tblRisk_tblProjectMember` FOREIGN KEY (intProjectMemberID) REFERENCES tblProjectMember (intProjectMemberID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblRiskItem_tblProject` FOREIGN KEY (intProjectID) REFERENCES tblProject (intProjectID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblRisk_tblRiskType` FOREIGN KEY (strRiskTypeID) REFERENCES `tblRiskType` (strRiskTypeID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblIssueType` (
  strIssueTypeID VARCHAR(255) NOT NULL COMMENT 'PK. Lookup type of Issue',
  strIssueTypeDescription VARCHAR(255) NULL,  
  PRIMARY KEY (strIssueTypeID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblIssue` (
  intIssueID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. Project issue for OPA',
  intProjectMemberID INT(11) NOT NULL COMMENT 'FK',
  intProjectID INT(11) NOT NULL COMMENT 'FK',
  intRiskID INT(11) NULL COMMENT 'FK', # link to risk
  strIssueTypeID VARCHAR(255) NULL COMMENT 'FK',
  strIssueDescription VARCHAR(1000) NULL,
  dmtIssueDateRaised DATE NULL,  
  dmtIssueRequirementFinishDate DATE NULL,
  enmIssueStatus ENUM('Opened','Closed','Assigned') DEFAULT NULL,
  dmtIssueDateClosed DATE NULL,  
  strIssueOutcome VARCHAR(5000) NULL,
  intIssueRating INT(11) NULL,
  PRIMARY KEY (intIssueID),
  KEY `FK_tblIssue_tblProjectMember` (intProjectMemberID),
  KEY `FK_tblIssue_tblProject` (intProjectID),
  KEY `FK_tblIssue_tblRisk` (intRiskID),
  KEY `FK_tblIssue_tblIssueType` (strIssueTypeID),
  CONSTRAINT `FK_tblIssue_tblProjectMember` FOREIGN KEY (intProjectMemberID) REFERENCES tblProjectMember (intProjectMemberID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblIssueItem_tblProject` FOREIGN KEY (intProjectID) REFERENCES tblProject (intProjectID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblIssueItem_tblRisk` FOREIGN KEY (intRiskID) REFERENCES tblRisk (intRiskID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblIssue_tblIssueType` FOREIGN KEY (strIssueTypeID) REFERENCES `tblIssueType` (strIssueTypeID) ON DELETE CASCADE ON UPDATE CASCADE  
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblAttachment` (
  intAttachmentID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. Project Status Attachment for OPA',
  intStatusID INT(11) NULL COMMENT 'FK',
  intRiskID INT(11) NULL COMMENT 'FK',
  intIssueID INT(11) NULL COMMENT 'FK',
  strAttachmentLink VARCHAR(1000) NULL,
  strAttachmentComment VARCHAR(1000) NULL,
  PRIMARY KEY (intAttachmentID),
  KEY `FK_tblAttachment_tblStatus` (intStatusID),
  KEY `FK_tblAttachment_tblRisk` (intRiskID),
  KEY `FK_tblAttachment_tblIssue` (intIssueID),
  CONSTRAINT `FK_tblAttachment_tblStatus` FOREIGN KEY (intStatusID) REFERENCES tblStatus (intStatusID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblAttachment_tblRisk` FOREIGN KEY (intRiskID) REFERENCES tblRisk (intRiskID) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tblAttachment_tblIssue` FOREIGN KEY (intIssueID) REFERENCES tblIssue (intIssueID) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `tblSession` (
  intSessionID INT(11) NOT NULL AUTO_INCREMENT COMMENT 'PK, AI. Sessions for OPA',
  intSessionSID INT(11) NULL,
  strPage VARCHAR(255) NULL,
  strTodo VARCHAR(255) NULL,
  intMemberID INT(11) NULL,
  intProjectID INT(11) NULL,
  intStatusID INT(11) NULL,
  intRiskID INT(11) NULL,
  intIssueID INT(11) NULL,
  PRIMARY KEY (intSessionID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `tblProject`(`intProjectID`,`strProjectName`,`strProjectSponsor`,`strProjectDescription`,`dmtProjectStartDate`,`dmtProjectEndDate`,`strProjectTeamName`,`strProjectTeamLeader`,`strProjectSiteURL`) VALUES (1,'OPA','James','OPA IRS Tracker','2009-07-13','2011-12-31','OPAdmin','Robyn','http://cit3.ldl.swin.edu.au/~opadmin/'),(2,'Project2',NULL,NULL,'2009-07-13',NULL,NULL,NULL,NULL);
INSERT INTO `tblMember`(`intMemberID`,`strMemberName`,`strMemberPassword`,`strMemberFirstName`,`strMemberLastName`,`strMemberEmail`) VALUES (NULL,'Mikhail','pass1','Mikhail','Kotov','gmail1@gmail.com'),(NULL,'Robyn','pass1','Robyn','Ius','gmail2@gmail.com');
INSERT INTO `tblStudent`(`intMemberID`) VALUES (1);
INSERT INTO `tblTeacher`(`intMemberID`,`strTeacherJobTitle`,`strTeacherPhone`,`strTeacherMobile`) VALUES (1,'Coordinator','+61397009876',NULL);
INSERT INTO `tblProjectMember`(`intProjectMemberID`,`intMemberID`,`intProjectID`,`intPermissionID`) VALUES (NULL,1,1,NULL),(NULL,1,2,NULL),(NULL,2,1,NULL),(NULL,2,2,NULL);
INSERT INTO `tblStatus`(`intStatusID`,`intProjectID`,`intProjectMemberID`,`dmtStatusCurrentDate`,`strActualBaseline`,`strPlanBaseline`,`strStatusVariation`,`strStatusNotes`) VALUES (NULL,1,1,'2011-09-12','2011-09-15','2011-09-19','Everything is ok','All team works very quickly');
INSERT INTO `tblIssueType`(`strIssueTypeID`) VALUES ('Bug'),('Environment'),('Financial'),('Management'),('Quality'),('Schedule'),('Technical');
INSERT INTO `tblRiskType`(`strRiskTypeID`) VALUES ('Financial'),('Management'),('Quality'),('Schedule'),('Technical');
INSERT INTO `tblRisk`(`intRiskID`,`intProjectMemberID`,`intProjectID`,`strRiskTypeID`,`strRiskDescription`,`strRiskImpactDescription`,`enmRiskStatus`,`strRiskLevelOfImpact`,`strLikelihoodOfImpact`,`strRiskConsequenceOfImpact`,`strRiskMitigationStrategy`,`strRiskContingencyStrategy`,`dmtRiskDateRaised`,`dmtRiskDateClosed`) VALUES (1,1,1,'Financial','desc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `tblIssue`(`intIssueID`,`intProjectMemberID`,`intProjectID`,`intRiskID`,`strIssueTypeID`,`strIssueDescription`,`dmtIssueDateRaised`,`dmtIssueRequirementFinishDate`,`enmIssueStatus`,`dmtIssueDateClosed`,`strIssueOutcome`,`intIssueRating`) VALUES (1,1,1,1,'Environment','desc',NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `tblAttachment`(`intAttachmentID`,`intStatusID`,`intRiskID`,`intIssueID`,`strAttachmentLink`,`strAttachmentComment`) VALUES ( NULL,'1',NULL,NULL,'http://cit3','attachment comment');
