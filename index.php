<?php

// Run the app init
require_once ("./bootstrap.php");

// This routes the app to the respective controller
$router = new Router();
$router->route();
