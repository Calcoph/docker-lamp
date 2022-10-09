<?php
if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
  } else {
    $username = "Iniciar Sesión";
  }
  $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html')); 
  $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/pagina_libro.html'));
  echo $pagina;
?>