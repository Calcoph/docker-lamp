<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = htmlspecialchars($_GET["titulo"]);

    // Si está logueado, tiene la cookie "username"
    if (isset($_COOKIE["username"])) {
        $user = htmlspecialchars($_COOKIE["username"]);
    } else {
        $user = "Iniciar Sesión";
    }
    // pone el nombre de usuario en el header
    $header = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/header_small.html')); 
    // inserta el header en la página
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/leer_libro.html'));

    // Obtiene el capítulo que se ha pedido
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "SELECT Chapter_ID FROM libro WHERE `Book ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $tit);
    $tit = $titulo;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
    
    mysqli_stmt_bind_result($query, $chap_id, $prologo);

    mysqli_stmt_fetch($query);

    // inserta el texto en la página
    $pagina = str_replace('%texto%', $prologo, $pagina);
    $pagina = str_replace('%TitCapitulo%', "Prólogo", $pagina);

    $anterior = "";

    // El botón de capítulo siguiente no está en el último capítulo
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "SELECT * FROM capitulo WHERE `Book ID`=? AND `Chapter Num`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "si", $tit, $c_num);
    $tit = $titulo;
    $c_num = "1";
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    $siguiente = "";
    if (mysqli_stmt_fetch($query)) {
        $siguiente = "
    <form metod=\"get\" action=\"/PHP/leer_libro.php\">
        <Button>Capítulo siguiente</Button>
        <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />
        <input type=\"hidden\" name=\"capitulo\" value=\"$cap_siguiente\" />
    </form>";
    }

    // inserta los botones de "capítulo anterior", tanto arriba como abajo
    $pagina = str_replace('%boton anterior%', $anterior, $pagina);
    // inserta los botones de "capítulo siguiente", tanto arriba como abajo
    $pagina = str_replace('%boton siguiente%', $siguiente, $pagina);

    // Los comentarios
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "SELECT `User ID`, Texto FROM `comentario capitulo` WHERE `Book ID`=? AND Chapter_ID=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ss", $tit, $c_id);
    $tit = $titulo;
    $c_id = $chap_id;
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

    echo $pagina;
?>