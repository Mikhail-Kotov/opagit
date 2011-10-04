<?php

class Project {

    public $intProjectID, $strProjectName, $strProjectTeamName;

    function __construct($intProjectID) {
        $this->intProjectID = $intProjectID;
    }

    function getDetails() {
        $query = "SELECT strProjectName, strProjectTeamName FROM tblProject WHERE intProjectID = " . $this->intProjectID . ";";
        $sqlArr = getArr($query);
        $this->strProjectName = $sqlArr[0]['strProjectName'];
        $this->strProjectTeamName = $sqlArr[0]['strProjectTeamName'];
    }
    
    function getID() {
        return $this->intProjectID;
    }
    
    function getName($intProjectID = null) {
        if(is_null($intProjectID)) {
            $intProjectID = $this->intProjectID;
        }
        if (isset($this->intProjectID)) {
            if ($this->intProjectID != "") {
                $query = "SELECT strProjectName FROM tblProject WHERE intProjectID = " . $intProjectID . ";";

                $sqlArr = getArr($query);

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
