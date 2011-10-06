<?php

class Attachment {

    public $strAttachmentLink, $strAttachmentComment;
    private $intAttachmentID;

    function __construct() {
        
    }
    
    function getID() {
        return $this->intAttachmentID;
    }
    
    function getDetailsStatus($intStatusID) {
        $query = "SELECT intAttachmentID, strAttachmentLink,strAttachmentComment FROM tblAttachment WHERE intStatusID = " . $intStatusID;

        $sqlArr = getArr($query);
        $_ENV['firephp']->log($sqlArr, 'sqlArrAtt');
        
        if(isset($sqlArr[0])) {
            $this->intAttachmentID = $sqlArr[0]['intAttachmentID'];
            $this->strAttachmentLink = $sqlArr[0]['strAttachmentLink'];
            $this->strAttachmentComment = $sqlArr[0]['strAttachmentComment'];
        }
    }
}

?>
