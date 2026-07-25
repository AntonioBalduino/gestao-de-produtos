<?php

$servername = 'localhost';
$user = 'root';
$senha = '';
$db_name = 'crud_produtos';

$conect = mysqli_connect($servername, $user, $senha, $db_name);

if (mysqli_connect_error()):
    echo "erro ao se comunicar " . mysqli_connect_error();
else:
    return true;
endif;

mysqli_set_charset($conect, "utf8mb4");

?>