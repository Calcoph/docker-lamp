<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";
  
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
      die("Database connection failed: " . $conn->connect_error);
    }

    $libros = $_POST["libros_borrados"];
    $arrlength = count($libros);
    for($x = 0; $x < $arrlength; $x++) {
        $query = mysqli_query($conn, "DELETE FROM libro WHERE `Book ID`='{$libros[$x]}'") or die (mysqli_error($conn));
    }

  
    // Vuelve a la página principal
    header('Location: '."/PHP/mod_libros/lista_borrar_libros.php");
    die();
?>