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

    $query = mysqli_query($conn, "SELECT * FROM libro WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
    } else {
        $username = "Iniciar Sesión";
    }
    $header = str_replace('%usuario%', $username, file_get_contents('/var/www/html/HTML/header_small.html'));
    $pagina = str_replace('%header%', $header, file_get_contents('/var/www/html/HTML/pagina_libro.html'));

    // el libro en sí
    $imagen = 2;
    $titulo_ = 0;
    $nota = 1; // TODO: poner $datos[$nota] en alguna parte
    $datos = mysqli_fetch_row($query);
    $pagina  = str_replace('%ruta imagen%', $datos[$imagen], $pagina);
    $pagina  = str_replace('%titulo%', $datos[$titulo_], $pagina);
    $descripcion = "Descripción: Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestiae sed vitae, tempore aspernatur saepe aliquam, delectus, possimus reprehenderit ipsa nobis reiciendis incidunt praesentium porro sapiente amet dignissimos quidem esse velit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio recusandae cum sequi voluptatem nesciunt facilis possimus explicabo illo, harum temporibus dolorem alias, ea ex quae dolorum atque quisquam! Labore, itaque? lore adipisicing elit. Sit ipsum minima ut nisi reprehenderit aliquam iste maxime quisquam, rerum, ullam sequi fuga quidem in voluptates incidunt quibusdam beatae officiis omnis?";
    $pagina  = str_replace('%descripcion%', $descripcion, $pagina);
    $boton = "
<form metod=\"get\" action=\"/PHP/leer_libro.php\">
    <button>leer</button>
    <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />
    <input type=\"hidden\" name=\"capitulo\" value=\"1\" />
</form>";
    $pagina = str_replace('%boton leer%', $boton, $pagina);

    // Los comentarios
    $query = mysqli_query($conn, "SELECT * FROM `comentario libro` WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    while ($row = mysqli_fetch_assoc($query)) {
        // $pagina .= // TODO: hacer los comentarios
        // "<tr>
        // <td>{$row["nombre comentarista"]}</td>
        // <td>{$row["fecha"]}</td>
        // <td>{$row["comentario"]}</td>
        // </tr>";
    }

    echo $pagina
?>