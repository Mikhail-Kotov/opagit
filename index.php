<?php
$version = "OPA Team Prototype, version updated 3 October 2011, 5.00 pm";

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
$_ENV['enable_status_delete'] = False;

ob_start();
$_ENV['firephp']->log($_POST, '_POST');

include_once("controller/controller.php");

closeDB($link);
?>
