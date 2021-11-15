<?php
// https://wits.ruc.dk/~ssrohr/WITS_AFLEVERING_3/login.php
session_start(); // starter en php session
require_once "/home/mir/lib/db.php";

if(!isset($_SESSION['loggedIn'])){
  $_SESSION['loggedIn'] = false;
}
?>

<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
  <div class="container">


    <h1 class="text-lg-center">Blog Forum</h1>

    <?php
    if (isset($_SESSION['username'])){ // vi tjekker om en bruger allerede er logget ind
      header("Location: menu.php");
    }

    if (isset($_POST['user'])){
      $_SESSION['username'] = $_POST['user']; // gemmer det uid der er i den igangværende session
      if(login($_POST['user'], $_POST['password'])){
        $_SESSION['loggedIn'] = true;
        header("Location: menu.php");
      } else {
        echo "No user found, try again or create an new user";
        session_unset(); //nulstiller sessions variabler
      }
    }
    ?>
    <div class="row">
      <div class="col text-center">
        <form action="login.php" method="POST">
          <p><input type="text" name="user" placeholder=Username></p>   <!-- Kan sættes til "user" -->
          <p><input type="password" name="password" placeholder=Password></p>  <!-- Kan sættes til "user" -->
          <p><input class="btn btn-success" type="submit" value="Log in"></p>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col text-center">
        <form action="addUser.php" method="POST">
          <p><input class="btn btn-outline-secondary" type="submit" value="Create New User"></p>
        </form>
      </div>
    </div>


    <div class="row">
      <div class="col text-center">
        <form action="menu.php" method="GET">
          <input class="btn btn-outline-secondary" type="submit" value="Main Menu"> <!-- eksikverer getUserList.php -->
        </form>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
