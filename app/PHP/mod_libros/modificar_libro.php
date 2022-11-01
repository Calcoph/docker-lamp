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
        $user = $_COOKIE["username"];
    } else {
        $user = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/modificar_libro.html'));

    $imagen = 1;
    $titulo_ = 0;
    $descripcion = 2;
    $resumen = 3;
    $prologo = 4;
    $datos = mysqli_fetch_row($query);
    // inserta la imagen en la página
    $pagina  = str_replace('%imagen%', $datos[$imagen], $pagina);
    // inserta los datos actuales del libro en la página
    $pagina  = str_replace('%titulo%', $datos[$titulo_], $pagina);
    $pagina  = str_replace('%descripcion%', $datos[$descripcion], $pagina);
    $pagina  = str_replace('%resumen%', $datos[$resumen], $pagina);
    $pagina  = str_replace('%texto%', $datos[$prologo], $pagina);

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $query = mysqli_prepare($conn, "SELECT `Chapter Num` FROM capitulo WHERE `Book ID`=? ORDER BY `Chapter Num` ASC") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $tit);
    $tit = $titulo;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $c_num);

    while (mysqli_stmt_fetch($query)) {
        $caps .= "<a href=\"/PHP/mod_libros/modificar_capitulo.php/?titulo=$titulo&capitulo=$c_num\">$c_num</a> ";
    };
    $pagina  = str_replace('%capitulos%', $caps, $pagina);

    echo $pagina
?>