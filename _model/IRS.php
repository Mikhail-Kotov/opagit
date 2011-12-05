<?php

class IRS {

    //private $IRSDAObj;
    protected $attachmentObj;
    protected $intSessionID;
    protected $memberArr, $projectArr;
    protected $intProjectMemberID;
    private $typeOfID, $ucTypeOfID, $shortTypeOfID, $intTypeOfID;

    function __construct($typeOfID, $memberArr, $projectArr, $intSessionID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
        $this->shortTypeOfID = substr($this->typeOfID, 0, 1);
        $this->intTypeOfID = 'int' . $this->ucTypeOfID . 'ID';
        

        $this->memberArr = $memberArr;
        $this->projectArr = $projectArr;

        $this->attachmentObj = new Attachment();
        $this->intSessionID = $intSessionID;
        $this->intProjectMemberID = $this->getProjectMember();
    }

    function getProjectMember() {
        $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE" .
                " intProjectID = " . $this->projectArr['intProjectID'] .
                " AND intMemberID = " . $this->memberArr['intMemberID'] . ";";

        $sqlArr = $_ENV['db']->query($query);

        $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
        return $intProjectMemberID;
    }

    public function getID() {
        $intID = null;
        if (!empty($this->IRSArr[$this->intTypeOfID])) {
            $intID = $this->IRSArr[$this->intTypeOfID];
        }

        return $intID;
    }

    function setID($intID) {
        $this->IRSArr[$this->intTypeOfID] = $intID;
    }

    function getDetails() {
        $this->IRSArr = $this->IRSDAObj->getDetails($this->IRSArr[$this->intTypeOfID]);

        $this->attachmentObj->setID($this->IRSArr[$this->intTypeOfID], $this->typeOfID);
        $this->attachmentObj->getDetailsFromDB();

        return $this->IRSArr;
    }

    function getLastID() {
        $intID = $this->IRSDAObj->getLastID($this->projectArr['intProjectID']);

        if (!empty($intID)) {
            $this->IRSArr[$this->intTypeOfID] = $intID;
        } else {
            unset($this->IRSArr[$this->intTypeOfID]);
        }

        return $intID;
    }

    function getGlobalLastID() {
        $globalLastIRSID = 0;

        $query = "SELECT " . $this->intTypeOfID . " FROM tbl" . $this->ucTypeOfID .
                " ORDER BY " . $this->intTypeOfID . " DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);

        if (isset($sqlArr[0])) {
            $globalLastIRSID = $sqlArr[0][$this->intTypeOfID];
        }

        return $globalLastIRSID;
    }

    public function setDetails($IRSArr, $intAttachmentIDArr, $deleteAttachmentArr) {
        $this->IRSDAObj->setDetails($IRSArr);

        $this->attachmentObj->setID($IRSArr[$this->intTypeOfID], $this->typeOfID);
        $this->attachmentObj->delIndividualDetails($deleteAttachmentArr);
    }

