<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $us = login();

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = htmlspecialchars($_POST["titulo"]);

    $query = mysqli_prepare($conn, "SELECT `Comentario ID` FROM `comentario libro`") or die (mysqli_error($conn));
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $c_id);

    $max_id = 0;
    while (mysqli_stmt_fetch($query)) {
        $id = intval($c_id);
        if ($id > $max_id) {
            $max_id = $id;
        }
    }

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "INSERT INTO `comentario libro`(`Comentario ID`, `User ID`, `Book ID`, `Texto`) VALUES (?, ?, ?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "isss", $m_id, $user, $tit, $comentario);
    $m_id = $max_id + 1;
    $user = $us;
    $tit = $titulo;
    $comentario = htmlspecialchars($_POST["comentario_nuevo"]);
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    header('Location: '."/PHP/libro.php/?titulo=$titulo");
    die();
?>