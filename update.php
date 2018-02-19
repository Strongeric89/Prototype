<?php session_start();

$_SESSION['SESS'] = $_POST['lang'];

$_SESSION['SESS'] = $_SESSION['SESS'];


print json_encode(array('message' => $_SESSION['SESS']));

die();


?>
