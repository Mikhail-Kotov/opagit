<?php
$currentStatusMessage = "<b>Date:</b> " . date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . "<br />" .
        "<b>Status created by:</b> " . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "<br />" .
        "<b>Project:</b> " . $this->projectObj->strProjectName . "<br /><br />" .
        "<b>Actual Baseline:</b><br />" . $this->strActualBaseline . "<br /><br />" .
        "<b>Plan Baseline:</b><br />" . $this->strPlanBaseline . "<br /><br />" .
        "<b>Variation:</b><br />" .
        $this->strStatusVariation . "<br /><br />" .
        "<b>Notes/Reasons:</b><br />" .
        $this->strStatusNotes . "<br /><br />";

$this->attachmentObj->setStatusID($this->getID());
$this->attachmentObj->getDetailsFromDB();
$attachmentArr = $this->attachmentObj->getDetails();

foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
                                                                                // so to change 'foreach' to something else???
                                                                                // don't know better php construction (Mikhail)
    $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $attachmentArr['strAttachmentLinkArr'][$id] . '">' . 
            $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
            "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
}
    //$_ENV['firephp']->log($attachmentArray, 'attachmentArray');
?>
