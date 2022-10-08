

<?php
    $target_dir = "/home/www-data/uploads/";
    $target_file = $target_dir . basename($_FILES["portada_personalizada"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $files = $_FILES["portada_personalizada"]["tmp_name"];
    echo "A<br>";
    echo "$target_file<br>";
    echo "$files<br>";
    echo "B<br>";
    if (move_uploaded_file($_FILES["portada_personalizada"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["portada_personalizada"]["tmp_name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
?>
