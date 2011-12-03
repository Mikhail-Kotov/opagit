<?php

class Issue extends IRS {

    function __construct($memberArr, $projectArr, $intSessionID) {
        parent::__construct('issue', $memberArr, $projectArr, $intSessionID);
        $this->IRSDAObj = new IRSDA('issue');
    }
}

?>
