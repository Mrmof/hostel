<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/application.php';

$fullname = htmlspecialchars($_POST['fullname']);
$matNo = htmlspecialchars($_POST['matNo']);
$department = htmlspecialchars($_POST['department']);
$level = htmlspecialchars($_POST['level']);
$schoolFees = $_FILES['schoolFees'];
$hostelFees = $_FILES['hostelFees'];
$user_id = $_SESSION['userid'];

$application = new Application();
$application->hostelApplication($fullname, $matNo, $department, $level, $schoolFees, $hostelFees, $user_id);
