<td valign="top">
<?php

echo "<p>Choose a Project:</p>\n";
echo '<form method="post">' . "\n<p>\n";
echo '<select name="p">' . "\n";

$query = "SELECT intProjectID, strProjectName FROM tblProject;";

$arr = getArr($query);

foreach ($arr[0] as $columnName => $value) {
    $columnArr[] = $columnName;
}

foreach ($arr as $arr2) {
    echo '<option value="' . $arr2[$columnArr[0]] . '">' . $arr2[$columnArr[1]] . "</option>\n";
}

echo "</select>\n";
echo '<input type="hidden" name="page" value="choosemember" />' . "\n";
echo '<input type="submit" value="Submit" />' . "\n";
echo "</p>\n</form>\n";
?>