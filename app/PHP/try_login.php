<?php
    require "tokens.php";

    if (!comprobar_token_csrf($_POST["_token"])) {
        echo "Ha habido un error interno (E9013), pruebe más tarde";
        die();
    }

    $user = htmlspecialchars($_POST["usuario"]);
    $pass = $_POST["pswd"];

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $query = mysqli_prepare($conn, "SELECT Password , Intentos FROM usuario WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $us);
    $us = $user;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
    mysqli_stmt_bind_result($query, $pass_correcta, $intentos);
    mysqli_stmt_fetch($query);
    mysqli_close($conn);
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    if (password_verify($pass, $pass_correcta)) {
        iniciar_sesion($user);
        mysqli_close($conn);
            $conn = mysqli_connect($hostname,$username,$password,$db);
            if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
            }
            $query3=mysqli_prepare($conn,"INSERT INTO `log`( `Used ID`, `Text`, `Fecha_creacion` ) VALUES (?,?,?)") or die (mysqli_error($conn));
            mysqli_stmt_bind_param($query3, "sss", $us, $texto, $dateact);
            $date = time();
            $dateact=date("Y-m-d G:i:s", $date);
            $texto="Inicio de sesión correcto";
            mysqli_stmt_execute($query3) or die (mysqli_error($conn));
            header('Location: '."/index.php");
            die();
    } else {
        $pagina = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/inicio_sesion_fallido.html'));
        $csrf = obtener_token_csrf();
        mysqli_close($conn);
        $conn = mysqli_connect($hostname,$username,$password,$db);
            if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
            }
            $query3=mysqli_prepare($conn,"INSERT INTO `log`( `Used ID`, `Text`, `Fecha_creacion` ) VALUES (?,?,?)") or die (mysqli_error($conn));
            mysqli_stmt_bind_param($query3, "sss", $us, $texto, $dateact);
            $date = time();
            $dateact=date("Y-m-d G:i:s", $date);
            $texto="Intento de inicio de sesión";
            mysqli_stmt_execute($query3) or die (mysqli_error($conn));
            $pagina  = str_replace('%nonce%', $csrf, $pagina);
            echo $pagina;
            die();
    }

?>
