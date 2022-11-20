<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $us = login();

    if (!comprobar_token_csrf($_POST["_token"])) {
        echo "Ha habido un error interno (E9013), pruebe más tarde";
        die();
    }

    // La carpeta donde se van a guardar los archivos
    $target_dir = "/var/www/html/uploads/";
    // La dirección que se ve desde el html (para insertar las imágenes luego)
    $save_path = "/uploads/";
    $titulo = htmlspecialchars($_POST["titulo"]);
    $target_file = $target_dir . basename($_FILES["portada_personalizada"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_FILES["portada_personalizada"]) && $target_file!='/var/www/html/uploads/'){
        $save_path = $save_path . basename($_FILES["portada_personalizada"]["name"]);
        $check = getimagesize($_FILES["portada_personalizada"]["tmp_name"]);
        if($check !== false) {
          $uploadOk = 1;
        } else {
           $razon='No es una imagen.'; 
          $uploadOk = 0;
        }

      
      // Check if file already exists
      if (file_exists($target_file)) {
        $razon=$razon . 'el fichero ya existe';
        $uploadOk = 2;
      }
      
      // Check file size
      if ($_FILES["portada_personalizada"]["size"] > 500000) {
        $razon=$razon . 'Fichero demasiado grande';
        $uploadOk = 0;
      }
      
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        $razon=$razon . 'Solo se aceptan jpg, png, jpeg y gif.';
        $uploadOk = 0;
      }
      
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $csrf = obtener_token_csrf();
          $header = str_replace('%usuario%', $us, file_get_contents('/var/www/html/HTML/header_small.html')); 
          $descripcion = htmlspecialchars($_POST["descripcion"]);
          $resumen = htmlspecialchars($_POST["resumen"]);
          $texto = htmlspecialchars($_POST["texto"]);
          $pagina = str_replace('%titulo%', $titulo, file_get_contents('/var/www/html/HTML/publicar_libro_fallido.html'));
          $pagina = str_replace('%header%', $header,$pagina);
          $pagina = str_replace('%descripcion%',$descripcion,$pagina);
          $pagina = str_replace('%resumen%',$resumen,$pagina);
          $pagina = str_replace('%texto%',$texto,$pagina);
          $pagina = str_replace('%scpt%', "<script>
            window.alert('$razon')
            </script>", $pagina);
            $pagina  = str_replace('%nonce%', $csrf, $pagina);
            echo($pagina);
          die();
      // if everything is ok, try to upload file
      } else {
        if ($uploadOk==2) {
        } 
        else{
          move_uploaded_file($_FILES["portada_personalizada"]["tmp_name"], $target_file);
        }
      }
    }
      else {
        // Si ha elegido una portada predefinida, solo guardamos la elección en la base de datos
        $target_file = $target_dir . htmlspecialchars($_POST["portada"]) . ".png";
        $save_path = $save_path . htmlspecialchars($_POST["portada"]) . ".png";
    }


    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    
    
    // Almacena el libro
    $query = mysqli_prepare($conn, "INSERT INTO libro(`Book ID`, imglink, Text_corto, Text_largo, Prologue) VALUES (?, ?, ?, ?, ?)") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "sssss", $tit, $s_p, $descripcion, $resumen, $texto);
    $tit = $titulo;
    $s_p =$save_path;
    $descripcion = htmlspecialchars($_POST["descripcion"]);
    $resumen = htmlspecialchars($_POST["resumen"]);
    $texto = htmlspecialchars($_POST["texto"]);
    mysqli_stmt_execute($query) or die ("Error interno E890");

    // Almacena quien lo ha publicado
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "INSERT INTO escritos(`Book ID`, `Used ID`) VALUES (?, ?)") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "ss", $tit, $user);
    $tit = $titulo;
    $user = $us;
    mysqli_stmt_execute($query) or die ("Error interno E890");

    if ($_POST['boton'] == "solo_publicar") {
        // Vuelve a la página principal
        header('Location: '."/index.php");
        die();
      } else {
        // Sigue añadiendo capítulos
        header('Location: '."/PHP/mod_libros/nuevo_capitulo.php/?titulo=$titulo");
        die();
    }
?>
