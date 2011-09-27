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
    
    function setDetails() {
        
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
        include_once("view/status/statusDisplay.php");
    }

    function displayStatusHistory() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment".
                " FROM tblStatus WHERE intProjectID = '$this->intProjectID' AND intProjectMemberID = '$this->intProjectMemberID';";
        $sqlArr = getArr($query);
        $caption = "Statuses";
        if (isset($sqlArr[0])) {
            echo '<table border="1">';
            echo "<caption>" . $caption . "</caption>\n";
            echo "<tr>\n";
            foreach ($sqlArr[0] as $row => $value) {
                echo "<th>" . $row . "</th>\n";
            }
            echo "<th>&nbsp;</th>\n<th>&nbsp;</th>\n";
            echo "</tr>\n";

            foreach ($sqlArr as $arr2) {
                echo "<tr>\n";
                foreach ($arr2 as $row => $value) {
                    echo "<td>";
                    if (isset($value))
                        echo $value; else
                        echo "&nbsp;";
                    echo "</td>\n";
                }
                echo "<td>&nbsp;";
//                echo '<form method="post">';
//                echo '<input type="hidden" name="page" value="editstatus" />' . "\n";
//                echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
//                echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
//                echo '<input type="hidden" name="dmtStatusDate" value="' . $arr2["dmtStatusDate"] . '" />' . "\n";
//                echo '<input type="submit" value="Edit" />' . "\n";
//                echo "</form>\n";
                echo "</td>\n<td>\n";
                
                echo '<form method="post">';
                echo '<input type="hidden" name="page" value="status" />' . "\n";
                echo '<input type="hidden" name="todo" value="deletestatus" />' . "\n";
                echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
                echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
                echo '<input type="hidden" name="intStatusID" value="' . $arr2["intStatusID"] . '" />' . "\n";
                echo '<input type="submit" value="Delete" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "</tr>\n\n";
            }
            echo '</table>';
        }
    }

    function printStatus() {
        
    }

    function addAttachment() {
        
    }

    function displayAddForm() {
        include_once("view/status/statusAddForm.php");
    }

}
?>
