<?php

class Status {
    private $statusDAObj;
    private $attachmentObj;
    private $intSessionID;
    private $memberArr, $projectArr;
    public $intStatusID;
    public $intProjectMemberID;
    public $dmtStatusCurrentDate;
    public $strActualBaseline;
    public $strPlanBaseline;
    public $strStatusVariation; // variation
    public $strStatusNotes; // Notes/Reasons

    function __construct($memberArr, $projectArr, $attachmentObj, $intSessionID) {
        $this->statusDAObj = new StatusDA();
        
        $this->memberArr = $memberArr;
        $this->projectArr = $projectArr;
        
        $this->attachmentObj = $attachmentObj;
        $this->intSessionID = $intSessionID;
        $this->intProjectMemberID = $this->getProjectMember();
    }

    function getProjectMember() {
        $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE" .
                " intProjectID = " . $this->projectArr['intProjectID'] .
                " AND intMemberID = " . $this->memberArr['intMemberID'] . ";";

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
        $memberArr = $this->statusDAObj->getDetails($this->intStatusID);

        if(isset($memberArr)) {
            $this->intStatusID = $memberArr['intStatusID'];
            $this->intProjectMemberID = $memberArr['intProjectMemberID'];
            $this->dmtStatusCurrentDate = $memberArr['dmtStatusCurrentDate'];
            $this->strActualBaseline = $memberArr['strActualBaseline'];
            $this->strPlanBaseline = $memberArr['strPlanBaseline'];
            $this->strStatusVariation = $memberArr['strStatusVariation'];
            $this->strStatusNotes = $memberArr['strStatusNotes'];
        }
        
        $this->attachmentObj->setStatusID($this->intStatusID);
        $this->attachmentObj->getDetailsFromDB();
    }
    
    function getLastStatusID() {
        $intStatusID = $this->statusDAObj->getLastStatusID($this->projectArr['intProjectID']);
       
        if(!empty($intStatusID)) {
            $this->intStatusID = $intStatusID;
        } else {
            unset($this->intStatusID);
        }
        
        return $intStatusID;
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
        
        
        
        $query = "UPDATE tblStatus SET intProjectID='" . mysql_real_escape_string($this->projectArr['intProjectID']) . 
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
                "', '" . mysql_real_escape_string($this->projectArr['intProjectID']) .
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

    function delDetails() {
        $this->statusDAObj->delDetails($this->intStatusID);
        $this->attachmentObj->delDetails($this->intStatusID);
        unset($this->intStatusID);
    }

    function displayStatus() {
        $currentStatusMessage = $this->statusMessage();

        echo $currentStatusMessage;

        echo '<table border="0">';
        echo '<tr><td><form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->intSessionID . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
        echo '<input type="submit" value="Edit Status" class="button" />' . "\n";
        echo "</div>\n";
        echo '</form></td>';
        echo '<td><form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->intSessionID . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
        echo '<input type="submit" value="PDF" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form></td><td>";
        echo '<form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="status" />' . "\n";
        echo '<input type="hidden" name="todo" value="delete" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->intSessionID . '" />' . "\n";
        echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
        echo '<input type="submit" value="Delete" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form>\n";
        echo "</td></tr></table>";

        $this->bottomMenu();
    }
    
    function bottomMenu() {

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

    function historyStatus() {
        $sqlArr = $this->statusDAObj->getAll($this->projectArr['intProjectID']);

        $memberObj = new Member();

        foreach ($sqlArr as $intStatusID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                switch ($columnName) {
                    case "intProjectMemberID":
                        $tableArr[$intStatusID]["intMemberName"] = $memberObj->getMemberName($value);
                        break;
                    case "dmtStatusCurrentDate":
                        $tableArr[$intStatusID][$columnName] = date("jS F Y", strtotime($value));
                        break;
                    default:
                        $tableArr[$intStatusID][$columnName] = $value;
                }
            }

            $this->attachmentObj->setStatusID($tableArr[$intStatusID]["intStatusID"]);
            $this->attachmentObj->getDetailsFromDB();

            $tableArr[$intStatusID]["strAttachmentLinkArr"] = "";
            $tableArr[$intStatusID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $tableArr[$intStatusID]["strAttachmentLinkArr"] .= '<a href="' .
                            $attachmentArr['strAttachmentLinkArr'][$id] .
                            '">' .
                            $attachmentArr['strAttachmentLinkArr'][$id] .
                            "</a><br />";
                    $tableArr[$intStatusID]['strAttachmentCommentArr'] .= $attachmentArr['strAttachmentCommentArr'][$id] . "<br />";
                }
            } else {
                $tableArr[$intStatusID]['strAttachmentLinkArr'] = "&nbsp;";
                $tableArr[$intStatusID]['strAttachmentCommentArr'] = "&nbsp;";
            }
        }
        
        $statusHistoryTableArr[0]['caption'] = "Status History for Project: " . $this->projectArr['strProjectName'];
        $statusHistoryTableArr[1] = $tableArr;
        
        return $statusHistoryTableArr;
    }

