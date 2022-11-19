<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $us = login();

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
    $dni = encryptthis ($_POST["dni"], $key);
    $email = encryptthis ($_POST["email"], $key);
    $nombre = encryptthis ($_POST["nombre"], $key);
    $apellido = encryptthis ($_POST["apellido"], $key);
    $tlf = encryptthis ($_POST["tlf"], $key);
    $usuario = htmlspecialchars($_POST["usuario"]);
    $dni = htmlspecialchars($dni);
    $nombre = htmlspecialchars($nombre);
    $apellido = htmlspecialchars($apellido);
    $tlf = htmlspecialchars( $tlf);
    $fnacimiento = htmlspecialchars($_POST["fnacimiento"]);
    $usuario_anterior = $us;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    iniciar_sesion($_POST["usuario"]);

    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
    function encryptthis ($data, $key){
        $encryption_key = base64_decode(openssl_cipher_iv_length('aes-256-cbc'));
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        $r = $encrypted. '::' . $iv;
        return base64_encode($r);
}
?>
