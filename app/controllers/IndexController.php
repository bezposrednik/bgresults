<?php
declare(strict_types=1);

namespace App\Controllers;

class IndexController extends ControllerBase
{

    public function initialize() {
        parent::initialize();
    }

    public function indexAction()
    {
        
        // var_dump('index indexAction');
        // exit();

        // var_dump($this->view->getMainView());
        // exit();

        
    }

    public function viewAction() {
        var_dump('viewAction');
        exit();
    }

}

