<?php

declare(strict_types=1);

namespace App\Controllers\Teams;

class IndexController extends ControllerBase
{

    public function initialize() {
        parent::initialize();
    }

    public function indexAction()
    {
        $teams = $this->services->load('Teams\Teams')->getItems();
        $this->view->setVar('teams', $teams);
    }
}
