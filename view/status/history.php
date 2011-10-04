<?php
//TODO: split this to MVC

$query = "SELECT intStatusID,intProjectMemberID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,strStatusCondition,strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment" .
        " FROM tblStatus WHERE intProjectID = '$this->intProjectID';";
$sqlArr = getArr($query);
$caption = "Status History for Project: " . $this->getProjectName();
if (isset($sqlArr[0])) {
    echo '<table border="1" rules="all" frame="void">';
    echo "<caption>" . $caption . "</caption>\n";
    echo "<tr>\n";
    echo "<th>&nbsp;</th>\n";
    echo "<th>ID</th>\n";
    echo "<th>PM_ID</th>\n";
    echo "<th>Creation Date</th>\n";
    echo "<th>Actual Baseline</th>\n";
    echo "<th>Plan Baseline</th>\n";
    echo "<th>Condition</th>\n";
    echo "<th>Variation</th>\n";
    echo "<th>Notes/Reasons</th>\n";
    echo "<th>Attachment</th>\n";
    echo "<th>Attachment Comment</th>\n";
    echo "<th>&nbsp;</th>\n"; // for PDF
    if($_ENV['engineering mode'] == True) {
        echo "<th>&nbsp;</th>\n"; // for Delete
    }
    echo "</tr>\n";

    foreach ($sqlArr as $arr2) {
        echo "<tr>\n";

        echo "<td>\n";
        echo '<form method="post">';
        echo '<input type="hidden" name="page" value="statusview" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $arr2["intStatusID"] . '" />' . "\n";
        echo '<input type="submit" value="View" class="button" />' . "\n";
        echo "</form>\n";
        echo "</td>\n";
        
        foreach ($arr2 as $row => $value) {
            echo "<td>";
            if (isset($value)) {
                echo $value;
            } else {
                echo "&nbsp;";
            }
            echo "</td>\n";
        }

        echo "<td>\n";
        echo '<form method="post">';
        echo '<input type="hidden" name="page" value="status" />' . "\n";
        echo '<input type="hidden" name="todo" value="pdf" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $arr2["intStatusID"] . '" />' . "\n";
        echo '<input type="submit" value="PDF" class="button" />' . "\n";
        echo "</form>\n";
        echo "</td>\n";
        
        if($_ENV['engineering mode'] == True) {
            echo "<td>\n";
            echo '<form method="post">';
            echo '<input type="hidden" name="page" value="status" />' . "\n";
            echo '<input type="hidden" name="todo" value="delete" />' . "\n";
            echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
            echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
            echo '<input type="hidden" name="s" value="' . $arr2["intStatusID"] . '" />' . "\n";
            echo '<input type="submit" value="Delete" class="button" />' . "\n";
            echo "</form>\n";
            echo "</td>\n";
        }
        echo "</tr>\n\n";
    }
    echo '</table>';
}

include_once("view/status/bottomMenu.php");
?>
