<?php

class Status {

    public $intStatusID, $intProjectID, $intMemberID, $intProjectMemberID;
    public $dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusCondition;
    public $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment;

    function __construct($intProjectID, $intProjectMemberID) {
        $this->intProjectID = $intProjectID;
        $this->intProjectMemberID = $intProjectMemberID;
        $this->intMemberID = getMember_from_tblProjectMember($intProjectID, $intProjectMemberID);
    }

    function getDetails($intStatusID) {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,strStatusCondition," . 
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment FROM tblStatus" .
                " WHERE intStatusID = " . $intStatusID;

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strStatusDate = $sqlArr[0]['strStatusDate'];
            $this->strStatusActualDate = $sqlArr[0]['strStatusActualDate'];
            $this->strStatusCondition = $sqlArr[0]['strStatusCondition'];
            $this->strStatusDifference = $sqlArr[0]['strStatusDifference'];
            $this->strStatusWhy = $sqlArr[0]['strStatusWhy'];
            $this->strStatusGanttLink = $sqlArr[0]['strStatusGanttLink'];
            $this->strStatusGanttLinkComment = $sqlArr[0]['strStatusGanttLinkComment'];
        }
    }
    
    function getLastStatusID() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,strStatusCondition," .
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment FROM tblStatus" .
                " WHERE intProjectID = " . $this->intProjectID .
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
            $strStatusCondition,
            $strStatusDifference,
            $strStatusWhy,
            $strStatusGanttLink,
            $strStatusGanttLinkComment) {
        $query = "UPDATE tblStatus SET intProjectID='$this->intProjectID',intProjectMemberID='$this->intProjectMemberID',dmtStatusCurrentDate='$dmtStatusCurrentDate',".
                "strStatusDate='$strStatusDate',strStatusActualDate='$strStatusActualDate',strStatusCondition='$strStatusCondition'," .
                "strStatusDifference='$strStatusDifference',strStatusWhy='$strStatusWhy',strStatusGanttLink='$strStatusGanttLink',".
                "strStatusGanttLinkComment='$strStatusGanttLinkComment' WHERE intStatusID = '$intStatusID';";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    function addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusCondition,$strStatusDifference, 
            $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment) {
            
        $query = "INSERT INTO tblStatus(intStatusID,intProjectID,intProjectMemberID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,strStatusCondition," .
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment)" .
                " values (NULL, '$this->intProjectID', '$this->intProjectMemberID', '$dmtStatusCurrentDate', '$strStatusDate', '$strStatusActualDate', '$strStatusCondition'," .
                "'$strStatusDifference', '$strStatusWhy', '$strStatusGanttLink', '$strStatusGanttLinkComment');";
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
    }

    function displayStatusHistory() {
        include_once("view/status/history.php");
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

    function getFirstName() {
        $query = "SELECT strMemberFirstName FROM tblMember WHERE intMemberID = " . $this->intMemberID . ";";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $returnValue = $sqlArr[0]['strMemberFirstName'];
        } else {
            $returnValue = null;
        }
        
        return $returnValue;
    }
    
    function getLastName() {
        $query = "SELECT strMemberLastName FROM tblMember WHERE intMemberID = " . $this->intMemberID . ";";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $returnValue = $sqlArr[0]['strMemberLastName'];
        } else {
            $returnValue = null;
        }
        
        return $returnValue;
    }
    
    function getProjectName() {
        $query = "SELECT strProjectName FROM tblProject WHERE intProjectID = " . $this->intProjectID . ";";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $returnValue = $sqlArr[0]['strProjectName'];
        } else {
            $returnValue = null;
        }
        
        return $returnValue;
    }
    
    function getProjects() {
        $query = "SELECT p.intProjectID,p.strProjectName FROM tblProject as p, tblMember AS m, tblProjectMember AS pm "."
            WHERE p.intProjectID = pm.intProjectID AND m.intMemberID = pm.intMemberID AND m.intMemberID=". $this->intMemberID . ";";

        $sqlArr = getArr($query);
        return $sqlArr;
    }
}
?>
