<?php
include 'db/database.php';


if(isset($_SESSION['user_id'])){
    echo "<script>window.open('index.php','_self')</script>";
}

$ID = 0;
session_start();
if (! isset($_SESSION['user_id'])) {
    $ID = -1;
} // end if
if ($ID == -1) {
    echo "<script>alert('You do not have permission to view this. Please Log in. You have been logged out!')</script>";
    session_destroy();
    echo "<script>window.open('login.php','_self')</script>";
}
//locally used
$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];
$profiler = $_SESSION['profile_img'];
$admin =  $_SESSION['is_admin'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Saprello - Prototype</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- toggle button -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</head>
<body>


  <div class="container">


      <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal"><img src="images/logo.png">Saprello</h5>
        <nav class="my-2 my-md-0 mr-md-3">

          <img src="<?php
           echo $profiler;?>" class="img-circle"  width="20px" height="20px">


          <a class="p-2 text-dark" href="index.php">Back to Control</a>

        </nav>
        <a class="btn btn-outline-primary" href="logout.php">Sign out</a>
      </div>

      <div class="jumbotron">
        <div class="container text-center">
          <h1>Saprello - Project Management by SAP</h1>
          <?php
            if($admin == 1){
              echo '<h1>ADMIN VIEW</h1>';
            }else{
              echo '  <h1>USER VIEW</h1>';
            }
           ?>


        </div>
      </div>

<hr>






<div class="container" align="center">

  <div class="col-lg-4" align="center">

            <img class="rounded-circle" src="<?php
             echo $profiler;?>" alt="Generic placeholder image" width="140" height="140">
            <h2><?php echo $name; ?></h2>
            <h2><?php echo $user_id; ?></h2>
          </div>
          <hr>
  <form class="" action="EditProfile.php"  method="post">


    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="pass1" required>

      </div>
      <div class="form-group col-md-4">
        <label for="inputPassword4">Confirm Password</label>
        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="pass2" required>
      </div>

      <div class="form-group col-md-2">
    <label for="inputPassword4">Update</label>
      <button type="submit" class="btn btn-primary" name="submit">Update Password</button>
    </div>
    </div>

    <hr>

      <form class="" action="EditProfile.php" enctype="multipart/form-data" method="post">

        <div class="form-row">
        <div class="form-group col-md-4">
          <label for="inputPassword4">Update Profile Picture</label>
            </div>

          <div class="form-group col-md-4">

            <input id="formElements" name="c_image" type="file" required />

          </div>
          <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary" name="submitImage">Update Profile Image</button>

            </div>

      </div>

      </form>



    <?php

      if(isset($_POST['submit'])){

              $pass1 = sanitize($_POST['pass1']);
              $pass2 = sanitize($_POST['pass2']);

              if ($pass1 == $pass2) {

                  $temp = $pass1;

                  $pass1 = md5($pass1);
                  $update9 = "UPDATE `user` SET `USERPASSWORD`= '$pass1' WHERE USER_ID ='$user_id' ";
                  $result9 = $mysqli->query($update9);



               if ($result9 == 0) {
                      $msg = "error when reseting password: ";
                      echo "<script>alert('$msg');</script>";
                      echo "<script>window.open('index.php','_self')</script>";
                  } else {
                      $msg = "password reset to : " . $temp;
                      echo "<script>alert('$msg');</script>";
                      echo "<script>window.open('index.php','_self')</script>";
                  }
              } else {
                  echo "<script>alert('the passwords must be the same');</script>";
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
  </form>
</div>

<hr>


    <footer class="container-fluid text-center">
        <p class="mt-5 mb-3 text-muted">Saprello | SAP | Intern Project</p>
    </footer>

  </div>

  <!-- for modals -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
      integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
      crossorigin="anonymous"></script>

    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
      integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
      crossorigin="anonymous"></script>



  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>
</html>
