<?php
    require "../login.php";

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

    $titulo = $_GET["titulo"];

    if (isset($_COOKIE["username"])) {
        $user = $_COOKIE["username"];
    } else {
        $user = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/modificar_capitulo.html'));
    $pagina  = str_replace('%titulo_libro%', $titulo, $pagina);

    $query = mysqli_prepare($conn, "SELECT Texto, Chapter_ID FROM capitulo WHERE `Book ID`=? AND `Chapter Num`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "si", $tit, $capitulo);
    $tit = $titulo;
    $capitulo = $_GET["capitulo"];
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