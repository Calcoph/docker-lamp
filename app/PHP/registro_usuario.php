<?php
    require "tokens.php";

    if (!comprobar_token_csrf($_POST["_token"])) {
        echo "Ha habido un error interno (E9013), pruebe más tarde";
        die();
    }

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";

    $conn = mysqli_connect($hostname,$username,$password,$db);
    //captcha
    if ($_POST['g-recaptcha-response'] == '') {
        } 
        else {
        $obj = new stdClass();
        $obj->secret = "6LezvhAjAAAAADFY-zfZ4cj2v6Rj3JWRe0JBhAXc";
        $obj->response = $_POST['g-recaptcha-response'];
        $obj->remoteip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        
        $options = array(
        'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($obj)
        )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        $validar = json_decode($result);}
        
        /* FIN DE CAPTCHA */
        
        if ($validar->success) { 

            if ($conn->connect_error) {
                die("Database connection failed: " . $conn->connect_error);
            }

            if (!preg_match("/[a-zA-z]+/", $_POST["nombre"])) {
                die("Nombre no válido");
            }

            if (!preg_match("/[a-zA-z]+/", $_POST["apellido"])) {
                die("Apellido no válido");
            }

            // TODO: validar DNI

            // TODO: Validar fecha

            if (!preg_match("/[0-9]{9}/", $_POST["tlf"])) {
                die("Teléfono no válido");
            }

            if (!preg_match("/\S+@\S+\.\S+/", $_POST["email"])) {
                die("Email no válido");
            }

            if (strlen($_POST["pswd"]) < 6) {
                die("Contraseña demasiado corta");
            }
            if (!(preg_match("/([a-z].*[A-Z])|([A-Z].*[a-z])/", $_POST["pswd"]))){
                die("Error, la contraseña debe de tener al menos una mayúscula y una minúscula");
            }
            if (!(preg_match("/([a-zA-Z])/", $_POST["pswd"])) || !(preg_match("/([0-9])/", $_POST["pswd"]))){
                die("Error, la contraseña debe contener al menos un número");
            }
            if (!preg_match("/([!,%,&,@,#,$,^,*,?,_,~])/", $_POST["pswd"])){
                die("Error, No hay un caracter especial");
            }

            if (strlen($_POST["usuario"]) < 3) {
                die("Nombre de usuario demasiado corto");
            }
            $key = file_get_contents('/var/encr_pswd.txt');
            $pass = $_POST["pswd"];
            // Inserta el usuario y contraseña en la base de datos
            $query = mysqli_prepare($conn, "INSERT INTO usuario(`Used ID`, Password, DNI, email, Nombre, Apellidos, Telefono, fecha_nacimiento)
                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die (mysqli_error($conn));
            mysqli_stmt_bind_param($query, "ssssssss", $usuario, $contraseña, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento);
            $dni = encryptthis ($_POST["dni"], $key);
            $email = encryptthis ($_POST["email"], $key);
            $nombre = encryptthis ($_POST["nombre"], $key);
            $apellido = encryptthis ($_POST["apellido"], $key);
            $tlf = encryptthis ($_POST["tlf"], $key);
            $contraseña = password_hash($pass, PASSWORD_BCRYPT);
            $usuario = htmlspecialchars($_POST["usuario"]);
            $dni = htmlspecialchars($dni);
            $nombre = htmlspecialchars($nombre);
            $apellido = htmlspecialchars($apellido);
            $tlf = htmlspecialchars( $tlf);
            $fnacimiento = htmlspecialchars($_POST["fnacimiento"]);
            mysqli_stmt_execute($query) or die (mysqli_error($conn));

            iniciar_sesion($_POST["usuario"]);

            // Vuelve a la página principal
            header('Location: '."/index.php");
            die();
    }
    else{
        header('Location: '."/PHP/register.php");
        die();
    }
    //Codigo obtenido de https://www.youtube.com/watch?v=I3GFDG_cCTY
        function encryptthis ($data, $key){
            $encryption_key = base64_decode(openssl_cipher_iv_length('aes-256-cbc'));
            $iv = openssl_random_pseudo_bytes(16);
            $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
            $r = $encrypted. '::' . $iv;
            return base64_encode($r);
 }
    




?>