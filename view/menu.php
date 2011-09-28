<td width="150">
<?php
displayButton("status", "Status", $currentMemberID, $currentProjectID);
?><br />
<?php displayButton("statushistory", "Status History", $currentMemberID, $currentProjectID); ?><br />
<?php displayButton("statusview", "View", $currentMemberID, $currentProjectID); ?><br />
<?php displayButton("statusadd", "Add", $currentMemberID, $currentProjectID); ?><br />
<?php displayButton("statusedit", "Edit", $currentMemberID, $currentProjectID); ?><br />
<br />
<a href="#">Issue</a><br />
<a href="#">Risk</a>
<br />
<a href="#">Timesheets</a><br />
<br />
<a href="javascript:history.go(-1)">Back</a><br />
<a href="">Logout</a>
</td>