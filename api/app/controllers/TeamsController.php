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
        if (!(int) $page) {
            $response = $this->response->setJsonContent(['status' => 'ERROR', 'data'   => []]);
            return $response;
        }

        /**
         * Get the total count
         */
        $count = Teams::count("status = 1");

        $limit = 2;

        $pagination = Pagination::generate($limit, $page, $count);

        // var_dump($pagination);
        // exit();

        $teams = Teams::find([
            'conditions' => 'status = :status:',
            'bind' => ['status' => 1],
            'limit' => $pagination['limit'],
            'offset' => $pagination['offset']
        ]);

        // var_dump($teams->toArray());
        // exit();

        // $prev = (($page - 1) - 1) * $limit;
        // $next = (($page + 1) - 1) * $limit;
        

        // $result = $connection->query("SELECT * FROM robots ORDER BY name");
        // echo 'There are ', $result->numRows(), ' rows in the resulset';

        // $sql = 'SELECT COUNT(*) FROM city USE INDEX(PRIMARY)';

        // $result = $connection->query(
        //     $sql,
        //     [
        //         1 => 4,
        //     ]
        // );


        // var_dump($teams->toArray());
        // exit();


        // $paginator   = new Paginator([
        //     "model"      => Teams::class,
        //     "parameters" => [
        //         // "inv_cst_id = :cst_id:",
        //         // "bind" => [
        //         //     "cst_id" => 1
        //         // ],
        //         "order" => "name"
        //     ],
        //     "limit"      => 2,
        //     "page"       => $page
        // ]);

        // $teams = $paginator->paginate();


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

    public function view($id)
    {
        $team = Teams::findFirst($id);

        var_dump($team);
        exit();

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $team]);

        return $response;
    }

    public function results($id, $date_start = null, $date_end = null)
    {

        $data = [];
        $response = $this->response->setJsonContent(['status' => 'NOT FOUND', 'data' => $data]);

        $team = Teams::findFirst(['conditions' => 'id = :id:', 'bind' => ['id' => $id]]);
        if (!isset($team)) return $response;

        // var_dump(isset($team));
        // exit();

        if (!isset($date_start) && !isset($date_end)) {
            $date_start = '1984-02-13';
            $date_end = '2021-02-13';
        }

        $data = $team->getResults($date_start, $date_end);

        // var_dump($team->results->toArray());
        // exit();

        $response = $this->response->setJsonContent(['status' => 'FOUND', 'data' => $data]);

        return $response;
    }

    public function tournamentType($id, $date_start = null, $date_end = null)
    {
        $team = Teams::findFirst(['conditions' => 'id = :id:', 'bind' => ['id' => $id]]);
    }
}
