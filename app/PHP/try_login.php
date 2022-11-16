<?php
    require "tokens.php";

    if (!comprobar_token_csrf($_POST["nonce"])) {
        echo "Ha habido un error interno (E9013), pruebe más tarde";
        die();
    }

    $user = $_POST["usuario"];
    $pass = $_POST["pswd"];

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $query = mysqli_prepare($conn, "SELECT Password FROM usuario WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $us);
    $us = $user;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $pass_correcta);
    mysqli_stmt_fetch($query);
    if (password_verify($pass, $pass_correcta)) {
        header('Location: '."/index.php");
        setcookie("username", $user, time()+30*24*60*60, "/");
        setcookie("pass", $pass, time()+30*24*60*60, "/");
        die();
    } else {
        $pagina = str_replace('%usuario%', $user, file_get_contents('/var/www/html/HTML/inicio_sesion_fallido.html'));
        $csrf = obtener_token_csrf();
        $pagina  = str_replace('%nonce%', $csrf, $pagina);
        echo $pagina;
    }
?>
