<?php
echo '<br /><table border="0"><tr><td>';
displayButton("statusadd", "Add Status", $this->projectObj->getID(), $this->memberObj->getID());
echo "</td><td>";
displayButton("statushistory", "Status History", $this->projectObj->getID(), $this->memberObj->getID());
echo "</td><td>";
displayButton("statusview", "View Last Status", $this->projectObj->getID(), $this->memberObj->getID());
echo '</td></tr></table><br /><a href="#top">Back to Top</a>';
?>