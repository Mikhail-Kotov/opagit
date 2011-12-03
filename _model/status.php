<?php

class Status extends IRS {

    function __construct($memberArr, $projectArr, $intSessionID) {
        parent::__construct('status', $memberArr, $projectArr, $intSessionID);
        $this->IRSDAObj = new IRSDA('status');
    }
    
    function setDetails($intStatusID,
            $dmtStatusCurrentDate,
            $strActualBaseline,
            $strPlanBaseline,
            $strStatusVariation,
            $strStatusNotes,
            $intAttachmentIDArr,
            $deleteAttachmentArr) {
        
        $this->IRSArr['intStatusID'] = $intStatusID;
        $this->IRSArr['dmtStatusCurrentDate'] = $dmtStatusCurrentDate;
        $this->IRSArr['strActualBaseline'] = $strActualBaseline;
        $this->IRSArr['strPlanBaseline'] = $strPlanBaseline;
        $this->IRSArr['strStatusVariation'] = $strStatusVariation;
        $this->IRSArr['strStatusNotes'] = $strStatusNotes;
        
        parent::setDetails($intAttachmentIDArr, $deleteAttachmentArr);

    }

    function addDetails($dmtStatusCurrentDate, $strActualBaseline, $strPlanBaseline, $strStatusVariation, 
            $strStatusNotes, $strAttachmentLinkArr, $strAttachmentCommentArr) {

        $this->IRSArr['intStatusID'] = $this->getGlobalLastID() + 1;
        $this->IRSArr['intProjectID'] = $this->projectArr['intProjectID'];
        $this->IRSArr['intProjectMemberID'] = $this->intProjectMemberID;
        $this->IRSArr['dmtStatusCurrentDate'] = $dmtStatusCurrentDate;
        $this->IRSArr['strActualBaseline'] = $strActualBaseline;
        $this->IRSArr['strPlanBaseline'] = $strPlanBaseline;
        $this->IRSArr['strStatusVariation'] = $strStatusVariation;
        $this->IRSArr['strStatusNotes'] = $strStatusNotes;

        parent::addDetails($strAttachmentLinkArr, $strAttachmentCommentArr);
    }


    public function viewStatus() {
        
        // DRAFT (RAW CODE)
        $memberObj = new Member();
        $intMemberID = $memberObj->getMemberID($this->IRSArr['intProjectMemberID']);
        $memberObj->setID($intMemberID);
        $memberArr = $memberObj->getDetails();
        
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

    // email will be moved to another place
    public function emailStatus() {
        // get all members email
        #$to      = '2708337@swin.edu.au';
        #$to = 'Robyn Ius <5651271@student.swin.edu.au>';
        
        $to = '2708337@swin.edu.au';
        
        $subject = 'Status ' . $this->IRSArr['intStatusID'] . ' for ' . $this->projectArr['strProjectName'] . ' project';
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
    
}
?>
