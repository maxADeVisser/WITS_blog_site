<?php
// tilføjer comment på et post
session_start();
require_once "/home/mir/lib/db.php";
$postID = $_GET['postID'];
$userID = $_SESSION['username'];
$comment_content = $_GET['comment'];

$comment_id = add_comment($userID, $postID, $comment_content); // returnerer id på kommentar
header("Location: getBlog.php?blog_ID=$postID");

 ?>
