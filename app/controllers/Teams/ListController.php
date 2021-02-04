<?php

declare(strict_types=1);

namespace App\Controllers\Teams;

use Models\Teams\Teams;

// use Phalcon\Paginator\Adapter\NativeArray;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class ListController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    public function allAction($page = null)
    {

        // var_dump($page);
        // exit();
        // $teams = $this->services->load('Teams\Teams')->getItems();

        $teams = Teams::find(
            [
                "order" => "name",
            ]
        );



        // var_dump($teams->toArray());
        // exit();

        // $page = (int) $page;

        // $page = 1;
        $paginator = new PaginatorModel(
            [
                "model"      => Teams::class,
                "parameters" => [
                    "status = :status:",
                    "bind" => [
                        "status" => 1
                    ],
                    "order" => "name"
                ],
                'limit' => 2,
                'page'  => $page,
            ]
        );

        // Get the paginated results
        $test = $paginator->paginate();

        // var_dump($test);
        // exit();


        $this->view->setVar('teams', $test);
    }

    public function championshipAction() {
        var_dump('championshipAction');
        exit();
    }
}
