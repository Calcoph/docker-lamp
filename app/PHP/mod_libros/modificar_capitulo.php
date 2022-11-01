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
    $pagina  = str_replace('%titulo_libro%', $titulo, $pagina);
    $titulo_ = 0;
    $datos = mysqli_fetch_row($query);

    $query = mysqli_prepare($conn, "SELECT Texto, Chapter_ID FROM capitulo WHERE `Book ID`=? AND `Chapter Num`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "si", $tit, $c_num);
    $tit = $titulo;
    $c_num = $capitulo;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $texto, $c_id);
    mysqli_stmt_fetch($query);

    $pagina  = str_replace('%texto%', $texto, $pagina);

    // inserta el título del libro en la página
    $titulo .= ": $c_id";
    $pagina  = str_replace('%titulo%', $titulo, $pagina);
    $pagina  = str_replace('%titulo_capitulo%', $c_id, $pagina);

    echo $pagina
?>