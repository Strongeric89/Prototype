<?php
if (! ini_get('date.timezone')) {
    date_default_timezone_set('GMT');
}
include ('db/database.php');
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Saprello Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/jquery.js"></script>


  </head>

  <h5 class="my-0 mr-md-auto font-weight-normal"><img src="images/logo.png">Saprello</h5>

  <div class="container">
    <div class="container">
      <body class="text-center">

        <form class="form-signin" action="login.php" method="post">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="username" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
          <p class="mt-5 mb-3 text-muted">Saprello | SAP | Intern Project</p>
        </form>
    </div>

  </div>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  </body>
</html>

<?php
if (isset($_POST['login'])) {
  // checking for correct credentials with prevent sql injections
  $username = mysqli_real_escape_string($mysqli, $_POST['username']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  //sanitize
  $username = sanitize($username);
  $password = sanitize($password);
  $password = md5($password);

  // if an admin is logging in -must contain admin in the email or password
  $selectQueryAdmin = "SELECT * FROM USER WHERE EMAIL = '$username' AND USERPASSWORD = '$password' ";
  $result = $mysqli->query($selectQueryAdmin);
  $check1 = mysqli_num_rows($result);



  if ($check1 == 0) {
      echo "<script>alert('Username or password does not exist. Try Again');</script>";

  } // end if
  else {

      // get the id to begin the session.
      $selectQuery2 = "SELECT USER_ID,NAME, PROFILE_IMG, IS_ADMIN FROM USER WHERE EMAIL = '$username' AND USERPASSWORD = '$password' ";
      $result2 = $mysqli->query($selectQuery2);
      $numResults = mysqli_num_rows($result2);



      if ($numResults != 0) {

        $_SESSION['user_id'] = '';
        $_SESSION['name'] = '';
        $_SESSION['profile_img'] = '';
        $_SESSION['is_admin'] = '';

        //get results from query save as a session
        while ($row = $result2->fetch_assoc()) {
               $_SESSION['name'] = $row['NAME'];
               $_SESSION['user_id'] = $row['USER_ID'];
               $_SESSION['profile_img'] = $row['PROFILE_IMG'];
               $_SESSION['is_admin'] = $row['IS_ADMIN'];
           }


          echo "<script>alert('You have been logged in.');</script>";
          echo "<script>window.open('index.php','_self')</script>";


      }


  } // end else
}//end if isset
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
