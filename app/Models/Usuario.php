<?php


namespace App\Models;

use App\Traits\BaseTrait;
use Core\Database\Model;

class Usuario extends Model
{
    use BaseTrait;
    protected string $table = 'usuarios';

}