<?php

class ProjectMember {
    public $intProjectMemberID, $intProjectID, $intMemberID;
//  public $intPermissionID;

    function __construct($projectObj, $memberObj) {
        $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE" .
                " intProjectID = " . $projectObj->getID() . 
                " AND intMemberID = " . $memberObj->getID() . ";";

        $sqlArr = getArr($query);

        $this->intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
    }

    function getID() {
        return $this->intProjectMemberID;
    }
    
    
    function getDetails() {
        $query = "SELECT intProjectMemberID,intProjectID,intMemberID FROM tblProjectMember ".
                "WHERE intProjectMemberID = " . $this->intProjectMemberID . ";";
        $sqlArr = getArr($query);
        $this->intProjectID = $sqlArr[0]['intProjectID'];
        $this->intMemberID = $sqlArr[0]['intMemberID'];
    }
}

?>
