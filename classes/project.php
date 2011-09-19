<?php

class Project {

    var $intProjectID, $strProjectName, $strProjectTeamName;

    function __construct($intProjectID) {
        $this->intProjectID = $intProjectID;
    }

    function getDetails() {
        $query = "SELECT strProjectName, strProjectTeamName FROM tblProject WHERE intProjectID = " . $this->intProjectID . ";";
        $sqlArr = getArr($query);
        $this->strProjectName = $sqlArr[0]['strProjectName'];
        $this->strProjectTeamName = $sqlArr[0]['strProjectTeamName'];
    }

}

?>
