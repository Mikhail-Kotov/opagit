<h1>Edit Risk</h1>
<div id="viewRisk">
    <form method ="post" action="" id="event-submission">
        <input type="hidden" name="page" value="risk" />
        <input type="hidden" name="todo" value="edit" />
        <input type="hidden" name="r" value="<?php echo $IRSArr['intRiskID']; ?>" />
        <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />

        <div class="statusgrp">
            <div class="statuslabel">
                <label title="You need to log out to change your project">Project: </label>
            </div>
            <div class="stEditfield">
                <input name="intProjectID" title="You need to log out to change your project" class="input-text" size="35" maxlength="40" value="<?php echo $IRSArr['intProjectID']; ?>"/>
            </div>
        </div><!--End of div class statusgrp-->

        <div class="statusgrp">
            <div class="statuslabel">
                <label for="intProjectMemberID" title="You can not change who raised this risk">Raised By: </label>
            </div>
            <div class="stEditfield">
                <input name="intProjectMemberID" class="input-text" title="You can not change who raised this risk" size="35" maxlength="40" value="<?php echo $IRSArr['intProjectMemberID']; ?>"/>
            </div>
        </div>
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk description?">Risk Description: </label>
            </div>
            <div class="stEditfield">
                <textarea name="strRiskDescription" title="Do you want to change the risk description?" class="form_textarea" rows="2" cols="80"><?php echo $IRSArr['strRiskDescription']; ?></textarea>
            </div>
        </div>
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk type?">Risk Type: </label>
            </div>
            <div class="stEditfield">
                <input type="text" class="input-text" title="Do you want to change the risk type?" name="strRiskTypeID" size="35" maxlength="40" value="<?php echo $IRSArr['strRiskTypeID']; ?>"/>
            </div>
        </div>
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk status?">Risk Status: </label>
            </div>
            <div class="stEditfield">
                <input type="text" class="input-text" title="Do you want to change the risk status?" size="35" maxlength="40" name="enmRiskStatus" value="<?php echo $IRSArr['enmRiskStatus']; ?>"/>
            </div>
        </div>
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the date risk was created?">Date Created: </label>
            </div>
            <div class="stEditfield">
                <input type="text" id="inputDate" class="inputDate" size="35" maxlength="40" name="dmtRiskDateRaised" value="<?php echo $IRSArr['dmtRiskDateRaised']; ?>"/>
            </div>
        </div>
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Risk status must be closed before you can put a closing date">Date Closed: </label>
            </div>
            <div class="stEditfield">
                <input type="text" id="inputDate2" class="inputDate2" size="35" maxlength="40" name="dmtRiskDateClosed" value="<?php echo $IRSArr['dmtRiskDateClosed']; ?>"/>
            </div>
        </div>
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk likelihood rating?">Risk Likelihood Rating: </label>
            </div>
            <div class="stEditfield">
                <input type="text" class="input-text" title="Do you want to change the risk likelihood rating?" size="35" maxlength="40" name="enmRiskLikelihoodOfImpact" value="<?php echo $IRSArr['enmRiskLikelihoodOfImpact']; ?>"/>
            </div>
        </div>        
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk impact description?">Risk Impact Description: </label>
            </div>
            <div class="stEditfield">
                <input type="text" name="strRiskImpactDescription" class="input-text" title="Do you want to change the risk impact description?" size="35" maxlength="40" value="<?php echo $IRSArr['strRiskImpactDescription']; ?>"/>
            </div>
        </div>    
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk impact rating?">Project Impact Rating: </label>
            </div>
            <div class="stEditfield">
                <input type="text" class="input-text" title="Do you want to change the risk impact rating?" size="35" maxlength="40" name="enmRiskProjectImpactRating" value="<?php echo $IRSArr['enmRiskProjectImpactRating']; ?>"/>
            </div>
        </div>  
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk mitigation strategy?">Risk Mitigation Strategy: </label>
            </div>
            <div class="stEditfield">
                <textarea name="strRiskMitigationStrategy" class="form_textarea" rows="2" cols="80" title="Do you want to change the risk mitigation strategy?"><?php echo $IRSArr['strRiskMitigationStrategy']; ?></textarea>
            </div>
        </div>         
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change the risk contingency strategy?">Risk Contingency Strategy: </label>
            </div>
            <div class="stEditfield">
                <textarea name="strRiskContingencyStrategy" class="form_textarea" rows="2" cols="80" title="Do you want to change the risk contingency strategy?"><?php echo $IRSArr['strRiskContingencyStrategy']; ?></textarea>
            </div>
        </div> 
        <div class="statusgrp">
            <div class="statuslabel">
                <label title="Do you want to change who the risk is assigned to?">Risk Assigned To: </label>
            </div>
            <div class="stEditfield">
                <input type="text" title="Do you want to change who the risk is assigned to?" class="input-text" size="35" maxlength="40" name="intProjectMemberAssignedID" value="<?php echo $IRSArr['intProjectMemberAssignedID']; ?>"/>
            </div>
        </div>        
        <?php
        include_once("attachmentEditForm.inc.php");
        ?>
        <input type="image" src="images/submit.gif" alt="submit button" value="Submit" class="submit" />
    </form><!-- End of id event-submission-->
</div>