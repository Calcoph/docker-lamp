<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $usuario = $_POST["usuario"];
    $contraseña = $_POST["pswd"];

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_query($conn, "INSERT INTO usuario(`Used ID`, Password) VALUES ('$usuario', '$contraseña')") or die (mysqli_error($conn));

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>