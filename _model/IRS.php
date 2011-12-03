<?php

class IRS {
    //private $IRSDAObj;
    protected $attachmentObj;
    protected $intSessionID;
    protected $memberArr, $projectArr;
    protected $intProjectMemberID;
    private $typeOfID;
    protected $IRSArr;

    function __construct($typeOfID, $memberArr, $projectArr, $intSessionID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);

        $this->memberArr = $memberArr;
        $this->projectArr = $projectArr;
        
        $this->attachmentObj = new Attachment();
        $this->intSessionID = $intSessionID;
        $this->intProjectMemberID = $this->getProjectMember();
    }

    function getProjectMember() {
        $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE" .
                " intProjectID = " . $this->projectArr['intProjectID'] .
                " AND intMemberID = " . $this->memberArr['intMemberID'] . ";";

        $sqlArr = $_ENV['db']->query($query);

        $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
        return $intProjectMemberID;
    }
    
    public function getID() {
        $intID = null;
        if(!empty($this->IRSArr['int' . $this->ucTypeOfID . 'ID'])) {
            $intID = $this->IRSArr['int' . $this->ucTypeOfID . 'ID'];
        }
        
        return $intID;
    }
    
    function setID($intID) {
        $this->IRSArr['int' . $this->ucTypeOfID . 'ID'] = $intID;
    }
    
    function getDetails() {
        $this->IRSArr = $this->IRSDAObj->getDetails($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->getDetailsFromDB();
        
        return $this->IRSArr;
    }
    
    function getLastID() {
        $intID = $this->IRSDAObj->getLastID($this->projectArr['intProjectID']);
       
        if(!empty($intID)) {
            $this->IRSArr['int' . $this->ucTypeOfID . 'ID'] = $intID;
        } else {
            unset($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
        }
        
        return $intID;
    }
    
    function getGlobalLastID() {
        $globalLastIRSID = 0;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $globalLastIRSID = $sqlArr[0]['intStatusID'];
        }
        
        return $globalLastIRSID;
    }
    
    protected function setDetails($intAttachmentIDArr, $deleteAttachmentArr) {
        $this->IRSDAObj->setDetails($this->IRSArr);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->delIndividualDetails($deleteAttachmentArr);
    }
    
    protected function addDetails($strAttachmentLinkArr, $strAttachmentCommentArr) {
        $this->IRSDAObj->addDetails($this->IRSArr);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->addDetails($strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function delDetails() {
        $this->IRSDAObj->delDetails($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->delDetails();
        unset($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
    }

}
?>
