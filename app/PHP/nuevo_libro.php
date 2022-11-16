<?php
  require "login.php";

  $username = login();
  // pone el nombre de usuario en el header
  $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html')); 
  // inserta el header en la página
  $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/nuevo_libro.html'));
  $csrf = obtener_token_csrf();
  $pagina  = str_replace('%nonce%', $csrf, $pagina);
  echo $pagina;
?>
