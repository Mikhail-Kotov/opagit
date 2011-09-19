<?php

class Status {

    var $intProjectID, $intMemberID, $intProjectMemberID;
    var $strStatusCondition;
    var $dmtStatusDate, $dmtStatusCurrentDate, $dmtStatusActualDate;
    var $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment;

    function __construct($intMemberID, $intProjectID) {
        $this->intMemberID = $intMemberID;
        $this->intProjectID = $intProjectID;
        $this->intProjectMemberID = getProjectMember($this->intMemberID, $this->intProjectID);
    }

    function getDetails() {
        $query = "SELECT dmtStatusDate,dmtStatusCurrentDate,dmtStatusActualDate," . 
                "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment FROM tblStatus" .
                " WHERE intProjectID = " . $this->intProjectID .
                " AND intProjectMemberID = " . $this->intProjectMemberID .
                " AND dmtStatusDate = '2011-09-12';";

        $sqlArr = getArr($query);

        $this->dmtStatusDate = $sqlArr[0]['dmtStatusDate'];
        $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
        $this->dmtStatusActualDate = $sqlArr[0]['dmtStatusActualDate'];
        $this->strStatusDifference = $sqlArr[0]['strStatusDifference'];
        $this->strStatusWhy = $sqlArr[0]['strStatusWhy'];
        $this->strStatusGanttLink = $sqlArr[0]['strStatusGanttLink'];
        $this->strStatusGanttLinkComment = $sqlArr[0]['strStatusGanttLinkComment'];
        $diff = dateDayDiff($this->dmtStatusDate, $this->dmtStatusActualDate);
        if($diff >= 7) { // <- check & fix it later
            $this->strStatusCondition = "Ahead";
        } elseif ($diff <= -7) { // <- check & fix it later
            $this->strStatusCondition = "Behind";
        } else {
            $this->strStatusCondition = "Up to date";
        }
    }
    
    function setDetails() {
        
    }

    function addDetails($dmtStatusDate, $dmtStatusCurrentDate, $dmtStatusActualDate, $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment) {
        $blnMessage = 0; // no error
        $query = "SELECT dmtStatusDate FROM tblStatus WHERE " .
                "intProjectID='$this->intProjectID' AND intProjectMemberID='$this->intProjectMemberID' AND dmtStatusDate='$dmtStatusDate'";
        
        $sqlArr = getArr($query);
        if(count($sqlArr) == 0) {
            $query = "INSERT INTO tblStatus(intProjectID,intProjectMemberID,dmtStatusDate,dmtStatusCurrentDate,dmtStatusActualDate," .
                    "strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment)" .
                    " values ('$this->intProjectID', '$this->intProjectMemberID', '$dmtStatusDate', '$dmtStatusCurrentDate', '$dmtStatusActualDate', " .
                    "'$strStatusDifference', '$strStatusWhy', '$strStatusGanttLink', '$strStatusGanttLinkComment');";
            $sql = mysql_query($query);
            if (!$sql)
                die('Invalid query: ' . mysql_error());
        } else {
            $blnMessage = 1; // error
        }
        
        return $blnMessage;
    }

    function delDetails($dmtStatusDate) {
        $query = "DELETE FROM tblStatus where intProjectID='$this->intProjectID' and intProjectMemberID='$this->intProjectMemberID' and dmtStatusDate='$dmtStatusDate'; ";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    function displayStatus() {
        echo "<p>Today is <b>" . $_ENV['currentDate'] . "</b><br />";
        echo "Status report as of: <b>" .$this->dmtStatusCurrentDate. "</b><br />\n";
        echo "Current status is <b>" . $this->strStatusCondition . "</b><br />\n";
        echo "Where we are: <b>" . $this->dmtStatusDate. "</b><br />\n";
        echo "Where we should be: <b>" . $this->dmtStatusActualDate. "</b><br /><br />\n";
        echo "<b>Differences?</b><br />\n";
        echo $this->strStatusDifference . "<br /><br />\n";
        echo "<b>Why?</b><br />\n";
        echo $this->strStatusWhy . "<br /><br />\n";
        echo "Gantt Link: <a href=>" . $this->strStatusGanttLink . "</a><br />\n";
        echo "Gantt Comment: <b>" . $this->strStatusGanttLinkComment . "</b>\n";
        echo "</p><br />\n";
    }

    function displayStatusTable() {
        $query = "SELECT dmtStatusDate,dmtStatusCurrentDate,dmtStatusActualDate,strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment".
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
                echo '<input type="hidden" name="page" value="mainscreen" />' . "\n";
                echo '<input type="hidden" name="todo" value="deletestatus" />' . "\n";
                echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
                echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
                echo '<input type="hidden" name="dmtStatusDate" value="' . $arr2["dmtStatusDate"] . '" />' . "\n";
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
        ?>
        <h3>Add Status for selected date:</h3>
        <form method="post">
            <input type="hidden" name="page" value="mainscreen" />
            <input type="hidden" name="todo" value="addstatus" />
            <input type="hidden" name="m" value="<?php echo $this->intMemberID; ?>" />
            <input type="hidden" name="p" value="<?php echo $this->intProjectID; ?>" />
            Status Creation Date:<br />
            <input type="text" name="dmtStatusCurrentDate" value="<?php echo $_ENV['currentDate']; ?>"/><br />
            Where we are:<br />
            <input type="text" name="dmtStatusDate" /><br />
            Where we should be:<br />
            <input type="text" name="dmtStatusActualDate" /><br />
            Difference:<br />
            <textarea name="strStatusDifference"></textarea><br />
            Why:<br />
            <textarea name="strStatusWhy"></textarea><br />
            Gantt Link:<br />
            <input type="text" name="strStatusGanttLink" value="http://"/><br />
            Gantt Link Comment:<br />
            <input type="text" name="strStatusGanttLinkComment" /><br />
            <br />
            <input type="submit" value="Submit New Status" />
        </form>
        <?php
    }

}
?>
