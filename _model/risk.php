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

    
    // MK
    public function historyRisk() {
        $sortBy = null;
        $desc = false; // or true
        $sqlArr = $this->IRSDAObj->getAll($this->projectArr['intProjectID'], $sortBy, $desc);

        $memberObj = new Member();
        $projectObj = new Project();
        
        foreach ($sqlArr as $intRiskID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                switch ($columnName) {
                    case "intProjectID":
                        $projectObj->setID($value);
                        $projectArr = $projectObj->getDetails();
                        $tableArr[$intRiskID]['strProjectName'] = $projectArr['strProjectName'];
                        unset($projectArr);
                        break;                        
                    case "intProjectMemberID":
                        $intMemberID = $memberObj->getMemberID($value);
                        $memberObj->setID($intMemberID);
                        $memberArr = $memberObj->getDetails();
                        $tableArr[$intRiskID]['strMemberFirstName'] = $memberArr['strMemberFirstName'];
                        unset($memberArr);
                        break;
                    case "dmtRiskDateRaised":
                        $tableArr[$intRiskID][$columnName] = date("jS F Y", strtotime($value));
                        break;
                    case "intProjectMemberAssignedID":
                        $intMemberID = $memberObj->getMemberID($value);
                        $memberObj->setID($intMemberID);
                        $memberArr = $memberObj->getDetails();
                        $tableArr[$intRiskID]['strMemberFullName'] = $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'];
                        unset($memberArr);
                        break;
                    default:
                        $tableArr[$intRiskID][$columnName] = $value;    
                }
            }

            $this->attachmentObj->setID($tableArr[$intRiskID]['intRiskID'], 'risk');
            $this->attachmentObj->getDetailsFromDB();

            $tableArr[$intRiskID]["strAttachmentLinkArr"] = "";
            $tableArr[$intRiskID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $tableArr[$intRiskID]["strAttachmentLinkArr"] .= '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
                            $this->projectArr['strProjectName'] . '/' . $statusArr['dmtStatusCurrentDate'] . '/' .
                            $attachmentArr['strAttachmentLinkArr'][$id] . '">' . $attachmentArr['strAttachmentLinkArr'][$id] . '</a><br />';
                    $tableArr[$intRiskID]['strAttachmentCommentArr'] .= $attachmentArr['strAttachmentCommentArr'][$id] . "<br />";
                }
            } else {
                $tableArr[$intRiskID]['strAttachmentLinkArr'] = "&nbsp;";
                $tableArr[$intRiskID]['strAttachmentCommentArr'] = "&nbsp;";
            }
        }
        
        $riskHistoryTableArr[0]['caption'] = "<h1>Risk History for Project: " . $this->projectArr['strProjectName'] . "</h1>";
        $riskHistoryTableArr[1] = $tableArr;
        
        return $riskHistoryTableArr;
        
    }

    
}
?>
