<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // TODO: Verificar la sesión

    if (!preg_match("/[a-zA-z]+/", $_POST["nombre"])) {
        die("Nombre no válido");
    }

    if (!preg_match("/[a-zA-z]+/", $_POST["apellido"])) {
        die("Apellido no válido");
    }

    // TODO: validar DNI

    // TODO: Validar fecha

    if (!preg_match("/[0-9]{9}/", $_POST["tlf"])) {
        die("Teléfono no válido");
    }

    if (!preg_match("/\S+@\S+\.\S+/", $_POST["email"])) {
        die("Email no válido");
    }

    if (strlen($_POST["pswd"]) < 3) {
        die("Contraseña demasiado corta");
    }

    if (strlen($_POST["usuario"]) < 3) {
        die("Nombre de usuario demasiado corto");
    }

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_prepare($conn, "UPDATE usuario
                                    SET `Used ID`=?, Password=?, DNI=?, email=?, Nombre=?, Apellidos=?, Telefono=?, fecha_nacimiento=?
                                    WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "sssssssss", $usuario, $contraseña, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento, $usuario_anterior);
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["pswd"];
    $dni = $_POST["dni"];
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $tlf = $_POST["tlf"];
    $fnacimiento = $_POST["fnacimiento"];
    $usuario_anterior = $_POST["usuario_anterior"];
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>
