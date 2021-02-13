<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    $config->application->controllersDir,
    $config->application->modelsDir,
    $config->application->servicesDir,
    $config->application->helpersDir,
    $config->application->traitsDir
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Models'    => $config->application->modelsDir,
    'Services'  => $config->application->servicesDir,
    'Helpers'   => $config->application->helpersDir,
    'Traits'    => $config->application->traitsDir,

    /** 
     * Register the controllers 
     */
    'App\Controllers'                        => $config->application->controllersDir,
    'App\Controllers\Teams'                  => $config->application->controllersDir . 'teams',
    'App\Controllers\Results'                => $config->application->controllersDir . 'results',
]);

$loader->register();
