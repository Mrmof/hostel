<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/hostel.php';

$roomNo = htmlspecialchars($_POST['roomNo']);
$hostelId = htmlspecialchars($_POST['hostelId']);

$hostel = new Hostel();
$hostel->createHostelSpace($roomNo, $hostelId);