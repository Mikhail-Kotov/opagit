<?php
 /****************************************************************************************
 * Team Name: OPA                                                                        *
 * Date: 18 Nov 2011                                                                     *
 * Version No: 3                                                                         *
 *                                                                                       *
 * File Name: member.php                                                                 *
 * Desc:This file gets and sets the member ID, gets a member details and gets all members* 
 * details.                                                                              * 
 ****************************************************************************************/
?>
<?php

class Member {

    private $sessionArr;
    private $intMemberID, $strMemberName, $strMemberFirstName, $strMemberLastName;

    function __construct() {
        $this->memberDAObj = new MemberDA();
    }
    
    function getID() {
        return $this->intMemberID;
    }
    
    function setID($intMemberID) { // private ???
        $this->intMemberID = $intMemberID;
    }
    
    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
        if(!empty($this->sessionArr['intMemberID'])) {
            $this->setID($this->sessionArr['intMemberID']);
        }
    }
    //get this member details
    public function getDetails() {
        $memberArr = $this->memberDAObj->getDetails($this->intMemberID);
        
        $this->strMemberName = $memberArr['strMemberName'];
        $this->strMemberFirstName = $memberArr['strMemberFirstName'];
        $this->strMemberLastName = $memberArr['strMemberLastName'];
        
        return $memberArr;
    }
    //function get all member details
    public function getAll() {
        $allMembersArr = $this->memberDAObj->getAll();
        
        return $allMembersArr;
    }
    
    public function getAllProjectMembers($intProjectID) {

        if (!empty($intProjectID)) {
            $query = "SELECT m.* from tblProjectMember AS pm, tblMember as m WHERE m.intMemberID = pm.intMemberID AND intProjectID =" . $intProjectID;

            $sqlArr = $_ENV['db']->query($query);

            if (isset($sqlArr[0])) {
                $returnValue = $sqlArr;
            } else {
                $returnValue = null;
            }
        } else {
            $returnValue = null;
        }

        $projectMembersArr = $returnValue;
        return $projectMembersArr;
    }
    
    //get memberID and return projectmemberID
    function getMemberID($intProjectMemberID) {
        if (isset($intProjectMemberID)) {
            if ($intProjectMemberID != "") {
                $query = "SELECT m.intMemberID FROM tblMember AS m, tblProjectMember AS pm ".
                        "WHERE m.intMemberID = pm.intMemberID AND pm.intProjectMemberID = " . $intProjectMemberID . ";";

                $sqlArr = $_ENV['db']->query($query);

                if (isset($sqlArr[0])) {
                    $returnValue = $sqlArr[0]['intMemberID'];
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
