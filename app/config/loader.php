<?php

$loader = new \Phalcon\Loader();

/**
                 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
        $config->application->controllersDir,
        $config->application->modelsDir,

        // $config->application->directory->helpers,
        // $config->application->directory->libraries,
        // $config->application->directory->models,
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
    // 'Phalcon' => $config->application->directory->libraries . '/Incubator/3.2.0/Phalcon/',

    /** 
     * Register the classes for forms, plug-ins, helpers and models 
     */
    'Forms'     => $config->application->directory->forms,
    'Helpers'   => $config->application->directory->helpers,
    'Libraries' => $config->application->directory->libraries,
    'Models'    => $config->application->directory->models,
    'Plugins'   => $config->application->directory->plugins,
    'Services'  => $config->application->directory->services,
    'Traits'    => $config->application->directory->traits,

    /** 
     * Register the controllers 
     */
    'Module\Controllers'                        => $config->application->directory->controllers,
    'Module\Controllers\Articles'               => $config->application->directory->controllers . 'articles',
    'Module\Controllers\Chats'                  => $config->application->directory->controllers . 'chats',
]);

$loader->register();
