<?php

class MemberDA {

    public function getDetails($intMemberID) {
        $query = "SELECT intMemberID,strMemberName,strMemberFirstName,strMemberLastName FROM tblMember WHERE intMemberID = " . $intMemberID;
        
        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $memberDAArr = $sqlArr[0];
        }
        
        return $memberDAArr;
    }
    
}

?>
