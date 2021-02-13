<?php

namespace Api\Controllers;

use Api\Models\Teams as Teams;

class TeamsController extends ControllerBase
{
    public function index()
    {
        $teams = Teams::find();

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data'   => $teams]);

        return $response;
    }

    public function view($id)
    {
        $team = Teams::findFirst($id);

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $team]);

        return $response;
    }

    public function results($id, $date_start = null, $date_end = null)
    {

        $data = [];
        $response = $this->response->setJsonContent(['status' => 'NOT FOUND', 'data' => $data]);

        $team = Teams::findFirst( ['conditions' => 'id = :id:', 'bind' => ['id' => $id]]);
        if(!isset($team)) return $response;

        // var_dump(isset($team));
        // exit();

        if(!isset($date_start) && !isset($date_end)) {
            $date_start = '1984-02-13';
            $date_end = '2021-02-13';
        }

        $data = $team->getResults($date_start, $date_end);

        // var_dump($team->results->toArray());
        // exit();

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }

    public function tournamentType($id, $date_start = null, $date_end = null) {
        $team = Teams::findFirst( ['conditions' => 'id = :id:', 'bind' => ['id' => $id]]);
    }


}
