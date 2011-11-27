<?php

class statusController {

    private $statusObj, $attachmentObj;
    private $sessionArr, $sessionObj;
    private $memberArr, $projectArr;

    public function __construct($memberArr, $projectArr, $sessionArr) {
        $this->sessionObj = new Session();
        $this->sessionArr = $sessionArr; // don't need to getDetails from Session Class, because we are already got SessionArr from Controller
        $this->memberArr = $memberArr;
        $this->projectArr = $projectArr;
        
        $this->statusObj = new Status($this->memberArr, $this->projectArr, $this->sessionArr['intSessionID']);
        $this->attachmentObj = new Attachment();
    }

    public function main() {
        if ($this->sessionArr['strPage'] == "status") {
            if ($this->sessionArr['strTodo'] != "") {
                switch ($this->sessionArr['strTodo']) {
                    case "add":
                        $this->todoAddStatus();
                        $this->sessionArr['strPage'] = "statusview";
                        break;
                    case "edit":
                        $this->todoEditStatus();
                        $this->sessionArr['strPage'] = "statusview";
                        break;
                    case "delete":
                        $this->todoDeleteStatus();
                        $this->sessionArr['strPage'] = "statushistory";
                        break;
                    case "email":
                        $this->todoEMailStatus();
                        $this->sessionArr['strPage'] = "statusview";
                        break;
                }
            } else {
                $this->sessionArr['strPage'] = "statushistory"; // if user choose Status from Menu
            }
        }
        
        switch($this->sessionArr['strPage']) {            
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

    private function todoDeleteStatus() {
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->delDetails();

        $this->sessionArr['intStatusID'] = null;
        $this->sessionObj->setDetails($this->sessionArr);
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
    
    private function todoEMailStatus() {
        echo "EMAIL";
        $this->statusObj->setID($this->sessionArr['intStatusID']);
        $this->statusObj->getDetails();
        $currentStatusMessage = $this->statusObj->viewStatus();
        $this->statusObj->emailStatus($currentStatusMessage);
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
            $this->attachmentObj->setID($this->sessionArr['intStatusID'], "status");
            $this->attachmentObj->getDetailsFromDB("status");
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
