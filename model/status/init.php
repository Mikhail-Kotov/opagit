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
$statusObj = new Status($currentProjectID, $currentProjectMemberID);
?>
