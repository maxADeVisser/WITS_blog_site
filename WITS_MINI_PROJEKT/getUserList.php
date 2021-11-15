<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
require_once "/home/mir/lib/db.php";
session_start();
$user_list = get_uids();
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
      <div class="col-1">
        <p><form action="menu.php" method="GET">
          <input class="btn btn-outline-secondary" type="submit" value="Main Menu"> <!-- eksikverer getUserList.php -->
        </form></p>
      </div>

      <div class="col-10">
        <h1 class="text-lg-center">List of all users</h1>
      </div>

      <div class="col-1">
        <?php
        if($_SESSION['loggedIn']){ //displayer en login knap hvis ikke man er logget ind
          ?>
          <p><form action="logout.php">
            <input class="btn btn-danger" type="submit" value="Log out">
          </form>
        <?php } else { // og hvis ikke man er logget ind, displayes en login knap ?>
          <p><form action="login.php">
            <input class="btn btn-success" type="submit" value="Log in">
          </form></p>
        <?php } ?>
      </div></p>
    </div>

    <div class="col text-center">
      <?php
      foreach ($user_list as $userID) { // fetcher user path
        $user = get_user($userID); //returnerer et associative array
        echo "<p><a href='getUser.php?user_ID=", $user['uid'], "'><i>", $user['uid'], "</i> (", $user['firstname'], " ", $user['lastname'], ")", "</a></p>";
      }?>


    </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
  </html>
