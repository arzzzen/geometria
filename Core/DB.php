<?php

namespace Core;


class DB
{
    private static $config;
    private static $_instance = null;
    private $dbh;
    private function __clone() {}
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public static function setConfig($config) {
        self::$config = $config;
    }
    private function __construct() {
        extract(self::$config);
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $this->setDBH(new \PDO($dsn, $user, $pass));
    }
    protected function setDBH(\PDO $dbh) {
        $this->dbh = $dbh;
    }
    public function getDBH() {
        return $this->dbh;
    }
}