<?php

class IRSDA {
    private $typeOfID, $ucTypeOfID, $shortTypeOfID, $intTypeOfID;
            
    public function __construct($typeOfID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
        $this->shortTypeOfID = substr($this->typeOfID, 0, 1);
        $this->intTypeOfID = 'int' . $this->ucTypeOfID . 'ID';
    }
    
    public function getDetails($intID) {
        $sqlArr = array();
        $query = "SELECT * FROM tbl" . $this->ucTypeOfID . " WHERE " . $this->intTypeOfID . "=" . $intID;
        $sqlArr = $_ENV['db']->query($query);

        if(isset($sqlArr[0])) {
            $sqlArr = $sqlArr[0];
        }
        
        return $sqlArr;
    }
    
    public function getLastID($intProjectID) {
        $intID = null;
        
        $query = "SELECT " . $this->intTypeOfID . " FROM tbl" . $this->ucTypeOfID .
                " WHERE intProjectID = " . $intProjectID .
                " ORDER BY " . $this->intTypeOfID . " DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
        
        if(isset($sqlArr[0])) {
            $intID = $sqlArr[0]['int' . $this->ucTypeOfID . 'ID'];
        }
        
        return $intID;
    }
    
    public function delDetails($intID) {
        
        $query = "DELETE FROM tbl" . $this->ucTypeOfID . " WHERE " . $this->intTypeOfID . "='" . $intID . "';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }

    public function getAll($intProjectID, $sortBy = null, $desc = null) {
        $query = "SELECT * FROM tbl" . $this->ucTypeOfID . " WHERE intProjectID = '" . $intProjectID . "'";
        if(!empty($sortBy)) {
            $query .= " ORDER BY ". $sortBy;
        }
        if($desc == true) {
            $query .= " DESC";
        }
        $query .= ";";
        $sqlArr = $_ENV['db']->query($query);
        
        return $sqlArr;
    }
    
    public function setDetails($IRSArr) {
        $IRSArr = $this->validate($IRSArr);

        $query = "UPDATE tbl" . $this->ucTypeOfID . " SET ";
        
        foreach($IRSArr as $id => $value) {
            if(!empty($value)) {
                $query .= $id . "='" . $value . "',";
            } else {
                $query .= $id . "=NULL,";
            }
        }
        // remove last comma
        $query = substr($query, 0, strlen($query) - 1);
        
        $query .= "WHERE " . $this->intTypeOfID . " = '" . $IRSArr[$this->intTypeOfID] . "';";
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
    
    public function addDetails($IRSArr) {
        $IRSArr = $this->validate($IRSArr);

        $query = "INSERT INTO tbl" . $this->ucTypeOfID . "(";
        foreach($IRSArr as $id => $value) {
            $query .= $id . ",";
        }                
        $query = substr($query, 0, strlen($query) - 1) . ") values (";
        foreach($IRSArr as $id => $value) {
            if(!empty($value)) {
                $query .= "'" . $value . "',";
            } else {
                $query .= 'NULL,';
            }
        }                
        $query = substr($query, 0, strlen($query) - 1) . ");";                

        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
    }
    
    private function validate($IRSArr) {
        foreach($IRSArr as $id => $value) {
            $IRSArr[$id] = mysql_real_escape_string($value);
        }
        
        return $IRSArr;
    }
    
    // get all risk types for Add Risk Dropdown
    public function getAllRiskTypes() {
        $query = "SELECT strRiskTypeID FROM tblRiskType";
        $sqlArr = $_ENV['db']->query($query);

        if (isset($sqlArr[0])) {
            $returnValue = $sqlArr;
        } else {
            $returnValue = null;
        }

        return $returnValue;
    }
    
    // get all issue types for Add Issue Dropdown
    public function getAllIssueTypes() {
        $query = "SELECT strIssueTypeID FROM tblIssueType";
        $sqlArr = $_ENV['db']->query($query);

        if (isset($sqlArr[0])) {
            $returnValue = $sqlArr;
        } else {
            $returnValue = null;
        }

        return $returnValue;
    }
}

?>
