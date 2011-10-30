<?php
class sessionDA {

    
    public function setDetails($intSessionID, $strSessionSID, $strPage, $strTodo, $intMemberID, $intProjectID, $intStatusID) {
        $query = "UPDATE tblSession SET ";
        if(!is_null($strPage)) { $query .= "strPage='" . mysql_real_escape_string($strPage) . "'"; } else { $query .= "strPage=NULL"; }
        if(!is_null($strPage)) { $query .= ",strTodo='" . mysql_real_escape_string($strTodo) . "'"; } else { $query .= ",strTodo=NULL"; }
        if(!is_null($intMemberID)) { $query .= ",intMemberID='" . mysql_real_escape_string($intMemberID) . "'"; } 
        if(!is_null($intStatusID)) { $query .= ",intProjectID='" . mysql_real_escape_string($intProjectID) . "'"; } 
        if(!is_null($intMemberID)) { $query .= ",intStatusID='" . mysql_real_escape_string($intStatusID) . "'"; } 
        $query .= " WHERE intSessionID = '" . mysql_real_escape_string($intSessionID) . "';"; // AND SID
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
    
    public function getDetails($intSessionID, $strSessionSID) {
        $query = "SELECT intSessionID, strSessionSID, strPage, strTodo, intMemberID, intProjectID, intStatusID FROM tblSession" . 
                 " WHERE intSessionID = '" . $intSessionID . "';";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $sessionDAArr = $sqlArr[0];
        }
        
        return $sessionDAArr;
    }
}

?>
