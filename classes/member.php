<?php

class Member {
    
    var $intMemberID, $strMemberName, $strMemberFirstName, $strMemberLastName;

    function __construct($intMemberID) {
        $this->intMemberID = $intMemberID;
    }
    
    function getID() {
        return $this->intMemberID;
    }
    
    function getDetails() {
        $query = "SELECT strMemberName, strMemberFirstName, strMemberLastName FROM tblMember WHERE intMemberID = " . $this->intMemberID . ";";

        $sqlArr = getArr($query);
        $this->strMemberName = $sqlArr[0]['strMemberName'];
        $this->strMemberFirstName = $sqlArr[0]['strMemberFirstName'];
        $this->strMemberLastName = $sqlArr[0]['strMemberLastName'];
    }
    
    function getName() {
        if (isset($this->intMemberID)) {
            if ($this->intMemberID != "") {
                $query = "SELECT strMemberName FROM tblMember WHERE intMemberID = " . $this->intMemberID . ";";

                $sqlArr = getArr($query);

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
}

?>
