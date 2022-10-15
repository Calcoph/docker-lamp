<?php
    // La carpeta donde se van a guardar los archivos
    $target_dir = "/var/www/html/uploads/";
    // La dirección que se ve desde el html (para insertar las imágenes luego)
    $save_path = "/uploads/";
    $titulo_libro = $_POST["titulo_libro"];
    $titulo_anterior = $_POST["titulo_anterior"];
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

    // modifica el capítulo
    $query = mysqli_query($conn, "UPDATE capitulo SET Chapter_ID = '$titulo', Texto = '$texto' WHERE `Book ID` = '$titulo_libro' AND Chapter_ID = '$titulo_anterior'") or die (mysqli_error($conn));

    header('Location: '."/PHP/mod_libros/modificar_libro.php/?titulo=$titulo_libro");
?>
