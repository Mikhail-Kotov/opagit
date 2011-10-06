<?php
if (isset($statusObj->intStatusID)) {
    $statusObj->displayStatusHistory();
} else {
    echo "Please add a new status";
}
?>
