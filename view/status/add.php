<b>Add Status</b><br /><br />
<form method="post">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="add" />
    <input type="hidden" name="m" value="<?php echo $this->intMemberID; ?>" />
    <input type="hidden" name="p" value="<?php echo $this->intProjectID; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $_ENV['currentDate']; ?>"/><br /><br />
    Actual Baseline:<br />
    <textarea name="strStatusDate" /></textarea><br /><br />
    Plan Baseline:<br />
    <textarea name="strStatusActualDate" /></textarea><br /><br />
    Variation:<br />
    <textarea name="strStatusDifference"></textarea><br /><br />
    Notes/Reasons:<br />
    <textarea name="strStatusWhy"></textarea><br /><br />
    Attachment:<br />
    <input type="text" name="strStatusGanttLink" value="http://"/><br /><br />
    Attachment Comment:<br />
    <input type="text" name="strStatusGanttLinkComment" /><br />
    <br />
    <input type="submit" value="Submit" />
</form>

<?php include_once("view/status/bottomMenu.php"); ?>
