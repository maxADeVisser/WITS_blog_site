<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->
<!-- fil til at håndtere opdatering af et post -->
<?php
  require_once "/home/mir/lib/db.php";
  $postID = $_GET['postID'];
  modify_post($postID, $_GET['postTitle'], $_GET['postContent']);
  header("Location: getBlog.php?blog_ID=$postID");
?>
