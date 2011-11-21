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
    
    public function getDetails() {
        $memberArr = $this->memberDAObj->getDetails($this->intMemberID);
        
        $this->strMemberName = $memberArr['strMemberName'];
        $this->strMemberFirstName = $memberArr['strMemberFirstName'];
        $this->strMemberLastName = $memberArr['strMemberLastName'];
        
        return $memberArr;
    }
    
    public function getAll() {
        $allMembersArr = $this->memberDAObj->getAll();
        
        return $allMembersArr;
    }
    
    function getName() {
        if (isset($this->intMemberID)) {
            if ($this->intMemberID != "") {
                $query = "SELECT strMemberName FROM tblMember WHERE intMemberID = " . $this->intMemberID . ";";

                $sqlArr = $_ENV['db']->query($query);

                if (isset($sqlArr[0])) {
                    $returnValue = $sqlArr[0]['strMemberName'];
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
    
    function getMemberName($intProjectMemberID) {
        if (isset($intProjectMemberID)) {
            if ($intProjectMemberID != "") {
                $query = "SELECT m.strMemberFirstName,m.strMemberLastName FROM tblMember AS m, tblProjectMember AS pm ".
                        "WHERE m.intMemberID = pm.intMemberID AND pm.intProjectMemberID = " . $intProjectMemberID . ";";

                $sqlArr = $_ENV['db']->query($query);

                if (isset($sqlArr[0])) {
                    $returnValue = $sqlArr[0];
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
