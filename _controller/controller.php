<?php

class Controller {

    function main() {
       
        $sessionObj = new Session();

        $strSessionSID = 'SID'; // draft

        if(!empty($_POST["intSessionID"])) {
            $intSessionID = $_POST["intSessionID"];
        } else {
            $intSessionID = 1; // draft
        }
     
        if(isset($_POST["page"])) {
            $strPage = $_POST["page"];
        } else {
            $strPage = "choosemember";
        }

        if(isset($_POST["todo"])) {
            $strTodo = $_POST["todo"];
        } else {
            $strTodo = null;
        }

        if(isset($_POST["m"])) {
            $intMemberID = $_POST["m"];
        } else {
            $intMemberID = null;
        }
        
        if(isset($_POST["p"])) {
            $intProjectID = $_POST["p"];
        } else {
            $intProjectID = null;
        }
        
  
        if(isset($_POST["s"])) {
            $intStatusID = $_POST["s"];
        } else {
            $intStatusID = null;
        }
        
        $sessionObj->setDetails($intSessionID, $strSessionSID, $strPage, $strTodo, $intMemberID, $intProjectID, $intStatusID);
        $sessionArr = $sessionObj->getDetails($intSessionID, $strSessionSID);
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
