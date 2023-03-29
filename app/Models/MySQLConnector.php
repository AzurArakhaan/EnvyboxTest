<?php

namespace App\Models;

use App\Interfaces\DatabaseConnector;
use mysqli;

class MySQLConnector implements DatabaseConnector
{

    private $connection;

    /**
     * Не уверен, что в рамках фреймворка имеет смысл устанавливать подключение такого рода
     * Но для тестового сделал
     * В остальном, взаимодействие с базой данных идет через файл .env и фасад DB, либо модели
     */
    public function connect(): void
    {
        $this->connection = new mysqli(
            'localhost',
            'root',
            'password',
            'envyboxDB'
        );
    }

    public function disconnect(): void
    {
        $this->connection->close();
    }

    public function save($data): void
    {
        $query = $this->connection->prepare("INSERT INTO `applications` (`name`, `phone`, `message`) VALUES (?, ?, ?)");
        $query->bind_param('sss', $data['name'], $data['phone'], $data['message']);
        $query->execute();
    }
}
