<?php
if (isset($statusObj->intStatusID)) {
    $statusObj->displayStatus();
} else {
    echo "Please add a new status";
}
?>
