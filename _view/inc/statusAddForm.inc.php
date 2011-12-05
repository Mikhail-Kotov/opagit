<h1>Add Status</h1>
<div id="viewthestatus">
	<form name="statusadd" method="post" action="" enctype="multipart/form-data" id="event-submission">
     <fieldset>
        <input type="hidden" name="page" value="status" />
        <input type="hidden" name="todo" value="add" />
        <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
        <div style="font-weight:normal;color:#E81C17">* All fields are required.</div>
        
        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="intMemberID" title="Automatic Name field.">Member Name:
        		</label>
        	</div>
        	<div class="fieldthestatus">
        		<input type="text" class="input-text" title="Automatic Name field." name="MemberName_NOT_USED" value="<?php echo $this->memberArr['strMemberFirstName']. " ".
                $this->memberArr['strMemberLastName']; ?>" class="input-text"  size="35" maxlength="40" disabled="disabled" />
            </div>
        </div><!--End of statusgrp div-->

        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="intProjectID" title="Automatic Project Name field.">Project Name: 
        		</label>
        	</div>
        	<div class="fieldthestatus">
        		<input type="text" title="Automatic Project field."  name="ProjectName_NOT_USED" value="<?php echo $this->projectArr['strProjectName']; ?>" class="input-text"  size="35" maxlength="40" disabled="disabled" />
        	</div>
        </div>

        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="dmtStatusCreationDate" title="The current date can be modified.">Status Creation Date: 
        		</label>
        	</div>
        	<div class="fieldthestatus">
        		<input type="text" id="inputDate" class="inputDate" title="The current date can be modified." name="dmtStatusCurrentDate" size="35" maxlength="40" value="<?php echo $_ENV['currentDate']; ?>" />	
        	</div>
        </div>

        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="strActualBaseline" title="The actual status is based on your project management or Gantt. Enter your actual project status.">Actual Status: 
        		</label>
        	</div>
        	<div class="fieldthestatus">
            	<textarea name="strActualBaseline" class="form_textarea" title="The actual status is based on your project management or Gantt. Enter your actual project status." rows="2" cols="80"></textarea>
            </div>
        </div>

        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="strPlanBaseline" title="The Planned Baseline is where you expect to be in your project management.">Planned Baseline:</label>
        	</div>
        	<div class="fieldthestatus">
        		<textarea name="strPlanBaseline" class="form_textarea" title="The Plan Baseline is where you expect to be in your project management." rows="2" cols="80"></textarea>
        	</div>
        </div>

        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="strStatusVariation" title="Variation is the difference between the actual status and the planned baseline.">Variation:</label>
        	</div>
        	<div class="fieldthestatus">
        		<textarea name="strStatusVariation" class="form_textarea" title="Variation is the difference between the actual status and the planned baseline." rows="2" cols="80"></textarea>
        	</div>
        </div>

        <div class="statusgrp">
        	<div class="labeladd">
        		<label for="strStatusNotes" title="Enter the reason for a variation in your planned baseline and actual status. Enter other notes here.">Notes/Reasons:</label>
        	</div>
        	<div class="fieldthestatus">
        		<textarea name="strStatusNotes" class="form_textarea" title="Enter the reason for a variation in your planned baseline and actual status. Enter other notes here." rows="2" cols="80"></textarea>
        	</div>
        </div>

        <?php
        include_once("attachmentAddForm.inc.php");
        ?>

        <div>&nbsp;</div>
        <input type="image" src="images/submit.gif" alt="submit button" value="Submit" class="submit" />
    	</fieldset>
	</form>
  </div>
