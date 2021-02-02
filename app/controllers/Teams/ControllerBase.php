<?php

declare(strict_types=1);

namespace App\Controllers\Teams;

use App\Controllers\ControllerBase as Base;

class ControllerBase extends Base
{
    public function afterExecuteRoute()
    {
        // parent::afterExecuteRoute();

        $this->view->setViewsDir($this->view->getViewsDir() . 'teams/');
        $this->view->setPartialsDir($this->view->getPartialsDir() . '../');
    }

    public function initialize() {
        $this->view->setLayoutsDir('../layouts/');
        $this->view->setLayout('main');
    }
}
