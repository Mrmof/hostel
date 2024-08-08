<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/user.php';

$identity = htmlspecialchars($_POST['details']);
$password = htmlspecialchars($_POST['password']);

$signin = new User();
$signin->signin($identity, $password);