<?php
  include 'db/database.php';

  $query = $_POST['query'];
    $cardID = $_POST['cardId'];

  $run = $mysqli->query($query);

echo $run;

 ?>
