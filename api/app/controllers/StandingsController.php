<?php

namespace Api\Controllers;

use Api\Traits\Pagination;
use Api\Models\Teams;

class StandingsController extends ControllerBase
{
    public function list($page = 1)
    {
        $limit = 2;

        if (!(int) $page) {
            $response = $this->response->setJsonContent(['status' => 'ERROR', 'data'   => []]);
            return $response;
        }

        $count = Teams::count("status = 1");
        $pagination = Pagination::generate($limit, $page, $count);
        $teams = Teams::find([
            'conditions' => 'status = :status:',
            'bind' => ['status' => 1],
            'limit' => $pagination['limit'],
            'offset' => $pagination['offset']
        ]);

        $data = ['pagination' => $pagination];
        foreach ($teams as $key => $team) {
            $data['items'][$key]['id'] = (int) $team->id;
            $data['items'][$key]['url'] = $team->url;
            $data['items'][$key]['name'] = $team->name;
            $data['items'][$key]['description'] = $team->description;
            $data['items'][$key]['founded'] = $team->founded;
            $data['items'][$key]['location'] = $team->location->name;
            $data['items'][$key]['logo'] = $team->logo;
        }

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }
}
