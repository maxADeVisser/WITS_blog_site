<!-- Author: Sebastian Rohr, Max de Visser, William Dyrnesli, Simon Hindsgaul -->
<!-- denne fil tjekker om brugeren har valgt et pid eller eller et uid fra menuen.
Hvis begge er specificeret, prioriteres pid-->

<?php
  require_once "/home/mir/lib/db.php";
  session_start();

  $blogID = $_GET['blog_ID']; // fetch
  $usersID = $_GET['users_ID'];

  if(!empty($blogID)){
    header("Location: getBlog.php?blog_ID=$blogID");
  } else {
    header("Location: getUser.php?user_ID=$usersID");
  }
?>
