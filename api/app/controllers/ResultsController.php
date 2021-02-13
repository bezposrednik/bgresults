<?php

namespace Api\Controllers;

use Api\Models\Results as Results;

class ResultsController extends ControllerBase
{
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
