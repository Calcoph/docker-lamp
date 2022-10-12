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

    $username = $_COOKIE["username"];
    $titulo = $_POST["titulo"];
    $comentario = $_POST["comentario_nuevo"];

    $query = mysqli_query($conn, "SELECT `Comentario ID` FROM `comentario libro`") or die (mysqli_error($conn));
    $max_id = 0;
    while ($row = mysqli_fetch_row($query)) {
        $id = intval($row[0]);
        if ($id > $max_id) {
            $max_id = $id;
        }
    }

    $query = mysqli_query($conn, "INSERT INTO `comentario libro`(`Comentario ID`, `User ID`, `Book ID`, `Texto`) VALUES ($max_id+1, '$username', '$titulo', '$comentario')") or die (mysqli_error($conn));

    $_GET["titulo"] = $titulo; // libro.php espera leer el titulo de _GET
    include "libro.php";
  } else {
    // Si no está logueado no puede publicar un comentario
    include "inicio_sesion.php";
  }
?>