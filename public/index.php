<?php
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

$query = $_SERVER['QUERY_STRING'];

Router::add('posts/add', ['controller' => 'Posts', 'action' => 'add']);
Router::add('posts/', ['controller' => 'Posts', 'action' => 'index']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);
debug(Router::getRoutes());

Router::matchRoute($query) ? debug(Router::getRoute()) : debug("404");