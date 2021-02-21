<?php

$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->traitsDir
    ]
);

$loader->registerNamespaces([
    'Api\Models'    => $config->application->modelsDir,
    'Api\Traits'    => $config->application->traitsDir,
    'Api\Controllers' => $config->application->controllersDir,
]);

$loader->register();
