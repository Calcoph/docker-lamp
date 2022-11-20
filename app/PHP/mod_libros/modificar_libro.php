<?php
    require "../login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $user = login();

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = htmlspecialchars($_GET["titulo"]);

    $query = mysqli_prepare($conn, "SELECT imglink, `Book ID`, Text_corto, Text_largo, Prologue FROM libro WHERE `Book ID`=?") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "s", $tit);
    $tit = $titulo;
    mysqli_stmt_execute($query) or die ("Error interno E890");

    mysqli_stmt_bind_result($query, $imagen, $titulo_, $descripcion, $resumen, $prologo);
    mysqli_stmt_fetch($query);

    $header = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/modificar_libro.html'));
    $csrf = obtener_token_csrf();
    $pagina  = str_replace('%nonce%', $csrf, $pagina);

    // inserta la imagen en la página
    $pagina  = str_replace('%imagen%', $imagen, $pagina);
    // inserta los datos actuales del libro en la página
    $pagina  = str_replace('%titulo%', $titulo_, $pagina);
    $pagina  = str_replace('%descripcion%', $descripcion, $pagina);
    $pagina  = str_replace('%resumen%', $resumen, $pagina);
    $pagina  = str_replace('%texto%', $prologo, $pagina);

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $query = mysqli_prepare($conn, "SELECT `Chapter Num` FROM capitulo WHERE `Book ID`=? ORDER BY `Chapter Num` ASC") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "s", $tit2);
    $tit2 = $titulo;
    mysqli_stmt_execute($query) or die ("Error interno E890");

    mysqli_stmt_bind_result($query, $c_num);

    while (mysqli_stmt_fetch($query)) {
        $caps .= "<a href=\"/PHP/mod_libros/modificar_capitulo.php/?titulo=$titulo&capitulo=$c_num\">$c_num</a> ";
    };
    $pagina  = str_replace('%capitulos%', $caps, $pagina);

    echo $pagina
?>