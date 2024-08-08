<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/hostel.php';

$hostelname = htmlspecialchars($_POST['hostelname']);
$gender = htmlspecialchars($_POST['gender']);

$hostel = new Hostel();
$hostel->createHostel($hostelname, $gender);