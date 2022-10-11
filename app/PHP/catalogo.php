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

    $partes = explode("%catalogo%", file_get_contents('/var/www/html/HTML/catalogo.html'), 2);
    $pagina = $partes[0];
    $imagen = 2;
    $titulo = 0;
    $nota = 1;
    while ($row = mysqli_fetch_row($query)) {
        $pagina .= "<tr>
        <th><a href=\"/PHP/libro.php/?titulo={$row[$titulo]}\">{$row[$titulo]}</a></th>
    </tr>";
    }
    $pagina .= $partes[1];


    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    } else {
        $username = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small_small.html'));
    $final = str_replace('%header%', $header, $pagina);
    echo $final
?>