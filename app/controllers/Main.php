<?php

namespace app\controllers;

/*
    Description of Main
*/
class Main extends Application {

    public $layout = 'main';

    public function indexAction()
    {
        //$this->layout = false;
        $name = 'flacs';
        $this->set(['name' => $name]);
    }

    public function testAction(){
        
    }

}