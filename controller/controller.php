<?php

if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = "chooseproject";
}

include_once("inc/header.php");

if ($page == "chooseproject" || $page == "choosemember") {
    // don't show menu
    echo '<td width="200">&nbsp;</td>'."\n";
}

if ($page == "chooseproject") {
    include_once("choose/project.php");
}

if ($page == "choosemember") {
    $currentProjectID = $_POST["p"];
    include_once("choose/member.php");
}

if ($page == "mainscreen") {
    include_once("inc/menu.php");
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
            $statusObj->addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
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
    include_once("view/content.php");
}

if ($page == "addstatus") {
    include_once("inc/menu.php");
    $currentMemberID = $_POST["m"];
    $currentProjectID = $_POST["p"];
    $currentProjectMemberID = getProjectMember($currentMemberID, $currentProjectID);
    $statusObj = new Status($currentProjectID, $currentProjectMemberID);
    $statusObj->displayAddForm();
}
include_once("inc/footer.php");
?>
