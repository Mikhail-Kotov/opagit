<h1>Add Status</h1>
<form name="statusadd" method="post" action="" enctype="multipart/form-data" id="event-submission">
    <div>
        <input type="hidden" name="page" value="status" />
        <input type="hidden" name="todo" value="add" />
        <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
        <label for="intMemberID" title="Automatic Name field.">Member Name:</label>
        <div class="field"><input type="text" name="MemberName_NOT_USED" value="<?php echo $this->memberArr['strMemberFirstName']. " ". $this->memberArr['strMemberLastName']; ?>" class="input-text"  size="35" maxlength="40" disabled="disabled" /></div><br />

        <label for="intProjectID" title="Automatic Project Name field.">Project Name:</label>
        <div class="field"><input type="text" name="ProjectName_NOT_USED" value="<?php echo $this->projectArr['strProjectName']; ?>" class="input-text"  size="35" maxlength="40" disabled="disabled" /></div><br />

        <label for="dmtStatusCreationDate" title="The current date can be modified.">Status Creation Date:</label>
        <div class="field"><input type="text" name="dmtStatusCurrentDate" class="input-text" size="10" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" /></div><br />

        <label for="strActualBaseline" title="The actual baseline is based on your project management or Gantt. Enter your actual project status.">Actual Status:</label>
        <div class="field">
            <textarea name="strActualBaseline" title="The actual baseline is based on your project management or Gantt. Enter your actual project status." rows="2" cols="43"></textarea></div><br />

        <label for="strPlanBaseline" title="The Planned Baseline is where you expect to be in your project management.">Planned Baseline:</label>
        <div class="field"><textarea name="strPlanBaseline" title="The Plan Baseline is where you expect to be in your project management." rows="2" cols="43"></textarea></div><br />

        <label for="strStatusVariation" title="Variation is the difference between the actual baseline and the planned baseline.">Variation:</label>
        <div class="field"><textarea name="strStatusVariation" title="Variation is the difference between the actual baseline and the planned baseline." rows="2" cols="43"></textarea></div><br />

        <label for="strStatusNotes" title="Enter the reason for a variation in your planned and actual baseline. Enter other notes here.">Notes/Reasons:</label>
        <div class="field"><textarea name="strStatusNotes" title="Enter the reason for a variation in your planned and actual baseline. Enter other notes here." rows="2" cols="43"></textarea></div><br />

        <!--
        <div class="field"><input type="file" name="file" id="file" value="" /></div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        -->
        
        
        <label for="strAttachmentLink0" title="Browse for a file to substantiate your status e.g. Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls.">Attachment 1:</label>
        <div class="field"><input type="file" name="strAttachmentLink0" /></div><br />
        
        <label for="strAttachmentComment0" title="Name your attachment or add a comment.">Attachment Comment:</label>
        <div class="field"><input type="text" name="strAttachmentComment0" /></div><br /><div id="text"></div>
        <input type="button" onclick="addAttachmentLink()" src="images/add-more-attachments.gif" name="add" value="Add more attachments" />
        <br /><br />
        <input type="submit" src="images/submit.gif" value="Submit" />
    </div>
</form>
