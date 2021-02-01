<?php

declare(strict_types=1);

namespace Module\Controllers\Teams;

use Models\Teams\Teams;
use Phalcon\Debug\Dump;
// use Phalcon\Helper\General;

use Phalcon\Helper\General;




class IndexController extends ControllerBase
{

    public function indexAction()
    {


        $ddd = $this->helpers->load('General')->test();
        $eeee = $this->services->load('Teams\Teams')->test();
        // $ddd = General::test();

        // var_dump($this->helpers);


        var_dump($eeee);
        exit();




        // Dump::debugVar();
        // exit();

        $test = Teams::find();

        // echo (new \Phalcon\Debug\Dump())->variable($test, "test");
        // // exit();

        // $dd = new Dump();

        // foreach ($test as $key => $value) {
        //     var_dump($value);
        // }

        Helper::test();

        // dd('dddd');

        // echo '<pre>', var_dump($test), '</pre>';


        $foo = 123;

        // echo (new \Phalcon\Debug\Dump())->toJson($test);

        // echo '<pre>';
        // print_r($test);
        // die('</pre>');



        // echo '<pre>';
        // print_r($test);
        // die('</pre>');



        // Dump::dump();

        // $dd->dd($dd);
        exit();

        // $ttt = new \Phalcon\Debug\Dump;

        // $ttt->dd($test);

        foreach ($test as $key => $value) {
            var_dump($value->name);
        }



        exit();
    }
}
