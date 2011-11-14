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
}

?>
