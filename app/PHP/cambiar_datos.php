<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

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

    if (strlen($_POST["usuario"]) < 3) {
        die("Nombre de usuario demasiado corto");
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

    iniciar_sesion($_POST["usuario"]);

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
?>
