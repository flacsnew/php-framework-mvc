<?php
error_reporting(E_ALL);

use vendor\core\Router;

require '../vendor/libs/functions.php';

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . '/vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');

// autoload classes
spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) require_once $file;
});

$query = rtrim($_SERVER['QUERY_STRING'], '/');

// url: pages/* -> posts/*
Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'posts']);

// default routs
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
debug(Router::getRoutes());

Router::dispatch($query);