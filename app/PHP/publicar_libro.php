<?php
    // La carpeta donde se van a guardar los archivos
    $target_dir = "/var/www/html/uploads/";
    // La dirección que se ve desde el html (para insertar las imágenes luego)
    $save_path = "/uploads/";
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $resumen = $_POST["resumen"];
    $texto = $_POST["texto"];
    if (file_exists($_FILES["portada_personalizada"]["tmp_name"])) {
        // Si ha elegido una portada personalizada, la descargamos
        $target_file = $target_dir . basename($_FILES["portada_personalizada"]["name"]);
        $save_path = $save_path . basename($_FILES["portada_personalizada"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $files = $_FILES["portada_personalizada"]["tmp_name"];
        // código sacado de https://www.w3schools.com/php/php_file_upload.asp
        // modificaciones: Hemos eliminado todos los checks
        if (move_uploaded_file($_FILES["portada_personalizada"]["tmp_name"], $target_file)) {

        } else {
            echo "Ha habido un error al subir la portada.";
            return;
        }
    } else {
        // Si ha elegido una portada predefinida, solo guardamos la elección en la base de datos
        $target_file = $target_dir . $_POST["portada"] . ".png";
        $save_path = $save_path . $_POST["portada"] . ".png";
    }

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Almacena el libro
    $query = mysqli_prepare($conn, "INSERT INTO libro(`Book ID`, imglink, Text_corto, Text_largo, Prologue) VALUES (?, ?, ?, ?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "sssss", $tit, $s_p, $desc, $res, $txt);
    $tit = $titulo;
    $s_p = $save_path;
    $desc = $descripcion;
    $res = $resumen;
    $txt = $texto;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    // Almacena quien lo ha publicado
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $username = $_COOKIE["username"];

    $query = mysqli_prepare($conn, "INSERT INTO escritos(`Book ID`, `Used ID`) VALUES (?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ss", $tit, $us);
    $tit = $titulo;
    $us = $username;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    if ($_POST['boton'] == "solo_publicar") {
        // Vuelve a la página principal
        header('Location: '."/index.php");
        die();
      } else {
        // Sigue añadiendo capítulos
        header('Location: '."/PHP/mod_libros/nuevo_capitulo.php/?titulo=$titulo");
        die();
    }
?>
