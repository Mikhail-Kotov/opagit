<?php
    $attachmentObj = new Attachment();    
    $statusObj = new Status($projectObj, $memberObj, $attachmentObj);
    $statusObj->setID($currentStatusID);
?>
