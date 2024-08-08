<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/hostel.php';

$id = $_GET['id'];


$hostel = new Hostel();
$hostel->deletehostel($id);