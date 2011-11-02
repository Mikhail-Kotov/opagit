<?php

class Project {

    private $sessionArr;
    public $intProjectID, $strProjectName, $strProjectTeamName;

    function __construct() {
        
    }

    function getDetails() {
        $query = "SELECT strProjectName, strProjectTeamName FROM tblProject WHERE intProjectID = " . $this->sessionArr['intProjectID'] . ";";
        $sqlArr = $_ENV['db']->query($query);
        $this->strProjectName = $sqlArr[0]['strProjectName'];
        $this->strProjectTeamName = $sqlArr[0]['strProjectTeamName'];
    }
    
    function getID() {
        return $this->intProjectID;
    }
    
    function setID($intProjectID) {
        $this->intProjectID = $intProjectID;
    }
    
    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
        if(!empty($this->sessionArr['intProjectID'])) {
            $this->setID($this->sessionArr['intProjectID']);
        }
    }
    
    function getName($intProjectID = null) {
        if(is_null($intProjectID)) {
            $intProjectID = $this->intProjectID;
        }
        if (isset($this->intProjectID)) {
            if ($this->intProjectID != "") {
                $query = "SELECT strProjectName FROM tblProject WHERE intProjectID = " . $intProjectID . ";";

                $sqlArr = $_ENV['db']->query($query);

                if (isset($sqlArr[0])) {
                    $returnValue = $sqlArr[0]['strProjectName'];
                } else {
                    $returnValue = null;
                }
            } else {
                $returnValue = null;
            }
        } else {
            $returnValue = null;
        }

        return $returnValue;
    }
}

?>
