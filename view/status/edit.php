<b>Edit Status</b><br /><br />
<form method="post">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="edit" />
    <input type="hidden" name="s" value="<?php echo $this->intStatusID; ?>" />
    <input type="hidden" name="m" value="<?php echo $this->intMemberID; ?>" />
    <input type="hidden" name="p" value="<?php echo $this->intProjectID; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $this->dmtStatusCurrentDate; ?>"/><br /><br />
    Project Name:<br />
    <select name ="intProjectID">
        <?php 
        $projectsArr = $this->getProjects();
        foreach ($projectsArr as $row  => $value) {
            echo '<option value="' . $value['intProjectID'].'"';
            if($value['intProjectID'] == $this->intProjectID) {
                echo ' selected="selected"';
            }
            echo'>'.$value['strProjectName']."</option>\n";
        ?>
        <?php  }
        $_ENV['firephp']->log($projectsArr, 'ProjectsArr');
        ?>
    </select>
    <br /><br />
    Actual Baseline:<br />
    <textarea name="strStatusDate"><?php echo $this->strStatusDate; ?></textarea><br /><br />
    Plan Baseline:<br />
    <textarea name="strStatusActualDate"><?php echo $this->strStatusActualDate; ?></textarea><br /><br />
    Status Condition:<br />
    <select name ="strStatusCondition">
        <option value="Up to date"<?php if($this->strStatusCondition == "Up to date") { echo ' selected="selected"'; } ?>>Up to date</option>
        <option value="Ahead"<?php if($this->strStatusCondition == "Ahead") { echo ' selected="selected"'; } ?>>Ahead</option>
        <option value="Behind"<?php if($this->strStatusCondition == "Behind") { echo ' selected="selected"'; } ?>>Behind</option>
    </select><br /><br />
    Variation:<br />
    <textarea name="strStatusDifference"><?php echo $this->strStatusDifference; ?></textarea><br /><br />
    Notes/Reasons:<br />
    <textarea name="strStatusWhy"><?php echo $this->strStatusWhy; ?></textarea><br /><br />
    Attachment:<br />
    <input type="text" name="strStatusGanttLink" value="<?php echo $this->strStatusGanttLink; ?>" /><br /><br />
    Attachment Comment:<br />
    <input type="text" name="strStatusGanttLinkComment" value="<?php echo $this->strStatusGanttLinkComment; ?>" /><br /><br />
    <input type="submit" value="Submit" />
</form>
