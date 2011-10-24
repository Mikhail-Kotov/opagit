<?php

class Status {
    public $projectObj, $memberObj;
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

    $sqlArr = getArr($query);

    $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
    return $intProjectMemberID;
}
    
    function getID() {
        return $this->intStatusID;
    }
    
    function setID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    function getDetails() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," . 
                "strStatusVariation,strStatusNotes FROM tblStatus" .
                " WHERE intStatusID = " . $this->intStatusID;

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strActualBaseline = $sqlArr[0]['strActualBaseline'];
            $this->strPlanBaseline = $sqlArr[0]['strPlanBaseline'];
            $this->strStatusVariation = $sqlArr[0]['strStatusVariation'];
            $this->strStatusNotes = $sqlArr[0]['strStatusNotes'];
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
            $strStatusVariation,
            $strStatusNotes,
            $intAttachmentID,
            $strAttachmentLink,
            $strAttachmentComment) {
        
        $this->attachmentObj->getDetailsStatus($intStatusID);
        
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
        
        foreach ($intAttachmentID as $id => $value) {
            $query = "UPDATE tblAttachment SET strAttachmentLink='" . mysql_real_escape_string($strAttachmentLink[$id]) .
                    "',strAttachmentComment='" . mysql_real_escape_string($strAttachmentComment[$id]) . "' WHERE intAttachmentID=" . $intAttachmentID[$id] . ";";

            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());
        }
    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
            $strStatusNotes, $strAttachmentLink, $strAttachmentComment) {

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

        $isNextAttachment = true;
        $i = 0;
        do {
            $query = "INSERT INTO tblAttachment(intAttachmentID,intStatusID,strAttachmentLink,strAttachmentComment) " .
                    "values (NULL, '" . $nextStatusID .
                    "', '" . mysql_real_escape_string($strAttachmentLink[$i]) .
                    "', '" . mysql_real_escape_string($strAttachmentComment[$i]) . "');";
            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());            
            
            
            if (isset($_POST["strAttachmentLink" . ($i + 1)])) {
                $i++;
            } else {
                $isNextAttachment = false;
            }
        } while ($isNextAttachment == true);


    }

    function delDetails($intStatusID) {
        $query = "DELETE FROM tblStatus WHERE intStatusID='$intStatusID';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        $this->attachmentObj->delDetails($intStatusID);
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
