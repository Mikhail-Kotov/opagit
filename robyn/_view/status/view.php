<?php
include_once("statusMessage.php");

echo $currentStatusMessage;

echo '<div>';
echo '<form method="post" id="event-submission">';
echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="Edit Status" class="button" />' . "\n";
echo '</form>';
echo '<form method="post">';
echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="PDF" class="button" />' . "\n";
echo "</form>";
echo '<form method="post">';
echo '<input type="hidden" name="page" value="status" />' . "\n";
echo '<input type="hidden" name="todo" value="delete" />' . "\n";
echo '<input type="hidden" name="m" value="' . $this->memberObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $this->projectObj->getID() . '" />' . "\n";
echo '<input type="hidden" name="s" value="' . $this->intStatusID . '" />' . "\n";
echo '<input type="submit" value="Delete" class="button" />' . "\n";
echo "</form>\n";
echo "</div>";
?>

