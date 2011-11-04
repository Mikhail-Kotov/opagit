<td width="150" valign="top">
    <table width="100%" border="0">
        <tr>
            <td colspan="2">
                <a href="#">Timesheets</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                &nbsp;
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php displayButton("chooseproject", "Choose Project", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                &nbsp;
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
                <?php displayButton("status", "Status", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <?php if(substr_compare($this->sessionArr['strPage'], "status", 0, 6) == 0) { ?>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statushistory", "History", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusview", "View Last", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("statusadd", "Add", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="2">
                <?php displayButton("riskhistory", "Risk", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <?php if(substr_compare($this->sessionArr['strPage'], "risk", 0, 4) == 0) { ?>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("riskhistory", "History", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="2">
                <?php displayButton("issuehistory", "Issue", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <?php if(substr_compare($this->sessionArr['strPage'], "issue", 0, 5) == 0) { ?>
        <tr>
            <td align="right">&nbsp;</td>
            <td>
                <?php displayButton("issuehistory", "History", $this->sessionArr['intSessionID']); ?>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        
        <?php if(!empty($this->sessionArr['intMemberID'])) { ?>
        <tr>
            <td colspan="2">
                <a class ="" href="">Logout</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</td>
<td valign="top">