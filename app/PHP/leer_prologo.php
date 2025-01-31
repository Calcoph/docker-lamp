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

    $titulo = htmlspecialchars($_GET["titulo"]);

    $user = get_usuario();
    if ($user == NULL) {
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

    $query = mysqli_prepare($conn, "SELECT Prologue FROM libro WHERE `Book ID`=?") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "s", $tit);
    $tit = $titulo;
    mysqli_stmt_execute($query) or die ("Error interno E890");
    
    mysqli_stmt_bind_result($query, $prologo);

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

    $query = mysqli_prepare($conn, "SELECT * FROM capitulo WHERE `Book ID`=? AND `Chapter Num`=?") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "si", $tit, $c_num);
    $tit = $titulo;
    $c_num = "1";
    mysqli_stmt_execute($query) or die ("Error interno E890");

    $siguiente = "";
    if (mysqli_stmt_fetch($query)) {
        $siguiente = "<a href='/PHP/leer_libro.php/?titulo=$titulo&capitulo=1'>Siguiente</a>";
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

    $pagina = str_replace('%comentario%', "", $pagina);

    echo $pagina;
?>