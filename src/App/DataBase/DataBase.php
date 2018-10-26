<?php

namespace App\DataBase;

use App\Views\View;
use mysqli;
use function PHPSTORM_META\type;

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
                View::errorCode(500, "Didn't conect to DB");
            }
        }
        else {
            View::errorCode(500, "Didn't find DB config");
        }
    }

    public function query($action, $table, $values)
    {
        $params = $this->createParams($values);
        echo "params: $params <br>";
        $sql_query = $this->buildQuery($action, $table, $values);
        echo "query: $sql_query <br>";
        if ($statement = $this->connection->prepare($sql_query)) {
            if (!empty($values)) {
                $statement->bind_param($params, ...array_values($values));
                $statement->execute();
                $result = $statement->get_result();
                $statement->close();
                return $result;
            } else {
                $statement->close();
                View::errorCode(500, 'SQL not result');
                echo $this->connection->errno;
                echo $this->connection->error;
            }
        }
        else {
            View::errorCode(500, 'SQL query wrong');
            echo $this->connection->errno;
            echo $this->connection->error;
        }
    }

    private function createParams($values)
    {
        $result = '';
        foreach ($values as $key => $value) {
            if (gettype($value) == 'integer') {
                $result .= 'i';
            }
            else if (gettype($value) == 'string') {
                $result .= 's';
            }
        }
        return $result;
    }

    private function buildQuery($action, $table, $values)
    {
        $query = '';
        if ($action == 'find') {
            $query = 'SELECT * FROM ' . $table . ' WHERE ';
            $keys = array_keys($values);
            for ($i = 0; $i < count($keys); $i++) {
                $query .= $keys[$i] . '=?';
                if ($i + 1 != count($keys)) {
                    $query .= ' AND ';
                } else {
                    $query .= ';';
                }
            }
        }
        return $query;
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}