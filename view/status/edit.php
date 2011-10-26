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
        foreach ($projectsArr as $columnName  => $value) {
            echo '<option value="' . $value['intProjectID'].'"';
            if($value['intProjectID'] == $this->projectObj->getID()) {
                echo ' selected="selected"';
            }
            echo'>'.$value['strProjectName']."</option>\n";
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
foreach ($attachmentArr['intAttachmentID'] as $id => $value_not_using) {
    echo '<input type="hidden" name="intAttachmentID' . $id .
            '" value="' . $attachmentArr['intAttachmentID'][$id] . '" />' .
            "Attachment:<br />" . '<input type="text" name="strAttachmentLink' . $id . 
            '" value="' . $attachmentArr['strAttachmentLink'][$id] . '" /><br /><br />' .
            "Attachment Comment:<br />" . '<input type="text" name="strAttachmentComment' . $id . 
            '" value="' . $attachmentArr['strAttachmentComment'][$id] . '" /><br /><br />';
}
?>
    

    <input type="submit" value="Submit" />
</form>
