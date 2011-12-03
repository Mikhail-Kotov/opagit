<?php

class IRSController {

    protected $IRSObj, $attachmentObj;
    protected $sessionArr, $sessionObj;
    protected $memberArr, $projectArr;
    private $typeOfID, $ucTypeOfID;

    public function __construct($typeOfID, $memberArr, $projectArr, $sessionArr) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
        
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
        $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
        $strActualBaseline = $_POST['strActualBaseline'];
        $strPlanBaseline = $_POST['strPlanBaseline'];
        $strStatusVariation = $_POST['strStatusVariation'];
        $strStatusNotes = $_POST['strStatusNotes'];
        
        $strAttachmentLinkArr = array();
        $strAttachmentCommentArr = array();
        
        if(!is_dir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'])) {
            mkdir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'], 0777);
        }
        
        if(!is_dir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'] . '/' . $dmtStatusCurrentDate)) {
            mkdir($_ENV['uploads_dir'] . $this->projectArr['strProjectName'] . '/' . $dmtStatusCurrentDate, 0777);
        }
        
        
        $i = 0;
        while (isset($_FILES['strAttachmentLink' . ($i)])) {
            $target = $_ENV['uploads_dir'] . $this->projectArr['strProjectName'] .
                    '/' . $dmtStatusCurrentDate . '/' . basename($_FILES['strAttachmentLink' . $i]['name']);
            if (!move_uploaded_file($_FILES['strAttachmentLink' . $i]['tmp_name'], $target)) {
                echo "Sorry, there was a problem uploading your file."; // <--/this is Alert/
            } else {
                $strAttachmentLinkArr[$i] = basename($_FILES['strAttachmentLink' . $i]['name']);
                $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment" . $i];
            }
            $i++;
        }
        
        $this->statusObj->addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
                $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    private function todoDelete() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->delDetails();

        $this->sessionArr['intStatusID'] = null;
        $this->sessionObj->setDetails($this->sessionArr);
    }

    private function todoEdit() {
        $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
        $strActualBaseline = $_POST['strActualBaseline'];
        $strPlanBaseline = $_POST['strPlanBaseline'];
        $strStatusVariation = $_POST['strStatusVariation'];
        $strStatusNotes = $_POST['strStatusNotes'];

        $isNextAttachment = true;
        $i = 0;
        do {
            $intAttachmentIDArr[$i] = $_POST['intAttachmentID' . $i];
            if(isset($_POST['deleteattachment' . $i])) {
                $deleteAttachmentArr[$i] = $_POST['deleteattachment' . $i];
            }
            if (isset($_POST["intAttachmentID" . ($i + 1)])) {
                $i++;
            } else {
                $isNextAttachment = false;
            }
        } while ($isNextAttachment == true);

        print_r($deleteAttachmentArr);
        $this->statusObj->setDetails($this->sessionArr['intStatusID'], $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes, $intAttachmentIDArr, $deleteAttachmentArr);
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
        
        echo "eee";
        switch($this->typeOfID) {
            case 'status':
                $this->IRSObj->getLastID();
                $historyGUIObj = new StatusHistoryGUI();
                $historyGUIObj->setSession($this->sessionArr);

                $intID = $this->IRSObj->getID();
                if (!empty($intID)) {
                    $this->IRSObj->getDetails();
                    $historyTableArr = $this->IRSObj->historyStatus();
                    $historyGUIObj->display($historyTableArr);
                    $historyGUIObj->displayStatusBottomMenu();
                } else {
                    $this->sessionArr['strPage'] = 'statusadd';
                }
                break;
            case 'risk':
                $historyGUIObj = new RiskHistoryGUI();
                $historyGUIObj->setSession($this->sessionArr);

                $intID = $this->IRSObj->getID();
                if (!empty($intID)) {
                    $this->IRSObj->getDetails();
                    $historyTableArr = $this->IRSObj->historyRisk();

                    $historyGUIObj->display($historyTableArr);
                    //$historyGUIObj->displayRiskBottomMenu();
                } else {
                    //if no history items displays Add form
                    $this->sessionArr['strPage'] = 'riskadd';
                }
                break;
            case 'issue':
                break;
        }

    }
 

    private function displayView() {
        if (!empty($this->sessionArr['int' . $this->ucTypeOfID . 'ID'])) {
            $this->displayViewStatusPart();
        } else {
            $this->sessionArr['int' . $this->ucTypeOfID . 'ID'] = $this->IRSObj->getLastID();
            $this->sessionObj->setDetails($this->sessionArr);
            if (!empty($this->sessionArr['int' . $this->ucTypeOfID . 'ID'])) {
                $this->displayViewPart();
            } else {
                $this->sessionArr['strPage'] = $this->typeOfID . 'add';
            }
        }
    }
    
    private function displayViewPart() {
        $this->IRSObj->setID($this->sessionArr['intStatusID']);
        $this->IRSObj->getDetails();
        $currentMessage = $this->IRSObj->viewStatus();
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        $statusGUIObj->display($currentMessage);
    }
    
    private function displayPDF() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->getDetails();
        $currentStatusMessage = $this->statusObj->viewStatus();
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        $statusGUIObj->displayPDFStatus($currentStatusMessage);
    }
    
    private function displayAddForm() {
        $this->sessionArr['intStatusID'] = null;
        $this->sessionObj->setDetails($this->sessionArr);
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        $statusGUIObj->displayAddForm();
    }
    
    private function displayEditForm() {
        if ($this->sessionArr['intStatusID'] != "") {
            $this->statusObj->setID($this->sessionArr['intStatusID']);
            $statusArr = $this->statusObj->getDetails();
            $this->attachmentObj->setID($this->sessionArr['intStatusID'], 'status');
            $this->attachmentObj->getDetailsFromDB('status');
            $attachmentArr = $this->attachmentObj->getDetails();
            
            $statusGUIObj = new StatusGUI();
            $statusGUIObj->setSession($this->sessionArr);
            $statusGUIObj->displayEditForm($statusArr, $attachmentArr);
        } else {
            die("wrong data in edit form");
        }
    }
    
    private function displayEmailForm() {
        
    }

}

?>
