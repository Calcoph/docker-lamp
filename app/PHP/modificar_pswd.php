<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $us = login();

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $pagina = file_get_contents('/var/www/html/HTML/cambiar_pswd.html');
    $csrf = obtener_token_csrf();
    $pagina  = str_replace('%nonce%', $csrf, $pagina);

    $query = mysqli_prepare($conn, "SELECT `Used ID`FROM usuario WHERE `Used ID`=?") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "s", $user);
    $user = $us;
    mysqli_stmt_execute($query) or die ("Error interno E890");

    mysqli_stmt_bind_result($query, $nombre, $apellidos, $dni, $f_nacimiento, $tlf, $email, $uid, $pswd);
    mysqli_stmt_fetch($query);

    // Inserta los datos actuales del usuario en la página
    $pagina  = str_replace('%usuario%', $user, $pagina);

    echo $pagina
?>