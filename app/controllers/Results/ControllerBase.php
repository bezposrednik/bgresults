<?php

declare(strict_types=1);

namespace App\Controllers\Results;

use App\Controllers\ControllerBase as Base;

class ControllerBase extends Base
{
    public function afterExecuteRoute()
    {
        // parent::afterExecuteRoute();

        $this->view->setViewsDir($this->view->getViewsDir() . 'results/');
        $this->view->setPartialsDir($this->view->getPartialsDir() . '../');
    }
}
