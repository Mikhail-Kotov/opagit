<?php

class IRSDA {
    private $typeOfID, $ucTypeOfID;
            
    public function __construct($typeOfID) {
        $this->typeOfID = $typeOfID;
        
        // upper case type of ID like Status, Risk or Issue
        $this->ucTypeOfID = ucfirst($this->typeOfID);
    }
    
    public function getDetails($intID) {
        $sqlArr = array();
        $query = "SELECT * FROM tbl" . $this->ucTypeOfID . " WHERE int" . $this->ucTypeOfID . "ID=" . $intID;
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
            $query .= $id . "='" . $value . "',";
        }
        // remove last comma
        $query = substr($query, 0, strlen($query) - 1);
        
        $query .= "WHERE int" . $this->ucTypeOfID . "ID = '" . $IRSArr['int' . $this->ucTypeOfID . 'ID'] . "';";
        
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
            $query .= "'" . $value . "',";
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
}

?>
