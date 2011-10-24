<?php
$todo = "";
$currentProjectID = "";
$currentMemberID = "";
$currentStatusID = "";

if (isset($_POST["page"])) {
    $page = $_POST["page"];
} else {
    $page = "chooseproject";
}

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

if ($page == "statuspdf") {
    include_once("controller/objectsInit.php");
    
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("model/status/pdf.php");
    } else {
        $page = "statusadd";
    }
}

if (!($page == "chooseproject" || $page == "choosemember")) {
    include_once("controller/objectsInit.php");
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

include_once("controller/statusController.php");

if ($page == "issuehistory") {
    include_once("view/issue/history.php");
}

if ($page == "riskhistory") {
    include_once("view/risk/history.php");
}

include_once("view/footer.php");
?>
