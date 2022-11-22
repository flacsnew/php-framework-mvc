<?php

namespace vendor\core\base;

/*
    Description of View
*/
class View {

    public $route = [];     // текущий маршрут и параметры
    public $view;           // текущий вид
    public $layout;         // текущий шаблон

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        $this->layout = $layout ?: LAYOUT;
        $this->view = $view;
    }

    public function render(){
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        if ($file_view)
        {
            require $file_view;
        }
            else
        {
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }
    }
    

}