<?php
  include 'db/database.php';
      $boardId = $_GET['boardId'];


      $numofcards3 = 4;


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


      //get board specific info
      $getBoard = "SELECT * FROM board where BOARD_ID =" .$boardId;
      $resultBoard = $mysqli->query($getBoard);

      $boardTitle = '';
      $boardDescription = '';



      while ($row = $resultBoard->fetch_array()) {
          $boardTitle = $row['BOARD_TITLE'];
          $boardDescription = $row['BOARD_DESCRIPTION'];

      }

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
            <h5 class="modal-title" id="exampleModalLongTitle">Card View ID <input type="text" name="bookId" id="passed" value=""readonly="readonly"/> </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">



            <form name="form1" action="boards.php?boardId=<?php echo $boardId;?>" method="get" >
              <div class="form-group">

                <label for="cardName">Card Title:
                  <input type="text" name="cardTitle"  value="" size="50" readonly="readonly"/>
              </label>


              </div>
              <hr>

              <div class="form-group">
                <label for="cardDescription">Card Description:<textarea type="text" name="cardDescription" rows="4" cols="50" value="" readonly="readonly"/></textarea></label>
                <hr>
                  </div>

                  <div class="form-group">
                    <label for="cardDescription">Date Created:<input type="text" name="cardCreated"  value="" readonly="readonly"/></label>
                    <hr>
                      </div>

                      <div class="form-group">
                        <label for="cardDescription">Card Created by: <input type="text" name="cardBy"  value="" readonly="readonly"/></label>
                        <hr>
                          </div>

              <div class="form-group">
                <label for="cardDescription">Card Catagory:<input type="text" name="cardCat"  value="" readonly="readonly"/></label>

                  </div>
                  <hr>

                  <div class="form-group">


                  <?php



                  $d = '<div class="col-xs-3">';
                  //get number of likes for that card
                  $numberofLikesQuery = 'SELECT USER_ID, VOTE_ID FROM votes WHERE CARD_ID = 1'; //MUST BE CHANged - need to pass over CARD_ID
                  $result = $mysqli->query($numberofLikesQuery);
                  $numResults = mysqli_num_rows($result);

                        for ($x = 1; $x <= $numResults; $x++) {

                          //get the profile pic for all people who liked this
                          $row = $result->fetch_array();

                                  $userId = $row['USER_ID'];

                                  $img = "SELECT PROFILE_IMG FROM USER WHERE USER_ID ='" .$userId. "'";
                                  $result2 = $mysqli->query($img);


                                  while( $row2 = $result2->fetch_array()){
                                    $pro = $row2['PROFILE_IMG'];
                                    $d .= '
                                           <a href="'.$pro.'" class="thumbnail">
                                                <img src="'.$pro.'" class="img-responsive" width="30px" height="30px"  style="margin:1%;">
                                           </a>
                                       ';
                                  }

                        }
                        $d .= ' </div>';

                        echo $d;

                   ?>
                       <label for="cardLikeCount">Likes: <?php
                             //display like count
                       echo  $numResults; ?></label>

                   <input type="text" name="likeBtnVal" id="likeBtnVal"  value="" readonly="readonly" hidden="hidden"/>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary" id="likeBtn" name="likeBtn"  value="">LIKE</button>

                      </div>

                      <script type="text/javascript">

                      $('#likeBtn').on('click', function(e){

                        var values = $('#likeBtnVal').val();
                        var v = values.split('#');
                        //alert(v);


                        var q = "INSERT INTO `votes` (`AGREE_COUNT`, `CARD_ID`, `USER_ID`, `BOARD_ID`) VALUES ( 1, "+v[0]+", '"+v[1]+"', "+v[2]+");";
                        alert(q);
                        //create an entry into the votes table
                        $.post('voteOnCard.php', {query: q}, function(data){
                          if(data == 1){
                            $("#likeBtn").html('UNLIKE');

                          }

                        });


                      });

                      </script>

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

            <form class="" action="boards.php?boardId=<?php echo $boardId;?>" method="post">

              <div class="form-group">
                <label for="cardName">Card Title:</label>
                <input type="text" class="form-control"  placeholder="Enter card Title:" name="title" required>

              </div>

              <div class="form-group">
                <label for="cardDescription">Card Description:</label>
                <textarea type="text" class="form-control"  placeholder="Enter Description:" name="description" required></textarea>
              </div>

              <div class="form-group">
                <label for="cardDescription">Card Catagory:</label>
                <div class="form-group">

                   <select class="form-control" id="cardCatagory" name="mgsOption" required>
                     <option value="glad">Glad</option>
                     <option value="sad">Sad</option>
                     <option value="mad">Mad</option>
                   </select>
                 </div>
                  </div>

    <button type="submit" class="btn btn-primary" name="submitNewCard">Create</button>

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
      <img src="<?php
       echo $profiler;?>" class="img-circle"  width="20px" height="20px">
      <a class="p-2 text-dark"  href="index.php">Back to Dashboard</a>
      <a class="btn btn-outline-primary"  href="logout.php">Sign out</a>

    </nav>

  </div>


  <div class="jumbotron">
    <h1 class="display-4">Board: #<?php echo $boardId;?> Title: <?php echo $boardTitle;?></h1>
    <p class="lead"></p>
    <hr class="my-4">
    <p><?php echo $boardDescription;?>  </p>

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




              //get numcards1
              $numberofcards1Q = "SELECT * FROM card where BOARD_ID =" .$boardId. " AND card_status = 'glad'";
              $result = $mysqli->query($numberofcards1Q);
              $numofcards1 = mysqli_num_rows($result);


              $resultCard1 = $mysqli->query($numberofcards1Q); //use result on 3 different boards



              for ($x = 1; $x <= $numofcards1; $x++) {
                $row = $resultCard1->fetch_array();
                $cardId = $row['CARD_ID'];
                $cardTitle = $row['TITLE'];
                $cardDescription = $row['DESCRIPTION'];
                  $cardDateAdded = $row['DATE_ADDED'];
                  $cardCreatedBy = $row['USER_ID'];

                  //get users name
                  $usersName = "SELECT NAME FROM user where USER_ID ='" .$cardCreatedBy. "';";
                  $userNameResult = $mysqli->query($usersName);
                    $r = $userNameResult->fetch_array();
                    $nameforCard = $r['NAME'];






                $button = '<button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-book-id="' .$boardId . ' ' .$cardId.'"  >View</button>';

                if($nameforCard == $name){
                  echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                      <div class="card-body" style="background-color:#dce5f4;">
                        <h5 class="card-title">'.$cardTitle.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDescription.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDateAdded.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$nameforCard.'</h6>

                        '.$button.'

                      </div>

                    </div>    <br>';
                }else{
                  echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                      <div class="card-body">
                        <h5 class="card-title">'.$cardTitle.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDescription.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDateAdded.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$nameforCard.'</h6>

                        '.$button.'

                      </div>

                    </div>    <br>';
                }



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
              //get numcards2
              $numberofcards2Q = "SELECT * FROM card where BOARD_ID =" .$boardId. " AND card_status = 'sad'";
              $result = $mysqli->query($numberofcards2Q);
              $numofcards2 = mysqli_num_rows($result);
              $resultCard2 = $mysqli->query($numberofcards2Q); //use result on 3 different boards



              for ($x = 1; $x <= $numofcards2; $x++) {
                $row = $resultCard2->fetch_array();
                $cardId = $row['CARD_ID'];
                $cardTitle = $row['TITLE'];
                $cardDescription = $row['DESCRIPTION'];
                  $cardDateAdded = $row['DATE_ADDED'];
                  $cardCreatedBy = $row['USER_ID'];

                  //get users name
                  $usersName = "SELECT NAME FROM user where USER_ID ='" .$cardCreatedBy. "';";
                  $userNameResult = $mysqli->query($usersName);
                    $r = $userNameResult->fetch_array();
                    $nameforCard = $r['NAME'];






                $button = '<button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-book-id="' .$boardId . ' ' .$cardId.'"  >View</button>';

                if($nameforCard == $name){
                  echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                      <div class="card-body" style="background-color:#dce5f4;">
                        <h5 class="card-title">'.$cardTitle.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDescription.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDateAdded.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$nameforCard.'</h6>

                        '.$button.'

                      </div>

                    </div>    <br>';
                }else{
                  echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                      <div class="card-body">
                        <h5 class="card-title">'.$cardTitle.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDescription.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDateAdded.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$nameforCard.'</h6>

                        '.$button.'

                      </div>

                    </div>    <br>';
                }

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
              //get numcards3
              $numberofcards3Q = "SELECT * FROM card where BOARD_ID =" .$boardId. " AND card_status = 'mad'";
              $result = $mysqli->query($numberofcards3Q);
              $numofcards3 = mysqli_num_rows($result);
              $resultCard3 = $mysqli->query($numberofcards3Q); //use result on 3 different boards





              for ($x = 1; $x <= $numofcards3; $x++) {
                $row = $resultCard3->fetch_array();
                $cardId = $row['CARD_ID'];
                $cardTitle = $row['TITLE'];
                $cardDescription = $row['DESCRIPTION'];
                  $cardDateAdded = $row['DATE_ADDED'];
                  $cardCreatedBy = $row['USER_ID'];

                  //get users name
                  $usersName = "SELECT NAME FROM user where USER_ID ='" .$cardCreatedBy. "';";
                  $userNameResult = $mysqli->query($usersName);
                    $r = $userNameResult->fetch_array();
                    $nameforCard = $r['NAME'];






                $button = '<button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#viewCardModal" data-book-id="' .$boardId . ' ' .$cardId. ' ' .$user_id. '" id="modalPass"  >View</button>';

                if($nameforCard == $name){
                  echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                      <div class="card-body" style="background-color:#dce5f4;">
                        <h5 class="card-title">'.$cardTitle.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDescription.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDateAdded.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$nameforCard.'</h6>

                        '.$button.'

                      </div>

                    </div>    <br>';
                }else{
                  echo '  <div class="card btn-social" style="margin:0;" draggable="true" ondragstart="drag(event)" id="drag1">
                      <div class="card-body">
                        <h5 class="card-title">'.$cardTitle.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDescription.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$cardDateAdded.'</h6>
                        <h6 class="card-subtitle mb-2 text-muted">'.$nameforCard.'</h6>

                        '.$button.'

                      </div>

                    </div>    <br>';
                }


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

$('#viewCardModal').on('show.bs.modal', function(e){
  //get data from button
  var bookId = $(e.relatedTarget).data('book-id');
  var comps = bookId.split(" ");
  var q = "select * from card where board_id = "+comps[0]+" AND card_id = "+comps[1]+"";



  //post q to getCardDetails
  $.post('getCardDetails.php', {query: q}, function(data){
    //call pass the data to modal here
    var content = data.split("#");
    //alert(content[5]);
    $(e.currentTarget).find('input[name="bookId"]').val(content[0]);
    $(e.currentTarget).find('input[name="cardTitle"]').val(content[1]);
        $(e.currentTarget).find('textarea[name="cardDescription"]').val(content[2]);
            $(e.currentTarget).find('input[name="cardCreated"]').val(content[3]);
                $(e.currentTarget).find('input[name="cardBy"]').val(content[4]);
                    $(e.currentTarget).find('input[name="cardCat"]').val(content[5]);
                      $(e.currentTarget).find('input[name="likeBtnVal"]').val(content[0] + '#' + comps[2] + '#' + comps[0]);
  });


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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  </body>
</html>


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


    echo "<script>window.open('boards.php?boardId=".$boardId."','_self')</script>";
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
