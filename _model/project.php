<?php

class Project {

    private $sessionArr;
    private $intProjectID, $strProjectName, $strProjectTeamName;

    public function __construct() {
        $this->projectDAObj = new ProjectDA();
    }

    public function getDetails() {
        $projectArr = $this->projectDAObj->getDetails($this->intProjectID);
        $this->strProjectName = $projectArr['strProjectName'];
        $this->strProjectTeamName = $projectArr['strProjectTeamName'];
        
        return $projectArr;
    }
    
    public function getAll() {
        $allProjectsArr = $this->projectDAObj->getAll();
        
        return $allProjectsArr;
    }
    
    public function getID() {
        return $this->intProjectID;
    }
    
    public function setID($intProjectID) {
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
