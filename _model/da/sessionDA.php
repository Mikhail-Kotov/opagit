<?php

class SessionDA {
   
    public function setDetails($intSessionID, $strSessionSID, $strPage, $strTodo, $strAlert, $intMemberID, $intProjectID, $intStatusID, $intRiskID, $intIssueID) {
        $strPage = mysql_real_escape_string($strPage);
        $strTodo = mysql_real_escape_string($strTodo);
        $strAlert = mysql_real_escape_string($strAlert);
        $intMemberID = mysql_real_escape_string($intMemberID);
        $intProjectID = mysql_real_escape_string($intProjectID);
        $intStatusID = mysql_real_escape_string($intStatusID);
        $intRiskID = mysql_real_escape_string($intRiskID);
        $intIssueID = mysql_real_escape_string($intIssueID);
        
        if(!empty($intSessionID)) {
            $intSessionID = mysql_real_escape_string($intSessionID);
            
            $query = "UPDATE tblSession SET ";
            if(!empty($strPage)) { $query .= "strPage='" . $strPage . "'"; }
            if(!empty($strTodo)) { $query .= ",strTodo='" . $strTodo . "'";  } else { $query .= ",strTodo=NULL"; }
            if(!empty($strAlert)) { $query .= ",strAlert='" . $strAlert . "'";  } else { $query .= ",strAlert=NULL"; }
            if(!empty($intMemberID)) { $query .= ",intMemberID='" . $intMemberID . "'"; }
            if(!empty($intProjectID)) { $query .= ",intProjectID='" . $intProjectID . "'"; } 
            if(!empty($intStatusID)) { $query .= ",intStatusID='" . $intStatusID . "'"; } else { $query .= ",intStatusID=NULL"; }
            if(!empty($intRiskID)) { $query .= ",intRiskID='" . $intRiskID . "'"; }  else { $query .= ",intRiskID=NULL"; }
            if(!empty($intIssueID)) { $query .= ",intIssueID='" . $intIssueID . "'"; }  else { $query .= ",intIssueID=NULL"; }
            $query .= " WHERE intSessionID = '" . $intSessionID . "';"; // AND SID
        } else {
            // find out next intSessionID
            $query = "SELECT intSessionID FROM tblSession ORDER BY intSessionID DESC LIMIT 1;";

            $sqlArr = $_ENV['db']->query($query);
           
            if(!empty($sqlArr[0])) {
                $intSessionID = intval($sqlArr[0]['intSessionID']) + 1; // bug ???
            } else {
                $intSessionID = 1;
            }
            
            $query = "INSERT INTO tblSession (intSessionID,strSessionSID";
            if(!empty($strPage)) { $query .= ",strPage"; }
            if(!empty($strTodo)) { $query .= ",strTodo"; }
            if(!empty($strAlert)) { $query .= ",strAlert"; }
            if(!empty($intMemberID)) { $query .= ",intMemberID"; }
            if(!empty($intProjectID)) { $query .= ",intProjectID"; }
            if(!empty($intStatusID)) { $query .= ",intStatusID"; }
            if(!empty($intRiskID)) { $query .= ",intRiskID"; }
            if(!empty($intIssueID)) { $query .= ",intIssueID"; }
            $query .= ") VALUES (" .
                    $intSessionID . 
                    ",'" . $strSessionSID  . "'";
            if(!empty($strPage)) { $query .= ",'" . $strPage . "'"; }
            if(!empty($strTodo)) { $query .= ",'" . $strTodo . "'"; }
            if(!empty($strAlert)) { $query .= ",'" . $strAlert . "'"; }
            if(!empty($intMemberID)) { $query .= "," . $intMemberID; }
            if(!empty($intProjectID)) { $query .= "," . $intProjectID; }
            if(!empty($intStatusID)) { $query .= "," . $intStatusID; }
            if(!empty($intRiskID)) { $query .= "," . $intRiskID; }
            if(!empty($intIssueID)) { $query .= "," . $intIssueID; }
            $query .= ");";
        }
               
        //$_ENV['db']->query($query);
        $sql = mysql_query($query);
        if (!$sql) {
            die('Invalid query: ' . mysql_error());
        }
        
        return $intSessionID;
    }
    
    public function getDetails($intSessionID, $strSessionSID) {
        $query = "SELECT intSessionID, strSessionSID, strPage, strTodo, strAlert, intMemberID, intProjectID, intStatusID FROM tblSession" . 
                 " WHERE intSessionID = '" . $intSessionID . "';";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $sessionDAArr = $sqlArr[0];
        }
        
        return $sessionDAArr;
    }
}

?>
