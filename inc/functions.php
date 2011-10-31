<?php

function echoTable($query, $caption = NULL) {
    if ($caption == NULL)
        $caption = $query;
    $sqlArr = $_ENV['db']->query($query);
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

function displayButtonOld($name, $caption, $currentProjectID, $currentMemberID) {
    echo '<form method="post">';
    echo '<input type="hidden" name="page" value="'.$name.'" />' . "\n";
    echo '<input type="hidden" name="p" value="' . $currentProjectID . '" />' . "\n";
    echo '<input type="hidden" name="m" value="' . $currentMemberID . '" />' . "\n";
    echo '<input type="submit" value="' . $caption . '" class="button" />' . "\n";
    echo '</form>';
}

function displayButtonNew($name, $caption, $intSessionID) {
    echo '<form method="post">';
    echo '<input type="hidden" name="page" value="' . $name . '" />' . "\n";
    echo '<input type="hidden" name="intSessionID" value="' . $intSessionID . '" />' . "\n";
    echo '<input type="submit" value="' . $caption . '" class="button" />' . "\n";
    echo '</form>';
}

function getMemberName($intMemberID) {
    if (isset($intMemberID)) {
        if ($intMemberID != "") {
            $query = "SELECT strMemberName FROM tblMember WHERE intMemberID = " . $intMemberID . ";";

            $sqlArr = $_ENV['db']->query($query);

            if (isset($sqlArr[0])) {
                $returnValue = $sqlArr[0]['strMemberName'];
            } else {
                $returnValue = null;
            }
        } else {
            $returnValue = null;
        }
    } else {
        $returnValue = null;
    }

    return $returnValue;
}

function getProjects($intMemberID) {
    $query = "SELECT p.intProjectID,p.strProjectName FROM tblProject as p, tblMember AS m, tblProjectMember AS pm " . "
            WHERE p.intProjectID = pm.intProjectID AND m.intMemberID = pm.intMemberID AND m.intMemberID=" . $intMemberID . ";";

    $sqlArr = $_ENV['db']->query($query);
    return $sqlArr;
}


?>