    function printStatus() {
        
    }

    function addAttachment() {
        
    }

    function displayAddForm() {
        ?>
        <h1>Add Status</h1>
        <form name="statusadd" method="post" action="" id="event-submission">
        <!-- <form name="statusadd" method="post" action="" id="event-submission"> -->
            <div>
            <input type="hidden" name="page" value="status" />
            <input type="hidden" name="todo" value="add" />
            <input type="hidden" name="intSessionID" value="<?php echo $this->intSessionID; ?>" />
            <label for="strMemberName" title="Automatic name field.">Member Name:</label>
            <div class="field"><input type="text" name="strMemberName" value="Your name" class="input-text"  size="35" maxlength="40" disabled="disabled" /></div><br />
            
            <label for="intProjectID" title="Select a project that you want to report on.">Project Name:</label>
            <div class="field">
            <select name="intProjectID">
                <?php
                $projectsArr = getProjects($this->memberArr['intMemberID']);
                foreach ($projectsArr as $columnName => $value) {
                    echo '<option value="' . $value['intProjectID'] . '"';
                    if ($value['intProjectID'] == $this->projectArr['intProjectID']) {
                        echo ' selected="selected"';
                    }
                    echo'>' . $value['strProjectName'] . "</option>\n";
                }
                ?>
            </select>
            </div><br />
            
            <label for="dmtStatusCreationDate" title="The current date can be modified.">Status Creation Date:</label>
            <div class="field"><input type="text" name="dmtStatusCurrentDate" class="input-text" size="10" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" /></div><br />
            
            <label for="strActualBaseline" title="The actual baseline is based on your project management or Gantt. Enter your actual project status.">Actual Baseline:</label>
            <div class="field">
            <textarea name="strActualBaseline" title="The actual baseline is based on your project management or Gantt. Enter your actual project status." rows="2" cols="43"></textarea></div><br />
            
            <label for="strPlanBaseline" title="The Plan Baseline is where you expect to be in your project management.">Plan Baseline:</label>
            <div class="field"><textarea name="strPlanBaseline" title="The Plan Baseline is where you expect to be in your project management." rows="2" cols="43"></textarea></div><br />
            
            <label for="strStatusVariation" title="Variation is the difference between the actual baseline and the planned baseline.">Variation:</label>
            <div class="field"><textarea name="strStatusVariation" title="Variation is the difference between the actual baseline and the planned baseline." rows="2" cols="43"></textarea></div><br />
            
            <label for="strStatusNotes" title="Enter the reason for a variation in your planned and actual baseline. Enter other notes here.">Notes/Reasons:</label>
            <div class="field"><textarea name="strStatusNotes" title="Enter the reason for a variation in your planned and actual baseline. Enter other notes here." rows="2" cols="43"></textarea></div><br />
            
            <label for="strAttachmentLink0" title="Browse for a file to substantiate your status e.g.Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls.">Attachment 1:</label>
            <div class="field"><input type="text" name="strAttachmentLink0" value="http://" /></div><br />
            <label for="strAttachmentComment0" title="Name your attachment or add a comment.">Attachment Comment:</label>
            <div class="field"><input type="text" name="strAttachmentComment0" /></div><br /><div id="text"></div>
            <input type="button" onclick="addAttachmentLink()" name="add" value="Add more attachments" />
            <br /><br />
            <input type="submit" value="Submit" />
            </div>
            </form>
        <?php
        $this->bottomMenu();
    }
    
    function statusMessage() {
// DRAFT (RAW CODE)
//        $memberObj = new Member();
//        $memberObj->getMemberID($this->intProjectMemberID);
//        $memberObj->setID();
//        $memberArr = $memberObj->getDetails();
        
        $currentStatusMessage = "<b>Date:</b> " . date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . "<br />" .
                // "<b>Status created by:</b> " . $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'] . "<br />" .
                "<b>Status created by:</b> __MEMBER_NAME_HERE__<br />" .
                "<b>Project:</b> " . $this->projectArr['strProjectName'] . "<br /><br />" .
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
        <form method="post" action="">
            <input type="hidden" name="page" value="status" />
            <input type="hidden" name="todo" value="edit" />
            <input type="hidden" name="s" value="<?php echo $this->intStatusID; ?>" />
            <input type="hidden" name="intSessionID" value="<?php echo $this->intSessionID; ?>" />
            Status Creation Date:<br />
            <input type="text" name="dmtStatusCurrentDate" value="<?php echo $this->dmtStatusCurrentDate; ?>"/><br /><br />
            Project Name:<br />
            <select name ="intProjectID">
        <?php
        $projectsArr = getProjects($this->memberArr['intMemberID']);
        foreach ($projectsArr as $columnName => $value) {
            echo '<option value="' . $value['intProjectID'] . '"';
            if ($value['intProjectID'] == $this->projectArr['intProjectID']) {
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
