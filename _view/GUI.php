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
        
        $memberObj = new Member();
        $memberObj->setSession($this->sessionArr);
        $memberArr = $memberObj->getDetails();
        echo 'Hello ' . $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'] . "<br />";
        echo "<b>Please choose something from left menu</b>";
    }
    
    public function displayMenuButton($name, $caption, $isSelected = false) {
        echo '<form  action="" method="post">' . "\n<div>";
        echo '<input type="hidden" name="page" value="' . $name . '" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<a><input type="submit" value="' . $caption . '" class="button';
        if ($isSelected == true) {
            echo 'selected';
        }
        echo '" /></a>' . "\n</div>\n";
        echo '</form>';
    }
    
    public function alert($currentAlert) {
        echo '<div class="msg" style="background-color: #f9f9f9; color:#E81c17; font:Arial; font-weight:bold; float:right">' . $currentAlert . '</div>';
    }
}
?>
