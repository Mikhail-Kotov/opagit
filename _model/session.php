<?php

class Session {

    private $intSessionID;
    private $strSessionSID;
    private $strPage;
    private $strTodo;
    private $intMemberID, $intProjectID, $intStatusID, $intIssueID, $intRiskID; // for member, project, status, issue, risk
    private $sessionDAObj;

    public function __construct() {
        $this->sessionDAObj = new SessionDA();
        $this->intStatusID = null;
        $this->intRiskID = null;
        $this->intIssueID = null;
    }
    
    function setDetails($sessionArr) {
        $this->intSessionID = $sessionArr['intSessionID'];
        $this->strSessionSID = $sessionArr['strSessionSID'];
        $this->strPage = $sessionArr['strPage'];
        $this->strTodo = $sessionArr['strTodo'];
        $this->intMemberID = $sessionArr['intMemberID'];
        $this->intProjectID = $sessionArr['intProjectID'];
        $this->intStatusID = $sessionArr['intStatusID'];
        $this->intRiskID = $sessionArr['intRiskID'];
        $this->intIssueID = $sessionArr['intIssueID'];
        

        $this->intSessionID = $this->sessionDAObj->setDetails($this->intSessionID, $this->strSessionSID, $this->strPage, $this->strTodo, 
                $this->intMemberID, $this->intProjectID, $this->intStatusID, $this->intRiskID, $this->intIssueID); // if intSessionID is empty - create a new one
    }

    function getID() {
        return $this->intSessionID;
    }

    public function getDetails() {
        
        $sessionArr = $this->sessionDAObj->getDetails($this->intSessionID, $this->strSessionSID);
                
        $this->intSessionID = $sessionArr['intSessionID'];
        $this->strSessionSID = $sessionArr['strSessionSID'];
        $this->strPage = $sessionArr['strPage'];
        $this->strTodo = $sessionArr['strTodo'];
        $this->intMemberID = $sessionArr['intMemberID'];
        $this->intProjectID = $sessionArr['intProjectID'];
        
        if (!empty($sessionArr['intStatusID'])) {
            $this->intStatusID = $sessionArr['intStatusID'];
        } else {
            $this->intStatusID = null;
        }
        
        if (!empty($sessionArr['intRiskID'])) {
            $this->intRiskID = $sessionArr['intRiskID'];
        } else {
            $this->intRiskID = null;
        }
        
        if (!empty($sessionArr['intIssueID'])) {
            $this->intIssueID = $sessionArr['intIssueID'];
        } else {
            $this->intIssueID = null;
        }
        
        return $sessionArr;
    }
}

?>
