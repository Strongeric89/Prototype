<?php
$boardId = 0;
  $numofcards1 = 4;
    $numofcards2 = 3;
      $numofcards3 = 12;
      $boardId = $_GET['boardId'];


      include 'db/database.php';
      // $admin = 0;
      // $numofscrums = 0;

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
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <!-- toggle button -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="js/scripts.js">

</script>


    <title>Boards Prototype</title>
  </head>
  <body>

    <!-- View Card Board Modal -->
    <div class="modal fade" id="viewCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Card View ID <input type="text" name="bookId" id="passed" value=""readonly="readonly"/></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form>
              <div class="form-group">

                <label for="cardName">Card Title:

                  AJAX CALL WITH ID HERE

              </label>


              </div>
              <hr>

              <div class="form-group">
                <label for="cardDescription">Card Description:</label>
                <hr>
                  </div>

                  <div class="form-group">
                    <label for="cardDescription">Date Created:</label>
                    <hr>
                      </div>

                      <div class="form-group">
                        <label for="cardDescription">Card Created by:</label>
                        <hr>
                          </div>

              <div class="form-group">
                <label for="cardDescription">Card Catagory:</label>

                  </div>
                  <hr>

                  <div class="form-group">
                    <label for="cardLikeCount">Likes: <?php echo $numofcards3 + 1; ?></label>




                  <?php
                  $d = '<div class="col-xs-3">';
                        for ($x = 0; $x <= $numofcards3; $x++) {


                        $d .= '
                               <a href="#" class="thumbnail">
                                    <img src="images/profiler.png" class="img-responsive" width="30px" height="30px" style="margin:1%;">
                               </a>
                           ';



                        }
                        $d .= ' </div>';

                        echo $d;

                   ?>


                    <button type="button" class="btn btn-lg btn-block btn-outline-primary" onclick="like(this);">LIKE</button>

                      </div>

  </form>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

          </div>
        </div>
      </div>
    </div>



    <!-- new Card Board Modal -->
    <div class="modal fade" id="newCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Create New Card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form>
              <div class="form-group">
                <label for="cardName">Card Title:</label>
                <input type="text" class="form-control"  placeholder="Enter card Title:">

              </div>

              <div class="form-group">
                <label for="cardDescription">Card Description:</label>
                <textarea type="text" class="form-control"  placeholder="Enter Description:"></textarea>
              </div>

              <div class="form-group">
                <label for="cardDescription">Card Catagory:</label>
                <div class="form-group">

                   <select class="form-control" id="cardCatagory">
                     <option>Glad</option>
                     <option>Sad</option>
                     <option>Mad</option>

                   </select>
                 </div>
                  </div>




    <button type="submit" class="btn btn-primary">Create</button>
  </form>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

          </div>
        </div>
      </div>
    </div>


 <div class="container">


  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><img src="images/logo.png">Saprello</h5>
    <nav class="my-2 my-md-0 mr-md-3">
          <img src="images/profiler.png" class="img-circle"  width="20" height="20">
      <a class="p-2 text-dark"  href="index.php">Back to Dashboard</a>
      <a class="p-2 text-dark"  href="logout.php">Sign out</a>

    </nav>

  </div>


  <div class="jumbotron">
    <h1 class="display-4">Board title <?php echo $boardId;?></h1>
    <p class="lead"></p>
    <hr class="my-4">
    <p>Board Description
      ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>

  </div>




    <div class="container">


         <div class="card box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">What did you think....</h4>
            </div>
            <div class="card-body">

              <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#newCardModal">Create New Card</button>

                </div>
          </div>
          <br>
       </div>


</div>



  <div class="container">
  <div class="row">
    <div class="col">
      <div class="card-deck text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Glad  <img src="images/happy.png" width="30" height="30"> </h4>
          </div>
          <div class="card-body"ondrop="drop(event)" ondragover="allowDrop(event)">
            <ul class="list-unstyled mt-3 mb-4">
              <div class="list-group" >
              <?php
              for ($x = 1; $x <= $numofcards2; $x++) {

                $button = '<button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-book-id="' .$boardId . 'Glad' .$x.'"  >View</button>';

                echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card Description</h6>
                      <h6 class="card-subtitle mb-2 text-muted">Date Added</h6>

                      '.$button.'




                    </div>

                  </div>    <br>';


                }

               ?>
            </ul>
          </div>
        </div>

    </div>

    </div>
    <div class="col">
      <div class="card-deck text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Sad  <img src="images/sad.png" width="40" height="30"> </h4>
          </div>
          <div class="card-body" ondrop="drop(event)" ondragover="allowDrop(event)">
            <ul class="list-unstyled mt-3 mb-4">
              <div class="list-group" >
              <?php
                    for ($x = 1; $x <= $numofcards2; $x++) {

                      $button = '<button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-book-id="' .$boardId . 'Sad' .$x.'"  >View</button>';

                      echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                          <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card Description</h6>
                            <h6 class="card-subtitle mb-2 text-muted">Date Added</h6>

                            '.$button.'




                          </div>

                        </div>    <br>';
                        // <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-id="'.$x.'"  >View '.$x.'</button>
                        // <a href="#my_modal" data-toggle="modal" data-book-id="echo $numofcards">Open Modal</a>


                      }

               ?>
            </ul>
          </div>
        </div>

    </div>

    </div>
    <div class="col">
      <div class="card-deck text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Mad <img src="images/angry.jpg" width="30" height="30"></h4>
          </div>
          <div class="card-body" ondrop="drop(event)" ondragover="allowDrop(event)">
            <ul class="list-unstyled mt-3 mb-4">
              <div class="list-group" >
              <?php
              for ($x = 1; $x <= $numofcards3; $x++) {

                $button = '<button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-book-id="' .$boardId . 'Mad' .$x.'"  >View</button>';

                echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <h6 class="card-subtitle mb-2 text-muted">Card Description</h6>
                      <h6 class="card-subtitle mb-2 text-muted">Date Added</h6>

                      '.$button.'




                    </div>

                  </div>    <br>';


                }


               ?>
            </ul>
          </div>
        </div>

    </div>

    </div>
  </div>

  </div>
  <hr>







  <footer class="container-fluid text-center">
      <p class="mt-5 mb-3 text-muted">Saprello | SAP | Intern Project</p>
  </footer>

</div>


</div>

<script type="text/javascript">
$('#viewCardModal').on('show.bs.modal', function(e) {
    var bookId = $(e.relatedTarget).data('book-id');
    $(e.currentTarget).find('input[name="bookId"]').val(bookId);
});

</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<!-- for modals -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>

  <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
    integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
    crossorigin="anonymous"></script>



  </body>
</html>
