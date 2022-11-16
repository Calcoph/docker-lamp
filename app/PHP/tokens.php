<?php
function otorgar_token_sesion() {
    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $token = bin2hex(random_bytes(32));
    $expira = time()+12*3600;

    $query = mysqli_prepare($conn, "INSERT INTO session_tokens(token, fecha_validez)
                                            VALUES (?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ss", $tok, $expira_date);
    $tok = $token;
    $expira_date = date("Y-m-d G:i:s", $expira);
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    setcookie("session", $token, $expira, "/");
    $_COOKIE["session"] = $token;
}

function iniciar_sesion($usuario) {
    if (!sesion_valida()) {
        otorgar_token_sesion();
    }

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = mysqli_prepare($conn, "UPDATE session_tokens
                                    SET user_id=?
                                    WHERE token=?") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ss", $us, $tok);
    $us = $usuario;
    $tok = $_COOKIE["session"];
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
}

function cerrar_sesion() {
    if (isset($_COOKIE["session"])) {
        $hostname = "db";
        $username = "admin";
        $password = file_get_contents('/var/db_pass.txt');
        $db = "database";
        $conn = mysqli_connect($hostname,$username,$password,$db);
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }
    
        $query = mysqli_prepare($conn, "DELETE FROM session_tokens
                                        WHERE token=?") or die (mysqli_error($conn));
        mysqli_stmt_bind_param($query, "s", $tok);
        $tok = $_COOKIE["session"];
        mysqli_stmt_execute($query) or die (mysqli_error($conn));

        unset($_COOKIE['session']); 
        setcookie('session', null, -1, '/'); 
    }
}

function obtener_token_csrf() {
    if (!sesion_valida()) {
        otorgar_token_sesion();
    }

    $hostname = "db";
    $username = "admin";
    $password = file_get_contents('/var/db_pass.txt');
    $db = "database";
    $conn = mysqli_connect($hostname,$username,$password,$db);
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $token = bin2hex(random_bytes(32));
    $query = mysqli_prepare($conn, "INSERT INTO csrf_tokens(token, session, fecha_validez)
                                            VALUES (?, ?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "sss", $tok, $ses, $expira_date);
    $tok = $token;
    $ses = $_COOKIE["session"];
    $expira_date = date("Y-m-d G:i:s", time()+1*3600); // Los tokens csrf duran 1 hora
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    return $token;
}
function comprobar_token_csrf($token) {
    if ($token == NULL) {
        return false;
    }

    if ($token == "") {
        return false;
    }

    if (sesion_valida()) {
        $hostname = "db";
        $username = "admin";
        $password = file_get_contents('/var/db_pass.txt');
        $db = "database";
        $conn = mysqli_connect($hostname,$username,$password,$db);
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $query = mysqli_prepare($conn, "SELECT token, `session`, fecha_validez FROM csrf_tokens WHERE token=?") or die (mysqli_error($conn));
        mysqli_stmt_bind_param($query, "s", $tok);
        $tok = $token;
        mysqli_stmt_execute($query) or die (mysqli_error($conn));
    
        mysqli_stmt_bind_result($query, $tok2, $session, $expira);
        mysqli_stmt_fetch($query);
    
        if ($tok2 == $token) {
            $expira = strtotime($expira);
            if ($expira > time()) {
                return $session == $_COOKIE["session"];
            } else {
                return false;
            };
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function sesion_valida() {
    if (isset($_COOKIE["session"])) {
        $hostname = "db";
        $username = "admin";
        $password = file_get_contents('/var/db_pass.txt');
        $db = "database";
        $conn = mysqli_connect($hostname,$username,$password,$db);
        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        $query = mysqli_prepare($conn, "SELECT token, fecha_validez FROM session_tokens WHERE token=?") or die (mysqli_error($conn));
        mysqli_stmt_bind_param($query, "s", $token);
        $token = $_COOKIE["session"];
        mysqli_stmt_execute($query) or die (mysqli_error($conn));

        mysqli_stmt_bind_result($query, $tok, $expira);
        mysqli_stmt_fetch($query);
        if ($tok == $token) {
            $expira = strtotime($expira);
            return $expira > time();
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>