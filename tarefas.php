<?php

use App\Models\Usuario;
use App\Models\Todo;
use Carbon\Carbon;

session_start();

include_once('vendor/autoload.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$todo = new Todo();
$dataTarefa = Carbon::now()->format("Y-m-d");
$idUsuario = Usuario::user()->id;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tarefas</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" aria-current="page" href="tarefas.php">Minhas Tarefas</a></li>
                <?php if(isset($_SESSION['email'])) : ?>
                    <?php if(Usuario::user()->tipoUsuario == 0) : ?>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="cadastro-usuario.php">Cadastro de Usuário</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="logout.php">Logout</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="login.php">Login</a></li>
                <?php  endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Minhas Tarefas</h1>
            <p>Afazeres do dia: <br><?php echo Carbon::now('America/Rio_Branco')->format('d/m/Y') ?></p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="tarefas.php" method="post">
                    <?php
                    if(isset($_POST['cadastrar'])) {
                        $tarefa = $_POST['tarefa'];

                        if(empty($tarefa)) {
                            echo "<div class='alert alert-danger text-center'>Informe sua tarefa!</div> ";
                        }
                        $todo->insert($todo->getTableName(), [
                           'idUsuario' => $idUsuario,
                            'descricao' => $tarefa,
                            'data' => $dataTarefa
                        ]);
                    }
                    ?>
                    <label>Adicionar tarefa</label>
                    <input name="tarefa" type="text" required class="form-control">
                    <br>
                    <button name="cadastrar" type="submit" class="btn btn-primary">
                        Cadastrar
                    </button>
                </form>
                <?php
                $tarefas = $todo->select('*', $todo->getTableName(), 'WHERE idUsuario = ? and data = ?', [
                    $idUsuario, $dataTarefa
                ]);

                ?>


                <?php

                if(isset($_POST['check'])) {
                    echo "concluido";
                }

                if(isset($_POST['delete'])) {
                    echo "removido";
                }

                ?>


                <?php if($tarefas): ?>
                    <form method="post" action="tarefas.php">
                        <div class="card mt-4">
                            <div class="card-body">
                                <ul class="mb-0">
                                    <table class="table">
                                    <?php foreach ($tarefas as $tarefa): ?>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col"><?php echo $tarefa->descricao; ?></th>
                                                <th scope="col">
                                                    <button name="check" class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i></button>
                                                    <button name="delete" class="btn btn-danger btn-sm"><i class="fa fa-check-circle"></i></button>

                                                </th>
                                            </tr>
                                        </thead>
                                    <?php endforeach; ?>
                                    </table>
                                </ul>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-info text-center mt-4">
                        Você não tem nenhuma tarefa para hoje
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
