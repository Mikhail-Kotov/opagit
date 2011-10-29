<?php
    $attachmentObj = new Attachment();    
    $statusObj = new Status($memberObj, $projectObj, $attachmentObj);
    
    if(!(is_null($sessionArr['intStatusID']))) {
        $statusObj->setID($sessionArr['intStatusID']);
    }
?>
