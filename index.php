<?php
if (!isset($_SESSION)) session_start();
error_reporting(E_ALL);
ob_start();
ini_set('display_errors', 1);
date_default_timezone_set("Asia/Bangkok");
$FORDER = "/example_v2";
include_once($_SERVER['DOCUMENT_ROOT']."".$FORDER."/htaccess.php");
include_once($_SERVER['DOCUMENT_ROOT']."".$FORDER."/plugin/thaidate/Okvee/Thaidate/Thaidate.php");
include_once($_SERVER['DOCUMENT_ROOT']."".$FORDER."/plugin/thaidate/Okvee/Thaidate/thaidate-functions.php");

$ID = isset($uri_past[2]) ? $uri_past[2] : null;
$_SESSION['ID'] = $ID;
include_once("app/".$LAYOUT.".php");

?>
