<?php
session_start();
require_once 'conexao/conexao.php';

if (!$_SESSION['logado']):
    header('Location: login.php');
endif;


$id = $_SESSION['user_id'];

$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($conect, $sql);
$dados = mysqli_fetch_array($resultado);

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


    <title>Sistema de Crud</title>

    <style>
        .links {
            width: 80%;
            /*background-color: darkblue;*/
        }

        .menu ul a {
            width: 300px;
            text-align: start;
        }

        .menu ul a:hover {
            background-color: lightgray;
            transition: 1s;
        }

        header nav .cont {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-primary mb-5 ">

            <div class="container-fluid cont">

                <!-- OFF CANVAS PARA SIDEBAR -->
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    MENU
                </button>



                <div class="collapse navbar-collapse me-auto mb-2 mb-lg-0">
                    <ul class="navbar-nav ">

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Notificações
                                <span class="badge text-bg-secondary bg-danger">4</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"> Perfil </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Minha conta</a></li>
                                <li><a class="dropdown-item" href="#">Configurações</a></li>
                                <li><a class="dropdown-item" href="processar/logout.php">Sair</a></li>

                            </ul>
                        </li>
                    </ul>

                </div>

                <div>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-success" type="submit">Pesquisar</button>
                    </form>
                </div>

            </div>
        </nav>
    </header>




    <h1 class="text-center" style="margin: 20px auto;">Sistema CRUD - Produtos</h1>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center">

                <h3>Sistema CRUD - Produtos</h3>
                
            </div>

        </div>

        <!-- OFF CANVAS PARA SIDEBAR -->
        <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

            <h3 class="offcanvas-title ml-5" id="offcanvasExampleLabel" style="margin: 15px 20px;">MENU PRINCIPAL</h3>
            <h4 class="offcanvas-title ml-5" id="offcanvasExampleLabel" style="margin: 15px 20px;">
                <?php echo $dados['nome']; ?>
            </h4>

            <div class="offcanvas-body links">

                <div class="menu">
                    <ul class="navbar-nav">
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-bar-chart-line-fill"></i> Dashboard</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-layers"></i>
                                Catálogo de produtos</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-diagram-3"></i> Categória</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-box-seam"></i>
                                Gestão de estoque</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-truck"></i>
                                Fornecedores</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-arrow-left-right"></i>
                                Movimentações</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-tag"></i>
                                Promoções</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-bar-chart"></i>
                                Relatórios</a></li>
                        <li><a class="btn  mb-1" href="#"> <i class="bi bi-gear"></i> Configurações</a></li>
                        <li style="width: 100%;">
                            <hr>
                        </li>
                        <li><a class="btn alert alert-danger mb-1" href="processar/logout.php"> <i class="bi bi-box-arrow-right"></i>
                                Terminar Sessão</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preco</th>
                    <th>Quantidade</th>
                    <th>Descrição</th>
                    <th>Data de Criação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM produtos";
                $resultados = mysqli_query($conect, $sql);
                //Pegando os dados de um arrya para mostrar os usuarios cadastrados
                while ($dados = mysqli_fetch_assoc($resultados)): ?>

                    <tr>
                        <td><?php echo $dados['nome']; ?></td>
                        <td><?php echo $dados['categoria']; ?></td>
                        <td><?php echo $dados['preco']; ?> kz</td>
                        <td><?php echo $dados['quantidade']; ?></td>
                        <td><?php echo $dados['descricao']; ?></td>
                        <td><?php echo $dados['criado_em']; ?></td>
                    </tr>    
                   
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>



    <!--IMPORTADO DO BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>