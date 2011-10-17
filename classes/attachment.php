<?php

class Attachment {

    public $strAttachmentLink, $strAttachmentComment;
    public $intAttachmentID;

    function __construct() {
        
    }
    
    function getID() {
        return $this->intAttachmentID[0];
    }
    
    function getDetailsStatus($intStatusID) {
        unset($this->intAttachmentID);
        unset($this->strAttachmentLink);
        unset($this->strAttachmentComment);
        
        $query = "SELECT intAttachmentID, strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE intStatusID = " . $intStatusID;

        $sqlArr = getArr($query);
        $_ENV['firephp']->log($sqlArr, 'sqlArrAtt');
        
        if (isset($sqlArr[0])) {
            foreach ($sqlArr as $id => $value) {
                $this->intAttachmentID[$id] = $sqlArr[$id]['intAttachmentID'];
                $this->strAttachmentLink[$id] = $sqlArr[$id]['strAttachmentLink'];
                $this->strAttachmentComment[$id] = $sqlArr[$id]['strAttachmentComment'];
            }
        }
    }
}

?>
