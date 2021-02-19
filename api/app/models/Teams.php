<?php

namespace Api\Models;

use Api\Models\Locations;
use Api\Models\Results as Results;

class Teams extends ModelBase
{

    public $id;
    public $url;
    public $name;
    public $description;
    public $founded;
    public $location_id;
    public $logo;
    public $status;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("teams");

        $this->hasOne('location_id', Locations::class, 'id', ['alias' => 'location']);
        $this->hasOne('tournament_id', Tournaments::class, 'id', ['alias' => 'tournament']);

        $this->hasMany('id', Results::class, 'team1_id', ['alias' => 'team1_results']);
        $this->hasMany('id', Results::class, 'team2_id', ['alias' => 'team2_results']);
    }

    public function getResults($date_start = null, $date_end = null)
    {
        $filter = 'team1_id = :team1_id: OR team2_id = :team2_id: AND date BETWEEN :date_start: AND :date_end:';
        $data = Results::find([
            'conditions' => $filter,
            'bind' => ['team1_id' => $this->id, 'team2_id' => $this->id, 'date_start' => $date_start, 'date_end' => $date_end],
            'order' => 'date desc'
        ]);

        return $data;
    }

    public function getHomeResults($date_start = null, $date_end = null)
    {
        $filter = "date BETWEEN '$date_start' AND '$date_end'";
        return $this->getRelated('team1_results', [$filter]);
    }

    public function getAwayResults($date_start = null, $date_end = null)
    {
        $filter = "date BETWEEN '$date_start' AND '$date_end'";
        return $this->getRelated('team2_results', [$filter]);
    }
}
