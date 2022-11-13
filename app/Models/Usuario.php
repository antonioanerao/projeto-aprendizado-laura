<?php


namespace App\Models;

use App\Traits\BaseTrait;
use Core\Database\Model;

class Usuario extends Model
{
    use BaseTrait;
    protected string $table = 'usuarios';

    public static function user() {
        $usuario = new self();

        return (object) $usuario->find("*", $usuario->getTableName(), "WHERE email = ?", [$_SESSION["email"]]);
    }
}
