<?php

$configurations['application'] = [
    'language'  => 'en-us',
    'name'      => 'Access Masters',
    'title'     => 'Access Masters — Education articles — Masters events — School information',
    'version'   => '1.0.1.2',
    /**
     * Base URL is used to generate all kind of URLs in the application
     */
    'url' => [
        'base'      => '/application/',
        'static'    => '/application/',
    ],
    'meta' => [
        'description' => 'Learn about study options and Masters programmes. Meet school representatives on the Access Masters Tour.',
        'keywords' => 'Masters study',
    ],
    /**
     * Default shared folders for the application that will contain features/tools for all modules 
     */
    'directory' => [
        'config'        => APP_PATH . 'config/',
        'controllers'   => APP_PATH . 'controllers/',
        'forms'         => APP_PATH . 'forms/',
        'helpers'       => APP_PATH . 'helpers/',
        'languages'     => APP_PATH . 'languages/',
        'libraries'     => APP_PATH . 'libraries/',
        'logs'          => APP_PATH . 'logs/',
        'models'        => APP_PATH . 'models/',
        'plugins'       => APP_PATH . 'plugins/',
        'services'      => APP_PATH . 'services/',
        'traits'        => APP_PATH . 'traits/',
        'views'         => APP_PATH . 'views/',
    ]
];
