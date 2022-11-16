<?php
    require "login.php";
    require "tokens.php";

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = $_GET["titulo"];

    $query = mysqli_prepare($conn, "SELECT `Book ID`, imglink, Text_corto FROM libro WHERE `Book ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $tit);
    $tit = $titulo;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $titulo_, $imagen, $descripcion);
    mysqli_stmt_fetch($query);

    $user = get_usuario();
    if ($user == NULL) {
        $user = "Iniciar Sesión";
    }

    $header = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/pagina_libro.html'));
    $csrf = obtener_token_csrf();
    $pagina  = str_replace('%nonce%', $csrf, $pagina);

    // inserta la imagen en la página
    $pagina  = str_replace('%ruta imagen%', $imagen, $pagina);
    // inserta el título del libro en la página
    $pagina  = str_replace('%titulo%', $titulo_, $pagina);
    // inserta la descripción del libro en la página
    $pagina  = str_replace('%descripcion%', $descripcion, $pagina);
    // El botón de leer envía al usuario al primer capítulo
    $boton = "
<form metod=\"get\" action=\"/PHP/leer_prologo.php\">
    <button>leer</button>
    <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />
</form>";
    // inserta el botón de leer en la página
    $pagina = str_replace('%boton leer%', $boton, $pagina);
    $boton = "
    <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />";
    // Para que publicar_comentario.php sepa de que libro es el comentario
    $pagina = str_replace('%datos comentario%', $boton, $pagina);

    // Los comentarios
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $query = mysqli_prepare($conn, "SELECT `User ID`, Texto FROM `comentario libro` WHERE `Book ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $tit2);
    $tit2 = $titulo;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $uid, $texto);
    $comentarios = "";
    while (mysqli_stmt_fetch($query)) {
        $comentarios .= "<div class=\"comentario\">
            <div class=\"infocoment\">
                <h4>$uid</h4>
                <p>$texto</p>
            </div>
        </div>";
    }

    $pagina = str_replace('%comentario%', $comentarios, $pagina);

    echo $pagina
?>