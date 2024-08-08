<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/application.php';

$id = $_GET['id'];


$application = new Application();
$application->approveapplication($id);