<?php

class AttachmentDA {
    // typeOfID: 'status', 'risk' or 'issue'
    
    public function getDetails($intIRS_ID, $typeOfID) {
        $query = "SELECT intAttachmentID,strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE int" . ucfirst($typeOfID) . "ID = " . $intIRS_ID;
        $attachmentArr = $_ENV['db']->query($query);
        
        return $attachmentArr;
    }

    public function addDetails($intIRS_ID, $typeOfID, $strAttachmentLink, $strAttachmentComment) {
        $query = "INSERT INTO tblAttachment(intAttachmentID,int" . ucfirst($typeOfID) . "ID,strAttachmentLink,strAttachmentComment) " .
                    "VALUES (NULL, '" . $intIRS_ID .
                    "', '" . mysql_real_escape_string($strAttachmentLink) .
                    "', '" . mysql_real_escape_string($strAttachmentComment) . "');";
            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());
        
    }
    
    public function delDetails($intIRS_ID, $typeOfID) {
        $query = "DELETE FROM tblAttachment WHERE int" . ucfirst($typeOfID) . "ID = " . $intIRS_ID;
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
    
    public function delIndividualDetails($intAttachmentID) {
        $query = "DELETE FROM tblAttachment WHERE intAttachmentID = " . $intAttachmentID;
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
}

?>
