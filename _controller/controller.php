<?php

class Controller {

    function main() {

        $sessionObj = new Session();

        $sessionArr = array();

        $sessionArr['strSessionSID'] = 'SID'; // draft
        if (!empty($_POST["intSessionID"])) {
            $sessionArr['intSessionID'] = $_POST["intSessionID"];
        } else {
            $sessionArr['intSessionID'] = null;
        }

        if (!empty($_POST["page"])) {
            $sessionArr['strPage'] = $_POST["page"];
        } else {
            $sessionArr['strPage'] = "choosemember";
        }

        if (!empty($_POST["todo"])) {
            $sessionArr['strTodo'] = $_POST["todo"];
        } else {
            $sessionArr['strTodo'] = null;
        }

        if (!empty($_POST['ssousername'])) {
            $ssousername = $_POST['ssousername'];
        } else {
            $ssousername = null;
        }

        if (!empty($_POST['password'])) {
            $password = $_POST['password'];
        } else {
            $password = null;
        }

        if (isset($_POST["m"])) {
            $sessionArr['intMemberID'] = $_POST["m"];
        } else {
            $sessionArr['intMemberID'] = null;
        }

        if (isset($_POST["p"])) {
            $sessionArr['intProjectID'] = $_POST["p"];
        } else {
            $sessionArr['intProjectID'] = null;
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
        unset($sessionArr);
        $sessionArr = $sessionObj->getDetails();

        //var_dump($sessionArr);
        $_ENV['firephp']->log($sessionArr, 'sessionArr');


        $GUIObj = new GUI();
        $GUIObj->setSession($sessionArr);

        if (!empty($sessionArr['intMemberID']) && !empty($sessionArr['intProjectID'])) {
            $memberObj = new Member();
            $memberObj->setSession($sessionArr);
            $memberArr = $memberObj->getDetails();

            $projectObj = new Project();
            $projectObj->setSession($sessionArr);
            $projectArr = $projectObj->getDetails();
        } else {
            if (empty($ssousername) || empty($password)) {
                $sessionArr['strPage'] = "login";
            }
        }

        $is_pdf = strpos($sessionArr['strPage'], "pdf");
        if ($is_pdf === false) {
            $GUIObj->header();
            $GUIObj->menu();

            if ($sessionArr['strPage'] == "welcome") {
                if (empty($sessionArr['intMemberID'])) {
                    $query = "SELECT intMemberID, strMemberPassword FROM tblMember WHERE strMemberName='" . $ssousername . "';";
                    $sqlArr = $_ENV['db']->query($query);

                    if (isset($sqlArr[0])) {
                        $strMemberPassword = $sqlArr[0]['strMemberPassword'];

                        if (crypt($password, $strMemberPassword) == $strMemberPassword) {
                            echo "Password verified!<br />\n";
                            $sessionArr['intMemberID'] = $sqlArr[0]['intMemberID'];

                            // Session sync with DB
                            $sessionObj->setDetails($sessionArr);

                            $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE intMemberID='" . $sessionArr['intMemberID'] .
                                    "' AND intProjectID='" . $sessionArr['intProjectID'] . "' LIMIT 1;";
                            $sqlArr = $_ENV['db']->query($query);

                            if (isset($sqlArr[0])) {
                                $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
                            } else {
                                // ALERT: incorrect project
                                $sessionArr['strPage'] = "chooseproject";
                            }
                            $GUIObj->welcome();
                        } else {
                            // ALERT: Wrong ID or Password
                            echo "password not correct";
                            $sessionArr['strPage'] = "login";
                        }
                    } else {
                        // ALERT: Wrong ID or Password
                        echo "user not exist";
                        $sessionArr['strPage'] = "login";
                    }
                } else {
                    $GUIObj->welcome();
                }
            }

            if ($sessionArr['strPage'] == "chooseproject") {
                $projectObj = new Project();
                $projectObj->setSession($sessionArr);

                $projectGUIObj = new ProjectGUI();
                $projectGUIObj->setSession($sessionArr);

                $projectGUIObj->chooseProject();
            }

            if ($sessionArr['strPage'] == "login") {
                $memberObj = new Member();
                $allMembersArr = $memberObj->getAll();

                $projectObj = new Project();
                $allProjectsArr = $projectObj->getAll();

                $loginGUIObj = new LoginGUI();
                $loginGUIObj->setSession($sessionArr);
                $loginGUIObj->displayLoginForm($allMembersArr, $allProjectsArr);
            }
        }

        if (!empty($sessionArr['intMemberID']) && !empty($sessionArr['intProjectID'])) {
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
    }

}

?>
