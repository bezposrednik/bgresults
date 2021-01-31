<?php

$router = $di->getRouter();

// Define your routes here


/**
 * Set the default options for the application
 */
$router->setDefaultController('index');
$router->setDefaultAction('index');

/**
 * Remove trailing slashes automatically
 */
$router->removeExtraSlashes(true);

/**
 * Index
 */
$router->add('/', [
    'namespace' => 'Module\Controllers',
    'controller' => 'index',
    'action'     => 'index',
]);

/**
 * 404
 */
$router->notFound(['controller' => 'index', 'action' => 'fourOhFour']);

/**
 * Main routes for the controllers that are not in subdirectory
 */
$router->add('/:controller/:action/:params', [
    'namespace' => 'Module\Controllers',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/:controller/:action', [
    'namespace' => 'Module\Controllers',
    'controller' => 1,
    'action' => 2,
]);

$router->add('/:controller', [
    'namespace' => 'Module\Controllers',
    'controller' => 1
]);


/**
 * Routing for the Teams controllers
 */
$router->add('/teams/:controller/:action/:params', [
    'namespace' => 'Module\Controllers\Teams',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/teams/:controller/:action', [
    'namespace' => 'Module\Controllers\Teams',
    'controller' => 1,
    'action' => 2,
]);

$router->add('/teams/:controller', [
    'namespace' => 'Module\Controllers\Teams',
    'controller' => 1
]);

$router->add('/teams', [
    'namespace' => 'Module\Controllers\Teams',
    'controller' => 'index'
]);



$router->handle($_SERVER['REQUEST_URI']);
