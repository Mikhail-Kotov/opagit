        
<!-- START MENU WRITER v2.0 -->
<div id="navcol">
    <div id="left_menu">
        <ul>
            <li class="top_item"><a href="">Timesheets</a></li>
            <li class="selected"><?php displayButton("chooseproject", "Choose Project", $this->sessionArr['intSessionID']); ?></li>
            <li class="selected"><?php displayButton("status", "Status", $this->sessionArr['intSessionID']); ?></li>
            <?php if(substr_compare($this->sessionArr['strPage'], "status", 0, 6) == 0) { ?>
            <li><ul>
                    <li class="selected"><?php displayButton("statushistory", "History", $this->sessionArr['intSessionID']); ?></li>
                    <li class="selected"><?php displayButton("statusadd", "Add", $this->sessionArr['intSessionID']); ?></li>
                    <li class="selected"><?php displayButton("statusview", "View Last", $this->sessionArr['intSessionID']); ?></li>
                </ul>
            </li>
            <?php } ?>
            <li><a href="#">Risk</a>
                <ul>
                    <li class="selected">
                        <form action="" method="post">
                            <div>
                                <input name="page" value="riskhistory" type="hidden" />
                                <input name="p" value="1" type="hidden" />
                                <input name="m" value="1" type="hidden" />
                                <input value="Risk" class="button" type="submit" />
                            </div>
                        </form>
                    </li>
                    <li class="selected"><a href="#">Add Risk</a></li>
                    <li class="selected"><a href="#">View Last Risk</a></li>
                </ul>
            </li>
            <li><a href="#">Issues</a>
                <ul>
                    <li class="selected">
                        <form action="" method="post">
                            <div>
                                <input name="page" value="issuehistory" type="hidden" />
                                <input name="p" value="1" type="hidden" />
                                <input name="m" value="1" type="hidden" />
                                <input value="Issue" class="button" type="submit" />
                            </div>
                        </form>
                    </li>
                    <li class="selected"><a href="#">Add Issue</a></li>
                    <li class="selected"><a href="#">View Last Issue</a></li>
                </ul>
            </li>
            <li><a href="http://cit.wta.swin.edu.au/">CIT</a></li>
            <li><a href="#">Help</a></li>
            <li><a href="javascript:history.go(-1)">Back</a></li>
            <li><a class="" href="">Logout</a></li>
        </ul>
    </div>
</div>
<div> 
    <!-- END MENU WRITER v2.0 --> 


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