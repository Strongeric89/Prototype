
<?php
if(isset($_POST['submitNewCard'])){
  $cTitle = sanitize($_POST['title']);
  $cDescription = sanitize($_POST['description']);
  $date = date("Y-m-d");
  $status = sanitize($_POST['mgsOption']);



  // insert with prepared statement
  // prepared statement - insert
  $query3 = "INSERT INTO card (DATE_ADDED,TITLE,DESCRIPTION,CARD_STATUS,BOARD_ID,USER_ID) VALUES (?,?,?,?,?,?); ";
  $stmt = $mysqli->prepare($query3);
  $stmt->bind_param("ssssss", $date,$cTitle,$cDescription,$status,$boardId,$user_id);
  $stmt->execute();
  print $stmt->error;
  $stmt->close();
  if ($stmt != 0) {
      echo '
         <script>alert("A new card has been created");</script>
       ';
       //AJAX Call HERE

    //echo "<script>window.open('boards.php?".$boardId."','_self')</script>";
  } else {
      echo '
       <script>alert("Something went wrong!");</script>
     ';
  }

}






function sanitize($str)
{
    // clear white space
    $str = trim($str);
    // strip any slashes to preven sql injection
    $str = stripslashes($str);
    // prevent crosssite scripting
    $str = htmlspecialchars($str);
    return $str;
}


 ?>
