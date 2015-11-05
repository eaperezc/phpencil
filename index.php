<?php

// Shows the errors on the browser
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Main Directories
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'app/');
define('VENDOR_DIR', ROOT_DIR .'vendor/');

//Paths constants
define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__).'/'));

//Configuration constants
define('DEBUG', false);

// Includes classes with composer autoload
require_once ("./vendor/autoload.php");

// This routes the app to the respective controller
$router = new Router();
