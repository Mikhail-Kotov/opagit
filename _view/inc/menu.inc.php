        
<!-- START MENU WRITER v2.0 -->
<div id="navcol">
    <div id="left_menu">
        <ul>
            <li class="top_item"><a href="">Timesheets</a></li>
            <li class="selected"><a><?php displayButton("chooseproject", "Choose Project", $this->sessionArr['intSessionID']); ?></a></li>
            <li class="selected"><a><?php displayButton("status", "Status", $this->sessionArr['intSessionID']); ?></a></li>
            <?php if(substr_compare($this->sessionArr['strPage'], "status", 0, 6) == 0) { ?>
            <li>
                <ul>
                    <li class="selected"><a><?php displayButton("statushistory", "History", $this->sessionArr['intSessionID']); ?></a></li>
                    <li class="selected"><a><?php displayButton("statusadd", "Add", $this->sessionArr['intSessionID']); ?></a></li>
                    <li class="selected"><a><?php displayButton("statusview", "View Last", $this->sessionArr['intSessionID']); ?></a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="selected"><a><?php displayButton("risk", "Risk", $this->sessionArr['intSessionID']); ?></a></li>
            <?php if(substr_compare($this->sessionArr['strPage'], "risk", 0, 4) == 0) { ?>
            <li>
                <ul>
                    <li class="selected"><a><?php displayButton("riskhistory", "History", $this->sessionArr['intSessionID']); ?></a></li>
                    <li class="selected"><a><?php displayButton("riskadd", "Add", $this->sessionArr['intSessionID']); ?></a></li>
                    <li class="selected"><a><?php displayButton("riskview", "View Last", $this->sessionArr['intSessionID']); ?></a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="selected"><a><?php displayButton("issue", "Issue", $this->sessionArr['intSessionID']); ?></a></li>
            <?php if(substr_compare($this->sessionArr['strPage'], "issue", 0, 5) == 0) { ?>
            <li>
                <ul>
                    <li class="selected"><a><?php displayButton("issuehistory", "History", $this->sessionArr['intSessionID']); ?></a></li>
                    <li class="selected"><a><?php displayButton("issueadd", "Add", $this->sessionArr['intSessionID']); ?></a></li>
                    <li class="selected"><a><?php displayButton("issueview", "View Last", $this->sessionArr['intSessionID']); ?></a></li>
                </ul>
            </li>
            <?php } ?>
            <li><a href="http://cit.wta.swin.edu.au/">CIT</a></li>
            <li><a href="#">Help</a></li>
            <li><a class="" href="">Logout</a></li>
        </ul>
    </div>
</div>
<div id="content">
    <div id="content-col">
<!-- END MENU WRITER v2.0 -->
    