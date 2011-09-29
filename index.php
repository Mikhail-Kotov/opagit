<?php
$version = "OPA Team Prototype, version updated 30 September 2011, 12.00 am";

error_reporting(E_ALL);
ini_set('display_errors','On');
require_once('FirePHPCore/FirePHP.class.php');
include_once("inc/db.php");
include_once("inc/functions.php");
include_once("classes/member.php");
include_once("classes/project.php");
include_once("classes/status.php");
include_once("classes/risk.php");
include_once("classes/issue.php");

// connect to db
$link = connectDB();
$_ENV['firephp'] = FirePHP::getInstance(true);
$_ENV['currentDate'] = date("Y-m-d");
//$_ENV['enable_status_delete'] = False;
$_ENV['enable_status_delete'] = True;

ob_start();
$_ENV['firephp']->log($_POST, '_POST');

include_once("controller/controller.php");

closeDB($link);
?>
