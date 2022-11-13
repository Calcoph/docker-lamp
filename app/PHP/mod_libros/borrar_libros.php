<?php
    require "../login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
      die("Database connection failed: " . $conn->connect_error);
    }

    $libros = $_POST["libros_borrados"];
    $arrlength = count($libros);
    for($x = 0; $x < $arrlength; $x++) {
      // TODO: Mirar que el libro es del usuario que ha iniciado sesión
      $query = mysqli_prepare($conn, "DELETE FROM libro WHERE `Book ID`=?") or die (mysqli_error($conn));
      mysqli_stmt_bind_param($query, "s", $lib_id);
      $lib_id = htmlspecialchars($libros[$x]);
      mysqli_stmt_execute($query) or die (mysqli_error($conn));
    }


    // Vuelve a la página principal
    header('Location: '."/PHP/mod_libros/lista_borrar_libros.php");
    die();
?>