<h3>Edit Status</h3>
<form method="post">
    <input type="hidden" name="page" value="status" />
    <input type="hidden" name="todo" value="edit" />
    <input type="hidden" name="s" value="<?php echo $this->intStatusID; ?>" />
    <input type="hidden" name="m" value="<?php echo $this->intMemberID; ?>" />
    <input type="hidden" name="p" value="<?php echo $this->intProjectID; ?>" />
    Status Creation Date:<br />
    <input type="text" name="dmtStatusCurrentDate" value="<?php echo $this->dmtStatusCurrentDate; ?>"/><br />
    Where we are:<br />
    <input type="text" name="strStatusDate" value="<?php echo $this->strStatusDate; ?>" /><br />
    Where we should be:<br />
    <input type="text" name="strStatusActualDate" value="<?php echo $this->strStatusActualDate; ?>" /><br />
    Difference:<br />
    <textarea name="strStatusDifference"><?php echo $this->strStatusDifference; ?></textarea><br />
    Why:<br />
    <textarea name="strStatusWhy"><?php echo $this->strStatusWhy; ?></textarea><br />
    Gantt Link:<br />
    <input type="text" name="strStatusGanttLink" value="<?php echo $this->strStatusGanttLink; ?>" /><br />
    Gantt Link Comment:<br />
    <input type="text" name="strStatusGanttLinkComment" value="<?php echo $this->strStatusGanttLinkComment; ?>" /><br />
    <br />
    <input type="submit" value="Edit" />
</form>
