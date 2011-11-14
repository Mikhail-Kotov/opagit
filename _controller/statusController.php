<?php

class statusController {

    private $statusObj;
    private $sessionArr, $sessionObj;

    public function __construct($sessionArr, $statusObj) {
        $this->sessionObj = new Session();
        $this->sessionArr = $sessionArr; // don't need to getDetails from Session Class, because we are already got SessionArr from Controller

        $this->statusObj = $statusObj;
    }

    public function main() {
        if ($this->sessionArr['strPage'] == "status") {
            if ($this->sessionArr['strTodo'] != "") {
                if ($this->sessionArr['strTodo'] == "add") {
                    $this->todoAddStatus();
                }
                if ($this->sessionArr['strTodo'] == "delete") {
                    $this->todoDeleteStatus();
                }
                if ($this->sessionArr['strTodo'] == "edit") {
                    $this->todoEditStatus();
                }
            }

            $this->sessionArr['strPage'] = "statushistory"; // if user choose Status from Menu
        }

        if ($this->sessionArr['strPage'] == "statushistory") {
            $this->displayHistoryStatus();
        }

        if ($this->sessionArr['strPage'] == "statusview") {
            $this->displayViewStatus();
        }

        if ($this->sessionArr['strPage'] == "statusadd") {
            $this->displayAddStatusForm();
        }

        if ($this->sessionArr['strPage'] == "statusedit") {
            $this->displayEditStatusForm();
        }
    }

    private function todoAddStatus() {
        $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
        $strActualBaseline = $_POST["strActualBaseline"];
        $strPlanBaseline = $_POST["strPlanBaseline"];
        $strStatusVariation = $_POST["strStatusVariation"];
        $strStatusNotes = $_POST["strStatusNotes"];

        $isNextAttachment = true;
        $i = 0;
        do {
            $strAttachmentLinkArr[$i] = $_POST["strAttachmentLink" . $i];
            $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment" . $i];

            if (isset($_POST["strAttachmentLink" . ($i + 1)])) {
                $i++;
            } else {
                $isNextAttachment = false;
            }
        } while ($isNextAttachment == true);

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
        if (!empty($this->statusObj->intStatusID)) {
            $this->statusObj->getDetails();
            $this->statusObj->displayStatusHistory();
        } else {
            $this->sessionArr['strPage'] = "statusadd";
        }
    }

    private function displayViewStatus() {
        if (!empty($this->sessionArr['intStatusID'])) {
            $this->statusObj->setID($this->sessionArr['intStatusID']);
            $this->statusObj->getDetails();
            $this->statusObj->displayStatus();
        } else {
            $this->sessionArr['intStatusID'] = $this->statusObj->getLastStatusID();
            $this->sessionObj->setDetails($this->sessionArr);
            if (!empty($this->sessionArr['intStatusID'])) {
                $this->statusObj->setID($this->sessionArr['intStatusID']);
                $this->statusObj->getDetails();
                $this->statusObj->displayStatus();
            } else {
                $this->sessionArr['strPage'] = "statusadd";
            }
        }
    }
    
    private function displayAddStatusForm() {
        $this->sessionArr['intStatusID'] = null;
        $this->sessionObj->setDetails($this->sessionArr);

        $this->statusObj->displayAddForm();
    }
    
    private function displayEditStatusForm() {
        if ($this->sessionArr['intStatusID'] != "") {
            $this->statusObj->setID($this->sessionArr['intStatusID']);
            $this->statusObj->getDetails();
            $this->statusObj->displayEditForm();
        } else {
            die("wrong data in edit form");
        }
    }
    
    private function displayEmailStatusForm() {
        
    }

}

?>
