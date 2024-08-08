<?php 
include $_SERVER['APP'];
include WEB_ROOT.'php/model/config.php';
include WEB_ROOT.'php/model/compliants.php';


$id = $_GET['id'];

$compliants = new Compliants();
$compliants->resolve($id);
