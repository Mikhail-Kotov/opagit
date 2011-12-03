<?php

class IRSHistoryGUI {

    private $sessionArr;
    private $typeOfID, $ucTypeOfID;

    public function __construct($typeOfID) {
        $this->typeOfID = $typeOfID;
        $this->ucTypeOfID = ucfirst($this->typeOfID);
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }

    public function displayOld($statusHistoryTableArr) {
        if (isset($statusHistoryTableArr[1])) {
            echo '<table class="standard" cellspacing="0">';
            echo "<caption>" . $statusHistoryTableArr[0]['caption'] . "</caption>\n";
            echo "<tr>\n";
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
            echo "</tr>\n";

            $oddOrEven = "historyodd";
            foreach ($statusHistoryTableArr[1] as $statusArr) {
                echo "<tr>\n";
                echo '<td class="' . $oddOrEven . '">' . "\n";
                echo '<form method="post" action="" id="event-submission">';
                echo '<input type="hidden" name="page" value="statusview" />' . "\n";
                echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                echo '<input type="hidden" name="s" value="' . $statusArr['intStatusID'] . '" />' . "\n";
                echo '<input type="submit" value="View" title="View current Status" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";

                foreach ($statusArr as $columnName => $value) {
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
                echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
                echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                echo '<input type="hidden" name="s" value="' . $statusArr["intStatusID"] . '" />' . "\n";
                echo '<input type="submit" value="PDF" title="PDF current Status" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";
                echo "</tr>\n\n";

                if ($oddOrEven == "historyodd") {
                    $oddOrEven = "historyeven";
                } else {
                    $oddOrEven = "historyodd";
                }
            }
            echo '</table>';
        }
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
                    echo "</tr>\n";

                    $oddOrEven = "historyodd";
                    foreach ($statusHistoryTableArr[1] as $statusArr) {
                        echo "<tr>\n";
                        echo '<td class="' . $oddOrEven . '">' . "\n";
                        echo '<form method="post" action="" id="event-submission">';
                        echo '<input type="hidden" name="page" value="statusview" />' . "\n";
                        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                        echo '<input type="hidden" name="s" value="' . $statusArr['intStatusID'] . '" />' . "\n";
                        echo '<input type="submit" value="View" title="View current Status" class="button" />' . "\n";
                        echo "</form>\n";
                        echo "</td>\n";

                        foreach ($statusArr as $columnName => $value) {
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
                        echo '<input type="hidden" name="page" value="statuspdf" />' . "\n";
                        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                        echo '<input type="hidden" name="s" value="' . $statusArr["intStatusID"] . '" />' . "\n";
                        echo '<input type="submit" value="PDF" title="PDF current Status" class="button" />' . "\n";
                        echo "</form>\n";
                        echo "</td>\n";
                    }
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
                    echo "</tr>\n";

//add alternate background colors
                    $oddOrEven = "historyodd";
//View Button
                    foreach ($historyTableArr[1] as $riskArr) {
                        echo "<tr>\n";
                        echo '<td class="' . $oddOrEven . '">' . "\n";
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="page" value="riskview" />' . "\n";
                        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                        echo '<input type="hidden" name="r" value="' . $riskArr['intRiskID'] . '" />' . "\n";
                        echo '<input type="submit" value="View" title="View current Risk" class="button" />' . "\n";
                        echo "</form>\n";
                        echo "</td>\n";
//echo different grey on each line
                        foreach ($riskArr as $columnName => $value) {
                            echo '<td class="' . $oddOrEven . '">' . "\n";
                            if (isset($value)) {
                                echo $value;
                            } else {
                                echo "&nbsp;";
                            }
                            echo "</td>\n";
                        }
//PDF Button
                        echo '<td class="' . $oddOrEven . '">' . "\n";
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="page" value="riskpdf" />' . "\n";
                        echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                        echo '<input type="hidden" name="r" value="' . $riskArr["intRiskID"] . '" />' . "\n";
                        echo '<input type="submit" value="PDF" title="PDF current Risk" class="button" />' . "\n";
                        echo "</form>\n";
                        echo "</td>\n";
                    }
                    break;

                case 'issue':
                    break;
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

    public function displayStatusBottomMenu() {
        include_once("inc/statusBottomMenu.inc.php");
    }

    private function displayStatusButtons($name, $caption) {
        include("inc/statusButtons.inc.php");
    }

}

?>
