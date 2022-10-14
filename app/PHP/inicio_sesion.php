<?php
    // Si está logueado, tiene la cookie "username"
  if (isset($_COOKIE["username"])) {
    // le mandamos a las opciones de usuario
    echo file_get_contents('/var/www/html/HTML/opciones_usuario.html');
  } else {
    // le mandamos a inicio_sesion
    echo file_get_contents('/var/www/html/HTML/inicio_sesion.html');
  }
?>