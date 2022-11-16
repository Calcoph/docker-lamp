<?php
  require "login.php";
  require "tokens.php";
  // Si está logueado, un usuario
  if (get_usuario() != NULL) {
    // le mandamos a las opciones de usuario
    // No hace falta que verifiquemos el login en este paso.
    // Sólo miramos si está logueado por comodidad del usuario.
    echo file_get_contents('/var/www/html/HTML/opciones_usuario.html');
  } else {
    // le mandamos a inicio_sesion
    $pagina = file_get_contents('/var/www/html/HTML/inicio_sesion.html');
    $csrf = obtener_token_csrf();
    $pagina  = str_replace('%nonce%', $csrf, $pagina);
    echo $pagina;
  }
?>