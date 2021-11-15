<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
  require_once "/home/mir/lib/db.php";
  session_start();
  $postID = $_GET['blog_ID'];
  $userID = $_GET['user_ID'];
  $post = get_post($postID);
  $images = get_iids_by_pid($postID); // returnerer et array af alle billeder vedhæftet indlægget
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Edit a Post</title>
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

        <!-- edit post funktionalitet -->
        <div class="col-10">
          <h1 class="text-lg-center">Edit post</h1>
          <div class="col text-center">
              <div class="col-md-6 offset-3">
                <!-- Edit post form -->
                <form action="updatePost.php" method="GET">
                  <label for="title"><h3>Title</h3></label>
                  <p><input id="title" type='text' name='postTitle' value='<?php echo htmlentities($post['title']);?>' class="form-control"></p>

                  <label for="content"><h3>Content</h3></label>
                  <p><textarea id="content" class="form-control" name='postContent' rows="7"> <?php echo htmlentities($post['content']); ?> </textarea></p>

                  <input type='hidden' name='postID' value='<?php echo $post['pid']; ?>'>

                  <?php //displayer billeder der høre til indlægget (hvis der er nogle)
                  if($images != NULL){
                    foreach ($images as $imageID) { // fetcher image paths for et post
                      $image_path = get_image($imageID)['path']; //sætter stien til hvert billede
                      echo "<p><img src='$image_path' class='img-fluid' width='700'></p>"; //viser billedet
                    }
                  }?>

                  <!-- Display knap af knapper -->
                  <div class="row">
                    <!-- Display knap "View post" -->
                    <div class="col">
                      <form action="getBlog.php" method="GET">
                        <input class="btn btn-primary" type="submit" value="View post">
                        <input type='hidden' name='blog_ID' value='<?php echo $post['pid']; ?>'>
                      </form>
                    </div>

                    <!-- Display knap "Delete image", hvis der er et billede tilhørende postet -->
                    <?php if($images != NULL){ ?>
                    <div class="col">
                      <form action="delete_attachment.php" method="GET">
                        <input type="hidden" name="iid" value="<?php echo $images[0]; ?>">
                        <input type='hidden' name='pid' value='<?php echo $post['pid'];?>'>
                        <input class="btn btn-danger" type="submit" value="Delete image">
                      </form>
                    </div>
                    <?php } ?>

                    <!-- Display submit-knap "Update post" -->
                    <div class="col">
                      <p><input class="btn btn-primary" type="submit" value="Update post"></p>
                    </div>

                  </div> <!-- Slut tag for display af knapper -->
                </form> <!-- slut edit post form -->

              </div>
            </div>
          </div> <!-- lukke tag for edit post functionality -->

          <!-- formateret så knappen sidder i højre hjørne -->
          <div class="col-1">
            <p><form action="logout.php">
              <input class="btn btn-danger" type="submit" value="Log out">
            </form></p>
          </div>

        </div> <!-- lukke tag for row -->
      </div> <!-- lukke tag for container slut -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
