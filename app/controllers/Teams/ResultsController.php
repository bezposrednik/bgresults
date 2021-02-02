<?php

declare(strict_types=1);

namespace App\Controllers\Teams;

class ResultsController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        // $teams = $this->services->load('Teams\Teams')->getItems();
        // $this->view->setVar('teams', $teams);
    }

    public function showAction($id = null)
    {
        $team = $this->services->load('Teams\Teams')->getItem($id);
        $this->view->setVar('team', $team);

        

        // foreach ($team->results as $key => $value) {
        //     var_dump($value->attendance);
        // }


        // exit();


        // var_dump($team->toArray());
        // exit();
    }
}
