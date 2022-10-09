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
    echo $partes[0];
    $imagen = 2;
    $titulo = 0;
    $nota = 1;
    while ($row = mysqli_fetch_row($query)) {
        echo
    "<tr>
        <th><a href=\"/PHP/libro.php/?titulo={$row[$titulo]}\">{$row[$titulo]}</a></th>
    </tr>";
    }
    echo $partes[1];
?>