<?php
    // La carpeta donde se van a guardar los archivos
    $target_dir = "/var/www/html/uploads/";
    // La dirección que se ve desde el html (para insertar las imágenes luego)
    $save_path = "/uploads/";
    $titulo_libro = $_POST["titulo_libro"];
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_query($conn, "SELECT `Chapter Num` FROM capitulo WHERE `Book ID`='$titulo_libro' ORDER BY `Chapter Num` ASC")
        or die (mysqli_error($conn));
    $row = mysqli_fetch_assoc($query);
    $cap = $row["Chapter Num"]+1;
    // Almacena el capítulo
    $query = mysqli_query($conn, "INSERT INTO capitulo(Chapter_ID, `Book ID`, `Chapter Num`, Texto) VALUES ('$titulo', '$titulo_libro', $cap, '$texto')") or die (mysqli_error($conn));

/* TODO: Descomentar
    if ($_POST['boton'] == "solo_publicar") {
        // Vuelve a la página principal
        header('Location: '."/index.php");
        die();
      } else {
        // Sigue añadiendo capítulos
        header('Location: '."/PHP/mod_libros/nuevo_capitulo.php/?titulo=$titulo");
        die();
    } */
?>
