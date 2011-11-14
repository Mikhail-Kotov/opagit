<?php

class StatusDA {
    private $sessionArr;
    
    public function __construct() {
        
    }
    
    public function getDetails($intStatusID) {
        $statusDAArr = array();
        
        $query = "SELECT intStatusID,intProjectMemberID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," . 
                "strStatusVariation,strStatusNotes FROM tblStatus" .
                " WHERE intStatusID = " . $intStatusID;

        $sqlArr = $_ENV['db']->query($query);

        if(isset($sqlArr[0])) {
            $statusDAArr = $sqlArr[0];
        }
        
        return $statusDAArr;
    }
    
    public function getLastStatusID($intProjectID) {
        $intStatusID = null;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " WHERE intProjectID = " . $intProjectID .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
        
        if(isset($sqlArr[0])) {
            $intStatusID = $sqlArr[0]['intStatusID'];
        }
        
        return $intStatusID;
    }
    
    public function delDetails($intStatusID) {
        $query = "DELETE FROM tblStatus WHERE intStatusID='" . $intStatusID . "';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    public function getAll($intProjectID) {
        $query = "SELECT intStatusID,intProjectMemberID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," .
                "strStatusVariation,strStatusNotes" .
                " FROM tblStatus WHERE intProjectID = '" . $intProjectID . "';";
        $sqlArr = $_ENV['db']->query($query);
        
        return $sqlArr;
    }
    
    public function setDetails($intStatusID, $intProjectID, $intProjectMemberID, $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes) {
        
        $intStatusID = mysql_real_escape_string($intStatusID);
        $intProjectID = mysql_real_escape_string($intProjectID);
        $intProjectMemberID = mysql_real_escape_string($intProjectMemberID);
        $dmtStatusCurrentDate = mysql_real_escape_string($dmtStatusCurrentDate);
        $strActualBaseline = mysql_real_escape_string($strActualBaseline);
        $strPlanBaseline = mysql_real_escape_string($strPlanBaseline );
        $strStatusVariation = mysql_real_escape_string($strStatusVariation);
        $strStatusNotes = mysql_real_escape_string($strStatusNotes);

        $query = "UPDATE tblStatus SET intProjectID='" . $intProjectID . 
                "',intProjectMemberID='" . $intProjectMemberID .
                "',dmtStatusCurrentDate='" . $dmtStatusCurrentDate .
                "',strActualBaseline='" . $strActualBaseline . 
                "',strPlanBaseline='" . $strPlanBaseline .
                "',strStatusVariation='" . $strStatusVariation . 
                "',strStatusNotes='" . $strStatusNotes . 
                "' WHERE intStatusID = '" . $intStatusID . "';";
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
    
    public function addDetails($intStatusID, $intProjectID, $intProjectMemberID, $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes) {
        
        $intStatusID = mysql_real_escape_string($intStatusID);
        $intProjectID = mysql_real_escape_string($intProjectID);
        $intProjectMemberID = mysql_real_escape_string($intProjectMemberID);
        $dmtStatusCurrentDate = mysql_real_escape_string($dmtStatusCurrentDate);
        $strActualBaseline = mysql_real_escape_string($strActualBaseline);
        $strPlanBaseline = mysql_real_escape_string($strPlanBaseline );
        $strStatusVariation = mysql_real_escape_string($strStatusVariation);
        $strStatusNotes = mysql_real_escape_string($strStatusNotes);

        
        $query = "INSERT INTO tblStatus(".
                "intStatusID," .
                "intProjectID," .
                "intProjectMemberID," .
                "dmtStatusCurrentDate," .
                "strActualBaseline," .
                "strPlanBaseline," .
                "strStatusVariation," .
                "strStatusNotes) " .
                "values (" .
                "'" . $intStatusID .
                "', '" . mysql_real_escape_string($intProjectID) .
                "', '" . mysql_real_escape_string($intProjectMemberID) .
                "', '" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "', '" . mysql_real_escape_string($strActualBaseline) .
                "', '" . mysql_real_escape_string($strPlanBaseline) .
                "', '" . mysql_real_escape_string($strStatusVariation) .
                "', '" . mysql_real_escape_string($strStatusNotes) . "');";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
}

?>
