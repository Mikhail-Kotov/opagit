<?php
if ($page == "status") {
    if ($todo != "") {
        if ($todo == "add") {
            $dmtStatusCurrentDate = $_POST["dmtStatusCurrentDate"];
            $strActualBaseline = $_POST["strActualBaseline"];
            $strPlanBaseline = $_POST["strPlanBaseline"];
            $strStatusDifference = $_POST["strStatusDifference"];
            $strStatusWhy = $_POST["strStatusWhy"];
            
            $isNextAttachment = true;
            $i = 0;
            do {
                $strAttachmentLink[$i] = $_POST["strAttachmentLink".$i];
                $strAttachmentComment[$i] = $_POST["strAttachmentComment".$i];
                
                if(isset($_POST["strAttachmentLink".($i+1)])) {
                    $i++;
                } else {
                    $isNextAttachment = false;
                }
            } while($isNextAttachment == true);
            
            $statusObj->addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, 
                    $strStatusDifference, $strStatusWhy, $strAttachmentLink, $strAttachmentComment);
        }
        
        if ($todo == "delete") {
            $statusObj->delDetails($currentStatusID);
        }
        
        if ($todo == "edit") {
            $dmtStatusCurrentDate = $_POST['dmtStatusCurrentDate'];
            $strActualBaseline = $_POST['strActualBaseline'];
            $strPlanBaseline = $_POST['strPlanBaseline'];
            $strStatusDifference = $_POST['strStatusDifference'];
            $strStatusWhy = $_POST['strStatusWhy'];
            
            $isNextAttachment = true;
            $i = 0;
            do {
                $intAttachmentID[$i] = $_POST["intAttachmentID".$i];
                $strAttachmentLink[$i] = $_POST["strAttachmentLink".$i];
                $strAttachmentComment[$i] = $_POST["strAttachmentComment".$i];
                
                if(isset($_POST["intAttachmentID".($i+1)])) {
                    $i++;
                } else {
                    $isNextAttachment = false;
                }
            } while($isNextAttachment == true);

            $statusObj->setDetails($currentStatusID, $dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, 
                    $strStatusDifference, $strStatusWhy, $intAttachmentID, $strAttachmentLink, $strAttachmentComment);
        }
    }
    
    $page = "statushistory";
}

if ($page == "statushistory") {
    $statusObj->getLastStatusID();
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("model/status/history.php");
    } else {
        $page = "statusadd";
    }
}

if ($page == "statusview") {
    if ($currentStatusID != "") {
        $statusObj->setID($currentStatusID);
    } else {
        $statusObj->getLastStatusID();
    }
    if(isset($statusObj->intStatusID)) {
        $statusObj->getDetails();
        include_once("model/status/view.php");
    } else {
        $page = "statusadd";
    }
}

if ($page == "statusadd") {
    $statusObj->displayAddForm();
}

if ($page == "statusedit") {
    if ($currentStatusID != "") {
        $statusObj->setID($currentStatusID);
        $statusObj->getDetails();
        $statusObj->displayEditForm();
    } else {
        die("wrong data in edit form");
    }
}
?>
