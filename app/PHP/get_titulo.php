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

  $query = mysqli_query($conn, "SELECT * FROM libro WHERE `Book ID`='$titulo'") or die (mysqli_error($conn));
  // Devuelve el título, si el libro está en la base de datos. Si no devuelve un ""
  echo mysqli_fetch_array($query)["Book ID"];
?>