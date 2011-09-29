<td width="150" valign="top">
    <table width="100%" border="0">
        <tr>
            <td colspan="2">
                <?php displayButton("status", "Status", $currentMemberID, $currentProjectID); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statushistory", "History", $currentMemberID, $currentProjectID); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusview", "View Last", $currentMemberID, $currentProjectID); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusadd", "Add", $currentMemberID, $currentProjectID); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("issuehistory", "Issue", $currentMemberID, $currentProjectID); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("riskhistory", "Risk", $currentMemberID, $currentProjectID); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="#">Timesheets</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="javascript:history.go(-1)">Back</a><br />
                <a href="">Logout</a>
            </td>
        </tr>            
    </table>
</td>
<td valign="top">