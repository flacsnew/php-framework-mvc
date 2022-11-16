<?php
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

$query = rtrim($_SERVER['QUERY_STRING'], '/');

// default rules
// regexp: [a-z-]+ - Латиница + знак тире или более символов
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
debug(Router::getRoutes());

Router::dispatch($query);