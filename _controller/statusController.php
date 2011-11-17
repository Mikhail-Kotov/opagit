<?php

class statusController {

    private $statusObj, $attachmentObj;
    private $sessionArr, $sessionObj;

    public function __construct($memberArr, $projectArr, $sessionArr) {
        $this->sessionObj = new Session();
        $this->sessionArr = $sessionArr; // don't need to getDetails from Session Class, because we are already got SessionArr from Controller

        
        $this->statusObj = new Status($memberArr, $projectArr, $sessionArr['intSessionID']);
        $this->attachmentObj = new Attachment();
    }

    public function main() {
        switch($this->sessionArr['strPage']) {
            case "status":
                if ($this->sessionArr['strTodo'] != "") {
                    switch ($this->sessionArr['strTodo']) {
                        case "add":
                            $this->todoAddStatus();
                            break;
                        case "edit":
                            $this->todoEditStatus();
                            break;
                        case "delete":
                            $this->todoDeleteStatus();
                            break;
                    }
                }
                
                $this->sessionArr['strPage'] = "statushistory"; // if user choose Status from Menu
            
           case "statushistory":
               $this->displayHistoryStatus();
               break;
           
           case "statusview":
               $this->displayViewStatus();
               break;
           
           case "statuspdf":
               $this->displayPDFStatus();
               break;
           
           case "statusadd":
               $this->displayAddStatusForm();
               break;
           
           case "statusedit":
               $this->displayEditStatusForm();
               break;
        }
    }

    private function todoAddStatus() {
        $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
        $strActualBaseline = $_POST["strActualBaseline"];
        $strPlanBaseline = $_POST["strPlanBaseline"];
        $strStatusVariation = $_POST["strStatusVariation"];
        $strStatusNotes = $_POST["strStatusNotes"];
        
        $strAttachmentLinkArr = array();
        $strAttachmentCommentArr = array();
        
        $i = 0;
        while (isset($_FILES['strAttachmentLink' . ($i)])) {
            $target = $_ENV['uploads_dir'] . basename($_FILES['strAttachmentLink' . $i]['name']);
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

        $this->sessionArr['strPage'] = "statusview";
    }

    private function todoDeleteStatus() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->delDetails();

        $this->sessionArr['intStatusID'] = null;
        $this->sessionObj->setDetails($this->sessionArr);

        $this->sessionArr['strPage'] = "statushistory";
    }

    private function todoEditStatus() {
        $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
        $strActualBaseline = $_POST['strActualBaseline'];
        $strPlanBaseline = $_POST['strPlanBaseline'];
        $strStatusVariation = $_POST['strStatusVariation'];
        $strStatusNotes = $_POST['strStatusNotes'];

        $isNextAttachment = true;
        $i = 0;
        do {
            $intAttachmentIDArr[$i] = $_POST["intAttachmentID" . $i];
            $strAttachmentLinkArr[$i] = $_POST["strAttachmentLink" . $i];
            $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment" . $i];

            if (isset($_POST["intAttachmentID" . ($i + 1)])) {
                $i++;
            } else {
                $isNextAttachment = false;
            }
        } while ($isNextAttachment == true);

        $this->statusObj->setDetails($this->sessionArr['intStatusID'], $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes, $intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr);

        $this->sessionArr['strPage'] = "statusview";
    }
    
    private function displayHistoryStatus() {
        $this->statusObj->getLastStatusID();
        $statusHistoryGUIObj = new StatusHistoryGUI();
        $statusHistoryGUIObj->setSession($this->sessionArr);
                
        if (!empty($this->statusObj->intStatusID)) {
            $this->statusObj->getDetails();
            $historyTableArr = $this->statusObj->historyStatus();
            $statusHistoryGUIObj->display($historyTableArr);
            $statusHistoryGUIObj->displayStatusBottomMenu();
        } else {
            $this->sessionArr['strPage'] = "statusadd";
        }
    }

    private function displayViewStatus() {
        if (!empty($this->sessionArr['intStatusID'])) {
            $this->displayViewStatusPart();
        } else {
            $this->sessionArr['intStatusID'] = $this->statusObj->getLastStatusID();
            $this->sessionObj->setDetails($this->sessionArr);
            if (!empty($this->sessionArr['intStatusID'])) {
                $this->displayViewStatusPart();
            } else {
                $this->sessionArr['strPage'] = "statusadd";
            }
        }
    }
    
    private function displayViewStatusPart() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->getDetails();
        $currentStatusMessage = $this->statusObj->viewStatus();
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        $statusGUIObj->display($currentStatusMessage);
    }
    
    private function displayPDFStatus() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->getDetails();
        $currentStatusMessage = $this->statusObj->viewStatus();
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        $statusGUIObj->displayPDFStatus($currentStatusMessage);
    }
    
    private function displayAddStatusForm() {
        $this->sessionArr['intStatusID'] = null;
        $this->sessionObj->setDetails($this->sessionArr);
        
        $statusGUIObj = new StatusGUI();
        $statusGUIObj->setSession($this->sessionArr);
        $statusGUIObj->displayAddForm();
    }
    
    private function displayEditStatusForm() {
        if ($this->sessionArr['intStatusID'] != "") {
            $this->statusObj->setID($this->sessionArr['intStatusID']);
            $statusArr = $this->statusObj->getDetails();
            $this->attachmentObj->setStatusID($this->sessionArr['intStatusID']);
            $this->attachmentObj->getDetailsFromDB();
            $attachmentArr = $this->attachmentObj->getDetails();
            
            $statusGUIObj = new StatusGUI();
            $statusGUIObj->setSession($this->sessionArr);
            $statusGUIObj->displayEditForm($statusArr, $attachmentArr);
        } else {
            die("wrong data in edit form");
        }
    }
    
    private function displayEmailStatusForm() {
        
    }

}

?>
