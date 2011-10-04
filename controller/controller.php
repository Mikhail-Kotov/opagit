<?php
$todo = "";
$currentProjectID = "";
$currentMemberID = "";
$currentProjectMemberID = "";

if (isset($_POST["todo"])) {
    $todo = $_POST["todo"];
}

if(isset($_POST["m"])) {
    $currentMemberID = $_POST["m"];
}

if(isset($_POST["p"])) {
    $currentProjectID = $_POST["p"];
}

if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = "chooseproject";
}

if (!($page == "chooseproject" || $page == "choosemember")) {
    $currentProjectMemberID = getProjectMember($currentMemberID, $currentProjectID);
}

include_once("view/header.php");

if (!($page == "chooseproject" || $page == "choosemember")) {
    include_once("view/menu.php");
} else {
    // don't show menu
    echo '<td width="200">&nbsp;</td>'."\n";
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
    if ($todo != "") {
        if ($todo == "add") {
            $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
            $strStatusDate = $_POST["strStatusDate"];
            $strStatusActualDate = $_POST["strStatusActualDate"];
            $strStatusCondition = $_POST["strStatusCondition"];
            $strStatusDifference = $_POST["strStatusDifference"];
            $strStatusWhy = $_POST["strStatusWhy"];
            $strStatusGanttLink = $_POST["strStatusGanttLink"];
            $strStatusGanttLinkComment = $_POST["strStatusGanttLinkComment"];

            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusCondition, 
                    $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
            unset($statusObj);
        }
        
        if ($todo == "delete") {
            $currentStatusID = $_POST["s"];
            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->delDetails($currentStatusID);
            unset($statusObj);
        }
        
        if ($todo == "edit") {
            $currentStatusID = $_POST["s"];
            $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
            $strStatusDate = $_POST['strStatusDate'];
            $strStatusActualDate = $_POST['strStatusActualDate'];
            $strStatusCondition = $_POST['strStatusCondition'];
            $strStatusDifference = $_POST['strStatusDifference'];
            $strStatusWhy = $_POST['strStatusWhy'];
            $strStatusGanttLink = $_POST['strStatusGanttLink'];
            $strStatusGanttLinkComment = $_POST['strStatusGanttLinkComment'];

            $statusObj = new Status($currentProjectID, $currentProjectMemberID);
            $statusObj->setDetails($currentStatusID, $dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusCondition, 
                    $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
            unset($statusObj);
        }
    }
    
    $page = "statushistory";
}

if ($page == "statushistory") {
    include_once("model/status/init.php");
    $statusObj->getLastStatusID();
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails($statusObj->intStatusID);
        include_once("model/status/history.php");
    } else {
        $page = "statusadd";
    }
}

if ($page == "statusview") {
    include_once("model/status/init.php");
    if (isset($_POST["s"])) {
        $statusObj->intStatusID = $_POST["s"];
    } else {
        $statusObj->getLastStatusID();
    }
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails($statusObj->intStatusID);
        include_once("model/status/view.php");
    } else {
        $page = "statusadd";
    }
}

if ($page == "statusadd") {
    $statusObj = new Status($currentProjectID, $currentProjectMemberID);
    $statusObj->displayAddForm();
}

if ($page == "statusedit") {
    if (isset($_POST["s"])) {
        $currentStatusID = $_POST["s"];
        $statusObj = new Status($currentProjectID, $currentProjectMemberID);
        $statusObj->getDetails($currentStatusID);
        $statusObj->displayEditForm();
    } else {
        die("wrong data in edit form");
    }
}

if ($page == "issuehistory") {
    include_once("view/issue/history.php");
}

if ($page == "riskhistory") {
    include_once("view/risk/history.php");
}

include_once("view/footer.php");
?>
