<?php
// tilføjer comment på et post
session_start();
require_once "/home/mir/lib/db.php";
$postID = $_GET['postID'];
$commentID = $_GET['commentID'];

$comment_delete_id = delete_comment($commentID);
header("Location: getBlog.php?blog_ID=$postID");

 ?>
