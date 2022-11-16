<?php
    require "tokens.php";
    $csrf = obtener_token_csrf();
    echo str_replace('%nonce%', $csrf, file_get_contents('/var/www/html/HTML/register.html'));
?>