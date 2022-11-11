<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $pagina = file_get_contents('/var/www/html/HTML/cambiar_pswd.html');

    $query = mysqli_prepare($conn, "SELECT `Used ID`FROM usuario WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $user);
    $user = $_COOKIE["username"];
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $nombre, $apellidos, $dni, $f_nacimiento, $tlf, $email, $uid, $pswd);
    mysqli_stmt_fetch($query);

    // Inserta los datos actuales del usuario en la página
    $pagina  = str_replace('%usuario%', $user, $pagina);

    echo $pagina
?>