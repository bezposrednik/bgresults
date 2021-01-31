<?php
declare(strict_types=1);

namespace Module\Controllers\Teams;

use Models\Teams\Teams;
use Phalcon\Debug\Dump;
use Phalcon\Helper;





class IndexController extends ControllerBase
{

    public function indexAction()
    {


        var_dump('ddd');
        exit();


        // Dump::debugVar();
        // exit();

        $test = Teams::find();

        // echo (new \Phalcon\Debug\Dump())->variable($test, "test");
        // exit();

        var_dump(Helper::dd);
        exit();

        // $ttt = new \Phalcon\Debug\Dump;
        
        // $ttt->dd($test);

        foreach ($test as $key => $value) {
            var_dump($value->name);
        }


        
        exit();
    }

}

