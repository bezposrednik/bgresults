<?php

$router = $di->getRouter();

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
    'namespace' => 'App\Controllers',
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
    'namespace' => 'App\Controllers',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/:controller/:action', [
    'namespace' => 'App\Controllers',
    'controller' => 1,
    'action' => 2,
]);

$router->add('/:controller', [
    'namespace' => 'App\Controllers',
    'controller' => 1
]);

/**
 * Routing for the Teams controllers
 */
$router->add('/teams/:controller/:action/:params', [
    'namespace' => 'App\Controllers\Teams',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/teams/:controller/:action', [
    'namespace' => 'App\Controllers\Teams',
    'controller' => 1,
    'action' => 2,
]);

$router->add('/teams/:controller', [
    'namespace' => 'App\Controllers\Teams',
    'controller' => 1
]);

$router->add('/teams', [
    'namespace' => 'App\Controllers\Teams',
    'controller' => 'index'
]);

/**
 * Routing for the Results controllers
 */
$router->add('/results/:controller/:action/:params', [
    'namespace' => 'App\Controllers\Results',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/results/:controller/:action', [
    'namespace' => 'App\Controllers\Results',
    'controller' => 1,
    'action' => 2,
]);

$router->add('/results/:controller', [
    'namespace' => 'App\Controllers\Results',
    'controller' => 1
]);

$router->add('/results', [
    'namespace' => 'App\Controllers\Results',
    'controller' => 'index'
]);

$router->handle($_SERVER['REQUEST_URI']);