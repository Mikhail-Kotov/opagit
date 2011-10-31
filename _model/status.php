<?php

class Status {
    private $projectObj, $memberObj, $attachmentObj, $sessionObj;
    public $intStatusID;
    public $intProjectMemberID;
    public $dmtStatusCurrentDate;
    public $strActualBaseline;
    public $strPlanBaseline;
    public $strStatusVariation; // variation
    public $strStatusNotes; // Notes/Reasons

    function __construct($memberObj, $projectObj, $attachmentObj, $sessionObj) {
        $this->projectObj = $projectObj;
        $this->memberObj = $memberObj;
        $this->attachmentObj = $attachmentObj;
        $this->sessionObj = $sessionObj;
        $this->intProjectMemberID = $this->getProjectMember();
    }

    function getProjectMember() {
        $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE" .
                " intProjectID = " . $this->projectObj->getID() .
                " AND intMemberID = " . $this->memberObj->getID() . ";";

        $sqlArr = $_ENV['db']->query($query);

        $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
        return $intProjectMemberID;
    }
    
    function getID() {
        if(isset($this->intStatusID)) {
            return $this->intStatusID;
        }
    }
    
    function setID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    function getDetails() {
        $query = "SELECT intStatusID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," . 
                "strStatusVariation,strStatusNotes FROM tblStatus" .
                " WHERE intStatusID = " . $this->intStatusID;

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
            $this->dmtStatusCurrentDate = $sqlArr[0]['dmtStatusCurrentDate'];
            $this->strActualBaseline = $sqlArr[0]['strActualBaseline'];
            $this->strPlanBaseline = $sqlArr[0]['strPlanBaseline'];
            $this->strStatusVariation = $sqlArr[0]['strStatusVariation'];
            $this->strStatusNotes = $sqlArr[0]['strStatusNotes'];
        }
        
