<?php

class Status extends IRS {

    function __construct($memberArr, $projectArr, $intSessionID) {
        parent::__construct('status', $memberArr, $projectArr, $intSessionID);
        $this->IRSDAObj = new IRSDA('status');
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
