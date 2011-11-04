<div id="navcol">
<!-- START MENU WRITER v2.0 -->
	<div id="left_menu">

    	<ul>
	    	<li class="top_item"><a href="#">Timesheets</a></li>
	    	<li class="selected"><a> <?php displayButton("status", "Status", $projectObj->getID(), $memberObj->getID()); ?></a>

            	<ul>
					
                	<li class="selected"><a><?php displayButton("statushistory", "History", $projectObj->getID(), $memberObj->getID()); ?></a></li>
                	<li class="selected"><a><?php displayButton("statusadd", "Add", $projectObj->getID(), $memberObj->getID()); ?></a></li>
                	<li class="selected"><a><?php displayButton("statusview", "View Last", $projectObj->getID(), $memberObj->getID()); ?></a></li>

                </ul>

            </li>
            <li><a href="#">Risk</a>
                <ul>

                 	<li class="selected"><?php displayButton("riskhistory", "Risk", $projectObj->getID(), $memberObj->getID()); ?></li>
                 	<li class="selected"><a href="#">Add Risk</a></li>
                 	<li class="selected"><a href="#">View Last Risk</a></li>
				</ul>
            </li>
            <li><a href="#">Issues</a>
                <ul>

			    	<li class="selected"><?php displayButton("issuehistory", "Issue", $projectObj->getID(), $memberObj->getID()); ?></li>
			    	<li class="selected"><a href="#">Add Issue</a></li>
			    	<li class="selected"><a href="#">View Last Issue</a></li>

                </ul>
            </li>
            
            <li><a href="http://cit.wta.swin.edu.au">CIT</a></li>
			<li><a href="#">Help</a></li>
            <li><a href="javascript:history.go(-1)">Back</a></li><br />
            <li><a class ="" href="">Logout</a></li>
		</ul>

    </div>
    	<!-- END MENU WRITER -->
</div>	
   <!-- <table width="100%" border="0">
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
                <a class ="" href="">Logout</a>
            </td>
        </tr>            
    </table>
</td>
<td valign="top">-->

