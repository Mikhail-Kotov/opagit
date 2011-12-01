<b>Edit Status</b><br /><br />
<form method="post" action="" id="event-submission">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="edit" />
    <input type="hidden" name="s" value="<?php echo $statusArr['intStatusID']; ?>" />
    <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $statusArr['dmtStatusCurrentDate']; ?>"/><br /><br />
    Status created by:
    <input type="text" name="strMemberFirstAndLastName_NOT_USED" value="<?php echo $this->memberArr['strMemberFirstName'] . " " . 
            $this->memberArr['strMemberLastName']; ?>" disabled="disabled" /><br /><br />
    Project Name:
    <input type="text" name="strProjectName_NOT_USED" value="<?php echo $this->projectArr['strProjectName']; ?>" disabled="disabled" />
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
    if (!empty($attachmentArr['intAttachmentIDArr'][0])) {
        foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
            echo '<hr /><input type="hidden" name="intAttachmentID' . $id .
            '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />' .
            "Attachment " . ($id + 1) . ":<br />" . '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
            $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
            $attachmentArr['strAttachmentLinkArr'][$id] . '</a><br /><br />' .
            "Attachment Comment:<br />" . '<input type="text" name="strAttachmentComment' . $id .
            '" value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" disabled="disabled" /><br /><br />';
            echo '<input type="checkbox" name="deleteattachment' . $id . '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />Delete';
        }
    }
    ?>

    <hr />
    <br />
    <!-- add another attachment not implemented yet
    <input type="button" value="Add new Attachment" name="addattachment" />
    -->
    <br /><br />
    <input type="image" src="images/submit.gif" value="Submit" />
</form>