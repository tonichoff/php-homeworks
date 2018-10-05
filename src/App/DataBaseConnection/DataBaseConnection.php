<?php

namespace App\DataBaseConnection;

use App\Views\View;


class DataBaseConnection
{
    private $configs;
    private $connection;

    public function __construct()
    {
        $configs_path = ROOT . '/../config/db.php';
        if (file_exists($configs_path)) {
            $this->configs = require $configs_path;
        }
        else {
            View::errorCode(500);
        }
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}