<?php

namespace Api\Models;

class Results extends ModelBase
{

    public $id;
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
        $this->setSource("results");

        $this->belongsTo('team1_id', Teams::class, 'id', ['alias' => 'team1']);
        $this->belongsTo('team2_id', Teams::class, 'id', ['alias' => 'team2']);

        $this->belongsTo('stadium_id', Stadiums::class, 'id', ['alias' => 'stadium']);
        $this->belongsTo('tournament_id', Tournaments::class, 'id', ['alias' => 'tournament']);


    }
}
