<?php
// sletter et billede fra et post

require_once "/home/mir/lib/db.php";
$postID = $_GET['pid'];
$imageID = $_GET['iid'];
delete_attachment($postID, $imageID);
header("Location: editPost.php?blog_ID=$postID");
 ?>
