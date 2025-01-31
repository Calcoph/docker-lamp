<?php
    require "../login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    login();

    if (!comprobar_token_csrf($_POST["_token"])) {
        echo "Ha habido un error interno (E9013), pruebe más tarde";
        die();
    }

    // La carpeta donde se van a guardar los archivos
    $target_dir = "/var/www/html/uploads/";
    // La dirección que se ve desde el html (para insertar las imágenes luego)
    $save_path = "/uploads/";
    $titulo_libro = htmlspecialchars($_POST["titulo_libro"]);

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "SELECT `Chapter Num` FROM capitulo WHERE `Book ID`=? ORDER BY `Chapter Num` DESC") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "s", $tit);
    $tit = $titulo_libro;
    mysqli_stmt_execute($query) or die ("Error interno E890");

    mysqli_stmt_bind_result($query, $cap);
    mysqli_stmt_fetch($query);
    $cap = $cap + 1;

    // Almacena el capítulo
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }
    $query = mysqli_prepare($conn, "INSERT INTO capitulo(Chapter_ID, `Book ID`, `Chapter Num`, Texto) VALUES (?, ?, ?, ?)") or die ("Error interno E890");
    mysqli_stmt_bind_param($query, "ssis", $titulo, $b_id, $c_num, $texto);
    $titulo = htmlspecialchars($_POST["titulo"]);
    $b_id = $titulo_libro;
    $c_num = $cap;
    $texto = htmlspecialchars($_POST["texto"]);
    mysqli_stmt_execute($query) or die ("Error interno E890");

    if ($_POST['boton'] == "solo_publicar") {
        // Vuelve a la página principal
        header('Location: '."/index.php");
        die();
      } else {
        // Sigue añadiendo capítulos
        header('Location: '."/PHP/mod_libros/nuevo_capitulo.php/?titulo=$titulo_libro");
        die();
    }
?>
