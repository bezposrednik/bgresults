<?php

namespace Services;

class Loader extends \Phalcon\DI\Injectable {

    /**
     * Helper method to load service classes
     * 
     * @param string $service
     * @return \Services\{Class}
     */
    public function load($service) {
        $class = '\Services\\' . $service;
        return new $class;
    }

}
