<?php

namespace app\controllers;

use app\models\Main;

/**
 * Description of Main
 */
class MainController extends ApplicationController {

    public $layout = 'main';    // переопределить шаблон

    public function indexAction()
    {
        $model = new Main;
        //$res = $model->query("CREATE TABLE `posts` SELECT * FROM `category`.`categories`"); 
        $posts = $model->findAll();
        $data = $model->findLike('категория', 'name');
        debug($data);
        
        $title = 'PAGE TITLE';
        $content = "page content";
        $this->set(compact('title', 'content', 'posts'));    // передача параметров в вид
    }

    public function testAction(){
        
    }

}