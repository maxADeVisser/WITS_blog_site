<?php
  require_once "/home/mir/lib/db.php";
  session_start();

  if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['password'])){
    add_user($_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['password']);
    if(login($_POST['username'], $_POST['password']) == true){
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['loggedIn'] = true;
      header("Location: menu.php");
    }
  }
 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Create New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h1>Create new user</h1>
          <div class="col-md-2 offset-5">
            <p><h5>Fill out all fields</h5></p>
            <p><form action="addUser.php" method="POST">
              <p><input class="form-control" type="text" placeholder="Username" name="username"></p>
              <p><input class="form-control" type="text" placeholder="First name" name="firstname"></p>
              <p><input class="form-control" type="text" placeholder="Last name" name="lastname"></p>
              <p><input class="form-control" type="password" placeholder="Password" name="password"></p>
              <p><input class="btn btn-success" type="submit" value="Create User"></p>
            </form></p>

            <form action="menu.php" method="GET">
              <input class="btn btn-outline-secondary" type="submit" value="Main Menu">
            </form>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
