<?php

class IRSDA {
    private $typeOfID, $ucTypeOfID;
            
    public function __construct($typeOfID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
    }
    
    public function getDetails($intID) {
        
        $sqlArr = array();
        
        $query = "SELECT * FROM tbl" . $this->ucTypeOfID . " WHERE int" . $this->ucTypeOfID . "ID = " . $intID;

        $sqlArr = $_ENV['db']->query($query);

        if(isset($sqlArr[0])) {
            $sqlArr = $sqlArr[0];
        }
        
        return $sqlArr;
    }
    
    public function getLastID($intProjectID) {
        $intID = null;
        
        $query = "SELECT int" . $this->ucTypeOfID . "ID FROM tbl" . $this->ucTypeOfID .
                " WHERE intProjectID = " . $intProjectID .
                " ORDER BY int" . $this->ucTypeOfID . "ID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
        
        if(isset($sqlArr[0])) {
            $intID = $sqlArr[0]['int' . $this->ucTypeOfID . 'ID'];
        }
        
        return $intID;
    }
    
    public function delDetails($intID) {
        
        $query = "DELETE FROM tbl" . $this->ucTypeOfID . " WHERE int" . $this->ucTypeOfID . "ID='" . $intID . "';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    public function getAll($intProjectID) {
        $query = "SELECT * FROM tbl" . $this->ucTypeOfID . " WHERE intProjectID = '" . $intProjectID . "';";
        $sqlArr = $_ENV['db']->query($query);
        
        return $sqlArr;
    }
    
    public function setDetails($IRSArr) {
        foreach($IRSArr as $id => $value) {
            $IRSArr[$id] = mysql_real_escape_string($value);
        }
        
        print_r($IRSArr);

        $query = "UPDATE tbl" . $this->ucTypeOfID . " SET ";
        
        foreach($IRSArr as $id => $value) {
            $query .= $id . "='" . $value . "', ";
        }
        // remove last comma
        $query = substr($query, 0, strlen($query) - 1);
        
        $query .= "WHERE int" . $this->ucTypeOfID . "ID = '" . $IRSArr['int' . $this->ucTypeOfID . 'ID'] . "';";
        
//        $sql = mysql_query($query);
//
//        if (!$sql)
//            die('Invalid query: ' . mysql_error());
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
