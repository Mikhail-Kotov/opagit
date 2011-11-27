<?php

class Attachment {

    private $intAttachmentIDArr;
    private $strAttachmentLinkArr;
    private $strAttachmentCommentArr;
    private $intIRS_ID, $typeOfID; // Issue, Risk or Status ID
    

    public function __construct() {
        $this->attachmentDAObj = new AttachmentDA();
    }
    
    public function getID() {
        return $this->intAttachmentIDArr[0];
    }
    
    public function getDetails() {
        if(isset($this->intAttachmentIDArr)) {
            $attachmentArray['intAttachmentIDArr'] = $this->intAttachmentIDArr;
            $attachmentArray['strAttachmentLinkArr'] = $this->strAttachmentLinkArr;
            $attachmentArray['strAttachmentCommentArr'] = $this->strAttachmentCommentArr;
        } else {
            $attachmentArray = null;
        }
        return $attachmentArray;
    }
    
    public function setID($intIRS_ID, $typeOfID) {
        $this->intIRS_ID = $intIRS_ID;
        $this->typeOfID = $typeOfID;
    }
    
    public function getDetailsFromDB() {
        unset($this->intAttachmentIDArr);
        unset($this->strAttachmentLinkArr);
        unset($this->strAttachmentCommentArr);

        $attachmentArr = $this->attachmentDAObj->getDetails($this->intIRS_ID, $this->typeOfID);

        if (isset($attachmentArr[0])) {
            foreach ($attachmentArr as $id => $value) {    
                $this->intAttachmentIDArr[$id] = $attachmentArr[$id]['intAttachmentID'];
                $this->strAttachmentLinkArr[$id] = $attachmentArr[$id]['strAttachmentLink'];
                $this->strAttachmentCommentArr[$id] = $attachmentArr[$id]['strAttachmentComment'];
            }
        }
    }
    
    public function delDetails() {
        $this->attachmentDAObj->delDetails($this->intIRS_ID, $this->typeOfID);
    }
    
    public function delIndividualDetails($intAttachmentIDArr) {
        foreach ($intAttachmentIDArr as $id => $value) {
            $this->attachmentDAObj->delIndividualDetails($intAttachmentIDArr[$id]);
        }
    }
    
    public function addDetails($strAttachmentLinkArr, $strAttachmentCommentArr) {
        $i = 0;
        while (isset($strAttachmentLinkArr[$i])) {
            $this->attachmentDAObj->addDetails($this->intIRS_ID, $this->typeOfID, $strAttachmentLinkArr[$i], $strAttachmentCommentArr[$i]);
            $i++;
        }
    }
}

?>
