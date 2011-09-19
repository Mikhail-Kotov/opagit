<?php
include_once("../inc/functions.php");
$link = connectDB();

$query = 'SELECT * FROM tblUser;';
echoTable($query);

closeDB($link)
?>
