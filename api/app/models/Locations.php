<?php

namespace Api\Models;

class Locations extends ModelBase
{
    public $id;
    public $name;
    public $description;
    public $status;
    public $created;

    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("locations");
    }
}
