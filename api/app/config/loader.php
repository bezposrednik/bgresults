<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        // $config->application->servicesDir,
        $config->application->traitsDir
    ]
);

$loader->registerNamespaces([
    'Api\Models'    => $config->application->modelsDir,
    // 'Services'  => $config->application->servicesDir,
    'Api\Traits'    => $config->application->traitsDir,
    'Api\Controllers' => $config->application->controllersDir,
]);

$loader->register();
