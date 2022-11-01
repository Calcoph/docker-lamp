<?php
    // Si está logueado, tiene la cookie "username"
  if (isset($_COOKIE["username"])) {
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $user = $_COOKIE["username"];
    $titulo = $_POST["titulo"];
    $comentario = $_POST["comentario_nuevo"];

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
    mysqli_stmt_bind_param($query, "isss", $m_id, $us, $tit, $comen);
    $m_id = $max_id + 1;
    $us = $user;
    $tit = $titulo;
    $comen = $comentario;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    header('Location: '."/PHP/libro.php/?titulo=$titulo");
    die();
  } else {
    // Si no está logueado no puede publicar un comentario
    header('Location: '."/PHP/inicio_sesion.php");
    die();
  }
?>