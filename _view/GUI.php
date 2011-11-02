<?php

class GUI {
    
    private $sessionArr;
    
    public function __construct() {
        
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }
    
    public function header() {
?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php echo $_ENV['version']; ?></title>
                <link href="prototype.css" rel="stylesheet" type="text/css" />
                <script type="text/javascript" src="js/functions.js"></script> 
                <script type="text/javascript" src="js/jquery.js"></script>
                <script type="text/javascript" src="js/jquery.qtip.js"></script> 
                <script type="text/javascript">
                    // Create the tooltips only on document load
                    $(document).ready(function() 
                    {
                        // Match all link elements with href attributes within the content div
                        $('#content a[href]').qtip(
                        {
                            content: 'Some basic content for the tooltip' // Give it some content, in this case a simple string
                        });
                    });
                </script>
            </head>

            <body>
                <a name="top"></a>
                <div id="content" >
                    <table width="1450" height="600" border="0">
                        <tr>
                            <td colspan="2" height="30">
<?php
        if ($_ENV['engineering mode'] == True) {
            echo "[page: <b>";
            if(!empty($this->sessionArr['strPage'])) {
                echo $this->sessionArr['strPage'];
            }
            if(!empty($this->sessionArr['strTodo'])) {
                echo ":" . $this->sessionArr['strTodo'];
            }
            
            echo "</b>]&nbsp;&nbsp;&nbsp;";

            if(!empty($this->sessionArr['intMemberID'])) {
                echo "[memberID: <b>" . $this->sessionArr['intMemberID'] . "</b>]&nbsp;&nbsp;&nbsp;";
            }
            
            if(!empty($this->sessionArr['intProjectID'])) {
                echo "[projectID: <b>" . $this->sessionArr['intProjectID']. "</b>]&nbsp;&nbsp;&nbsp;";
            }

        } else {
            echo "OPA Prototype\n";
        }

        echo "<br /><br /><hr /><br /></td></tr><tr>\n<!-- header  header  header  header  header  header  header  header  header  header -->\n";

    }
    
    public function footer() {
?><!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
    </td>
  </tr>
  <tr>
    <td colspan="2" height="30"><hr /><br />
    <?php
        echo $_ENV['version'];
        if($_ENV['engineering mode'] == True) {
            echo ', <a href="history.txt">History of changes</a>';
        }
    ?>
    </td><br />
  </tr>
</table>
</div>
</body>
</html>
<?php
    }
    
    public function menu() {
?>
    <td width="150" valign="top">
    <table width="100%" border="0">
        <tr>
            <td colspan="2">
                <a href="#">Timesheets</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                &nbsp;
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <?php displayButton("status", "Status", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statushistory", "History", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusview", "View Last", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusadd", "Add", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("issuehistory", "Issue", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("riskhistory", "Risk", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="javascript:history.go(-1)">Back</a><br />
                <a class ="" href="">Logout</a>
            </td>
        </tr>            
    </table>
</td>
<td valign="top">
<?php
    }
    
    public function welcome() {
//        echo "Hello <b>" . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "</b><br />";
//        echo "Your Team is <b>" . $this->projectObj->strProjectTeamName . "</b><br />";
//        echo "Your Project is <b>" . $this->projectObj->strProjectName . "</b><br /><br />";
        echo 'Hello $username!'."<br />";
        echo "<b>Please choose something from left menu</b>";
    }
}
?>
