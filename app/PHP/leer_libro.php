<?php
    require "login.php";

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = $_GET["titulo"];
    $capitulo = $_GET["capitulo"];

    $username = get_usuario();
    if ($username == NULL) {
      $username = "Iniciar Sesión";
    }

    // pone el nombre de usuario en el header
    $header = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/header_small.html')); 
    // inserta el header en la página
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/leer_libro.html'));

    // Obtiene el capítulo que se ha pedido
    $query = mysqli_prepare($conn, "SELECT Chapter_ID, Texto FROM capitulo WHERE `Book ID`=? AND `Chapter Num`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "si", $tit, $c_num);
    $tit = $titulo;
    $c_num = $capitulo;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
    
    // Guarda el nombre del capítulo para luego
    mysqli_stmt_bind_result($query, $chap_id, $texto);
    mysqli_stmt_fetch($query);

    // inserta el texto en la página
    $pagina = str_replace('%texto%', $texto, $pagina);
    $pagina = str_replace('%TitCapitulo%', $chap_id, $pagina);

    $cap_anterior = intval($capitulo)-1;
    $anterior = "";
    // El botón de capítulo anterior no está en el primer capítulo
    if ($cap_anterior >= 1) {
        $cap_anterior = strval($cap_anterior);
        $anterior = "
    <form metod=\"get\" action=\"/PHP/leer_libro.php\">
        <Button>Capítulo anterior</Button>
        <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />
        <input type=\"hidden\" name=\"capitulo\" value=\"$cap_anterior\" />
    </form>";
    } else {
        $anterior = "
        <form metod=\"get\" action=\"/PHP/leer_prologo.php\">
            <Button>Capítulo anterior</Button>
            <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />
        </form>";
    }


    // El botón de capítulo siguiente no está en el último capítulo
    $cap_siguiente = strval(intval($capitulo)+1);

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "SELECT * FROM capitulo WHERE `Book ID`=? AND `Chapter Num`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "si", $tit2, $c_num2);
    $tit2 = $titulo;
    $c_num2 = $cap_siguiente;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    $siguiente = "";
    if (mysqli_stmt_fetch($query)) { // Este while solo se va a ejecutar 1 vez (o ninguna, si es el último)
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
    mysqli_stmt_bind_param($query, "ss", $tit3, $c_num3);
    $tit3 = $titulo;
    $c_num3 = $chap_id;
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