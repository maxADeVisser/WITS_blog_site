<?php
  session_start();
  require_once "/home/mir/lib/db.php";

  $postID = $_GET['postID'];
  $commentID = $_GET['commentID'];
  // slet en kommentar på et post
  $comment_delete_id = delete_comment($commentID);
  header("Location: getBlog.php?blog_ID=$postID");
?>
