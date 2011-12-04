<?php

class IRSGUI {

    private $sessionArr, $memberArr, $projectArr;
    private $typeOfID, $ucTypeOfID, $shortTypeOfID, $intID;

    public function __construct($typeOfID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
        $this->shortTypeOfID = substr($this->typeOfID, 0, 1);
        $this->intID = 'int' . $this->ucTypeOfID . 'ID';
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
        $memberObj = new Member();
        $memberObj->setSession($sessionArr);
        $this->memberArr = $memberObj->getDetails();

        $projectObj = new Project();
        $projectObj->setSession($sessionArr);
        $this->projectArr = $projectObj->getDetails();
    }

    public function display($currentMessage) {
        echo $currentMessage;

        echo '<table border="0">';
        echo '<tr><td><form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="' . $this->typeOfID . 'edit" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="' . $this->shortTypeOfID . '" value="' . $this->sessionArr['int' . $this->ucTypeOfID . 'ID'] . '" />' . "\n";
        echo '<input type="submit" value="Edit ' . $this->ucTypeOfID . '" class="button" />' . "\n";
        echo "</div>\n";
        echo '</form></td>';
        echo '<td><form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="' . $this->typeOfID . 'pdf" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="' . $this->shortTypeOfID . '" value="' . $this->sessionArr['int' . $this->ucTypeOfID . 'ID'] . '" />' . "\n";
        echo '<input type="submit" value="PDF" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form></td><td>";
        echo '<form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="' . $this->typeOfID . '" />' . "\n";
        echo '<input type="hidden" name="todo" value="delete" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="' . $this->shortTypeOfID . '" value="' . $this->sessionArr['int' . $this->ucTypeOfID . 'ID'] . '" />' . "\n";
        echo '<input type="submit" value="Delete" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form></td><td>";
        echo '<form method="post" action="">';
        echo "<div>\n";
        echo '<input type="hidden" name="page" value="' . $this->typeOfID . '" />' . "\n";
        echo '<input type="hidden" name="todo" value="email" />' . "\n";
        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
        echo '<input type="hidden" name="' . $this->shortTypeOfID . '" value="' . $this->sessionArr['int' . $this->ucTypeOfID . 'ID'] . '" />' . "\n";
        echo '<input type="submit" value="E-Mail" class="button" />' . "\n";
        echo "</div>\n";
        echo "</form>\n";
        echo "</td></tr></table>";

        $this->displayBottomMenu();
    }

    public function displayEmailForm() {
        
    }

    public function displayAddForm() {
        include_once("inc/addForm.inc.php");
        $this->displayBottomMenu();
    }

    public function displayEditForm($IRSArr, $attachmentArr) {
        include_once("inc/editForm.inc.php");
    }

    public function displayBottomMenu() {
        include_once("inc/bottomMenu.inc.php");
    }

    private function displayButtons($name, $caption) {
        include("inc/buttons.inc.php");
    }

    function displayPDF($currentMessage, $filename = null) {
        //$pdf = new FPDF();
        //$pdf->AddPage();
        //$pdf->SetFont('Arial','',10);
        //$pdf->Cell(40,10,$currentStatusMessage);
        //$pdf->Output();

        $pdf = new PDF();
        $pdf->SetDisplayMode('real', 'default');
        $title = 'Status #' . $this->sessionArr[$this->intID];
        $pdf->SetTitle($title);
        $pdf->SetAuthor('OPA');
        $pdf->PrintChapter(1, 'Status #' . $this->sessionArr[$this->intID], "");
        $currentMessage = str_replace('</div></div>', '<br /><br />', $currentMessage);
        $pdf->WriteHTML($currentMessage);

        if (!empty($filename)) {
            $pdf->Output($_ENV['temp_dir'] . $filename, 'F');
        } else {
            $pdf->Output();
        }
    }

}

?>
