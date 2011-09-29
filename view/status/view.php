<?php
echo "<b>Today is:</b> " . $_ENV['currentDate'] . "<br />";
echo "<b>Status report as of:</b> " . $this->dmtStatusCurrentDate . "<br />\n";
echo "<b>Current status is:</b> " . $this->strStatusCondition . "<br /><br />\n";
echo "<b>Actual Baseline:</b><br />" . $this->strStatusDate . "<br /><br />\n";
echo "<b>Plan Baseline:</b>" . $this->strStatusActualDate . "<br /><br />\n";
echo "<b>Variation:</b><br />\n";
echo $this->strStatusDifference . "<br /><br />\n";
echo "<b>Notes/Reasons:</b><br />\n";
echo $this->strStatusWhy . "<br /><br /><br />\n";
echo '<b>Attachment:</b><br /><a href="' . $this->strStatusGanttLink . '">' . $this->strStatusGanttLink . "</a><br /><br />\n";
echo "<b>File Comment:</b><br />" . $this->strStatusGanttLinkComment . "<br /><br />\n";
displayButton("statusedit", "Edit", $this->intMemberID, $this->intProjectID);
?>