<?php

namespace vendor\core;

/*
    Description of Class Db
*/
class Db {

    protected $pdo;
    protected static $instance;
    public static $countSql = 0;
    public static $queries = [];
    
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
    public function execute($sql, $params = []){
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Для SELECT
     */
    public function query($sql, $params = []){
        self::$countSql++;
        self::$queries[] = $sql;
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false)
        {
            return $stmt->fetchAll();
        }
        return [];
    }

}