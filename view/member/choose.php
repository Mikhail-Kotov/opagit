<td valign="top">
<?php

echo "<p>Choose a Member:</p>\n";
echo '<form method="post">' . "\n<p>\n";
echo '<select name="m">' . "\n";

//// code for adding new member
//if(isset($_POST["strMemberName"])) {
//    $strMemberName = $_POST["strMemberName"];
//    $query = "INSERT INTO `tblMember` (`intMemberID`, `strMemberName`) VALUES (NULL, '" . $strMemberName . "');";
//    $arr = getArr($query);
//}

$query = "SELECT m.intMemberID, m.strMemberName FROM
tblMember AS m,
tblProject AS p,
tblProjectMember AS pm
WHERE
m.intMemberID = pm.intMemberID AND
pm.intProjectID = p.intProjectID AND
p.intProjectID = " . $projectObj->intProjectID . ";";    

$arr = getArr($query);

foreach ($arr[0] as $columnName => $value) {
    $columnArr[] = $columnName;
}

foreach ($arr as $intStatusID) {
    echo '<option value="' . $intStatusID[$columnArr[0]] . '">' . $intStatusID[$columnArr[1]] . "</option>\n";
}
echo "</select>\n";
echo '<input type="hidden" name="page" value="main" />' . "\n";
echo '<input type="hidden" name="p" value="' . $projectObj->intProjectID . '" />' . "\n";
echo '<input type="submit" value="Choose" />' . "\n";
echo "</p>\n</form>\n";

// add Member
//echo '<a href="../add/member.php">Add new Member</a><br />' . "\n";

//echo '<a href="../edit/member.php">Edit a Member</a><br />' . "\n";
//echo '<a href="../delete/member.php">Delete a Member</a><br />' . "\n";
?>