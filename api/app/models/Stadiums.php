<?php

namespace Api\Models;

class Stadiums extends \Phalcon\Mvc\Model
{
    public $id;
    public $name;
    public $capacity;
    public $location_id;

    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("Stadiums");
    }
}
