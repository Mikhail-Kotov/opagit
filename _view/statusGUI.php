<?php

class StatusGUI {

    private $sessionArr, $memberArr, $projectArr;

    public function __construct() {
        
    }

//    public function setSession($sessionArr) {
//        $this->sessionArr = $sessionArr;
//        $memberObj = new Member();
//        $memberObj->setSession($sessionArr);
//        $this->memberArr = $memberObj->getDetails();
//
//        $projectObj = new Project();
//        $projectObj->setSession($sessionArr);
//        $this->projectArr = $projectObj->getDetails();
//    }

//    public function display($currentStatusMessage) {
//        echo $currentStatusMessage;
//
//        echo '<table border="0">';
//        echo '<tr><td><form method="post" action="">';
//        echo "<div>\n";
//        echo '<input type="hidden" name="page" value="statusedit" />' . "\n";
//        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
//        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
//        echo '<input type="submit" value="Edit Status" class="button" />' . "\n";
//        echo "</div>\n";
//        echo '</form></td>';
//        echo '<td><form method="post" action="">';
//        echo "<div>\n";
//        echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
//        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
//        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
//        echo '<input type="submit" value="PDF" class="button" />' . "\n";
//        echo "</div>\n";
//        echo "</form></td><td>";
//        echo '<form method="post" action="">';
//        echo "<div>\n";
//        echo '<input type="hidden" name="page" value="status" />' . "\n";
//        echo '<input type="hidden" name="todo" value="delete" />' . "\n";
//        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
//        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
//        echo '<input type="submit" value="Delete" class="button" />' . "\n";
//        echo "</div>\n";
//        echo "</form></td><td>";
//        echo '<form method="post" action="">';
//        echo "<div>\n";
//        echo '<input type="hidden" name="page" value="status" />' . "\n";
//        echo '<input type="hidden" name="todo" value="email" />' . "\n";
//        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
//        echo '<input type="hidden" name="s" value="' . $this->sessionArr['intStatusID'] . '" />' . "\n";
//        echo '<input type="submit" value="E-Mail" class="button" />' . "\n";
//        echo "</div>\n";
//        echo "</form>\n";
//        echo "</td></tr></table>";
//
//        $this->displayStatusBottomMenu();
//    }
//    
//    public function displayEmailForm() {
//
//    }
    
//    public function displayPDFStatus($currentStatusMessage, $filename = null) {
//        //$pdf = new FPDF();
//        //$pdf->AddPage();
//        //$pdf->SetFont('Arial','',10);
//        //$pdf->Cell(40,10,$currentStatusMessage);
//        //$pdf->Output();
//
//        $pdf = new PDF();
//        $pdf->SetDisplayMode('real', 'default');
//        $title = 'Status #' . $this->sessionArr['intStatusID'];
//        $pdf->SetTitle($title);
//        $pdf->SetAuthor('OPA');
//        $pdf->PrintChapter(1, 'Status #' . $this->sessionArr['intStatusID'], "");
//        $pdf->WriteHTML($currentStatusMessage);
//        
//        if(!empty($filename)) {
//            $pdf->Output($_ENV['temp_dir'] . $filename, 'F');
//        } else {
//            $pdf->Output();
//        }
//        
//    }
    
//    public function displayAddForm() {
//        include_once("inc/statusAddForm.inc.php");
//        $this->displayStatusBottomMenu();
//    }
//    
//    public function displayEditForm($statusArr, $attachmentArr) {
//        include_once("inc/statusEditForm.inc.php");
//    }
//    
//    public function displayStatusBottomMenu() {
//        include_once("inc/statusBottomMenu.inc.php");
//    }
//    
//    private function displayStatusButtons($name, $caption) {
//        include("inc/statusButtons.inc.php");
//    }
}

?>
