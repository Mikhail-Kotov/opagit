<?php

class Controller {

    function main() {
        $todo = "";
        $currentProjectID = "";
        $currentMemberID = "";
        $currentStatusID = "";
        
        $sessionObj = new Session();
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
        
        $sessionObj->setDetails(1, 'SID', $strPage, $strTodo, $intMemberID, $intProjectID, $intStatusID);
        $sessionArr = $sessionObj->getDetails();
        
        $GUIObj = new GUI();
        $statusGUIObj = new statusGUI();

        if (isset($sessionArr['intMemberID'])) {
            $memberObj = new Member($sessionArr['intMemberID']);
            $memberObj->getDetails();
        }

        if (isset($sessionArr['intProjectID'])) {
            $currentProjectID = $_POST["p"];
            $projectObj = new Project($currentProjectID);
            $projectObj->getDetails();
        }

        if (isset($_POST["s"])) {
            $currentStatusID = $_POST["s"];
        }
        
        if ($sessionArr['strPage'] == "statuspdf") {
            include_once("_controller/objectsInit.php");

            if (isset($statusObj->intStatusID)) {
                $statusObj->getDetails();
                include_once("_model/status/pdf.php");
            } else {
                $sessionArr['strPage'] = "statusadd";
            }
        }

        if (!($sessionArr['strPage'] == "chooseproject" || $sessionArr['strPage'] == "choosemember")) {
            include_once("_controller/objectsInit.php");
        }

        include_once("_view/header.php");

        if (!($sessionArr['strPage'] == "chooseproject" || $sessionArr['strPage'] == "choosemember")) {
            include_once("_view/menu.php");
        } else {
// don't show menu when choosing project & member
            //echo '<td width="200">&nbsp;</td>' . "\n";
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
