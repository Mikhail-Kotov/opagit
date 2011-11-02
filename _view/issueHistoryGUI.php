<?php

class IssueHistoryGUI {
    public function display($sqlArr) {
        $caption = "Issue History";
        if (isset($sqlArr[0])) {
            echo '<table border="1" rules="all" frame="void">';
            echo "<caption>" . $caption . "</caption>\n";
            echo "<tr>\n";
            foreach ($sqlArr[0] as $row => $value) {
                echo "<th>" . $row . "</th>\n";
            }
            echo "</tr>\n";

            foreach ($sqlArr as $arr2) {
                echo "<tr>\n";
                foreach ($arr2 as $row => $value) {
                    echo "<td>";
                    if (isset($value))
                        echo $value; else
                        echo "&nbsp;";
                    echo "</td>\n";
                }
                echo "</tr>\n";
            }
            echo '</table>';
        }
    }
}

?>