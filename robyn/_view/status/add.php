<div id="content">
                <div id="content-col">

                	<!-- START: BREADCRUMBS -->

                    <!--<div id="breadcrumbs">

                        <ul>

                            <li>&gt; <a href="http://cit3.ldl.swin.edu.au/~opamin/files/prototypes/Mikhails-prototype/index.php">Status</a></li>

                        </ul>

                    </div>-->
                    <div class="clear" ></div>

                   	<!-- END: BREADCRUMBS -->


<h1> Add Status</h1>

 <p></p>
  <div class="qtip-tip" rel="cornerValue">

 <div class="qtip-title">
<div class="qtip-borderTop">

<form name="statusadd" method="post" action="" id="event-submission">
<h4 >&nbsp;</h4>
<fieldset class="group">
    <input type="hidden" name="page" value="status" />
     </fieldset>
     <fieldset class="group">
    <input type="hidden" name="todo" value="add" />
   </fieldset>      
    <fieldset class="group">
      <label for="m" title="Automatic name field.">Member Name:</label>
         <div class="field">
            <input type="text" class="input-text"  name="m" value="<?php echo $this->memberObj->getID(); ?>" size="35" maxlength="40"/>
         </div>
    </fieldset>
    
    <input type="hidden" name="p" value="<?php echo $this->projectObj->getID(); ?>" />

    
    <fieldset class="group">
     <label for="intProjectID" title="Select a project that you want to report on.">Project Name:</label>
        <div class="field">
            <select name ="intProjectID" title="Select a project that you want to report on.">
	        <?php
	        $projectsArr = getProjects($this->memberObj->getID());
	        foreach ($projectsArr as $columnName => $value) {
	            echo '<option value="' . $value['intProjectID'] . '"';
	            if ($value['intProjectID'] == $this->projectObj->getID()) {
	                echo ' selected="selected"';
	            }
	            echo'>' . $value['strProjectName'] . "</option>\n";
	        }
	        ?>
	     </select>
        </div>
    </fieldset>
    
    <fieldset class="group">
      <label for="dmtStatusCurrentDate" title="The current date can be modified.">Status Creation Date:</label>
         <div class="field">
         	<input class="input-text" title="The current date can be modified." type="text" name="dmtStatusCurrentDate" id="dmtStatusCurrentDate" value="<?php echo $_ENV['currentDate']; ?>" size="35" maxlength="40" />
         </div>
    </fieldset>
    
    <fieldset class="group">
        <label for="strActualBaseline" title="The actual baseline is based on your project management or Gantt. Enter your actual project status.">Actual Baseline:</label>
            <div class="field">
                <textarea name="strActualBaseline" title="The actual baseline is based on your project management or Gantt. Enter your actual project status." rows="2" cols="43"/></textarea> 
            </div>
    </fieldset>
    
    <fieldset class="group">
       <label for="strPlanBaseline" title="The Plan Baseline is where you expect to be in your project management.">Plan Baseline:</label>
         <div class="field">
           <textarea name="strPlanBaseline" title="The Plan Baseline is where you expect to be in your project management." rows="2" cols="43"/></textarea>
         </div>
     </fieldset>
    
     <fieldset class="group">
       <label for="strStatusVariation" title="Variation is the difference between the actual baseline and the planned baseline.">Variation:</label>
            <div class="field">
		<textarea name="strStatusVariation" title="Variation is the difference between the actual baseline and the planned baseline." rows="2" cols="43"></textarea>
            </div>
     </fieldset>
	
     <fieldset class="group">
       <label for="strStatusNotes" title="Enter the reason for a variation in your planned and actual baseline. Enter other notes here.">Notes/Reasons:</label>
            <div class="field">
		<textarea name="strStatusNotes" title="Enter the reason for a variation in your planned and actual baseline. Enter other notes here." rows="2" cols="43"></textarea>
            </div>
    </fieldset>

    <fieldset class="group">
      <label for="strAttachmentLink0" title="Browse for a file to substantiate your status e.g.Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls.">Attachment 1:</label>
         <div class="field">
            <input class="input-text" type="text" title="Browse for a file to substantiate your status e.g.Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls." name="strAttachmentLink0" id="strAttachmentLink0" value="" size="35" maxlength="40" />
         </div>
    </fieldset>

    <fieldset class="group">
      <label for="strAttachmentComment0" title="Name your attachment or add a comment.">Attachment Comment:</label>
         <div class="field">
            <input class="input-text" type="text" name="strAttachmentComment0" id="strAttachmentComment0" value="" size="35" maxlength="40" />
         </div>
    </fieldset>

	<div class="submit">
         <!--create image for buttons-->
         <!--<input type="image" src="http://www.swinburne.edu.au/images/buttons/form-btn-request.gif" name="btn-submit" />

         <a href=""><img src="http://www.swinburne.edu.au/images/buttons/form-btn-reset.gif" alt="Reset" /></a>-->
         
		<input type="image" onclick="addAttachmentLink()" name="add" value="Add more attachments" src="images/addattach-button.gif"/><br />
        </div>
    
	<div class="submit">
            <!--<input type="submit" value="Submit" />-->
            <input type="image" src="images/submit-button.gif" name="btn-submit" />
	</div>
</form>
</div>
</div>
      </div>
<?php include_once("_view/status/bottomMenu.php"); ?>
