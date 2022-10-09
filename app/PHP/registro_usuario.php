<?php
    $usuario = $_POST["usuario"];
    $index = str_replace('%usuario%', $usuario, file_get_contents('/var/www/html/HTML/index.html'));
    echo $index
?>