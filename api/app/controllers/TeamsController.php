<?php

namespace Api\Controllers;

use Api\Traits\Pagination;
use Api\Models\Teams;

class TeamsController extends ControllerBase
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
        $data['stadium'] = $item->stadium->name;
        
        // var_dump($data);
        // exit();

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }

    public function resultsAction($url = null, $type = 'all', $page = 1, $date_start = null, $date_end = null)
    {
        $item = Teams::findFirst(['conditions' => 'url = :url:', 'bind' => ['url' => $url]]);

        if (!isset($item)) return $this->response->setJsonContent(['status' => 'NOT FOUND', 'data' => []]);

        if (!isset($date_start) && !isset($date_end)) {
            $date_start = '1984-02-13';
            $date_end = '2021-08-13';
        }

        $limit = $this->settings->teams->pagination->limit;

        switch ($type) {
            case 'all':
                $results = $item->getResults($limit, $page, $date_start, $date_end);
                break;
            case 'home':
                $results = $item->getHomeResults($limit, $page, $date_start, $date_end);
                break;
            case 'away':
                $results = $item->getAwayResults($limit, $page, $date_start, $date_end);
                break;
            default:
                return $this->response->setJsonContent(['status' => 'NOT-FOUND', 'data' => []]);
                break;
        }

        $data = [];
        $data = ['pagination' => $results['pagination']];
        foreach ($results['data'] as $key => $result) {
            $data['items'][$key]['id'] = (int) $result->id;
            $data['items'][$key]['date'] = $result->date;
            $data['items'][$key]['team1_id'] = $result->team1->name;
            $data['items'][$key]['team1_goals'] = $result->team1_goals;
            $data['items'][$key]['team2_id'] = $result->team2->name;
            $data['items'][$key]['team2_goals'] = $result->team2_goals;
            $data['items'][$key]['stadium'] = $result->stadium->name;
            $data['items'][$key]['tournament'] = $result->tournament->name;
            $data['items'][$key]['attendance'] = $result->attendance;
            $data['items'][$key]['description'] = $result->description;
        }

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }

    public function tournamentType($id, $date_start = null, $date_end = null)
    {
        $team = Teams::findFirst(['conditions' => 'id = :id:', 'bind' => ['id' => $id]]);
    }
}
