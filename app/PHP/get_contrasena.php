<?php
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }

  $query = mysqli_prepare($conn, "SELECT Password FROM usuario WHERE `Used ID`=?") or die (mysqli_error($conn));
  mysqli_stmt_bind_param($query, "s", $usuario);
  $usuario = $_GET["username"];
  mysqli_stmt_execute($query) or die (mysqli_error($conn));

  mysqli_stmt_bind_result($query, $pas);
  mysqli_stmt_fetch($query);

  // Devuelve la contreseña del usuario que intenta loguearse
  echo $pas
?>