<?php

namespace App\Models;

use \App\Models\FileConnector;

class FileFactory extends DatabaseFactory
{
    public function getConnector()
    {
        return new FileConnector();
    }
}
