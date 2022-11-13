<?php

use App\Models\Usuario;

session_start();

include_once('vendor/autoload.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_SESSION['email'])){
    if(Usuario::user()->tipoUsuario == 1){
        header('Location: ' . '/');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cadastro de usuário</title>
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
            <h1 class="display-4 fw-bolder">Cadastro</h1>
            <p>Infome os dados do usuário</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="cadastro-usuario.php" method="post">
                    <?php
                    if(isset($_POST['cadastrar'])) {
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                        $resenha = $_POST['resenha'];
                        $nome = $_POST['nome'];
                        $tipoUsuario = $_POST['tipoUsuario'];

                        if(empty($email) or empty($senha) or empty($nome) or empty($tipoUsuario) or empty ($resenha)){
                            echo "<div class='alert alert-danger text-center'>Informe todos os dados.</div> ";
                        }
                        else{
                            $usuario = new Usuario();
                            $u = $usuario->select('*', $usuario->getTableName(), 'WHERE email = ?', [
                                    $email
                            ]);

                            if($u){
                                echo "<div class='alert alert-danger text-center'>E-mail já cadastrado.</div> ";
                            }

                            elseif ($senha != $resenha){
                                echo "<div class='alert alert-danger text-center'>Sua senha e confirmação de senha não correspondem.</div> ";
                            }

                            else{
                                if($tipoUsuario == 9){
                                    $tipoUsuario = 0;
                                }
                                $usuario->insert($usuario->getTableName(), [
                                    'nome'=>$nome,
                                    'email'=>$email,
                                    'senha'=>$senha,
                                    'tipoUsuario'=>$tipoUsuario
                                ]);
                                echo "<div class='alert alert-success text-center'>Usuário cadastrado com sucesso.</div> ";

                            }
                        }

                    }
                    ?>
                    <label>Nome</label>
                    <input name="nome" type="text" class="form-control">
                    <br>
                    <label>E-mail</label>
                    <input name="email" type="email" class="form-control">
                    <br>
                    <label>Senha</label>
                    <input name="senha" type="password" class="form-control">
                    <br>
                    <label>Repita sua senha</label>
                    <input name="resenha" type="password" class="form-control">
                    <br>
                    <label>Tipo de usuário</label>
                    <select name="tipoUsuario" class="form-control">
                        <option value="">Escolha uma Opção</option>
                        <option value="9">Administrador</option>
                        <option value="1">Usuário</option>
                    </select>
                    <br>
                    <button name="cadastrar" type="submit" class="btn btn-primary">
                        Cadastrar
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
