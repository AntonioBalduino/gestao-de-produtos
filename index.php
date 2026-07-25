<?php
session_start();
include_once 'conexao/conexao.php';



if (!$_SESSION['logado']):
    header('Location: login.php');
endif;

// verificar o ususario

$id = $_SESSION['user_id'];
$sql = "SELECT * FROM usuarios WHERE id = '$id' ";
$resultados = mysqli_query($conect, $sql);
$dados = mysqli_fetch_array($resultados);


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
    <div class="container" style="display: flex; justify-content:center;">
        <div class="alert alert-success">
            <?php
            if (!empty($_SESSION['mensagem'])):
                echo  $_SESSION['mensagem'];
                unset($_SESSION['mensagem']);
            endif;
            ?>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

                <h3>Sistema CRUD - Produtos</h3>
                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAdicionar">
                    <i class="bi bi-plus-circle"></i> Adicionar Produto</button>
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
                    <th>Acções</th>
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

                        <td>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditar<?php echo $dados['id']; ?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeletar<?php echo $dados['id']; ?>">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- MODAL PARA EDITAR OS DADOS -->

                    <div class="modal fade" id="modalEditar<?php echo $dados['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-white">
                                    <h5> <i class="bi bi-pencil-square"></i> Editar Produto</h5>
                                    <button class="btn-close bg-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="processar/update.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">

                                        <input type="text" class="form-control mb-2" name="nome" placeholder="nome do produto" value="<?php echo $dados['nome']; ?>">
                                        <input type="text" class="form-control mb-2" name="categoria" placeholder="categoria do produto" value="<?php echo $dados['categoria']; ?>">
                                        <input type="number" class="form-control mb-2" name="preco" placeholder="preco do produto" value="<?php echo $dados['preco']; ?>">
                                        <input type="number" class="form-control mb-2" name="quantidade" placeholder="quantidade de produto" value="<?php echo $dados['quantidade']; ?>">

                                        <textarea name="descricao" class="form-control mb-2"
                                            placeholder="breve descricao do produto" value="<?php echo $dados['descricao']; ?>"> <?php echo $dados['descricao']; ?>

                                        </textarea>

                                        <div class="modal-footer bg-warning text-white">
                                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="cancelar">Cancelar</button>
                                            <button type="submit" class="btn btn-success" name="actualizar">Update</button>
                                        </div>

                                    </form>
                                </div>



                            </div>
                        </div>
                    </div>


                    <!-- MODAL PARA EXCLUIR OS DADOS -->

                    <div class="modal fade" id="modalDeletar<?php echo $dados['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5> <i class="bi bi-trash-fill"></i> Deletar Produto</h5>
                                    <button class="btn-close bg-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h5>tem a certeza de que quer deletar esse produto,
                                        <span style="color: blue;"><?php echo $dados['nome']; ?></span> ?
                                    </h5>
                                </div>

                                <div class="modal-footer bg-danger text-white">
                                    <form action="processar/delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
                                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="cancelar">Cancelar</button>
                                        <button type="submit" class="btn btn-success" name="deletar">Excluir</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>


    <!-- MODAL PARA ADICIONAR DADOS -->
    <div class="modal fade" id="modalAdicionar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5> <i class="bi bi-plus-circle"></i> Adicionar Produto</h5>
                    <button class="btn-close bg-white text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="processar/create.php" method="post" onsubmit="return enviado()">
                        <input type="text" class="form-control mb-2" name="nome" id="nome" placeholder="nome do produto">
                        <input type="text" class="form-control mb-2" name="categoria" id="categoria" placeholder="categoria do produto">
                        <input type="number" class="form-control mb-2" name="preco" id="preco" placeholder="preco do produto">
                        <input type="number" class="form-control mb-2" name="quantidade" id="quantidade" placeholder="quantidade de produto">

                        <textarea name="descricao" class="form-control mb-2" id="descricao" placeholder="breve descricão do produto"></textarea>

                        <div class="modal-footer bg-primary text-white">
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal" name="fechar">Fechar</button>
                            <button type="submit" class="btn btn-success" name="salvar">Salvar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




    <!--IMPORTADO DO BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>