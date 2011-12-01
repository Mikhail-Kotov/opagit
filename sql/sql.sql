# Last edited: 21 Nov, 2.45 pm
# By: Mikhail
#edited Risk Fileds: 24 Nov, 11.33am
#By Robyn 

#DROP DATABASE IF EXISTS opadmin;
#CREATE DATABASE opadmin character set utf8;

#DROP DATABASE IF EXISTS opadmindev;
#CREATE DATABASE opadmindev CHARACTER SET utf8;

#USE opadmin;
#USE opadmindev;

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
  strMemberPassword VARCHAR(34) NULL,
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
  intProjectMemberID INT(11) NOT NULL COMMENT 'FK' COMMENT 'Raised by',
  intProjectID INT(11) NOT NULL COMMENT 'FK',
  strRiskTypeID VARCHAR(255) NULL COMMENT 'FK' COMMENT 'calls Risk Type description',
  strRiskDescription VARCHAR(1000) NULL,
  strRiskImpactDescription VARCHAR(5000) NULL,  
  enmRiskStatus ENUM('Open','Closed') DEFAULT NULL,
  enmRiskLikelihoodOfImpact ENUM('High','Medium','Low') DEFAULT NULL,
  enmRiskProjectImpactRating ENUM('High','Medium','Low') DEFAULT NULL,
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
  strSessionSID VARCHAR(255) NULL,
  strPage VARCHAR(255) NULL,
  strTodo VARCHAR(255) NULL,
  strAlert VARCHAR(5000) NULL,  
  intMemberID INT(11) NULL,
  intProjectID INT(11) NULL,
  intStatusID INT(11) NULL,
  intRiskID INT(11) NULL,
  intIssueID INT(11) NULL,
  PRIMARY KEY (intSessionID)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO `tblProject`(`intProjectID`,`intCourseID`,`strProjectName`,`strProjectSponsor`,`strProjectDescription`,`dmtProjectStartDate`,`dmtProjectEndDate`,`strProjectTeamName`,`strProjectTeamLeader`,`strProjectSiteURL`) VALUES (NULL,NULL,'helisim',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'fundcalc',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'bafa',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'fastrack2',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'optime',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'trafficca',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'chisholm',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'opadmin',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'mpas',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'EMS',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `tblMember`(`intMemberID`,`strMemberName`,`strMemberPassword`,`strMemberFirstName`,`strMemberLastName`,`strMemberEmail`) VALUES (1,'7022441','$1$tS1.yT2.$v/tXvuTxEWp3Z0foBDw9Y.','Stacey','Arnott','Stacey Arnott <7022441@student.swin.edu.au>'),(2,'6835449','$1$Th1.ga4.$FutZbu2qqrs9smomrQBjx1','Ly','Che','Ly Che <6835449@student.swin.edu.au>'),(3,'7022034','$1$pN/.8M4.$qRT7LPVKA1Vapxcbuer1o0','Joshua','Fletcher','Joshua Fletcher <7022034@student.swin.edu.au>'),(4,'6453910','$1$vt0.MG5.$zoSGtYXbSIoN3qsBE8bTF.','Gregory','Smith','Gregory Smith <6453910@student.swin.edu.au>'),(5,'7009615','$1$lH0.KX3.$bwempNoaprvREx3pRKrMg/','Christian','Gimelli','Christian Gimelli <7009615@student.swin.edu.au>'),(6,'7102976','$1$LR1.272.$rq1RVGwjVCD9U3YdsB5/8.','Jessica','Nirens','Jessica Nirens <7102976@student.swin.edu.au>'),(7,'7230176','$1$hw/.Wl0.$SVLR8JDURE3GuZSGW56bj/','Simone','Cavanagh','Simone Cavanagh <7230176@student.swin.edu.au>'),(8,'6819680','$1$n55.ku1.$dqPLswbdWhTRCF3jGbYNC0','Amanda','Netzel','Amanda Netzel <6819680@student.swin.edu.au>'),(9,'6454860','$1$d2..im0.$Jw8noo47t9JJiMRGjf3ph0','Criag','Poole','Criag Poole <6454860@student.swin.edu.au>'),(10,'7231164','$1$Dd1.QL/.$EQyno5ehNPUUYk2DUyPjX/','Orel','Razvag','Orel Razvag <7231164@student.swin.edu.au>'),(11,'7022301','$1$ZP..uK4.$oYQjO5VFPSLb56U/ztpiR/','Tung','Truong','Tung Truong <7022301@student.swin.edu.au>'),(12,'5642108','$1$fl0.6D1.$ra4629TfrmxfYELuODDwd1','Sheng','Wei','Sheng Wei <5642108@student.swin.edu.au>'),(13,'6653723','$1$Vl0.4C0.$5kjzeWLaAzVJhly8xhBwE0','David','Hourn','David Hourn <6653723@student.swin.edu.au>'),(14,'6819648','$1$5F0.oF2.$jvGU0OfuSO1uyUNdK4sqF0','Glen','Greenwood','Glen  Greenwood <6819648@student.swin.edu.au>'),(15,'7001479','$1$Rq0.G65.$SEJPJ0Q5GptpGJLX5XV0Y/','Sharla','Cartner','Sharla Cartner <7001479@student.swin.edu.au>'),(16,'6453996','$1$Xr1.UD1.$LDI7M3F7xyDagGcov0Ovg0','Erick','Santos','Erick Santos <6453996@student.swin.edu.au>'),(17,'7022069','$1$NO..Sp/.$Exqx8ARX4s.jH6A9P49ik0','Ben','Weekley','Ben Weekley <7022069@student.swin.edu.au>'),(18,'7023995','$1$zI3.As0.$BOs275VAqKDb8UGLh8Sz61','David','Kemp','David Kemp <7023995@student.swin.edu.au>'),(19,'6819729','$1$JB5.e31.$MSmqxeNldqevSlWURApFV0','Dustin','Widrose ','Dustin  Widrose <6819729@student.swin.edu.au>'),(20,'6819737','$1$PN..sv/.$h1sJAukr.UQY2qE2sctk70','Frank','Cho','Frank Cho <6819737@student.swin.edu.au>'),(21,'7026129','$1$Fz4.qc5.$WULsuKo7PW4uilXzjBUx0/','Sunghyun','Park','Sunghyun Park <7026129@student.swin.edu.au>'),(22,'6819702','$1$ro0.Y81.$Y9NJkwEEaG1dE9Ljc4M8E0','Azy','Sir','Azy Sir <6819702@student.swin.edu.au>'),(23,'6819664','$1$BU1.0D..$qRVX4qmIfYNzRMhjrNJ0w1','Adam','Gammon','Adam Gammon <6819664@student.swin.edu.au>'),(24,'6335829','$1$HL4.EI3.$kqVIJO58vEPv3cV6z9jWz0','Jingwia','Lawrence','Jingwia Lawrence <6335829@student.swin.edu.au>'),(25,'9117954','$1$7U2.Cc/.$VUAAQB88rXqvqfgInF9Tn1','Paul','Ryan','Paul Ryan <9117954@student.swin.edu.au>'),(26,'6819621','$1$jk..w61.$9gA1BEGNCHMe9wy2XX1qY1','Andrew','McNab','Andrew McNab <6819621@student.swin.edu.au>'),(27,'7463421','$1$3j3.OY2.$QuU2KjJUOQEOZMLM8J3Z1.','Muniba','Syeda','Muniba Syeda <7463421@student.swin.edu.au>'),(28,'6817866','$1$9l1.cM1.$8z1u.IoCgiqzay41pySpG1','Brendan','Dell','Brendan Dell <6817866@student.swin.edu.au>'),(29,'6105912','$1$/x4.an3.$2l7cjQlFx/kwFNi.j6.oN/','Noha','Hassan','Noha Hassan <6105912@student.swin.edu.au>'),(30,'5595258','$1$b63.In..$IKTz5fPcUDxsxZNOaGk4E0','Jason','Grivas','Jason Grivas <5595258@student.swin.edu.au>'),(31,'6817513','$1$xt1.m34.$wmedikDg2LFyQKPrUX.fT/','Gareth','Somers','Gareth Somers <6817513@student.swin.edu.au>'),(32,'4091248','$1$1b4..70.$ZOPV7W5pJ3USgbUuTzFAe/','Rebecca','Wilson','Rebecca Wilson <4091248@student.swin.edu.au>'),(33,'6817637','$1$tJ2.y80.$E5jUTwoYlNXCxWKK8dHwY0','Abed','Beshara','Abed Beshara <6817637@student.swin.edu.au>'),(34,'6745695','$1$Tw3.g70.$o3j/IAxFFzSpjR6o/3T8P0','Scott','Cowley','Scott Cowley <6745695@student.swin.edu.au>'),(35,'4466918','$1$p.2.8n0.$wmK/ix.qbu3ZQaKVAB08Z0','Oliver','Koehrer','Oliver Koehrer <4466918@student.swin.edu.au>'),(36,'7225539','$1$vs2.MZ5.$M1HM4MT1tC13CutBfrsNY.','Jeremy','Kuiters','Jeremy Kuiters <7225539@student.swin.edu.au>'),(37,'6463541','$1$le0.Ki2.$MrxItnY1hh.zRgDCDajXH.','Corrina','Mayall','Corrina Mayall <6463541@student.swin.edu.au>'),(38,'6453236','$1$LA/.2A3.$qkuAzrjKq2d6euDyn8YUb.','Jerome','Pereira','Jerome Pereira <6453236@student.swin.edu.au>'),(39,'6955762','$1$h12.Wg..$voFEKBfMkgi1AuTRcHTZ9.','James','Zuccon','James Zuccon <6955762@student.swin.edu.au>'),(40,'6762921','$1$na2.kh/.$w/39EKaPFBf9B5EYoSjty0','Stephen','Blatancic','Stephen Blatancic <6762921@student.swin.edu.au>'),(41,'6806503','$1$dv5.iR1.$VBY4A6WNR6Sghyu6Erd8J1','Reece','Dixon','Reece Dixon <6806503@student.swin.edu.au>'),(42,'5651271','$1$Ds2.Qu5.$6IdwXj/HaObURaZ8XCLbu1','Robyn','Ius','Robyn Ius <5651271@student.swin.edu.au>'),(43,'2708337','$1$Z00.ul3.$3pKxAaDJUjGH/INLdeeBF/','Mikhail','Kotov','Mikhail Kotov <2708337@student.swin.edu.au>'),(44,'6763073','$1$fk1.6W4.$VXGnU8u8uwxTRduDq5HyM1','Melody','Kwan','Melody Kwan <6763073@student.swin.edu.au>'),(45,'6365493','$1$V60.4N2.$uOmcHD.oiCbQYXhLC3v5H.','Kevin','Phillips','Kevin Phillips <6365493@student.swin.edu.au>'),(46,'6762999','$1$5.5.oI..$l8WTmL8YaoEsxlk3gFghc0','James','Brauman','James Brauman <6762999@student.swin.edu.au>'),(47,'6061036','$1$Rx1.G1..$GEeabgEQNUSAhYJWdEhyu/','Jessica','Grey','Jessica Grey <6061036@student.swin.edu.au>'),(48,'6763154','$1$XK..U02.$95gAE0y3UEU1hy7l7ksE5/','Joshua','Harbour','Joshua Harbour <6763154@student.swin.edu.au>'),(49,'2502771','$1$NF5.SU3.$.xhmBG7V14Fim4/KmlUUp1','Nicholas','Jackson','Nicholas Jackson <2502771@student.swin.edu.au>'),(50,'6817475','$1$zX3.AP2.$Fs2g7e6QtlCM.s4TJZZ7x1','Scott','Matthews','Scott Matthews <6817475@student.swin.edu.au>'),(51,'6763871','$1$Jo5.eU3.$kApAlpwhygUQBTAItJ3q8.','Andrew','Thackray','Andrew Thackray <6763871@student.swin.edu.au>'),(52,'7391986','$1$PM..sC..$t2CdE4rEIWpJBkJe5KIBn1','Cassandra','Drake','Cassandra Drake <7391986@student.swin.edu.au>'),(53,'7392141','$1$FK3.qn2.$ENlinc/M0afdc4yDXjLYb0','Mark','Fulton','Mark Fulton <7392141@student.swin.edu.au>'),(54,'7392427','$1$rX4.YB0.$MPwcuUVgReXIh2d./w00A.','Martyn','Hole','Martyn Hole <7392427@student.swin.edu.au>'),(55,'7391862','$1$Bb1.082.$BldrXkRPf1FLWfa34VH6/1','Michael','Tigas','Michael Tigas <7391862@student.swin.edu.au>');
INSERT INTO `tblStudent`(`intMemberID`) VALUES (1);
INSERT INTO `tblTeacher`(`intMemberID`,`strTeacherJobTitle`,`strTeacherPhone`,`strTeacherMobile`) VALUES (1,'Coordinator','+61397009876',NULL);
INSERT INTO `tblProjectMember`(`intProjectMemberID`,`intMemberID`,`intProjectID`,`intPermissionID`) VALUES (1,1,1,NULL),(2,2,1,NULL),(3,3,1,NULL),(4,4,1,NULL),(5,5,1,NULL),(6,6,1,NULL),(7,7,2,NULL),(8,8,2,NULL),(9,9,2,NULL),(10,10,2,NULL),(11,11,2,NULL),(12,12,2,NULL),(13,13,2,NULL),(14,14,3,NULL),(15,15,3,NULL),(16,16,3,NULL),(17,17,3,NULL),(18,18,4,NULL),(19,19,4,NULL),(20,20,4,NULL),(21,21,4,NULL),(22,22,4,NULL),(23,23,5,NULL),(24,24,5,NULL),(25,25,5,NULL),(26,26,5,NULL),(27,27,5,NULL),(28,28,6,NULL),(29,29,6,NULL),(30,30,6,NULL),(31,31,6,NULL),(32,32,6,NULL),(33,33,7,NULL),(34,34,7,NULL),(35,35,7,NULL),(36,36,7,NULL),(37,37,7,NULL),(38,38,7,NULL),(39,39,7,NULL),(40,40,8,NULL),(41,41,8,NULL),(42,42,8,NULL),(43,43,8,NULL),(44,44,8,NULL),(45,45,8,NULL),(46,46,9,NULL),(47,47,9,NULL),(48,48,9,NULL),(49,49,9,NULL),(50,50,9,NULL),(51,51,9,NULL),(52,52,10,NULL),(53,53,10,NULL),(54,54,10,NULL),(55,55,10,NULL);
INSERT INTO `tblStatus`(`intStatusID`,`intProjectID`,`intProjectMemberID`,`dmtStatusCurrentDate`,`strActualBaseline`,`strPlanBaseline`,`strStatusVariation`,`strStatusNotes`) VALUES (NULL,8,43,'2011-09-12','2011-09-15','2011-09-19','Everything is ok','All team works very quickly');
INSERT INTO `tblIssueType`(`strIssueTypeID`) VALUES ('Bug'),('Environment'),('Financial'),('Management'),('Quality'),('Schedule'),('Technical');
INSERT INTO `tblRiskType`(`strRiskTypeID`) VALUES ('Financial'),('Management'),('Quality'),('Schedule'),('Technical');
#INSERT INTO `tblRisk`(`intRiskID`,`intProjectMemberID`,`intProjectID`,`strRiskTypeID`,`strRiskDescription`,`strRiskImpactDescription`,`enmRiskStatus`,`strRiskLevelOfImpact`,`strLikelihoodOfImpact`,`strRiskConsequenceOfImpact`,`strRiskMitigationStrategy`,`strRiskContingencyStrategy`,`dmtRiskDateRaised`,`dmtRiskDateClosed`) VALUES (1,43,8,'Financial','desc',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
#INSERT INTO `tblIssue`(`intIssueID`,`intProjectMemberID`,`intProjectID`,`intRiskID`,`strIssueTypeID`,`strIssueDescription`,`dmtIssueDateRaised`,`dmtIssueRequirementFinishDate`,`enmIssueStatus`,`dmtIssueDateClosed`,`strIssueOutcome`,`intIssueRating`) VALUES (1,43,8,1,'Environment','desc',NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `tblAttachment`(`intAttachmentID`,`intStatusID`,`intRiskID`,`intIssueID`,`strAttachmentLink`,`strAttachmentComment`) VALUES ( NULL,'1',NULL,NULL,'cit3','attachment comment');

# Test users & Test Projects
INSERT INTO `tblProject`(`intProjectID`,`intCourseID`,`strProjectName`,`strProjectSponsor`,`strProjectDescription`,`dmtProjectStartDate`,`dmtProjectEndDate`,`strProjectTeamName`,`strProjectTeamLeader`,`strProjectSiteURL`) VALUES (NULL,NULL,'testProject1',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'testProject2',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(NULL,NULL,'testProject3',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO `tblMember`(`intMemberID`,`strMemberName`,`strMemberPassword`,`strMemberFirstName`,`strMemberLastName`,`strMemberEmail`) VALUES (NULL,'testUser1','$1$yc2qisRp$cU8DF/SKQsehYb3naDPL6.','FName1','LName1','FName1 LName1 <2708337@student.swin.edu.au>'),(NULL,'testUser2','$1$yc2qisRp$cU8DF/SKQsehYb3naDPL6.','FName2','LName2','FName2 LName2 <2708337@student.swin.edu.au>'),(NULL,'testUser3','$1$yc2qisRp$cU8DF/SKQsehYb3naDPL6.','FName3','LName3','FName3 LName3 <2708337@student.swin.edu.au>');
INSERT INTO `tblProjectMember`(`intProjectMemberID`,`intMemberID`,`intProjectID`,`intPermissionID`) VALUES ( NULL,'56','1',NULL),( NULL,'56','2',NULL),( NULL,'56','3',NULL),( NULL,'56','4',NULL),( NULL,'56','5',NULL),( NULL,'56','6',NULL),( NULL,'56','7',NULL),( NULL,'56','8',NULL),( NULL,'56','9',NULL),( NULL,'56','10',NULL),( NULL,'56','11',NULL),( NULL,'56','12',NULL),( NULL,'56','13',NULL);
INSERT INTO `tblProjectMember`(`intProjectMemberID`,`intMemberID`,`intProjectID`,`intPermissionID`) VALUES ( NULL,'57','11',NULL),( NULL,'57','12',NULL);
INSERT INTO `tblProjectMember`(`intProjectMemberID`,`intMemberID`,`intProjectID`,`intPermissionID`) VALUES ( NULL,'58','12',NULL),( NULL,'58','13',NULL);
