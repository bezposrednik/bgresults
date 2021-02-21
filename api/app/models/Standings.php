<?php

namespace Api\Models;

use Api\Models\Tournaments;
use Api\Models\Teams;


class Standings extends ModelBase
{

    public $id;
    public $tournament_id;
    public $team_id;
    public $position;
    public $goals_for;
    public $goals_against;
    public $points;
    public $matches;

    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("standings");

        $this->belongsTo('tournament_id', Tournaments::class, 'id', ['alias' => 'tournament']);
        $this->belongsTo('team_id', Teams::class, 'id', ['alias' => 'team']);
    }

}
