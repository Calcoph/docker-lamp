<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $fnacimiento = $_POST["fnacimiento"];
    $tlf = $_POST["tlf"];
    $email = $_POST["email"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["pswd"];

    $usuario_anterior = $_POST["usuario_anterior"];

    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_query($conn, "UPDATE usuario
    SET `Used ID`='$usuario', Password='$contraseña', DNI='$dni', email='$email', Nombre='$nombre', Apellidos='$apellido', Telefono='$tlf', fecha_nacimiento='$fnacimiento'
    WHERE `Used ID`='$usuario_anterior'") or die (mysqli_error($conn));
    echo $usuario_anterior;
    echo $usuario;

    // modifica el capítulo
    $query = mysqli_query($conn, "UPDATE capitulo SET Chapter_ID = '$titulo', Texto = '$texto' WHERE `Book ID` = '$titulo_libro' AND Chapter_ID = '$titulo_anterior'") or die (mysqli_error($conn));

    //header('Location: '."/index.php");
?>
