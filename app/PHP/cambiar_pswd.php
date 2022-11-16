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
    if (!(preg_match("/([a-z].*[A-Z])|([A-Z].*[a-z])/", $_POST["pswd"]))){
        die("Error, la contraseña debe de tener al menos una mayúscula y una minúscula");
    }
    if (!(preg_match("/([a-zA-Z])/", $_POST["pswd"])) || !(preg_match("/([0-9])/", $_POST["pswd"]))){
        die("Error, la contraseña debe contener al menos un número");
    }
    if (!preg_match("/([!,%,&,@,#,$,^,*,?,_,~])/", $_POST["pswd"])){
        die("Error, No hay un caracter especial");
    }
    // Inserta el usuario y contraseña en la base de datos
    $query = mysqli_prepare($conn, "UPDATE usuario
                                    SET Password=?
                                    WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ss", $contraseña, $usuario_anterior);
    $contraseña = password_hash($_POST["pswd"], PASSWORD_BCRYPT);
    $usuario_anterior = $_POST["usuario_anterior"]; 
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
    // Vuelve a la página principal
    header('Location: '."/index.php");
    die();
