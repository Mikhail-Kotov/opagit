<?php
if (isset($statusObj->intStatusID)) {
    $statusObj->pdfStatus();
} else {
    echo "Please add a new status";
}
?>
