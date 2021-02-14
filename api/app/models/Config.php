<?php

namespace Api\Models;

class Config extends \Phalcon\Mvc\Model
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
    public $table;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var integer
     */
    public $value;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("Config");
    }

    

}
