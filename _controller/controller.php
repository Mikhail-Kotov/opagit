<?php

class Controller {

    function main() {
       
        $sessionObj = new Session();

        
        $sessionArr = array();

        $sessionArr['strSessionSID'] = 'SID'; // draft
        if(!empty($_POST["intSessionID"])) {
            $sessionArr['intSessionID'] = $_POST["intSessionID"];
        } else {
            $sessionArr['intSessionID'] = 1; // draft
        }

        if(!empty($_POST["page"])) {
            $sessionArr['strPage'] = $_POST["page"];
        } else {
            $sessionArr['strPage'] = "choosemember";
        }

        if(!empty($_POST["todo"])) {
            $sessionArr['strTodo'] = $_POST["todo"];
        } else {
            $sessionArr['strTodo'] = null;
        }

        if(isset($_POST["m"])) {
            $sessionArr['intMemberID'] = $_POST["m"];
        } else {
            $sessionArr['intMemberID'] = null;
        }
        
        if(isset($_POST["p"])) {
            $sessionArr['intProjectID'] = $_POST["p"];
        } else {
            $sessionArr['intProjectID'] = null;
        }
  
        if(isset($_POST["s"])) {
            $sessionArr['intStatusID'] = $_POST["s"];
        } else {
            $sessionArr['intStatusID'] = null;
        }
        
        if(isset($_POST["r"])) {
            $sessionArr['intRiskID'] = $_POST["s"];
        } else {
            $sessionArr['intRiskID'] = null;
        }
        
        if(isset($_POST["i"])) {
            $sessionArr['intIssueID'] = $_POST["s"];
        } else {
            $sessionArr['intIssueID'] = null;
        }  
        
        $sessionObj->setDetails($sessionArr);
        $sessionArr = $sessionObj->getDetails();
        
        var_dump($sessionArr);
        //$sessionObj->setDetails(1, 'SID', $strPage, $strTodo, $intMemberID, $intProjectID, $intStatusID);
        
        $GUIObj = new GUI();
        $GUIObj->setSession($sessionArr);

        if (!empty($sessionArr['intMemberID'])) {
            $memberObj = new Member($sessionArr['intMemberID']);
            $memberObj->getDetails();
        }

        if (!empty($sessionArr['intProjectID'])) {
            $projectObj = new Project($sessionArr['intProjectID']);
            $projectObj->getDetails();
        }

        if (!($sessionArr['strPage'] == "chooseproject" || $sessionArr['strPage'] == "choosemember") || $sessionArr['strPage'] == "statuspdf") {
            $attachmentObj = new Attachment();    
            $statusObj = new Status($memberObj, $projectObj, $attachmentObj);
    
            // init status by default
            if(!empty($sessionArr['intStatusID'])) {
                $statusObj->setID($sessionArr['intStatusID']);
                $statusGUIObj = new statusGUI($memberObj, $projectObj);
            }
        }

        if ($sessionArr['strPage'] == "statuspdf") {
            if(!(is_null($sessionArr['intStatusID']))) {
                $statusObj->getDetails();
                $statusObj->pdfStatus();
            } else {
                $sessionArr['strPage'] = "statusadd";
            }
        }        
        
        $GUIObj->header();
        //include_once("_view/header.php");

        if (!($sessionArr['strPage'] == "chooseproject" || $sessionArr['strPage'] == "choosemember")) {
            include_once("_view/menu.php");
        } else {
// don't show menu when choosing project & member
            echo '<td width="200">&nbsp;</td>' . "\n";
        }

        if ($sessionArr['strPage'] == "choosemember") {
            include_once("_view/member/choose.php");
        }

        if ($sessionArr['strPage'] == "chooseproject") {
            $memberObj = new Member($sessionArr['intMemberID']);
            include_once("_view/project/choose.php");
        }

        if ($sessionArr['strPage'] == "main") {
            include_once("_view/main.php");
        }

        include_once("_controller/statusController.php");

        if ($sessionArr['strPage'] == "issuehistory") {
            include_once("_view/issue/history.php");
        }

        if ($sessionArr['strPage'] == "riskhistory") {
            include_once("_view/risk/history.php");
        }

        include_once("_view/footer.php");
    }
}

?>
