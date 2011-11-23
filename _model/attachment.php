<?php

class Attachment {

    private $intAttachmentIDArr;
    private $strAttachmentLinkArr;
    private $strAttachmentCommentArr;
    private $intStatusID, $intRiskID, $intIssueID;
    

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
    
    public function setStatusID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    public function getDetailsFromDB($typeOfID) {
        unset($this->intAttachmentIDArr);
        unset($this->strAttachmentLinkArr);
        unset($this->strAttachmentCommentArr);

        $attachmentArr = $this->attachmentDAObj->getDetails($this->intStatusID, $typeOfID);

        if (isset($attachmentArr[0])) {
            foreach ($attachmentArr as $id => $value) {    
                $this->intAttachmentIDArr[$id] = $attachmentArr[$id]['intAttachmentID'];
                $this->strAttachmentLinkArr[$id] = $attachmentArr[$id]['strAttachmentLink'];
                $this->strAttachmentCommentArr[$id] = $attachmentArr[$id]['strAttachmentComment'];
            }
        }
    }
    
    public function delDetails($intStatusID) {
        $this->attachmentDAObj->delDetails($intStatusID);
    }
    
    public function setDetails($intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr) {
        foreach ($intAttachmentIDArr as $id => $value) {
            $query = "UPDATE tblAttachment SET strAttachmentLink='" . mysql_real_escape_string($strAttachmentLinkArr[$id]) .
                    "',strAttachmentComment='" . mysql_real_escape_string($strAttachmentCommentArr[$id]) . "' WHERE intAttachmentID=" . $intAttachmentIDArr[$id] . ";";

            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());
        }
    }
    
    public function addDetails($nextStatusID, $strAttachmentLinkArr, $strAttachmentCommentArr) {
        $i = 0;
        while (isset($strAttachmentLinkArr[$i])) {
            $this->attachmentDAObj->addDetails($nextStatusID, "status", $strAttachmentLinkArr[$i], $strAttachmentCommentArr[$i]);
            $i++;
        }
    }
}

?>
