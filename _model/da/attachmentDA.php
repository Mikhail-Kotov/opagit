<?php

class AttachmentDA {
    // typeOfID: 'status', 'risk' or 'issue'
    
    public function getDetails($intID, $typeOfID) {
        $query = "SELECT intAttachmentID,strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE int" . ucfirst($typeOfID) . "ID = " . $intID;
        $attachmentArr = $_ENV['db']->query($query);
        
        return $attachmentArr;
    }

    public function addDetails($intID, $typeOfID, $strAttachmentLink, $strAttachmentComment) {
        $query = "INSERT INTO tblAttachment(intAttachmentID,int" . ucfirst($typeOfID) . "ID,strAttachmentLink,strAttachmentComment) " .
                    "VALUES (NULL, '" . $intID .
                    "', '" . mysql_real_escape_string($strAttachmentLink) .
                    "', '" . mysql_real_escape_string($strAttachmentComment) . "');";
            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());
        
    }
    
    public function delDetails($intID, $typeOfID) {
        $query = "DELETE FROM tblAttachment WHERE int" . ucfirst($typeOfID) . "ID = " . $intID;
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
}

?>
