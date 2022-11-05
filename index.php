<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once('vendor/autoload.php');

use App\Models\Usuario;

$usuario = new Usuario();

//$usuario->insert($usuario->getTableName(), [
//    'nome' => "Laravel", 'email' => "demo@hell.com", 'senha' => "123456"
//]);

//$usuario->update($usuario->getTableName(), 'nome = :NOME, email = :EMAIL WHERE id = :ID', [
//    ':NOME' => "Lara",
//    ':ID' => 9,
//    ':EMAIL' => "lara@mail.com"
//]);

$usuario->delete($usuario->getTableName(), 'WHERE id = :ID', [
   ':ID' => 9
]);

foreach ($usuario->all($usuario->getTableName()) as $usuario){
    echo $usuario->nome . "<br>";
}


