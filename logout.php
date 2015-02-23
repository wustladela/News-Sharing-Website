<?php
 session_start();

  echo "Logged out successfully. ";
  session_destroy();   
  header("Location: news_site.php");
?>