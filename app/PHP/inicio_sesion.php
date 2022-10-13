<?php
    // Si está logueado, tiene la cookie "username"
  if (isset($_COOKIE["username"])) {
    // le mandamos a cambiar_datos
    echo file_get_contents('/var/www/html/HTML/cambiar_datos.html');
  } else {
    // le mandamos a inicio_sesion
    echo file_get_contents('/var/www/html/HTML/inicio_sesion.html');
  }
?>