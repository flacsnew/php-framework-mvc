<?php
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

$query = rtrim($_SERVER['QUERY_STRING'], '/');

// Router::add('posts/add', ['controller' => 'Posts', 'action' => 'add']);
// Router::add('posts', ['controller' => 'Posts', 'action' => 'index']);
// Router::add('', ['controller' => 'Main', 'action' => 'index']);

// default rules
// regexp: [a-z-]+ - Латиница + знак тире или более символов
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)');

debug(Router::getRoutes());

if (Router::matchRoute($query)) { debug(Router::getRoute()); } else { echo "404"; }