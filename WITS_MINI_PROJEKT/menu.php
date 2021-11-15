<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->
<?php
session_start();
require_once "/home/mir/lib/db.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Opretter en style vi bruger til hovedmenuen. NY: er det her ikke en gammel kommentar? -->
</head>

<body>
  <div class="container"> <!-- er nødvendigt for at kunne bruge Bootstrap, og alt indhold skal være i containeren -->
    <div class="row">
      <div class="col-1"> <!-- Oprettes en tom 1/12 grid, for at gøre plads til 1/12 logout grid-->
      </div>
      <div class="col-10">


      <h1 class="text-lg-center">Main Menu</h1>
      </div>
      <div class="col-1">
      <?php
      if($_SESSION['loggedIn'] == false){ //displayer en login knap hvis ikke man er logget ind
        ?>

        <p><form action="login.php">
          <input class="btn btn-success" type="submit" value="Log in">
        </form></p>
      <?php } else { ?>
        <p><form action="logout.php">
          <input class="btn btn-danger" type="submit" value="Log out">
        </form></p>
      <?php } ?>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-2"></div> <!-- for at det hele bliver rykket mere til højre -->
      <div class="col-2">
        <form action="verifyInput.php" method="GET">
          <p><input class="form-control" type="text" name="blog_ID" placeholder="Post"></p>
        </div>

        <div class="col-2">
          <p>
            <select class="form-select" name='users_ID' value="USER ID">
              <option value="none" hidden>User</option>
              <?php
              $user_list = get_uids(); //returnerer et array af uids
              foreach ($user_list as $userID){ // vi fetcher alle uid's og smider dem i en dropdown menu
                echo "<option value='$userID'> $userID </option>";
              }
              ?>
            </p>
          </select>
        </div>

        <div class="col-2">
          <input class="btn btn-primary" type="submit" value="Go">
        </div>
      </form>
    </div>


    <div class="row">
      <div class="col text-center">

        <p><form action="getUserList.php" method="GET">
          <input class="btn btn-outline-secondary" type="submit" value="List of users"> <!-- eksikverer getUserList.php -->
        </form></p>
      </div>
    </div>

    <?php
    if($_SESSION['loggedIn']){ //displayer en "See my posts"-knap hvis man er logget ind
      ?>
      <form action="getUser.php?user_ID=<?php echo $_SESSION['username']?>" method="post">
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
          <p><input class="btn btn-outline-secondary" type="submit" value="Create new post"></p> <!-- eksikverer getUserList.php -->
        </form>
      </div>
    </div>
  </div> <!-- høre til Bootstrap containeren -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