    public function addDetails($IRSArr, $strAttachmentLinkArr, $strAttachmentCommentArr) {
        $this->IRSArr[$this->intTypeOfID] = $this->getGlobalLastID() + 1;
        $this->IRSArr['intProjectID'] = $this->projectArr['intProjectID'];
        $this->IRSArr['intProjectMemberID'] = $this->intProjectMemberID;
        
        foreach($IRSArr as $id => $value) {
            $this->IRSArr[$id] = $IRSArr[$id];
        }
        
        $this->IRSDAObj->addDetails($this->IRSArr);

        $this->attachmentObj->setID($this->IRSArr[$this->intTypeOfID], $this->typeOfID);
        $this->attachmentObj->addDetails($strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function delDetails() {
        $this->IRSDAObj->delDetails($this->IRSArr[$this->intTypeOfID]);

        $this->attachmentObj->setID($this->IRSArr[$this->intTypeOfID], $this->typeOfID);
        $this->attachmentObj->delDetails();
        unset($this->IRSArr[$this->intTypeOfID]);
    }

    public function history() {
        $sortBy = null;
        $desc = false; // or true
        $sqlArr = $this->IRSDAObj->getAll($this->projectArr['intProjectID'], $sortBy, $desc);

        $memberObj = new Member();
        $projectObj = new Project();

        foreach ($sqlArr as $intID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                if ($this->typeOfID == 'status') {
                    switch ($columnName) {
                        case "intProjectID": // skip intProjectID
                            break;
                        case "intProjectMemberID":
                            $intMemberID = $memberObj->getMemberID($value);
                            $memberObj->setID($intMemberID);
                            $memberArr = $memberObj->getDetails();
                            $tableArr[$intID]['strMemberFirstName'] = $memberArr['strMemberFirstName'];
                            break;
                        case "dmtStatusCurrentDate":
                            $tableArr[$intID][$columnName] = date("jS F Y", strtotime($value));
                            $uploadDate = $value;
                            break;
                        default:
                            $tableArr[$intID][$columnName] = $value;
                    }
                }
                if ($this->typeOfID == 'risk') {
                    switch ($columnName) {
                        case "intProjectID":
                            $projectObj->setID($value);
                            $projectArr = $projectObj->getDetails();
                            $tableArr[$intID]['strProjectName'] = $projectArr['strProjectName'];
                            unset($projectArr);
                            break;
                        case "intProjectMemberID":
                            $intMemberID = $memberObj->getMemberID($value);
                            $memberObj->setID($intMemberID);
                            $memberArr = $memberObj->getDetails();
                            $tableArr[$intID]['strMemberFirstName'] = $memberArr['strMemberFirstName'];
                            unset($memberArr);
                            break;
                        case "dmtRiskDateRaised":
                            $tableArr[$intID][$columnName] = date("jS F Y", strtotime($value));
                            $uploadDate = $value;
                            break;
                        case "intProjectMemberAssignedID":
                            $intMemberID = $memberObj->getMemberID($value);
                            $memberObj->setID($intMemberID);
                            $memberArr = $memberObj->getDetails();
                            $tableArr[$intID]['strMemberFullName'] = $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'];
                            unset($memberArr);
                            break;
                        default:
                            $tableArr[$intID][$columnName] = $value;
                    }
                }
                if ($this->typeOfID == 'issue') {
                    switch ($columnName) {
                        case "intProjectID":
                            $projectObj->setID($value);
                            $projectArr = $projectObj->getDetails();
                            $tableArr[$intID]['strProjectName'] = $projectArr['strProjectName'];
                            unset($projectArr);
                            break;
                        case "intProjectMemberID":
                            $intMemberID = $memberObj->getMemberID($value);
                            $memberObj->setID($intMemberID);
                            $memberArr = $memberObj->getDetails();
                            $tableArr[$intID]['strMemberFirstName'] = $memberArr['strMemberFirstName'];
                            unset($memberArr);
                            break;
                        case "dmtIssueDateRaised ":
                            $tableArr[$intID][$columnName] = date("jS F Y", strtotime($value));
                            $uploadDate = $value;
                            break;
                        case "intProjectMemberAssignedID":
                            $intMemberID = $memberObj->getMemberID($value);
                            $memberObj->setID($intMemberID);
                            $memberArr = $memberObj->getDetails();
                            $tableArr[$intID]['strMemberFullName'] = $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'];
                            unset($memberArr);
                            break;
                        default:
                            $tableArr[$intID][$columnName] = $value;
                    }
                }
            }

            $this->attachmentObj->setID($tableArr[$intID][$this->intTypeOfID], $this->typeOfID);
            $this->attachmentObj->getDetailsFromDB();

            $tableArr[$intID]["strAttachmentLinkArr"] = "";
            $tableArr[$intID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $tableArr[$intID]["strAttachmentLinkArr"] .= '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
                            $this->projectArr['strProjectName'] . '/' . $uploadDate . '/' .
                            $attachmentArr['strAttachmentLinkArr'][$id] . '">' . $attachmentArr['strAttachmentLinkArr'][$id] . '</a><br />';
                    $tableArr[$intID]['strAttachmentCommentArr'] .= $attachmentArr['strAttachmentCommentArr'][$id] . "<br />";
                }
            } else {
                $tableArr[$intID]['strAttachmentLinkArr'] = "&nbsp;";
                $tableArr[$intID]['strAttachmentCommentArr'] = "&nbsp;";
            }
        }

        $historyTableArr[0]['caption'] = $this->ucTypeOfID . " History: " . $this->projectArr['strProjectName'];
        $historyTableArr[1] = $tableArr;

        return $historyTableArr;
    }

