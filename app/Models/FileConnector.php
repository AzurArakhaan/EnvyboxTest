<?php

namespace App\Models;

use App\Interfaces\DatabaseConnector;
use Illuminate\Support\Facades\Storage;

class FileConnector implements DatabaseConnector
{

    private $connection;

    public function connect(): void
    {
        $this->connection = Storage::disk('messages');
    }

    public function disconnect(): void
    {
        $this->connection = null;
    }

    public function save($data): void
    {
        $this->connection->put('application' . date('Y-m-d-H_i_s') . '.json', json_encode($data));
    }
}
