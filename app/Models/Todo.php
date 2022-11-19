<?php
namespace App\Models;

use App\Traits\BaseTrait;
use Core\Database\Model;

class Todo extends Model
{
    use BaseTrait;
    protected string $table = 'todo';
}

