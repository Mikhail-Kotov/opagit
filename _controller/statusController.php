<?php

class statusController extends IRSController {

    public function __construct($memberArr, $projectArr, $sessionArr) {
        parent::__construct('status', $memberArr, $projectArr, $sessionArr);
    }

}

?>
