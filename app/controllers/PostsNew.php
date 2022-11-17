<?php

namespace app\controllers;

use vendor\core\base\Controller;

/*
    Description of PostsNew
*/
class PostsNew extends Controller {

    public function indexAction(){
        echo "PostsNew::index().";
    }

    public function testAction(){
        echo "PostsNew::test().";
    }

    public function testPageAction(){
        echo "PostsNew::testPage().";
    }

    public function before(){
        echo "PostsNew::before().";
    }

}