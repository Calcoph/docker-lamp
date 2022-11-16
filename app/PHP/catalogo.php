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

    $query = mysqli_prepare($conn, "SELECT `Book ID`, Text_corto FROM libro") or die (mysqli_error($conn));
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $b_id, $text_corto);

    // parte la página por la mitad, para insertar el catalogo en medio
    $partes = explode("%catalogo%", file_get_contents('/var/www/html/HTML/catalogo.html'), 2);
    $pagina = $partes[0];

    // Para acceder mediante índice
    while (mysqli_stmt_fetch($query)) {
        $pagina .= "<tr>
        <th><a href=\"/PHP/libro.php/?titulo=$b_id\">$b_id</a></th>
        <th>$text_corto</th>
    </tr>";
    }
    // unimos la parte inferior que hemos separado antes
    $pagina .= $partes[1];

    $username = get_usuario();
    if ($username == NULL) {
      $username = "Iniciar Sesión";
    }

    // pone el nombre de usuario en el header
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html'));
    // inserta el header en la página
    $final = str_replace('%header%', $header, $pagina);
    echo $final
?>