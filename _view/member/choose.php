<?php
echo '<td valign="top">'."\n";
echo "<p>Choose a Member:</p>\n";
echo '<form method="post">' . "\n<p>\n";
echo '<select name="m">' . "\n";

$arr = $_ENV['db']->query("SELECT intMemberID, strMemberName FROM tblMember;");

foreach ($arr[0] as $columnName => $value) {
    $columnArr[] = $columnName;
}

foreach ($arr as $intMemberID) {
    echo '<option value="' . $intMemberID[$columnArr[0]] . '">' . $intMemberID[$columnArr[1]] . "</option>\n";
}

echo "</select>\n";
echo '<input type="hidden" name="page" value="chooseproject" />' . "\n";
echo '<input type="hidden" name="intSessionID" value="' . $sessionObj->getID() . '" />' . "\n";
echo '<input type="submit" value="Submit" />' . "\n";
echo "</p>\n</form>\n";
?>