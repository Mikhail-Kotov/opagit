<?php

class StatusDA {

    public function getDetails($intStatusID) {
        $statusDAArr = array();
        
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," . 
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

}

?>
