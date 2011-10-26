<?php

class Risk {

    function echoRiskTable($intMemberID, $intProjectID) {
        $query = "SELECT r.intRiskID, r.strRiskDescription FROM " .
                "tblProject AS p, tblMember AS m, tblProjectMember AS pm, tblRisk AS r WHERE " .
                " m.intMemberID = pm.intMemberID AND pm.intProjectMemberID = r.intProjectMemberID AND r.intProjectID = p.intProjectID AND " .
                "m.intMemberID = " . $intMemberID . " AND p.intProjectID = " . $intProjectID . ";";
        echoTable($query, "Risks");
    }

}

?>
