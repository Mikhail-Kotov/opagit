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
                $dmtStatusDate = $_POST["dmtStatusDate"];
                $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
                $dmtStatusActualDate = $_POST["dmtStatusActualDate"];
                $strStatusDifference = $_POST["strStatusDifference"];
                $strStatusWhy = $_POST["strStatusWhy"];
                $strStatusGanttLink = $_POST["strStatusGanttLink"];
                $strStatusGanttLinkComment = $_POST["strStatusGanttLinkComment"];

                $statusObj = new Status($currentProjectID, $currentProjectMemberID);
                if($statusObj->addDetails($dmtStatusDate, $dmtStatusCurrentDate, $dmtStatusActualDate, 
                        $strStatusDifference,$strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment) == 1) {
                    echo '<b><font size="3" color="red">Status not added, because status with this date already exists</font></b><br>'; // <- fix it later
                }
                unset($statusObj);
            }
            if ($todo == "deletestatus") {
                $dmtStatusDate = $_POST["dmtStatusDate"];
                $statusObj = new Status($currentProjectID, $currentProjectMemberID);
                $statusObj->delDetails($dmtStatusDate);
                unset($statusObj);
            }
            if ($todo == "editstatus") {
                $dmtStatusDate = $_POST["dmtStatusDate"];
                $statusObj = new Status($currentProjectID, $currentProjectMemberID);
                $statusObj->setDetails($dmtStatusDate);
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
