<?php

use Carbon\Carbon;

session_start();
if(isset($_SESSION['email'])){
    header('Location: ' . '/');
}

include_once('vendor/autoload.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
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
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Login</h1>
            <p class="lead fw-normal text-white-50 mb-0">Acesse sua conta</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-4 offset-4">
                <form action="login.php" method="post">
                    <?php
                        if(isset($_POST['acessar'])){
                            $email = $_POST['email'];
                            $senha = $_POST['senha'];

                            if(empty($email) or empty($senha)){
                                echo "<div class='alert alert-danger text-center'>Informe seu Usuário e Senha.</div> ";
                            }
                            else{
                                $usuario = new \App\Models\Usuario();
                                $u = $usuario->select('*', $usuario->getTableName(), 'WHERE email = ? and senha = ?', [
                                    $email, $senha
                                ]);
                                if($u){
                                    $_SESSION["email"] = $email;
                                    $_SESSION["data"] = Carbon::now("America/Rio_Branco")->format("Y-m-d");
                                    header('Location: ' . '/');
                                } else {
                                    echo "<div class='alert alert-danger text-center'>Usuário ou senha inválidos.</div> ";
                                }
                            }
                        }
                    ?>
                    <label>E-mail</label>
                    <input name="email" type="email" class="form-control">
                    <br>
                    <label>Senha</label>
                    <input name="senha" type="password" class=" form-control">
                    <br>
                    <button name="acessar" type="submit" class="btn btn-primary">
                        Acessar
                    </button>
                </form>
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



