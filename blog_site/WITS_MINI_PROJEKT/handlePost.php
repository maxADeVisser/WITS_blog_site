<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->
<!-- Fil der bruges til at håndtering af oprettelsen af et post  -->

<?php
  session_start();
  require_once "/home/mir/lib/db.php";

  // fetch inputs fra createPost.php
  $title = htmlentities($_POST['postTitle']);
  $content = htmlentities($_POST['postContent']);

  $author = $_SESSION['username'];
  $image_included = false; // er initially false fordi udgangspunktet er, at en bruger ikke har uploaded et billede

  // hvis et billede er uploaded sammen med postet
  if($_FILES['image']['name'] != ""){
    $image = $_FILES['image'];
    $image_included = true;

    if($image['type']=="image/png"){ //Reformatere filtype navn så det passer til image-filen
      $image['type']=".png";
    } elseif ($image['type']=="image/jpeg"){
      $image['type']=".jpg";
    }

    $image_ID = add_image($image['tmp_name'], $image['type']); //tilføjer et billede til databasen og returnerer et iid
  }

  $post_ID = add_post($author, $title, $content); //opretter postet, og returnerer et pid for postet

  //hvis et billede er inkluderet, tilføj det til det oprettede post
  if($image_included == true){
    add_attachment($post_ID,$image_ID);
  }

  header("Location: getBlog.php?blog_ID=$post_ID"); //send brugeren videre til postet der lige er oprettet
?>
