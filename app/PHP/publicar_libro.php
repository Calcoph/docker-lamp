

<?php
    $target_dir = "/home/www-data/uploads/";
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];
    if (file_exists($_FILES["portada_personalizada"]["tmp_name"])) {
        $target_file = $target_dir . basename($_FILES["portada_personalizada"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $files = $_FILES["portada_personalizada"]["tmp_name"];
        if (move_uploaded_file($_FILES["portada_personalizada"]["tmp_name"], $target_file)) {
            
        } else {
            echo "Ha habido un error al subir la portada.";
            return;
        }
    } else {
        $target_file = $target_dir . $_POST["portada"] . ".png";
    }

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_query($conn, "INSERT INTO libro(`Book ID`, Nota, img) VALUES ('$titulo', 0.0, '$target_dir')") or die (mysqli_error($conn));
    $query = mysqli_query($conn, "INSERT INTO capitulo(Chapter_ID, `Book ID`, `Chapter Num`, Texto) VALUES ('Cap 0', '$titulo', 0, '$texto')") or die (mysqli_error($conn));

    include "../index.php";
?>
