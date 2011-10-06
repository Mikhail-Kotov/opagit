<?php
$todo = "";
$currentProjectID = "";
$currentMemberID = "";
$currentStatusID = "";

if (isset($_POST["todo"])) {
    $todo = $_POST["todo"];
}

if(isset($_POST["p"])) {
    $currentProjectID = $_POST["p"];
    $projectObj = new Project($currentProjectID);
    $projectObj->getDetails();
}

if(isset($_POST["m"])) {
    $currentMemberID = $_POST["m"];
    $memberObj = new Member($currentMemberID);
    $memberObj->getDetails();
}

if (isset($_POST["s"])) {
    $currentStatusID = $_POST["s"];
}

if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = "chooseproject";
}

if ($page == "statuspdf") {
    $statusObj = new Status($projectObj, $memberObj);
    $statusObj->setID($currentStatusID);
    
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("model/status/pdf.php");
    } else {
        $page = "statusadd";
    }
}

if (!($page == "chooseproject" || $page == "choosemember")) {
    $statusObj = new Status($projectObj, $memberObj);
}

include_once("view/header.php");

if (!($page == "chooseproject" || $page == "choosemember")) {
    include_once("view/menu.php");
} else {
    // don't show menu when choosing project & member
    echo '<td width="200">&nbsp;</td>'."\n";
}

if ($page == "chooseproject") {
    include_once("view/project/choose.php");
}

if ($page == "choosemember") {
    $currentProjectID = $_POST["p"];
    $projectObj = new Project($currentProjectID);
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

            $statusObj->addDetails($dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusCondition, 
                    $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
        }
        
        if ($todo == "delete") {
            $statusObj->delDetails($currentStatusID);
        }
        
        if ($todo == "edit") {
            $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
            $strStatusDate = $_POST['strStatusDate'];
            $strStatusActualDate = $_POST['strStatusActualDate'];
            $strStatusCondition = $_POST['strStatusCondition'];
            $strStatusDifference = $_POST['strStatusDifference'];
            $strStatusWhy = $_POST['strStatusWhy'];
            $strStatusGanttLink = $_POST['strStatusGanttLink'];
            $strStatusGanttLinkComment = $_POST['strStatusGanttLinkComment'];

            $statusObj->setDetails($currentStatusID, $dmtStatusCurrentDate, $strStatusDate, $strStatusActualDate, $strStatusCondition, 
                    $strStatusDifference, $strStatusWhy, $strStatusGanttLink, $strStatusGanttLinkComment);
        }
    }
    
    $page = "statushistory";
}

if ($page == "statushistory") {
    $statusObj->getLastStatusID();
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("model/status/history.php");
    } else {
        $page = "statusadd";
    }
}

if ($page == "statusview") {
    if ($currentStatusID != "") {
        $statusObj->setID($currentStatusID);
    } else {
        $statusObj->getLastStatusID();
    }
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("model/status/view.php");
    } else {
        $page = "statusadd";
    }
}

if ($page == "statusadd") {
    $statusObj->displayAddForm();
}

if ($page == "statusedit") {
    if ($currentStatusID != "") {
        $statusObj->setID($currentStatusID);
        $statusObj->getDetails();
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
