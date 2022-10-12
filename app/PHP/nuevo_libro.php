<?php
  // Si está logueado, tiene la cookie "username"
  if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    $username = "Iniciar Sesión";
  }

  // pone el nombre de usuario en el header
  $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html')); 
  // inserta el header en la página
  $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/nuevo_libro.html'));
  echo $pagina
?>
