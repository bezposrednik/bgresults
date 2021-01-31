<?php

$loader = new \Phalcon\Loader();

/**
* We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->servicesDir,

        // $config->application->directory->helpers,
        // $config->application->directory->libraries,
        // $config->application->directory->plugins,

        /**
     * Register each of the external libraries for the application
     */
        // $config->application->directory->libraries . '/Curl/1.0.0/',
        // $config->application->directory->libraries . '/Image/1.0/',
        // $config->application->directory->libraries . '/QRcode/1.1.4/',
]);

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Models'    => $config->application->modelsDir,
    'Services'  => $config->application->servicesDir,

    // 'Phalcon' => $config->application->directory->libraries . '/Incubator/3.2.0/Phalcon/',

    /** 
     * Register the classes for forms, plug-ins, helpers and models 
     */
    // 'Forms'     => $config->application->directory->forms,
    // 'Helpers'   => $config->application->directory->helpers,
    // 'Libraries' => $config->application->directory->libraries,
    // 'Plugins'   => $config->application->directory->plugins,
    // 'Traits'    => $config->application->directory->traits,

    /** 
     * Register the controllers 
     */
    'Module\Controllers'                        => $config->application->controllersDir,
    'Module\Controllers\Teams'                  => $config->application->controllersDir . 'Teams',
    'Module\Controllers\Results'                => $config->application->controllersDir . 'Results',
]);

$loader->register();
