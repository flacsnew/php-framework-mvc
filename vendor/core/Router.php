<?php

namespace vendor\core;

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
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
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
        $url = self::removeQueryString($url);
        if (self::matchRoute($url))
        {
            $controller = "app\controllers\\" . self::$route['controller'];
            if (class_exists($controller))
            {
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action))
                {
                    $cObj->$action();
                    $cObj->getView();
                }
                    else
                {
                    echo "Метод <b>$action</b> в контролере <b>$controller</b> не найден.";
                }
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

    /**
     * Преобразуем имена к виду CamelCase
     * @param string $name строка для преобразования
     * @return string
     */
    protected static function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    /**
     * Преобразуем имена к виду camelCase
     * @param string $name строка для преобразования
     * @return string
     */
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }

    /**
     * Удаляет GET параметры, если они есть
     * @param string $url текущий URL
     * @return string
     */
    protected static function removeQueryString($url){
        if ($url)
        {
            $params = explode('&', $url, 2);
            if (strpos($params[0], '=') === false)
            {
                return rtrim($params[0], '/');
            }
                else
            {
                return '';
            }
        }
    }

}