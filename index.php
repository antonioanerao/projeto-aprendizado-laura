<?php
require_once "vendor/autoload.php";

use Models\Usuario;

$usuario = new Usuario();

//$usuario->find(1);
//
//echo $usuario;

$usuario->setNome("antonio");
$usuario->setEmail("antonio@email.com");
$usuario->setSenha("123456");
$usuario->setTipoUsuario(1);

$usuario->insert();
