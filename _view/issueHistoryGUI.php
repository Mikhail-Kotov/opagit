<?php

/* * *************************************************************************************
 * Team Name: OPA                                                                       *
 * Date: 30 Nov 2011                                                                    *
 * Version No: 1                                                                        * 																		*
 *                                                                       		*
 * File Name: issueHistoryGUI.php                                                        *
 * Desc:This file displays the issue History GUI                                         * 
 * ************************************************************************************* */

class IssueHistoryGUI {

    private $sessionArr;

    public function __construct() {
        
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }

    //Display the table on History page
    public function display($issueHistoryTableArr) {
        $caption = "Issue History";
        if (isset($issueHistoryTableArr[1])) {
            echo '<table class="standard" cellspacing="0">';
            echo "<caption>" . $issueHistoryTableArr[0]['caption'] . "</caption>\n";
            echo "<tr>\n";
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
            echo "</tr>\n";

//add alternate background colors
            $oddOrEven = "historyodd";
            //View Button
            foreach ($issueHistoryTableArr[1] as $issueArr) {
                echo "<tr>\n";
                echo '<td class="' . $oddOrEven . '">' . "\n";
                echo '<form method="post" action="">';
                echo '<input type="hidden" name="page" value="issueview" />' . "\n";
                echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                echo '<input type="hidden" name="i" value="' . $issueArr['intIssueID'] . '" />' . "\n";
                echo '<input type="submit" value="View" title="View current Issue" class="button" />' . "\n";
                echo "</form>\n";
                echo "</td>\n";
//echo different grey on each line
                foreach ($issueArr as $columnName => $value) {
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
                echo '<input type="hidden" name="page" value="issuepdf" />' . "\n";
                echo '<input type="hidden" name="intSessionID" value="' . $this->sessionArr['intSessionID'] . '" />' . "\n";
                echo '<input type="hidden" name="i" value="' . $issueArr["intIssueID"] . '" />' . "\n";
                echo '<input type="submit" value="PDF" title="PDF current Issue" class="button" />' . "\n";
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

//Display Bottom Menu
    public function displayIssueBottomMenu() {
        include_once("inc/issueIssueBottomMenu.inc.php");
    }

}

?>