<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
session_start();
require_once "/home/mir/lib/db.php";

$title = $_POST['postTitle'];
$content = $_POST['postContent'];
$author = $_SESSION['username'];
$image_included = false; // er initially false fordi udgangspunktet er, at en bruger ikke har uploaded et billede

if($_FILES['image']['name'] != ""){ // hvis et billede er uploaded sammen med postet
  $image = $_FILES['image'];
  $image_included = true;

  if($image['type']=="image/png"){ // skuffende if-statement vi har været nødt til at bruge fordi fil-typen returneres som noget vi ikke kan bruge. Derfor reformateringen
    $image['type']=".png";
  } elseif ($image['type']=="image/jpeg"){
    $image['type']=".jpg";
  }

  $image_ID = add_image($image['tmp_name'], $image['type']); //tilføjer et billede til databasen og returnerer et iid
}

$post_ID = add_post($author, $title, $content); //returnerer et nyt pid

if($image_included == true){ //hvis et billede er inkluderet, tilføj det til det oprettede post
  add_attachment($post_ID,$image_ID);
}

header("Location: getBlog.php?blog_ID=$post_ID"); //send brugeren videre til postet der lige er oprettet
?>
