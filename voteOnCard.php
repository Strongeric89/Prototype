<?php
  include 'db/database.php';

  $query = $_POST['query'];

  $run = $mysqli->query($query);


  echo $run;


 ?>
