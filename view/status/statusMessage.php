<?php
$currentStatusMessage = "<b>Date:</b> " . date("j F Y", strtotime($this->dmtStatusCurrentDate)) . "<br />" .
        "<b>Status created by:</b> " . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "<br />" .
        "<b>Project:</b> " . $this->projectObj->strProjectName . "<br /><br />" .
        "<b>Actual Baseline:</b><br />" . $this->strStatusDate . "<br /><br />" .
        "<b>Plan Baseline:</b><br />" . $this->strStatusActualDate . "<br /><br />" .
        "<b>Variation:</b><br />" .
        $this->strStatusDifference . "<br /><br />" .
        "<b>Notes/Reasons:</b><br />" .
        $this->strStatusWhy . "<br /><br />" .
        '<b>Attachment:</b><br /><a href="' . $this->attachmentObj->strAttachmentLink . '">' . $this->attachmentObj->strAttachmentLink . "</a><br /><br />" .
        "<b>Attachment Comment:</b><br />" . $this->attachmentObj->strAttachmentComment . "<br /><br />";
?>
