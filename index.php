<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ENVIRONMENT DEFINITION
if (file_exists(".server")) {
    define("BASE_PATH", "");
    define("CFG", ".server");
    //
    ini_set('display_errors', 0);
} else {
    define("BASE_PATH", "");
    define("CFG", "");
    ini_set('display_errors', 1);
}

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use App\Core\{Router, Request};

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
