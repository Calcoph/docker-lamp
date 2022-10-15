<?php
    $usuario = $_COOKIE["username"];

    // pone el nombre de usuario en el header
    $header = str_replace('%usuario%', $usuario, file_get_contents('/var/www/html/HTML/header_small.html'));
    // inserta el header en la página
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/lista_borrar_libros.html'));

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_query($conn, "SELECT * FROM libro JOIN escritos ON libro.`Book ID`=escritos.`Book ID` WHERE `Used ID`='$usuario'")
        or die (mysqli_error($conn));

    $libros = "";
    while ($row = mysqli_fetch_assoc($query)) {
        $libros .= "<tr>
        <th>
            <input name=\"libros_borrados[]\" type=\"checkbox\" value=\"{$row["Book ID"]}\"><a href=\"/PHP/libro.php/?titulo={$row["Book ID"]}\">{$row["Book ID"]}</a>
        </th>
        <th>
            {$row["Text_corto"]}
        </th>
</tr>";
    }

    $pagina = str_replace('%titulos%', $libros, $pagina);
    //"<th><input name=\"cbipeliculas\" type=\"checkbox\" /><a href=\"#\">pelicula</a></th>"

    echo $pagina
?>