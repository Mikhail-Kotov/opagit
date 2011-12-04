<?php

class IRS {
    //private $IRSDAObj;
    protected $attachmentObj;
    protected $intSessionID;
    protected $memberArr, $projectArr;
    protected $intProjectMemberID;
    private $typeOfID;
    protected $IRSArr;

    function __construct($typeOfID, $memberArr, $projectArr, $intSessionID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);

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
        if(!empty($this->IRSArr['int' . $this->ucTypeOfID . 'ID'])) {
            $intID = $this->IRSArr['int' . $this->ucTypeOfID . 'ID'];
        }
        
        return $intID;
    }
    
    function setID($intID) {
        $this->IRSArr['int' . $this->ucTypeOfID . 'ID'] = $intID;
    }
    
    function getDetails() {
        $this->IRSArr = $this->IRSDAObj->getDetails($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->getDetailsFromDB();
        
        return $this->IRSArr;
    }
    
    function getLastID() {
        $intID = $this->IRSDAObj->getLastID($this->projectArr['intProjectID']);
       
        if(!empty($intID)) {
            $this->IRSArr['int' . $this->ucTypeOfID . 'ID'] = $intID;
        } else {
            unset($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
        }
        
        return $intID;
    }
    
    function getGlobalLastID() {
        $globalLastIRSID = 0;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $globalLastIRSID = $sqlArr[0]['intStatusID'];
        }
        
        return $globalLastIRSID;
    }
    
    protected function setDetails($intAttachmentIDArr, $deleteAttachmentArr) {
        $this->IRSDAObj->setDetails($this->IRSArr);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->delIndividualDetails($deleteAttachmentArr);
    }
    
    protected function addDetails($strAttachmentLinkArr, $strAttachmentCommentArr) {
        $this->IRSDAObj->addDetails($this->IRSArr);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->addDetails($strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function delDetails() {
        $this->IRSDAObj->delDetails($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
        
        $this->attachmentObj->setID($this->IRSArr['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
        $this->attachmentObj->delDetails();
        unset($this->IRSArr['int' . $this->ucTypeOfID . 'ID']);
    }
    
    public function history() {
        $sortBy = null;
        $desc = false; // or true
        $sqlArr = $this->IRSDAObj->getAll($this->projectArr['intProjectID'], $sortBy, $desc);

        $memberObj = new Member();
        $projectObj = new Project();
        
        foreach ($sqlArr as $intID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                if($this->typeOfID == 'status') {
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
                            break;
                        default:
                            $tableArr[$intID][$columnName] = $value;
                    }
                }
                if($this->typeOfID == 'risk') {
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

            $this->attachmentObj->setID($tableArr[$intID]['int' . $this->ucTypeOfID . 'ID'], $this->typeOfID);
            $this->attachmentObj->getDetailsFromDB();

            $tableArr[$intID]["strAttachmentLinkArr"] = "";
            $tableArr[$intID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $tableArr[$intID]["strAttachmentLinkArr"] .= '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
                            $this->projectArr['strProjectName'] . '/' . $statusArr['dmtStatusCurrentDate'] . '/' .
                            $attachmentArr['strAttachmentLinkArr'][$id] . '">' . $attachmentArr['strAttachmentLinkArr'][$id] . '</a><br />';
                    $tableArr[$intID]['strAttachmentCommentArr'] .= $attachmentArr['strAttachmentCommentArr'][$id] . "<br />";
                }
            } else {
                $tableArr[$intID]['strAttachmentLinkArr'] = "&nbsp;";
                $tableArr[$intID]['strAttachmentCommentArr'] = "&nbsp;";
            }
        }
        
        $historyTableArr[0]['caption'] = "<h1>" . $this->ucTypeOfID . " History for Project: " . $this->projectArr['strProjectName'] . "</h1>";
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
                break;
            case 'risk':
                break;
            case 'issue':
                break;
        }

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
