<?php

require_once '../conexao/conexao.php';

if (isset($_POST['deletar'])):
    $id = mysqli_escape_string($conect, $_POST['id']);
    
    $sql = "DELETE FROM produtos WHERE id = '$id'";
    if (mysqli_query($conect, $sql)):
        header('Location: ../index.php?deletado_com_sucesso');
        exit();
    else:
        header('Location: ../index.php?erro_ao_deletar');
    endif;
endif;

if (isset($_POST['cancelar'])):
    header('Location: ../index.php?cancelado');
    exit();
endif;
?>