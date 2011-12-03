<?php 
 /***************************************************************************************
 * Team Name: OPA                                                                       *
 * Date: 2 Dec 2011                                                                    *
 * Version No: 2                                                                        * 																		*
 *                                                                       		*
 * File Name: riskHistoryGUI.php                                                        *
 * Desc:This file displays the risk History GUI                                         * 
 ***************************************************************************************/

class RiskHistoryGUI {

    private $sessionArr;

    public function __construct() {
        
    }

    public function setSession($sessionArr) {
        $this->sessionArr = $sessionArr;
    }

    //Display the table on History page
    public function display($riskHistoryTableArr) {
        $caption = "Risk History";
        if (isset($riskHistoryTableArr[1])) {
            echo '<table class="standard" cellspacing="0">';
            echo "<caption>" . $riskHistoryTableArr[0]['caption'] . "</caption>\n";
            echo "<tr>\n";
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
            foreach ($riskHistoryTableArr[1] as $riskArr) {
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
    public function displayRiskBottomMenu() {
        include_once("inc/riskBottomMenu.inc.php");
    }

}

?>
