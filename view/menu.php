<td width="150">
<?php
echo '<form method="post">';
echo '<input type="hidden" name="page" value="status" />' . "\n";
echo '<input type="hidden" name="m" value="' . $currentMemberID . '" />' . "\n";
echo '<input type="hidden" name="p" value="' . $currentProjectID . '" />' . "\n";
echo '<input type="submit" value="Status" />' . "\n";
echo '</form>';
?><br />
&nbsp;- <a href="#">History</a><br />
&nbsp;- <a href="#">View</a><br />
&nbsp;- <a href="#">Add</a><br />
&nbsp;- <a href="#">Edit</a><br />
<br />
<a href="#">Issue</a><br />
<a href="#">Risk</a>
<br />
<a href="#">Timesheets</a><br />
<br />
<a href="javascript:history.go(-1)">Back</a><br />
<a href="">Logout</a>
</td>