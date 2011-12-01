<?php

class LoginGUI {

    private $sessionArr;
    
    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }
    
    public function displayLoginForm($allMembersArr, $allProjectsArr) {
        echo '<div id="login_box">' . "\n";
    	echo '<div id="box">';
    	echo "<h1>Login Here</h1>\n";
    	echo "<p>Students and staff can now login to do project administration.</p>\n";
        echo '<form method="post" action="" id="event-submission">' . "<div>\n";
        //Username is not implemented yet
        echo '<label for="ssousername" title="Enter SIMS username.">SIMS Username:</label><br />';
    	echo '<input class="form_textfield" style="width: 150px;" tabindex="1" type="text" id="ssousername" name="ssousername" value="" /><br /><br />';
    	//Password is not implemented yet
        echo '<label for="password">SIMS Password:</label><br />';
        echo '<input name="password" id="password" class="form_textfield" style="width: 150px;" tabindex="2" type="password" /><br /><br />';

        echo '<label for="p">Choose a Project:</label><br />';
        echo '<select name="p" id="p" class="form_dropdown">' . "\n";
        foreach ($allProjectsArr as $id => $value) {
            echo '<option value="' . $allProjectsArr[$id]['intProjectID'] . '">' . $allProjectsArr[$id]['strProjectName'] . "</option>\n";
        }
        echo "</select><br /><br />\n";

        echo '<input type="hidden" name="page" value="welcome" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input name="Submit" type="image" src="images/submit.gif" alt="Submit" />' . "\n";
        echo "\n</div>\n</form>\n";
        echo '<p><a href="http://www.its.swinburne.edu.au/students/guides/faqs/sims.htm" title="Swinburne Identity Management System (SIMS) User Guide"><img src="images/arrow8.gif" alt="" height="10" width="8" />SIMS User Guide</a></p>';						
        echo '<p><a href="http://www.its.swinburne.edu.au/students/guides/faqs/sims.htm#student"><img src="images/arrow8.gif" alt="" height="10" width="8" />Help I forgot my username</a></p>';
        echo '<p><a href=""><img src="images/arrow8.gif" alt="" height="10" width="8" />Help I forgot my password</a></p>';
        echo '</div>'; //End of class box
        echo '</div>'; //End of class login-box 
    }

}

?>
