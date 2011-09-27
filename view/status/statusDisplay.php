<?php
echo "<p>Today is <b>" . $_ENV['currentDate'] . "</b><br />";
echo "Status report as of: <b>" . $this->dmtStatusCurrentDate . "</b><br />\n";
echo "Current status is <b>" . $this->strStatusCondition . "</b><br />\n";
echo "Where we are: <b>" . $this->strStatusDate . "</b><br />\n";
echo "Where we should be: <b>" . $this->strStatusActualDate . "</b><br /><br />\n";
echo "<b>Differences?</b><br />\n";
echo $this->strStatusDifference . "<br /><br />\n";
echo "<b>Why?</b><br />\n";
echo $this->strStatusWhy . "<br /><br />\n";
echo "Gantt Link: <a href=>" . $this->strStatusGanttLink . "</a><br />\n";
echo "Gantt Comment: <b>" . $this->strStatusGanttLinkComment . "</b>\n";
echo "</p><br />\n";
?>
