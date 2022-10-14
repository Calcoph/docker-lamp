<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_query($conn, "SELECT * FROM libro")
        or die (mysqli_error($conn));

    // parte la página por la mitad, para insertar el catalogo en medio
    $partes = explode("%catalogo%", file_get_contents('/var/www/html/HTML/catalogo.html'), 2);
    $pagina = $partes[0];

    // Para acceder mediante índice
    $imagen = 2;
    $titulo = 0;
    $nota = 1;
    while ($row = mysqli_fetch_row($query)) {
        $pagina .= "<tr>
        <th><a href=\"/PHP/libro.php/?titulo={$row[$titulo]}\">{$row[$titulo]}</a></th>
        <th>{$row[$nota]}</th>
    </tr>";
    }
    // unimos la parte inferior que hemos separado antes
    $pagina .= $partes[1];

    // Si está logueado, tiene la cookie "username"
    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    } else {
        $username = "Iniciar Sesión";
    }
    // pone el nombre de usuario en el header
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html'));
    // inserta el header en la página
    $final = str_replace('%header%', $header, $pagina);
    echo $final
?>