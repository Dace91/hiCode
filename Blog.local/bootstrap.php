<?php

// constante utiliser dans les templates URL du site
define('URL_SITE', 'http://miniblog.local');

define('URI', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); // protection  des urls
define('URL_VIEWS', __DIR__.'/src/views'); // protection  des urls

require_once __DIR__.'/vendor/autoload.php';

// base de données
$database = include __DIR__.'/config/database.php';

// les routes
$routes = include __DIR__.'/config/routes.php';

use Services\Connect;
use Services\Router;

$conn = Connect::setDB($database); // récupérer par la classe Controller

$router = new Router;
$router->addRoute($routes);


