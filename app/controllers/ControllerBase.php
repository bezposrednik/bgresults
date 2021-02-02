<?php

declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->view->setLayoutsDir('layouts/');
        $this->view->setLayout('main');
    }
}
