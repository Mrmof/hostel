<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/compliants.php';

$fullname = htmlspecialchars($_POST['fullname']);
$roomNo = htmlspecialchars($_POST['roomNo']);
$message = htmlspecialchars($_POST['message']);

$user_id = $_SESSION['userid'];

$compliants = new Compliants();
$compliants->message($fullname, $roomNo, $message, $user_id);
