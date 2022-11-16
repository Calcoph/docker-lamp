<?php
    require "../login.php";
    $titulo = $_GET["titulo"];

    $username = get_usuario();
    if ($username == NULL) {
        $username = "Iniciar Sesión";
    }

    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/nuevo_capitulo.html'));
    $pagina = str_replace('%titulo%', $titulo, $pagina);

    echo $pagina
?>