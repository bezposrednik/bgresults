<?php

declare(strict_types=1);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Micro;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    // Load Config
    $config = include APP_PATH . "/config/config.php";

    // Autoloading classes
    include APP_PATH . '/config/loader.php';

    // The FactoryDefault Dependency Injector
    $di = new FactoryDefault();

    // Initializing application
    $app = new Micro();

    // Setting DI container
	$app->setDI($di);

    // Load services
    include APP_PATH . '/config/services.php';

    // Setting up routing
    include APP_PATH . '/config/router.php';
    // $app->setService('router', $router, true);

    // Handle the request
    $app->handle($_SERVER["REQUEST_URI"]);
    
} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
