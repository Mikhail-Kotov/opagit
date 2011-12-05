
<?php 
 /***************************************************************************************
 * Team Name: OPA                                                                       *
 * Date: 4 Dec 2011                                                                     *
 * Version No: 3                                                                        *
 *                                                                       				*
 * File Name: statusEditForm.inc.php                                                    *
 * Desc:This file displays the Status Edit Page                                         * 
 ***************************************************************************************/
?>
<h1>Edit St`atus</h1>
<div id="statusEditForm">
	<form method="post" action="" id="event-submission">
	    <input type="hidden" name="page" value="status" />
	    <input type="hidden" name="todo" value="edit" />
	    <input type="hidden" name="s" value="<?php echo $IRSArr['intStatusID']; ?>" />
	    <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
	    <div class="statusgrp"><div class="statuslabel"><label title="Do you want to change the date of the status?">Status Creation Date: </label></div>
	    <div class="stEditfield"><input type="text" title="Do you want to change the date of the status?" id="inputDate" class="inputDate" size="35" maxlength="40" name="dmtStatusCurrentDate" value="<?php echo $IRSArr['dmtStatusCurrentDate']; ?>"/></div></div>
	    <div class="statusgrp"><div class="statuslabel"><label for="intProjectID" title="Project Name">Project Name: </label></div>
	    <div class="stEditfield"><input type="text" name="strProjectName_NOT_USED" value="<?php echo $this->projectArr['strProjectName']; ?>" disabled="disabled" /></div></div>
	    
	    <div class="statusgrp"><div class="statuslabel"><label title="Do you want to change the actual status?">Actual Status: </label></div>
	    <div class="stEditfield"><textarea name="strActualBaseline" title="Do you want to change the actual status?" class="form_textarea" rows="2" cols="80"><?php echo $IRSArr['strActualBaseline']; ?></textarea></div></div>
	    <div class="statusgrp"><div class="statuslabel"><label title="Do you want to change the planned baseline?">Planned Baseline: </label></div>
	    <div class="stEditfield"><textarea name="strPlanBaseline" title="Do you want to change the planned baseline?" class="form_textarea" rows="2" cols="80"><?php echo $IRSArr['strPlanBaseline']; ?></textarea></div></div>
	    <div class="statusgrp"><div class="statuslabel"><label title="Do you want to change the variation comment?">Variation: </label></div>
	    <div class="stEditfield"><textarea name="strStatusVariation" title="Do you want to change the variation comment?" class="form_textarea" rows="2" cols="80"><?php echo $IRSArr['strStatusVariation']; ?></textarea></div></div>
	    <div class="statusgrp"><div class="statuslabel"><label title="Re type any comments here?">Notes/Reasons: </label></div>
	    <div class="stEditfield"><textarea name="strStatusNotes" title="Re type any comments here" class="form_textarea" rows="2" cols="80"><?php echo $IRSArr['strStatusNotes']; ?></textarea></div></div>
            <?php
            include_once("attachmentEditForm.inc.php");
            ?>
            
	<br />
    	<input type="image" src="images/submit.gif" alt="submit button" value="Submit" class="submit"/>
	</form>
</div>