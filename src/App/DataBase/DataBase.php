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
        $sql_query = $this->buildQuery($action, $table, $values);
        if ($params == '' && $action == 'select_all') {
            $rows = [];
            $result = $this->connection->query($sql_query);
            for ($i = 0; $i < $result->num_rows; $i++) {
                mysqli_data_seek($result, $i);
                $rows[$i] = mysqli_fetch_assoc($result);
            }
            return $rows;
        }
        else {
            if ($statement = $this->connection->prepare($sql_query)) {
                if ($statement->bind_param($params, ...array_values($values))) {
                    if ($statement->execute()) {
                        $result = $statement->get_result();
                        if ($result) {
                            $rows = [];
                            for ($i = 0; $i < $result->num_rows; $i++) {
                                $rows[$i] = mysqli_fetch_array($result);
                            }
                            $result = $rows;
                        } else {
                            if ($this->connection->errno == 0) {
                                $result = true;
                            }
                        }
                        $statement->close();
                        return $result;
                    } else {
                        $statement->close();
                        View::errorCode(500, 'Не удалось выполнить запрос');
                        echo $this->connection->errno . "<br>";
                        echo $this->connection->error;
                    }
                } else {
                    View::errorCode(500, 'Не удалось подготовить привязать параметры');
                    echo $this->connection->errno . "<br>";
                    echo $this->connection->error;
                }
            } else {
                View::errorCode(500, 'Не удалось подготовить запрос');
                echo $this->connection->errno . "<br>";
                echo $this->connection->error;
            }
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
                if ($i + 1 == count($keys)) {
                    $query .= ';';
                } else {
                    $query .= ' AND ';
                }
            }
        }
        else if ($action == 'insert') {
            $query = 'INSERT INTO ' . $table . '( ';
            $keys = array_keys($values);
            for ($i = 0; $i < count($keys); $i++) {
                $query .= $keys[$i];
                if ($i + 1 == count($keys)) {
                    $query .= ' )';
                } else {
                    $query .= ', ';
                }
            }
            $query .= ' VALUES( ';
            $val = array_values($values);
            for ($i = 0; $i < count($val); $i++) {
                $keys = array_keys($values);
                for ($i = 0; $i < count($keys); $i++) {
                    $query .= '?';
                    if ($i + 1 == count($keys)) {
                        $query .= ' );';
                    } else {
                        $query .= ', ';
                    }
                }
            }
        }
        else if ($action == 'delete') {
            $query = 'DELETE FROM ' . $table . ' WHERE id=?';
        }
        else if ($action == 'select_all') {
            $query = 'SELECT * FROM ' . $table;
        }
        return $query;
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}