<?php

namespace Helpers;

class Loader
{

    protected $_helpers = [];

    /**
     * Helper method to load service classes
     * 
     * @param string $service
     * @return \Services\class
     */
    function load($helper)
    {
        $class = '\Helpers\\' . $helper;

        /**
         * Verify if we have an instance of the helper
         */
        if (isset($this->_helpers[$helper]) && ($this->_helpers[$helper] instanceof $class)) :
            return $this->_helpers[$helper];
        endif;

        /**
         * Create a new instance of the helper
         */
        $this->_helpers[$helper] = new $class;

        /**
         * Return the instance of the helper
         */
        return new $this->_helpers[$helper];
    }
}
