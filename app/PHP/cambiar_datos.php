<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_prepare($conn, "UPDATE usuario
                                    SET `Used ID`=?, DNI=?, email=?, Nombre=?, Apellidos=?, Telefono=?, fecha_nacimiento=?
                                    WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ssssssss", $usuario, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento, $usuario_anterior);
    $usuario = htmlspecialchars($_POST["usuario"]);
    $dni = htmlspecialchars($_POST["dni"]);
    $email = htmlspecialchars($_POST["email"]);
    $nombre = htmlspecialchars($_POST["nombre"]);
    $apellido = htmlspecialchars($_POST["apellido"]);
    $tlf = htmlspecialchars($_POST["tlf"]);
    $fnacimiento = htmlspecialchars($_POST["fnacimiento"]);
    $usuario_anterior = htmlspecialchars($_POST["usuario_anterior"]); // TODO: En vez de un post con el usuario anterior, coger el usuario de la cookie, igual que el login
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>
