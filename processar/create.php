<?php
session_start();
include '../conexao/conexao.php';

if (isset($_POST['salvar'])):
    $_SESSION['mensagem'] = array();

    $nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_var(trim($_POST['categoria']), FILTER_SANITIZE_SPECIAL_CHARS);
    $preco = filter_var(trim($_POST['preco']), FILTER_SANITIZE_NUMBER_FLOAT);
    $quantidade = filter_var(trim($_POST['quantidade']), FILTER_SANITIZE_NUMBER_INT);
    $descricao = filter_var(trim($_POST['descricao']), FILTER_SANITIZE_SPECIAL_CHARS);

    if (filter_var($preco, FILTER_VALIDATE_FLOAT) && filter_var($quantidade, FILTER_VALIDATE_INT)):
        $nome = mysqli_escape_string($conect, $nome);
        $categoria = mysqli_escape_string($conect, $categoria);
        $preco = mysqli_escape_string($conect, $preco);
        $quantidade = mysqli_escape_string($conect, $quantidade);

        $sql = "INSERT INTO produtos(nome, categoria, preco, quantidade, descricao)
        VALUES('$nome', '$categoria', '$preco', '$quantidade', '$descricao')";

        if (mysqli_query($conect, $sql)):
            $_SESSION['mensagem'] = "cadastrado com sucesso!";
            header('Location: ../index.php?');
            exit();

        else:
            $_SESSION['mensagem'] = "erro ao cadastrar";
            header('Location: ../index.php?erro_ao_cadastrar');
            exit();
            
        endif; // if para saber se cadastramos com sucesso

    else:
        echo "Verifa bem os campos numericos ";

    endif; // if da validacao
    
endif; // if do botao clicado

if (isset($_POST['fechar'])):
    header('Location: ../index.php');
    exit();
endif;

?>