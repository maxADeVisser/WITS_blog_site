<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
session_start();
require_once "/home/mir/lib/db.php";
$post = get_post($_GET['blog_ID']); //Returnerer et associative array repræsentation af et post
$commentsID_on_post = get_cids_by_pid($post['pid']); //Returnerer et array af id'ere for alle kommentarer på indlæg $pid
$user = get_user($post['uid']); // returnerer forfatteren af et post som et associative array
$imagesID_on_post = get_iids_by_pid($post['pid']); //Returnerer et array af id'ere for alle billeder vedhæftet til indlæg $pid.
?>

<!DOCTYPE html>
<html>
<head>
  <title>See a blog post</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-1">
        <p><form action="menu.php" method="GET">
          <input class="btn btn-outline-secondary " type="submit" value="Main Menu"> <!-- eksikverer getUserList.php -->
        </form></p>
      </div>

      <div class="col-10">
        <h1 class="text-lg-center"><?php echo $post['title']; ?></h1>
      </div>

      <div class="col-1">
        <?php
        if($_SESSION['loggedIn']){ //displayer en logud knap hvis ikke man er logget ind
          ?>
          <p><form action="logout.php">
            <input class="btn btn-danger" type="submit" value="Log out">
          </form></p>
        <?php } else { // og hvis ikke man er logget ind, displayes en login knap ?>
          <p><form action="login.php">
            <input class="btn btn-success" type="submit" value="Log in">
          </form></p>
        <?php } ?>
      </div>

      <div class="col text-center">
        <div class="col-md-6 offset-3">
          <h4><?php



          if(!is_numeric($_GET['blog_ID'])){
            echo "Posts can't contain letters";

          } else if($post == NULL){
            echo "Post doesn't exist";
          }

          if($user != NULL){ // tjekker om der er en user
            echo "by <a href='getUser.php?user_ID=", $user['uid'], "'>", $user['firstname'], " ", $user['lastname'], "</a>";
          }

          ?></h4>

          <p><?php
          echo "<p>", $post['content'], "</p>"; //det her er dumt fix det senere - det gør så vi ikke kan displaye hvad vi skriver, men bare echo al teksten på samme linje.
          ?></p>




          <p><?php //DISPLAY IMAGES
          if($imagesID_on_post != NULL){
            echo "<h4>Images related to this post</h4>";

            foreach ($imagesID_on_post as $imageID) { // fetcher image paths for et post
              $image_path = get_image($imageID)['path']; //sætter stien til hvert billede
              echo "<img src='$image_path' width='500' height='500'>"; // viser billederne
            }
          }?>

          <p><?php if($user['uid'] == $_SESSION['username']){ ?>
            <form action="editPost.php" method="GET">
              <input class="btn btn-primary btn" type="submit" value="Edit post">
              <input type='hidden' name='blog_ID' value='<?php echo $post['pid']; ?>'>
            </form>
          <?php } ?></p>

          <p><?php //COMMENTS SECTION
          if($commentsID_on_post != NULL){
            echo "<h4>Comments</h4>";
          }

          //DISPLAYER ALLE KOMMENTARER
          foreach ($commentsID_on_post as $commentID) {
            $com = get_comment($commentID); //returnerer et associative array
            echo "<a href='getUser.php?user_ID=", $com['uid'], "'>", $com['uid'], "</a>: ", $com['content'], "<br><i><u>", $com['date'],"</u></i>";

            if($com['uid'] == $_SESSION['username'] || ($user['uid'] == $_SESSION['username'])){ // tjekker om brugeren ?>
              <form action="deleteComment.php" method="GET">
                <input class="btn btn-outline-danger btn-sm py-0" style="font-size: 0.7em;" type="submit" value="X">
                <input type='hidden' name='commentID' value='<?php echo $com['cid']; ?>'>
                <input type='hidden' name='postID' value='<?php echo $post['pid']; ?>'>
              </form>
              <?php echo "<br>";
            } else {
              echo "<br><br>"; // ┌∩┐(◣_◢)┌∩┐ //
            }
          }?>


            <?php
            if($_SESSION['loggedIn']){ //displayer en logud knap hvis ikke man er logget ind
              ?>
              <div class="col-md-6 offset-3">

                <form action="addComment.php" method="GET">
                  <!-- <p><textarea name="comment" rows="3" cols="40" placeholder="Add a public comment..."></textarea></p> -->
                  <p><input class="form-control" type="text" name="comment" placeholder="Add a public comment..."></p>
                  <input class="btn btn-outline-success" type="submit" name="add_comment" value="Comment">
                  <input type='hidden' name='postID' value='<?php echo $post['pid']; ?>'>
                  <input type='hidden' name='userID' value='<?php echo $user['uid']; ?>'>
                </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
  </html>
