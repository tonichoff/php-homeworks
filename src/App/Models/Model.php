<?php

namespace App\Models;

use App\DataBase\DataBase;

abstract class Model
{
    protected $_db;

    public function __construct()
    {
        $this->_db = new DataBase();
    }
}