<?php

/*
    Description of Router
*/
class Router {

    protected static $routes = [];      // таблица маршрутов
    protected static $route = [];       // текущий маршрут

    /**
     * Добавление в таблицу маршрутов
     * @param string $regexp регулярное выражение для маршрута
     * @param array $route правила для маршрута
     * @return void
     */
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    /**
     * Получить все маршруты
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Получить текущий маршрут
     * @return array
     */
    public static function getRoute()
    {
        return self::$route;
    }

    /**
     * Найти совпадение url по таблице маршрутов
     * @param string $url текущий url
     * @return boolean
     */
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route)
        {
            if (preg_match("#$pattern#i", $url, $matches))
            {
                foreach ($matches as $key => $val)
                {
                    if (is_string($key)) $route[$key] = $val;
                }
                if (!isset($route['action']))
                {
                    $route['action'] = 'index';
                }
                self::$route = $route;
                debug(self::$route);
                return true;
            }
        }
        return false;
    }

    /**
     * Перенаправляет URL по корректному маршруту
     * @param string $url текущий url
     * @return void
     */
    public static function dispatch($url)
    {
        if (self::matchRoute($url))
        {
            $controller = self::$route['controller'];
            self::upperCamelCase($controller);
            if (class_exists($controller))
            {
                echo 'OK';
            }
                else
            {
                echo "Контролер <b>$controller</b> не найден.";
            }
        }
            else
        {
            http_response_code(404);
            include '404.html';
        }
    }

    protected static function upperCamelCase($name){
        debug($name);
    }

}