<?php
$currentStatusMessage = "<b>Date:</b> " . date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . "<br />" .
        "<b>Status created by:</b> " . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "<br />" .
        "<b>Project:</b> " . $this->projectObj->strProjectName . "<br /><br />" .
        "<b>Actual Baseline:</b><br />" . $this->strActualBaseline . "<br /><br />" .
        "<b>Plan Baseline:</b><br />" . $this->strPlanBaseline . "<br /><br />" .
        "<b>Variation:</b><br />" .
        $this->strStatusDifference . "<br /><br />" .
        "<b>Notes/Reasons:</b><br />" .
        $this->strStatusWhy . "<br /><br />";
foreach ($this->attachmentObj->strAttachmentLink as $id => $strAttachmentLinkValue) {
    $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $this->attachmentObj->strAttachmentLink[$id] . '">' . 
            $this->attachmentObj->strAttachmentLink[$id] . "</a><br /><br />" .
            "<b>Attachment Comment:</b><br />" . $this->attachmentObj->strAttachmentComment[$id] . "<br /><br />";
}
    $_ENV['firephp']->log($this->attachmentObj->strAttachmentLink, 'strAttachmentLink');
?>
