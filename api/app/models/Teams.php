<?php

namespace Api\Models;

use Api\Traits\Pagination;

use Api\Models\Locations;
use Api\Models\Results;
use Api\Models\Stadiums;

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
    public $created;

    public function initialize()
    {
        $this->setSchema("bgresults");
        $this->setSource("teams");

        $this->hasOne('location_id', Locations::class, 'id', ['alias' => 'location']);
        $this->hasOne('stadium_id', Stadiums::class, 'id', ['alias' => 'stadium']);

        $this->hasMany('id', Results::class, 'team1_id', ['alias' => 'team1_results']);
        $this->hasMany('id', Results::class, 'team2_id', ['alias' => 'team2_results']);
    }

    public static function getNames() {
        $conditions = 'status = :status:';
        $bind = ['status' => 1];

        $data = $this::find(['conditions' => $conditions, 'bind' => $bind, 'column' => 'name']);

        return $data;

        // var_dump($data->toArray*());
        // exit();

    }

    public function getResults($limit = 10, $page = 1, $date_start = null, $date_end = null)
    {
        $conditions = 'team1_id = :team1_id: OR team2_id = :team2_id: AND date BETWEEN :date_start: AND :date_end:';
        $bind = ['team1_id' => $this->id, 'team2_id' => $this->id, 'date_start' => $date_start, 'date_end' => $date_end];

        $count = Results::count(['conditions' => $conditions, 'bind' => $bind, 'order' => 'date desc']);
        $pagination = Pagination::generate($limit, $page, $count);

        $data = Results::find(['conditions' => $conditions, 'bind' => $bind, 'limit' => $pagination['limit'], 'offset' => $pagination['offset']]);

        return ['pagination' => $pagination,'data' => $data];
    }

    public function getHomeResults($limit = 10, $page = 1, $date_start = null, $date_end = null)
    {
        $conditions = 'team1_id = :team1_id: AND date BETWEEN :date_start: AND :date_end:';
        $bind = ['team1_id' => $this->id, 'date_start' => $date_start, 'date_end' => $date_end];

        $count = Results::count(['conditions' => $conditions, 'bind' => $bind, 'order' => 'date desc']);
        $pagination = Pagination::generate($limit, $page, $count);

        $data = Results::find(['conditions' => $conditions, 'bind' => $bind, 'limit' => $pagination['limit'], 'offset' => $pagination['offset']]);

        return ['pagination' => $pagination,'data' => $data];
    }

    public function getAwayResults($limit = 10, $page = 1, $date_start = null, $date_end = null)
    {
        $conditions = 'team2_id = :team2_id: AND date BETWEEN :date_start: AND :date_end:';
        $bind = ['team2_id' => $this->id, 'date_start' => $date_start, 'date_end' => $date_end];

        $count = Results::count(['conditions' => $conditions, 'bind' => $bind, 'order' => 'date desc']);
        $pagination = Pagination::generate($limit, $page, $count);

        $data = Results::find(['conditions' => $conditions, 'bind' => $bind, 'limit' => $pagination['limit'], 'offset' => $pagination['offset']]);

        return ['pagination' => $pagination,'data' => $data];
    }


}
