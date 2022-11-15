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

    $token = random_bytes(32);
    $expira = time()+12*3600; // Las sesiones duran 12 horas

    $query = mysqli_prepare($conn, "INSERT INTO session_tokens(token, fecha_validez)
                                            VALUES (?, ?)") or die (mysqli_error($conn));
    mysqli_stmt_bind_param($query, "ss", $tok, $expira_date);
    $tok = $token;
    $expira_date = date("Y-m-d G:i:s", $expira);
    mysqli_stmt_execute($query) or die (mysqli_error($conn));

    setcookie("session", $token, $expira, "/");
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
    $tok = $token;
    mysqli_stmt_execute($query) or die (mysqli_error($conn));
}
function comprobar_token_sesion() {
    // TODO
}
function otorgar_token_csrf() {
    if (!sesion_valida()) {
        otorgar_token_sesion();
    }
}
function comprobar_token_csrf() {
    // TODO
}

function sesion_valida() {
    $valida = isset($_COOKIE["session"]);
    if ($valida) {
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