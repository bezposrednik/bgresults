<?php

namespace Api\Models;

class Stadiums extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var integer
     */
    public $capacity;

    /**
     *
     * @var integer
     */
    public $location_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("Stadiums");
    }

}
