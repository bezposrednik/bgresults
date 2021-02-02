<?php

declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        /**
         * Set the layouts directories
         */
        $this->view->setLayoutsDir('layouts/');
        $this->view->setLayout('main');

        /**
         * Set the title of the application
         */
        // $this->tag->setTitle($this->config->application->title);

        /**
         * Set the active navigation section
         */
        // $this->session->set('navigation-active', '');
    }
}
