<?php

function getArr($query) {
    $sql = mysql_query($query);
    if (!$sql) {
        die('Invalid query: ' . mysql_error());
    }

    while ($arr[] = mysql_fetch_array($sql, MYSQL_ASSOC));
    unset($arr[(count($arr) - 1)]);
    return $arr;
}

function echoTable($query, $caption = NULL) {
    if ($caption == NULL)
        $caption = $query;
    $sqlArr = getArr($query);
    if (isset($sqlArr[0])) {
        echo '<table border="1">';
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

function getProjectMember($intMemberID, $intProjectID) {
    $query = "SELECT intProjectMemberID FROM tblProjectMember WHERE " .
            "intMemberID = " . $intMemberID .
            " AND intProjectID = " . $intProjectID . ";";
    $sqlArr = getArr($query);

    $intProjectMemberID = $sqlArr[0]['intProjectMemberID'];
    return $intProjectMemberID;
}

function getMember_from_tblProjectMember($intProjectID, $intProjectMemberID) {
    $query = "SELECT intMemberID FROM tblProjectMember WHERE " .
            "intProjectMemberID = " . $intProjectMemberID .
            " AND intProjectID = " . $intProjectID . ";";
    $sqlArr = getArr($query);

    $intMemberID = $sqlArr[0]['intMemberID'];
    return $intMemberID;
}

function restoreDB() {
    
}

function dateDayDiff($date1, $date2) {
//    PHP >= 5.3
//    $date1Obj = new DateTime($date1);
//    $date2Obj = new DateTime($date2);
//    $interval = $date2Obj->diff($date1Obj);
//    $days_diff = intval($interval->format('%r%a'));

    
//  PHP < 5.3 (need to check bugs)
    $day = 60 * 60 * 24;

    $date1 = strtotime($date1);
    $date2 = strtotime($date2);

    $days_diff = round(($date2 - $date1) / $day); // Unix time difference devided by 1 day to get total days in between    
    return $days_diff;
}

function displayButton($name, $caption, $currentMemberID, $currentProjectID) {
    echo '<form method="post">';
    echo '<input type="hidden" name="page" value="'.$name.'" />' . "\n";
    echo '<input type="hidden" name="m" value="' . $currentMemberID . '" />' . "\n";
    echo '<input type="hidden" name="p" value="' . $currentProjectID . '" />' . "\n";
    echo '<input type="submit" value="' . $caption . '" />' . "\n";
    echo '</form>';
}

?>
