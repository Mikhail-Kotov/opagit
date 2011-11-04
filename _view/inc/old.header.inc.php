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
                            if (!empty($this->sessionArr['strPage'])) {
                                echo $this->sessionArr['strPage'];
                            }
                            if (!empty($this->sessionArr['strTodo'])) {
                                echo ":" . $this->sessionArr['strTodo'];
                            }

                            echo "</b>]&nbsp;&nbsp;&nbsp;";

                            if (!empty($this->sessionArr['intMemberID'])) {
                                echo "[memberID: <b>" . $this->sessionArr['intMemberID'] . "</b>]&nbsp;&nbsp;&nbsp;";
                            }

                            if (!empty($this->sessionArr['intProjectID'])) {
                                echo "[projectID: <b>" . $this->sessionArr['intProjectID'] . "</b>]&nbsp;&nbsp;&nbsp;";
                            }
                        } else {
                            echo "OPA Prototype\n";
                        }

                        echo "<br /><br /><hr /><br /></td></tr><tr>\n<!-- header  header  header  header  header  header  header  header  header  header -->\n";
                        ?>