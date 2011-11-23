<?php
echo '<form  action="" method="post">' . "\n<div>";
echo '<input type="hidden" name="page" value="' . $name . '" />' . "\n";
echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
echo '<a><input type="submit" value="' . $caption . '" class="button" /></a>' . "\n</div>\n";
echo '</form>';
?>
