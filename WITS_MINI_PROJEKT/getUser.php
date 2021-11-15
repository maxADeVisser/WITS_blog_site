<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
session_start();
require_once "/home/mir/lib/db.php";

$user = get_user($_GET['user_ID']); //returnerer et associative array
htmlentities($user); //undgår html injections

$postIDs_of_user = get_pids_by_uid($user['uid']); //returnerer en liste med ID'er over posts en user har lavet
?>



<!DOCTYPE html>
<html>
<head>
  <title>See a user</title>
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
      <div class="col-10"> <!-- Oprettes en tom 1/12 grid, for at gøre plads til 1/12 logout grid-->
        <?php
        if($user['firstname'] != NULL){ //hvis der er fundet en user, lav en h1 med navn
          echo "<h3 class='text-lg-center'>Posts by </h3><h1 class='text-lg-center'><i>", $user['uid'], "</i> (", $user['firstname'], " ", $user['lastname'], ")"; }
          ?></h1>
        </div>

        <div class="col-1"> <!-- Oprettes en tom 1/12 grid, for at gøre plads til 1/12 logout grid-->
          <!-- knap til log out -->
          <?php if($_SESSION['loggedIn']){ //displayer en login knap hvis ikke man er logget ind ?>
            <p><form action="logout.php">
              <input class="btn btn-danger" type="submit" value="Log out">
            </form></p>
          <?php } ?>
        </div>

        <div class="col text-center">

          <!-- Denne blok laver en liste af en users post, hvis de har nogen -->
          <?php
          if ($postIDs_of_user != NULL){ //hvis en user har oprettet posts
            foreach ($postIDs_of_user as $postID) {
              $post_ID = get_post($postID)['pid'];
              $post_title = get_post($post_ID)['title'];
              echo "<p><a href='verifyInput.php?blog_ID=$post_ID'> $post_title</a></p>"; //laver links der fører brugeren videre til verifyInput
            }
          } else { //hvis en bruger ikke har nogen posts
            echo "User has no posts";
          }
          ?>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
  </html>
