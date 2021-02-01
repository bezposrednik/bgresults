<?php

namespace Services\Results;

class Results extends \Services\Abstracts\Service {

    use \Traits\Services;

    public function __construct() {
        parent::__construct('\Models\Results\Results');
    }

    public function test() {
        return 'test success!';
    }

}
