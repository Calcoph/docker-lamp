<?php
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }

  $query = mysqli_prepare($conn, "SELECT `Book ID` FROM libro WHERE `Book ID`=?") or die (mysqli_error($conn));
  mysqli_stmt_bind_param($query, "s", $titulo);
  $titulo = $_GET["titulo"];
  mysqli_stmt_execute($query) or die (mysqli_error($conn));

  mysqli_stmt_bind_result($query, $titulo_libro);
  mysqli_stmt_fetch($query);

  // Devuelve el título, si el libro está en la base de datos. Si no devuelve un ""
  echo $titulo_libro
?>