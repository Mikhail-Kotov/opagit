<?php
echo '<br /><table border="0"><tr><td>';
displayButton("statusadd", "Add Status", $this->intMemberID, $this->intProjectID);
echo "</td><td>";
displayButton("statushistory", "Status History", $this->intMemberID, $this->intProjectID);
echo "</td><td>";
displayButton("statusview", "View Last Status", $this->intMemberID, $this->intProjectID);
echo '</td></tr></table><br /><a href="#top">Back to Top</a>';
?>