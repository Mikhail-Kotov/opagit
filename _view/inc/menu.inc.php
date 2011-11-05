        
<!-- START MENU WRITER v2.0 -->
<div id="navcol">
    <div id="left_menu">
        <ul>
            <li class="top_item"><a href="">Timesheets</a></li>
            <li class="selected"><?php displayButton("chooseproject", "Choose Project", $this->sessionArr['intSessionID']); ?></li>
            <li class="selected"><?php displayButton("status", "Status", $this->sessionArr['intSessionID']); ?>
                <?php if (substr_compare($this->sessionArr['strPage'], "status", 0, 6) == 0) { ?>
                    <ul><li class="selected"><?php displayButton("statushistory", "History", $this->sessionArr['intSessionID']); ?></li>
                        <li class="selected"><?php displayButton("statusadd", "Add", $this->sessionArr['intSessionID']); ?></li>
                        <li class="selected"><?php displayButton("statusview", "View Last", $this->sessionArr['intSessionID']); ?></li>
                    </ul>
                <?php } ?></li>
            <li class="selected"><?php displayButton("risk", "Risk", $this->sessionArr['intSessionID']); ?>
                <?php if (substr_compare($this->sessionArr['strPage'], "risk", 0, 4) == 0) { ?>
                    <ul><li class="selected"><?php displayButton("riskhistory", "History", $this->sessionArr['intSessionID']); ?></li>
                        <li class="selected"><?php displayButton("riskadd", "Add", $this->sessionArr['intSessionID']); ?></li>
                        <li class="selected"><?php displayButton("riskview", "View Last", $this->sessionArr['intSessionID']); ?></li>
                    </ul>
                <?php } ?></li>
            <li class="selected"><?php displayButton("issue", "Issue", $this->sessionArr['intSessionID']); ?>
                <?php if (substr_compare($this->sessionArr['strPage'], "issue", 0, 5) == 0) { ?>
                    <ul><li class="selected"><?php displayButton("issuehistory", "History", $this->sessionArr['intSessionID']); ?></li>
                        <li class="selected"><?php displayButton("issueadd", "Add", $this->sessionArr['intSessionID']); ?></li>
                        <li class="selected"><?php displayButton("issueview", "View Last", $this->sessionArr['intSessionID']); ?></li>
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
    