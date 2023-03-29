<?php

namespace App\Models;

use App\Interfaces\DatabaseConnector;
use Illuminate\Http\JsonResponse;

class Application
{
    public static function saveToFile($data): void
    {
        $connector = new FileFactory();

        try {
            $connector->save($data);
        } catch (\Exception $e) {
            throw new \RuntimeException('Save failed. Try again later');
        }
    }

    public static function saveToDataBase($data): void
    {
        $connector = new MySQLFactory();

        try {
            $connector->save($data);
        } catch (\Exception $e) {
            throw new \RuntimeException('Save failed. Try again later');
        }
    }
}
