<?php

include_once '../conexao/conexao.php';

if (isset($_POST['actualizar'])):


    $nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_var(trim($_POST['categoria']), FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_var(trim($_POST['preco']), FILTER_SANITIZE_NUMBER_FLOAT);
    $quantidade = filter_var(trim($_POST['quantidade']), FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_var(trim($_POST['descricao']), FILTER_SANITIZE_SPECIAL_CHARS);


    $id = $_POST['id'];
    $nome = mysqli_escape_string($conect, $nome);
    $categoria = mysqli_escape_string($conect, $categoria);
    $preco = mysqli_escape_string($conect, $preco);
    $qtd = mysqli_escape_string($conect, $quantidade);
    $descricao = mysqli_escape_string($conect, $descricao);

    $sql = "UPDATE produtos SET nome = '$nome', categoria = '$categoria', preco = '$preco', quantidade = '$qtd', descricao = '$descricao'
    WHERE id = '$id'";

    if (mysqli_query($conect, $sql)):
        header('Location: ../index.php');
        exit();
    else:
        return false;
    endif;

endif; // botao adicionar (atualizar)

if (isset($_POST['cancelar'])):
    header('Location: ../index.php');
    exit();
endif;

?>