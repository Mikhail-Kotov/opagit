<?php
//TODO: split this to MVC

$query = "SELECT intStatusID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,strStatusDifference,strStatusWhy,strStatusGanttLink,strStatusGanttLinkComment" .
        " FROM tblStatus WHERE intProjectID = '$this->intProjectID' AND intProjectMemberID = '$this->intProjectMemberID';";
$sqlArr = getArr($query);
$caption = "Status History";
if (isset($sqlArr[0])) {
    echo '<table border="1">';
    echo "<caption>" . $caption . "</caption>\n";
    echo "<tr>\n";
    echo "<th>&nbsp;</th>\n";
    foreach ($sqlArr[0] as $row => $value) {
        echo "<th>" . $row . "</th>\n";
    }
    echo "<th>&nbsp;</th>\n"; // for PDF
    if($_ENV['enable_status_delete'] == True) {
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
        echo '<input type="submit" value="View" />' . "\n";
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
        echo '<input type="submit" value="PDF" />' . "\n";
        echo "</form>\n";
        echo "</td>\n";
        
        if($_ENV['enable_status_delete'] == True) {
            echo "<td>\n";
            echo '<form method="post">';
            echo '<input type="hidden" name="page" value="status" />' . "\n";
            echo '<input type="hidden" name="todo" value="delete" />' . "\n";
            echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
            echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
            echo '<input type="hidden" name="s" value="' . $arr2["intStatusID"] . '" />' . "\n";
            echo '<input type="submit" value="Delete" />' . "\n";
            echo "</form>\n";
            echo "</td>\n";
        }
        echo "</tr>\n\n";
    }
    echo '</table>';
}

include_once("view/status/bottomMenu.php");
?>
