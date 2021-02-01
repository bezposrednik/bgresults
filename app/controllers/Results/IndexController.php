<?php

declare(strict_types=1);

namespace App\Controllers\Results;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        /**
         * Load the information for the Results
         */
        $results = $this->services->load('Results\Results')->getItems();

        var_dump($results->toArray());
        exit();

        $this->view->setVar('results', $results);
    }
}
