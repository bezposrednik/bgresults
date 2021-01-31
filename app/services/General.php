<?php

namespace Services;

class General extends \Services\Abstracts\Service {

    use \Traits\Services;

    public function __construct() {
        parent::__construct('\Models\Accepte');

        /**
         * Set the default ordering 
         */
        // $this->ordering = 'uid ASC';
    }

}
