<?php

namespace Core;


abstract class Model
{
    public $_fields;
    public static $dbh;
    public function __construct($fields = array()) {
        $this->_fields = array_fill_keys($this->fields, null);
        if ($fields) {
            foreach(array_keys($this->_fields) as $key) {
                if (array_key_exists($key, $fields)) {
                    $this->_fields[$key] = $fields[$key];
                }
            }
        }
    }
    public function __get($name) {
        if (!array_key_exists($name, $this->_fields)) {
            throw new \Exception("Property $name is not defined");
        }
        return $this->_fields[$name];
    }
    public function __set($name, $val) {
        if (!array_key_exists($name, $this->_fields)) {
            throw new \Exception("Property $name is not defined");
        }
        $this->_fields[$name] = $val;
    }
    public static function findAll($add_sql = '', $params = array()) {
        $sth = self::getDBH()->prepare('SELECT * FROM '.static::$table." $add_sql");
        $sth->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class());
        $sth->execute($params);
        return $sth->fetchAll();
    }
    public static function find($id) {
        $id = intval($id);
        $models = self::findAll('WHERE id = :id', array(':id' => $id));
        if (!$models) {
            throw new \Exception('Can\'t find '.get_called_class(). ' with id = '.$id, 404);
        }
        return $models[0];
    }
    protected static function getDBH() {
        if (is_null(self::$dbh)) {
            $db = DB::getInstance();
            self::$dbh = $db->getDBH();
        }
        return self::$dbh;
    }
}