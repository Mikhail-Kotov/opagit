<?php

class IRS {
    //private $IRSDAObj;
    protected $attachmentObj;
    protected $intSessionID;
    protected $memberArr, $projectArr;
    protected $intID;
    protected $intProjectMemberID;
    private $typeOfID;
    protected $IRSArr;

    function __construct($typeOfID, $memberArr, $projectArr, $intSessionID) {
        $this->typeOfID = $typeOfID;
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
        if(isset($this->intID)) {
            $intID =  $this->intID;
        }
        
        return $intID;
    }
    
    function setID($intID) {
        $this->intID = $intID;
    }
    
    function getDetails() {
        $this->IRSArr = $this->IRSDAObj->getDetails($this->intID);
        
        $this->attachmentObj->setID($this->intID, $this->typeOfID);
        $this->attachmentObj->getDetailsFromDB();
        
        return $this->IRSArr;
    }
    
    function getLastID() {
        $intID = $this->IRSDAObj->getLastID($this->projectArr['intProjectID']);
       
        if(!empty($intID)) {
            $this->intID = $intID;
        } else {
            unset($this->intID);
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
    
    function setDetails($intStatusID, // <- refactor this!!!
            $dmtStatusCurrentDate,
            $strActualBaseline,
            $strPlanBaseline,
            $strStatusVariation,
            $strStatusNotes,
            $intAttachmentIDArr,
            $deleteAttachmentArr) {
        
        $this->statusDAObj->setDetails($intStatusID, $this->projectArr['intProjectID'], $this->intProjectMemberID, $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes);
        
        $this->attachmentObj->setID($intStatusID, "status");
        $this->attachmentObj->delIndividualDetails($deleteAttachmentArr);
    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
            $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr) {

        $nextStatusID = $this->getGlobalLastStatusID() + 1;
        
        $this->statusDAObj->addDetails($nextStatusID, $this->projectArr['intProjectID'], $this->intProjectMemberID, $dmtStatusCurrentDate, $strActualBaseline, 
                $strPlanBaseline, $strStatusVariation, $strStatusNotes);

        $this->attachmentObj->setID($nextStatusID, "status");
        $this->attachmentObj->addDetails($strAttachmentLinkArr, $strAttachmentCommentArr);
    }

    function delDetails() {
        $this->statusDAObj->delDetails($this->intStatusID);
        
        $this->attachmentObj->setID($this->intStatusID, "status");
        $this->attachmentObj->delDetails();
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

        $this->attachmentObj->setID($this->getID(), "status");

        $this->attachmentObj->getDetailsFromDB("status");
        $attachmentArr = $this->attachmentObj->getDetails();
        if ($attachmentArr != null) {
            foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {      // don't using this value here
                // so to change 'foreach' to something else???
                // don't know better php construction (Mikhail)
                $currentStatusMessage .= '<b>Attachment:</b><br /><a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] . 
                        $this->projectArr['strProjectName'] . '/' . $this->dmtStatusCurrentDate . '/' . $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
                        $attachmentArr['strAttachmentLinkArr'][$id] . "</a><br /><br />" .
                        "<b>Attachment Comment:</b><br />" . $attachmentArr['strAttachmentCommentArr'][$id] . "<br /><br />";
            }
        }

        //$_ENV['firephp']->log($attachmentArr, 'attachmentArray');
        return $currentStatusMessage;

    }

    public function emailStatus() {
        // get all members email
        #$to      = '2708337@swin.edu.au';
        #$to = 'Robyn Ius <5651271@student.swin.edu.au>';
        
        $to = '2708337@swin.edu.au';
        
        $subject = 'Status ' . $this->intStatusID. ' for ' . $this->projectArr['strProjectName'] . ' project';
//        $headers = 'From: 2708337@student.swin.edu.au' . "\r\n" .
//        'Reply-To: 2708337@student.swin.edu.au' . "\r\n" .
//        'X-Mailer: PHP/' . phpversion();

        //mail($to, $subject, $message, $headers);
        $files = array();
        $files[0] = $_ENV['temp_dir'] . "status.pdf";
        
        $sendermail = '2708337@student.swin.edu.au';
        $mailerror = $this->multi_attach_mail($to, $sendermail, $subject, $files);
        echo "###MAILERROR=" . $mailerror . "###";

    }
    
    function multi_attach_mail($to, $sendermail, $subject, $files) {
        // email fields: to, from, subject, and so on
        $from = "Files attach <" . $sendermail . ">";
        $message = date("Y.m.d H:i:s") . "\n" . count($files) . " attachments";
        $headers = "From: $from";

        // boundary
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

        // headers for attachment
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // multipart boundary
        $message = "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";

        // preparing attachments
        for ($i = 0; $i < count($files); $i++) {
            if (is_file($files[$i])) {
                $message .= "--{$mime_boundary}\n";
                $fp = @fopen($files[$i], "rb");
                $data = @fread($fp, filesize($files[$i]));
                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"" . basename($files[$i]) . "\"\n" .
                        "Content-Description: " . basename($files[$i]) . "\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"" . basename($files[$i]) . "\"; size=" . filesize($files[$i]) . ";\n" .
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }
        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $sendermail;
        $ok = @mail($to, $subject, $message, $headers, $returnpath);
        if ($ok) {
            return $i;
        } else {
            return 0;
        }
    }

    public function historyStatus() {
        $sqlArr = $this->statusDAObj->getAll($this->projectArr['intProjectID']);

        $memberObj = new Member();

        foreach ($sqlArr as $intStatusID => $statusArr) {
            foreach ($statusArr as $columnName => $value) {
                switch ($columnName) {
                    case "intProjectMemberID":
                        $intMemberID = $memberObj->getMemberID($value);
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

            $this->attachmentObj->setID($tableArr[$intStatusID]["intStatusID"], "status");
            $this->attachmentObj->getDetailsFromDB();

            $tableArr[$intStatusID]["strAttachmentLinkArr"] = "";
            $tableArr[$intStatusID]["strAttachmentCommentArr"] = "";

            $attachmentArr = $this->attachmentObj->getDetails();
            if ($attachmentArr != null) {
                foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) { // not using $value2 anywhere
                    $tableArr[$intStatusID]["strAttachmentLinkArr"] .= '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
                            $this->projectArr['strProjectName'] . '/' . $statusArr['dmtStatusCurrentDate'] . '/' .
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
