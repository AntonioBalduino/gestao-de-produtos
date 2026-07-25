<?php
session_start();
require_once 'conexao/conexao.php';

if(isset($_POST['btnRegistrar'])):

    $nome = filter_var(trim($_POST['nome']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $senha = filter_var(trim($_POST['senha']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmar = filter_var(trim($_POST['confirmar']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar)):
        return false;

    else:
        $nome = mysqli_escape_string($conect, $nome);
        $email = mysqli_escape_string($conect, $email);
        $senha = mysqli_escape_string($conect, $senha);
        $confirmar = mysqli_escape_string($conect, $confirmar);

        if (($senha == $confirmar) && filter_var($email, FILTER_VALIDATE_EMAIL) ):
            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios(nome, email, senha) VALUES('$nome', '$email', '$senha')";
            mysqli_query($conect, $sql);
            
        else:
            return false;
        endif;

    endif;

endif;


?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>registrar</title>

    <style>
        .container {
            width: 100%;

        }

        .container form {
            width: 800px;
            margin: 60px 350px;

        }

        .btn {
            margin-top: 20px;
            margin-left: 140px;
        }

        .links {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .registro {
            text-align: center;
        }
    </style>

</head>

<body>
    <h1 class="registro">PREENCHA O FORMULARIO</h1>

    <h5 id="mensagem" class="registro alert alert-danger" style="display: none;"></h5>

    <div class="container">

        <form action=" <?php echo $_SERVER['PHP_SELF']; ?> " class="formulario" method="post" onsubmit="return validarFormulario()">

            <div class="col-md-6">
                <label for="nome" class="form-label">NOME COMPLETO</label>
                <input type="text" class="form-control input" name="nome" id="nome">
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">EMAIL</label>
                <input type="text" class="form-control input" name="email" id="email">
            </div>

            <div class="col-md-6">
                <label for="senha" class="form-label">PASSWORD</label>
                <input type="password" class="form-control input" name="senha" id="senha">
            </div>

            <div class="col-md-6">
                <label for="confirmar" class="form-label">CONFRIMAR PASSWORD</label>
                <input type="password" class="form-control input" name="confirmar" id="confirmar">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary botao botaoRegistrar" name="btnRegistrar" id="registrar">REGISTRAR-SE</button>
            </div>
            <div class="col-md-6 links">
                <a href="login.php">Iniciar sessão</a>
            </div>
        </form>
    </div>




    <script src="assets/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

</body>

</html>