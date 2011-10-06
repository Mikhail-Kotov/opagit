<?php

class Status {
    public $projectObj, $memberObj;
    public $intStatusID;
    public $intProjectMemberID;
    public $dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate;
    public $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment;

    function __construct($projectObj, $memberObj, $attachmentObj) {
        $this->projectObj = $projectObj;
        $this->memberObj = $memberObj;
        $this->attachmentObj = $attachmentObj;
        $this->intProjectMemberID = getProjectMember($this->projectObj->getID(), $this->memberObj->getID());
    }

    function getID() {
        return $this->intStatusID;
    }
    
    function setID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    function getDetails() {
        $query = "";
        
        $this->attachmentObj->getDetailsStatus($this->intStatusID);
        
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate," . 
                "strStatusDifference,strStatusWhy FROM tblStatus" .
                " WHERE intStatusID = " . $this->intStatusID;

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strStatusDate = $sqlArr[0]['strStatusDate'];
            $this->strStatusActualDate = $sqlArr[0]['strStatusActualDate'];
            $this->strStatusDifference = $sqlArr[0]['strStatusDifference'];
            $this->strStatusWhy = $sqlArr[0]['strStatusWhy'];
            $this->strStatusGanttLink = $this->attachmentObj->strAttachmentLink;
            $this->strStatusGanttLinkComment = $this->attachmentObj->strAttachmentComment;
        }
    }
    
    function getLastStatusID() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate," .
                "strStatusDifference,strStatusWhy FROM tblStatus" .
                " WHERE intProjectID = " . $this->projectObj->getID() .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
        }
    }
    
    function setDetails($intStatusID,
            $dmtStatusCurrentDate,
            $strStatusDate,
            $strStatusActualDate,
            $strStatusDifference,
            $strStatusWhy,
            $strStatusGanttLink,
            $strStatusGanttLinkComment) {
        $query = "UPDATE tblStatus SET intProjectID='" . mysql_real_escape_string($this->projectObj->getID()) . 
                "',intProjectMemberID='" . mysql_real_escape_string($this->intProjectMemberID) .
                "',dmtStatusCurrentDate='" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "',strStatusDate='" . mysql_real_escape_string($strStatusDate) . 
                "',strStatusActualDate='" . mysql_real_escape_string($strStatusActualDate) .
                "',strStatusDifference='" . mysql_real_escape_string($strStatusDifference) . 
                "',strStatusWhy='" . mysql_real_escape_string($strStatusWhy) . 
                "',strStatusGanttLink='" . mysql_real_escape_string($strStatusGanttLink) . 
                "',strStatusGanttLinkComment='" . mysql_real_escape_string($strStatusGanttLinkComment) . 
                "' WHERE intStatusID = '" . mysql_real_escape_string($intStatusID) . "';";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    function addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusDifference, 
            $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment) {
            
        $query = "INSERT INTO tblStatus(intStatusID,intProjectID,intProjectMemberID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate," .
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment) " .
                "values (NULL, '" . mysql_real_escape_string($this->projectObj->getID()) . "', '" . mysql_real_escape_string($this->intProjectMemberID) .
                "', '" . mysql_real_escape_string($dmtStatusCurrentDate) . "', '" . mysql_real_escape_string($strStatusDate) . 
                "', '" . mysql_real_escape_string($strStatusActualDate) . "'," .
                "'" . mysql_real_escape_string($strStatusDifference) . "', '" . mysql_real_escape_string($strStatusWhy) . 
                "', '" . mysql_real_escape_string($strStatusGanttLink) . "', '" . mysql_real_escape_string($strStatusGanttLinkComment) . "');";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    function delDetails($intStatusID) {
        $query = "DELETE FROM tblStatus where intStatusID='$intStatusID';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    function displayStatus() {
        include_once("view/status/view.php");
        include_once("view/status/bottomMenu.php");
    }

    function pdfStatus() {
        include_once("view/status/pdf.php");
    }    
    
    function displayStatusHistory() {
        include_once("view/status/history.php");
        include_once("view/status/bottomMenu.php");
    }

    function printStatus() {
        
    }

    function addAttachment() {
        
    }

    function displayAddForm() {
        include_once("view/status/add.php");
    }
    
    function displayEditForm() {
        include_once("view/status/edit.php");
    }
}
?>
