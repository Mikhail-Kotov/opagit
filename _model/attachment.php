<?php

class Attachment {

    private $intAttachmentIDArr;
    private $strAttachmentLinkArr;
    private $strAttachmentCommentArr;
    private $intStatusID, $intRiskID, $intIssueID;
    

    function __construct() {
        $this->attachmentDAObj = new AttachmentDA();
    }
    
    function getID() {
        return $this->intAttachmentIDArr[0];
    }
    
    function getDetails() {
        if(isset($this->intAttachmentIDArr)) {
            $attachmentArray['intAttachmentIDArr'] = $this->intAttachmentIDArr;
            $attachmentArray['strAttachmentLinkArr'] = $this->strAttachmentLinkArr;
            $attachmentArray['strAttachmentCommentArr'] = $this->strAttachmentCommentArr;
        } else {
            $attachmentArray = null;
        }
        return $attachmentArray;
    }
    
    function setStatusID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    function getDetailsFromDB() {
        unset($this->intAttachmentIDArr);
        unset($this->strAttachmentLinkArr);
        unset($this->strAttachmentCommentArr);

        $attachmentArr = $this->attachmentDAObj->getDetails($this->intStatusID);

        if (isset($attachmentArr[0])) {
            foreach ($attachmentArr as $id => $value) {    
                $this->intAttachmentIDArr[$id] = $attachmentArr[$id]['intAttachmentID'];
                $this->strAttachmentLinkArr[$id] = $attachmentArr[$id]['strAttachmentLink'];
                $this->strAttachmentCommentArr[$id] = $attachmentArr[$id]['strAttachmentComment'];
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
    
    function setDetails($intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr) {
        foreach ($intAttachmentIDArr as $id => $value) {
            $query = "UPDATE tblAttachment SET strAttachmentLink='" . mysql_real_escape_string($strAttachmentLinkArr[$id]) .
                    "',strAttachmentComment='" . mysql_real_escape_string($strAttachmentCommentArr[$id]) . "' WHERE intAttachmentID=" . $intAttachmentIDArr[$id] . ";";

            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());
        }
    }
    
    function addDetails($nextStatusID, $strAttachmentLinkArr, $strAttachmentCommentArr) {
        $isNextAttachment = true;
        $i = 0;
        do {
            $query = "INSERT INTO tblAttachment(intAttachmentID,intStatusID,strAttachmentLink,strAttachmentComment) " .
                    "values (NULL, '" . $nextStatusID .
                    "', '" . mysql_real_escape_string($strAttachmentLinkArr[$i]) .
                    "', '" . mysql_real_escape_string($strAttachmentCommentArr[$i]) . "');";
            $sql = mysql_query($query);

            if (!$sql)
                die('Invalid query: ' . mysql_error());


            if (isset($_POST["strAttachmentLink" . ($i + 1)])) {
                $i++;
            } else {
                $isNextAttachment = false;
            }
        } while ($isNextAttachment == true);
    }
}

?>
