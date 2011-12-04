<?php

echo '<br /><table border="0" id="redLinks"><tr><td>';
$this->displayButtons($this->typeOfID .  'add', 'Add ' . $this->ucTypeOfID);
echo "</td><td>";
$this->displayButtons($this->typeOfID .  'history', $this->ucTypeOfID . ' History');
echo "</td><td>";
$this->displayButtons($this->typeOfID .  'view', 'View Last ' . $this->ucTypeOfID);
echo '</td></tr></table><br /><a href="#top">Back to Top</a>';

?>
