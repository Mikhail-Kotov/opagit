<?php

class Session {

    private $intSessionID;
    private $strSessionSID;
    private $strPage;
    private $strTodo;
    private $intMemberID, $intProjectID, $intStatusID, $intIssueID, $intRiskID; // for member, project, status, issue, risk

    function setDetails($intSessionID, $strSessionSID, $strPage, $strTodo, $intMemberID, $intProjectID, 
            $intStatusID = null, $intIssueID = null, $intRiskID = null) {

        $this->intSessionID = $intSessionID;
        $this->strSessionSID = $strSessionSID;
        $this->strPage = $strPage;
        $this->strTodo = $strTodo;
        $this->intMemberID = $intMemberID;
        $this->intProjectID = $intProjectID;
        $this->intStatusID = $intStatusID;
        $this->intIssueID = $intIssueID;
        $this->intRiskID = $intRiskID;
    }

    function getID() {
        return $this - intSessionID;
    }

    function getDetails() {
        $sessionArr['intSessionID'] = $this->intSessionID;
        $sessionArr['strSessionSID'] = $this->strSessionSID;
        $sessionArr['strPage'] = $this->strPage;
        $sessionArr['strTodo'] = $this->strTodo;
        $sessionArr['intMemberID'] = $this->intMemberID;
        $sessionArr['intProjectID'] = $this->intProjectID;
        if (!is_null($this->intStatusID)) {
            $sessionArr['intStatusID'] = $this->intStatusID;
        }
        if (!is_null($this->intRiskID)) {
            $sessionArr['intRiskID'] = $this->intRiskID;
        }
        if (!is_null($this->intIssueID)) {
            $sessionArr['intIssueID'] = $this->intIssueID;
        }
        return $sessionArr;
    }

}

?>
