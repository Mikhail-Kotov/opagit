<?php
    $attachmentObj = new Attachment();    
    $statusObj = new Status($memberObj, $projectObj, $attachmentObj);
    
    if($currentStatusID != "") {
        $statusObj->setID($sessionArr['intStatusID']);
    }
?>
