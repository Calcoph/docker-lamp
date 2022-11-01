<?php
    $titulo_libro = $_POST["titulo_libro"];
    $titulo_anterior = $_POST["titulo_anterior"];
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];

    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // modifica el capítulo
    $query = mysqli_prepare($conn, "UPDATE capitulo SET Chapter_ID = ?, Texto = ? WHERE `Book ID` = ? AND Chapter_ID = ?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ssss", $tit_cap, $tex, $tit_lib, $tit_ant);
    $tit_cap = $titulo;
    $tex = $texto;
    $tit_lib = $titulo_libro;
    $tit_ant = $titulo_anterior;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    header('Location: '."/PHP/mod_libros/modificar_libro.php/?titulo=$titulo_libro");
?>
