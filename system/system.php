<?php
    $hostname = "localhost";
    $login = "root";
    $senha = "";
    $database = "login";

    $connect = mysqli_connect($hostname, $login, $senha, $database);

    if(mysqli_connect_error()):
        echo "Error: falha ao conectar-se ao banco de dados ".mysqli_connect_error();
    endif;
?>