<?php

class Controller {

    function main() {
        // GET SIMS login
        if (!empty($_POST['ssousername'])) {
            $ssousername = $_POST['ssousername'];
        } else {
            $ssousername = null;
        }

        // GET SIMS password
        if (!empty($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $password = null;
        }

        // init session Object & Array
        $sessionObj = new Session();
        $sessionArr = array(); 

        if (!empty($_POST["page"])) {
            $post_page = $_POST["page"];
        } else {
            $post_page = "login"; // page by default
        }
        
        // get POST and put some of them to the SessionArr
        if (!empty($_POST["intSessionID"])) { // will be set from cookie
            $sessionArr['intSessionID'] = $_POST["intSessionID"];
            $sessionObj->setID($sessionArr['intSessionID']);
            $sessionArr = $sessionObj->getDetails();
            
            $sessionArr['strPage'] = $post_page;

            $sessionArr['strSessionSID'] = 'SID'; // will compared with SID from the cookie

            if (!empty($_POST["todo"])) {
                $sessionArr['strTodo'] = $_POST["todo"];
            } else {
                $sessionArr['strTodo'] = null;
            }

            if(!empty($_POST["p"])) {
                $sessionArr['intProjectID'] = $_POST["p"];
            }
            
            if (isset($_POST["s"])) {
                $sessionArr['intStatusID'] = $_POST["s"];
            } else {
                $sessionArr['intStatusID'] = null;
            }

            if (isset($_POST["r"])) {
                $sessionArr['intRiskID'] = $_POST["s"];
            } else {
                $sessionArr['intRiskID'] = null;
            }

            if (isset($_POST["i"])) {
                $sessionArr['intIssueID'] = $_POST["s"];
            } else {
                $sessionArr['intIssueID'] = null;
            }

            $sessionObj->setDetails($sessionArr);
        } else {
            $sessionArr['intSessionID'] = null;
            $sessionArr['strSessionSID'] = 'SID'; // generate random SID
            $sessionArr['strPage'] = "login";
            $sessionArr['strTodo'] = null;
            $sessionArr['strAlert'] = ""; // no alert message by default
            $sessionArr['intMemberID'] = null;
            $sessionArr['intProjectID'] = null;

            $sessionObj->setDetails($sessionArr);
            $sessionArr['intSessionID'] = $sessionObj->getID();
        }
        
        $_ENV['firephp']->log($sessionArr, 'sessionArr BEGIN');

        $GUIObj = new GUI();
        $GUIObj->setSession($sessionArr);
        $memberObj = new Member();
        $projectObj = new Project();
        
        if (!empty($sessionArr['intMemberID']) && !empty($sessionArr['intProjectID'])) {
            $memberObj->setSession($sessionArr);
            $memberArr = $memberObj->getDetails();

            $projectObj->setSession($sessionArr);
            $projectArr = $projectObj->getDetails();
        }

        $is_pdf = strpos($sessionArr['strPage'], "pdf");
        if ($is_pdf === false) {
            $GUIObj->header();
            
            if ($sessionArr['strPage'] == "welcome") {
                if (!empty($sessionArr['intMemberID'])) {
                    $this->displayWelcome($GUIObj, $sessionArr);
                } else {
                    if (!empty($ssousername)) {
                        $query = "SELECT intMemberID, strMemberPassword FROM tblMember WHERE strMemberName='" . $ssousername . "';";
                        $sqlArr = $_ENV['db']->query($query);

                        if (isset($sqlArr[0])) {
                            $strMemberPassword = $sqlArr[0]['strMemberPassword'];

                            if (crypt($password, $strMemberPassword) == $strMemberPassword) {
                                $sessionArr['intMemberID'] = $sqlArr[0]['intMemberID'];
                                $sessionObj->setDetails($sessionArr);

                                $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE intMemberID='" . $sessionArr['intMemberID'] .
                                        "' AND intProjectID='" . $sessionArr['intProjectID'] . "' LIMIT 1;";
                                $sqlArr = $_ENV['db']->query($query);

                                // Checking is project correct for current Member
                                if (isset($sqlArr[0])) {
                                    $this->displayWelcome($GUIObj, $sessionArr);
                                } else {
                                    // ALERT: incorrect project
                                    $sessionArr['strAlert'] = "incorrect project";
                                    $sessionArr['strPage'] = "chooseproject";
                                }
                            } else {
                                $sessionArr['strPage'] = "login";
                                $sessionArr['strAlert'] = "password not correct";
                            }
                        } else {
                            $sessionArr['strPage'] = "login";
                            $sessionArr['strAlert'] = "user not exist 111";
                        }
                    } else {
                        $sessionArr['strPage'] = "login";
                        $sessionArr['strAlert'] = "user not exist 222";
                    }
                 }
            }

            if ($sessionArr['strPage'] == "login") {
                $allMembersArr = array();
                //$allMembersArr = $memberObj->getAll();
                $allProjectsArr = $projectObj->getAll();
                
                $GUIObj->menu();
                
                if (!empty($sessionArr['strAlert'])) { $GUIObj->alert($sessionArr['strAlert']); }

                $loginGUIObj = new LoginGUI();
                $loginGUIObj->setSession($sessionArr);
                $loginGUIObj->displayLoginForm($allMembersArr, $allProjectsArr);
            }
            
            if ($sessionArr['strPage'] == "chooseproject") {
                $projectObj->setSession($sessionArr);
                
                $query = "SELECT p.intProjectID, p.strProjectName FROM " .
                "tblMember AS m," .
                "tblProject AS p," .
                "tblProjectMember AS pm " .
                "WHERE " .
                "m.intMemberID = pm.intMemberID AND " .
                "pm.intProjectID = p.intProjectID AND " .
                "m.intMemberID = " . $sessionArr['intMemberID'] . ";";
                //echo $query;
                $arr = $_ENV['db']->query($query);

                if (count($arr) == 1) {
                    $sessionArr['intProjectID'] = $arr[0]['intProjectID'];
                    $sessionArr['strAlert'] = "Did you mean to choose " . $arr[0]['strProjectName'] . 
                            "?<br />You are logged in to " . $arr[0]['strProjectName'] . ".";
                    $sessionArr['strPage'] = "welcome";

                    $this->displayWelcome($GUIObj, $sessionArr);
                } else {
                    $GUIObj->setSession($sessionArr);
                    $GUIObj->menu();
                    if (!empty($sessionArr['strAlert'])) { $GUIObj->alert($sessionArr['strAlert']); }
                    $projectGUIObj = new ProjectGUI();
                    $projectGUIObj->setSession($sessionArr);
                    $projectGUIObj->chooseProject();
                }
            }
        }

        if (!empty($sessionArr['intMemberID']) && !empty($sessionArr['intProjectID'])) {
            $GUIObj->menu();

            $is_status = strpos($sessionArr['strPage'], "status");
            $is_risk = strpos($sessionArr['strPage'], "risk");
            $is_issue = strpos($sessionArr['strPage'], "issue");

            if ($is_status !== false) {
                $statusControllerObj = new StatusController($memberArr, $projectArr, $sessionArr);
                $statusControllerObj->main();
            }

            if ($is_risk !== false) {
                include_once("_controller/riskController.inc.php");
            }

            if ($is_issue !== false) {
                include_once("_controller/issueController.inc.php");
            }
        }

        if ($is_pdf === false) {
            $GUIObj->footer();
        }
        
        $sessionArr['strAlert'] = null;
        $sessionObj->setDetails($sessionArr);
        
        $_ENV['firephp']->log($sessionArr, 'sessionArr END');
    }
    
    private function displayWelcome($GUIObj ,$sessionArr) {
        $GUIObj->setSession($sessionArr);
        $GUIObj->menu();
        if (!empty($sessionArr['strAlert'])) {
            $GUIObj->alert($sessionArr['strAlert']);
        }
        $GUIObj->welcome();
    }

}

?>
