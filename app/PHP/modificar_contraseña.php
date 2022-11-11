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
                                    SET `Password=?
                                    WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "sssssssss", $contraseña;
    $contraseña = password_hash($pass, PASSWORD_BCRYPT);
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();