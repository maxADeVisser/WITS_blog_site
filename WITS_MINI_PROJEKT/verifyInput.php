<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->

<?php
  require_once "/home/mir/lib/db.php";
  session_start();

  $blogID = $_GET['blog_ID'];

  $usersID = $_GET['users_ID'];



  if($_SESSION['loggedIn'] && $_SESSION['username'] == get_post($blogID)['uid']){ //hvis en bruger ejer postet
     header("Location: getBlog.php?blog_ID=$blogID");
  } else {
    //hvis IKKE brugeren ejer postet
    if(!empty($blogID)){
      header("Location: getBlog.php?blog_ID=$blogID");
    } else { 
      header("Location: getUser.php?user_ID=$usersID");
    }
  }
?>
