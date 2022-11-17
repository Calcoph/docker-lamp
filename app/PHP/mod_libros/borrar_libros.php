<?php
    require "../login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $user = login();

    if (!comprobar_token_csrf($_POST["_token"])) {
      echo "Ha habido un error interno (E9013), pruebe más tarde";
      die();
    }

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
      die("Database connection failed: " . $conn->connect_error);
    }

    // Obtener la lista de libros escritos por este usuario, para asegurarse que solo se borran los escritos por él
    $query = mysqli_prepare($conn, "SELECT `Book ID` FROM escritos WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $us_id);
    $us_id = $user;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
    $libros_usuario = mysqli_stmt_get_result($query)->fetch_array();

    $libros = $_POST["libros_borrados"];
    $arrlength = count($libros);
    for($x = 0; $x < $arrlength; $x++) {
      $hostname = "db";
      $username = "admin";
      $password = "test";
      $db = "database";
    
      $conn = mysqli_connect($hostname,$username,$password,$db);
      if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
      }

      if (in_array($libros[$x], $libros_usuario)) {
        // TODO: Mirar que el libro es del usuario que ha iniciado sesión
      $query = mysqli_prepare($conn, "DELETE FROM libro WHERE `Book ID`=?") or die (mysqli_error($conn));
      mysqli_stmt_bind_param($query, "s", $lib_id);
      $lib_id = htmlspecialchars($libros[$x]);
      mysqli_stmt_execute($query) or die (mysqli_error($conn));
      }
    }


    // Vuelve a la página principal
    header('Location: '."/PHP/mod_libros/lista_borrar_libros.php");
    die();
?>