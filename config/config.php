<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 20.09.18
 * Time: 14:42
 */

ini_set('display_errors', 1);
ini_set('session.cookie_lifetime', 0);
ini_set('session.gc_maxlifetime', 10800);
session_set_cookie_params(0);
session_save_path(ROOT . '/../sessions');
error_reporting(E_ALL);

session_start();