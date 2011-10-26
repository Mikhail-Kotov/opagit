<?php
$version = "OPA Team Prototype, version 10.18-0430";

error_reporting(E_ALL);
ini_set('display_errors','On');
require_once('FirePHPCore/FirePHP.class.php');
include_once("fpdf/fpdf.php");
include_once("_model/db.php");
include_once("inc/functions.php");
include_once("_model/member.php");
include_once("_model/project.php");
include_once("_model/status.php");
include_once("_model/risk.php");
include_once("_model/issue.php");
include_once("_model/attachment.php");

// connect to db
$_ENV['db'] = new DB();
$_ENV['db']->connectDB();
 
$_ENV['firephp'] = FirePHP::getInstance(True);
$_ENV['currentDate'] = date("Y-m-d");
$_ENV['engineering mode'] = 1;

ob_start();
$_ENV['firephp']->log($_POST, '_POST');

include_once("_controller/controller.php");

$_ENV['db']->closeDB();
?>
