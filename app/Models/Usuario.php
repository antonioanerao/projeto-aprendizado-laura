<?php


namespace App\Models;

use Core\Database\Model;

class Usuario extends Model
{
    protected string $table = 'users';

    public function getTableName(): string
    {
        return $this->table;
    }
}