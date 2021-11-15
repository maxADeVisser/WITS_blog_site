<?php
  session_start(); // starter en php-session
  require_once "/home/mir/lib/db.php";

  if(!isset($_SESSION['loggedIn'])){ // sørger for, at brugeren indledningsvist IKKE er logget ind
    $_SESSION['loggedIn'] = false; // sessions variable vi bruger til at holde styr på, om der er en bruger logget ind
  }
?>

<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col text-center">

          <h1>Blog Forum</h1>

          <?php
          if (isset($_SESSION['username'])){ // sender brugeren direkte videre, hvis man allerede er logget ind
            header("Location: menu.php");
          }

          if (isset($_POST['user'])){ // hvis et username er angivet
            if(login($_POST['user'], $_POST['password'])){ // OG hvis log ind er vellykket
              $_SESSION['username'] = htmlentities($_POST['user']); // gem det uid en bruger har indtastet i en sessionsvariable
              $_SESSION['loggedIn'] = true; // opdaterer sessionsvariable til at en bruger er logget ind
              header("Location: menu.php"); // send brugeren videre til menuen
            } else {
              echo "<p>No user found, try again or create an new user.</p>"; // Fejlmeddelse om brugeren ikke findes
            }
          }?>

          <form action="login.php" method="POST"> <!-- Login knap -->
            <p><input type="text" name="user" placeholder=Username></p>
            <p><input type="password" name="password" placeholder=Password></p>
            <p><input class="btn btn-success" type="submit" value="Log in"></p>
          </form>

          <form action="addUser.php" method="POST"> <!-- Opretny bruger knap -->
            <p><input class="btn btn-outline-secondary" type="submit" value="Create New User"></p>
          </form>

          <form action="menu.php" method="GET"> <!-- Menu knap -->
            <input class="btn btn-outline-secondary" type="submit" value="Main Menu">
          </form>

        </div>
      </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
