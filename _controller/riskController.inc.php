<?php
if ($sessionArr['strPage'] == "risk") {
    if ($sessionArr['strTodo'] != "") {
        // add something later
    } else {
        $sessionArr['strPage'] = "riskhistory";
    }
}

if ($sessionArr['strPage'] == "riskhistory") {
    $riskObj = new Risk();
    $riskObj->setSession($sessionArr);

    $riskHistoryObj = new RiskHistoryGUI();
    $riskHistoryObj->display($riskObj->getHistoryDetails());
}

?>
