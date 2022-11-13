<?php
    require "../login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

    // La carpeta donde se van a guardar los archivos
    $target_dir = "/var/www/html/uploads/";
    // La dirección que se ve desde el html (para insertar las imágenes luego)
    $save_path = "/uploads/";
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
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if ($_POST["portada"] == "anterior") {
        // Actualizar todo menos la portada
        $query = mysqli_prepare($conn, "UPDATE libro SET `Book ID`=?, Text_corto=?, Text_largo=? Prologue=? WHERE `Book ID`=?") or die (mysqli_error($conn));
        mysqli_stmt_bind_param($query, "sssss", $titulo, $descripcion, $resumen, $texto, $titulo_anterior);
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $resumen = $_POST["resumen"];
        $texto = $_POST["texto"];
        $titulo_anterior = $_POST["titulo_anterior"];
        mysqli_stmt_execute($query) or die (mysqli_error($conn));
    } else {
        // Actualizar todo
        $query = mysqli_prepare($conn, "UPDATE libro SET `Book ID`=?, imglink=?, Text_corto=?, Text_largo=?, Prologue=? WHERE `Book ID`=?") or die (mysqli_error($conn));
        mysqli_stmt_bind_param($query, "ssssss", $titulo, $link, $descripcion, $resumen, $texto, $titulo_anterior);
        $titulo = $_POST["titulo"];
        $link = $save_path;
        $descripcion = $_POST["descripcion"];
        $resumen = $_POST["resumen"];
        $texto = $_POST["texto"];
        $titulo_anterior = $_POST["titulo_anterior"];
        mysqli_stmt_execute($query) or die (mysqli_error($conn));
    }

    header('Location: '."/index.php");
    die();
?>
