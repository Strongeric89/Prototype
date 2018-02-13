<?php
$admin = 1;
$numofscrums = 4;

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

  <!-- Admin Settings Board Modal -->
  <div class="modal fade" id="adminSettingsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Admin Settings</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="boardName">Add new Admin Name:</label>
              <input type="text" class="form-control"  placeholder="Enter name">
              <small id="emailHelp" class="form-text text-muted">Enter New Admin name</small>
            </div>

            <div class="form-group">
              <label for="boardName">Add new Admin Email:</label>
              <input type="email" class="form-control"  placeholder="inumber@sap.com">
              <small id="emailHelp" class="form-text text-muted">Enter Email</small>
            </div>




  <button type="submit" class="btn btn-primary">Create</button>
</form>


<div class="container">
  <h2>Edit / Remove Boards </h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Board Title</th>
        <th>Edit</th>
        <th>Remove</th>
        <th>Hide / Show</th>
      </tr>
    </thead>
    <tbody>
      <?php
            for ($x = 1; $x <= $numofscrums; $x++) {
                echo '  <tr>
                    <td>'.$x.'</td>
                    <td>Scrum '.$x.'</td>
                    <td>    <button type="button" class="btn btn-lg btn-block btn-outline-primary" >Edit</button>
                  </td>
                    <td>  <button type="button" class="btn btn-lg btn-block btn-outline-primary" >Remove</button>
                    </td>

                    <td><input type="checkbox" checked data-toggle="toggle"></td>

                  </tr>
';
            }

       ?>

    </tbody>
  </table>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

        </div>
      </div>
    </div>
  </div>




  <!-- Create new Board Modal -->
  <div class="modal fade" id="createNewBoardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Create New Board</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
  <div class="form-group">
    <label for="boardName">Board Title:</label>
    <input type="text" class="form-control"  placeholder="scrum #x">
    <small id="emailHelp" class="form-text text-muted">Enter title of new Board</small>
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
        <h5 class="my-0 mr-md-auto font-weight-normal">Saprello</h5>
        <nav class="my-2 my-md-0 mr-md-3">
          <?php
            if($admin == 1){
              echo '  <a class="p-2 text-dark" href="AdminSettings.php">Admin Settings</a>';
            }
           ?>

          <a class="p-2 text-dark" href="EditProfile.php">Edit Profile</a>
          <a class="p-2 text-dark" href="BoardSettings.php">Board Settings</a>

        </nav>
        <a class="btn btn-outline-primary" href="login.php">Sign out</a>
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






<div class="container">
  <div class="row">





      <?php
        if($admin == 1){
            echo '    <div class="col-sm">
                  <div class="card box-shadow">
                     <div class="card-header">
                       <h4 class="my-0 font-weight-normal">New</h4>
                     </div>
                     <div class="card-body">
                       <h1 class="card-title pricing-card-title"></h1>
                       <ul class="list-unstyled mt-3 mb-4">

                       </ul>
                       <!-- send with an id to display the correct board -->
                  <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target="#createNewBoardModal">Create a new Board</button>

                         </div>
                   </div>
                   <br>
                </div>
              ';
        }

        for ($x = 1; $x <= $numofscrums; $x++) {
            echo '    <div class="col-sm">
                  <div class="card box-shadow">
                     <div class="card-header">
                       <h4 class="my-0 font-weight-normal">Scrum '.$x.'</h4>
                     </div>
                     <div class="card-body">
                       <h1 class="card-title pricing-card-title"></h1>
                       <ul class="list-unstyled mt-3 mb-4">

                       </ul>
                       <!-- send with an id to display the correct board -->
                       <a href="boards.php"> <button type="button" class="btn btn-lg btn-block btn-outline-primary">Board Settings</button>
                   </a>
                         </div>
                   </div>
                   <br>
                </div>';
  }

       ?>

  </div>
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
