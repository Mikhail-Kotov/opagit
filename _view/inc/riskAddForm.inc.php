<h1>Add Risk</h1>
<div id="viewthestatus">
<form name="riskadd" method="post" action="" id="event-submission">

        <!--<fieldset class="event-submission">-->

        	<div class="field">
            	<input type="hidden" class="input-text" id="page" value="risk" />
            	<input type="hidden"  class="input-text" id="todo" value="add" />
        	</div>
       
        	<div style="font-weight:normal;color:#E81C17">* All fields are required except the attachment and comment.</div><br />
      
        <div class="groupopa">
            <div class="labelopa">
                <label for="intProjectMemberID" title="Automatic name field.">Risk Raised By:</label>
            </div>
            <div class="fieldopa">
                <input type="text" class="input-text" title="Automatic name field." id="intProjectMemberID" value="<?php echo $this->memberArr['strMemberFirstName'] . " " . 
                    $this->memberArr['strMemberLastName']; ?>"  size="28" maxlength="40" disabled="disabled" />
            </div>
            <div class="labelopadate">
                <label for="strProjectName" title="Automatic project field.">Project Name:</label>
            </div>
           <div class="fieldopadate">
                <input type="text" id="strProjectName" value="<?php echo $this->projectArr['strProjectName']; ?>" class="input-text" title="Automatic project field." size="28" maxlength="43" disabled="disabled" />
           </div> 
        </div><!--end of group-->
        <div class="groupopa">    
            <div class="labelopa">
                <label for="strRiskDescription "  title="A description of the risk impact.">Risk Description:</label>
            </div>
            <div class="fieldopa"> 
                <textarea name="strRiskDescription" title="A description of the risk impact." class="form_textarea" rows="2" cols="80"></textarea>
            </div> 
        </div><!--end of group-->
        <div class="groupopa"> 
            <div class="labelopa">
                <label for="strRiskTypeID "  title="Select the type of risk">Risk Type:</label>
            </div>
            <div class="fieldopa">
                <select name="strRiskTypeID" title="Select the type of risk" class="form_dropdown">
                  
          				
                  <?php
                    foreach ($allRiskTypeArr as $id => $value_not_used) {
                        echo '<option value="' . $allRiskTypeArr[$id]['strRiskTypeID'] . '"';
                        echo '>' . $allRiskTypeArr[$id]['strRiskTypeID'] . "</option>\n";
                    }
                  ?>
                </select>
            </div>
        </div><!--end of group-->
        <div class="groupopa">
            <div class="labelopa">
                <label for="enmRiskStatus" title="Select the current status of the risk.">Risk Status:</label>
            </div>
            <div class="fieldopa">
                <select name="enmRiskStatus" title="Select the current status of the risk." class="form_dropdown">

                    <?php
                    //print_r($allRiskStatusArr);
                    foreach ($allRiskStatusArr as $id => $value_not_used) {
                        echo '<option value="' . $allRiskStatusArr[$id] . '"';
                        echo '>' . $allRiskStatusArr[$id] . "</option>\n";
                    }
                    ?>

                </select>
            </div> 
            <div class="labelopadate">
                <label for="dmtRiskDateRaised" title="The day the risk was raised.">Date Created:</label>
            </div>
            <div class="fieldopadate">
                <input type="text" class="inputDate" title="The day the risk was raised." id="inputDate" id="dmtRiskDateRaised" class="input-text" size="28" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" />
            </div>
          
            <div class="labelopadate">
                <label for="dmtRiskDateClosed "   title="The day the risk was closed. This is only available when a risk status is closed">Date Closed:</label>
            </div>
            <div class="fieldopadate">
                <input type="text" id="dmtRiskDateClosed" title="The day the risk was closed. This is only available when a risk status is closed" disabled="disabled" class="inputDate2" id="inputDate" class="input-text" size="28" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" />
            </div>
        </div><!--end of group-->
        <div class="groupopa">
            <div class="labelopa">
                <label for="enmRiskLikelihoodOfImpact"  title="Select the likelihood of the risk occurring.">Risk Likelihood Rating:</label>
            </div>
            <div class="fieldopa">
                <select name="enmRiskLikelihoodOfImpact" title="Select the likelihood of the risk occurring." class="form_dropdown">
                    <?php
                    //print_r($allRiskLikelihoodArr);
                    foreach ($allRiskLikelihoodArr as $id => $value_not_used) {
                        echo '<option value="' . $allRiskLikelihoodArr[$id] . '"';
                        echo '>' . $allRiskLikelihoodArr[$id] . "</option>\n";
                    }
                    ?>

                </select>
            </div>
        </div><!--end of group-->
    <hr />
        <div class="groupopa">
            <div class="labelopa">
                <label for="strRiskImpactDescription"  title="A description of the risk impact.">Risk Impact Description:</label>
            </div>
            <div class="fieldopa"> 
                <textarea name="strRiskImpactDescription" title="A description of the risk impact."  class="form_textarea" rows="2" cols="80"></textarea>
            </div>
        </div><!--end of group-->
        <div class="groupopa">    
            <div class="labelopa">
                <label for="enmRiskProjectImpactRating" title="Select the consequnce rating of the risk occurring.">Project Impact Rating: </label>
            </div>
            <div class="fieldopa">
                <select name="enmRiskProjectImpactRating" title="Select the consequnce rating of the risk occurring." class="form_dropdown">
                    <?php
                    //print_r($allRiskImpactRatingArr);
                    foreach ($allRiskImpactRatingArr as $id => $value_not_used) {
                        echo '<option value="' . $allRiskImpactRatingArr[$id] . '"';
                        echo '>' . $allRiskImpactRatingArr[$id] . "</option>\n";
                    }
                    ?>
                </select>
            </div>
        </div><!--end of group-->
        
    <hr />
        <div class="groupopa"> 
            <div class="labelopa">
                <label for="strRiskMitigationStrategy"  title="Describe the strategy to mitigate such a risk.">Risk Mitigation Strategy:</label>
            </div>
            <div class="fieldopa">
                <textarea name="strRiskMitigationStrategy" title="Describe the strategy to mitigate such a risk." class="form_textarea" rows="2" cols="80"></textarea>
            </div>
        </div><!--end of group-->
        
        <div class="groupopa"> 
            <div class="labelopa">
                <label for="strRiskContingencyStrategy" title="Describe the contingency stategy for this risk.">Risk Contingency Strategy:</label>
            </div>
            <div class="fieldopa">
                <textarea name="strRiskContingencyStrategy" title="Describe the contingency stategy for this risk."  class="form_textarea" rows="2" cols="80"></textarea>
            </div>
        </div><!--end of group-->
        
        <div class="groupopa"> 
            <div class="labelopa">
                <label for="intProjectMemberAssignedID"  title="Select who the risk is assigned to. You must assign this risk to someone to resolve">Risk Assigned To:</label>
            </div>
            <div class="fieldopa">
                <select name="intProjectMemberAssignedID" title="Select who the risk is assigned to. You must assign this risk to someone to resolve" class="form_dropdown">

                <?php
                $memberAssignedObj = new Member();
                $allMembersArr = $memberAssignedObj->getAllProjectMembers($this->sessionArr['intProjectID']);

                foreach ($allMembersArr as $id => $value) {
                    $intMemberAssignedID = $memberAssignedObj->getMemberID($allMembersArr[$id]['intMemberID']);
                    $memberAssignedObj->setID($intMemberAssignedID);
                    $memberAssignedArr = $memberAssignedObj->getDetails();

                    echo '<option value="' . $allMembersArr[$id]['intMemberID'] . '">' .
                            $allMembersArr[$id]['strMemberFirstName'] . " " .
                            $allMembersArr[$id]['strMemberLastName'] . "</option>\n";
                }
                ?>

                </select>
            </div>
        </div><!--end of group-->
        
        <div class="groupopa"> 
            <div class="labelopa">
                <label for="strAttachmentLink0" title="Browse for a file to substantiate your risk e.g.Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls.">Attachment 1:</label>
            </div>
            <div class="fieldopa">
                <input type="text" class="input-text" title="Browse for a file to substantiate your risk e.g.Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls." size="28" id="strAttachmentLink0" value="http://" />
            </div>
        </div><!--end of group-->
        <div class="groupopa"> 
            <div class="labelopa">
                <label for="strAttachmentComment0" title="Describe your attachment or add a comment.">Attachment Comment:</label>
            </div>
            <div class="fieldopa">
                <input type="text" class="input-text" title="Describe your attachment or add a comment." size="28" id="strAttachmentComment0" />
            </div>
        </div><!--end of group-->
        
        <div class="statusgrp">
            <div>&nbsp;</div> 
            	
                <input type="image"  onclick="addAttachmentLink()" id="add-more-attachments" src="images/add-more-attachments.gif" title="Add more attachments button will enable 3 more attachments to be attached."  alt="add attachments button" name="add" value="Add more attachments" />
                
            </div>
        <div>&nbsp;</div>
                <input type="image" src="images/submit.gif" alt="submit button"    value="Submit" class="submit" />
     
           
       
  <!-- </fieldset>-->
</form>
</div>