<?php

echo '<table border="0"><tr><td id="add">';
$this->displayButtons($this->typeOfID .  'add', 'Add ' . $this->ucTypeOfID);
echo '</td><td id="history">';
$this->displayButtons($this->typeOfID .  'history', $this->ucTypeOfID . ' History');
echo '</td><td id="view">';
$this->displayButtons($this->typeOfID .  'view', 'View Last ' . $this->ucTypeOfID);
echo '</td></tr></table><br /><a id="toTop" href="#top">Back to Top</a>';

?>