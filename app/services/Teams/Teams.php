<?php

namespace Services\Teams;

class Teams extends \Services\Abstracts\Service {

    use \Traits\Services;

    public function __construct() {
        parent::__construct('\Models\Teams\Teams');
    }

    public function test() {
        return 'test success!';
    }

}
