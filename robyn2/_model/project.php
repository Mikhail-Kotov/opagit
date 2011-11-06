<?php

class Project {

    private $sessionArr;
    private $intProjectID, $strProjectName, $strProjectTeamName;

    function __construct() {
        $this->projectDAObj = new ProjectDA();
    }

    function getDetails() {
        $projectArr = $this->projectDAObj->getDetails($this->intProjectID);
        $this->strProjectName = $projectArr['strProjectName'];
        $this->strProjectTeamName = $projectArr['strProjectTeamName'];
        
        return $projectArr;
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

}

?>