    public function view() {
        $memberObj = new Member();
        $intMemberID = $memberObj->getMemberID($this->IRSArr['intProjectMemberID']);
        $memberObj->setID($intMemberID);
        $memberArr = $memberObj->getDetails();

        switch ($this->typeOfID) {
            case 'status':
                $currentMessage = '<div class="viewgroup"><div class="labelView"><b>DATE: </b></div><div class="fieldstatus"> ' .
                        date("jS F Y", strtotime($this->IRSArr['dmtStatusCurrentDate'])) . "</div></div>\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Status Created By: </b></div>' . "\n" .
                        '<div class="fieldstatus">' . $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'] .
                        '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Project: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->projectArr['strProjectName'] . "</div></div>" . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Actual Status: </b></div><div class="fieldstatus"> ' . 
                        $this->IRSArr['strActualBaseline'] . "</div></div>" . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Planned Baseline: </b></div><div class="fieldstatus"> ' . 
                        $this->IRSArr['strPlanBaseline'] . "</div></div>" . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Variation: </b></div><div class="fieldstatus"> ' . 
                        $this->IRSArr['strStatusVariation'] . "</div></div>" . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Notes/Reasons: </b></div><div class="fieldstatus"> ' . 
                        $this->IRSArr['strStatusNotes'] . '</div></div>' . "\n";
                $uploadDate = $this->IRSArr['dmtStatusCurrentDate'];
                break;
            case 'risk':
                $memberAssignedArr = $this->getMemberAssignedArr(($this->IRSArr['intProjectMemberAssignedID']));

                $currentMessage = '<div class="viewgroup"><div class="labelView"><b>ID: </b></div><div class="fieldstatus"> ' .
                        $this->IRSArr[$this->intTypeOfID] . "</div></div>\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Project: </b></div><div class="fieldstatus"> ' .
                        $this->projectArr['strProjectName'] . "</div></div>\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Risk Raised By: </b></div>' . "\n" .
                        '<div class="fieldstatus">' . $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'] . "\n" .
                        '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Description: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['strRiskDescription'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Risk Type: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['strRiskTypeID'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Risk Status: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['enmRiskStatus'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Date Created: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . date("jS F Y", strtotime($this->IRSArr['dmtRiskDateRaised'])) . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Date Closed: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . date("jS F Y", strtotime($this->IRSArr['dmtRiskDateClosed'])) . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Risk Likelihood: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['enmRiskLikelihoodOfImpact'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Impact Description: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['strRiskImpactDescription'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Project Impact Rating: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['enmRiskProjectImpactRating'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Mitigation Strategy: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['strRiskMitigationStrategy'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Contingency/Prevention Strategy: </b></div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['strRiskContingencyStrategy'] . '</div></div>' . "\n" .
                        '<div class="viewgroup"><div class="labelView"><b>Assigned To: </b></div>' . "\n" .
                        '<div class="fieldstatus">' . $memberAssignedArr['strMemberFirstName'] . " " .
                        $memberAssignedArr['strMemberLastName'] . '</div></div>' . "\n";
                $uploadDate = $this->IRSArr['dmtRiskDateRaised'];
                break;
            case 'issue':
                $memberAssignedArr = $this->getMemberAssignedArr(($this->IRSArr['intProjectMemberAssignedID']));

                $currentMessage = '<div class="labelView">ID:</div><div class="fieldstatus"> ' . $this->IRSArr[$this->intTypeOfID] . "</div><br />\n" .
                        '<div class="labelView">Project:</div><div class="fieldstatus"> ' . $this->IRSArr['intProjectID'] . "</div><br />\n" .
                        '<div class="labelView">Issue Raised By:</div>' .
                        '<div class="fieldstatus">' . $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'] .
                        '</div><br />' . "\n" .
                        '<div class="labelView">Issue Status:</div>' . "\n" .
                        '<div class="fieldstatus"> ' . $this->IRSArr['enmIssueStatus'] . '</div><br />' . "\n" .
                        '<div class="labelView">Date Created:</div>' . "\n" .
                        '<div class="fieldstatus"> ' . date("jS F Y", strtotime($this->IRSArr['dmtIssueDateRaised'])) . '</div><br />' . "\n" .
                        '<div class="labelView"> Issue Deadline:</div>' . "\n" . '<div class="fieldstatus"> ' .
                        date("jS F Y", strtotime($this->IRSArr['dmtIssueDeadline'])) . '</div>' . "\n" .
                        '<div class="labelView">Issue Description:</div>' . "\n" . '<div class="fieldstatus"> ' .
                        $this->IRSArr['strIssueDescription'] . '</div>' . "\n" .
                        '<div class="labelView">Issue Type:</div>' . "\n" . '<div class="fieldstatus"> ' . $this->IRSArr['strIssueTypeID'] . '</div>' . "\n" .
                        '<div class="labelView">Issue Priority:</div>' . "\n" . '<div class="fieldstatus"> ' . $this->IRSArr['enmIssuePriority'] . '</div>' . "\n" .
                        '<div class="labelView">Assigned To:</div>' . "\n" . '<div class="fieldstatus"> ' . $memberAssignedArr['strMemberFirstName'] . " " .
                        $memberAssignedArr['strMemberLastName'] . '</div>' . "\n" .
                        '<div class="labelView">Date Closed:</div>' . "\n" . '<div class="fieldstatus"> ' .
                        date("jS F Y", strtotime($this->IRSArr['dmtIssueDateClosed'])) . '</div>' . "\n" .
                        '<div class="labelView">Issue Outcome:</div>' . "\n";
                $uploadDate = $this->IRSArr['dmtIssueDateRaised'];
                break;
        }

        $this->attachmentObj->setID($this->getID(), $this->typeOfID);

        $this->attachmentObj->getDetailsFromDB($this->typeOfID);
        $attachmentArr = $this->attachmentObj->getDetails();
        if ($attachmentArr != null) {
            foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
                // so to change 'foreach' to something else???
                // don't know better php construction (Mikhail)
                $currentMessage .= '<b>Attachment:</b><br /><a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
                        $this->projectArr['strProjectName'] . '/' . $uploadDate . '/'
                        . $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
                        $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
                        "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
            }
        }

        //$_ENV['firephp']->log($attachmentArr, 'attachmentArray');
        return $currentMessage;
    }

    private function getMemberAssignedArr($intProjectMemberAssignedID) {
        $memberAssignedObj = new Member();
        $intMemberAssignedID = $memberAssignedObj->getMemberID($intProjectMemberAssignedID);
        $memberAssignedObj->setID($intMemberAssignedID);
        $memberAssignedArr = $memberAssignedObj->getDetails();
        
        return $memberAssignedArr;
    }

}

?>
