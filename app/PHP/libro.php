<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }


    $query = mysqli_query($conn, "SELECT * FROM libros WHERE titulo=$titulo")
        or die (mysqli_error($conn));

    // el libro en sí
    $imagen = 0;
    $titulo = 1;
    $descripcion = 2;
    $contenido = 3;
    while ($row = mysqli_fetch_row($query)) {
        echo
        "<tr>
        <td>{$row[$imagen]}</td>
        <td>{$row[$titulo]}</td>
        <td>{$row[$descripcion]}</td>
        <td>{$row[$contenido]}</td>
        </tr>";
    }

    // Los comentarios
    $query = mysqli_query($conn, "SELECT * FROM comentarios WHERE titulo=$titulo")
        or die (mysqli_error($conn));

    while ($row = mysqli_fetch_array($query)) {
        echo
        "<tr>
        <td>{$row["nombre comentarista"]}</td>
        <td>{$row["fecha"]}</td>
        <td>{$row["comentario"]}</td>
        </tr>";
    }   
?>