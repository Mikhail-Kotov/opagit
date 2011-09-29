<?php

class Status {

    public $intStatusID, $intProjectID, $intMemberID, $intProjectMemberID;
    public $strStatusCondition;
    public $dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate;
    public $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment;

    function __construct($intMemberID, $intProjectID) {
        $this->intMemberID = $intMemberID;
        $this->intProjectID = $intProjectID;
        $this->intProjectMemberID = getProjectMember($this->intMemberID, $this->intProjectID);
    }

    function getDetails() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate," . 
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment FROM tblStatus" .
                " WHERE intProjectID = " . $this->intProjectID .
                " AND intProjectMemberID = " . $this->intProjectMemberID .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = getArr($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strStatusDate = $sqlArr[0]['strStatusDate'];
            $this->strStatusActualDate = $sqlArr[0]['strStatusActualDate'];
            $this->strStatusDifference = $sqlArr[0]['strStatusDifference'];
            $this->strStatusWhy = $sqlArr[0]['strStatusWhy'];
            $this->strStatusGanttLink = $sqlArr[0]['strStatusGanttLink'];
            $this->strStatusGanttLinkComment = $sqlArr[0]['strStatusGanttLinkComment'];
            $diff = dateDayDiff($this->strStatusDate, $this->strStatusActualDate);
            if ($diff >= 7) { // <- check & fix it later
                $this->strStatusCondition = "Ahead";
            } elseif ($diff <= -7) { // <- check & fix it later
                $this->strStatusCondition = "Behind";
            } else {
                $this->strStatusCondition = "Up to date";
            }
        }
    }
    
    function setDetails($intStatusID,$dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment) {
        $query = "UPDATE tblStatus SET intProjectID='$this->intProjectID',intProjectMemberID='$this->intProjectMemberID',dmtStatusCurrentDate='$dmtStatusCurrentDate',strStatusDate='$strStatusDate',strStatusActualDate='$strStatusActualDate'," .
                "strStatusDifference='$strStatusDifference',strStatusWhy='$strStatusWhy',strStatusGanttLink='$strStatusGanttLink',strStatusGanttLinkComment='$strStatusGanttLinkComment' WHERE intStatusID = '$intStatusID';";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    function addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusDifference, 
            $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment) {
            
        $query = "INSERT INTO tblStatus(intStatusID,intProjectID,intProjectMemberID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate," .
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment)" .
                " values (NULL, '$this->intProjectID', '$this->intProjectMemberID', '$dmtStatusCurrentDate', '$strStatusDate', '$strStatusActualDate', " .
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

}
?>
