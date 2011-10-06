<?php
$currentStatusMessage = "<b>Today is:</b> " . $_ENV['currentDate'] . "<br />\n" . 
"<b>Status report as of:</b> " . $this->dmtStatusCurrentDate . "<br />\n" . 
"<b>Status created by:</b> " . $this->memberObj->strMemberFirstName . " " . $this->memberObj->strMemberLastName . "<br />\n" . 
"<b>For Project:</b> " . $this->projectObj->strProjectName . "<br />\n" . 
"<b>Current status is:</b> " . $this->strStatusCondition . "<br /><br />\n" . 
"<b>Actual Baseline:</b><br />" . $this->strStatusDate . "<br /><br />\n" . 
"<b>Plan Baseline:</b><br />" . $this->strStatusActualDate . "<br /><br />\n" . 
"<b>Status Condition:</b><br />" . $this->strStatusCondition . "<br /><br />\n" . 
"<b>Variation:</b><br />\n" . 
$this->strStatusDifference . "<br /><br />\n" . 
"<b>Notes/Reasons:</b><br />\n" . 
$this->strStatusWhy . "<br /><br />\n" . 
'<b>Attachment:</b><br /><a href="' . $this->strStatusGanttLink . '">' . $this->strStatusGanttLink . "</a><br /><br />\n" . 
"<b>Attachment Comment:</b><br />" . $this->strStatusGanttLinkComment . "<br /><br />\n";

//$pdf = new FPDF();
//$pdf->AddPage();
//$pdf->SetFont('Arial','',10);
//$pdf->Cell(40,10,$currentStatusMessage);
//$pdf->Output();


class PDF extends FPDF {

    function Header() {
        global $title;
    }

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function ChapterTitle($num, $label) {
        // Arial 12
        $this->SetFont('Arial', '', 12);
        // Background color
        $this->SetFillColor(200, 220, 255);
        // Title
        $this->Cell(0, 6, $label, 0, 1, 'L', true);
        // Line break
        $this->Ln(4);
    }

    function ChapterBody($file) {
        // Read text file
        $txt = $file;
        // Times 12
        $this->SetFont('Arial', '', 12);
        // Output justified text
        $this->MultiCell(0, 5, $txt);
        // Line break
        $this->Ln();
        // Mention in italics
        $this->SetFont('', 'I');
        $this->Cell(0, 5, '');
    }

    function PrintChapter($num, $title, $file) {
        $this->AddPage();
        $this->ChapterTitle($num, $title);
        $this->ChapterBody($file);
    }

}

$pdf = new PDF();
$title = 'Status #'. $this->getID();
$pdf->SetTitle($title);
$pdf->SetAuthor('OPA');
$pdf->PrintChapter(1,'Status #'. $this->getID() ,strip_tags($currentStatusMessage));
//$pdf->PrintChapter(2,'THE PROS AND CONS','20k_c2.txt');
$pdf->Output();

?>
