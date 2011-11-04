<?php
echo '<div id="bottom-menu"><li><a>';
displayButton("statusadd", "Add Status", $this->projectObj->getID(), $this->memberObj->getID());
echo "</a></li><li><a>";
displayButton("statushistory", "Status History", $this->projectObj->getID(), $this->memberObj->getID());
echo "</a></li><li><a>";
displayButton("statusview", "View Last Status", $this->projectObj->getID(), $this->memberObj->getID());
echo '</a></li><a href="#top">Back to Top</a></div>';
?>