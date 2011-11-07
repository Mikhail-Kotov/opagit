<?php

class MemberDA {

    public function getDetails($intMemberID) {
        $memberDAArr = array();
        
        $query = "SELECT intMemberID,strMemberName,strMemberFirstName,strMemberLastName FROM tblMember WHERE intMemberID = " . $intMemberID;
        
        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $memberDAArr = $sqlArr[0];
        }
        
        return $memberDAArr;
    }
    
    public function getAllDetails() {
        $membersDAArr = array();
        $sqlArr = $_ENV['db']->query("SELECT intMemberID,strMemberName,strMemberFirstName,strMemberLastName FROM tblMember;");

        if(isset($sqlArr[0])) {
            $membersDAArr = $sqlArr;
        }
        
        return $membersDAArr;
    }
}

?>
