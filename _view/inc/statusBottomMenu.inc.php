<?php

echo '<br /><table border="0" id="redLinks"><tr><td>';
displayButton("statusadd", "Add Status", $this->sessionArr['intSessionID']);
echo "</td><td>";
displayButton("statushistory", "Status History", $this->sessionArr['intSessionID']);
echo "</td><td>";
displayButton("statusview", "View Last Status", $this->sessionArr['intSessionID']);
echo '</td></tr></table><br /><a href="#top">Back to Top</a>';

?>
