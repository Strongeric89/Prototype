<?php
ob_start();
$host = "localhost";
$db_name = "Saprello";
$user = "root";
$password = ""; // for xamp login
$mysqli = new mysqli($host, $user, $password, $db_name);


if (mysqli_connect_errno())
{
    echo "failed to connect";
    die();
}else{
  echo "db connected!";
}


 ?>