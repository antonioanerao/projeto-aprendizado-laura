<?php
require_once "vendor/autoload.php";

use Models\Usuario;

$usuario = new Usuario();

$usuario->setNome("Laravel");
echo $usuario->getNome();
