<h1>Edit Risk</h1>
    <form method ="post" action="" id="event-submission">
        <input type="hidden" name="page" value="risk" />
        <input type="hidden" name="page" value="edit" />
        <input type="hidden" name="r" value="<?php echo $IRSArr['intRiskID']; ?>" />
        <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
      <div class="statusgrp"><div id=" ">Project:</div>
        <input name="intProjectID" value="<?php echo $IRSArr['intProjectID']; ?>"/><br /><br />
        Raised By:
        <input name="intProjectMemberID" value="<?php echo $IRSArr['intProjectMemberID']; ?>"/><br /><br />
        Risk Description:
        <textarea name="strRiskDescription"><?php echo $IRSArr['strRiskDescription']; ?></textarea><br /><br />
        Risk Type:
        <input type="text" name="strRiskTypeID" value="<?php echo $IRSArr['strRiskTypeID']; ?>"/><br /><br />
        Risk Status:
        <input type="text" name="enmRiskStatus" value="<?php echo $IRSArr['enmRiskStatus']; ?>"/><br /><br />
        Date Created:
        <input type="text" name="dmtRiskDateRaised" value="<?php echo $IRSArr['dmtRiskDateRaised']; ?>"/><br /><br />
        Date Closed:
        <input type="text" name="dmtRiskDateClosed" value="<?php echo $IRSArr['dmtRiskDateClosed']; ?>"/><br /><br />
        Risk Likelihood Rating:
        <input type="text" name="enmRiskLikelihoodOfImpact" value="<?php echo $IRSArr['enmRiskLikelihoodOfImpact']; ?>"/><br /><br />
        Risk Impact Description:
        <input type="text" name="strRiskImpactDescription" value="<?php echo $IRSArr['strRiskImpactDescription']; ?>"/><br /><br />      
        Project Impact Rating:
        <input type="text" name="enmRiskProjectImpactRating" value="<?php echo $IRSArr['enmRiskProjectImpactRating']; ?>"/><br /><br />
        Risk Mitigation Strategy:
        <textarea name="strRiskMitigationStrategy"><?php echo $IRSArr['strRiskMitigationStrategy']; ?></textarea><br /><br />
        Risk Contingency Strategy:
        <textarea name="strRiskContingencyStrategy"><?php echo $IRSArr['strRiskContingencyStrategy']; ?></textarea><br /><br />
        Risk Assigned To:
        <input type="text" name="intProjectMemberAssignedID" value="<?php echo $IRSArr['intProjectMemberAssignedID']; ?>"/><br /><br />
       
        <!--<?php
           // $attachmentArr = $this->attachmentObj->getDetails();
           // foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
           // echo '<input type="hidden" name="intAttachmentID' . $id .
           // '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" />' .
           // "Attachment:<br />" . '<input type="text" name="strAttachmentLink' . $id .
           // '" value="' . $attachmentArr['strAttachmentLinkArr'][$id] . '" /><br /><br />' .
           // "Attachment Comment:<br />" . '<input type="text" name="strAttachmentComment' . $id .
           // ' value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" /><br /><br />';
       // }
        //?>-->

    <input type="image" src="images/submit.gif" alt="submit button" value="Submit" class="submit" />
</form>