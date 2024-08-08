<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/user.php';
include WEB_ROOT.'php/model/allocation.php';

$id = $_GET['id'];
$user_id = $_GET['user_id'];


$allocation = new Allocation();
$allocation->allocate($id, $user_id);