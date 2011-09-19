<?php

class Member {
    
    var $intMemberID, $strMemberName, $strMemberFirstName, $strMemberLastName;

    function __construct($intMemberID) {
        $this->intMemberID = $intMemberID;
    }
    
    function getDetails() {
        $query = "SELECT strMemberName, strMemberFirstName, strMemberLastName FROM tblMember WHERE intMemberID = " . $this->intMemberID . ";";

        $sqlArr = getArr($query);
        $this->strMemberName = $sqlArr[0]['strMemberName'];
        $this->strMemberFirstName = $sqlArr[0]['strMemberFirstName'];
        $this->strMemberLastName = $sqlArr[0]['strMemberLastName'];
    }

}

?>
