<?php
if ($statusObj->getID() != null) {
    $statusObj->displayStatusHistory();
} else {
    echo "Please add a new status";
}
?>
