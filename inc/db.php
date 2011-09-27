<?php

function connectDB() {
    $link = mysql_connect('localhost', 'opadmin', 'Hu3bi9');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db('opadmin');
    return $link;
}

function closeDB($link) {
    mysql_close($link);
}

?>