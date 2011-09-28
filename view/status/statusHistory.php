<td>
<?php
// get strMemberName, strMemberFirstName, strMemberLastName
$memberObj = new Member($currentMemberID);
$memberObj->getDetails();

// get strProjectName
$projectObj = new Project($currentProjectID);
$projectObj->getDetails();

// find intProjectMemberID
$currentProjectMemberID = getProjectMember($memberObj->intMemberID, $projectObj->intProjectID);

// get last status details
$statusObj = new Status($projectObj->intProjectID, $currentProjectMemberID);
$statusObj->getDetails();

echo "<p>Hello <b>" . $memberObj->strMemberFirstName . " " . $memberObj->strMemberLastName . "</b><br />";
echo 'You are loginned as <b>' . $memberObj->strMemberName . "</b><br />";
echo "Your Team is <b>" . $projectObj->strProjectTeamName . "</b><br />";
echo "Your Project is <b>" . $projectObj->strProjectName . "</b></p>";

if (isset($statusObj->intStatusID)) {
    $statusObj->displayStatus();
}

echo '<form method="post">';
echo '<input type="hidden" name="page" value="addstatus" />' . "\n";
echo '<input type="hidden" name="m" value="' . $memberObj->intMemberID . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $projectObj->intProjectID . '" />' . "\n";
echo '<input type="submit" value="Add New Status" />' . "\n";
echo '</form>';
$statusObj->displayStatusHistory();

echo "<br /><br />\n";

$riskObj = new Risk();
$riskObj->echoRiskTable($memberObj->intMemberID, $projectObj->intProjectID);
echo "<br />\n";

$issueObj = new Issue();
$issueObj->echoIssueTable($memberObj->intMemberID, $projectObj->intProjectID);

?>
</td>