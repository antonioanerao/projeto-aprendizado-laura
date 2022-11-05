<?php

namespace App\Traits;

trait BaseTrait{
    public function getTableName(): string
    {
        return $this->table;
    }
}