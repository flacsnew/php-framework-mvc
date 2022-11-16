<?php

/*
    Description of Router
*/
class Router {

    protected static $routes = [];      // таблица маршрутов
    protected static $route = [];       // текущий маршрут

    // Добавление в таблицу маршрутов
    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    // Получить все маршруты
    public static function getRoutes()
    {
        return self::$routes;
    }

    // Получить текущий маршрут
    public static function getRoute()
    {
        return self::$route;
    }

    // Найти совпадение $url по таблице маршрутов
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route)
        {
            if (preg_match("#$pattern#i", $url, $matches))
            {
                debug($matches);
                self::$route = ['controller' => $matches['controller'], 'action' => $matches['action']];
                return true;
            }
        }
        return false;
    }

}