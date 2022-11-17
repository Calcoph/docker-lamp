<?php
    require "login.php";

    // Nos aseguramos de que los datos del login son correctos antes de continuar.
    $us = login();

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $pagina = file_get_contents('/var/www/html/HTML/cambiar_datos.html');
    $csrf = obtener_token_csrf();
    $pagina  = str_replace('%nonce%', $csrf, $pagina);
    $key = file_get_contents('/var/encr_pswd.txt');
    $query = mysqli_prepare($conn, "SELECT Nombre, Apellidos, DNI, fecha_nacimiento, Telefono, email, `Used ID`, Password FROM usuario WHERE `Used ID`=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "s", $user);
    $user = $us;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    mysqli_stmt_bind_result($query, $nombre, $apellidos, $dni, $f_nacimiento, $tlf, $email, $uid, $pswd);
    mysqli_stmt_fetch($query);
    $nombre = decryptthis ($nombre, $key);
    // Inserta los datos actuales del usuario en la página
    $pagina  = str_replace('%nombre%', $nombre, $pagina);
    $pagina  = str_replace('%apellido%',decryptthis ($apellidos, $key) , $pagina);
    $pagina  = str_replace('%dni%', decryptthis ($dni, $key), $pagina);
    $pagina  = str_replace('%fnacimiento%',$f_nacimiento, $pagina);
    $pagina  = str_replace('%tlf%',decryptthis ($tlf, $key) , $pagina);
    $pagina  = str_replace('%email%',decryptthis ($email, $key) , $pagina);
    $pagina  = str_replace('%usuario%', $uid, $pagina);
    $pagina  = str_replace('%pswd%',decryptthis ($pswd, $key) , $pagina);

    echo $pagina;

    function decryptthis($data, $key){
        $encryption_key = base64_decode(openssl_cipher_iv_length('aes-256-cbc'));
        $info= base64_decode($data);
        list($encrypted_data, $iv) = explode ('::', $info);
        $resultado = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return $resultado;
    }   
?>