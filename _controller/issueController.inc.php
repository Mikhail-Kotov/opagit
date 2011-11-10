<?php
if ($sessionArr['strPage'] == "issue") {
    if ($sessionArr['strTodo'] != "") {
        // add something later
    } else {
        $sessionArr['strPage'] = "issuehistory";
    }
}

if ($sessionArr['strPage'] == "issuehistory") {
    $issueObj = new issue();
    $issueObj->setSession($sessionArr);

    $issueHistoryObj = new issueHistoryGUI();
    $issueHistoryObj->display($issueObj->getHistoryDetails());
}
?>
