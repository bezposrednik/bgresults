<?php

namespace Api\Controllers;

use Phalcon\Http\Request;

use Api\Traits\Pagination;
use Api\Models\Teams;


class TeamsController extends ControllerBase
{
    public function loadAction()
    {
        $page = 1;
        $filters = $this->request->get();
        $allowed = ['page', 'location_id',  'stadium_id', 'founded_start', 'founded_end'];

        $sql = [];
        $bind = [];
        foreach ($filters as $filter => $value) {
            if (!in_array($filter, $allowed)) continue;
            switch ($filter) {
                case 'page':
                    $page = (int) $value;
                    break;
                case 'location_id':
                    $sql['location_id'] = 'location_id IN ({location_id:array})';
                    $bind[$filter] = explode(',', $value);
                    break;
                case 'stadium_id':
                    $sql['stadium_id'] = 'stadium_id IN ({stadium_id:array})';
                    $bind[$filter] = explode(',', $value);
                    break;
                case 'founded_start':
                    $sql['founded_start'] = 'founded >= :founded_start:';
                    $bind[$filter] = $value;
                    break;
                case 'founded_end':
                    $sql['founded_end'] = 'founded <= :founded_end:';
                    $bind[$filter] = $value;
                    break;

                default:
                    # code...
                    break;
            }

        }

        // var_dump($bind);
        // exit();

        /**
         * Prepare condtions
         */
        $conditions = '';
        $counter = 0;
        foreach ($sql as $value) {
            $counter+=1;
            if($counter === 1) {
                $conditions .= $value;
            } else {
                $conditions .= ' AND ' . $value;
            }
        }

        // var_dump($conditions);
        // exit();

        // var_dump($bind);
        // exit();

        // exit();

        // $conditions = 'status = :status:';
        // $bind = ['status' => 1];


        // $filters['team'] = $this->request->getQuery('team', 'int');



        // $email = $request->get('userEmail', 'email', 'some@example.com');


        $limit = 2;

        // if (!(int) $page) {
        //     $response = $this->response->setJsonContent(['status' => 'ERROR', 'data'   => []]);
        //     return $response;
        // }

        // $conditions = 'status = :status:';
        // $bind = ['status' => 1];

        $count = Teams::count("status = 1");
        $pagination = Pagination::generate($limit, $page, $count);
        $teams = Teams::find([
            'conditions' => $conditions,
            'bind' => $bind,
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

        // var_dump($data);
        // exit();
        

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
