<?php

class AttachmentDA {

    public function getDetails($intStatusID) {
        $query = "SELECT intAttachmentID,strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE intStatusID = " . $intStatusID;
        $attachmentArr = $_ENV['db']->query($query);
        
        return $attachmentArr;
    }

}

?>
