<?php

namespace app\controllers;

/*
    Description of Main
*/
class MainController extends ApplicationController {

    public $layout = 'main';

    public function indexAction()
    {
        //$this->layout = false;
        $name = 'flacs';
        $this->set([
            'name' => $name, 
            'colors' => ['red', 'white']
        ]);
    }

    public function testAction(){
        
    }

}