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
    $capitulo = $_GET["capitulo"];

    $query = mysqli_query($conn, "SELECT * FROM libro WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    } else {
        $username = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/modificar_capitulo.html'));

    $titulo_ = 0;
    $datos = mysqli_fetch_row($query);

    $query = mysqli_query($conn, "SELECT * FROM capitulo WHERE `Book ID`='$titulo' AND `Chapter Num`=$capitulo")
        or die (mysqli_error($conn));
    $row = mysqli_fetch_assoc($query);
    $pagina  = str_replace('%texto%', $row["Texto"], $pagina);

    // inserta el título del libro en la página
    $titulo .= ": {$row["Chapter_ID"]}";
    $pagina  = str_replace('%titulo%', $titulo, $pagina);

    echo $pagina
?>