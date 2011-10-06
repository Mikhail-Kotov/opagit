<?php
//TODO: split this to MVC

$query = "SELECT intStatusID,intProjectMemberID,dmtStatusCurrentDate,strStatusDate,strStatusActualDate,".
        "strStatusDifference,strStatusWhy" .
        " FROM tblStatus WHERE intProjectID = '" . $this->projectObj->getID() . "';";
$sqlArr = getArr($query);

$caption = "Status History for Project: " . $this->projectObj->strProjectName;

//$arr3 = array();
foreach ($sqlArr as $intStatusID => $statusArr) {
    foreach ($statusArr as $columnName => $value) {
        switch ($columnName) {
            case "intProjectMemberID":
                $historyTableArr[$intStatusID]["intMemberName"] = $this->memberObj->getMemberName($value);
                break;
            case "dmtStatusCurrentDate":
                $historyTableArr[$intStatusID][$columnName] = date("j F Y", strtotime($value));
                break;
            default:
                $historyTableArr[$intStatusID][$columnName] = $value;
        }
    }
    $historyTableArr[$intStatusID]["strAttachmentLink"] = $this->attachmentObj->strAttachmentLink;
    $historyTableArr[$intStatusID]["strAttachmentComment"] = $this->attachmentObj->strAttachmentComment;
}


unset($columnName);
unset($statusArr);

if (isset($historyTableArr[0])) {
    echo '<table border="1" rules="all" frame="void">';
    echo "<caption>" . $caption . "</caption>\n";
    echo "<tr>\n";
    echo "<th>&nbsp;</th>\n";
    echo "<th>ID</th>\n";
    echo "<th>Member</th>\n";
    echo "<th>Creation Date</th>\n";
    echo "<th>Actual Baseline</th>\n";
    echo "<th>Plan Baseline</th>\n";
    echo "<th>Variation</th>\n";
    echo "<th>Notes/Reasons</th>\n";
    echo "<th>Attachment</th>\n";
    echo "<th>Attachment Comment</th>\n";
    echo "<th>&nbsp;</th>\n"; // for PDF
    echo "</tr>\n";

    foreach ($historyTableArr as $statusArr) {
        echo "<tr>\n";
        echo "<td>\n";
        echo '<form method="post">';
        echo '<input type="hidden" name="page" value="statusview" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $statusArr["intStatusID"] . '" />' . "\n";
        echo '<input type="submit" value="View" class="button" />' . "\n";
        echo "</form>\n";
        echo "</td>\n";
        
        foreach ($statusArr as $columnName => $value) {
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
        echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $statusArr["intStatusID"] . '" />' . "\n";
        echo '<input type="submit" value="PDF" class="button" />' . "\n";
        echo "</form>\n";
        echo "</td>\n";
        echo "</tr>\n\n";
    }
    echo '</table>';
}

?>
