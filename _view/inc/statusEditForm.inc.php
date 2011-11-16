<b>Edit Status</b><br /><br />
<form method="post" action="" id="event-submission">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="edit" />
    <input type="hidden" name="s" value="<?php echo $statusArr['intStatusID']; ?>" />
    <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $statusArr['dmtStatusCurrentDate']; ?>"/><br /><br />
    Project Name:<br />
    <select name ="intProjectID">
        <option value="1" selected="selected">OPA</option>
        <?php
//        $projectsArr = getProjects($this->memberArr['intMemberID']);
//        foreach ($projectsArr as $columnName => $value) {
//            echo '<option value="' . $value['intProjectID'] . '"';
//            if ($value['intProjectID'] == $this->projectArr['intProjectID']) {
//                echo ' selected="selected"';
//            }
//            echo'>' . $value['strProjectName'] . "</option>\n";
//        }
//        $_ENV['firephp']->log($projectsArr, 'ProjectsArr');
        ?>
    </select>
    <br /><br />
    Actual Status:<br />
    <textarea name="strActualBaseline"><?php echo $statusArr['strActualBaseline']; ?></textarea><br /><br />
    Planned Baseline:<br />
    <textarea name="strPlanBaseline"><?php echo $statusArr['strPlanBaseline']; ?></textarea><br /><br />
    Variation:<br />
    <textarea name="strStatusVariation"><?php echo $statusArr['strStatusVariation']; ?></textarea><br /><br />
    Notes/Reasons:<br />
    <textarea name="strStatusNotes"><?php echo $statusArr['strStatusNotes']; ?></textarea><br /><br />
    <?php
    foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
        echo '<input type="hidden" name="intAttachmentID' . $id .
        '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />' .
        "Attachment:<br />" . '<input type="text" name="strAttachmentLink' . $id .
        '" value="' . $attachmentArr['strAttachmentLinkArr'][$id] . '" /><br /><br />' .
        "Attachment Comment:<br />" . '<input type="text" name="strAttachmentComment' . $id .
        '" value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" /><br /><br />';
    }
    ?>


    <input type="image" src="images/submit.gif" value="Submit" />
</form>