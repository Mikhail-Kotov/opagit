<td valign="top">
<?php

echo "<p>Choose a Member:</p>\n";
echo '<form method="post">' . "\n<p>\n";
echo '<select name="m">' . "\n";

$query = "SELECT m.intMemberID, m.strMemberName FROM
tblMember AS m,
tblProject AS p,
tblProjectMember AS pm
WHERE
m.intMemberID = pm.intMemberID AND
pm.intProjectID = p.intProjectID AND
p.intProjectID = " . $projectObj->getID() . ";";    

$arr = $_ENV['db']->query($query);

foreach ($arr[0] as $columnName => $value) {
    $columnArr[] = $columnName;
}

foreach ($arr as $intStatusID) {
    echo '<option value="' . $intStatusID[$columnArr[0]] . '">' . $intStatusID[$columnArr[1]] . "</option>\n";
}
echo "</select>\n";
echo '<input type="hidden" name="page" value="main" />' . "\n";
echo '<input type="hidden" name="p" value="' . $projectObj->getID() . '" />' . "\n";
echo '<input type="submit" value="Choose" />' . "\n";
echo "</p>\n</form>\n";
?>