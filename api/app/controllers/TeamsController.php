<?php

namespace Api\Controllers;

use Phalcon\Db\Adapter\Pdo\Mysql;

// use Api\Models\Config as Config;
use Api\Models\Teams as Teams;


use Api\Traits\Pagination;

use Phalcon\Paginator\Adapter\Model as Paginator;

class TeamsController extends ControllerBase
{
    public function index($page = 1)
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

    public function detailsAction($url)
    {
        $item = Teams::findFirst(['conditions' => 'url = :url:', 'bind' => ['url' => $url]]);

        $data = [];
        $data['id'] = (int) $item->id;
        $data['url'] = $item->url;
        $data['name'] = $item->name;
        $data['description'] = $item->description;
        $data['founded'] = $item->founded;
        $data['location'] = $item->location->name;
        $data['logo'] = $item->logo;

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }

    public function resultsAction($url = null, $type = 'all', $date_start = null, $date_end = null)
    {
        $item = Teams::findFirst(['conditions' => 'url = :url:', 'bind' => ['url' => $url]]);

        if (!isset($item)) return $this->response->setJsonContent(['status' => 'NOT FOUND', 'data' => []]);

        if (!isset($date_start) && !isset($date_end)) {
            $date_start = '1984-02-13';
            $date_end = '2021-08-13';
        }

        switch ($type) {
            case 'all':
                $results = $item->getResults($date_start, $date_end);
                break;
            case 'home':
                $results = $item->getHomeResults($date_start, $date_end);
                break;
            case 'away':
                $results = $item->getAwayResults($date_start, $date_end);
                break;
            default:
                return [];
                break;
        }

        $data = [];
        foreach ($results as $key => $result) {

            $data[$key]['id'] = (int) $result->id;
            $data[$key]['date'] = $result->date;
            $data[$key]['team1_id'] = $result->team1->name;
            $data[$key]['team1_goals'] = $result->team1_goals;
            $data[$key]['team2_id'] = $result->team2->name;
            $data[$key]['team2_goals'] = $result->team2_goals;
            $data[$key]['stadium'] = $result->stadium->name;
            $data[$key]['tournament'] = $result->tournament->name;
            // $data['description'] = $result->description;
            // $data['founded'] = $result->founded;
            // $data['location'] = $result->location->name;
            // $data['logo'] = $result->logo;
        }

        // var_dump($data);
        // exit();


        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }

    public function tournamentType($id, $date_start = null, $date_end = null)
    {
        $team = Teams::findFirst(['conditions' => 'id = :id:', 'bind' => ['id' => $id]]);
    }
}
