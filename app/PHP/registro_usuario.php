<?php
    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $pass = $_POST["pswd"];

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_prepare($conn, "INSERT INTO usuario(`Used ID`, Password, DNI, email, Nombre, Apellidos, Telefono, fecha_nacimiento)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ssssssss", $usuario, $contraseña, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento);
    $usuario = htmlspecialchars($_POST["usuario"]);
    $contraseña = password_hash($pass, PASSWORD_BCRYPT);
    $dni = htmlspecialchars($_POST["dni"]);
    $email = htmlspecialchars($_POST["email"]);
    $nombre = htmlspecialchars($_POST["nombre"]);
    $apellido = htmlspecialchars($_POST["apellido"]);
    $tlf = htmlspecialchars($_POST["tlf"]);
    $fnacimiento = htmlspecialchars($_POST["fnacimiento"]);
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    setcookie("username", htmlspecialchars($_POST["usuario"]), time()+24*3600); // El inicio de sesión dura 24h
    setcookie("pass", $pass, time()+24*3600); // El inicio de sesión dura 24h

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>