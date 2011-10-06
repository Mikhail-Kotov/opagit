<?php
$currentStatusMessage = "<b>Today is:</b> " . $_ENV['currentDate'] . "<br />\n" . 
"<b>Status report as of:</b> " . $this->dmtStatusCurrentDate . "<br />\n" . 
"<b>Status created by:</b> " . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "<br />\n" . 
"<b>For Project:</b> " . $this->projectObj->strProjectName . "<br />\n" . 
"<b>Current status is:</b> " . $this->strStatusCondition . "<br /><br />\n" . 
"<b>Actual Baseline:</b><br />" . $this->strStatusDate . "<br /><br />\n" . 
"<b>Plan Baseline:</b><br />" . $this->strStatusActualDate . "<br /><br />\n" . 
"<b>Status Condition:</b><br />" . $this->strStatusCondition . "<br /><br />\n" . 
"<b>Variation:</b><br />\n" . 
$this->strStatusDifference . "<br /><br />\n" . 
"<b>Notes/Reasons:</b><br />\n" . 
$this->strStatusWhy . "<br /><br />\n" . 
'<b>Attachment:</b><br /><a href="' . $this->strStatusGanttLink . '">' . $this->strStatusGanttLink . "</a><br /><br />\n" . 
"<b>Attachment Comment:</b><br />" . $this->strStatusGanttLinkComment . "<br /><br />\n";

echo $currentStatusMessage;

echo '<table border="0">';
echo '<tr><td><form method="post">';
echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="Edit Status" class="button" />' . "\n";
echo '</form></td>';
echo '<td><form method="post">';
echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="PDF" class="button" />' . "\n";
echo "</form></td><td>";
echo '<form method="post">';
echo '<input type="hidden" name="page" value="status" />' . "\n";
echo '<input type="hidden" name="todo" value="delete" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="Delete" class="button" />' . "\n";
echo "</form>\n";
echo "</td></tr></table>";
?>

