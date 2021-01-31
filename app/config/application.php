<?php

$configurations['application'] = [
    'language'  => 'en-us',
    'name'      => 'bgresults.com',
    'title'     => 'Bg results title',
    'version'   => '1.0.0.0',
    /**
     * Base URL is used to generate all kind of URLs in the application
     */
    'url' => [
        'base'      => '/application/',
        'static'    => '/application/',
    ],
    'meta' => [
        'description' => 'website description',
        'keywords' => 'website keywords',
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
