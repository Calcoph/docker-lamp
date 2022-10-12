<?php
  $hostname = "db";
  $username = "admin";
  $password = "test";
  $db = "database";

  $conn = mysqli_connect($hostname,$username,$password,$db);
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
  $usuario = $_GET["username"];

  $query = mysqli_query($conn, "SELECT * FROM usuario WHERE `Used ID`='$usuario'") or die (mysqli_error($conn));
  // Devuelve la contreseña del usuario que intenta loguearse
  echo mysqli_fetch_array($query)["Password"];
?>