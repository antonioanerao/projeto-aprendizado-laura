<?php
require_once "vendor/autoload.php";

use Models\Usuario;

$usuario = new Usuario();

$usuario->find(1);
