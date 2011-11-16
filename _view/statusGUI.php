<?php

class StatusGUI {

    private $sessionArr;

    public function __construct() {
        
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }

    public function display($currentStatusMessage) {
        echo $currentStatusMessage;

        echo '<table border="0">';
        echo '<tr><td><form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
        echo '<input type="submit" value="Edit Status" class="button" />' . "\n";
        echo "</div>\n";
        echo '</form></td>';
        echo '<td><form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
        echo '<input type="submit" value="PDF" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form></td><td>";
        echo '<form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="status" />' . "\n";
        echo '<input type="hidden" name="todo" value="delete" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
        echo '<input type="submit" value="Delete" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form>\n";
        echo "</td></tr></table>";

        $this->displayStatusBottomMenu();
    }
    
    public function displayAddForm() {
        include_once("inc/statusAddForm.inc.php");
        $this->displayStatusBottomMenu();
    }
    
    public function displayEditForm($statusArr) {
        include_once("inc/statusEditForm.inc.php");
    }
    
    public function displayStatusBottomMenu() {
        include_once("inc/statusBottomMenu.inc.php");
    }
}

?>
