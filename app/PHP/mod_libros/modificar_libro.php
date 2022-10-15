<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = $_GET["titulo"];

    $query = mysqli_query($conn, "SELECT * FROM libro WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    } else {
        $username = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/modificar_libro.html'));

    $imagen = 2;
    $titulo_ = 0;
    $descripcion = 3;
    $resumen = 4;
    $datos = mysqli_fetch_row($query);
    // inserta la imagen en la página
    $pagina  = str_replace('%imagen%', $datos[$imagen], $pagina);
    // inserta el título del libro en la página
    $pagina  = str_replace('%titulo%', $datos[$titulo_], $pagina);
    // inserta la descripción del libro en la página
    $pagina  = str_replace('%descripcion%', $datos[$descripcion], $pagina);
    // inserta el resumen del libro en la página
    $pagina  = str_replace('%resumen%', $datos[$resumen], $pagina);

    $query = mysqli_query($conn, "SELECT * FROM capitulo WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));
    while ($row = mysqli_fetch_assoc($query)) {
        $caps .= "<a href=\"/PHP/mod_libros/modificar_capitulo.php/?titulo=$titulo&capitulo={$row["Chapter Num"]}\">{$row["Chapter Num"]}</a> ";
    };
    $pagina  = str_replace('%capitulos%', $caps, $pagina);

    echo $pagina
?>