<?php

class ProjectDA {

    public function getDetails($intProjectID) {
        $query = "SELECT intProjectID, strProjectName, strProjectTeamName FROM tblProject WHERE intProjectID = " . $intProjectID . ";";

        $sqlArr = $_ENV['db']->query($query);

        if (isset($sqlArr[0])) {
            $projectDAArr = $sqlArr[0];
        }

        return $projectDAArr;
    }
    
    public function getAll() {
        $allProjectsDAArr = array();
        
        $query = "SELECT * FROM tblProject;";
        $sqlArr = $_ENV['db']->query($query);

        if (isset($sqlArr[0])) {
            $allProjectsDAArr = $sqlArr;
        }
        
        return $allProjectsDAArr;
    }

}

?>
