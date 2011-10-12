<?php
    $attachmentObj = new Attachment();    
    $statusObj = new Status($projectObj, $memberObj, $attachmentObj);
    
    if($currentStatusID != "") {
        $statusObj->setID($currentStatusID);
    }
?>
