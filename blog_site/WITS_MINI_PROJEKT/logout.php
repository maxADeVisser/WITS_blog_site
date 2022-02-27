<?php
  // nulstiller session
  session_start();
  session_destroy();
  header("Location: menu.php");
?>
