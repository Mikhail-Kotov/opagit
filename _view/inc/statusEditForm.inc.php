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