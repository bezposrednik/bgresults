<?php

declare(strict_types=1);

namespace App\Controllers\Teams;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        /**
         * Load the information for the Teams
         */
        $teams = $this->services->load('Teams\Teams')->getItems();
        $this->view->setVar('teams', $teams);
    }
}
