<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once('vendor/autoload.php');

use App\Models\Usuario;

$usuario = new Usuario();

foreach ($usuario->all("usuarios") as $usuario){
    echo $usuario->nome . "<br>";
}

