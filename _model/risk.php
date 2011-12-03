<?php

class Risk extends IRS {

    function __construct($memberArr, $projectArr, $intSessionID) {
        parent::__construct('risk', $memberArr, $projectArr, $intSessionID);
        $this->IRSDAObj = new IRSDA('risk');
    }
    
    function setDetails(
            $intRiskID,
            $intProjectID,
            $intProjectMemberID,
            $strRiskTypeID,
            $strRiskDescription,
            $enmRiskStatus,
            $dmtRiskDateRaised,
            $dmtRiskDateClosed,
            $enmRiskLikelihoodOfImpact,
            $strRiskImpactDescription,
            $enmRiskProjectImpactRating,
            $strRiskMitigationStrategy,
            $strRiskContingencyStrategy,
            $intProjectMemberAssignedID) {

            $this->IRSArr['intRiskID'] = $intRiskID;
            $this->IRSArr['intProjectID'] = $intProjectID;
            $this->IRSArr['intProjectMemberID'] = $intProjectMemberID;
            $this->IRSArr['strRiskTypeID'] = $strRiskTypeID;
            $this->IRSArr['strRiskDescription'] = $strRiskDescription;
            $this->IRSArr['enmRiskStatus'] = $enmRiskStatus;
            $this->IRSArr['dmtRiskDateRaised'] = $dmtRiskDateRaised;
            $this->IRSArr['dmtRiskDateClosed'] = $dmtRiskDateClosed;
            $this->IRSArr['enmRiskLikelihoodOfImpact'] = $enmRiskLikelihoodOfImpact;
            $this->IRSArr['strRiskImpactDescription'] = $strRiskImpactDescription;
            $this->IRSArr['enmRiskProjectImpactRating'] = $enmRiskProjectImpactRating;
            $this->IRSArr['strRiskMitigationStrategy'] = $strRiskMitigationStrategy;
            $this->IRSArr['strRiskContingencyStrategy'] = $strRiskContingencyStrategy;
            $this->IRSArr['intProjectMemberAssignedID'] = $intProjectMemberAssignedID;

        parent::setDetails($intAttachmentIDArr, $deleteAttachmentArr);
    }

    function addDetails(
            $strRiskTypeID,
            $strRiskDescription,
            $enmRiskStatus,
            $dmtRiskDateRaised,
            $dmtRiskDateClosed,
            $enmRiskLikelihoodOfImpact,
            $strRiskImpactDescription,
            $enmRiskProjectImpactRating,
            $strRiskMitigationStrategy,
            $strRiskContingencyStrategy,
            $intProjectMemberAssignedID) {
        
        $this->IRSArr['intRiskID'] = $this->getGlobalLastID() + 1;
        $this->IRSArr['intProjectID'] = $this->projectArr['intProjectID'];
        $this->IRSArr['intProjectMemberID'] = $this->intProjectMemberID;
        $this->IRSArr['strRiskTypeID'] = $strRiskTypeID;
        $this->IRSArr['strRiskDescription'] = $strRiskDescription;
        $this->IRSArr['enmRiskStatus'] = $enmRiskStatus;
        $this->IRSArr['dmtRiskDateRaised'] = $dmtRiskDateRaised;
        $this->IRSArr['dmtRiskDateClosed'] = $dmtRiskDateClosed;
        $this->IRSArr['enmRiskLikelihoodOfImpact'] = $enmRiskLikelihoodOfImpact;
        $this->IRSArr['strRiskImpactDescription'] = $strRiskImpactDescription;
        $this->IRSArr['enmRiskProjectImpactRating'] = $enmRiskProjectImpactRating;
        $this->IRSArr['strRiskMitigationStrategy'] = $strRiskMitigationStrategy;
        $this->IRSArr['strRiskContingencyStrategy'] = $strRiskContingencyStrategy;
        $this->IRSArr['intProjectMemberAssignedID'] = $intProjectMemberAssignedID;

        parent::addDetails($strAttachmentLinkArr, $strAttachmentCommentArr);
    }


    public function viewRisk() {
        
        // DRAFT (RAW CODE)
        $memberObj = new Member();
        $intMemberID = $memberObj->getMemberID($this->IRSArr['intProjectMemberID']);
        $memberObj->setID($intMemberID);
        $memberArr = $memberObj->getDetails();
        
        $currentStatusMessage = "<b>Date:</b> " . 
                date("jS F Y", strtotime($this->IRSArr['dmtStatusCurrentDate'])) . "<br />" .
                "<b>Status created by: </b>";
        $currentStatusMessage .= $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'];
        $currentStatusMessage .= "<br />" .
                "<b>Project:</b> " . $this->projectArr['strProjectName'] . "<br /><br />" .
                "<b>Actual Status:</b><br />" . $this->IRSArr['strActualBaseline'] . "<br /><br />" .
                "<b>Planned Baseline:</b><br />" . $this->IRSArr['strPlanBaseline'] . "<br /><br />" .
                "<b>Variation:</b><br />" .
                $this->IRSArr['strStatusVariation'] . "<br /><br />" .
                "<b>Notes/Reasons:</b><br />" .
                $this->IRSArr['strStatusNotes'] . "<br /><br />";

        $this->attachmentObj->setID($this->getID(), 'status');

        $this->attachmentObj->getDetailsFromDB('status');
        $attachmentArr = $this->attachmentObj->getDetails();
        if ($attachmentArr != null) {
            foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
                // so to change 'foreach' to something else???
                // don't know better php construction (Mikhail)
                $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] . 
                        $this->projectArr['strProjectName'] . '/' . $this->IRSArr['dmtStatusCurrentDate'] . '/' 
                        . $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
                        $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
                        "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
            }
        }

        //$_ENV['firephp']->log($attachmentArr, 'attachmentArray');
        return $currentStatusMessage;

    }
    
}
?>
