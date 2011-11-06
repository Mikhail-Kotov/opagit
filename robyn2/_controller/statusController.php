<?php
if ($sessionArr['strPage'] == "status") {
    if ($sessionArr['strTodo'] != "") {
        if ($sessionArr['strTodo'] == "add") {
            $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
            $strActualBaseline = $_POST["strActualBaseline"];
            $strPlanBaseline = $_POST["strPlanBaseline"];
            $strStatusVariation = $_POST["strStatusVariation"];
            $strStatusNotes = $_POST["strStatusNotes"];
            
            $isNextAttachment = true;
            $i = 0;
            do {
                $strAttachmentLinkArr[$i] = $_POST["strAttachmentLink".$i];
                $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment".$i];
                
                if(isset($_POST["strAttachmentLink".($i+1)])) {
                    $i++;
                } else {
                    $isNextAttachment = false;
                }
            } while($isNextAttachment == true);
            
            $statusObj->addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, 
                    $strStatusVariation, $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr);
        }
        
        if ($sessionArr['strTodo'] == "delete") {
            $statusObj->delDetails($sessionArr['intStatusID']);
        }
        
        if ($sessionArr['strTodo'] == "edit") {
            $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
            $strActualBaseline = $_POST['strActualBaseline'];
            $strPlanBaseline = $_POST['strPlanBaseline'];
            $strStatusVariation = $_POST['strStatusVariation'];
            $strStatusNotes = $_POST['strStatusNotes'];
            
            $isNextAttachment = true;
            $i = 0;
            do {
                $intAttachmentIDArr[$i] = $_POST["intAttachmentID".$i];
                $strAttachmentLinkArr[$i] = $_POST["strAttachmentLink".$i];
                $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment".$i];
                
                if(isset($_POST["intAttachmentID".($i+1)])) {
                    $i++;
                } else {
                    $isNextAttachment = false;
                }
            } while($isNextAttachment == true);

            $statusObj->setDetails($sessionArr['intStatusID'], $dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, 
                    $strStatusVariation, $strStatusNotes, $intAttachmentIDArr, $strAttachmentLinkArr, $strAttachmentCommentArr);
        }
    }
    
    $sessionArr['strPage'] = "statushistory";
}

if ($sessionArr['strPage'] == "statushistory") {
    $statusObj->getLastStatusID();
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("_model/status/history.php");
    } else {
        $sessionArr['strPage'] = "statusadd";
    }
}

if ($sessionArr['strPage'] == "statusview") {
    if (!empty($sessionArr['intStatusID'])) {
        $statusObj->setID($sessionArr['intStatusID']);
    } else {
        $statusObj->getLastStatusID();
        $sessionArr['intStatusID'] = $statusObj->getID();
    }

    if(!empty($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("_model/status/view.php");
    } else {
        $sessionArr['strPage'] = "statusadd";
    }
}

if ($sessionArr['strPage'] == "statusadd") {
    $statusObj->displayAddForm();
}

if ($sessionArr['strPage'] == "statusedit") {
    if ($sessionArr['intStatusID'] != "") {
        $statusObj->setID($sessionArr['intStatusID']);
        $statusObj->getDetails();
        $statusObj->displayEditForm();
    } else {
        die("wrong data in edit form");
    }
}
?>
