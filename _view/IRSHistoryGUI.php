<?php

class IRSHistoryGUI {

    private $sessionArr;
    private $typeOfID, $ucTypeOfID, $shortTypeOfID;

    public function __construct($typeOfID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
        $this->shortTypeOfID = substr($this->typeOfID, 0, 1);
        $this->intID = 'int' . $this->ucTypeOfID . 'ID';
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }

    public function display($historyTableArr) {
        if (isset($historyTableArr[1])) {
            echo '<table class="standard" cellspacing="0">';
            echo "<caption>" . $historyTableArr[0]['caption'] . "</caption>\n";
            echo "<tr>\n";
            switch ($this->typeOfID) {
                case 'status':
                    echo "<th>Individual Status</th>\n";
                    echo "<th>ID</th>\n";
                    echo "<th>Member</th>\n";
                    echo "<th>Creation Date</th>\n";
                    echo "<th>Actual Status</th>\n";
                    echo "<th>Planned Baseline</th>\n";
                    echo "<th>Variation</th>\n";
                    echo "<th>Notes/Reasons</th>\n";
                    echo "<th>Attachment</th>\n";
                    echo "<th>Attachment Comment</th>\n";
                    echo "<th>Convert to PDF</th>\n"; // for PDF
                    break;
                case 'risk':
                    echo "<th>View</th>\n";
                    echo "<th>ID</th>\n";
                    echo "<th>Project</th>\n";
                    echo "<th>Raised By</th>\n";
                    echo "<th>Type</th>\n";
                    echo "<th>Description</th>\n";
                    echo "<th>Risk Status</th>\n";
                    echo "<th>Date Created</th>\n";
                    echo "<th>Date Closed</th>\n";
                    echo "<th>Risk Likelihood</th>\n";
                    echo "<th>Impact Description</th>\n";
                    echo "<th>Project Impact Rating</th>\n";
                    echo "<th>Mitigation Strategy</th>\n";
                    echo "<th>Contingency Strategy</th>\n";
                    echo "<th>Assigned To</th>\n";
                    echo "<th>Attachment</th>\n";
                    echo "<th>Attachment Comment</th>\n";
                    echo "<th>Convert To PDF</th>\n"; // for PDF
                    break;
                case 'issue':
                    echo "<th>View</th>\n";
                    echo "<th>ID</th>\n";
                    echo "<th>Project</th>\n";
                    echo "<th>Raised By</th>\n";
                    echo "<th>Issue Status</th>\n";
                    echo "<th>Date Raised</th>\n";
                    echo "<th>Issue Deadline</th>\n";
                    echo "<th>Description</th>\n";
                    echo "<th>Issue Type</th>\n";
                    echo "<th>Issue Priority</th>\n";
                    echo "<th>Assigned To</th>\n";
                    echo "<th>Date Closed</th>\n";
                    echo "<th>Issue Outcome</th>\n";
                    echo "<th>Attachment</th>\n";
                    echo "<th>Attachment Comment</th>\n";
                    echo "<th>Convert To PDF</th>\n"; // for PDF
                    break;
            }
            echo "</tr>\n";

            $oddOrEven = "historyodd";
            foreach ($historyTableArr[1] as $IRSArr) {
                echo "<tr>\n";
                echo '<td class="' . $oddOrEven . '">' . "\n";
                echo '<form method="post" action="" id="event-submission">';
                echo '<input type="hidden" name="page" value="' . $this->typeOfID . 'view" />' . "\n";
                echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                echo '<input type="hidden" name="' . $this->shortTypeOfID . '" value="' . $IRSArr['int' . $this->ucTypeOfID . 'ID'] . '" />' . "\n";
                echo '<input type="submit" value="View" title="View current ' . $this->ucTypeOfID . '" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";

                foreach ($IRSArr as $columnName => $value) {
                    echo '<td class="' . $oddOrEven . '">' . "\n";
                    if (isset($value)) {
                        echo $value;
                    } else {
                        echo "&nbsp;";
                    }
                    echo "</td>\n";
                }

                echo '<td class="' . $oddOrEven . '">' . "\n";
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="page" value="' . $this->typeOfID . 'pdf" />' . "\n";
                echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                echo '<input type="hidden" name="' . $this->shortTypeOfID . '" value="' . $IRSArr['int' . $this->ucTypeOfID . 'ID'] . '" />' . "\n";
                echo '<input type="submit" value="PDF" title="PDF current ' . $this->ucTypeOfID . '" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";
            }

            echo "</tr>\n\n";

            if ($oddOrEven == "historyodd") {
                $oddOrEven = "historyeven";
            } else {
                $oddOrEven = "historyodd";
            }
        }
        echo '</table>';
    }

    public function displayBottomMenu() {
        include_once("inc/bottomMenu.inc.php");
    }

    private function displayButtons($name, $caption) {
        include("inc/buttons.inc.php");
    }

}

?>
