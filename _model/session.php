<?php

class Session {

    private $intSessionID;
    private $strSessionSID;
    private $strPage;
    private $strTodo;
    private $intMemberID, $intProjectID, $intStatusID, $intIssueID, $intRiskID; // for member, project, status, issue, risk
    private $sessionDAObj;

    public function __construct() {
        $this->sessionDAObj = new sessionDA();
    }
    
    function setDetails($intSessionID, $strSessionSID, $strPage, $strTodo, $intMemberID, $intProjectID, 
            $intStatusID = null, $intIssueID = null, $intRiskID = null) {

        $this->sessionDAObj->setDetails(1, 'SID', $this->strPage, $this->strTodo, $this->intMemberID, $this->intProjectID, $this->intStatusID);
    }

    function getID() {
        return $this - intSessionID;
    }

    function getDetails($intSessionID, $strSessionSID) {
        
        $sessionArr = $this->sessionDAObj->getDetails($intSessionID, $strSessionSID);
                
        $this->intSessionID = $sessionArr['intSessionID'];
        $this->strSessionSID = $sessionArr['strSessionSID'];
        $this->strPage = $sessionArr['strPage'];
        $this->strTodo = $sessionArr['strTodo'];
        $this->intMemberID = $sessionArr['intMemberID'];
        $this->intProjectID = $sessionArr['intProjectID'];
        
        if (!empty($sessionArr['intStatusID'])) {
            $this->intStatusID = $sessionArr['intStatusID'];
        }
        
        if (!empty($sessionArr['intRiskID'])) {
            $this->intRiskID = $sessionArr['intRiskID'];
        }
        
        if (!empty($sessionArr['intIssueID'])) {
            $this->intIssueID = $sessionArr['intIssueID'];
        }
        
        return $sessionArr;
    }

}

?>
