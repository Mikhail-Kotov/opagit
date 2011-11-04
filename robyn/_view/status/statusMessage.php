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
                   	








                   	
<h1>Status</h1>

 <p></p>  
 <div class="qtip-title">
 <div class="qtip-borderTop">
 <h4>&nbsp;</h4>
<?php
$currentStatusMessage = '<div class="group">Date:</div> '.'<div class="field">'. date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . '<div>' .
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
if($attachmentArr != null) {
    foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
        // so to change 'foreach' to something else???
        // don't know better php construction (Mikhail)
        $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
                $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
                "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
    }    
}


    $_ENV['firephp']->log($attachmentArr, 'attachmentArray');
?>
 </div><!--end of Status view-->
