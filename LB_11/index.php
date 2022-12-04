<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once('./config.php');
require_once('controllers/MainController.php');
$controller =new MainController([$db_servername, $db_username, $db_password, $db_name],[$mailserver,$maillogin,$mailpassword]);
$controller->process();
