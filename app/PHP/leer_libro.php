<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = $_GET["titulo"];
    $capitulo = $_GET["capitulo"];

    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    } else {
        $username = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html')); 
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/leer_libro.html'));

    $query = mysqli_query($conn, "SELECT * FROM capitulo WHERE `Book ID`='$titulo' AND `Chapter Num`=$capitulo")
        or die (mysqli_error($conn));

    $row = mysqli_fetch_assoc($query);
    $pagina = str_replace('%texto%', $row["Texto"], $pagina);
    // capitulos
    while ($row = mysqli_fetch_assoc($query)) {
        // $pagina .= // TODO: borrar este while
        // "<tr>
        // <td>{$row["Chapter_ID"]}</td>
        // <td>{$row["Book ID"]}</td>
        // <td>{$row["Chapter num"]}</td>
        // <td>{$row["Texto"]}</td>
        // </tr>";
    }

    echo $pagina;
?>