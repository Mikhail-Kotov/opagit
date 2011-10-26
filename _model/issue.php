<?php

class Issue {

    function echoIssueTable($intMemberID, $intProjectID) {
        $query = "SELECT r.intIssueID, r.strIssueDescription FROM " .
                "tblProject AS p, tblMember AS m, tblProjectMember AS pm, tblIssue AS r WHERE " .
                " m.intMemberID = pm.intMemberID AND pm.intProjectMemberID = r.intProjectMemberID AND r.intProjectID = p.intProjectID AND " .
                "m.intMemberID = " . $intMemberID . " AND p.intProjectID = " . $intProjectID . ";";
        echoTable($query, "Issues");
    }


}

?>
