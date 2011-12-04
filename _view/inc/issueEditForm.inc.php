<?php 
 /***************************************************************************************
 * Team Name: OPA 																		*
 * Robyn Ius                                                                      		*
 * Date: 4 Dec 2011                                                                     *
 * Version No: 1                                                                        *
 *                                                                       				*
 * File Name: issueEditForm.inc.php                                                     *
 * Desc:This file displays the Edit Form for Issue                                      * 
 ***************************************************************************************/
?>
<h1>Edit Issue</h1>
<form method="post" action="" id="event-submission">
    <input type="hidden" name="page" value="issue" />
    <input type="hidden" name="todo" value="edit" />
    <input type="hidden" name="i" value="<?php echo $IRSArr['intIssueID']; ?>" />
    <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
   Issue Raised By:
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $IRSArr['dmtIssueDateRaised']; ?>"/><br /><br />
    Issue Status:
    <input type="text" name="enmIssueStatus" value="<?php echo $IRSArr['enmIssueStatus']; ?>"/><br /><br />
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

    Date Raised:
    <input type="text" name="dmtIssueDateRaised" value="<?php echo $IRSArr['dmtIssueDateRaised']; ?>"/><br /><br />
    Issue Deadline:
    <textarea name="strPlanBaseline"><?php echo $IRSArr['strPlanBaseline']; ?></textarea><br /><br />
    Issue Description:
    <textarea name="strStatusVariation"><?php echo $IRSArr['strStatusVariation']; ?></textarea><br /><br />
    Issue Type:
    <textarea name="strStatusNotes"><?php echo $IRSArr['strStatusNotes']; ?></textarea><br /><br />
    Issue Priority:
    <textarea name="strStatusNotes"><?php echo $IRSArr['strStatusNotes']; ?></textarea><br /><br />
    
    Assigned TO:
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
    
    Date Closed:
    <input type="text" name="dmtIssueDateClosed" value="<?php echo $IRSArr['dmtIssueDateClosed']; ?>"/><br /><br />

    Issue Outcome:
    <textarea name="strStatusNotes"><?php echo $IRSArr['strStatusNotes']; ?></textarea><br /><br />

    <?php
    foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
        echo '<input type="hidden" name="intAttachmentID' . $id .
        '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />' .
        "Attachment: " . '<input type="text" name="strAttachmentLink' . $id .
        '" value="' . $attachmentArr['strAttachmentLinkArr'][$id] . '" /><br /><br />' .
        "Attachment Comment: " . '<input type="text" name="strAttachmentComment' . $id .
        '" value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" /><br /><br />';
    }
    ?>


    <input type="image" src="images/submit.gif" alt="submit button" class="submit" value="Submit" />
</form>