        
<!-- START MENU WRITER v2.0 -->
<div id="navcol">
    <div id="left_menu">
        <ul>
            <li class="top_item"><a href="">Timesheets</a></li>
<?php            
$choosenItem = "";
if (strcmp("status", substr($this->sessionArr['strPage'], 0, 6)) == 0) { $choosenItem = "status"; }
if (strcmp("risk", substr($this->sessionArr['strPage'], 0, 4)) == 0) { $choosenItem = "risk"; }
if (strcmp("issue", substr($this->sessionArr['strPage'], 0, 5)) == 0) { $choosenItem = "issue"; }

$menuItemsArr = array('status', 'risk', 'issue');
foreach ($menuItemsArr as $menuItem) {
    echo '<li class="';
    if ($menuItem == $choosenItem) {
        echo "selected";
    } 
    echo '">'."\n";
    displayMenuButton($menuItem, ucfirst($menuItem), $this->sessionArr['intSessionID']);
    if (($menuItem == $choosenItem) && isset($this->sessionArr['intMemberID']) && isset($this->sessionArr['intProjectID'])) {
        echo '<ul>'."\n";

        echo '<li class="">';
        displayMenuButton($menuItem . 'history', "History", $this->sessionArr['intSessionID'], ($this->sessionArr['strPage'] == $menuItem . 'history') ||
                ($this->sessionArr['strPage'] == $menuItem));
        echo '</li>'."\n";

        echo '<li class="">';
        displayMenuButton($menuItem . 'add', "Add", $this->sessionArr['intSessionID'], ($this->sessionArr['strPage'] == $menuItem . 'add'));
        echo '</li>'."\n";

        echo '<li class="">';
        displayMenuButton($menuItem . 'view', "View Last", $this->sessionArr['intSessionID'], ($this->sessionArr['strPage'] == $menuItem . 'view'));
        echo '</li>'."\n";
        echo '</ul>'."\n";
    }
    echo '</li>'."\n";
}
?>
            <li><a href="#">Help</a></li>
            <li><a href="http://cit.wta.swin.edu.au/">CIT</a></li>
            <?php if (!empty($this->sessionArr['intMemberID'])) { ?>
                <li><a class="" href="">Logout</a></li>
            <?php } ?>
        </ul>
    </div><!-- END left_menu -->
</div><!-- END navcol -->
<div id="content">
    <div id="content-col">
        <!-- END MENU WRITER v2.0 -->
