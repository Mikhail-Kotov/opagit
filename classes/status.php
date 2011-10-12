<?php

class Status {
    public $projectObj, $memberObj;
    public $intStatusID;
    public $intProjectMemberID;
    public $dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline;
    public $strStatusDifference, $strStatusWhy;

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
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," . 
                "strStatusDifference,strStatusWhy FROM tblStatus" .
                " WHERE intStatusID = " . $this->intStatusID;

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strActualBaseline = $sqlArr[0]['strActualBaseline'];
            $this->strPlanBaseline = $sqlArr[0]['strPlanBaseline'];
            $this->strStatusDifference = $sqlArr[0]['strStatusDifference'];
            $this->strStatusWhy = $sqlArr[0]['strStatusWhy'];
        }
        
        $this->attachmentObj->getDetailsStatus($this->intStatusID);
    }
    
    function getLastStatusID() {
        $query = "SELECT intStatusID FROM tblStatus" .
                " WHERE intProjectID = " . $this->projectObj->getID() .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
        }
    }
    
    function getGlobalLastStatusID() {
        $globalLastStatusID = 0;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $globalLastStatusID = $sqlArr[0]['intStatusID'];
        }
        
        return $globalLastStatusID;
    }
    
    function setDetails($intStatusID, // <- refactor this!!!
            $dmtStatusCurrentDate,
            $strActualBaseline,
            $strPlanBaseline,
            $strStatusDifference,
            $strStatusWhy,
            $strAttachmentLink,
            $strAttachmentComment) {
        
        $this->attachmentObj->getDetailsStatus($intStatusID);
        
        $query = "UPDATE tblStatus SET intProjectID='" . mysql_real_escape_string($this->projectObj->getID()) . 
                "',intProjectMemberID='" . mysql_real_escape_string($this->intProjectMemberID) .
                "',dmtStatusCurrentDate='" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "',strActualBaseline='" . mysql_real_escape_string($strActualBaseline) . 
                "',strPlanBaseline='" . mysql_real_escape_string($strPlanBaseline) .
                "',strStatusDifference='" . mysql_real_escape_string($strStatusDifference) . 
                "',strStatusWhy='" . mysql_real_escape_string($strStatusWhy) . 
                "' WHERE intStatusID = '" . mysql_real_escape_string($intStatusID) . "';";
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        $query = "UPDATE tblAttachment SET strAttachmentLink='" . mysql_real_escape_string($strAttachmentLink) . 
                "',strAttachmentComment='" . mysql_real_escape_string($strAttachmentComment) . "' WHERE intAttachmentID=" .$this->attachmentObj->getID() . ";";
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());                                
    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusDifference, 
            $strStatusWhy, $strAttachmentLink, $strAttachmentComment) {

        $nextStatusID = $this->getGlobalLastStatusID() + 1;
        
        $query = "INSERT INTO tblStatus(".
                "intStatusID," .
                "intProjectID," .
                "intProjectMemberID," .
                "dmtStatusCurrentDate," .
                "strActualBaseline," .
                "strPlanBaseline," .
                "strStatusDifference," .
                "strStatusWhy) " .
                "values (" .
                "'" . $nextStatusID .
                "', '" . mysql_real_escape_string($this->projectObj->getID()) .
                "', '" . mysql_real_escape_string($this->intProjectMemberID) .
                "', '" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "', '" . mysql_real_escape_string($strActualBaseline) .
                "', '" . mysql_real_escape_string($strPlanBaseline) .
                "', '" . mysql_real_escape_string($strStatusDifference) .
                "', '" . mysql_real_escape_string($strStatusWhy) . "');";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());

        $query = "INSERT INTO tblAttachment(intAttachmentID,intStatusID,strAttachmentLink,strAttachmentComment) " .
                "values (NULL, '" . $nextStatusID .
                "', '" . mysql_real_escape_string($strAttachmentLink) . 
                "', '" . mysql_real_escape_string($strAttachmentComment) . "');";
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
