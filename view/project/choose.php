<td valign="top">
<?php

echo "<p>Choose a Project:</p>\n";
echo '<form method="post">' . "\n<p>\n";
echo '<select name="p">' . "\n";

$arr = $_ENV['db']->query("SELECT intProjectID, strProjectName FROM tblProject;");

foreach ($arr[0] as $columnName => $value) {
    $columnArr[] = $columnName;
}

foreach ($arr as $intStatusID) {
    echo '<option value="' . $intStatusID[$columnArr[0]] . '">' . $intStatusID[$columnArr[1]] . "</option>\n";
}

echo "</select>\n";
echo '<input type="hidden" name="page" value="choosemember" />' . "\n";
echo '<input type="submit" value="Submit" />' . "\n";
echo "</p>\n</form>\n";
?>