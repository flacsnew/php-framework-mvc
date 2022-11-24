<?php

namespace vendor\core;

/*
    Description of Class Db
*/
class Db {

    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $db = require ROOT . "/config/config_db.php";
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    // Singleton
    public static function instance(){
        if (self::$instance === null)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Для CREATE, DELETE и пр.
     */
    public function execute($sql){
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    /**
     * Для SELECT
     */
    public function query($sql){
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if ($res !== false)
        {
            return $stmt->fetchAll();
        }
        return [];
    }

}