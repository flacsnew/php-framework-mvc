<?php

namespace vendor\core\base;

/*
    Description of Controller
    Base class for controllers items
*/

abstract class Controller {

    public $route = [];
    public $view;
    public $layout;

    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }

    public function set($vars){
        $this->vars = $vars;
    }

}