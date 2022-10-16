<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $username = $_COOKIE["username"];

    $pagina = file_get_contents('/var/www/html/HTML/cambiar_datos.html');

    $query = mysqli_query($conn, "SELECT * FROM usuario WHERE `Used ID`='$username'")
        or die (mysqli_error($conn));

    $datos = mysqli_fetch_assoc($query);
    // Inserta los datos actuales del usuario en la página
    $pagina  = str_replace('%nombre%', $datos["Nombre"], $pagina);
    $pagina  = str_replace('%apellido%', $datos["Apellidos"], $pagina);
    $pagina  = str_replace('%dni%', $datos["DNI"], $pagina);
    $pagina  = str_replace('%fnacimiento%', $datos["fecha_nacimiento"], $pagina);
    $pagina  = str_replace('%tlf%', $datos["Telefono"], $pagina);
    $pagina  = str_replace('%email%', $datos["email"], $pagina);
    $pagina  = str_replace('%usuario%', $datos["Used ID"], $pagina);
    $pagina  = str_replace('%pswd%', $datos["Password"], $pagina);

    echo $pagina
?>