        $this->attachmentObj->setStatusID($this->intStatusID);
        $this->attachmentObj->getDetailsFromDB();
    }
    
    function getLastStatusID() {
        $query = "SELECT intStatusID FROM tblStatus" .
                " WHERE intProjectID = " . $this->projectObj->getID() .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $this->intStatusID = $sqlArr[0]['intStatusID'];
        }
    }
    
    function getGlobalLastStatusID() {
        $globalLastStatusID = 0;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $globalLastStatusID = $sqlArr[0]['intStatusID'];
        }
        
        return $globalLastStatusID;
    }
    
    function setDetails($intStatusID, // <- refactor this!!!
            $dmtStatusCurrentDate,
            $strActualBaseline,
            $strPlanBaseline,
            $strStatusVariation,
            $strStatusNotes,
            $intAttachmentIDArr,
            $strAttachmentLinkArr,
            $strAttachmentCommentArr) {
        
        
        
        $query = "UPDATE tblStatus SET intProjectID='" . mysql_real_escape_string($this->projectObj->getID()) . 
                "',intProjectMemberID='" . mysql_real_escape_string($this->intProjectMemberID) .
                "',dmtStatusCurrentDate='" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "',strActualBaseline='" . mysql_real_escape_string($strActualBaseline) . 
                "',strPlanBaseline='" . mysql_real_escape_string($strPlanBaseline) .
                "',strStatusVariation='" . mysql_real_escape_string($strStatusVariation) . 
                "',strStatusNotes='" . mysql_real_escape_string($strStatusNotes) . 
                "' WHERE intStatusID = '" . mysql_real_escape_string($intStatusID) . "';";
        
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        $this->attachmentObj->setStatusID($intStatusID);
        $this->attachmentObj->setDetails($intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
            $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr) {

        $nextStatusID = $this->getGlobalLastStatusID() + 1;
        
        $query = "INSERT INTO tblStatus(".
                "intStatusID," .
                "intProjectID," .
                "intProjectMemberID," .
                "dmtStatusCurrentDate," .
                "strActualBaseline," .
                "strPlanBaseline," .
                "strStatusVariation," .
                "strStatusNotes) " .
                "values (" .
                "'" . $nextStatusID .
                "', '" . mysql_real_escape_string($this->projectObj->getID()) .
                "', '" . mysql_real_escape_string($this->intProjectMemberID) .
                "', '" . mysql_real_escape_string($dmtStatusCurrentDate) .
                "', '" . mysql_real_escape_string($strActualBaseline) .
                "', '" . mysql_real_escape_string($strPlanBaseline) .
                "', '" . mysql_real_escape_string($strStatusVariation) .
                "', '" . mysql_real_escape_string($strStatusNotes) . "');";
        $sql = mysql_query($query);

        if (!$sql)
            die('Invalid query: ' . mysql_error());

        $this->attachmentObj->addDetails($nextStatusID, $strAttachmentLinkArr, $strAttachmentCommentArr);


    }

    function delDetails($intStatusID) {
        $query = "DELETE FROM tblStatus WHERE intStatusID='$intStatusID';";
        $sql = mysql_query($query);
        if (!$sql)
            die('Invalid query: ' . mysql_error());
        
        $this->attachmentObj->delDetails($intStatusID);
    }

    function displayStatus() {
        $currentStatusMessage = $this->statusMessage();

        echo $currentStatusMessage;

        echo '<table border="0">';
        echo '<tr><td><form method="post">';
        echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
        echo '<input type="submit" value="Edit Status" class="button" />' . "\n";
        echo '</form></td>';
        echo '<td><form method="post">';
        echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
        echo '<input type="submit" value="PDF" class="button" />' . "\n";
        echo "</form></td><td>";
        echo '<form method="post">';
        echo '<input type="hidden" name="page" value="status" />' . "\n";
        echo '<input type="hidden" name="todo" value="delete" />' . "\n";
        echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
        echo '<input type="submit" value="Delete" class="button" />' . "\n";
        echo "</form>\n";
        echo "</td></tr></table>";

        $this->bottomMenu();
    }
    
    function bottomMenu() {
        echo '<br /><table border="0"><tr><td>';
        displayButtonNew("statusadd", "Add Status", $this->sessionObj->getID());
        echo "</td><td>";
        displayButtonNew("statushistory", "Status History", $this->sessionObj->getID());
        echo "</td><td>";
        displayButtonNew("statusview", "View Last Status", $this->sessionObj->getID());
        echo '</td></tr></table><br /><a href="#top">Back to Top</a>';
    }

    function pdfStatus() {
        $currentStatusMessage = $this->statusMessage();

        //$pdf = new FPDF();
        //$pdf->AddPage();
        //$pdf->SetFont('Arial','',10);
        //$pdf->Cell(40,10,$currentStatusMessage);
        //$pdf->Output();



        $pdf = new PDF();
        $pdf->SetDisplayMode('real', 'default');
        $title = 'Status #' . $this->getID();
        $pdf->SetTitle($title);
        $pdf->SetAuthor('OPA');
        $pdf->PrintChapter(1, 'Status #' . $this->getID(), "");
        $pdf->WriteHTML($currentStatusMessage);

        $pdf->Output();
    }

    function displayStatusHistory() {
        $query = "SELECT intStatusID,intProjectMemberID,dmtStatusCurrentDate,strActualBaseline,strPlanBaseline," .
                "strStatusVariation,strStatusNotes" .
                " FROM tblStatus WHERE intProjectID = '" . $this->projectObj->getID() . "';";
        $sqlArr = $_ENV['db']->query($query);
        $_ENV['firephp']->log($sqlArr, 'sqlArr');

        $caption = "Status History for Project: " . $this->projectObj->strProjectName;

//$arr3 = array();
        foreach ($sqlArr as $intStatusID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                switch ($columnName) {
                    case "intProjectMemberID":
                        $historyTableArr[$intStatusID]["intMemberName"] = $this->memberObj->getMemberName($value);
                        break;
                    case "dmtStatusCurrentDate":
                        $historyTableArr[$intStatusID][$columnName] = date("jS F Y", strtotime($value));
                        break;
                    default:
                        $historyTableArr[$intStatusID][$columnName] = $value;
                }
            }

            $this->attachmentObj->setStatusID($historyTableArr[$intStatusID]["intStatusID"]);
            $this->attachmentObj->getDetailsFromDB();

            $historyTableArr[$intStatusID]["strAttachmentLinkArr"] = "";
            $historyTableArr[$intStatusID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $historyTableArr[$intStatusID]["strAttachmentLinkArr"] .= '<a href="' .
                            $attachmentArr['strAttachmentLinkArr'][$id] .
                            '">' .
                            $attachmentArr['strAttachmentLinkArr'][$id] .
                            "</a><br />";
                    $historyTableArr[$intStatusID]['strAttachmentCommentArr'] .= $attachmentArr['strAttachmentCommentArr'][$id] . "<br />";
                }
            } else {
                $historyTableArr[$intStatusID]['strAttachmentLinkArr'] = "&nbsp;";
                $historyTableArr[$intStatusID]['strAttachmentCommentArr'] = "&nbsp;";
            }
        }


        unset($columnName);
        unset($statusArr);

        if (isset($historyTableArr[0])) {
            echo '<table border="1" rules="all" frame="void">';
            echo "<caption>" . $caption . "</caption>\n";
            echo "<tr>\n";
            echo "<th>&nbsp;</th>\n";
            echo "<th>ID</th>\n";
            echo "<th>Member</th>\n";
            echo "<th>Creation Date</th>\n";
            echo "<th>Actual Baseline</th>\n";
            echo "<th>Plan Baseline</th>\n";
            echo "<th>Variation</th>\n";
            echo "<th>Notes/Reasons</th>\n";
            echo "<th>Attachment</th>\n";
            echo "<th>Attachment Comment</th>\n";
            echo "<th>&nbsp;</th>\n"; // for PDF
            echo "</tr>\n";

            foreach ($historyTableArr as $statusArr) {
                echo "<tr>\n";
                echo "<td>\n";
                echo '<form method="post">';
                echo '<input type="hidden" name="page" value="statusview" />' . "\n";
                echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
                echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
                echo '<input type="hidden" name="s" value="' . $statusArr["intStatusID"] . '" />' . "\n";
                echo '<input type="submit" value="View" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";

                foreach ($statusArr as $columnName => $value) {
                    echo "<td>";
                    if (isset($value)) {
                        echo $value;
                    } else {
                        echo "&nbsp;";
                    }
                    echo "</td>\n";
                }

                echo "<td>\n";
                echo '<form method="post">';
                echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
                echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
                echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
                echo '<input type="hidden" name="s" value="' . $statusArr["intStatusID"] . '" />' . "\n";
                echo '<input type="submit" value="PDF" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "</tr>\n\n";
            }
            echo '</table>';
        }
        $this->bottomMenu();
    }

    function printStatus() {
        
    }

    function addAttachment() {
        
    }

    function displayAddForm() {
        ?>
        <b>Add Status</b><br /><br />
        <form name="statusadd" method="post">
            <input type="hidden" name="page" value="status" />
            <input type="hidden" name="todo" value="add" />
            <input type="hidden" name="m" value="<?php echo $this->memberObj->getID(); ?>" />
            <input type="hidden" name="p" value="<?php echo $this->projectObj->getID(); ?>" />
            Status Creation Date:<br />
            <input type="text" name="dmtStatusCurrentDate" value="<?php echo $_ENV['currentDate']; ?>"/><br /><br />
            Project Name:<br />
            <select name ="intProjectID">
                <?php
                $projectsArr = getProjects($this->memberObj->getID());
                foreach ($projectsArr as $columnName => $value) {
                    echo '<option value="' . $value['intProjectID'] . '"';
                    if ($value['intProjectID'] == $this->projectObj->getID()) {
                        echo ' selected="selected"';
                    }
                    echo'>' . $value['strProjectName'] . "</option>\n";
                }
                ?>
            </select>
            <br /><br />
            Actual Baseline:<br />
            <textarea name="strActualBaseline" /></textarea><br /><br />
        Plan Baseline:<br />
        <textarea name="strPlanBaseline" /></textarea><br /><br />
        Variation:<br />
        <textarea name="strStatusVariation"></textarea><br /><br />
        Notes/Reasons:<br />
        <textarea name="strStatusNotes"></textarea><br /><br />
        Attachment 1:<br />
        <input type="text" name="strAttachmentLink0" value="http://"/><br /><br />
        Attachment 1 Comment:<br />
        <input type="text" name="strAttachmentComment0" /><br /><br />
        <div id="text">
            
        </div>
        <input type="button" onclick="addAttachmentLink()" name="add" value="Add more attachments" /><br />
            
        <br />
        <input type="submit" value="Submit" />
        </form>
            
        <?php
        $this->bottomMenu();
    }
    
    function statusMessage() {
        $currentStatusMessage = "<b>Date:</b> " . date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . "<br />" .
                "<b>Status created by:</b> " . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "<br />" .
                "<b>Project:</b> " . $this->projectObj->strProjectName . "<br /><br />" .
                "<b>Actual Baseline:</b><br />" . $this->strActualBaseline . "<br /><br />" .
                "<b>Plan Baseline:</b><br />" . $this->strPlanBaseline . "<br /><br />" .
                "<b>Variation:</b><br />" .
                $this->strStatusVariation . "<br /><br />" .
                "<b>Notes/Reasons:</b><br />" .
                $this->strStatusNotes . "<br /><br />";

        $this->attachmentObj->setStatusID($this->getID());

        $this->attachmentObj->getDetailsFromDB();
        $attachmentArr = $this->attachmentObj->getDetails();
        if ($attachmentArr != null) {
            foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
                // so to change 'foreach' to something else???
                // don't know better php construction (Mikhail)
                $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
                        $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
                        "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
            }
        }

        //$_ENV['firephp']->log($attachmentArr, 'attachmentArray');
        return $currentStatusMessage;
    }
    
    function displayEditForm() {
        ?>
        <b>Edit Status</b><br /><br />
        <form method="post">
            <input type="hidden" name="page" value="status" />
            <input type="hidden" name="todo" value="edit" />
            <input type="hidden" name="s" value="<?php echo $this->intStatusID; ?>" />
            <input type="hidden" name="m" value="<?php echo $this->memberObj->getID(); ?>" />
            <input type="hidden" name="p" value="<?php echo $this->projectObj->getID(); ?>" />
            Status Creation Date:<br />
            <input type="text" name="dmtStatusCurrentDate" value="<?php echo $this->dmtStatusCurrentDate; ?>"/><br /><br />
            Project Name:<br />
            <select name ="intProjectID">
        <?php
        $projectsArr = getProjects($this->memberObj->getID());
        foreach ($projectsArr as $columnName => $value) {
            echo '<option value="' . $value['intProjectID'] . '"';
            if ($value['intProjectID'] == $this->projectObj->getID()) {
                echo ' selected="selected"';
            }
            echo'>' . $value['strProjectName'] . "</option>\n";
        }
        $_ENV['firephp']->log($projectsArr, 'ProjectsArr');
        ?>
            </select>
            <br /><br />
            Actual Baseline:<br />
            <textarea name="strActualBaseline"><?php echo $this->strActualBaseline; ?></textarea><br /><br />
            Plan Baseline:<br />
            <textarea name="strPlanBaseline"><?php echo $this->strPlanBaseline; ?></textarea><br /><br />
            Variation:<br />
            <textarea name="strStatusVariation"><?php echo $this->strStatusVariation; ?></textarea><br /><br />
            Notes/Reasons:<br />
            <textarea name="strStatusNotes"><?php echo $this->strStatusNotes; ?></textarea><br /><br />
        <?php
        $attachmentArr = $this->attachmentObj->getDetails();
        foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
            echo '<input type="hidden" name="intAttachmentID' . $id .
            '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />' .
            "Attachment:<br />" . '<input type="text" name="strAttachmentLink' . $id .
            '" value="' . $attachmentArr['strAttachmentLinkArr'][$id] . '" /><br /><br />' .
            "Attachment Comment:<br />" . '<input type="text" name="strAttachmentComment' . $id .
            '" value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" /><br /><br />';
        }
        ?>
            
            
            <input type="submit" value="Submit" />
        </form>
        <?php
    }
}
?>
