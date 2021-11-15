<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->
<?php
session_start();
require_once "/home/mir/lib/db.php";
if($_SESSION['loggedIn'] == false){ //hvis man ikke er logget ind, bliver med sendt til login-siden
  header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Create a new post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-1">
        <p><form action="menu.php" method="GET">
          <input class="btn btn-outline-secondary" type="submit" value="Main Menu">
        </form></p>
      </div>

      <div class="col-10">
        <h1 class="text-lg-center">Create a new post</h1>
      </div>

      <div class="col-1">
        <?php
        if($_SESSION['loggedIn']){ //displayer en login knap hvis ikke man er logget ind
          ?>
          <p><form action="logout.php">
            <input class="btn btn-danger" type="submit" value="Log out">
          </form></p>
        <?php } ?>

      </div>
    </div>


    <div class="col text-center">
      <div class="col-md-6 offset-3">
        <form action="handlePost.php" method="POST" enctype='multipart/form-data'>
          <div class="form-group">
            <label for="title"><h3>Title</h3></label>
            <p><input id="title" class="form-control" type='text' name='postTitle' maxlength="25" placeholder="Title"></p>

            <label for="content"><h3>Content</h3></label>
            <p><textarea id="content" class="form-control" name='postContent' rows="10" cols="50" placeholder="Write content here"> </textarea></p>

            <label for="image"><h3>Attach Image</h3></label>
            <p><input class="form-control" type="file" name="image"></p>

            <p><input class="btn btn-success" type="submit" value"Create post"></p>

          </div>
        </form>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
