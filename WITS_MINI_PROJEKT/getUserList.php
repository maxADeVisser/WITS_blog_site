<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
  require_once "/home/mir/lib/db.php";
  session_start();
  $user_list = get_uids(); // Returnerer et array af alle bruger-id'ere
?>

<!DOCTYPE html>
<html>
  <head>
    <title>List of users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>
    <div class="container">
      <div class="row">

        <!-- display menu knap -->
        <div class="col-1">
          <p><form action="menu.php" method="GET">
            <input class="btn btn-outline-secondary" type="submit" value="Main Menu"> <!-- eksikverer getUserList.php -->
          </form></p>
        </div>

        <!-- display titel på side, og liste af brugere som links til deres "profiler" -->
        <div class="col-10">
          <div class="col text-center">
            <p><h1>List of all users</h1></p>
            <!-- dislay liste af brugere med links til deres "profiler" -->
            <?php
            foreach ($user_list as $userID) { // fetcher user path
              $user = get_user($userID); //returnerer et associative array
              echo "<p><a href='getUser.php?user_ID=", htmlentities($user['uid']), "'><i>", htmlentities($user['uid']), "</i> (", htmlentities($user['firstname']), " ", htmlentities($user['lastname']), ")", "</a></p>";
            }?>
          </div>
        </div>

        <!-- display logout/login knap -->
        <div class="col-1">
          <?php
          if($_SESSION['loggedIn']){?>
            <p><form action="logout.php">
              <input class="btn btn-danger" type="submit" value="Log out">
            </form></p>
          <?php } else { ?>
            <p><form action="login.php">
              <input class="btn btn-success" type="submit" value="Log in">
            </form></p>
          <?php } ?>
        </div>



      </div> <!--slut tag for row -->
    </div> <!-- slut tag for container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
