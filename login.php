<?php
session_start();
include 'conexao/conexao.php';

if (isset($_POST['logar'])):
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $senha = filter_var(trim($_POST['senha']), FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($email) || empty($senha)):
        return false;

    else:
        $email = mysqli_escape_string($conect, $email);
        $senha = mysqli_escape_string($conect, $senha);

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conect, $sql);

        if (mysqli_num_rows($resultado) == 1):
            $dados = mysqli_fetch_array($resultado);
            $_SESSION['logado'] = true;
            $_SESSION['user_id'] = $dados['id'];
            mysqli_close($conect);

            if (password_verify($senha, $dados['senha'])):

                if ($dados['nivel'] == 'administrador'):
                    header('Location: index.php');
                    exit();
                else:
                    header('Location: funcionario.php');
                    exit();
                endif;

            endif;

        else:
            echo "crie uma conta para se cadastrar";
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
    <title>Login</title>

    <style>
        .container {
            width: 100%;

        }

        .container form {
            width: 800px;
            margin: 100px 350px;

        }

        .btn {
            margin-top: 20px;
            margin-left: 165px;
        }

        .links {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body>

    <h2> </h2>

    <div class="container">
        <form action=" <?php echo $_SERVER['PHP_SELF']; ?> " method="post" onsubmit="return logado()">
            <div class="col-12" style="display: flex;">
                <p class="alert alert-danger" style="height: 10px; display: none;" id="mensagem"></p>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">EMAIL</label>
                <input type="email" class="form-control input" name="email" id="email">
            </div>
            <div class="col-md-6">
                <label for="senha" class="form-label">PASSWORD</label>
                <input type="password" class="form-control input" name="senha" id="senha">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary botao" name="logar">Logar</button>
            </div>
            <div class="col-md-6 links">
                <a href="#">Esqueceu a senha ?</a>
                <a href="registrar.php">Criar conta</a>
            </div>
        </form>
    </div>


    <script src="assets/js/login.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>