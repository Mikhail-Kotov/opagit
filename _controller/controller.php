<?php

class Controller {

    function main() {
       
        $sessionObj = new Session();
        
        $sessionArr = array();

        $sessionArr['strSessionSID'] = 'SID'; // draft
        if(!empty($_POST["intSessionID"])) {
            $sessionArr['intSessionID'] = $_POST["intSessionID"];
        } else {
            $sessionArr['intSessionID'] = null;
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
        unset($sessionArr);
        $sessionArr = $sessionObj->getDetails();
        
        //var_dump($sessionArr);
        $_ENV['firephp']->log($sessionArr, 'sessionArr');
        
        
        $GUIObj = new GUI();
        $GUIObj->setSession($sessionArr);

        if (!empty($sessionArr['intMemberID'])) {
            $memberObj = new Member();
            $memberObj->setSession($sessionArr);
            $memberObj->getDetails();
        } else {
            $sessionArr['strPage'] = "choosemember";
        }

        if (!empty($sessionArr['intProjectID'])) {
            $projectObj = new Project();
            $projectObj->setSession($sessionArr);
            $projectObj->getDetails();
        }
        if ( ( (strcmp("status", substr($sessionArr['strPage'], 0, 6)) == 0) || 
               (strcmp("risk", substr($sessionArr['strPage'], 0, 4))   == 0) ||
               (strcmp("issue", substr($sessionArr['strPage'], 0, 5))  == 0)
             ) && empty($sessionArr['intProjectID']) && !empty($sessionArr['intMemberID'])) {
            $lastPage = $sessionArr['strPage'];
            $sessionArr['strPage'] = "chooseproject";
        }
        
        if(isset($memberObj) && isset($projectObj)) {
            $attachmentObj = new Attachment();    
            $statusObj = new Status($memberObj, $projectObj, $attachmentObj, $sessionObj);
    
            // init status by default
            if(!empty($sessionArr['intStatusID'])) {
                $statusObj->setID($sessionArr['intStatusID']);
            }
        }
        
        if(isset($memberObj) && !isset($projectObj)) {
            $sessionArr['strPage'] = "chooseproject";
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

        $GUIObj->menu();

        if ($sessionArr['strPage'] == "choosemember") {
            $memberObj = new Member();
            $memberObj->setSession($sessionArr);
            
            $memberGUIObj = new MemberGUI();
            $memberGUIObj->setSession($sessionArr);
            $membersArr = $memberObj->getAllDetails();
            $memberGUIObj->chooseMember($membersArr);
        }

        if ($sessionArr['strPage'] == "chooseproject") {
            $memberObj = new Member();
            $memberObj->setSession($sessionArr);
            
            $projectObj = new Project();
            $projectObj->setSession($sessionArr);
            
            $projectGUIObj = new ProjectGUI();
            $projectGUIObj->setSession($sessionArr);
            
            if(empty($lastPage)) {
                $lastPage = "welcome";
            }
            $projectGUIObj->chooseProject($lastPage);
        }

        if ($sessionArr['strPage'] == "welcome") {
            $GUIObj->welcome();
        }

        include_once("_controller/statusController.inc.php");
        include_once("_controller/riskController.inc.php");
        include_once("_controller/issueController.inc.php");

        $GUIObj->footer();
    }
}

?>
