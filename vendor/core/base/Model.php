<?php

namespace vendor\core\base;

use vendor\core\Db;

/*
    Description of Class Model
*/
abstract class Model {

    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = DB::instance();
    }

    public function query($sql){
        return $this->pdo->execute($sql);
    }

    public function findAll(){
        $sql = "SELECT * FROM {$this->table}";
        $this->pdo->query($sql);
    }

}