<?php
  include 'db/database.php';
  session_start();
  $query = $_POST['query'];
  //echo $query;

  $title = '';
  $id = 0;
  $description = '';
  $dateCreated = '';
  $createdBy = '';
  $cardCat = '';

  $run = $mysqli->query($query); //returns the cards
  while($row = $run->fetch_array()){
    $id = $row['CARD_ID'];
    $title =  $row['TITLE'];
    $description = $row['DESCRIPTION'];
    $dateCreated = $row['DATE_ADDED'];
    $createdBy = $row['USER_ID'];
    $cardCat = $row['CARD_STATUS'];
    $board = $row['BOARD_ID'];

  }
  //create session for CARDID
  $_SESSION['CARDID'] = $id;
  echo $id . '#'.$title. '#' .$description. '#' .$dateCreated. '#' .$createdBy. '#' .$cardCat. '#' .$board;






 ?>
