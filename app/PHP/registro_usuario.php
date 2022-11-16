<?php
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

            $pass = $_POST["pswd"];

            // Inserta el usuario y contraseña en la base de datos
            $query = mysqli_prepare($conn, "INSERT INTO usuario(`Used ID`, Password, DNI, email, Nombre, Apellidos, Telefono, fecha_nacimiento)
                                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)") or die (mysqli_error($conn));
            mysqli_stmt_bind_param($query, "ssssssss", $usuario, $contraseña, $dni, $email, $nombre, $apellido, $tlf, $fnacimiento);
            $usuario = $_POST["usuario"];
            $contraseña = password_hash($pass, PASSWORD_BCRYPT);
            $dni = $_POST["dni"];
            $email = $_POST["email"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $tlf = $_POST["tlf"];
            $fnacimiento = $_POST["fnacimiento"];
            mysqli_stmt_execute($query) or die (mysqli_error($conn));

            setcookie("username", $_POST["usuario"], time()+24*3600, "/"); // El inicio de sesión dura 24h
            setcookie("pass", $pass, time()+24*3600, "/"); // El inicio de sesión dura 24h

            // Vuelve a la página principal
            header('Location: '."/index.php");
            die();
    }
    else{
        header('Location: '."/HTML/register.html");
        die();
    }

?>