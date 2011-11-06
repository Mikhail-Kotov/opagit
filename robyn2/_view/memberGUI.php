<?php

class MemberGUI {

    private $sessionArr;
    
    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }
    
    public function chooseMember() {
    	echo '<div id="login_box" summary="Login Here">' . "\n";
    	echo '<div id="box">';
    	echo "<h1>Login Here</h1>\n";
    	echo "<p>Students and staff can now login to do project administration.</p>\n";
        echo '<form method="post" action="" id="event-submission">' . "\n<p>\n";
        echo '<p><label for="m">Choose a Member:</label><br />';
        echo '<select name="m" class="form_dropdown">' . "\n";

        $arr = $_ENV['db']->query("SELECT intMemberID, strMemberName FROM tblMember;");

        foreach ($arr[0] as $columnName => $value) {
            $columnArr[] = $columnName;
        }

        foreach ($arr as $intMemberID) {
            echo '<option value="' . $intMemberID[$columnArr[0]] . '">' . $intMemberID[$columnArr[1]] . "</option>\n";
        }

        echo "</select>\n";
        //Username is not implemented yet
        echo '<p><label for="ssousername" title="Enter SIMS username.">SIMS Username:</label><br />';
    	echo '<input class="form_textfield" style="width: 150px;" tabindex="1" type="text" id="ssousername" name="ssousername" value=""></p>';
    	//Password is not implemented yet
        echo '<p><label for="password">SIMS Password:</label><br />';
        echo '<input name="password" id="password" class="form_textfield" style="width: 150px;" tabindex="2" type="password"></p>';
        echo '<input type="hidden" name="page" value="welcome" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<p><input name="Submit" type="image" src="images/submit.gif" alt="Submit" /></p>' . "\n";
        echo "</p>\n</form>\n";
        echo '<p><a href="http://www.its.swinburne.edu.au/students/guides/faqs/sims.htm" title="Swinburne Identity Management System (SIMS) User Guide"><img src="images/arrow8.gif" alt="" border="0" height="10" width="8">SIMS User Guide</a></p>';						
        echo '<p><a href="http://www.its.swinburne.edu.au/students/guides/faqs/sims.htm#student"><img src="images/arrow8.gif" alt="" border="0" height="10" width="8">Help I forgot my username</a></p>';
        echo '<p><a href=""><img src="images/arrow8.gif" alt="" border="0" height="10" width="8">Help I forgot my password</a></p>';
        echo '</div>'; //End of class box
  		echo '</div>'; //End of class login-box 

    }

}

?>
