<?php

echo '<br /><table border="0" id="redLinks"><tr><td>';
$this->displayStatusButtons("statusadd", "Add Status");
echo "</td><td>";
$this->displayStatusButtons("statushistory", "Status History");
echo "</td><td>";
$this->displayStatusButtons("statusview", "View Last Status");
echo '</td></tr></table><br /><a href="#top">Back to Top</a>';

?>
