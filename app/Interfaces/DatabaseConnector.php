<?php

namespace App\Interfaces;

interface DatabaseConnector
{
    public function connect();
    public function disconnect();
    public function save($data): void;
}
