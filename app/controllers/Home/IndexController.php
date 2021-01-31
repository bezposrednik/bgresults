<?php
declare(strict_types=1);

namespace Module\Controllers\Home;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        var_dump('home');
        exit();
    }

    public function testAction()
    {
        var_dump('test');
        exit();
    }

}

