<?php
function login() {
    $user = htmlspecialchars($_COOKIE["username"]);
    $pass = $_COOKIE["pass"];

    $hostname = "db";
    $username = "admin";
    $password = "test";
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
        return true;
    } else {
        header('Location: '."/HTML/inicio_sesion.html");
        die();
    }
}
?>