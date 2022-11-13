<?php
    require "../login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

    // pone el nombre de usuario en el header
    $header = str_replace('%usuario%', $usuario, file_get_contents('/var/www/html/HTML/header_small.html'));
    // inserta el header en la página
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/mod_libros/lista_modificar_libros.html'));

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "SELECT libro.`Book ID`, Text_corto FROM libro JOIN escritos ON libro.`Book ID`=escritos.`Book ID` WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $usuario);
    $usuario = htmlspecialchars($_COOKIE["username"]);
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    $libros = "";
    mysqli_stmt_bind_result($query, $book_id, $texto_corto);
    while (mysqli_stmt_fetch($query)) {
        $libros .= "<tr>
        <th>
            <a href=\"/PHP/libro.php/?titulo=$book_id\">$book_id</a>
        </th>
        <th>
           <p>$texto_corto</p>
            
        </th>
        <th id=\"col_botones\">
            <form name=\"form_modificar_libro\" action=\"/PHP/mod_libros/modificar_libro.php\" method=\"get\" class=\"form\">
                <input id=\"btn\" type=\"submit\" value=\"Modificar\">
                <input type=\"hidden\" name=\"titulo\" value=\"$book_id\">
            </form>
            <form name=\"form_anadir_capitulo\" action=\"/PHP/mod_libros/nuevo_capitulo.php\" method=\"get\" class=\"form\">
                <input id=\"btn\" type=\"submit\" value=\"Añadir capitulo\">
                <input type=\"hidden\" name=\"titulo\" value=\"$book_id\">
            </form>
        </th>
</tr>";
    }

    $pagina = str_replace('%titulos%', $libros, $pagina);
    //"<th><input name=\"cbipeliculas\" type=\"checkbox\" /><a href=\"#\">pelicula</a></th>"

    echo $pagina
?>