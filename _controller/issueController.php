<?php

class IssueController extends IRSController {

    public function __construct($memberArr, $projectArr, $sessionArr) {
        parent::__construct('issue', $memberArr, $projectArr, $sessionArr);
    }
    
}
?>
