<?php

class IRSController {

    protected $IRSObj, $attachmentObj;
    protected $sessionArr, $sessionObj;
    protected $memberArr, $projectArr;
    private $typeOfID, $ucTypeOfID, $shortTypeOfID, $intTypeOfID;

    public function __construct($typeOfID, $memberArr, $projectArr, $sessionArr) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
        $this->shortTypeOfID = substr($this->typeOfID, 0, 1);
        $this->intTypeOfID = 'int' . $this->ucTypeOfID . 'ID'; // intStatusID, intRiskID or intIssueID

        
        $this->sessionObj = new Session();
        $this->sessionArr = $sessionArr; // don't need to getDetails from Session Class, because we are already got SessionArr from Controller
        $this->memberArr = $memberArr;
        $this->projectArr = $projectArr;
        
        switch($this->typeOfID) {
            case 'status':
                $this->IRSObj = new Status($this->memberArr, $this->projectArr, $this->sessionArr['intSessionID']);
                break;
            case 'risk':
                $this->IRSObj = new Risk($this->memberArr, $this->projectArr, $this->sessionArr['intSessionID']);
                break;
            case 'issue':
                $this->IRSObj = new Issue($this->memberArr, $this->projectArr, $this->sessionArr['intSessionID']);
                break;
        }
        $this->attachmentObj = new Attachment();
    }

    public function main() {
        if ($this->sessionArr['strPage'] == $this->typeOfID) {
            if ($this->sessionArr['strTodo'] != "") {
                switch ($this->sessionArr['strTodo']) {
                    case 'add':
                        $this->todoAdd();
                        $this->sessionArr['strPage'] = $this->typeOfID . 'view';
                        break;
                    case 'edit':
                        $this->todoEdit();
                        $this->sessionArr['strPage'] = $this->typeOfID . 'view';
                        break;
                    case 'delete':
                        $this->todoDelete();
                        $this->sessionArr['strPage'] = $this->typeOfID . 'history';
                        break;
                    case 'email':
                        $this->todoEMail();
                        $this->sessionArr['strPage'] = $this->typeOfID . 'view';
                        break;
                }
            } else {
                $this->sessionArr['strPage'] = $this->typeOfID . 'history'; // if user choose Status from Menu
            }
        }
        
        switch($this->sessionArr['strPage']) {               
           case $this->typeOfID . 'history':
               $this->displayHistory();
               break;
           
           case $this->typeOfID . 'view':
               $this->displayView();
               break;
        }
        
        switch($this->sessionArr['strPage']) {               
           case $this->typeOfID . 'pdf':
               $this->displayPDF();
               break;
           
           case $this->typeOfID . 'add':
               $this->displayAddForm();
               break;
           
           case $this->typeOfID . 'edit':
               $this->displayEditForm();
               break;
        }
        
        
    }

    private function todoAdd() {
        $reloadAddForm = true;
        $IRSArr = array();
        switch ($this->typeOfID) {
            case 'status':
                $IRSArr['dmtStatusCurrentDate'] = $_POST['dmtStatusCurrentDate'];
                $IRSArr['strActualBaseline'] = $_POST['strActualBaseline'];
                $IRSArr['strPlanBaseline'] = $_POST['strPlanBaseline'];
                $IRSArr['strStatusVariation'] = $_POST['strStatusVariation'];
                $IRSArr['strStatusNotes'] = $_POST['strStatusNotes'];
                if(empty($IRSArr['strActualBaseline'])) {
                    $reloadAddForm = true;
                }
                
                $uploadDate = $IRSArr['dmtStatusCurrentDate'];
                break;
            case 'risk':
                $IRSArr['strRiskTypeID'] = $_POST['strRiskTypeID'];
                $IRSArr['strRiskDescription'] = $_POST['strRiskDescription'];
                $IRSArr['enmRiskStatus'] = $_POST['enmRiskStatus'];
                $IRSArr['dmtRiskDateRaised'] = $_POST['dmtRiskDateRaised'];
                $IRSArr['dmtRiskDateClosed'] = null;
                if(!empty($_POST['dmtRiskDateClosed'])) {
                    $IRSArr['dmtRiskDateClosed'] = $_POST['dmtRiskDateClosed'];
                }
                $IRSArr['enmRiskLikelihoodOfImpact'] = $_POST['enmRiskLikelihoodOfImpact'];
                $IRSArr['strRiskImpactDescription'] = $_POST['strRiskImpactDescription'];
                $IRSArr['enmRiskProjectImpactRating'] = $_POST['enmRiskProjectImpactRating'];
                $IRSArr['strRiskMitigationStrategy'] = $_POST['strRiskMitigationStrategy'];
                $IRSArr['strRiskContingencyStrategy'] = $_POST['strRiskContingencyStrategy'];
                $IRSArr['intProjectMemberAssignedID'] = $_POST['intProjectMemberAssignedID'];
                
                $uploadDate = $IRSArr['dmtRiskDateRaised'];
                break;
            case 'issue':
                $IRSArr['enmIssueStatus'] = $_POST['enmIssueStatus'];
                $IRSArr['dmtIssueDateRaised'] = $_POST['dmtIssueDateRaised'];
                $IRSArr['dmtIssueDeadline'] = $_POST['dmtIssueDeadline'];
                $IRSArr['strIssueDescription'] = $_POST['strIssueDescription'];
                $IRSArr['strIssueTypeID'] = $_POST['strIssueTypeID'];
                $IRSArr['enmIssuePriority'] = $_POST['enmIssuePriority'];
                $IRSArr['intProjectMemberAssignedID'] = $_POST['intProjectMemberAssignedID'];
                $IRSArr['dmtIssueDateClosed'] = $_POST['dmtIssueDateClosed'];
                $IRSArr['strIssueOutcome'] = $_POST['strIssueOutcome'];
                
                $uploadDate = $IRSArr['dmtIssueDateRaised'];
                break;
        }
       
        if($reloadAddForm != true) {
            
            $strAttachmentLinkArr = array();
            $strAttachmentCommentArr = array();

            if (!is_dir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'])) {
                mkdir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'], 0777);
            }

            if (!is_dir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'] . '/' . $uploadDate)) {
                mkdir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'] . '/' . $uploadDate, 0777);
            }


            $i = 0;
            while (isset($_FILES['strAttachmentLink' . ($i)])) {
                $target = $_ENV['uploads_dir'] . $this->projectArr['strProjectName'] .
                        '/' . $uploadDate . '/' . basename($_FILES['strAttachmentLink' . $i]['name']);
                if (!move_uploaded_file($_FILES['strAttachmentLink' . $i]['tmp_name'], $target)) {
                    echo "Sorry, there was a problem uploading your file."; // <--/this is Alert/
                } else {
                    $strAttachmentLinkArr[$i] = basename($_FILES['strAttachmentLink' . $i]['name']);
                    $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment" . $i];
                }
                $i++;
            }

            $this->IRSObj->addDetails($IRSArr, $strAttachmentLinkArr, $strAttachmentCommentArr);
        } else {
            $this->sessionArr['strPage'] = $this->typeOfID . 'add'; 
        }
    }

    private function todoDelete() {
        $this->IRSObj->setID($this->sessionArr[$this->intTypeOfID]);
        $this->IRSObj->delDetails();

        $this->sessionArr[$this->intTypeOfID] = null;
        $this->sessionObj->setDetails($this->sessionArr);
    }

    private function todoEdit() {
        $intAttachmentIDArr = array();
        $deleteAttachmentArr = array();
        
        $IRSArr = array();
        $IRSArr[$this->intTypeOfID] = $this->sessionArr[$this->intTypeOfID];
        
        switch ($this->typeOfID) {
            case 'status':
                $IRSArr['dmtStatusCurrentDate'] = $_POST['dmtStatusCurrentDate'];
                $IRSArr['strActualBaseline'] = $_POST['strActualBaseline'];
                $IRSArr['strPlanBaseline'] = $_POST['strPlanBaseline'];
                $IRSArr['strStatusVariation'] = $_POST['strStatusVariation'];
                $IRSArr['strStatusNotes'] = $_POST['strStatusNotes'];
                
                $uploadDate = $IRSArr['dmtStatusCurrentDate'];
                break;
            case 'risk':
                echo "editeditedit";
                $IRSArr['strRiskTypeID'] = $_POST['strRiskTypeID'];
                $IRSArr['strRiskDescription'] = $_POST['strRiskDescription'];
                $IRSArr['enmRiskStatus'] = $_POST['enmRiskStatus'];
                $IRSArr['dmtRiskDateRaised'] = $_POST['dmtRiskDateRaised'];
                $IRSArr['dmtRiskDateClosed'] = null;
                if(!empty($_POST['dmtRiskDateClosed'])) {
                    $IRSArr['dmtRiskDateClosed'] = $_POST['dmtRiskDateClosed'];
                }
                $IRSArr['enmRiskLikelihoodOfImpact'] = $_POST['enmRiskLikelihoodOfImpact'];
                $IRSArr['strRiskImpactDescription'] = $_POST['strRiskImpactDescription'];
                $IRSArr['enmRiskProjectImpactRating'] = $_POST['enmRiskProjectImpactRating'];
                $IRSArr['strRiskMitigationStrategy'] = $_POST['strRiskMitigationStrategy'];
                $IRSArr['strRiskContingencyStrategy'] = $_POST['strRiskContingencyStrategy'];
                $IRSArr['intProjectMemberAssignedID'] = $_POST['intProjectMemberAssignedID'];
                
                $uploadDate = $IRSArr['dmtRiskDateRaised'];
                break;
            case 'issue':
                $IRSArr['enmIssueStatus'] = $_POST['enmIssueStatus'];
                $IRSArr['dmtIssueDateRaised'] = $_POST['dmtIssueDateRaised'];
                $IRSArr['dmtIssueDeadline'] = $_POST['dmtIssueDeadline'];
                $IRSArr['strIssueDescription'] = $_POST['strIssueDescription'];
                $IRSArr['strIssueTypeID'] = $_POST['strIssueTypeID'];
                $IRSArr['enmIssuePriority'] = $_POST['enmIssuePriority'];
                $IRSArr['intProjectMemberAssignedID'] = $_POST['intProjectMemberAssignedID'];
                $IRSArr['dmtIssueDateClosed'] = $_POST['dmtIssueDateClosed'];
                $IRSArr['strIssueOutcome'] = $_POST['strIssueOutcome'];
                
                $uploadDate = $IRSArr['dmtIssueDateRaised'];
                break;
        }
        
        $isNextAttachment = true;
        $i = 0;
        do {
            $intAttachmentIDArr[$i] = null;
            if(isset($_POST['intAttachmentID' . $i])) {
                $intAttachmentIDArr[$i] = $_POST['intAttachmentID' . $i];
            }
            
            $deleteAttachmentArr[$i] = null;
            if(isset($_POST['deleteattachment' . $i])) {
                $deleteAttachmentArr[$i] = $_POST['deleteattachment' . $i];
            }
            if (isset($_POST["intAttachmentID" . ($i + 1)])) {
                $i++;
            } else {
                $isNextAttachment = false;
            }
        } while ($isNextAttachment == true);

        //print_r($deleteAttachmentArr);
        $this->IRSObj->setDetails($IRSArr, $intAttachmentIDArr, $deleteAttachmentArr);
    }
    
    private function todoEMail() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->getDetails();
        $currentStatusMessage = $this->statusObj->viewStatus();
        
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        
        
        $filename = 'status.pdf';
        if(is_file($_ENV['temp_dir'] . $filename) == TRUE) {
            unlink($_ENV['temp_dir'] . $filename);
        }
        $statusGUIObj->displayPDFStatus($currentStatusMessage, $filename);
        //$this->statusObj->emailStatus($currentStatusMessage);
        $this->statusObj->emailStatus();
    }

    protected function displayHistory() {
        $this->IRSObj->getLastID();
        $historyGUIObj = new IRSHistoryGUI($this->typeOfID);
        $historyGUIObj->setSession($this->sessionArr);

        $intID = $this->IRSObj->getID();
        if (!empty($intID)) {
            $this->IRSObj->getDetails();
            $historyTableArr = $this->IRSObj->history();
            $historyGUIObj->display($historyTableArr);
            $historyGUIObj->displayBottomMenu();
        } else {
            $this->sessionArr['strPage'] = $this->ucTypeOfID . 'add';
        }
    }
 

    protected function displayView() {
        if (!empty($this->sessionArr[$this->intTypeOfID])) {
            $this->displayViewPart();
        } else {
            $this->sessionArr[$this->intTypeOfID] = $this->IRSObj->getLastID();
            $this->sessionObj->setDetails($this->sessionArr);
            if (!empty($this->sessionArr[$this->intTypeOfID])) {
                $this->displayViewPart();
            } else {
                $this->sessionArr['strPage'] = $this->typeOfID . 'add';
            }
        }
    }
    
    private function displayViewPart() {
        $this->IRSObj->setID($this->sessionArr[$this->intTypeOfID]);
        $this->IRSObj->getDetails();
        $currentMessage = $this->IRSObj->view();
        
        $GUIObj = new IRSGUI($this->typeOfID);
        $GUIObj->setSession($this->sessionArr);
        $GUIObj->display($currentMessage);
    }
    
    private function displayPDF() {
        $this->IRSObj->setID($this->sessionArr[$this->intTypeOfID]);
        $this->IRSObj->getDetails();
        $currentStatusMessage = $this->IRSObj->view();
        
        $GUIObj = new IRSGUI($this->typeOfID);
        $GUIObj->setSession($this->sessionArr);
        $GUIObj->displayPDF($currentStatusMessage);
    }
    
    private function displayAddForm() {
        $this->sessionArr[$this->intTypeOfID] = null;
        $this->sessionObj->setDetails($this->sessionArr);
        
        $GUIObj = new IRSGUI($this->typeOfID);
        $GUIObj->setSession($this->sessionArr);
        $GUIObj->displayAddForm();
    }
    
    private function displayEditForm() {
        if ($this->sessionArr[$this->intTypeOfID] != "") {
            $this->IRSObj->setID($this->sessionArr[$this->intTypeOfID]);
            $IRSArr = $this->IRSObj->getDetails();
            $this->attachmentObj->setID($this->sessionArr[$this->intTypeOfID], $this->typeOfID);
            $this->attachmentObj->getDetailsFromDB($this->typeOfID);
            $attachmentArr = $this->attachmentObj->getDetails();
            
            $GUIObj = new IRSGUI($this->typeOfID);
            $GUIObj->setSession($this->sessionArr);
            $GUIObj->displayEditForm($IRSArr, $attachmentArr);
        } else {
            die("wrong data in edit form");
        }
    }
    
    private function displayEmailForm() {
        
    }

}

?>
