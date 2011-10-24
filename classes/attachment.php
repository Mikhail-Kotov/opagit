<?php

class Attachment {

    private $intAttachmentID;
    private $strAttachmentLink;
    private $strAttachmentComment;
    

    function __construct() {
        
    }
    
    function getID() {
        return $this->intAttachmentID[0];
    }
    
    function getDetails() {
        $attachmentArray['intAttachmentID'] = $this->intAttachmentID;
        $attachmentArray['strAttachmentLink'] = $this->strAttachmentLink;
        $attachmentArray['strAttachmentComment'] = $this->strAttachmentComment;
        return $attachmentArray;
    }
    
    function getDetailsStatus($intStatusID) {
        unset($this->intAttachmentID);
        unset($this->strAttachmentLink);
        unset($this->strAttachmentComment);
        
        $query = "SELECT intAttachmentID, strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE intStatusID = " . $intStatusID;

        $sqlArr = $_ENV['db']->query($query);
        $_ENV['firephp']->log($sqlArr, 'sqlArrAtt');
        
        if (isset($sqlArr[0])) {
            foreach ($sqlArr as $id => $value) {
                $this->intAttachmentID[$id] = $sqlArr[$id]['intAttachmentID'];
                $this->strAttachmentLink[$id] = $sqlArr[$id]['strAttachmentLink'];
                $this->strAttachmentComment[$id] = $sqlArr[$id]['strAttachmentComment'];
            }
        }
    }
    
    function delDetails($intStatusID) {
        $query = "DELETE FROM tblAttachment WHERE intStatusID='$intStatusID';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        //$db->del('tblAttachment', $intStatusID);
    }
}

?>
