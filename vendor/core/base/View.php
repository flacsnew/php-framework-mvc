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
        if ($layout === false)
        {
            $this->layout = false;
        }
            else
        {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render($vars){
        // Вид
        if (is_array($vars)) extract($vars);
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if ($file_view)
        {
            require $file_view;
        }
            else
        {
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }
        $content = ob_get_clean();
        if (false !== $this->layout)
        {
             // Шаблон
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if ($file_layout)
            {
                require $file_layout;
            }
                else
            {
                echo "<p>Не найден шаблон <b>$file_layout</b></p>";
            }
        }
    }

}