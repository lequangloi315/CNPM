<?php

require '../vendor/autoload.php';
use Core\Env;
use Core\Router;

// Load environment variables
Env::load();

// Include routes
require '../routes/api.php';

// Resolve routes
$router->resolve();
