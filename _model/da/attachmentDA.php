<?php

class AttachmentDA {

    public function getDetails($intStatusID) {
        $query = "SELECT intAttachmentID,strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE intStatusID = " . $intStatusID;
        $attachmentArr = $_ENV['db']->query($query);
        
        return $attachmentArr;
    }

    public function delDetails($intStatusID) {
        $query = "DELETE FROM tblAttachment WHERE intStatusID='$intStatusID';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
}

?>
