<?php

namespace App\Models;

use App\Models\MySQLConnector;

class MySQLFactory extends DatabaseFactory
{
    public function getConnector()
    {
        return new MySQLCOnnector();
    }
}
