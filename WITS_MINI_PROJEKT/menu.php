<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->
<?php
  session_start(); // starter session
  require_once "/home/mir/lib/db.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  </head>

  <body>
    <div class="container"> <!-- er nødvendigt for at kunne bruge Bootstrap, og alt indhold skal være i containeren -->
      <div class="row"> <!-- opretter et row -->
        <div class="col-1"></div> <!-- Oprettes en tom 1/12 grid, for at gøre plads til 1/12 logout grid -->

        <div class="col-10">
        <h1 class="text-lg-center">Main Menu</h1>
        </div>

        <div class="col-1"> <!-- Displayer login/logout knap oppe i højre hjørne -->
        <?php
        if($_SESSION['loggedIn'] == false){?> <!-- displayer enten login eller logud knap, alt efter om man er logget ind eller ej -->
          <p><form action="login.php">
            <input class="btn btn-success" type="submit" value="Log in">
          </form></p>
        <?php } else { ?>
          <p><form action="logout.php">
            <input class="btn btn-danger" type="submit" value="Log out">
          </form></p>
        <?php } ?>
        </div>

      </div> <!-- Lukker row class -->

      <div class="row justify-content-center">
        <div class="col-2"></div> <!-- for at det hele bliver rykket mere til højre -->
        <div class="col-2">
          <form action="verifyInput.php" method="GET">
            <p><input class="form-control" type="text" name="blog_ID" placeholder="Post"></p>
        </div>

          <div class="col-2">
              <p><select class="form-select" name='users_ID' value="USER ID"> <!-- dropdown menu med uid's -->
                <option value="none" hidden>User</option>
                <?php
                  $user_list = get_uids(); //returnerer et array af uids
                  foreach ($user_list as $userID){ // vi fetcher alle uid's og smider dem i en dropdown menu
                    echo "<option value='$userID'> $userID </option>";
                  }?>
            </select></p>
          </div>
          <div class="col-2">
            <input class="btn btn-primary" type="submit" value="Go"> <!-- submit knap til form -->
          </div>
        </form>

      </div> <!-- Lukke tag til row -->

      <div class="row">
        <div class="col text-center">
          <p><form action="getUserList.php" method="GET"> <!-- knap til at eksikverer getUserList.php -->
            <input class="btn btn-outline-secondary" type="submit" value="List of users">
          </form></p>
        </div>
      </div>

      <?php
        //displayer en "See my posts"-knap hvis man er logget ind
        if($_SESSION['loggedIn']){ ?>
          <form action="getUser.php?user_ID=<?php echo $_SESSION['username']?>" method="post"> <!-- eksikverer getUser.php med username-sessionsvariablen -->
            <div class="row">
              <div class="col text-center">
                <p><button type="submit" class="btn btn-outline-secondary">See my posts</button></p>
              </div>
            </div>
          </form>
      <?php } ?>


      <div class="row">
        <div class="col text-center">
          <form action="createPost.php" method="GET">
            <p><input class="btn btn-outline-secondary" type="submit" value="Create new post"></p> <!-- knap der eksikverer createPost.php -->
          </form>
        </div>
      </div>

    </div> <!-- lukketag til Bootstrap containeren -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
