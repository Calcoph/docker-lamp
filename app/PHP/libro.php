<?php
    $hostname = "db";
    $username = "admin";
    $password = "test";
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $titulo = $_GET["titulo"];

    $query = mysqli_query($conn, "SELECT * FROM libro WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));
    
    // el libro en sí
    $imagen = 2;
    $titulo_ = 0;
    $nota = 1;
    while ($row = mysqli_fetch_row($query)) {
        echo
        "<tr>
        <td>{$row[$imagen]}</td>
        <td>{$row[$titulo_]}</td>
        <td>{$row[$nota]}</td>
        </tr>";
    }

    $query = mysqli_query($conn, "SELECT * FROM capitulo WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    // capitulos
    while ($row = mysqli_fetch_assoc($query)) {
        echo
        "<tr>
        <td>{$row["Chapter_ID"]}</td>
        <td>{$row["Book ID"]}</td>
        <td>{$row["Chapter num"]}</td>
        <td>{$row["Texto"]}</td>
        </tr>";
    }

    // Los comentarios
    $query = mysqli_query($conn, "SELECT * FROM `comentario libro` WHERE `Book ID`='$titulo'")
        or die (mysqli_error($conn));

    while ($row = mysqli_fetch_assoc($query)) {
        echo
        "<tr>
        <td>{$row["nombre comentarista"]}</td>
        <td>{$row["fecha"]}</td>
        <td>{$row["comentario"]}</td>
        </tr>";
    }   
?>