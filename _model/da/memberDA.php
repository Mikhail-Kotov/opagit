<?php

class MemberDA {
    //this function returns details for one member
    public function getDetails($intMemberID) {
        $memberDAArr = array();
        
        $query = "SELECT intMemberID,strMemberName,strMemberFirstName,strMemberLastName FROM tblMember WHERE intMemberID = " . $intMemberID;
        
        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $memberDAArr = $sqlArr[0];
        }
        
        return $memberDAArr;
    }
    
    //function to return details for all members
    public function getAll() {
        $allMembersDAArr = array();
        $sqlArr = $_ENV['db']->query("SELECT intMemberID,strMemberName,strMemberFirstName,strMemberLastName FROM tblMember;");

        if(isset($sqlArr[0])) {
            $allMembersDAArr = $sqlArr;
        }
        
        return $allMembersDAArr;
    }
}

?>
