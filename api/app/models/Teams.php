<?php

namespace Api\Models;

use Api\Models\Locations;

class Teams extends ModelBase
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
    public $url;

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
        $this->setSource("teams");

        $this->hasOne('location_id', Locations::class, 'id', ['alias' => 'location']);

        $this->hasMany('id', Results::class, 'team1_id', ['alias' => 'results']);
    }

    public function getResults($date_start = null, $date_end = '') {
        $filter = "date BETWEEN '$date_start' AND '$date_end'";
        return $this->getRelated('results', [$filter]);
    }

}
