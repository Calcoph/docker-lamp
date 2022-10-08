<?php
  if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    $username = "Iniciar Sesión";
  }
  $index = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/index.html'));
  echo $index
?>
