<td width="150" valign="top">
    <table width="100%" border="0">
        <tr>
            <td colspan="2">
                <?php displayButton("status", "Status", $projectObj->getID(), $memberObj->getID()); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statushistory", "History", $projectObj->getID(), $memberObj->getID()); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusview", "View Last", $projectObj->getID(), $memberObj->getID()); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusadd", "Add", $projectObj->getID(), $memberObj->getID()); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("issuehistory", "Issue", $projectObj->getID(), $memberObj->getID()); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("riskhistory", "Risk", $projectObj->getID(), $memberObj->getID()); ?>
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