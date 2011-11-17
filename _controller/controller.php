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
            $memberArr = $memberObj->getDetails();
        } else {
            $sessionArr['strPage'] = "choosemember";
        }

        if (!empty($sessionArr['intProjectID'])) {
            $projectObj = new Project();
            $projectObj->setSession($sessionArr);
            $projectArr = $projectObj->getDetails();
        }
        if ( ( (strcmp("status", substr($sessionArr['strPage'], 0, 6)) == 0) || 
               (strcmp("risk", substr($sessionArr['strPage'], 0, 4))   == 0) ||
               (strcmp("issue", substr($sessionArr['strPage'], 0, 5))  == 0)
             ) && empty($sessionArr['intProjectID']) && !empty($sessionArr['intMemberID'])) {
            $lastPage = $sessionArr['strPage'];
            $sessionArr['strPage'] = "chooseproject";
        }
        


        
        if(isset($memberObj) && !isset($projectObj)) {
            $sessionArr['strPage'] = "chooseproject";
        }
        
        $is_pdf = strpos($sessionArr['strPage'], "pdf");
        if ($is_pdf === false) {
            $GUIObj->header();
            $GUIObj->menu();

            if ($sessionArr['strPage'] == "choosemember") {
                $memberObj = new Member();
                $memberObj->setSession($sessionArr);
                $allMembersArr = $memberObj->getAll();
                
                $projectObj = new Project();
                $projectObj->setSession($sessionArr);
                $allProjectsArr = $projectObj->getAll();
                
                $loginGUIObj = new LoginGUI();
                $loginGUIObj->setSession($sessionArr);
                $loginGUIObj->displayLoginForm($allMembersArr, $allProjectsArr);
            }

            if ($sessionArr['strPage'] == "chooseproject") {
                $memberObj = new Member();
                $memberObj->setSession($sessionArr);

                $projectObj = new Project();
                $projectObj->setSession($sessionArr);

                $projectGUIObj = new ProjectGUI();
                $projectGUIObj->setSession($sessionArr);

                if (empty($lastPage)) {
                    $lastPage = "welcome";
                }
                $projectGUIObj->chooseProject($lastPage);
            }

            if ($sessionArr['strPage'] == "welcome") {
                $GUIObj->welcome();
            }
        }
        
        if(!empty($sessionArr['intMemberID']) && !empty($sessionArr['intProjectID'])) {
            $is_status = strpos($sessionArr['strPage'], "status");
            $is_risk = strpos($sessionArr['strPage'], "risk");
            $is_issue = strpos($sessionArr['strPage'], "issue");
            
            if($is_status !== false) {
                $statusControllerObj = new StatusController($memberArr, $projectArr, $sessionArr);
                $statusControllerObj->main();
            }
            
            if($is_risk !== false) {
                include_once("_controller/riskController.inc.php");
            }
            
            if($is_issue !== false) {
                include_once("_controller/issueController.inc.php");
            }
        }
        
        if ($is_pdf === false) {
            $GUIObj->footer();
        }
    }
}

?>
