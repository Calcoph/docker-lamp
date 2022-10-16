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

    $imagen = 1;
    $titulo_ = 0;
    $descripcion = 2;
    $datos = mysqli_fetch_row($query);
    // inserta la imagen en la página
    $pagina  = str_replace('%ruta imagen%', $datos[$imagen], $pagina);
    // inserta el título del libro en la página
    $pagina  = str_replace('%titulo%', $datos[$titulo_], $pagina);
    // inserta la descripción del libro en la página
    $pagina  = str_replace('%descripcion%', $datos[$descripcion], $pagina);
    // El botón de leer envía al usuario al primer capítulo
    $boton = "
<form metod=\"get\" action=\"/PHP/leer_prologo.php\">
    <button>leer</button>
    <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />
</form>";
    // inserta el botón de leer en la página
    $pagina = str_replace('%boton leer%', $boton, $pagina);

    $boton = "
    <input type=\"hidden\" name=\"titulo\" value=\"$titulo\" />";
    // Para que publicar_comentario.php sepa de que libro es el comentario
    $pagina = str_replace('%datos comentario%', $boton, $pagina);

    // Los comentarios
    $query = mysqli_query($conn, "SELECT * FROM `comentario libro` WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    $comentarios = "";
    while ($row = mysqli_fetch_assoc($query)) {
        $comentarios .= "<div class=\"comentario\">
            <div class=\"infocoment\">
                <h4>{$row['User ID']}</h4>
                <p>{$row['Texto']}</p>
            </div>
        </div>";
    }

    $pagina = str_replace('%comentario%', $comentarios, $pagina);

    echo $pagina
?>