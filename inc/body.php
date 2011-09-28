<?php

if (isset($_POST["page"])) {
    $page = $_POST["page"];
    echo "<h1>[$page]</h1>\n";
    
    if ($page == "choosemember") {
        $currentProjectID = $_POST["p"];
        include_once("choose/member.php");
    }
    if ($page == "mainscreen") {
        $currentMemberID = $_POST["m"];
        $currentProjectID = $_POST["p"];
        $currentProjectMemberID = getProjectMember($currentMemberID, $currentProjectID);
        if (isset($_POST["todo"])) {
            $todo = $_POST["todo"];
            if ($todo == "addstatus") {
                $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
                $strStatusDate = $_POST["strStatusDate"];
                $strStatusActualDate = $_POST["strStatusActualDate"];
                $strStatusDifference = $_POST["strStatusDifference"];
                $strStatusWhy = $_POST["strStatusWhy"];
                $strStatusGanttLink = $_POST["strStatusGanttLink"];
                $strStatusGanttLinkComment = $_POST["strStatusGanttLinkComment"];

                $statusObj = new Status($currentProjectID, $currentProjectMemberID);
                $statusObj->addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, 
                        $strStatusDifference,$strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
                unset($statusObj);
            }
            if ($todo == "deletestatus") {
                $intStatusID = $_POST["intStatusID"];
                $statusObj = new Status($currentProjectID, $currentProjectMemberID);
                $statusObj->delDetails($intStatusID);
                unset($statusObj);
            }
            if ($todo == "editstatus") {
                $intStatusID = $_POST["intStatusID"];
                $statusObj = new Status($currentProjectID, $currentProjectMemberID);
                $statusObj->setDetails($intStatusID);
                unset($statusObj);
            }
        }
        include_once("display/main_screen.php");
    }
    if ($page == "addstatus") {
        $currentMemberID = $_POST["m"];
        $currentProjectID = $_POST["p"];
        $currentProjectMemberID = getProjectMember($currentMemberID, $currentProjectID);
        $statusObj = new Status($currentProjectID, $currentProjectMemberID);
        $statusObj->displayAddForm();
    }
} else {
    echo "<h1>[chooseproject]</h1>\n";
    include_once("choose/project.php");
}
?>
