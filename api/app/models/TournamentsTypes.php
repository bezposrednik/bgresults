<?php

namespace Api\Models;

use Api\Models\Tournaments;

class TournamentsTypes extends ModelBase
{
    public $id;
    public $name;
    public $description;

    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("tournaments_types");
    }
}
