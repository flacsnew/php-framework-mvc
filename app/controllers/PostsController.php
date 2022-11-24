<?php

namespace app\controllers;

/*
    Description of Posts
*/
class PostsController extends ApplicationController {

    public function indexAction(){
        echo "Posts::index().";
    }

    public function testAction(){
        echo "Posts::test().";
    }

}