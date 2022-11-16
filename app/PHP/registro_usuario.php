<?php
    require "tokens.php";

    if (!comprobar_token_csrf($_POST["nonce"])) {
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

    $pass = $_POST["pswd"];

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_prepare($conn, "INSERT INTO usuario(`Used ID`, Password, DNI, email, Nombre, Apellidos, Telefono, fecha_nacimiento)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ssssssss", $usuario, $contraseña, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento);
    $usuario = $_POST["usuario"];
    $contraseña = password_hash($pass, PASSWORD_BCRYPT);
    $dni = $_POST["dni"];
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tlf = $_POST["tlf"];
    $fnacimiento = $_POST["fnacimiento"];
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    setcookie("username", $_POST["usuario"], time()+24*3600, "/"); // El inicio de sesión dura 24h
    setcookie("pass", $pass, time()+24*3600, "/"); // El inicio de sesión dura 24h

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>