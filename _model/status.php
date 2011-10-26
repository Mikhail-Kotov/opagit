<?php

class Status {
    private $projectObj, $memberObj;
    public $intStatusID;
    public $intProjectMemberID;
    public $dmtStatusCurrentDate;
    public $strActualBaseline;
    public $strPlanBaseline;
    public $strStatusVariation; // variation
    public $strStatusNotes; // Notes/Reasons

    function __construct($projectObj, $memberObj, $attachmentObj) {
        $this->projectObj = $projectObj;
        $this->memberObj = $memberObj;
        $this->attachmentObj = $attachmentObj;
        $this->intProjectMemberID = $this->getProjectMember();
    }

    function getProjectMember() {
    $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE" .
            " intProjectID = " . $this->projectObj->getID() . 
            " AND intMemberID = " . $this->memberObj->getID() . ";";

    $sqlArr = $_ENV['db']->query($query);

    $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
    return $intProjectMemberID;
}
    
    function getID() {
        if(isset($this->intStatusID)) {
            return $this->intStatusID;
        }
    }
    
    function setID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    function getDetails() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," . 
                "strStatusVariation,strStatusNotes FROM tblStatus" .
                " WHERE intStatusID = " . $this->intStatusID;

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strActualBaseline = $sqlArr[0]['strActualBaseline'];
            $this->strPlanBaseline = $sqlArr[0]['strPlanBaseline'];
            $this->strStatusVariation = $sqlArr[0]['strStatusVariation'];
            $this->strStatusNotes = $sqlArr[0]['strStatusNotes'];
        }
        
        $this->attachmentObj->setStatusID($this->intStatusID);
        $this->attachmentObj->getDetailsFromDB();
    }
    
    function getLastStatusID() {
        $query = "SELECT intStatusID FROM tblStatus" .
                " WHERE intProjectID = " . $this->projectObj->getID() .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
        }
    }
    
    function getGlobalLastStatusID() {
        $globalLastStatusID = 0;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $globalLastStatusID = $sqlArr[0]['intStatusID'];
        }
        
        return $globalLastStatusID;
    }
    
    function setDetails($intStatusID, // <- refactor this!!!
            $dmtStatusCurrentDate,
            $strActualBaseline,
            $strPlanBaseline,
            $strStatusVariation,
            $strStatusNotes,
            $intAttachmentIDArr,
            $strAttachmentLinkArr,
            $strAttachmentCommentArr) {
        
        
        
        $query = "UPDATE tblStatus SET intProjectID='" . mysql_real_escape_string($this->projectObj->getID()) . 
                "',intProjectMemberID='" . mysql_real_escape_string($this->intProjectMemberID) .
                "',dmtStatusCurrentDate='" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "',strActualBaseline='" . mysql_real_escape_string($strActualBaseline) . 
                "',strPlanBaseline='" . mysql_real_escape_string($strPlanBaseline) .
                "',strStatusVariation='" . mysql_real_escape_string($strStatusVariation) . 
                "',strStatusNotes='" . mysql_real_escape_string($strStatusNotes) . 
                "' WHERE intStatusID = '" . mysql_real_escape_string($intStatusID) . "';";
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        $this->attachmentObj->setStatusID($intStatusID);
        $this->attachmentObj->setDetails($intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
            $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr) {

        $nextStatusID = $this->getGlobalLastStatusID() + 1;
        
        $query = "INSERT INTO tblStatus(".
                "intStatusID," .
                "intProjectID," .
                "intProjectMemberID," .
                "dmtStatusCurrentDate," .
                "strActualBaseline," .
                "strPlanBaseline," .
                "strStatusVariation," .
                "strStatusNotes) " .
                "values (" .
                "'" . $nextStatusID .
                "', '" . mysql_real_escape_string($this->projectObj->getID()) .
                "', '" . mysql_real_escape_string($this->intProjectMemberID) .
                "', '" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "', '" . mysql_real_escape_string($strActualBaseline) .
                "', '" . mysql_real_escape_string($strPlanBaseline) .
                "', '" . mysql_real_escape_string($strStatusVariation) .
                "', '" . mysql_real_escape_string($strStatusNotes) . "');";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());

        $this->attachmentObj->addDetails($nextStatusID, $strAttachmentLinkArr, $strAttachmentCommentArr);


    }

    function delDetails($intStatusID) {
        $query = "DELETE FROM tblStatus WHERE intStatusID='$intStatusID';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        $this->attachmentObj->delDetails($intStatusID);
    }

    function displayStatus() {
        include_once("_view/status/view.php");
        include_once("_view/status/bottomMenu.php");
    }

    function pdfStatus() {
        include_once("_view/status/pdf.php");
    }    
    
    function displayStatusHistory() {
        include_once("_view/status/history.php");
        include_once("_view/status/bottomMenu.php");
    }

    function printStatus() {
        
    }

    function addAttachment() {
        
    }

    function displayAddForm() {
        include_once("_view/status/add.php");
    }
    
    function displayEditForm() {
        include_once("_view/status/edit.php");
    }
}
?>
