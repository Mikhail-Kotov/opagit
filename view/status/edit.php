<b>Edit Status</b><br /><br />
<form method="post">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="edit" />
    <input type="hidden" name="s" value="<?php echo $this->intStatusID; ?>" />
    <input type="hidden" name="m" value="<?php echo $this->intMemberID; ?>" />
    <input type="hidden" name="p" value="<?php echo $this->intProjectID; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $this->dmtStatusCurrentDate; ?>"/><br /><br />
    Actual Baseline:<br />
    <textarea name="strStatusDate"><?php echo $this->strStatusDate; ?></textarea><br /><br />
    Plan Baseline:<br />
    <textarea name="strStatusActualDate"><?php echo $this->strStatusActualDate; ?></textarea><br /><br />
    Status Condition:<br />
    <select name ="strStatusCondition">
        <option value="Uptodate" selected="selected">Up to date</option>
        <option value="Ahead">Ahead</option>
        <option value="Behind">Behind</option>    
    </select><br />
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
