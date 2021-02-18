<?php

namespace Api\Models;

class Results extends ModelBase
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
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $founded;

    /**
     *
     * @var integer
     */
    public $location_id;

    /**
     *
     * @var string
     */
    public $logo;

    /**
     *
     * @var string
     */
    public $status;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("results");

        // $this->belongsTo('team1_id', Teams::class, 'id', ['alias' => 'team']);

    }
}
