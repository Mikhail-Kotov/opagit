<h3>Add Status</h3>
<form method="post">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="add" />
    <input type="hidden" name="m" value="<?php echo $this->intMemberID; ?>" />
    <input type="hidden" name="p" value="<?php echo $this->intProjectID; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $_ENV['currentDate']; ?>"/><br />
    Where we are:<br />
    <input type="text" name="strStatusDate" /><br />
    Where we should be:<br />
    <input type="text" name="strStatusActualDate" /><br />
    Difference:<br />
    <textarea name="strStatusDifference"></textarea><br />
    Why:<br />
    <textarea name="strStatusWhy"></textarea><br />
    Gantt Link:<br />
    <input type="text" name="strStatusGanttLink" value="http://"/><br />
    Gantt Link Comment:<br />
    <input type="text" name="strStatusGanttLinkComment" /><br />
    <br />
    <input type="submit" value="Submit" />
</form>
