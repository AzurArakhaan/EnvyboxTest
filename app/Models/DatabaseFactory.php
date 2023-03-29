<?php

namespace App\Models;

abstract class DatabaseFactory
{
    abstract public function getConnector();

    public function save($data): void
    {
        $database = $this->getConnector();
        $database->connect();
        $database->save($data);
        $database->disconnect();
    }

}
