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
    include_once("view/project/projectChoose.php");
}

if ($page == "choosemember") {
    $currentProjectID = $_POST["p"];
    include_once("view/member/memberChoose.php");
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
            $intStatusID = $_POST["intStatusID"];
            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->delDetails($intStatusID);
            unset($statusObj);
        }
        
        if ($todo == "edit") {
            $intStatusID = $_POST["intStatusID"];
            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->setDetails($intStatusID);
            unset($statusObj);
        }
    }
    
    include_once("view/status/statusHistory.php");
}

if ($page == "statushistory") {
    include_once("view/status/statusHistory.php");
}

if ($page == "statusview") {
    include_once("view/status/statusView.php");
}


if ($page == "statusadd") {
    $statusObj = new Status($currentProjectID, $currentProjectMemberID);
    $statusObj->displayAddForm();
}

if ($page == "issuehistory") {
    include_once("view/issue/issueHistory.php");
}

if ($page == "riskhistory") {
    include_once("view/risk/riskHistory.php");
}

include_once("view/footer.php");
?>
