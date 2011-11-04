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

<h1>Edit Status</h1>

 <p></p>
 <div class="qtip-title">
<div class="qtip-borderTop">
<form method="post" name="statusedit" id="event-submission">
<h4>&nbsp;</h4>
	<fieldset class="group">
    	<input type="hidden" name="page" value="status" />
   	</fieldset>
   	<fieldset class="group">
    	<input type="hidden" name="todo" value="edit" />
    </fieldset>
    <fieldset class="group">
    	<input type="hidden" name="s" value="<?php echo $this->intStatusID; ?>" />
    </fieldset>
   
    
    <fieldset class="group">
      <label for="m">Member Name:</label>
         <div class="field">
            <input type="text" class="input-text" name="m" value="<?php echo $this->memberObj->getID(); ?>" size="35" maxlength="40"/>
         </div>
    </fieldset>
    
    <input type="hidden" name="p" value="<?php echo $this->projectObj->getID(); ?>" />
    
    <fieldset class="group">
     <label for="intProjectID">Project Name:</label>
      <div class="field">
	 <select name ="intProjectID">
	        <?php 
	        $projectsArr = getProjects($this->memberObj->getID());
	        foreach ($projectsArr as $columnName  => $value) {
	            echo '<option value="' . $value['intProjectID'].'"';
	            if($value['intProjectID'] == $this->projectObj->getID()) {
	                echo ' selected="selected"';
	            }
	            echo'>'.$value['strProjectName']."</option>\n";
	        }
	        $_ENV['firephp']->log($projectsArr, 'ProjectsArr');
	        ?>
    	  </select>
     </div>
    </fieldset>
    
    <fieldset class="group">
      <label for="dmtStatusCurrentDate">Status Creation Date:</label>
         <div class="field">
            <input type="text" class="input-text" name="dmtStatusCurrentDate" value="<?php echo $this->dmtStatusCurrentDate; ?>" size="35" maxlength="40" />
         </div>
    </fieldset>
    
    <fieldset class="group">
       <label for="strActualBaseline">Actual Baseline:</label>
       <div class="field">
       	<textarea name="strActualBaseline" rows="2" cols="43"><?php echo $this->strActualBaseline; ?></textarea> 
       </div>
    </fieldset>
    
    <fieldset class="group">
       <label for="strPlanBaseline">Plan Baseline:</label>
         <div class="field">
           <textarea name="strPlanBaseline" rows="2" cols="43"><?php echo $this->strPlanBaseline; ?></textarea>
         </div>
     </fieldset>
   
    <fieldset class="group">
       <label for="strStatusVariation">Variation:</label>
          <div class="field">
            <textarea name="strStatusVariation" rows="2" cols="43"><?php echo $this->strStatusVariation; ?></textarea>
          </div>
    </fieldset>
	
    <fieldset class="group">
       <label for="strStatusNotes">Notes/Reasons:</label>
        <div class="field">
            <textarea name="strStatusNotes" rows="2" cols="43"><?php echo $this->strStatusNotes; ?></textarea>
	</div>
    </fieldset>
   

<?php    
$attachmentArr = $this->attachmentObj->getDetails();
foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
    echo    '<fieldset class="group">'.
            '<div class="field">'.
            '<input type="hidden" name="intAttachmentID' . $id .
            '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />' .
            '</div>' .
            '</fieldset>' .
            '<fieldset class="group">' .
            '<label for="strAttachmentLink0">Attachment:</label>' . 
            '<div class="field">'.
            '<input type="text" class="input-text" size="35" maxlength="40" name="strAttachmentLink' . $id . 
            '" value="' . $attachmentArr['strAttachmentLinkArr'][$id] . '" />' .
            '</div>' .
            '</fieldset>' .
            '<fieldset class="group">'.
            '<label for="strAttachmentComment0">Attachment Comment:</label>' .
            '<div class="field">'. 
            '<input type="text" class="input-text" size="35" maxlength="40" name="strAttachmentComment' . $id .
            '" value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" />' .
            '</div>' .
            '</fieldset>' ;
}
?>
    
	<div class="submit">
            <input type="submit" value="Submit" />
        </div>
        
</form>
</div>
</div>


