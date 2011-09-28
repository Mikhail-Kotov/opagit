<?php

if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = "chooseproject";
}

include_once("view/header.php");

if ($page == "chooseproject" || $page == "choosemember") {
    // don't show menu
    echo '<td width="200">&nbsp;</td>'."\n";
} else {
    $currentMemberID = $_POST["m"];
    $currentProjectID = $_POST["p"];
    $currentProjectMemberID = getProjectMember($currentMemberID, $currentProjectID);    
    include_once("view/menu.php");
}

if ($page == "chooseproject") {
    include_once("view/project/choose.php");
}

if ($page == "choosemember") {
    $currentProjectID = $_POST["p"];
    include_once("view/member/choose.php");
}

if ($page == "main") {
    include_once("view/main.php");
}

if ($page == "status") {
    if (isset($_POST["todo"])) {
        $todo = $_POST["todo"];
        
        if ($todo == "add") {
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
        
        if ($todo == "delete") {
            $intStatusID = $_POST["s"];
            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->delDetails($intStatusID);
            unset($statusObj);
        }
        
        if ($todo == "edit") {
            $intStatusID = $_POST["s"];
            $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
            $strStatusDate = $_POST['strStatusDate'];
            $strStatusActualDate = $_POST['strStatusActualDate'];
            $strStatusDifference = $_POST['strStatusDifference'];
            $strStatusWhy = $_POST['strStatusWhy'];
            $strStatusGanttLink = $_POST['strStatusGanttLink'];
            $strStatusGanttLinkComment = $_POST['strStatusGanttLinkComment'];

            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->setDetails($intStatusID, $dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
            unset($statusObj);
        }
    }
    
    $page = "statushistory";
}

if ($page == "statushistory") {
    include_once("model/status/init.php");
    include_once("model/status/history.php");
}

if ($page == "statusview") {
    include_once("model/status/init.php");
    include_once("model/status/view.php");
}

if ($page == "statusadd") {
    $statusObj = new Status($currentProjectID, $currentProjectMemberID);
    $statusObj->displayAddForm();
}

if ($page == "statusedit") {
    $statusObj = new Status($currentProjectID, $currentProjectMemberID);
    $statusObj->getDetails();
    $statusObj->displayEditForm();
}

if ($page == "issuehistory") {
    include_once("view/issue/history.php");
}

if ($page == "riskhistory") {
    include_once("view/risk/history.php");
}

include_once("view/footer.php");
?>
