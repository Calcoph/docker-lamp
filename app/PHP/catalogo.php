<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_query($conn, "SELECT * FROM libros")
        or die (mysqli_error($conn));

    $imagen = 0;
    $titulo = 1;
    $descripcion = 2;
    while ($row = mysqli_fetch_row($query)) {
        echo
        "<tr>
        <td>{$row[$imagen]}</td>
        <td>{$row[$titulo]}</td>
        <td>{$row[$descripcion]}</td>
        </tr>";
    }
?>