<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_prepare($conn, "INSERT INTO usuario(`Used ID`, Password, DNI, email, Nombre, Apellidos, Telefono, fecha_nacimiento)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ssssssss", $usuario, $contraseña, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento);
    $usuario = $_POST["usuario"];
    $contraseña = password_hash($_POST["pswd"], PASSWORD_BCRYPT);
    $dni = $_POST["dni"];
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tlf = $_POST["tlf"];
    $fnacimiento = $_POST["fnacimiento"];
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>