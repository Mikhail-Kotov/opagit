<?php
$week = new DateTime('2009-10-13');
$weekActual = new DateTime('2009-10-13');
$interval = $weekActual->diff($week);
$dateDiff = intval($interval->format('%r%a'));
var_dump($dateDiff);
?>