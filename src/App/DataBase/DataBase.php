<?php

namespace App\DataBase;

use App\Views\View;
use mysqli;

class DataBase
{
    private $configs;
    private $connection;

    public function __construct()
    {
        $configs_path = ROOT . '/../config/db.php';
        if (file_exists($configs_path)) {
            $this->configs = require $configs_path;
            $this->connection = new mysqli($this->configs['host'], $this->configs['user'],
                                           $this->configs['password'], $this->configs['dbname']);
            if ($this->connection->connect_error) {
                View::errorCode(500);
            }
            $result = $this->connection->query('SELECT * FROM Users');
        }
        else {
            View::errorCode(500);
        }
    }

    public function query()
    {

    }

    public function __destruct()
    {
        $this->connection->close();
    }
}