<?php

class Issue {

    private $sessionArr;
    
    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }
    
    public function getHistoryDetails() {
        $query = "SELECT r.intIssueID, r.strIssueDescription FROM " .
                "tblProject AS p, tblMember AS m, tblProjectMember AS pm, tblIssue AS r WHERE " .
                " m.intMemberID = pm.intMemberID AND pm.intProjectMemberID = r.intProjectMemberID AND r.intProjectID = p.intProjectID AND " .
                "m.intMemberID = " . $this->sessionArr['intMemberID'] . " AND p.intProjectID = " . $this->sessionArr['intProjectID'] . ";";

        $sqlArr = $_ENV['db']->query($query);
        if (isset($sqlArr[0])) {
            $returnArray = $sqlArr;
        } else {
            $returnArray = null;
        }
        return $returnArray;
    }

}

?>
