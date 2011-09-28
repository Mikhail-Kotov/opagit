<?php
// get strMemberName, strMemberFirstName, strMemberLastName
$memberObj = new Member($currentMemberID);
$memberObj->getDetails();

// get strProjectName
$projectObj = new Project($currentProjectID);
$projectObj->getDetails();

// find intProjectMemberID
$currentProjectMemberID = getProjectMember($memberObj->intMemberID, $projectObj->intProjectID);

echo "<p>Hello <b>" . $memberObj->strMemberFirstName . " " . $memberObj->strMemberLastName . "</b><br />";
echo 'You are loginned as <b>' . $memberObj->strMemberName . "</b><br />";
echo "Your Team is <b>" . $projectObj->strProjectTeamName . "</b><br />";
echo "Your Project is <b>" . $projectObj->strProjectName . "</b></p>";
?>
Please choose something from menu
