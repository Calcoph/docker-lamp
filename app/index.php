<?php
  require "PHP/login.php";
  $username = get_usuario();
  if ($username == NULL) {
    $username = "Iniciar Sesión";
  }

  // pone el nombre de usuario en el header
  $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header.html')); 
  // inserta el header en la página
  $index = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/index.html'));
  echo $index
?>
