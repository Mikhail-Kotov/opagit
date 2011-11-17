<?php

class StatusHistoryGUI {

    private $sessionArr;

    public function __construct() {
        
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }

    public function display($statusHistoryTableArr) {
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

    public function displayStatusBottomMenu() {
        include_once("inc/statusBottomMenu.inc.php");
    }

}

?>
