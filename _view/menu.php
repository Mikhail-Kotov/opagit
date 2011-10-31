<td width="150" valign="top">
    <table width="100%" border="0">
        <tr>
            <td colspan="2">
                <?php displayButtonNew("status", "Status", $sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButtonNew("statushistory", "History", $sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButtonNew("statusview", "View Last", $sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButtonNew("statusadd", "Add", $sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButtonNew("issuehistory", "Issue", $sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButtonNew("riskhistory", "Risk", $sessionArr['intSessionID']); ?>
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
                <a class ="" href="">Logout</a>
            </td>
        </tr>            
    </table>
</td>
<td valign="top">