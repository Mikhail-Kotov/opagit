<?php

class GUI {
    
    private $sessionArr;
    
    public function __construct() {
        
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }
    
    public function header() {
        include_once("_view/inc/header.inc.php");
    }
    
    public function footer() {
        include_once("_view/inc/footer.inc.php");
    }
    
    public function menu() {
        include_once("_view/inc/menu.inc.php");
    }
    
    public function welcome() {
//        echo "Hello <b>" . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "</b><br />";
//        echo "Your Team is <b>" . $this->projectObj->strProjectTeamName . "</b><br />";
//        echo "Your Project is <b>" . $this->projectObj->strProjectName . "</b><br /><br />";
        echo 'Hello ' . $this->sessionArr['intMemberID'] . "<br />";
        echo "<b>Please choose something from left menu</b>";
    }
}
?>
