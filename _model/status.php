<?php

class Status {
    private $statusDAObj;
    private $attachmentObj;
    private $intSessionID;
    private $memberArr, $projectArr;
    public $intStatusID;
    public $intProjectMemberID;
    public $dmtStatusCurrentDate;
    public $strActualBaseline;
    public $strPlanBaseline;
    public $strStatusVariation; // variation
    public $strStatusNotes; // Notes/Reasons

    function __construct($memberArr, $projectArr, $intSessionID) {
        $this->statusDAObj = new StatusDA();
        
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
    
    function getID() {
        if(isset($this->intStatusID)) {
            return $this->intStatusID;
        }
    }
    
    function setID($intStatusID) {
        $this->intStatusID = $intStatusID;
    }
    
    function getDetails() {
        $memberArr = $this->statusDAObj->getDetails($this->intStatusID);

        if(isset($memberArr)) {
            $this->intStatusID = $memberArr['intStatusID'];
            $this->intProjectMemberID = $memberArr['intProjectMemberID'];
            $this->dmtStatusCurrentDate = $memberArr['dmtStatusCurrentDate'];
            $this->strActualBaseline = $memberArr['strActualBaseline'];
            $this->strPlanBaseline = $memberArr['strPlanBaseline'];
            $this->strStatusVariation = $memberArr['strStatusVariation'];
            $this->strStatusNotes = $memberArr['strStatusNotes'];
            
            $statusArr['intStatusID'] = $this->intStatusID;
            $statusArr['intProjectMemberID'] = $this->intProjectMemberID;
            $statusArr['dmtStatusCurrentDate'] = $this->dmtStatusCurrentDate;
            $statusArr['strActualBaseline'] = $this->strActualBaseline;
            $statusArr['strPlanBaseline'] = $this->strPlanBaseline;
            $statusArr['strStatusVariation'] = $this->strStatusVariation;
            $statusArr['strStatusNotes'] = $this->strStatusNotes;
        }
        
        $this->attachmentObj->setStatusID($this->intStatusID);
        $this->attachmentObj->getDetailsFromDB("status");
        
        return $statusArr;
    }
    
    function getLastStatusID() {
        $intStatusID = $this->statusDAObj->getLastStatusID($this->projectArr['intProjectID']);
       
        if(!empty($intStatusID)) {
            $this->intStatusID = $intStatusID;
        } else {
            unset($this->intStatusID);
        }
        
        return $intStatusID;
    }
    
    function getGlobalLastStatusID() {
        $globalLastStatusID = 0;
        
        $query = "SELECT intStatusID FROM tblStatus" .
                " ORDER BY intStatusID DESC LIMIT 1;";

        $sqlArr = $_ENV['db']->query($query);
       
        if(isset($sqlArr[0])) {
            $globalLastStatusID = $sqlArr[0]['intStatusID'];
        }
        
        return $globalLastStatusID;
    }
    
    function setDetails($intStatusID, // <- refactor this!!!
            $dmtStatusCurrentDate,
            $strActualBaseline,
            $strPlanBaseline,
            $strStatusVariation,
            $strStatusNotes,
            $intAttachmentIDArr,
            $strAttachmentLinkArr,
            $strAttachmentCommentArr) {
        
        $this->statusDAObj->setDetails($intStatusID, $this->projectArr['intProjectID'], $this->intProjectMemberID, $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes);
        
        $this->attachmentObj->setStatusID($intStatusID);
        $this->attachmentObj->setDetails($intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
            $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr) {

        $nextStatusID = $this->getGlobalLastStatusID() + 1;
        
        $this->statusDAObj->addDetails($nextStatusID, $this->projectArr['intProjectID'], $this->intProjectMemberID, $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes);

        $this->attachmentObj->addDetails($nextStatusID, $strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function delDetails() {
        $this->statusDAObj->delDetails($this->intStatusID);
        $this->attachmentObj->delDetails($this->intStatusID);
        unset($this->intStatusID);
    }

    public function viewStatus() {
        
        // DRAFT (RAW CODE)
        $memberObj = new Member();
        $intMemberID = $memberObj->getMemberID($this->intProjectMemberID);
        $memberObj->setID($intMemberID);
        $memberArr = $memberObj->getDetails();
        
        $currentStatusMessage = "<b>Date:</b> " . 
                date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . "<br />" .
                "<b>Status created by: </b>";
        $currentStatusMessage .= $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'];
        $currentStatusMessage .= "<br />" .
                "<b>Project:</b> " . $this->projectArr['strProjectName'] . "<br /><br />" .
                "<b>Actual Status:</b><br />" . $this->strActualBaseline . "<br /><br />" .
                "<b>Planned Baseline:</b><br />" . $this->strPlanBaseline . "<br /><br />" .
                "<b>Variation:</b><br />" .
                $this->strStatusVariation . "<br /><br />" .
                "<b>Notes/Reasons:</b><br />" .
                $this->strStatusNotes . "<br /><br />";

        $this->attachmentObj->setStatusID($this->getID());

        $this->attachmentObj->getDetailsFromDB("status");
        $attachmentArr = $this->attachmentObj->getDetails();
        if ($attachmentArr != null) {
            foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
                // so to change 'foreach' to something else???
                // don't know better php construction (Mikhail)
                $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] . $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
                        $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
                        "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
            }
        }

        //$_ENV['firephp']->log($attachmentArr, 'attachmentArray');
        return $currentStatusMessage;

    }

    public function historyStatus() {
        $sqlArr = $this->statusDAObj->getAll($this->projectArr['intProjectID']);

        $memberObj = new Member();

        foreach ($sqlArr as $intStatusID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                switch ($columnName) {
                    case "intProjectMemberID":
                        $intMemberID = $memberObj->getMemberID($this->intProjectMemberID);
                        $memberObj->setID($intMemberID);
                        $memberArr = $memberObj->getDetails();
                        $tableArr[$intStatusID]['strMemberFirstName'] = $memberArr['strMemberFirstName'];
                        break;
                    case "dmtStatusCurrentDate":
                        $tableArr[$intStatusID][$columnName] = date("jS F Y", strtotime($value));
                        break;
                    default:
                        $tableArr[$intStatusID][$columnName] = $value;
                }
            }

            $this->attachmentObj->setStatusID($tableArr[$intStatusID]["intStatusID"]);
            $this->attachmentObj->getDetailsFromDB("status");

            $tableArr[$intStatusID]["strAttachmentLinkArr"] = "";
            $tableArr[$intStatusID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $tableArr[$intStatusID]["strAttachmentLinkArr"] .= '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
                            $attachmentArr['strAttachmentLinkArr'][$id] . '">' . $attachmentArr['strAttachmentLinkArr'][$id] . '</a><br />';
                    $tableArr[$intStatusID]['strAttachmentCommentArr'] .= $attachmentArr['strAttachmentCommentArr'][$id] . "<br />";
                }
            } else {
                $tableArr[$intStatusID]['strAttachmentLinkArr'] = "&nbsp;";
                $tableArr[$intStatusID]['strAttachmentCommentArr'] = "&nbsp;";
            }
        }
        
        $statusHistoryTableArr[0]['caption'] = "Status History for Project: " . $this->projectArr['strProjectName'];
        $statusHistoryTableArr[1] = $tableArr;
        
        return $statusHistoryTableArr;
    }

}
?>
