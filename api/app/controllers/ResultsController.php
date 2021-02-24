<?php

namespace Api\Controllers;

use Api\Traits\Pagination;
use Api\Models\Results;

class ResultsController extends ControllerBase
{
    public function list($page = null)
    {
        if (!isset($page) || !(int) $page) {
            $response = $this->response->setJsonContent(['status' => 'Missing or wrong page', 'data'   => []]);
            return $response;
        }

        $count = Results::count();
        $limit = $this->settings->results->pagination->limit;
        $pagination = Pagination::generate($limit, $page, $count);
        $items = Results::find(['limit' => $pagination['limit'], 'offset' => $pagination['offset']]);

        $data = ['pagination' => $pagination];
        foreach ($items as $key => $item) {
            $data['items'][$key]['id'] = (int) $item->id;
            $data['items'][$key]['date'] = $item->date;
            $data['items'][$key]['team1_name'] = $item->team1->name;
            $data['items'][$key]['team1_goals'] = $item->team1_goals;
            $data['items'][$key]['team2_name'] = $item->team2->name;
            $data['items'][$key]['team2_goals'] = $item->team2_goals;
            $data['items'][$key]['stadium'] = $item->stadium->name;
            $data['items'][$key]['tournament'] = $item->tournament->name;
            $data['items'][$key]['attendance'] = $item->attendance;
            $data['items'][$key]['description'] = $item->description;
        }

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }


    public function all()
    {
        $results = Results::Find();

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $results]);

        return $response;
    }

    public function view($id)
    {
        $result = Results::findFirst(
            [
                'conditions' => 'id = :id:',
                'bind'       => [
                    'id' => $id,
                ],
                'order'      => 'date, created asc',
            ]
        );

        print_r(
            $result->toArray()
        );

        exit();
        // $test = [];

        // $test['team_1'] = $result->getTeam();



        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $result]);

        return $response;
    }

    public function team() {

    }
}
