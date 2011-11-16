        
<!-- START MENU WRITER v2.0 -->
<div id="navcol">
    <div id="left_menu">
        <ul>
            <li class="top_item"><a href="">Timesheets</a></li>
            <li class="selected"><?php displayMenuButton("chooseproject", "Choose Project", $this->sessionArr['intSessionID']); ?></li>
            <li class="selected"><?php displayMenuButton("status", "Status", $this->sessionArr['intSessionID']); ?>
                <?php if (strcmp("status", substr($this->sessionArr['strPage'], 0, 6)) == 0) { ?>
                    <ul><li class="selected"><?php displayMenuButton("statushistory", "History", $this->sessionArr['intSessionID'], 
                            ($this->sessionArr['strPage'] == "statushistory") || ($this->sessionArr['strPage'] == "status")); ?></li>
                        <li class="selected"><?php displayMenuButton("statusadd", "Add", $this->sessionArr['intSessionID'], 
                                ($this->sessionArr['strPage'] == "statusadd")); ?></li>
                        <li class="selected"><?php displayMenuButton("statusview", "View Last", $this->sessionArr['intSessionID'], 
                                ($this->sessionArr['strPage'] == "statusview")); ?></li>
                    </ul>
                <?php } ?></li>
            <li class="selected"><?php displayMenuButton("risk", "Risk", $this->sessionArr['intSessionID']); ?>
                <?php if (strcmp("risk", substr($this->sessionArr['strPage'], 0, 4)) == 0) { ?>
                    <ul><li class="selected"><?php displayMenuButton("riskhistory", "History", $this->sessionArr['intSessionID'], 
                            ($this->sessionArr['strPage'] == "riskhistory") || ($this->sessionArr['strPage'] == "risk")); ?></li>
                        <li class="selected"><?php displayMenuButton("riskadd", "Add", $this->sessionArr['intSessionID'], 
                                ($this->sessionArr['strPage'] == "riskadd")); ?></li>
                        <li class="selected"><?php displayMenuButton("riskview", "View Last", $this->sessionArr['intSessionID'],
                                ($this->sessionArr['strPage'] == "riskview")); ?></li>
                        </ul>
                <?php } ?></li>
            <li class="selected"><?php displayMenuButton("issue", "Issue", $this->sessionArr['intSessionID']); ?>
                <?php if (strcmp("issue", substr($this->sessionArr['strPage'], 0, 5)) == 0) { ?>
                    <ul><li class="selected"><?php displayMenuButton("issuehistory", "History", $this->sessionArr['intSessionID'], 
                            ($this->sessionArr['strPage'] == "issuehistory") || ($this->sessionArr['strPage'] == "issue")); ?></li>
                        <li class="selected"><?php displayMenuButton("issueadd", "Add", $this->sessionArr['intSessionID'], 
                                ($this->sessionArr['strPage'] == "issueadd")); ?></li>
                        <li class="selected"><?php displayMenuButton("issueview", "View Last", $this->sessionArr['intSessionID'],
                                ($this->sessionArr['strPage'] == "issueview")); ?></li>
                        </ul></li>
            <?php } ?></li>
            <li><a href="http://cit.wta.swin.edu.au/">CIT</a></li>
            <li><a href="#">Help</a></li>
            <?php if (!empty($this->sessionArr['intMemberID'])) { ?>
                <li><a class="" href="">Logout</a></li>
            <?php } ?>
        </ul>
    </div><!-- END left_menu -->
</div><!-- END navcol -->
<div id="content">
    <div id="content-col">
        <!-- END MENU WRITER v2.0 -->
