<div>
<?php

echo "<p>Choose a Project:</p>\n";
echo '<form method="post">' . "\n<p>\n";
echo '<select name="p">' . "\n";

$query = "SELECT p.intProjectID, p.strProjectName FROM
tblMember AS m,
tblProject AS p,
tblProjectMember AS pm
WHERE
m.intMemberID = pm.intMemberID AND
pm.intProjectID = p.intProjectID AND
m.intMemberID = " . $memberObj->getID() . ";";    

$arr = $_ENV['db']->query($query);

foreach ($arr[0] as $columnName => $value) {
    $columnArr[] = $columnName;
}

foreach ($arr as $intProjectID) {
    echo '<option value="' . $intProjectID[$columnArr[0]] . '">' . $intProjectID[$columnArr[1]] . "</option>\n";
}

echo "</select>\n";
echo '<input type="hidden" name="page" value="main" />' . "\n";
echo '<input type="hidden" name="m" value="' . $memberObj->getID() . '" />' . "\n";
echo '<input type="submit" value="Choose" />' . "\n";
echo "</p>\n</form>\n";
?>