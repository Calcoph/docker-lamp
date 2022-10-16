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
    // inserta la imagen en la página
    $pagina  = str_replace('%nombre%', $datos["Nombre"], $pagina);
    // inserta el título del libro en la página
    $pagina  = str_replace('%apellido%', $datos["Apellidos"], $pagina);
    // inserta la descripción del libro en la página
    $pagina  = str_replace('%dni%', $datos["DNI"], $pagina);
    // inserta el resumen del libro en la página
    $pagina  = str_replace('%fnacimiento%', $datos["fecha_nacimiento"], $pagina);
    // inserta el resumen del libro en la página
    $pagina  = str_replace('%tlf%', $datos["Telefono"], $pagina);
    // inserta el resumen del libro en la página
    $pagina  = str_replace('%email%', $datos["email"], $pagina);
    // inserta el resumen del libro en la página
    $pagina  = str_replace('%usuario%', $datos["Used ID"], $pagina);
    // inserta el resumen del libro en la página
    $pagina  = str_replace('%pswd%', $datos["Password"], $pagina);
    

    $query = mysqli_query($conn, "SELECT * FROM capitulo WHERE `Book ID`='$titulo' ORDER BY `Chapter Num` ASC")
        or die (mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($query)) {
        $caps .= "<a href=\"/PHP/mod_libros/modificar_capitulo.php/?titulo=$titulo&capitulo={$row["Chapter Num"]}\">{$row["Chapter Num"]}</a> ";
    };
    $pagina  = str_replace('%capitulos%', $caps, $pagina);

    echo $pagina
?>