<?php
require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
require '../app/controllers/Main.php';
require '../app/controllers/Posts.php';
require '../app/controllers/PostsNew.php';

$query = rtrim($_SERVER['QUERY_STRING'], '/');

// default rules
// regexp: [a-z-]+ => Латиница и знак тире а также или более символов
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
debug(Router::getRoutes());

Router::dispatch($query);