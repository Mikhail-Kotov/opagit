<?php
echo "<b>Today is:</b> " . $_ENV['currentDate'] . "<br />";
echo "<b>Status report as of:</b> " . $this->dmtStatusCurrentDate . "<br />\n";
echo "<b>Status created by:</b> " . $this->getFirstName() . " " . $this->getLastName() . "<br />\n";
echo "<b>For Project:</b> " . $this->getProjectName() . "<br />\n";
echo "<b>Current status is:</b> " . $this->strStatusCondition . "<br /><br />\n";
echo "<b>Actual Baseline:</b><br />" . $this->strStatusDate . "<br /><br />\n";
echo "<b>Plan Baseline:</b><br />" . $this->strStatusActualDate . "<br /><br />\n";
echo "<b>Variation:</b><br />\n";
echo $this->strStatusDifference . "<br /><br />\n";
echo "<b>Notes/Reasons:</b><br />\n";
echo $this->strStatusWhy . "<br /><br /><br />\n";
echo '<b>Attachment:</b><br /><a href="' . $this->strStatusGanttLink . '">' . $this->strStatusGanttLink . "</a><br /><br />\n";
echo "<b>Attachment Comment:</b><br />" . $this->strStatusGanttLinkComment . "<br /><br />\n";
echo '<table border="0">';
echo '<tr><td><form method="post">';
echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="Edit Status" />' . "\n";
echo '</form></td>';
echo '<td><form method="post">';
echo '<input type="hidden" name="page" value="status" />' . "\n";
echo '<input type="hidden" name="todo" value="pdf" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->intMemberID . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->intProjectID . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="PDF" />' . "\n";
echo "</form></td></tr></table>";

include_once("view/status/bottomMenu.php");
?>

